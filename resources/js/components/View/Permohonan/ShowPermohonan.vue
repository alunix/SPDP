<template>
  <v-container>
    <v-row>
      <v-col cols="6" md="4">
        <v-card class="py-4" v-if="loaded">
          <v-card-text v-for="list in lists" :key="list.id">
            <v-layout row class="my-n5 px-3 pt-1">
              <v-flex xs6>
                <p>{{list.title}}</p>
              </v-flex>
              <v-flex xs6>
                <div class="text--primary">{{list.subtitle}}</div>
              </v-flex>
            </v-layout>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col v-if="loaded" cols="12" md="8">
        <LantikPenilai v-if="!isFakulti && !showLaporan" :permohonan_props="permohonan"></LantikPenilai>
        <LaporanUpload v-if="!isFakulti && showLaporan" :permohonan_id_props="id"></LaporanUpload>
        <PermohonanTab v-if="permohonan.status_permohonan_id != 1" :permohonan_id_props="id"></PermohonanTab>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import dayjs from "dayjs";
export default {
  data() {
    return {
      loaded: false,
      permohonan: {},
      dokumen: {},
      id: "",
      role: "",
      isFakulti: false,
      showLaporan: false
    };
  },
  created() {
    this.id = this.$route.params.id;
    this.getRole();
    this.showComponent();
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
    showComponent() {
      if (!isFakulti && this.role != "pjk") {
        this.showLaporan = true;
      }
      if (
        this.role == "pjk" &&
        this.permohonan.jenis_id == 1 &&
        this.permohonan.status_permohonan_id == 1
      ) {
        showLaporan = false;
      } else showLaporan = true;
    },
    showPermohonan(id) {
      fetch("/api/permohonan/" + id)
        .then(res => res.json())
        .then(res => {
          this.permohonan = res.permohonan;
          this.dokumen = res.dokumen;
          this.lists = [
            {
              title: "Tajuk permohonan",
              subtitle: this.permohonan.doc_title,
              id: 1
            },
            {
              title: "Jenis permohonan",
              subtitle: this.permohonan.jenis_permohonan
                .huraian,
              id: 2
            },
            {
              title: "Dihantar",
              subtitle: this.date(this.permohonan.created_at),
              id: 3
            },
            {
              title: "Jumlah dokumen dihantar",
              subtitle: this.permohonan.dokumen_permohonans_count,
              id: 4
            },
            {
              title: "Jumlah laporan dikeluarkan",
              subtitle: this.permohonan.laporans_count,
              id: 5
            },
            { title: "Id", subtitle: this.permohonan.id, id: 6 },
            {
              title: "Dokumen permohonan",
              subtitle: this.dokumen.file_link,
              id: 7
            }
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
      return { permohonan_id_props: this.permohonan.id };
    }
  }
};
</script>
