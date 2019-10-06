<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="au-breadcrumb-content">
          <div class="au-breadcrumb-left">
            <div class="overview-wrap">
              <h2 class="title-1">Senarai permohonan dihantar</h2>
            </div>
          </div>
          <modal height="auto" :scrollable="true" name="permohonan_baharu">
            <permohonanModal @event="fetchPermohonans"></permohonanModal>
          </modal>
          <a v-on:click="showModel()" class="btn btn-success mb-2" id="create-permohonan">
            <i class="zmdi zmdi-plus"></i>
            Permohonan Baharu
          </a>
        </div>
      </div>
      <hr />
    </div>
    <br />
    <div class="table-responsive table-responsive-data2">
      <table class="table table-data2">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">ID</th>
            <th scope="col">Jenis</th>
            <th scope="col">Bilangan penghantaran</th>
            <th scope="col">Nama program/semakan</th>
            <th scope="col">Penghantar</th>
            <th scope="col">Tarikh/Masa Penghantaran</th>
            <th scope="col">Status</th>
            <th scope="col">Tarikh/Masa Status</th>
          </tr>
        </thead>

        <tbody id="permohonans-add">
          <tr
            class="tr-shadow"
            v-for="permohonan in permohonans"
            v-bind:key="permohonan.permohonan_id"
          >
            <!-- <th scope="row">{{permohonan.permohonan_id}}</th>
            <td>{{permohonan.permohonan_id}}</td>
            <td>{{permohonan.jenis}}</td>
            <td>{{permohonan.bil_hantar}}</td>
            <td>{{permohonan.jenis}}</td>
            <td>{{permohonan.nama}}</td>
            <td>{{permohonan.created_at}}</td>
            <td>{{permohonan.status}}</td>
            <td>{{permohonan.updated_at}}</td>-->

            <th scope="row">{{permohonan.permohonan_id}}</th>
            <td>{{permohonan.permohonan_id}}</td>
            <!-- <td>{{permohonan.jenis_permohonan.jenis_permohonan_huraian}}</td> -->
            <td>{{permohonan.version_counts()}}</td>
            <td>{{permohonan.jenis}}</td>
            <td>{{permohonan.user.name}}</td>
            <td>{{permohonan.created_at}}</td>
            <td>{{permohonan.status_permohonan.status_permohonan_huraian}}</td>
            <td>{{permohonan.updated_at}}</td>

            <td>
              <div class="table-data-feature">
                <button
                  v-on:click="showKemajuanModel();setPermohonanId(permohonan.permohonan_id)"
                  class="item"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Kemajuan Permohonan"
                >
                  <i class="fas fa-spinner"></i>
                </button>
                <modal height="auto" :scrollable="true" name="kemajuan_permohonan">
                  <kemajuanModal :permohonan_id="permohonan_id"></kemajuanModal>
                </modal>
                <button
                  v-on:click="showDokumenModel();setPermohonanId(permohonan.permohonan_id)"
                  class="item"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Dokumen dihantar"
                >
                  <i class="fas fa-file-upload"></i>
                </button>
                <modal height="auto" :scrollable="true" name="dokumen_permohonan">
                  <dokumenModal :permohonan_id="permohonan_id"></dokumenModal>
                </modal>
              </div>
            </td>
          </tr>

          <tr class="spacer"></tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import PermohonansModal from "./PermohonanModal";
export default {
  data() {
    return {
      permohonans: [],
      permohonan_id: "",
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
    setPermohonanId(id) {
      this.permohonan_id = id;
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