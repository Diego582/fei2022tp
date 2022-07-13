<template>
  <v-app>
    <MainMenu></MainMenu>
    <MainBar></MainBar>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import MainBar from "./components/MainBar.vue";
import MainMenu from "./components/MainMenu.vue";

export default {
  name: "App",
  data: () => ({
    //
  }),
  components: { MainBar, MainMenu },
};
</script>
