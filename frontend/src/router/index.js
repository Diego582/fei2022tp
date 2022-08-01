import Vue from "vue";
import VueRouter from "vue-router";
import AulasHome from "../components/AulasHome";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Default",
    redirect: "/home",
    component: AulasHome,
    children: [
      {
        path: "home",
        name: "home",
        component: AulasHome,
      },
    ],
  },

  {
    path: "/about",
    name: "about",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../components/AulasAbout.vue"),
  },
  {
    path: "/carrera",
    name: "ListarCarreras",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(
        /* webpackChunkName: "about" */ "../views/carreras/Crud-Carrera.vue"
      ),
  },
  {
    path: "/profesor",
    name: "ListarProfesores",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(
        /* webpackChunkName: "about" */ "../views/profesores/Crud-Profesor.vue"
      ),
  },
  {
    path: "/materia",
    name: "ListarMaterias",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(
        /* webpackChunkName: "about" */ "../views/materias/Crud-Materia.vue"
      ),
  },
  {
    path: "/aula",
    name: "ListarAulas",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/aulas/Crud-Aula.vue"),
  },
  {
    path: "/reservaaula",
    name: "ListarReservasAulas",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(
        /* webpackChunkName: "about" */ "../views/reservasaulas/Crud-ReservaAula.vue"
      ),
  },
  {
    path: "/calendario",
    name: "ListarCrudCalendario",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(
        /* webpackChunkName: "about" */ "../components/CalendarioReserva.vue"
      ),
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
