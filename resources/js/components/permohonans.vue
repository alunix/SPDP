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

            <div class="text-center">
              <v-row>
                <v-btn
                  :disabled="!pagination.prev_page_url"
                  v-on:click="fetchPermohonans(pagination.prev_page_url)"
                  small
                >Prev</v-btn>
                <div class="divider" />
                <v-btn
                  :disabled="!pagination.next_page_url"
                  v-on:click="fetchPermohonans(pagination.next_page_url)"
                  small
                >Next</v-btn>
              </v-row>
            </div>

            <div class="my-2">
              <v-btn v-on:click="showModel()" normal>Permohonan baru</v-btn>
            </div>
          </div>
        </div>
        <hr />
      </div>
      <br />
      <p style="white-space: pre-line;">{{ pagination.total }} permohonan dihantar</p>
      <div class="table-responsive table-responsive-data2">
        <table class="table table-hover">
          <thead class="thead-light">
            <tr>
              <th scope="col">No</th>
              <!-- <th scope="col">ID</!-->
              <th scope="col">Jenis</th>
              <th scope="col">Bil hantar</th>
              <th scope="col">Nama permohonan</th>
              <th scope="col">Penghantar</th>
              <th scope="col">Dihantar</th>
              <th scope="col">Status</th>
              <th scope="col">Tarikh/Masa Status</th>
              <th scope="col"></th>
            </tr>
          </thead>

          <tbody id="permohonans-add">
            <tr class="tr-shadow" v-for="(p, index) in permohonans" v-bind:key="p.permohonan_id">
              <th v-if="!pagination.prev_page_url" scope="row">{{index + 1}}</th>
              <th v-if="pagination.prev_page_url" scope="row">{{index + 1 + pagination.per_page}}</th>
              <!-- <td>{{p.permohonan_id}}</td> -->
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
      permohonan_id: "",
      pagination: {}
    };
  },
  components: {
    PermohonansModal
  },

  created() {
    this.fetchPermohonans();
  },
  methods: {
    fetchPermohonans(page_url) {
      let that = this;
      page_url = page_url || "api/permohonan_dihantar";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.permohonans = res.data;
          that.makePagination(res);
          console.log(res);
        });
    },
    makePagination(res) {
      let pagination = {
        total: res.total,
        current_page: res.current_page,
        last_page: res.last_page,
        next_page_url: res.next_page_url,
        prev_page_url: res.prev_page_url,
        last_page_url: res.last_page_url,
        per_page: res.per_page
      };
      this.pagination = pagination;
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