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
            v-model="start_date"
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
        <v-col @click="getAnalytics" class="d-flex" cols="12" sm="2">
          <v-btn style="margin-bottom:30px" normal>Search</v-btn>
        </v-col>
      </v-app-bar>
      <!-- <v-if>
      <div class="col-lg-6">
        <div class="au-card recent-report">
          <div class="au-card-inner">
            <h3 class="title-2">Jumlah permohonan mengikut fakulti</h3>
            <div class="chart-info"></div>
            <div class="recent-report__chart">
              <apexchart
                v-if="loaded"
                width="500"
                type="bar"
                :options="lineChart.options"
                :series="lineChart.series"
              ></apexchart>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="au-card recent-report">
          <div class="au-card-inner">
            <h3 class="title-2">Jenis permohonan</h3>
            <div class="recent-report__chart">
              <apexchart
                v-if="loaded"
                width="500"
                type="donut"
                :options="pieChart.options"
                :series="pieChart.series"
              ></apexchart>
            </div>
          </div>
        </div>
      </div>
      </v-if> -->
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
        { desc: "12 bulan lepas", value: dayjs().subtract(12, "month") },
        { desc: "Custom date range", value: "custom_date_range" }
      ],
      fakultis: [],
      start_date: "",
      end_date: "",
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
          // this.fakultis.unshift({ fakulti_id: 0, f_nama: "Semua fakulti" });
          // console.log(this.fakultis);
        });
    },
    // pickFile() {
    //   this.$refs.fail_permohonan.click();
    // },
    getAnalytics() {
      this.loading = true;
      // this.loaded = false;
      fetch("api/analytics", {
          headers: {
            start_date : this.start_date,
            end_date : this.end_date,
            fakulti: this.fakulti,
          }
        })
        .then(res => res.json())
        .then(res => {
          console.log(res);
          // this.error = false;
          // this.success = true;
          // this.jenis_permohonan = "";
          // this.nama_program = "";
          // this.komen = "";
          // this.fail_permohonan = "";
          // this.fileName = "";
          // this.loading = false;
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