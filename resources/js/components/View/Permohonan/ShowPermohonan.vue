<template>
  <v-container>
    <v-row>
      <v-col cols="6" md="4">
        <v-card>
          <v-list two-line subheader>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>Tajuk permohonan</v-list-item-title>
                <v-list-item-subtitle>{{permohonan.doc_title}}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>Dihantar</v-list-item-title>
                <v-list-item-subtitle>{{date(permohonan.created_at)}}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>Jumlah dokumen dihantar</v-list-item-title>
                <v-list-item-subtitle>{{permohonan.dokumen_permohonans.length}}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>Jumlah laporan dikeluarkan</v-list-item-title>
                <v-list-item-subtitle>{{laporans.length}}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>ID</v-list-item-title>
                <v-list-item-subtitle>{{permohonan.permohonan_id}}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>
      <v-col cols="12" md="8">
        <v-card class="pa-2" outlined tile>
          <div class="container">
            <div class="table-data__tool">
              <div class="table-data__tool-left"></div>
            </div>
            <div>
              <!-- <b-tabs content-class="mt-3" justified>
                <b-tab title="Dokumen" active>
                  <senaraiPermohonan></senaraiPermohonan>
                </b-tab>
                <b-tab title="Laporan"></b-tab>
                <b-tab title="Kemajuan"></b-tab>
              </b-tabs>-->
              <v-tabs fixed-tabs>
                <v-tab>
                  Dokumen
                  <!-- <senaraiPermohonan></senaraiPermohonan> -->
                </v-tab>
                <v-tab>Laporan</v-tab>
                <v-tab>
                  Kemajuan
                  <!-- <senaraiPermohonan></senaraiPermohonan> -->
                </v-tab>
              </v-tabs>
            </div>
          </div>
        </v-card>
      </v-col>
    </v-row>

    <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
    <v-row>
      <v-col v-for="n in 3" :key="n" cols="6" md="4">
        <v-card class="pa-2" outlined tile>.col-6 .col-md-4</v-card>
      </v-col>
    </v-row>

    <!-- Columns are always 50% wide, on mobile and desktop -->
    <v-row>
      <v-col v-for="n in 2" :key="n" cols="6">
        <v-card class="pa-2" outlined tile>.col-6</v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import dayjs from "dayjs";
export default {
  data() {
    return {
      loading: false,
      // permohonan_id: "",
      tabs: [
        { title: "Kemajuan", component: <kemajuan></kemajuan> },
        { title: "Laporan", component: <laporan></laporan> },
        { title: "Dokumen", component: <dokumen></dokumen> }
      ],
      list: [],
      dokumens: [],
      kemajuans: [],
      permohonan: {
        dokumen_permohonans: []
      },
      laporans: [],
      pagination: {},
      alignment: "center",
      justify: "center",
      start: "start",
      end: "end"
    };
  },
  created() {
    var id = this.$route.params.id;
    this.showPermohonan(id);
  },
  methods: {
    showPermohonan(id) {
      console.log(id);
      // axios.get('/permohonan_dihantar')
      fetch("/api/permohonan/" + id)
        .then(res => res.json())
        .then(res => {
          console.log(res);
          this.permohonan = res.permohonan;
          this.dokumens = res.permohonan.dokumen_permohonans;
          this.kemajuans = res.kemajuans;
          this.laporans = res.laporans;
        });
    },
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
    }
    // makePagination(res) {
    //   let pagination = {
    //     total: res.total,
    //     current_page: res.current_page,
    //     next_page_url: res.next_page_url,
    //     prev_page_url: res.prev_page_url,
    //     per_page: res.per_page
    //   };
    //   this.pagination = pagination;
    // }
  }
};
</script>