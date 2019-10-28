<template>
  <div>
    <!-- @if(($permohonan->status_permohonan_id == 8 or $permohonan->status_permohonan_id == 9 or $permohonan->status_permohonan_id == 10 or $permohonan->status_permohonan_id == 11  ) and (Auth::user()->role == "fakulti"))
            <a class="btn icon-btn btn-info" style="font-size:14px" href="{{ route('dokumenPermohonan.penambahbaikkan.show',$permohonan->permohonan_id) }}">
            Muat naik penambahbaikkan
    </a>-->
    <div class="row justify-content-center">
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
            <tr class="tr-shadow" v-for="k in kemajuans" v-bind:key="k.id">
              <th scope="row">{{k.id}}</th>
              <td>{{k.status_permohonan.status_permohonan_huraian}}</td>
              <td>{{k.created_at}}</td>
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
            <tr class="tr-shadow" v-for="l in laporans" v-bind:key="l.laporan_id">
              <th scope="row">{{l.versi}}</th>
              <td>{{l.tajuk_fail_link}}</td>
              <td>{{l.id_penghantar.name}}</td>
              <td>{{l.id_penghantar.role}}</td>
              <td>{{l.komen}}</td>
              <td>{{l.versi_laporan}}</td>
              <td>{{l.created_at}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["permohonan_id"],
  data() {
    return {
      kemajuans: [
        {
          status_permohonan: {
            status_permohonan_huraian: ""
          }
        }
      ],
      laporans: []
    };
  },
  created() {
    this.fetchKemajuan();
  },
  methods: {
    fetchKemajuan() {
      fetch("/api/kemajuan-permohonan/" + this.permohonan_id)
        .then(res => res.json())
        .then(res => {
          this.laporans = res.laporans;
          this.kemajuans = res.kemajuans;
        });
    }
  }
};
</script>