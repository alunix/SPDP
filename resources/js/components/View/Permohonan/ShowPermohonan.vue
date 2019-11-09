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
      <v-col v-if="loaded" cols="12" md="8">
        <laporanUpload v-if="isFakulti" :permohonan_id_props="id"></laporanUpload>
        <tabPermohonan :permohonan_id_props="id"></tabPermohonan>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import dayjs from "dayjs";
import tabPermohonan from "./tabPermohonan";
import laporanUpload from "../Approval/LaporanUpload";
export default {
  components: {
    tabPermohonan
  },
  data() {
    return {
      loaded: false,
      permohonan: {},
      id: "",
      role: "",
      isFakulti: false
    };
  },
  created() {
    this.id = this.$route.params.id;
    this.getRole();
    this.showPermohonan(this.id);
  },
  methods: {
    getRole() {
      fetch("/api/role")
        .then(res => res.json())
        .then(res => {
          this.role = res;
          if (this.role == "fakulti") {
            this.isFakulti = true;
          }
        });
    },
    showPermohonan(id) {
      fetch("/api/permohonan/" + id)
        .then(res => res.json())
        .then(res => {
          this.permohonan = res.permohonan;
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
              subtitle: this.permohonan.dokumen_permohonans_count,
              id: 3
            },
            {
              title: "Jumlah laporan dikeluarkan",
              subtitle: this.permohonan.laporans_count,
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
      return this.currentTab;
    },
    getDataBind() {
      return { permohonan_id_props: this.permohonan.permohonan_id };
    }
  }
};
</script>