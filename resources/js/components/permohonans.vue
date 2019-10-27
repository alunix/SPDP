<template>
  <v-container>
    <v-card>
      <v-row class="left-padding" :align="alignment" :justify="start">
        <v-col class="divider" cols="3" md="6">
          <h3>Senarai permohonan dihantar</h3>
          <hr />
        </v-col>

        <v-row style="padding-right:45px" class="padding-right" :align="alignment" :justify="end">
          <v-btn v-on:click="showModel()" color="primary" small>Permohonan baru</v-btn>
          <modal height="auto" width="25%" :scrollable="true" name="permohonan_baharu">
            <permohonanModal @event="fetchPermohonans"></permohonanModal>
          </modal>
          <modal :adaptive="true" width="50%" height="50%" name="dokumen_permohonan">
            <dokumenModal :permohonan_id="permohonan_id"></dokumenModal>
          </modal>
          <modal :adaptive="true" width="60%" height="50%" name="kemajuan_permohonan">
            <kemajuanModal :permohonan_id="permohonan_id"></kemajuanModal>
          </modal>
        </v-row>
      </v-row>

      <v-row :align="alignment" :justify="justify">
        <div style="padding-left:35px">
          <p>{{ pagination.total }} permohonan</p>
        </div>

        <v-row style="padding-right:45px" class="padding-right" :align="alignment" :justify="end">
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
      </v-row>

      <v-row :align="alignment" :justify="justify">
        <v-col>
          <table class="table table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">NO</th>
                <th scope="col">JENIS</th>
                <th scope="col">BIL HANTAR</th>
                <th scope="col">TAJUK</th>
                <th scope="col">TARIKH HANTAR</th>
                <th scope="col">STATUS</th>
                <th scope="col">TARIKH STATUS</th>
                <th scope="col"></th>
              </tr>
            </thead>

            <tbody id="permohonans-add">
              <tr
                class="tr-shadow"
                v-for="(p, index) in permohonans"
                v-bind:key="p.permohonan_id"
                v-on:click="show(p.permohonan_id)"
              >
                <th
                  scope="row"
                >{{(index + 1) + (pagination.per_page * (pagination.current_page - 1) )}}</th>
                <td>{{p.jenis_permohonan.jenis_permohonan_huraian}}</td>
                <td>{{p.dokumen_permohonans.length}}</td>
                <td>{{p.doc_title}}</td>
                <td>{{date(p.created_at)}}</td>
                <td>{{p.status_permohonan.status_permohonan_huraian}}</td>
                <td>{{date(p.updated_at)}}</td>
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
            </tbody>
          </table>
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<script>
import PermohonansModal from "./PermohonanModal";
import dayjs from "dayjs";
export default {
  data() {
    return {
      permohonans: [],
      permohonan_id: "",
      pagination: {},
      alignment: "center",
      justify: "center",
      start: "start",
      end: "end"
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
        });
    },
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
    },
    show(id) {
      let that = this;
      // that.$router.push({ name: "permohonan", params: { id: id } });
      this.$router
        .replace({ name: "permohonan", params: { id: id } })
        .catch(err => {
          console.log("all good");
        });
    },
    makePagination(res) {
      let pagination = {
        total: res.total,
        current_page: res.current_page,
        next_page_url: res.next_page_url,
        prev_page_url: res.prev_page_url,
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