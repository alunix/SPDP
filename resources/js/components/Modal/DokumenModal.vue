<template>
  <div class="container">
    <h2>Dokumen yang telah dihantar</h2>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Dokumen</th>
          <th scope="col">Saiz(kb)</th>
          <th scope="col">Komen</th>
          <th scope="col">Versi</th>
          <th scope="col">Jumlah laporan</th>
          <th scope="col">Tarikh/Masa Penghantaran</th>
        </tr>
      </thead>
      <tbody>
        <tr class="tr-shadow" v-for="d in dokumens" v-bind:key="d.dokumen_permohonan_id">
          <th scope="row">{{d.versi}}</th>
          <td>{{d.file_name}}</td>
          <td>{{d.file_size}}</td>
          <td>{{d.komen}}</td>
          <td>{{d.versi}}</td>
          <td>{{d.laporans.count}}</td>
          <td>{{d.created_at}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props: ["permohonan_id"],
  data() {
    return {
      dokumens: [],
      permohonan: ""
    };
  },
  components: {
    // PermohonansModal
  },

  created() {
    this.fetchDokumens();
  },

  methods: {
    fetchDokumens() {
      fetch("api/senarai-dokumen-permohonan/" + this.permohonan_id)
        .then(res => res.json())
        .then(res => {
          //   console.log(res.permohonan.dokumen_permohonans);
          console.log(res);
          this.dokumens = res.dokumen_permohonans;
          this.permohonan = res.permohonan;
        });
    },
    downloadPdf(file_link) {
      //   axios
      //     .get("api/dokumen/" + file_link, { responseType: "arraybuffer" })
      //     .then(function(response) {
      //       var headers = response.headers();
      //       var blob = new Blob([response.data], {
      //         type: headers["content-type"]
      //       });
      //       var link = document.createElement("a");
      //       link.href = window.URL.createObjectURL(blob);
      //       link.download = dokumen.file_name;
      //       link.click();
      //     });
      //     axios.get('api/dokumen/', file_link)
      // .then(function (response) {
      //      this.previewDokumen = response.data;
      // }.bind(this));
    }
  }
};
</script>