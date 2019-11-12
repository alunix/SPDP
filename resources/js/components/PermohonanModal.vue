<template>
  <div class="card-body">
    <h4>Permohonan baru</h4>
    <hr />

    <v-form ref="form" @submit.prevent="submit">
      <v-alert type="error" v-if="error">
        <b></b>
        <ul>
          <li v-for="error in errors" v-bind:key="error[0]">{{ error[0] }}</li>
        </ul>
      </v-alert>
      <v-alert v-if="success" type="success">Permohonan berjaya dihantar</v-alert>
      <v-select
        v-model="jenis_permohonan"
        item-text="name"
        item-value="value"
        :items="jenis"
        :rules="[v => !!v || 'Sila pilih jenis']"
        label="Jenis Permohonan"
        required
      ></v-select>

      <v-text-field
        v-model="nama_program"
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
        id="fail_permohonan"
        accept=".pdf"
        v-on:change="filePreview"
        name="fail_permohonan"
        ref="fail_permohonan"
      />

      <v-textarea
        class="mx-2"
        v-model="komen"
        id="komen"
        name="komen"
        label="Komen( Tidak diwajibkan )"
        rows="3"
      ></v-textarea>

      <v-row style="padding-right:15px" :align="alignment" :justify="end">
        <v-btn
          color="normal"
          accept=".pdf"
          class="mr-4"
          @click="$modal.hide('permohonan_baharu')"
        >Batal</v-btn>
        <v-btn :loading="loading" type="submit" color="primary">Hantar</v-btn>
      </v-row>
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
      jenis_permohonan: "",
      nama_program: "",
      komen: "",
      fileName: "",
      fail_permohonan: null,
      errors: {},
      success: false,
      error: false,
      loaded: true,
      alignment: "center",
      end: "end",
      loading: false
    };
  },
  methods: {
    filePreview(event) {
      this.fail_permohonan = event.target.files[0];
      this.fileName = event.target.files[0].name;
    },
    pickFile() {
      this.$refs.fail_permohonan.click();
    },
    submit() {
      this.loading = true;
      let formData = new FormData();
      formData.append("fail_permohonan", this.fail_permohonan);
      formData.append("jenis_permohonan", this.jenis_permohonan);
      formData.append("nama_program", this.nama_program);
      formData.append("komen", this.komen);
      this.loaded = false;
      this.success = false;
      this.errors = {};
      axios
        .post("api/permohonan/submit", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          this.error = false;
          this.success = true;
          this.jenis_permohonan = "";
          this.nama_program = "";
          this.komen = "";
          this.fail_permohonan = "";
          this.fileName = "";
          this.loading = false;
          this.$emit("event");
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