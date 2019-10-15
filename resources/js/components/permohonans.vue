<template>
  <div>
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
            <modal :adaptive="true" width="50%" height="50%" name="dokumen_permohonan">
              <dokumenModal :permohonan_id="permohonan_id"></dokumenModal>
            </modal>
            <modal :adaptive="true" width="60%" height="50%" name="kemajuan_permohonan">
              <kemajuanModal :permohonan_id="permohonan_id"></kemajuanModal>
            </modal>
            <a
              v-on:click="showModel()"
              type="button"
              class="btn btn-success"
              style="color:white;"
              id="create-permohonan"
            >
              <i class="zmdi zmdi-plus"></i>
              Permohonan Baharu
            </a>
          </div>
        </div>
        <hr />
      </div>
      <br />
      <div class="table-responsive table-responsive-data2">
        <table class="table table-hover">
          <thead class="thead-light">
            <tr>
              <th scope="col">No</th>
              <th scope="col">ID</th>
              <th scope="col">Jenis</th>
              <th scope="col">Bilangan penghantaran</th>
              <th scope="col">Nama program/semakan</th>
              <th scope="col">Penghantar</th>
              <th scope="col">Dihantar</th>
              <th scope="col">Status</th>
              <th scope="col">Tarikh/Masa Status</th>
              <th scope="col"></th>
            </tr>
          </thead>

          <tbody id="permohonans-add">
            <tr class="tr-shadow" v-for="p in permohonans" v-bind:key="p.permohonan_id">
              <th scope="row">{{p.permohonan_id}}</th>
              <td>{{p.permohonan_id}}</td>
              <td>{{p.jenis_permohonan.jenis_permohonan_huraian}}</td>
              <td>{{p.dokumen_permohonans.length}}</td>
              <td>{{p.doc_title}}</td>
              <td>{{p.user.name}}</td>
              <td>{{p.created_at}}</td>
              <td>{{p.status_permohonan.status_permohonan_huraian}}</td>
              <td>{{p.updated_at}}</td>

              <td>
                <div class="table-data-feature">
                  <button
                    v-on:click="showKemajuanModel();setPermohonanId(p.permohonan_id)"
                    class="item"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Kemajuan Permohonan"
                  >
                    <i class="fas fa-spinner"></i>
                  </button>

                  <button
                    v-on:click="showDokumenModel();setPermohonanId(p.permohonan_id)"
                    class="item"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Dokumen dihantar"
                  >
                    <i class="fas fa-file-upload"></i>
                  </button>
                </div>
              </td>
            </tr>

            <tr class="spacer"></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import PermohonansModal from "./PermohonanModal";
export default {
  data() {
    return {
      permohonans: [],
      permohonan_id: ""
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