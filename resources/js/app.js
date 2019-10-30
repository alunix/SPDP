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
        path: "/modal_pengguna_baharu",
        component: require("./components/Pengguna.vue").default
    },
    {
        path: "/senarai-permohonan",
        name: "permohonans",
        component: require("./components/permohonans.vue").default
    },
    {
        path: "/dashboard",
        name: "dashboard",
        component: require("./components/View/Dashboard/Dashboard.vue").default
    },
    {
        path: "/senarai-permohonan-baharu",
        component: require("./components/view/senarai.vue").default
    },
    {
        path: "/permohonan/:id",
        name: "permohonan",
        component: require("./components/view/Permohonan/ShowPermohonan.vue")
            .default
    },
    {
        path: "*",
        name: "NotFound",
        component: require("./components/view/ErrorHandling/404.vue").default
    }
];

Vue.component(
    "permohonanModal",
    require("./components/PermohonanModal.vue").default
);

//View
Vue.component("senarai", require("./components/view/senarai.vue")).default;
//Tabs
Vue.component(
    "tab-dokumen",
    require("./components/view/Permohonan/Dokumen.vue").default
);
Vue.component(
    "tab-laporan",
    require("./components/view/Permohonan/Laporan.vue").default
);
Vue.component(
    "tab-kemajuan",
    require("./components/view/Permohonan/Kemajuan.vue").default
);
//Chart library
Vue.component("apexchart", VueApexCharts).default;

//Tab
Vue.component(
    "senaraiPermohonan",
    require("./components/view/SenaraiPermohonan/SenaraiPermohonan.vue").default
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
