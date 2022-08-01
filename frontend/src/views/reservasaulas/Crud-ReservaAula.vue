<template>
  <v-container fluid grid-list-lg text-lg-left>
    <v-data-table
      :headers="headers"
      :items="reservas"
      sort-by="reservaAula"
      class="elevation-1"
      :search="search"
    >
      <template v-slot:no-data>
        <v-alert :value="true" color="warning" icon="warning">
          <span
            ><v-icon large>mdi-emoticon-confused-outline</v-icon>Lamentamos
            informar que no tienes Datos Cargados
          </span>
        </v-alert>
      </template>
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Reserva Aula Usuario Externos </v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
          <v-divider class="mx-4" inset vertical></v-divider>

          <!-- Sector de altas y actualizacion  -->
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                New Item
              </v-btn>
            </template>
            <v-card>
              <v-toolbar color="primary" class="text-h4" dark>
                <v-card-title>
                  <span class="text-h5">{{ formTitle }}</span>
                </v-card-title>
              </v-toolbar>
              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="8" md="6">
                      <v-select
                        v-model="editedItem.id_aula"
                        label="Aulas"
                        :items="aulas"
                        :hint="`${editedItem.id_aula.id}, ${editedItem.id_aula.descripcion}`"
                        item-text="descripcion"
                        item-value="id"
                        single-line
                      ></v-select>
                      <v-text-field
                        v-model="editedItem.fh_desde"
                        label="Desde"
                        type="datetime-local"
                      ></v-text-field>
                      <v-text-field
                        v-model="editedItem.fh_hasta"
                        label="Hasta"
                        type="datetime-local"
                      ></v-text-field>
                      <v-text-field
                        v-model="editedItem.observacion"
                        label="Observacion"
                        type="text"
                      ></v-text-field>
                      <v-switch
                        v-model="editedItem.procesado"
                        :input-value="editedItem.procesado"
                        @change="(value) => changeState(value)"
                        :label="`No procesada `"
                      ></v-switch>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="error" @click="close"> Cancelar </v-btn>
                <v-btn color="success" @click="save"> Guardar </v-btn>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>

          <!-- ESTE ES EL MODAL DE PROCESAMIENTO -->
          <v-dialog v-model="dialog2" max-width="500px">
            <v-card>
              <v-toolbar color="primary" class="text-h4" dark>
                <v-card-title>
                  <span class="text-h5">Procesar Reserva</span>
                </v-card-title>
              </v-toolbar>
              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="8" md="6">
                      <v-text-field
                        v-model="editedItem.id"
                        label="Id Reserva"
                        type="text"
                        readonly
                      ></v-text-field>

                      <v-select
                        v-model="editedItem.id_aula"
                        label="Aulas"
                        :items="aulas"
                        :hint="`${editedItem.id_aula.id}, ${editedItem.id_aula.descripcion}`"
                        item-text="descripcion"
                        item-value="id"
                        single-line
                      ></v-select>
                    </v-col>
                    <v-col cols="12" sm="8" md="6">
                      <v-text-field
                        v-model="editedItem.fh_desde"
                        label="Desde"
                        type="datetime-local"
                        readonly
                      ></v-text-field>
                      <v-text-field
                        v-model="editedItem.fh_hasta"
                        label="Hasta"
                        type="datetime-local"
                        readonly
                      ></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="12" md="12">
                      <v-text-field
                        v-model="editedItem.observacion"
                        label="Observacion"
                        type="text"
                        readonly
                      ></v-text-field>
                    </v-col>
                  </v-row>

                  <v-row>
                    <v-col cols="12" sm="12" md="12">
                      <v-card-subtitle class="ma-0 pa-0 text-center">
                        <span class="text-h10">Opciones</span>
                      </v-card-subtitle>
                      <v-text-field
                        v-model="editedItem.color"
                        label="Color"
                        type="color"
                      ></v-text-field>
                      <v-text-field
                        v-model="editedItem.detail"
                        label="Detalle del Proceso"
                        type="text"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="error" @click="close"> Cancelar </v-btn>
                <v-btn color="primary" @click="generar"> Procesar </v-btn>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>

          <!-- Modal de eliminacion -->

          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-toolbar color="error" class="text-h5" dark
                >Cuidado !!!
              </v-toolbar>
              <v-card-text>
                <div class="text-h6 pa-12">
                  Estas seguro de ELIMINAR este item?
                </div>
              </v-card-text>
              <v-card-actions class="justify-end">
                <v-spacer></v-spacer>
                <v-btn color="error" @click="closeDelete">NO</v-btn>
                <v-btn color="success" @click="deleteItemConfirm()">SI</v-btn>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <!-- Alerta de correcto en el sistema -->
          <template>
            <div class="text-center">
              <v-dialog
                v-model="dialogAlerta"
                hide-overlay
                persistent
                width="400"
              >
                <v-alert dense type="success">
                  Orden procesada Correctamente!!!
                </v-alert>
              </v-dialog>
            </div>
          </template>
          <!-- Alerta de error en el sistema -->
          <template>
            <div class="text-center">
              <v-dialog
                v-model="dialogError"
                hide-overlay
                persistent
                width="400"
              >
                <v-alert dense type="error"
                  >Advertencia <span>{{ errors }}</span>
                </v-alert>
              </v-dialog>
            </div>
          </template>
        </v-toolbar>
      </template>
      <!--   Botones de acciones  -->
      <template v-slot:[`item.actions`]="{ item }">
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-btn v-bind="attrs" v-on="on" text @click="editItem(item)">
              <v-icon small color="primary" dark> mdi-pencil</v-icon>
            </v-btn>
          </template>
          <span>Editar</span>
        </v-tooltip>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-btn v-bind="attrs" v-on="on" text @click="deleteItem(item)">
              <v-icon small color="error" dark> mdi-delete</v-icon>
            </v-btn>
          </template>
          <span>Eliminar</span>
        </v-tooltip>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              v-show="item.procesado"
              v-bind="attrs"
              v-on="on"
              text
              @click="procesarItem(item)"
            >
              <v-icon small color="tertiary" dark>
                mdi-check-underline-circle</v-icon
              >
            </v-btn>
          </template>
          <span>Procesar</span>
        </v-tooltip>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
export default {
  name: "CrudReservaAula",
  data() {
    return {
      reservaAula: "",
      url: "",
      errors: "",
      dialog: false,
      dialog2: false,
      dialogDelete: false,
      dialogAlerta: false,
      dialogError: false,
      search: "",
      aulas: "",
      profesores: "",
      headers: [
        { text: "Nro de Reserva", value: "id" },
        { text: "Aula", value: "id_aula.descripcion" },
        { text: "Fecha Desde", value: "fh_desde" },
        { text: "Fecha Hasta", value: "fh_hasta" },
        { text: "Observaciones", value: "observacion" },
        { text: "Actions", value: "actions", sortable: false },
      ],
      reservas: [],
      editedIndex: -1,
      editedItem: {
        id: "",
        id_aula: "",
        fh_desde: "",
        fh_hasta: "",
        observacion: "",
        procesado: "",
        id_usuario: 1,
      },
      defaultItem: {
        id: "",
        id_aula: "",
        fh_desde: "",
        fh_hasta: "",
        observacion: "",
        procesado: "",
        id_usuario: 1,
      },
      crearCalendario: {
        id: "",
        name: "",
        start: "",
        end: "",
        color: "",
        details: "",
      },
      calendarios: [],
      relaciones: {
        id_calendario: "",
        id_reserva: "",
      },
    };
  },
  mounted() {
    this.listarReservas(), this.listarAulas();
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo Item" : "Editar Item";
    },
  },
  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
    dialogAlerta(val) {
      if (!val) return;

      setTimeout(() => (this.dialogAlerta = false), 1500);
    },
    dialogError(val) {
      if (!val) return;

      setTimeout(() => (this.dialogError = false), 2000);
    },
  },

  methods: {
    initialize() {},
    editItem(item) {
      this.editedIndex = this.reservas.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    procesarItem(item) {
      this.editedIndex = this.reservas.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog2 = true; // cambiar a otro modal
    },
    deleteItem(item) {
      this.editedIndex = this.reservas.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },
    deleteItemConfirm() {
      this.reservas.splice(this.editedIndex, 1);
      this.axiosDelete(this.editedItem);
      this.closeDelete();
    },
    close() {
      this.dialog = false;
      this.dialog2 = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    save() {
      if (this.editedIndex > -1) {
        this.axiosUpdate();
        Object.assign(this.reservas[this.editedIndex], this.editedItem);
      } else {
        this.axiosCreate();
      }
      this.close();
    },
    changeState(valor) {
      this.editedItem.procesado = valor;
    },

    async listarReservas() {
      await this.axios
        .get("apiv1/reservaaula")
        .then((response) => {
          this.reservas = response.data;
          //solicitamos los datos a la api
        })
        .catch((e) => {
          this.errors = e;
          this.dialogError = true;
          // Capturamos los errores
        });
    },
    async listarAulas() {
      await this.axios
        .get("apiv1/aula")
        .then((response) => {
          this.aulas = response.data;

          //solicitamos los datos a la api
        })
        .catch((e) => {
          this.errors = e;
          this.dialogError = true;
          // Capturamos los errores
        });
    },
    async axiosDelete(item) {
      await this.axios.delete("apiv1/reservaaula/" + item.id).catch((e) => {
        this.errors = e;
        this.dialogError = true;
        // Capturamos los errores
      });
    },
    async axiosCreate() {
      await this.axios
        .post("apiv1/reservaaula", this.editedItem)
        .then((response) => {
          this.editedItem = response.data;
          this.reservas.push(this.editedItem);
          this.dialogAlerta = true;
        })
        .catch((e) => {
          this.errors = e;
          this.dialogError = true;
          // Capturamos los errores
        });
    },
    async axiosCreateCalendario(itemCalendario, idReserva) {
      let itemVinculado = [];
      itemVinculado.id_reserva = idReserva;

      await this.axios
        .post("apiv1/calendario", itemCalendario)
        .then((response) => {
          this.calendarios.push(response.data);
          itemVinculado.id_calendario = response.data.id;
        })
        .catch((e) => {
          this.errors = e;
          this.dialogError = true;
          // Capturamos los errores
        });
      this.relaciones = Object.assign({}, itemVinculado);

      await this.axios
        .post("apiv1/calendarioreserva", this.relaciones)
        .then((response) => {
          this.calendarios.push(response.data);
        })
        .catch((e) => {
          this.errors = e;
          this.dialogError = true;
          // Capturamos los errores
        });
    },

    async axiosUpdate() {
      await this.axios
        .put("apiv1/reservaaula/" + this.editedItem.id, this.editedItem)
        .then((response) => {
          if (response != null) {
            this.dialogAlerta = true;
          }
        })
        .catch((e) => {
          this.errors = e;
          this.dialogError = true;
          // Capturamos los errores
        });
    },
    generar() {
      let fechaDesde = Date.parse(this.editedItem.fh_desde);
      let fechaHasta = Date.parse(this.editedItem.fh_hasta);
      let fechaInicial = new Date(fechaDesde);
      let fechaFinal = new Date(fechaHasta);
      let nombre = this.editedItem.observacion;
      let color = this.editedItem.color;
      let fechaFinCalendario = Date.parse(
        new Date(
          fechaInicial.getFullYear(),
          fechaInicial.getMonth(),
          fechaInicial.getDate(),
          fechaFinal.getHours(),
          fechaFinal.getMinutes(),
          fechaFinal.getSeconds()
        )
      );
      let detalle = this.editedItem.detail;
      let fechaIni = fechaDesde;
      let itemCalendario = [];
      for (let i = fechaDesde; i < fechaHasta; i++) {
        itemCalendario.name = nombre;
        itemCalendario.start = new Date(fechaIni - 10800000);
        itemCalendario.end = new Date(fechaFinCalendario - 10800000);
        itemCalendario.color = color;
        itemCalendario.details = detalle;
        i = i + 604800000;
        this.crearCalendario = Object.assign({}, itemCalendario);
        this.axiosCreateCalendario(this.crearCalendario, this.editedItem.id);
        fechaIni = parseInt(fechaIni) + 604800000;
        fechaFinCalendario = fechaFinCalendario + 604800000;
      }
      this.editedItem.procesado = false;
      this.axiosUpdate();
      this.close();
      this.dialogAlerta = true;
    },
  },
};
</script>
