import VModal from "vue-js-modal";
import VueRouter from "vue-router";
import VueApexCharts from "vue-apexcharts";
import BootstrapVue from "bootstrap-vue";
import Vuetify from "vuetify";
import dayjs from "dayjs";
import LocalizedFormat from "dayjs/plugin/localizedFormat";

require("./bootstrap");

dayjs.extend(LocalizedFormat);

window.Vue = require("vue");
[VModal, VueRouter, VueApexCharts, BootstrapVue, Vuetify, dayjs].forEach(x =>
    Vue.use(x)
);

const routes = [
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
        name: "senarai-baru",
        component: require("./components/view/senarai.vue").default
    },
    {
        path: "/permohonan/:id",
        name: "permohonan",
        component: require("./components/view/Permohonan/ShowPermohonan.vue")
            .default
    },
    {
        path: "/pengguna",
        name: "pengguna",
        component: require("./components/View/Pengguna/SenaraiPengguna.vue")
            .default
    },
    {
        path: "*",
        name: "NotFound",
        component: require("./components/view/ErrorHandling/404.vue").default
    }
];

//Modal
Vue.component(
    "PermohonanModal",
    require("./components/PermohonanModal.vue").default
);
Vue.component(
    "ModalPengguna",
    require("./components/View/Pengguna/ModalPengguna.vue").default
);
//View
Vue.component("senarai", require("./components/view/senarai.vue")).default;
//Tabs
Vue.component(
    "tab-dokumen",
    require("./components/view/Permohonan/Tab/Dokumen.vue").default
);
Vue.component(
    "tab-laporan",
    require("./components/view/Permohonan/Tab/Laporan.vue").default
);
Vue.component(
    "tab-kemajuan",
    require("./components/view/Permohonan/Tab/Kemajuan.vue").default
);
Vue.component("permohonans", require("./components/permohonans.vue").default);
Vue.component(
    "tabSenaraiBaru",
    require("./components/View/SenaraiPermohonan/tabSenaraiBaru.vue").default
);
Vue.component(
    "tabSenaraiPerakuan",
    require("./components/View/SenaraiPermohonan/tabSenaraiPerakuan.vue")
        .default
);
Vue.component(
    "tabPenilaianPanel",
    require("./components/View/SenaraiPermohonan/tabPenilaianPanel.vue").default
);
//Chart library
Vue.component("apexchart", VueApexCharts).default;

//Tab
Vue.component(
    "senaraiPermohonan",
    require("./components/view/SenaraiPermohonan/SenaraiPermohonan.vue").default
);
//Component
Vue.component(
    "tabPermohonan",
    require("./components/View/Permohonan/TabPermohonan.vue").default
);
//Approval view
Vue.component(
    "laporanUpload",
    require("./components/View/Approval/LaporanUpload.vue").default
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
