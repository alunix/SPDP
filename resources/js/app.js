import VModal from "vue-js-modal";
import VueRouter from "vue-router";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
Vue.use(VModal);
// Vue.use(VueRouter);

// const routes = [
//     {
//         path: "/modal_permohonan_baharu",
//         component: require("./components/PermohonanModal.vue")
//     },
//     {
//         path: "/modal_kemajuan_permohonan",
//         component: require("./components/KemajuanPermohonan.vue")
//     },
//     {
//         path: "/modal_dokumen_permohonan",
//         component: require("./components/DokumenPermohonan.vue")
//     },
//     {
//         path: "/modal_pengguna_baharu",
//         component: require("./components/Pengguna.vue")
//     }
// ];

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("permohonans", require("./components/Permohonans.vue"));
Vue.component("permohonanModal", require("./components/PermohonanModal.vue"));

//Modal
Vue.component("kemajuanModal", require("./components/modal/KemajuanModal.vue"));
Vue.component("dokumenModal", require("./components/modal/DokumenModal.vue"));

// const router = new VueRouter({
//     mode: "history",
//     routes // short for `routes: routes`
// });

const app = new Vue({
    el: "#app"
    // router
});
