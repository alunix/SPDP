<template>
  <div v-if="loaded" class="row m-t-25">
    <div class="col-md-6 col-lg-3">
      <div class="statistic__item statistic__item--green">
        <h2 class="number" style="color:white">{{permohonans}}</h2>
        <span class="desc" style="color:white">permohonan dihantar</span>
        <div class="icon">
          <i class="zmdi zmdi-file"></i>
        </div>
      </div>
    </div>
    <!-- <div class="col-md-6 col-lg-3">
      <div class="statistic__item statistic__item--orange">
        <h2 class="number" style="color:white">{{diperakui}}</h2>
        <span class="desc" style="color:white">permohonan untuk diperakui</span>
        <div class="icon">
          <i class="zmdi zmdi-alert-circle-o"></i>
        </div>
      </div>
    </div> -->
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
    <div class="col-lg-6">
      <div class="au-card recent-report">
        <div class="au-card-inner">
          <h3 class="title-2">Dokumen permohonan dihantar</h3>
          <div class="chart-info"></div>
          <div class="recent-report__chart">
            <apexchart
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
              width="500"
              type="donut"
              :options="pieChart.options"
              :series="pieChart.series"
            ></apexchart>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
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
      role: ""
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
    }
  }
};
</script>