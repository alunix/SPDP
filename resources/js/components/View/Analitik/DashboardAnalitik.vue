<template>
  <v-container fluid>
    <v-row align="center">
      <v-app-bar style="padding-top:10px" :outlined="false" min-height="60px">
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
    </v-row>

    <v-card>
      <v-row>
        <v-col cols="7" sm="6" md="8">
          <apexchart
            v-if="loaded"
            width="500"
            height="200"
            type="bar"
            :options="line_chart.options"
            :series="line_chart.series"
          ></apexchart>
        </v-col>
        <v-col cols="9" sm="5" md="4">
          <apexchart
            v-if="loaded"
            width="400"
            height="200"
            type="donut"
            :options="pie_chart.options"
            :series="pie_chart.series"
          ></apexchart>

          <!-- <apexchart
              v-if="loaded"
              width="500"
              type="bar"
              :options="bar_chart.options"
              :series="bar_chart.series"
          ></apexchart>-->
        </v-col>
      </v-row>

      <v-row v-if="loaded" align="center" justify="center">
        <table>
          <table class="table table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Fakulti</th>
                <th scope="col">Jumlah permohonan</th>
                <th scope="col">Jumlah permohonan diluluskan</th>
                <th scope="col">Jumlah perlu penambahbaikkan</th>
                <th scope="col">Jumlah dokumen permohonan</th>
              </tr>
            </thead>

            <tbody id="permohonans-add">
              <tr class="tr-shadow td-cursor" v-for="(data, index) in datas" v-bind:key="data.id">
                <th>{{index + 1}}</th>
                <td>{{data.f_nama}}</td>
                <td>{{data.permohonans_count}}</td>
                <td>{{data.lulus_count}}</td>
                <td>{{data.penambahbaikkan_count}}</td>
                <td>{{data.dokumens_count}}</td>
              </tr>
            </tbody>
          </table>
        </table>
      </v-row>
    </v-card>
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
      fakulti: "",
      loaded: false,
      datas: [],
      bar_chart: [],
      line_chart: [],
      pie_chart: [],
      errors: []
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
        });
    },
    getAnalytics() {
      this.loading = true;
      // this.loaded = false;
      console.log(this.fakulti);
      axios
        .get("api/analytics", {
          params: {
            start_date: this.start_date,
            end_date: this.end_date,
            fakulti: this.fakulti
          }
        })
        .then(res => res.data)
        .then(res => {
          console.log(res);
          this.datas = res.datas;
          this.bar_chart = {
            options: {
              chart: {
                id: res.bar_chart.id
              },
              xaxis: {
                categories: res.bar_chart.labels
              }
            },
            series: [
              {
                name: "Jumlah",
                data: res.bar_chart.series
              }
            ]
          };
          this.line_chart = {
            options: {
              chart: {
                id: res.line_chart.id
              },
              xaxis: {
                categories: res.line_chart.labels
              }
            },
            series: [
              {
                name: "Jumlah",
                data: res.line_chart.series
              }
            ]
          };
          this.pie_chart = {
            options: {
              chart: {
                id: res.pie_chart.id
              },
              labels: res.pie_chart.labels
            },
            series: res.pie_chart.series
          };
          this.loaded = true;
        })
        .catch(error => {
          this.loading = false;
          console.log(error);
          // if (error.response.status === 422) {
          //   this.errors = error.response.data.errors || {};
          //   this.success = false;
          //   this.error = true;
          // }
        });
    }
  }
};
</script>