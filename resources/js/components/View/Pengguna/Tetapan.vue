<template>
  <v-container>
    <v-card>
      <h4>{{mode}} pengguna</h4>
      <v-divider></v-divider>
      <v-alert v-if="success" type="success">{{successMessage}}</v-alert>
      <v-row :align="center" :justify="center">
        <v-progress-circular v-if="!loaded" :size="25" :width="2" color="blue-grey" indeterminate></v-progress-circular>
      </v-row>

      <div v-if="loaded">
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
            :rules="emailRules"
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

          <v-row style="padding-right:15px" :align="center" :justify="end">
            <v-btn
              color="normal"
              class="mr-4"
              @click="$modal.hide('ModalPengguna')"
              ref="hideButton"
            >Batal</v-btn>
            <v-btn :loading="loading" type="submit" color="primary">Hantar</v-btn>
          </v-row>
        </v-form>
      </div>

      <v-divider></v-divider>
    </v-card>
  </v-container>
</template>
<script>
export default {
  props: ["user_id_props"],
  data() {
    return {
      center: "center",
      loaded: false,
      fakultis: [],
      name: "",
      email: "",
      role: "",
      fakulti: "",
      user: {},
      errors: {},
      peranans: ["Penilai", "PJK", "JPPA", "Senat", "Fakulti"],
      rules: {
        required: v => !!v || "Sila isi bahagian ini"
      },
      emailRules: [
        v => !!v || "E-mel diperlukan",
        v => /.+@.+\..+/.test(v) || "Masuk emel yang sah"
      ],
      success: false,
      user_id: this.user_id_props,
      editingMode: true,
      error: false,
      end: "end",
      api: "api/user/store",
      successMessage: "",
      loading: false
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
    this.isEditingMode();
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
    isEditingMode() {
      if (this.user_id == null || "") {
        this.mode = "Cipta";
        this.editingMode = false;
        this.loaded = true;
      } else {
        this.mode = "Kemaskini";
        fetch("api/user/" + this.user_id + "/edit")
          .then(res => res.json())
          .then(res => {
            this.name = res.name;
            this.email = res.email;
            this.role = this.getRoleString(res.role);
            if (res.fakulti_id) {
              this.fakulti = res.fakulti_id;
            }
            this.api = "api/user/" + this.user_id + "/update";
            this.loaded = true;
          });
      }
    },
    //match string in database to dropdown value
    getRoleString(role) {
      switch (role) {
        case "pjk":
        case "jppa":
          return role.toUpperCase();
          break;
        default:
          return role.charAt(0).toUpperCase() + role.substring(1);
      }
    },

    submit() {
      this.loading = true;
      let formData = new FormData();
      formData.append("name", this.name);
      formData.append("email", this.email);
      formData.append("role", this.role);
      if (!this.fakulti == "") {
        formData.append("fakulti", this.fakulti);
      }
      axios
        .post(this.api, formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          this.error = false;
          if (!this.editingMode) {
            this.successMessage =
              "Pengguna berjaya didaftar dan emel telah dihantar kepada pengguna";
            this.name = "";
            this.email = "";
            this.role = "";
          } else {
            this.successMessage = "Pengguna berjaya dikemaskini";
          }
          this.success = true;
          this.loading = false;
          this.$emit("event");
        })
        .catch(error => {
          this.loading = false;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            this.success = false;
            this.error = true;
          }
        });
    }
  }
};
</script>