<template>
  <div class="card-body">
    <h4>Tambah pengguna</h4>
    <v-divider></v-divider>
    <v-alert
      v-if="success"
      type="success"
    >Pengguna berjaya didaftar dan emel telah dihantar kepada pengguna</v-alert>

    <v-form ref="form" @submit.prevent="submit">
      <v-alert type="error" v-if="error">
        <b></b>
        <ul>
          <li v-for="error in errors" v-bind:key="error[0]">{{ error[0] }}</li>
        </ul>
      </v-alert>

      <v-text-field
        v-model="name"
        label="Nama"
        :rules="[rules.required]"
        :error-messages="name.error"
      ></v-text-field>

      <v-text-field
        v-model="email"
        label="E-mel"
        :rules="[v => /.+@.+/.test(v)  || 'Sila isi bahagian ini']"
        required
        :error-messages="email.error"
      ></v-text-field>

      <v-select
        v-model="role"
        label="Peranan/Role"
        :items="peranans"
        :rules="[rules.required]"
        :error-messages="role.error"
      ></v-select>

      <v-select
        v-if="role == 'Fakulti'"
        v-model="fakulti"
        label="Pilih fakulti"
        item-text="f_nama"
        item-value="fakulti_id"
        :items="fakultis"
        :rules="[rules.required]"
        :error-messages="fakulti.error"
      ></v-select>

      <v-row style="padding-right:15px" :align="alignment" :justify="end">
        <v-btn color="normal" accept=".pdf" class="mr-4" @click="$modal.hide('ModalPengguna')">Batal</v-btn>
        <v-btn type="submit" color="primary">Hantar</v-btn>
      </v-row>
    </v-form>

    <v-divider></v-divider>
  </div>
</template>
<script>
export default {
  data() {
    return {
      fakultis: [],
      name: "",
      email: "",
      role: "",
      fakulti: "",
      errors: {},
      peranans: ["Penilai", "PJK", "JPPA", "Senat", "Fakulti"],
      rules: {
        required: v => !!v || "Sila isi bahagian ini"
      },
      success: false,
      error: false,
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
          this.fakultis = res;
          console.log(res);
        });
    },
    submit() {
      let formData = new FormData();
      formData.append("name", this.name);
      formData.append("email", this.email);
      formData.append("role", this.role);
      // console.log(formData);
      if (!this.fakulti == "") {
        formData.append("fakulti", this.fakulti);
        console.log("Exist");
      }
      axios
        .post("api/daftar-pengguna", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          console.log(res);
          this.error = false;
          this.success = true;
          this.name = "";
          (this.role = ""), (this.email = ""), this.$emit("event");
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            console.log(this.errors);
            this.success = false;
            this.error = true;
          }
        });
    }
  }
};
</script>