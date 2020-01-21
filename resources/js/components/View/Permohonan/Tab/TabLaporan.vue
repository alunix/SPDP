<template>
  <div>
    <v-row align="center" justify="center">
      <div style="padding-left:20px; padding-top:20px">
        <p>{{ pagination.total }} keputusan</p>
      </div>

      <v-row
        style="padding-right:25px; padding-top:8px; padding-bottom:8px"
        class="padding-right"
        align="center"
        justify="end"
      >
        <v-btn
          :disabled="!pagination.prev_page_url"
          v-on:click="fetchLaporans(pagination.prev_page_url)"
          small
        >Prev</v-btn>
        <div class="divider" />
        <v-btn
          :disabled="!pagination.next_page_url"
          v-on:click="fetchLaporans(pagination.next_page_url)"
          small
        >Next</v-btn>
      </v-row>
    </v-row>

    <v-simple-table fixed-header height="auto">
      <template v-slot:default>
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Laporan</th>
            <th scope="col">Dihantar</th>
            <th scope="col">Laporan Id</th>
            <th scope="col">Pihak</th>
            <th scope="col">Komen</th>
            <th scope="col">Versi</th>
            <th scope="col">Tarikh/Masa</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="tr-shadow td-cursor"
            v-for="(l, index) in laporans"
            v-bind:key="l.laporan_id"
            v-on:click="openFile(l.tajuk_fail_link)"
          >
            <th scope="row">{{(index + 1) + (pagination.per_page * (pagination.current_page - 1) )}}</th>
            <td>{{l.tajuk_fail_link}}</td>
            <td>{{l.id_penghantar_nama.name || " "}}</td>
            <td>{{l.laporan_id}}</td>
            <td>{{l.id_penghantar_nama.role|uppercase}}</td>
            <td>{{l.komen}}</td>
            <td>{{l.versi}}</td>
            <td>{{l.created_at}}</td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </div>
</template>
<script>
export default {
  props: ["permohonan_id_props", "dokumen_id_props"],
  data() {
    return {
      laporans: [],
      pagination: {},
      permohonan_id: this.permohonan_id_props,
      dokumen_id: this.dokumen_id_props
    };
  },
  created() {
    this.fetchLaporans();
  },
  filters: {
    uppercase: function(value) {
      if (!value) {
        return "";
      }
      return value.toString().toUpperCase();
    }
  },
  methods: {
    fetchLaporans(page_url) {
      // check whether props is permohonan id or dokumen id
      if (this.permohonan_id != undefined) {
        page_url = page_url || "/api/senarai-laporan/" + this.permohonan_id;
      } else {
        page_url =
          page_url || "/api/senarai-laporan-dokumen/" + this.dokumen_id;
      }
      axios.get(page_url)
        .then(res => {
          this.laporans = res.data.data;
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
    openFile(tajuk_fail_link) {
      return window.open("/storage/laporan/" + tajuk_fail_link);
    }
  }
};
</script>
