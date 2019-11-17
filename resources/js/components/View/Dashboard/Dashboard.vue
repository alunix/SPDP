<template>
  <div>
    <div>
      <div class="col-md-12">
        <div class="au-breadcrumb-content">
          <div class="au-breadcrumb-left">
            <div class="overview-wrap">
              <h2 class="title-1">gambaran keseluruhan</h2>
            </div>
          </div>
          <form class="au-form-icon--sm" action="/search" method="post">
            <input
              class="au-input--w300 au-input--style2"
              type="text"
              name="input-search"
              placeholder="Cari permohonan dan laporan"
            />
            <button class="au-btn--submit2" type="submit">
              <i class="zmdi zmdi-search"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
    <!-- End Top -->
    <hr />
    <div class="row m-t-25">
      <div class="col-md-6 col-lg-3">
        <div class="statistic__item statistic__item--green">
          <h2 class="number" style="color:white">{{permohonans}}</h2>
          <span class="desc" style="color:white">permohonan dihantar</span>
          <div class="icon">
            <i class="zmdi zmdi-file"></i>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="statistic__item statistic__item--orange">
          <h2 class="number" style="color:white">{{permohonans}}</h2>
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
      <div class="col-lg-6">
        <div class="au-card recent-report">
          <div class="au-card-inner">
            <h3 class="title-2">Dokumen permohonan dihantar</h3>
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
      lulus: "",
      progress: "",
      loaded: false,
      pieChart: [],
      lineChart: []
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
          console.log(res);
          this.permohonans = res.permohonans;
          this.progress = res.progress;
          this.lulus = res.lulus;
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