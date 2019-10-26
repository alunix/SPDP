<template>
  <div class="card-body">
    <v-alert v-if="success" type="success">Permohonan berjaya dihantar</v-alert>
    <v-alert v-if="error" type="error">Permohonan tidak dapat dihantar</v-alert>
    <h4>Permohonan baru</h4>
    <hr />

    <v-form ref="form" @submit.prevent="submit">
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
        id="file_link"
        accept=".pdf"
        v-on:change="filePreview"
        name="file_link"
        ref="file_link"
      />

      <v-textarea
        class="mx-2"
        v-model="komen"
        id="komen"
        name="komen"
        label="Komen( Tidak diwajibkan )"
        rows="3"
      ></v-textarea>

      <v-btn
        color="normal"
        accept=".pdf"
        class="mr-4"
        @click="$modal.hide('permohonan_baharu')"
      >Batal</v-btn>

      <v-btn type="submit" color="primary">Hantar</v-btn>
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
      fileName: "",
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
      this.fileName = event.target.files[0].name;
    },
    pickFile() {
      this.$refs.file_link.click();
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
          this.fileName = "";
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