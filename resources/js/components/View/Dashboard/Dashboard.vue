<template>
  <v-container>
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
    this.getRole();
  },
  methods: {
    getRole() {
      fetch("api/role")
        .then(res => res.json())
        .then(res => {
          this.role = res;
          if (this.role != "fakulti") {
            this.showDefaultDashboard = true;
          }
        });
    }
  }
};
</script>