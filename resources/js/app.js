import VModal from "vue-js-modal";
import VueRouter from "vue-router";
import VueApexCharts from "vue-apexcharts";
import BootstrapVue from "bootstrap-vue";
import Vuetify from "vuetify";
import dayjs from "dayjs";
import LocalizedFormat from "dayjs/plugin/localizedFormat";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

dayjs.extend(LocalizedFormat);

window.Vue = require("vue");
[VModal, VueRouter, VueApexCharts, BootstrapVue, Vuetify, dayjs].forEach(x =>
    Vue.use(x)
);

const routes = [
    {
        path: "/modal_kemajuan_permohonan",
        name: "modal_kemajuan",
        component: require("./components/KemajuanPermohonan.vue")
    },
    {
        path: "/modal_pengguna_baharu",
        component: require("./components/Pengguna.vue")
    },
    {
        path: "/permohonans",
        name: "permohonans",
        component: require("./components/permohonans.vue")
    },
    {
        path: "/dashboard",
        name: "dashboard",
        component: require("./components/View/Dashboard/Dashboard.vue"),
    },
    {
        path: "/senarai-permohonan-baharu",
        component: require("./components/view/senarai.vue")
    },
    {
        path: "/permohonan/:id",
        name: "permohonan",
        component: require("./components/view/Permohonan/ShowPermohonan.vue")
    },
    {
        path: "*",
        name: "NotFound",
        component: require("./components/view/ErrorHandling/404.vue")
    }
];

Vue.component("permohonanModal", require("./components/PermohonanModal.vue"));

//Modal
Vue.component("kemajuanModal", require("./components/Modal/KemajuanModal.vue"));
Vue.component("dokumenModal", require("./components/Modal/DokumenModal.vue"));
//View
Vue.component("senarai", require("./components/view/senarai.vue"));

//Chart library
Vue.component("apexchart", VueApexCharts);

//Tab
Vue.component(
    "senaraiPermohonan",
    require("./components/view/SenaraiPermohonan/SenaraiPermohonan.vue")
);

const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
});

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    router
});
