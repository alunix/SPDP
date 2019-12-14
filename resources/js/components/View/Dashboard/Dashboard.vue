<template>
  <v-container>
    <div class="col-md-12">
      <div class="au-breadcrumb-content">
        <div class="au-breadcrumb-left">
          <div class="overview-wrap">
            <h2 class="title-1">gambaran keseluruhan</h2>
          </div>
        </div>
      </div>
    </div>

    <!-- End Top -->
    <hr />
    <DashboardDefault v-if="showDefaultDashboard"></DashboardDefault>
    <DashboardFakulti v-if="!showDefaultDashboard"></DashboardFakulti>
  </v-container>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
export default {
  components: {
    apexchart: VueApexCharts
  },
  data() {
    return {
      showDefaultDashboard: false,
      role: ""
    };
  },
  created() {
    this.$store
      .dispatch("fetchUser")
      .then(res => res.json())
      .then(res => {
        this.role = res.role;
        if (this.role != "fakulti") {
          this.showDefaultDashboard = true;
        }
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>
