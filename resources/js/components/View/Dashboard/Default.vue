<template>
  <div v-if="loaded" class="row m-t-25">
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

    <div class="col-lg-6">
      <div class="au-card recent-report">
        <div class="au-card-inner">
          <h3 class="title-2">Laporan dikeluarkan</h3>
          <v-simple-table fixed-header height="auto">
            <template v-slot:default>
              <thead class="thead-light">
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">LAPORAN</th>
                  <th scope="col">PIHAK</th>
                  <th scope="col">TARIKH DIKELUARKAN</th>
                </tr>
              </thead>

              <tbody>
                <tr
                  class="tr-shadow td-cursor"
                  v-for="(l, index) in laporans"
                  v-bind:key="l.id"
                  v-on:click="show(l.id)"
                >
                  <th scope="row">{{index + 1}}</th>
                  <td>{{l.tajuk_fail}}</td>
                  <td>{{(l.id_penghantar_nama.role).toUpperCase()}}</td>
                  <td>{{l.created_at | date}}</td>
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
                <td>{{p.created_at | date}}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </div>
    </div>
  </div>
</template>

<script>
("");
export default {
  data() {
    return {
      permohonans: [],
      diperakui: "",
      lulus: "",
      progress: "",
      loaded: false,
      role: "",
      laporans: []
    };
  },
  created() {
    this.loadDashboard();
  },
  methods: {
    loadDashboard() {
      axios.get("api/dashboard")
        .then(res => {
          this.permohonans = res.data.permohonans;
          this.progress = res.data.progress;
          this.lulus = res.data.lulus;
          this.role = res.data.role;
          this.diperakui = res.data.diperakui;
          this.laporans = res.data.laporans;
          this.loaded = true;
        });
    }
  }
};
</script>