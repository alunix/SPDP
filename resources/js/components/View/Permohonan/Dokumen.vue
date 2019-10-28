<template>
  <div class="container">
    <modal :adaptive="true" width="50%" height="50%" name="modal-laporan">
      <tab-laporan :laporans_props="laporans_props"></tab-laporan>
    </modal>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Dokumen</th>
          <th scope="col">Saiz(kb)</th>
          <th scope="col">Komen</th>
          <th scope="col">Versi</th>
          <th scope="col">Jumlah laporan</th>
          <th scope="col">Tarikh/Masa</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr
          class="tr-shadow td-cursor"
          v-for="(d, index) in dokumens"
          v-bind:key="d.dokumen_permohonan_id"
        >
          <th scope="row">{{index+1}}</th>
          <td>{{d.file_name}}</td>
          <td>{{d.file_size}}</td>
          <td>{{d.komen}}</td>
          <td>{{d.versi}}</td>
          <td>{{d.laporans.count}}</td>
          <td>{{date(d.created_at)}}</td>
          <th>
            <v-btn
              v-on:click="setLaporansProps(d.laporans);showLaporan()"
              color="primary"
              small
            >Laporan</v-btn>
          </th>
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
      permohonan: "",
      laporans_props: []
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
    showLaporan() {
      this.$modal.show("modal-laporan");
    },
    setLaporansProps(laporans) {
      this.laporans_props = laporans;
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