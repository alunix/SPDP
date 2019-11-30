<template>
  <v-content>
    <v-container fluid>
      <v-card>
        <v-row style="margin-bottom:-40px;max-width:1000px" align="center" justify="center">
          <v-col>
            <v-select
              item-text="desc"
              item-value="value"
              style="padding-left:20px;max-width:500px"
              label="Sila pilih tarikh/masa"
              :items="date_pickers"
              :full-width="false"
              dense
              solo
              v-model="start_date"
            ></v-select>
          </v-col>

          <v-col>
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

          <v-col v-if="start_date == ''">
            <v-menu
              ref="menu"
              v-model="menu"
              :close-on-content-click="false"
              :return-value.sync="date"
              transition="scale-transition"
              offset-y
            >
              <template v-slot:activator="{ on }">
                <v-text-field
                  v-model="date"
                  label="Start date"
                  prepend-icon="event"
                  readonly
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="date" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
              </v-date-picker>
            </v-menu>
          </v-col>

          <v-col v-if="start_date == ''">
            <v-menu
              ref="menu"
              v-model="menu"
              :close-on-content-click="false"
              :return-value.sync="date"
              transition="scale-transition"
              offset-y
            >
              <template v-slot:activator="{ on }">
                <v-text-field
                  v-model="date"
                  label="End date"
                  prepend-icon="event"
                  readonly
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="date" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
              </v-date-picker>
            </v-menu>
          </v-col>

          <v-col @click="getAnalytics" class="d-flex" cols="12" sm="2">
            <v-btn style="margin-bottom:30px" normal>Search</v-btn>
          </v-col>
        </v-row>
        <v-divider></v-divider>

        <v-row>
          <v-col>
            <apexchart
              title="Dokumen Dihantar"
              v-if="loaded"
              width="500"
              height="200"
              type="line"
              :options="line_chart.options"
              :series="line_chart.series"
            ></apexchart>
          </v-col>
          <v-col>
            <apexchart
              v-if="loaded"
              width="400"
              height="200"
              type="donut"
              :options="pie_chart.options"
              :series="pie_chart.series"
            ></apexchart>
          </v-col>
        </v-row>
        <v-divider></v-divider>
        <v-row>
          <v-col>
            <apexchart
              v-if="loaded"
              width="500"
              type="bar"
              :options="bar_chart.options"
              :series="bar_chart.series"
            ></apexchart>
          </v-col>
          <v-col>
            <apexchart
              v-if="loaded"
              width="500"
              height="200"
              type="line"
              :options="lulus_chart.options"
              :series="lulus_chart.series"
            ></apexchart>
          </v-col>
        </v-row>
        <v-divider></v-divider>

        <v-row v-if="loaded" align="center" justify="center">
          <v-simple-table fixed-header height="auto">
            <template v-slot:default>
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
                  <th>{{ index + 1 }}</th>
                  <td>{{ data.f_nama }}</td>
                  <td>{{ data.permohonans_count }}</td>
                  <td>{{ data.lulus_count }}</td>
                  <td>{{ data.penambahbaikkan_count }}</td>
                  <td>{{ data.dokumens_count }}</td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-row>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
import dayjs from "dayjs";
export default {
  data() {
    return {
      date_pickers: [
        {
          desc: "1 hari lepas",
          value: dayjs()
            .subtract(1, "day")
            .format("YYYY-MM-DD")
        },
        {
          desc: "7 hari lepas",
          value: dayjs()
            .subtract(7, "day")
            .format("YYYY-MM-DD")
        },
        {
          desc: "30 hari lepas",
          value: dayjs()
            .subtract(30, "day")
            .format("YYYY-MM-DD")
        },
        {
          desc: "90 hari lepas",
          value: dayjs()
            .subtract(90, "day")
            .format("YYYY-MM-DD")
        },
        {
          desc: "12 bulan lepas",
          value: dayjs().subtract(12, "month")
        },
        { desc: "Custom date range", value: "" }
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
      lulus_chart: [],
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
          this.fakultis.unshift({
            fakulti_id: 0,
            f_nama: "Semua fakulti"
          });
        });
    },
    getAnalytics() {
      this.loading = true;
      this.loaded = false;
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
          this.datas = res.datas;
          this.bar_chart = {
            options: {
              chart: {
                id: res.bar_chart.id
              },
              xaxis: {
                categories: res.bar_chart.labels
              },
              title: {
                text: "Permohonan oleh setiap fakulti",
                align: "left"
              }
            },
            series: [
              {
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
              },
              title: {
                text: "Dokumen dihantar",
                align: "left"
              }
            },
            series: [
              {
                name: "Jumlah",
                data: res.line_chart.series
              }
            ]
          };
          this.lulus_chart = {
            options: {
              chart: {
                id: res.lulus_chart.id
              },
              xaxis: {
                categories: res.lulus_chart.labels
              },
              title: {
                text: "Permohonan diluluskan",
                align: "left"
              }
            },
            series: [
              {
                name: "Jumlah",
                data: res.lulus_chart.series
              }
            ]
          };
          this.pie_chart = {
            options: {
              chart: {
                id: res.pie_chart.id
              },
              title: {
                text: "Jenis permohonan",
                align: "left"
              },
              labels: res.pie_chart.labels
            },
            series: res.pie_chart.series
          };
          this.loaded = true;
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
