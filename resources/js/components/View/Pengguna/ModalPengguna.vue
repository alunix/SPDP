<template>
  <div class="card-body">
    <v-alert
      v-if="success"
      type="success"
    >Pengguna berjaya didaftar dan emel telah dihantar kepada pengguna</v-alert>
    <v-alert v-if="error" type="error">Pengguna tidak dapat didaftar</v-alert>
    <h4>Tambah pengguna</h4>
    <v-divider></v-divider>

    <v-form ref="form" @submit.prevent="submit">
      <v-text-field v-model="user.name" label="Nama" :rules="[rules.required]"></v-text-field>

      <v-text-field
        v-model="user.email"
        label="E-mel"
        :rules="[v => /.+@.+/.test(v)  || 'Sila isi bahagian ini']"
        required
      ></v-text-field>

      <v-select
        v-model="user.role"
        :items="peranans"
        :rules="[rules.required]"
        label="Peranan/Role"
      ></v-select>

      <v-select
        v-if="user.role == 'Fakulti'"
        v-model="user.fakulti_id"
        item-text="f_nama"
        item-value="fakulti_id"
        :items="fakultis"
        :rules="[rules.required]"
        label="Pilih fakulti"
        :required="user.role == 'Fakulti'"
      ></v-select>

      <v-radio-group v-model="passwordChoice" :mandatory="true">
        <v-radio label="Auto jana kata laluan" value="false"></v-radio>
        <v-radio label="Biar saya tetap sendiri" value="true"></v-radio>
      </v-radio-group>

      <div v-if="passwordChoice == 'true'">
        <v-text-field
          :append-icon="true ? 'visibility' : 'visibility_off'"
          v-model="user.password"
          :type="show1 ? 'text' : 'password'"
          label="Kata laluan"
          @click:append="show1 = !show1"
          :required="requiredPassword()"
        ></v-text-field>

        <v-text-field
          :append-icon="true ? 'visibility' : 'visibility_off'"
          v-model="user.confirmPassword"
          :type="show2 ? 'text' : 'password'"
          label="Taip semula kata laluan"
          @click:append="show2 = !show2"
          :required="requiredPassword()"
        ></v-text-field>
      </div>

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
      show1: false,
      show2: false,
      rules: {
        required: v => !!v || "Sila isi bahagian ini"
      },
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
          this.fakultis = res;
        });
    },
    requiredPassword() {
      if (this.passwordChoice == "true") {
        return true;
      } else {
        return false;
      }
    },
    submit() {
      let formData = new FormData();
      formData.append("name", this.user.name);
      formData.append("email", this.user.email);
      formData.append("role", this.user.role);
      if (!this.user.fakulti_id == null) {
        formData.append("fakulti_id", this.user.fakulti_id);
      }
      axios
        .post("api/daftar-pengguna", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          console.log(res);
          this.success = true;
          this.user = [];
          this.$emit("event");
        })
        .catch(error => {
          if (error.response.status === 500) {
            this.errors = error.response.data.errors || {};
            console.log(error);
            this.error = true;
          }
        });
    }
  }
};
</script>