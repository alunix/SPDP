<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card" style="width:65rem;">
          <div class="card-header">Sejarah versi dokumen</div>

          <div class="card-body">
            <div class="container">
              <h5>Dokumen yang telah dihantar</h5>

              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Dokumen</th>
                    <th scope="col">Saiz</th>
                    <th scope="col">Komen</th>
                    <th scope="col">Versi</th>
                    <th scope="col">Jumlah laporan</th>
                    <th scope="col">Tarikh/Masa Penghantaran</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <!-- <th scope="row">{{dk->versi}}</th> -->

                    <!-- <td><a href ="<?php echo asset("storage/cadangan_permohonan_baharu/$dk->file_link")?>">{{ basename($dk->file_name) }}</td> </a>
<td> {{$dk->file_size}} KB</td>
<td> {{$dk->komen}}</td> 
<td> {{$dk->versi}}</td>     
<td> {{$dk->laporans->count()}}</td>
                    <td> {{$dk->created_at->format('d/m/Y h:i a')}}</td>-->

                    <!-- <td><a href="{{ route('senaraiLaporan.show',$dk->dokumen_permohonan_id) }}" class="btn btn-primary">Senarai laporan</a></td> -->
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      permohonans: [],
      permohonans: {
        permohonan_id: "",
        jenis: "",
        bil_hantar: "",
        doc_title: "",
        nama: "",
        created_at: "",
        status_permohonan_id: "",
        updated_at: ""
      }
    };
  },
  components: {
    PermohonansModal
  },

  created() {
    this.fetchPermohonans();
  },

  methods: {
    fetchPermohonans() {
      fetch("api/permohonan_dihantar")
        .then(res => res.json())
        .then(res => {
          this.permohonans = res;
        });
    },
    parentPermohonans() {
      console.log("Testing parent");
    },
    showModel() {
      this.$modal.show("permohonan_baharu");
    },
    showKemajuanModel() {
      this.$modal.show("kemajuan_permohonan");
    },
    showDokumenModel() {
      this.$modal.show("dokumen_permohonan");
    }
  }
};
</script>