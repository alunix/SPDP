<template>
  <v-container>
    <v-row>
      <v-col cols="6" md="4">
        <v-card v-if="loaded">
          <v-list v-for="list in lists" :key="list.id" two-line subheader>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>{{list.title}}</v-list-item-title>
                <v-list-item-subtitle>{{list.subtitle}}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>
      <v-col cols="12" md="8">
        <v-card v-if="loaded" class="pa-2" outlined tile>
          <div class="container">
            <div class="table-data__tool">
              <div class="table-data__tool-left"></div>
            </div>
            <div>
              <v-tabs fixed-tabs>
                <v-tab
                  v-for="tab in tabs"
                  v-bind:key="tab"
                  @click="currentTabComponent(tab)"
                >{{tab}}</v-tab>
              </v-tabs>
              <keep-alive>
                <component v-bind:is="currentTab" v-bind="getDataBind()"></component>
              </keep-alive>
            </div>
          </div>
        </v-card>
      </v-col>
    </v-row>

    <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
    <!-- <v-row>
      <v-col v-for="n in 3" :key="n" cols="6" md="4">
        <v-card class="pa-2" outlined tile>.col-6 .col-md-4</v-card>
      </v-col>
    </v-row> -->

    <!-- Columns are always 50% wide, on mobile and desktop -->
    <!-- <v-row>
      <v-col v-for="n in 2" :key="n" cols="6">
        <v-card class="pa-2" outlined tile>.col-6</v-card>
      </v-col>
    </v-row> -->
  </v-container>
</template>

<script>
import dayjs from "dayjs";
export default {
  data() {
    return {
      loaded: false,
      dataBind: [],
      // permohonan_id: "",
      currentTab: "tab-kemajuan",
      tabs: ["Kemajuan", "Laporan", "Dokumen"],
      dokumens: [],
      kemajuans: [],
      permohonan: {
        dokumen_permohonans: []
      },
      laporans: [],
      lists: [],
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
      fetch("/api/permohonan/" + id)
        .then(res => res.json())
        .then(res => {
          console.log(res);
          this.permohonan = res.permohonan;
          this.dokumens = res.dokumens.data;
          this.kemajuans = res.kemajuans.data;
          this.laporans = res.laporans.data;
          this.lists = [
            {
              title: "Tajuk permohonan",
              subtitle: this.permohonan.doc_title,
              id: 1
            },
            {
              title: "Dihantar",
              subtitle: this.date(this.permohonan.created_at),
              id: 2
            },
            {
              title: "Jumlah dokumen dihantar",
              subtitle: this.permohonan.dokumen_permohonans.count,
              id: 3
            },
            {
              title: "Jumlah laporan dikeluarkan",
              subtitle: this.laporans.total,
              id: 4
            },
            { title: "Id", subtitle: this.permohonan.permohonan_id, id: 5 }
          ];
          this.loaded = true;
        });
    },
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
    },
    currentTabComponent(tab) {
      this.currentTab = "tab-" + tab.toString().toLowerCase();
      if (this.currentTab == "tab-kemajuan") {
        this.dataBind = this.kemajuans;
      } else if (this.currentTab == "tab-dokumen") {
        this.dataBind = this.dokumens;
      } else {
        this.dataBind = this.laporans;
      }
      return this.currentTab;
    },
    getDataBind() {
      if (this.currentTab == "tab-kemajuan") {
        return { kemajuans_props: this.kemajuans };
      } else if (this.currentTab == "tab-dokumen") {
        return { dokumens_props: this.dokumens };
      } else {
        return { laporans_props: this.laporans };
      }
      // console.log(this.dataBind);
      // return this.dataBind;

      // if (this.currentTab == "tab-kemajuan") {
      //   return this.kemajuans;
      // } else if (this.currentTab == "tab-dokumen") {
      //   return this.dokumens;
      // } else {
      //   return this.laporans;
      // }
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