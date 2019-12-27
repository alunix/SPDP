<template>
  <v-container fluid>
    <v-card>
      <v-row class="left-padding" :align="center" :justify="start">
        <v-col class="divider" cols="3" md="6">
          <h3>Senarai permohonan dihantar</h3>
          <hr />
        </v-col>
        <v-row style="padding-right:45px" class="padding-right" :align="center" :justify="end">
          <v-btn v-on:click="showModel()" color="primary" small>
            <v-icon left dark>mdi-plus</v-icon>Permohonan
          </v-btn>
          <modal height="auto" width="25%" :scrollable="true" name="permohonan_baharu">
            <PermohonanModal @event="fetchPermohonans"></PermohonanModal>
          </modal>
        </v-row>
      </v-row>

      <v-row :align="center" :justify="center">
        <div style="padding-left:35px">
          <p>{{ pagination.total }} permohonan</p>
        </div>

        <v-row style="padding-right:45px" class="padding-right" :align="center" :justify="end">
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

      <v-row v-if="!loaded" :align="center" :justify="center">
        <v-progress-circular :size="25" :width="2" color="blue-grey" indeterminate></v-progress-circular>
      </v-row>

      <v-row v-else :align="center" :justify="center">
        <v-col>
          <v-simple-table fixed-header height="auto">
            <template v-slot:default>
              <thead class="thead-light">
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">JENIS</th>
                  <th scope="col">ID</th>
                  <th scope="col">TAJUK</th>
                  <th scope="col">TARIKH HANTAR</th>
                  <th scope="col">STATUS</th>
                  <th scope="col">TARIKH STATUS</th>
                </tr>
              </thead>

              <tbody id="permohonans-add">
                <tr
                  class="tr-shadow td-cursor"
                  v-for="(p, index) in permohonans"
                  v-bind:key="p.id"
                  v-on:click="show(p.id)"
                >
                  <th
                    scope="row"
                  >{{(index + 1) + (pagination.per_page * (pagination.current_page - 1) )}}</th>
                  <td>{{p.jenis_permohonan.huraian}}</td>
                  <td>{{p.id}}</td>
                  <td>{{p.doc_title}}</td>
                  <td>{{p.created_at | date}}</td>
                  <td>{{p.status_permohonan.huraian}}</td>
                  <td>{{p.updated_at | date}}</td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<script>
import permohonanModal from "./Modal/PermohonanModal";
export default {
  data() {
    return {
      permohonans: [],
      permohonan_id: "",
      pagination: {},
      start: "start",
      end: "end",
      center: "center",
      loaded: false
    };
  },
  components: {
    permohonanModal
  },
  created() {
    this.fetchPermohonans();
  },
  methods: {
    fetchPermohonans(page_url) {
      let that = this;
      this.loaded = false;
      page_url = page_url || "api/senarai-permohonan-dihantar";
      fetch(page_url)
        // .then(res => res.json())
        .then(res => res.text())
        .then(res => {
          console.log(res);
          // this.permohonans = res.data;
          // that.makePagination(res);
          // this.loaded = true;
        });
    },
    show(id) {
      let that = this;
      this.$router
        .push({ name: "permohonan", params: { id: id } })
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
    }
  }
};
</script>
<style>
</style>