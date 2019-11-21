<template>
  <v-container fluid>
    <v-row align="center">
      <v-col class="d-flex" cols="6" sm="6">
        <v-select :items="items" label="2019"></v-select>
      </v-col>
      <v-col class="d-flex" cols="6" sm="6">
        <v-select :items="items" label="Semua fakulti"></v-select>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
// import VueApexCharts from "vue-apexcharts";
// export default {
//   components: {
//     apexchart: VueApexCharts
//   },
//   data() {
//     return {
//       permohonans: [],
//       lulus: "",
//       progress: "",
//       loaded: false,
//       pieChart: [],
//       lineChart: []
//     };
//   },
//   created() {
//     this.loadDashboard();
//   },
//   methods: {
//     loadDashboard() {
//       fetch("api/dashboard")
//         .then(res => res.json())
//         .then(res => {
//           console.log(res);
//           this.permohonans = res.permohonans;
//           this.progress = res.progress;
//           this.lulus = res.lulus;
//           this.lineChart = {
//             options: {
//               chart: {
//                 id: res.line_chart.id
//               },
//               xaxis: {
//                 categories: res.line_chart.labels
//               }
//             },
//             series: [
//               {
//                 name: "Jumlah",
//                 data: res.line_chart.data
//               }
//             ]
//           };
//           this.pieChart = {
//             options: {
//               chart: {
//                 id: res.pie_chart.id
//               },
//               labels: res.pie_chart.labels
//             },
//             series: res.pie_chart.data
//           };
//           this.loaded = true;
//         });
//     }
//   }
// };
</script>