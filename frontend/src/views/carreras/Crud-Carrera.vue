<template>
  <v-container fluid grid-list-lg text-lg-left>
    <v-data-table
      :headers="headers"
      :items="carreras"
      sort-by="carrera"
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
          <v-toolbar-title>Carreras</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
          <v-divider class="mx-4" inset vertical></v-divider>

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
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field
                        v-model="editedItem.id"
                        label="Codigo Carrera"
                        disabled
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field
                        v-model="editedItem.nombre"
                        label="Nombre Carrera"
                      ></v-text-field>
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

          <template>
            <div class="text-center">
              <v-dialog
                v-model="dialogAlerta"
                hide-overlay
                persistent
                width="400"
              >
                <v-alert dense type="success">
                  Orden procesada Corresctamente!!!
                </v-alert>
              </v-dialog>
            </div>
          </template>
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
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
export default {
  name: "CrudCarrera",

  data() {
    return {
      carrera: "",
      url: "",
      errors: "",
      dialog: false,
      dialogDelete: false,
      dialogAlerta: false,
      dialogError: false,
      search: "",
      headers: [
        { text: "ID", value: "id" },
        { text: "Nombre", value: "nombre" },
        { text: "Actions", value: "actions", sortable: false },
      ],
      carreras: [],
      editedIndex: -1,
      editedItem: {
        id: "",
        nombre: "",
      },
      defaultItem: {
        id: "",
        nombre: "",
      },
    };
  },
  async mounted() {
    this.listarCarreras();
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

  created() {
    this.initialize();
  },

  methods: {
    initialize() {},
    editItem(item) {
      this.editedIndex = this.carreras.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    deleteItem(item) {
      this.editedIndex = this.carreras.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },
    deleteItemConfirm() {
      this.carreras.splice(this.editedIndex, 1);
      this.axiosDelete(this.editedItem);
      console.log("error", this.errors);
      if (this.errors != true) {
        this.dialogAlerta = true;
      }
      this.closeDelete();
    },

    close() {
      this.dialog = false;
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
        Object.assign(this.carreras[this.editedIndex], this.editedItem);
      } else {
        this.axiosCreate();
      }
      this.close();
    },
    async listarCarreras() {
      await this.axios
        .get("apiv1/carrera")
        .then((response) => {
          this.carreras = response.data;
          //solicitamos los datos a la api
        })
        .catch((e) => {
          this.errors = e;
          this.dialogError = true;
          // Capturamos los errores
        });
    },
    async axiosDelete(item) {
      await this.axios.delete("apiv1/carrera/" + item.id).catch((e) => {
        this.errors = e;
        this.dialogError = true;
        // Capturamos los errores
      });
    },
    async axiosCreate() {
      await this.axios
        .post("apiv1/carrera", this.editedItem)
        .then((response) => {
          this.editedItem = response.data;
          this.carreras.push(this.editedItem);
          this.editItem.id = "";
          this.editItem.nombre = "";
          this.dialogAlerta = true;
        })
        .catch((e) => {
          this.errors = e;
          this.dialogError = true;
        });
    },
    async axiosUpdate() {
      await this.axios
        .put("apiv1/carrera/" + this.editedItem.id, this.editedItem)
        .then((response) => {
          if (response != null) {
            this.dialogAlerta = true;
          }
        })
        .catch((e) => {
          this.errors = e;
          this.dialogError = true;
        });
    },
  },
};
</script>
