<template>
  <v-container>
    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <h2>Permohonan</h2>
    <v-row>
      <v-col cols="12" md="8">
        <v-card class="pa-2" outlined tile>.col-12 .col-md-8</v-card>
      </v-col>
      <v-col cols="6" md="4">
        <v-card class="pa-2" outlined tile>.col-6 .col-md-4</v-card>
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
      // loading: false,
      // permohonan_id: "",
      // dokumens: [],
      // kemajuans: [],
      // permohonan: [],
      // pagination: {},
      // alignment: "center",
      // justify: "center",
      // start: "start",
      // end: "end"
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
      fetch("api/permohonan/" + id)
        .then(res => res.json())
        .then(res => {
          this.permohonan = res.permohonan;
          console.log(this.permohonan);
          // this.dokumens = res.dokumens;
          // this.kemajuans = res.kemajuans;
          // that.makePagination(res);
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