<template>
  <v-card min-height="360px" class="pa-2" outlined tile>
    <h3 class="subheading black--text">Muat naik laporan</h3>
    <v-divider></v-divider>

    <v-form ref="form" method="post" @submit.prevent="submit">
      <v-col md="12">
        <v-radio-group class="mt-n4" v-model="kelulusan" :mandatory="false">
          <v-radio color="success" label="Lulus permohonan" value="true"></v-radio>
          <v-radio color="red" label="Perlu penambahbaikkan" value="false"></v-radio>
        </v-radio-group>
        <!-- <v-file-input class="mt-n4" label="Laporan"></v-file-input> -->
        <v-btn color="blue-grey" class="ma-2 white--text" @click="pickFile">
          Fail(pdf)
          <v-icon right dark>mdi-cloud-upload</v-icon>
        </v-btn>
        <br />
        <div style="padding-top:10px">
          <p style="white-space: pre-line;">{{ fileName }}</p>
        </div>
        <input
          style="display:none;"
          type="file"
          id="laporan"
          accept=".pdf"
          v-on:change="filePreview"
          name="laporan"
          ref="laporan"
        />
        <v-textarea solo name="input-7-4" label="Komen laporan(Tidak diwajibkan)"></v-textarea>
      </v-col>

      <v-row
        style="padding-right:20px;padding-bottom:20px;margin-top:-20px"
        allign="center"
        justify="end"
      >
        <v-btn type="submit" small color="primary">Hantar laporan</v-btn>
      </v-row>
    </v-form>
  </v-card>
</template>
<script>
export default {
  props: ["permohonan_id_props"],
  data() {
    return {
      loaded: false,
      kelulusan: [],
      permohonan_id: this.permohonan_id_props,
      fileName: "",
      laporan: null
    };
  },
  watch: {},
  methods: {
    filePreview(event) {
      this.laporan = event.target.files[0];
      this.fileName = event.target.files[0].name;
    },
    pickFile() {
      this.$refs.laporan.click();
    },
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
    },
    currentTabComponent(tab) {
      this.currentTab = "Tab" + tab;
      return this.currentTab;
    },
    getDataBind() {
      return { permohonan_id_props: this.permohonan_id };
    },
    submit() {
      let formData = new FormData();
      formData.append("laporan", this.laporan);
      formData.append("kelulusan", this.kelulusan);
      axios
        .post("/api/upload-laporan/" + this.permohonan_id, formData, {
          headers: {
            // laporan: this.laporan,
            // kelulusan: this.kelulusan,
            "Content-Type": "multipart/form-data"
          }
          // _method: "patch"
        })
        .then(res => {
          console.log(res);
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
            this.error = true;
          }
        });
    }
  }
};
</script>