<template>
  <div>
    <h4>Kemajuan Permohonan</h4>
    <!-- @if(($permohonan->status_permohonan_id == 8 or $permohonan->status_permohonan_id == 9 or $permohonan->status_permohonan_id == 10 or $permohonan->status_permohonan_id == 11  ) and (Auth::user()->role == "fakulti"))
            <a class="btn icon-btn btn-info" style="font-size:14px" href="{{ route('dokumenPermohonan.penambahbaikkan.show',$permohonan->permohonan_id) }}">
            Muat naik penambahbaikkan
    </a>-->
    <hr />
    <v-timeline>
      <v-timeline-item
        v-for="kemajuan in kemajuans"
        :right="true"
        :fill-dot="true"
        :small="true"
        color="red lighten-2"
        v-bind:key="kemajuan.id"
        large
      >
        <template v-slot:icon>
          <span>{{kemajuan.created_at}}</span>
        </template>
        <v-card class="elevation-2">
          <v-card-title class="headline">{{kemajuan.status_permohonan.status_permohonan_huraian}}</v-card-title>
          <v-card-text></v-card-text>
        </v-card>
      </v-timeline-item>
    </v-timeline>

    <!-- <div class="row justify-content-center">
      <div class="container">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Status Permohonan</th>
              <th scope="col">Tarikh/Masa Status</th>
            </tr>
          </thead>
          <tbody>
            <tr class="tr-shadow" v-for="kemajuan in kemajuans" v-bind:key="kemajuan.id">
              <th scope="row">{{kemajuan.id}}</th>
              <td>{{kemajuan.status_permohonan.status_permohonan_huraian}}</td>
              <td>{{kemajuan.created_at}}</td>
            </tr>
          </tbody>
        </table>
        <h5>Semua laporan yang telah dikeluarkan</h5>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Laporan</th>
              <th scope="col">Dihantar</th>
              <th scope="col">Pihak</th>
              <th scope="col">Komen</th>
              <th scope="col">Versi</th>
              <th scope="col">Tarikh/Masa Laporan</th>
            </tr>
          </thead>
          <tbody>
            <tr class="tr-shadow" v-for="laporan in laporans" v-bind:key="laporan.laporan_id">
              <th scope="row">{{laporan.versi}}</th>
              <td>{{laporan.tajuk_fail_link}}</td>
              <td>{{laporan.id_penghantar.name}}</td>
              <td>{{laporan.id_penghantar.role}}</td>
              <td>{{laporan.komen}}</td>
              <td>{{laporan.versi_laporan}}</td>
              <td>{{laporan.created_at}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>-->
  </div>
</template>
<script>
export default {
  props: ["permohonan_id"],
  data() {
    return {
      kemajuans: [],
      laporans: []
    };
  },
  created() {
    this.fetchKemajuan();
  },
  methods: {
    fetchKemajuan() {
      fetch("api/kemajuan-permohonan/" + this.permohonan_id)
        .then(res => res.json())
        .then(res => {
          this.laporans = res.laporans;
          this.kemajuans = res.kemajuans;
        });
    }
  }
};
</script>