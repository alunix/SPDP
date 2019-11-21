<template>
  <v-container fluid>
    <v-row align="center">
      <v-app-bar style="padding-top:20px" :outlined="false" min-height="60px">
        <v-col class="d-flex" cols="12" sm="5">
          <v-select
            item-text="desc"
            item-value="value"
            label="Sila pilih tarikh/masa"
            :items="date_pickers"
            dense
            solo
            v-model="date_picker"
          ></v-select>
        </v-col>
        <v-col class="d-flex" cols="12" sm="5">
          <v-select
            item-text="f_nama"
            item-value="fakulti_id"
            label="Sila pilih fakulti"
            :items="fakultis"
            v-model="fakulti"
            dense
            solo
          ></v-select>
        </v-col>
        <v-col class="d-flex" cols="12" sm="2">
          <v-btn style="margin-bottom:30px" normal>Search</v-btn>
        </v-col>
      </v-app-bar>
    </v-row>
  </v-container>
</template>

<script>
import dayjs from "dayjs";
export default {
  data() {
    return {
      date_pickers: [
        { desc: "1 hari lepas", value: dayjs().subtract(1, "day") },
        { desc: "7 hari lepas", value: dayjs().subtract(7, "day") },
        { desc: "30 hari lepas", value: dayjs().subtract(30, "day") },
        { desc: "90 hari lepas", value: dayjs().subtract(90, "day") },
        { desc: "12 bulan lepas", value: dayjs().subtract(12, "month") }
      ],
      fakultis: [],
      date_picker: "",
      fakulti: ""
    };
  },
  created() {
    this.fetchFakultis();
  },
  methods: {
    fetchFakultis() {
      fetch("/api/fakultis")
        .then(res => res.json())
        .then(res => {
          this.fakultis = res;
          this.fakultis.unshift({ fakulti_id: 0, f_nama: "Semua fakulti" });
          // console.log(this.fakultis);
        });
    }
    // pickFile() {
    //   this.$refs.fail_permohonan.click();
    // },
    // submit() {
    //   this.loading = true;
    //   let formData = new FormData();
    //   formData.append("fail_permohonan", this.fail_permohonan);
    //   formData.append("jenis_permohonan", this.jenis_permohonan);
    //   formData.append("nama_program", this.nama_program);
    //   formData.append("komen", this.komen);
    //   this.loaded = false;
    //   this.success = false;
    //   this.errors = {};
    //   axios
    //     .post("api/permohonan/submit", formData, {
    //       headers: {
    //         "Content-Type": "multipart/form-data"
    //       }
    //     })
    //     .then(res => {
    //       this.error = false;
    //       this.success = true;
    //       this.jenis_permohonan = "";
    //       this.nama_program = "";
    //       this.komen = "";
    //       this.fail_permohonan = "";
    //       this.fileName = "";
    //       this.loading = false;
    //       this.$emit("event");
    //     })
    //     .catch(error => {
    //       this.loading = false;
    //       if (error.response.status === 422) {
    //         this.errors = error.response.data.errors || {};
    //         this.success = false;
    //         this.error = true;
    //       }
    //     });
    // }
  }
};
</script>