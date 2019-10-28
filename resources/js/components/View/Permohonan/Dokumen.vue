<template>
  <div class="container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Dokumen</th>
          <th scope="col">Saiz(kb)</th>
          <th scope="col">Komen</th>
          <th scope="col">Versi</th>
          <th scope="col">Jumlah laporan</th>
          <th scope="col">Tarikh/Masa</th>
        </tr>
      </thead>
      <tbody>
        <tr class="tr-shadow" v-for="(d, index) in dokumens" v-bind:key="d.dokumen_permohonan_id">
          <th scope="row">{{index+1}}</th>
          <td>{{d.file_name}}</td>
          <td>{{d.file_size}}</td>
          <td>{{d.komen}}</td>
          <td>{{d.versi}}</td>
          <td>{{d.laporans.count}}</td>
          <td>{{date(d.created_at)}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import dayjs from "dayjs";
export default {
  props: ["dokumens_props"],
  data() {
    return {
      dokumens: [],
      permohonan: ""
    };
  },
  created() {
    this.dokumens = this.dokumens_props;
  },

  methods: {
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
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