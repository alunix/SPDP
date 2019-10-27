<template>
  <v-container>
    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <h2>Permohonan</h2>
    <v-card>
      <v-list two-line subheader>
        <v-subheader>General</v-subheader>

        <v-list-item>
          <v-list-item-content>
            <v-list-item-title>Tajuk dokumen</v-list-item-title>
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
            <v-list-item-title>Show your status</v-list-item-title>
            <v-list-item-subtitle>Your status is visible to everyone</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-content>
            <v-list-item-title>Show your status</v-list-item-title>
            <v-list-item-subtitle>Your status is visible to everyone</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-card>
  </v-container>
</template>

<script>
import dayjs from "dayjs";
export default {
  data() {
    return {
      loading: false,
      // permohonan_id: "",
      dokumens: [],
      kemajuans: [],
      permohonan: [],
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