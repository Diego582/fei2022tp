import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import axios from "axios";
import VueAxios from "vue-axios";
import custom_axios from "@/plugins/axios";


Vue.config.productionTip = false
Vue.use(VueAxios, axios, custom_axios);

new Vue({
  vuetify,
  render: h => h(App)
}).$mount('#app')
