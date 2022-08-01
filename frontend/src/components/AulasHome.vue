<template>
  <v-container>
    <v-card elevation="24" class="mx-auto">
      <v-system-bar lights-out></v-system-bar>
      <v-carousel
        :continuous="false"
        :cycle="cycle"
        :show-arrows="false"
        hide-delimiter-background
        delimiter-icon="mdi-minus"
        height="300"
      >
        <v-carousel-item v-for="(item, i) in items" :key="i">
          <v-sheet color="tertiary" height="100%" width="100%" tile>
            <v-bottom-navigation background-color>
              <v-btn :to="item.to">
                <span>{{ item.title }}</span>

                <v-icon color="primary" dark>{{ item.icon }} </v-icon>
              </v-btn>
            </v-bottom-navigation>
            <v-img :src="item.img"></v-img>
          </v-sheet>
        </v-carousel-item>
      </v-carousel>
      <v-list two-line>
        <v-list-item>
          <v-list-item-avatar>
            <v-img :src="require('../assets/f1.jpg')"></v-img>
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title>Diego Peña</v-list-item-title>
            <v-list-item-subtitle>Desarrollador</v-list-item-subtitle>
          </v-list-item-content>
          <v-list-item-action>
            <v-switch v-model="cycle" label="Ciclo de Slides" inset></v-switch>
          </v-list-item-action>
        </v-list-item>
      </v-list>
    </v-card>
  </v-container>
</template>
<script>
export default {
  name: "AulasHome",
  components: {},
  data() {
    return {
      colors: [
        "tertiary",
        "green",
        "secondary",
        "yellow darken-4",
        "red lighten-2",
        "orange darken-1",
        "success",
        "purple",
      ],
      cycle: false,
      slides: ["First", "Second", "Third", "Fourth", "Fifth"],
      items: [
        {
          title: "Home",
          icon: "mdi-home",
          to: "/",
          img: "https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg",
        },
        {
          title: "Carrera",
          icon: "mdi-account-school",
          to: "/carrera",
          img: "https://cdn.vuetifyjs.com/images/carousel/sky.jpg",
        },
        {
          title: "Profesor",
          icon: "mdi-account-tie",
          to: "/profesor",
          img: "https://cdn.vuetifyjs.com/images/carousel/bird.jpg",
        },
        {
          title: "Materia",
          icon: "mdi-form-select",
          to: "/materia",
          img: "https://cdn.vuetifyjs.com/images/carousel/planet.jpg",
        },
        {
          title: "Aula",
          icon: "mdi-home-import-outline",
          to: "/aula",
          img: "https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg",
        },
        {
          title: "Reservar Aula",
          icon: " mdi-clipboard-clock",
          to: "/reservaaula",
          img: "https://cdn.vuetifyjs.com/images/carousel/sky.jpg",
        },
        {
          title: "Horario Materia",
          icon: "mdi-clock-check",
          to: "/horariomateria",
          img: "https://cdn.vuetifyjs.com/images/carousel/planet.jpg",
        },

        {
          title: "Calendario",
          icon: "mdi-calendar-month",
          to: "/calendario",
          img: "https://cdn.vuetifyjs.com/images/carousel/bird.jpg",
        },
      ],
    };
  },
};
</script>
