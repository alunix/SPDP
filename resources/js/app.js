import VModal from 'vue-js-modal';
import VueRouter from 'vue-router';
import VueApexCharts from 'vue-apexcharts';
import BootstrapVue from 'bootstrap-vue';
import Vuetify from 'vuetify';
import dayjs from 'dayjs';
import LocalizedFormat from 'dayjs/plugin/localizedFormat';
import Vuex from 'vuex';

require('./bootstrap');

dayjs.extend(LocalizedFormat);

window.Vue = require('vue');
[ VModal, VueRouter, VueApexCharts, BootstrapVue, Vuetify, dayjs, Vuex ].forEach((x) => Vue.use(x));

const routes = [
	{
		path: '/senarai-permohonan',
		name: 'SenaraiPermohonan',
		component: require('./components/SenaraiPermohonan.vue').default
	},
	{
		path: '/',
		name: 'dashboard',
		component: require('./components/View/Dashboard/Dashboard.vue').default
	},
	{
		path: '/senarai-permohonan-baharu',
		name: 'senarai-baru',
		component: require('./components/view/senarai.vue').default
	},
	{
		path: '/permohonan/:id',
		name: 'permohonan',
		component: require('./components/view/Permohonan/ShowPermohonan.vue').default
	},
	{
		path: '/senarai-pengguna',
		name: 'pengguna',
		component: require('./components/View/Pengguna/SenaraiPengguna.vue').default
	},
	{
		path: '/analitik',
		name: 'analitik',
		component: require('./components/View/Analitik/DashboardAnalitik.vue').default
	},
	{
		path: '*',
		name: 'NotFound',
		component: require('./components/view/ErrorHandling/404.vue').default
	}
];

//Modal
Vue.component('PermohonanModal', require('./components/Modal/PermohonanModal.vue').default);
Vue.component('ModalPengguna', require('./components/View/Pengguna/ModalPengguna.vue').default);
Vue.component('ModalUploadDokumen', require('./components/Modal/ModalUploadDokumen.vue').default);
//View
Vue.component('senarai', require('./components/view/senarai.vue')).default;
//Tabs
Vue.component('TabDokumen', require('./components/view/Permohonan/Tab/TabDokumen.vue').default);
Vue.component('TabLaporan', require('./components/view/Permohonan/Tab/TabLaporan.vue').default);
Vue.component('TabKemajuan', require('./components/view/Permohonan/Tab/TabKemajuan.vue').default);
Vue.component('tabSenaraiBaru', require('./components/View/SenaraiPermohonan/tabSenaraiBaru.vue').default);
Vue.component('tabSenaraiPerakuan', require('./components/View/SenaraiPermohonan/tabSenaraiPerakuan.vue').default);
Vue.component('tabPenilaianPanel', require('./components/View/SenaraiPermohonan/tabPenilaianPanel.vue').default);
//Chart library
Vue.component('apexchart', VueApexCharts).default;
//Component
Vue.component('PermohonanTab', require('./components/View/Permohonan/PermohonanTab.vue').default);
//Approval view
Vue.component('LaporanUpload', require('./components/View/Approval/LaporanUpload.vue').default);
Vue.component('LantikPenilai', require('./components/View/Approval/LantikPenilai.vue').default);

//Laravel passport components
Vue.component('passport-clients', require('./components/passport/Clients.vue').default);
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue').default);

const router = new VueRouter({
	mode: 'history',
	routes // short for `routes: routes`
});

const app = new Vue({
	el: '#app',
	vuetify: new Vuetify(),
	router
});
