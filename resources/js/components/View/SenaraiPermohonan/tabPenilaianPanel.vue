<template>
  <v-container>
    <v-row :align="alignment" :justify="justify">
      <div style="padding-left:20px">
        <p>{{ pagination.total }} permohonan</p>
      </div>

      <v-row style="padding-right:45px" class="padding-right" :align="alignment" :justify="end">
        <v-btn
          :disabled="!pagination.prev_page_url"
          v-on:click="fetchPenilaians(pagination.prev_page_url)"
          small
        >Prev</v-btn>
        <div class="divider" />
        <v-btn
          :disabled="!pagination.next_page_url"
          v-on:click="fetchPenilaians(pagination.next_page_url)"
          small
        >Next</v-btn>
      </v-row>
    </v-row>

    <v-row :justify="justify">
      <v-col>
        <v-simple-table fixed-header height="auto">
          <template v-slot:default>
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">PENILAIAN ID</th>
                <th scope="col">PERMOHONAN ID</th>
                <th scope="col">PELANTIK</th>
                <th scope="col">PENILAI</th>
                <th scope="col">TARIKH PERNILAIAN BERMULA</th>
                <th scope="col">TARIKH AKHIR/DEADLINE</th>
                <th scope="col">TEMPOH(HARI)</th>
              </tr>
            </thead>

            <tbody id="permohonans-add">
              <tr
                class="tr-shadow td-cursor"
                v-for="(p, index) in penilaians"
                v-bind:key="p.penilaian_id"
                v-on:click="show(p.penilaian_id)"
              >
                <th
                  scope="row"
                >{{(index + 1) + (pagination.per_page * (pagination.current_page - 1) )}}</th>
                <td>{{p.id}}</td>
                <td>{{p.id}}</td>
                <td>{{p.pelantik.name}}</td>
                <td>{{p.penilai.name}}</td>
                <td>{{p.created_at | date}}</td>
                <td>{{p.due_date | date}}</td>
                <td>{{p.tempoh}}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      fakulti: false,
      penilaians: [],
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
    this.fetchPenilaians();
  },
  methods: {
    fetchPenilaians(page_url) {
      let that = this;
      page_url = page_url || "api/senarai-penilaian";
      axios.get(page_url)
        .then(res => {
          this.penilaians = res.data.data;
          that.makePagination(res.data);
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
/* td {
  cursor: pointer;
} */
</style>