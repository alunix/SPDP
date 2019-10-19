<template>
  <div class="card-body">
    <div v-if="success" class="alert alert-success mt-3">Permohonan berjaya dihantar</div>
    <v-alert v-if="success" type="success">Permohonan berjaya dihantar</v-alert>
    <div v-if="error" class="alert alert-danger mt-3">Permohonan tidak dapat dihantar</div>
    <v-alert v-if="error" type="error">I'm an error alert.</v-alert>
    <h4>Permohonan baharu</h4>
    <hr />

    <v-form ref="form">
      <v-select
        v-model="jenis_permohonan_id"
        item-text="name"
        item-value="value"
        :items="jenis"
        :rules="[v => !!v || 'Sila pilih jenis']"
        label="Jenis Permohonan"
        required
      ></v-select>

      <v-text-field
        v-model="doc_title"
        label="Nama program/kursus"
        :rules="[v => !!v || 'Sila isi bahagian ini']"
        required
      ></v-text-field>

      <v-file-input label="Pautan fail"></v-file-input>

      <v-textarea class="mx-2" label="Komen( Tidak diwajibkan )" rows="1" prepend-icon="comment"></v-textarea>

      <v-btn small class="mr-4" color="normal">Batal</v-btn>
      <br />
      <v-btn small class="mr-4" color="primary">Hantar</v-btn>

      <!-- <v-btn color="error" class="mr-4" @click="reset">Reset Form</v-btn>

      <v-btn color="warning" @click="resetValidation">Reset Validation</v-btn>-->
    </v-form>

    <hr />
  </div>
</template>
<script>
export default {
  data() {
    return {
      jenis: [
        {
          name: "Program Pengajian Baru",
          value: "1"
        },
        {
          name: "Semakan Program Pengajian",
          value: "2"
        },
        {
          name: "Kursus Teras Baru",
          value: "3"
        },
        {
          name: "Kursus Elektif Baru",
          value: "4"
        },
        {
          name: "Semakan Kursus Teras",
          value: "5"
        },
        {
          name: "Semakan Kursus Elektif",
          value: "6"
        },
        {
          name: "Penjumudan Program Pengajian",
          value: "8"
        }
      ],
      jenis_permohonan_id: "",
      doc_title: "",
      komen: "",
      file_link: null,
      errors: {},
      success: false,
      error: false,
      loaded: true
    };
  },
  methods: {
    filePreview(event) {
      this.file_link = event.target.files[0];
    },
    submit() {
      let formData = new FormData();
      formData.append("file_link", this.file_link);
      formData.append("jenis_permohonan_id", this.jenis_permohonan_id);
      formData.append("doc_title", this.doc_title);
      formData.append("komen", this.komen);
      this.loaded = false;
      this.success = false;
      this.errors = {};
      axios
        .post("api/permohonan_submit", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          this.success = true;
          this.jenis_permohonan_id = "";
          this.doc_title = "";
          this.komen = "";
          this.file_link = "";
          this.$emit("event");
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
            console.log(error);
            this.error = true;
          }
        });
    }
  }
};
</script>