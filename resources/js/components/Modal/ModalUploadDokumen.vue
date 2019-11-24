<template>
  <div class="card-body">
    <h4>Muat naik penambahbaikkan</h4>
    <hr />

    <v-form ref="form" @submit.prevent="submit">
      <v-alert type="error" v-if="error">
        <b></b>
        <ul>
          <li v-for="error in errors" v-bind:key="error[0]">{{ error[0] }}</li>
        </ul>
      </v-alert>
      <!-- <v-alert v-if="success" type="success">Dokumen berjaya dimuatnaik</v-alert> -->

      <v-snackbar
        v-if="success"
        v-model="snackbar"
        color="success"
        :multi-line="false"
        :timeout="6000"
        :top="true"
        :vertical="true"
      >
        {{snackbarMessage}}
        <v-btn dark text @click="snackbar = false">Close</v-btn>
      </v-snackbar>

      <v-row style="padding-left:10px">
        <v-btn color="blue-grey" class="ma-2 white--text" @click="pickFile">
          Fail(pdf)
          <v-icon right dark>mdi-cloud-upload</v-icon>
        </v-btn>
        <br />
        <div style="padding-top:10px">
          <p style="white-space: pre-line;">{{ fileName }}</p>
        </div>
      </v-row>

      <input
        style="display:none;"
        type="file"
        id="dokumen"
        accept=".pdf"
        v-on:change="filePreview"
        name="dokumen"
        ref="dokumen"
      />

      <v-textarea
        class="mx-2"
        v-model="komen"
        id="komen"
        name="komen"
        label="Komen( Tidak diwajibkan )"
        rows="3"
      ></v-textarea>

      <v-row style="padding-right:15px" align="center" justify="end">
        <v-btn
          color="normal"
          accept=".pdf"
          class="mr-4"
          @click="$modal.hide('uploadDokumenModal')"
        >Batal</v-btn>
        <v-btn :loading="loading" type="submit" color="primary">Hantar</v-btn>
      </v-row>
    </v-form>

    <hr />
  </div>
</template>
<script>
export default {
  props: ["permohonan_id_props"],
  data() {
    return {
      fileName: "",
      dokumen: null,
      komen: "",
      errors: {},
      success: false,
      error: false,
      loaded: true,
      loading: false,
      snackbar: {},
      snackbarMessage: "Dokumen berjaya dimuatnaik"
    };
  },
  methods: {
    filePreview(event) {
      this.dokumen = event.target.files[0];
      this.fileName = event.target.files[0].name;
    },
    pickFile() {
      this.$refs.dokumen.click();
    },
    submit() {
      this.loading = true;
      let formData = new FormData();
      formData.append("dokumen", this.dokumen);
      formData.append("komen", this.komen);
      this.loaded = false;
      this.success = false;
      this.errors = {};
      axios
        .post(
          "/api/muat-naik-penambahbaikkan/" + this.permohonan_id_props,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          }
        )
        .then(res => {
          this.error = false;
          this.success = true;
          this.komen = "";
          this.dokumen = "";
          this.fileName = "";
          this.loading = false;
          this.$router.go();
          // this.$emit("event");
        })
        .catch(error => {
          this.loading = false;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
            this.success = false;
            this.error = true;
          }
        });
    }
  }
};
</script>