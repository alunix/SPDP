<template>
  <div class="container">
    <h3 class="title-5 m-b-35">Senarai permohonan baharu</h3>
    <div class="table-data__tool">
      <div class="table-data__tool-left"></div>
    </div>
    <h4>Jumlah permohonan baharu : {{permohonans.length}}</h4>
    <div class="table-responsive table-responsive-data2">
      <table class="table table-data2">
        <thead>
          <tr>
            <th>no</th>
            <th>id</th>
            <th>jenis</th>
            <th>bil penghantaran</th>
            <th>nama program/kursus</th>
            <th>penghantar</th>
            <th>fakulti</th>
            <th>tarikh</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr class="tr-shadow" v-for="p in permohonans" v-bind:key="p.permohonan_id">
            <th scope="row">{{p.permohonan_id}}</th>
            <td>{{p.permohonan_id}}</td>
            <td>{{p.jenis_permohonan.jenis_permohonan_huraian}}</td>
            <td>{{p.version_counts()}}</td>
            <td>{{p.doc_title}}</td>
            <td>{{p.user.name}}</td>
            <td>{{p.user.fakulti.fnama_kod}}</td>
            <td>{{p.created_at}}</td>

            <td>
              <div class="table-data-feature">
                <button
                  v-on:click="showPermohonan"
                  class="item"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Lihat permohonan"
                >
                  <i class="zmdi zmdi-zoom-in"></i>
                </button>
              </div>
            </td>
          </tr>
          <tr class="spacer"></tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
// export default {
//   data() {
//     return {
//       permohonans: [],
//       permohonan_id: "",
//       permohonans: {
//         permohonan_id: "",
//         jenis: "",
//         bil_hantar: "",
//         doc_title: "",
//         nama: "",
//         created_at: "",
//         status_permohonan_id: "",
//         updated_at: ""
//       }
//     };
//   },
//   components: {
//     PermohonansModal
//   },

//   created() {
//     this.fetchPermohonans();
//   },
//   methods: {
//     fetchPermohonans() {
//       fetch("api/permohonan_dihantar")
//         .then(res => res.json())
//         .then(res => {
//           this.permohonans = res;
//         });
//     },
//     setPermohonanId(id) {
//       this.permohonan_id = id;
//     },
//     showModel() {
//       this.$modal.show("permohonan_baharu");
//     },
//     showKemajuanModel() {
//       this.$modal.show("kemajuan_permohonan");
//     },
//     showDokumenModel() {
//       this.$modal.show("dokumen_permohonan");
//     }
//   }
// };
</script>