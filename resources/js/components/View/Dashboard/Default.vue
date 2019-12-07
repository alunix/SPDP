<template>
  <div v-if="loaded" class="row m-t-25">
    <!-- <div class="col-md-6 col-lg-3">
      <div class="statistic__item statistic__item--green">
        <h2 class="number" style="color:white">{{permohonans}}</h2>
        <span class="desc" style="color:white">permohonan dihantar</span>
        <div class="icon">
          <i class="zmdi zmdi-file"></i>
        </div>
      </div>
    </div>-->
    <div class="col-md-6 col-lg-3">
      <div class="statistic__item statistic__item--orange">
        <h2 class="number" style="color:white">{{diperakui}}</h2>
        <span class="desc" style="color:white">permohonan untuk diperakui</span>
        <div class="icon">
          <i class="zmdi zmdi-alert-circle-o"></i>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="statistic__item statistic__item--blue">
        <h2 class="number" style="color:white">{{progress}}</h2>
        <span class="desc" style="color:white">permohonan sedang dinilai</span>
        <div class="icon">
          <i class="zmdi zmdi-calendar-note"></i>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="statistic__item statistic__item--red">
        <h2 class="number" style="color:white">{{lulus}}</h2>
        <span class="desc" style="color:white">permohonan diluluskan</span>
        <div class="icon">
          <i class="zmdi zmdi-check"></i>
        </div>
      </div>
    </div>
    <!-- TODO work on showing laporans -->
    <div class="col-lg-6">
      <div class="au-card recent-report">
        <div class="au-card-inner">
          <h3 class="title-2">Laporan dikeluarkan</h3>
          <v-simple-table fixed-header height="auto">
            <template v-slot:default>
              <thead class="thead-light">
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">JENIS</th>
                  <th scope="col">TARIKH HANTAR</th>
                </tr>
              </thead>

              <tbody>
                <tr
                  class="tr-shadow td-cursor"
                  v-for="(p, index) in permohonans"
                  v-bind:key="p.id"
                  v-on:click="show(p.id)"
                >
                  <th scope="row">{{index + 1}}</th>
                  <td>{{p.jenis_permohonan.huraian}}</td>
                  <td>{{date(p.created_at)}}</td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="au-card recent-report">
        <h3 class="title-2">Senarai permohonan baharu</h3>
        <v-simple-table fixed-header height="auto">
          <template v-slot:default>
            <thead class="thead-light">
              <tr>
                <th scope="col">NO</th>
                <th scope="col">JENIS</th>
                <th scope="col">TARIKH HANTAR</th>
              </tr>
            </thead>

            <tbody>
              <tr
                class="tr-shadow td-cursor"
                v-for="(p, index) in permohonans"
                v-bind:key="p.id"
                v-on:click="show(p.id)"
              >
                <th scope="row">{{index + 1}}</th>
                <td>{{p.jenis_permohonan.huraian}}</td>
                <td>{{date(p.created_at)}}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </div>
      <!-- <div class="au-card recent-report">
        <div class="au-card-inner">
          <h3 class="title-2">Jenis permohonan</h3>
          <div class="recent-report__chart">
            <apexchart
              width="500"
              type="donut"
              :options="pieChart.options"
              :series="pieChart.series"
            ></apexchart>
          </div>
        </div>
      </div>-->
    </div>
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
import dayjs from "dayjs";
("");
export default {
  components: {
    apexchart: VueApexCharts
  },
  data() {
    return {
      permohonans: [],
      diperakui: "",
      lulus: "",
      progress: "",
      loaded: false,
      pieChart: [],
      lineChart: [],
      role: "",
      laporans: []
    };
  },
  created() {
    this.loadDashboard();
  },
  methods: {
    loadDashboard() {
      fetch("api/dashboard")
        .then(res => res.json())
        .then(res => {
          this.permohonans = res.permohonans;
          this.progress = res.progress;
          this.lulus = res.lulus;
          this.role = res.role;
          this.diperakui = res.diperakui;
          this.laporans = res.laporans;
          this.lineChart = {
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
                data: res.line_chart.data
              }
            ]
          };
          this.pieChart = {
            options: {
              chart: {
                id: res.pie_chart.id
              },
              labels: res.pie_chart.labels
            },
            series: res.pie_chart.data
          };
          this.loaded = true;
        });
    },
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
    }
  }
};
</script>