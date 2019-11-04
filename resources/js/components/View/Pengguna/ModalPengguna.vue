<template>
  <div class="card-body">
    <v-alert v-if="success" type="success">Pengguna dicipta dan emel telah dihantar kepada pengguna</v-alert>
    <v-alert v-if="error" type="error">Pengguna tidak dapat dicipta</v-alert>
    <h4>Tambah pengguna</h4>
    <v-divider></v-divider>

    <v-form ref="form" @submit.prevent="submit">
      <v-text-field
        v-model="user.name"
        label="Nama"
        :rules="[v => !!v || 'Sila isi bahagian ini']"
        required
      ></v-text-field>

      <v-text-field
        v-model="user.email"
        label="E-mel"
        :rules="[v => /.+@.+/.test(v)  || 'Sila isi bahagian ini']"
        required
      ></v-text-field>

      <v-select
        v-model="user.role"
        :items="peranans"
        :rules="[v => !!v || 'Sila pilih jenis']"
        label="Peranan/Role"
        required
      ></v-select>

      <v-select
        v-if="user.role == 'Fakulti'"
        v-model="user.fakulti_id"
        item-text="f_nama"
        item-value="fakulti_id"
        :items="fakultis"
        :rules="[v => !!v || 'Sila pilih jenis']"
        label="Pilih fakulti"
        required
      ></v-select>

      <v-radio-group v-model="passwordChoice" :mandatory="true">
        <v-radio label="Auto jana kata laluan" value="auto"></v-radio>
        <v-radio label="Biar saya tetap sendiri" value="manual"></v-radio>
      </v-radio-group>

      <v-text-field
        v-if="passwordChoice == 'manual'"
        v-model="user.email"
        label="Kata laluan"
        :rules="[v => /.+@.+/.test(v)  || 'Sila isi bahagian ini']"
        required
      ></v-text-field>

      <v-text-field
        v-if="passwordChoice == 'manual'"
        v-model="user.email"
        label="Taip semula kata laluan"
        :rules="[v => /.+@.+/.test(v)  || 'Sila isi bahagian ini']"
        required
      ></v-text-field>

      <v-row style="padding-right:15px" :align="alignment" :justify="end">
        <v-btn color="normal" accept=".pdf" class="mr-4" @click="$modal.hide('ModalPengguna')">Batal</v-btn>
        <v-btn type="submit" color="primary">Hantar</v-btn>
      </v-row>
    </v-form>

    <hr />
  </div>
</template>
<script>
export default {
  data() {
    return {
      fakultis: [],
      user: [],
      errors: {},
      peranans: ["Penilai", "PJK", "JPPA", "Senat", "Fakulti"],
      success: false,
      error: false,
      passwordChoice: "",
      loaded: true,
      alignment: "center",
      end: "end"
    };
  },
  filters: {
    uppercase: function(value) {
      if (!value) {
        return "";
      }
      return value.toString().toUpperCase();
    }
  },
  created() {
    this.getFakultis();
  },
  methods: {
    getFakultis() {
      fetch("api/fakultis")
        .then(res => res.json())
        .then(res => {
          console.log(res);
          this.fakultis = res;
        });
    },
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