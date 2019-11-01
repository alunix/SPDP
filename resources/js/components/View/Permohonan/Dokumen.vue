<template>
  <div>
    <v-row
      style="padding-right:20px; padding-top:8px;padding-bottom:8px"
      class="padding-right"
      :align="alignment"
      :justify="end"
    >
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
    <modal :adaptive="true" width="50%" height="50%" name="modal-laporan">
      <tab-laporan :laporans_props="laporans_props"></tab-laporan>
    </modal>
    <table class="table table-hover">
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
          <td>{{date(d.created_at)}}</td>
          <th>
            <v-btn
              v-on:click.stop="setLaporansProps(d.laporans);showLaporan()"
              color="primary"
              small
            >Laporan</v-btn>
          </th>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import dayjs from "dayjs";
export default {
  props: ["permohonan_id_props"],
  data() {
    return {
      dokumens: [],
      permohonan: "",
      laporans_props: [],
      pagination: {},
      alignment: "center",
      permohonan_id: this.permohonan_id_props,
      end: "end"
    };
  },
  created() {
    this.fetchDokumens();
  },

  methods: {
    fetchDokumens(page_url) {
      // let that = this;
      page_url = page_url || "/api/senarai-dokumen/" + this.permohonan_id;
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          console.log(res);
          this.dokumens = res.data;
          this.makePagination(res);
        });
    },
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
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
    setLaporansProps(laporans) {
      this.laporans_props = laporans;
    },
    openFile(file_link) {
      return window.open("/storage/cadangan/" + file_link);
    }
  }
};
</script>