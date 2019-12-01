<template>
  <v-container>
    <v-row :align="alignment" :justify="justify">
      <div style="padding-left:20px">
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
        <v-simple-table fixed-header height="auto">
          <template v-slot:default>
            <thead class="thead-light">
              <tr>
                <th scope="col">NO</th>
                <th scope="col">JENIS</th>
                <th scope="col">ID</th>
                <th scope="col">TAJUK</th>
                <th scope="col">PENGHANTAR</th>
                <th scope="col">FAKULTI</th>
                <th scope="col">TARIKH HANTAR</th>
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
                <td>{{p.user.name}}</td>
                <td>{{p.user.fakulti.kod}}</td>
                <td>{{date(p.created_at)}}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import dayjs from "dayjs";
export default {
  data() {
    return {
      fakulti: false,
      permohonans: [],
      permohonan_id: "",
      pagination: {},
      alignment: "center",
      justify: "center",
      start: "start",
      end: "end",
      api: ""
    };
  },
  created() {
    this.fetchPermohonans();
  },
  methods: {
    fetchPermohonans(page_url) {
      let that = this;
      page_url = page_url || "api/senarai-perakuan";
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
<style>
</style>