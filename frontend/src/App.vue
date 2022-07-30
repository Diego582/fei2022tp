<template>
  <v-app>
    <MainBarMenu></MainBarMenu>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import MainBarMenu from "./components/MainBarMenu.vue";

export default {
  name: "App",
  data: () => ({
    //
  }),
  components: { MainBarMenu },
};
</script>
