<template>
  <div>
    <v-row :align="alignment" :justify="justify">
      <div style="padding-left:20px; padding-top:20px">
        <p>{{ pagination.total }} keputusan</p>
      </div>
      <v-row class="padding-right" style="padding-left:20px" :align="alignment" :justify="end">
        <v-btn
          :disabled="!pagination.prev_page_url"
          v-on:click="fetchDokumens(pagination.prev_page_url)"
          small
        >Prev</v-btn>
        <div class="divider" />
        <v-btn
          :disabled="!pagination.next_page_url"
          v-on:click="fetchDokumens(pagination.next_page_url)"
          small
        >Next</v-btn>
      </v-row>
    </v-row>
    <modal :adaptive="true" width="50%" height="50%" name="modal-laporan">
      <tab-laporan :dokumen_id_props="dokumen_id"></tab-laporan>
    </modal>
    <v-simple-table fixed-header height="auto">
      <template v-slot:default>
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Dokumen</th>
            <th scope="col">Saiz(kb)</th>
            <th scope="col">Komen</th>
            <th scope="col">Versi</th>
            <th scope="col">Jumlah laporan</th>
            <th scope="col">Tarikh/Masa</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="tr-shadow td-cursor"
            v-for="(d, index) in dokumens"
            v-bind:key="d.dokumen_permohonan_id"
            v-on:click="openFile(d.file_link)"
          >
            <th scope="row">{{(index + 1) + (pagination.per_page * (pagination.current_page - 1) )}}</th>
            <td>{{d.file_name}}</td>
            <td>{{d.file_size}}</td>
            <td>{{d.komen}}</td>
            <td>{{d.versi}}</td>
            <td>{{d.laporans.count}}</td>
            <td>{{d.created_at | date}}</td>
            <th>
              <v-btn
                v-on:click.stop="setDokumenIdProps(d.dokumen_permohonan_id);showLaporan()"
                color="primary"
                small
              >Laporan</v-btn>
            </th>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </div>
</template>
<script>
export default {
  props: ["permohonan_id_props"],
  data() {
    return {
      dokumens: [],
      permohonan: "",
      laporans_props: [],
      pagination: {},
      alignment: "center",
      justify: "center",
      permohonan_id: this.permohonan_id_props,
      dokumen_id: "",
      end: "end"
    };
  },
  created() {
    this.fetchDokumens();
  },

  methods: {
    fetchDokumens(page_url) {
      page_url = page_url || "/api/senarai-dokumen/" + this.permohonan_id;
      axios.get(page_url)
        .then(res => {
          this.dokumens = res.data.data;
          this.makePagination(res.data);
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
    showLaporan() {
      this.$modal.show("modal-laporan");
    },
    setDokumenIdProps(id) {
      this.dokumen_id = id;
    },
    openFile(file_link) {
      return window.open("/storage/permohonan/" + file_link);
    }
  }
};
</script>