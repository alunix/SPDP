<template>
  <v-container>
    <v-row>
      <v-snackbar
        v-if="success"
        v-model="snackbar"
        color="success"
        :multi-line="false"
        :timeout="6000"
        :top="true"
        :vertical="true"
      >
        {{snackbarMessage}}
        <v-btn dark text @click="snackbar = false">Close</v-btn>
      </v-snackbar>

      <v-col cols="6" md="4">
        <v-card class="py-4" v-if="loaded">
          <v-card-text v-for="list in lists" :key="list.id">
            <v-layout row class="my-n5 px-3 pt-1">
              <v-flex xs6>
                <p>{{list.title}}</p>
              </v-flex>
              <v-flex xs6 v-if="list.id != 7">
                <div class="text--primary">{{list.subtitle}}</div>
              </v-flex>
              <v-flex xs6 v-else>
                <v-btn small @click="openFile(list.subtitle)">
                  Muat turun
                  <v-icon right dark>mdi-download</v-icon>
                </v-btn>
              </v-flex>
            </v-layout>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col v-if="loaded" cols="12" md="8">
        <v-col v-if="canSwitchTab">
          <v-switch v-model="switchTab" label="Muat naik laporan" color="indigo" value="indigo" hide-details></v-switch>
        </v-col>
        <LantikPenilai
          v-if="showLantikPenilai"
          :permohonan_props="permohonan"
          @event="hideLantikPenilai"
        ></LantikPenilai>
        <LaporanUpload
          v-if="showLaporanUpload || switchTab"
          :permohonan_id_props="id"
          @event="hideLaporanUpload"
        ></LaporanUpload>
        <PermohonanTab :permohonan_props="permohonan"></PermohonanTab>
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
      showLaporanUpload: false,
      showLantikPenilai: false,
      loaded: false,
      id: this.$route.params.id,
      success: false,
      snackbar: {},
      snackbarMessage: "",
      switchTab: false,
      canSwitchTab: false
    };
  },
  created() {
    this.getRole();
  },
  methods: {
    getRole() {
      fetch("/api/role")
        .then(res => res.json())
        .then(res => {
          this.showPermohonan(res);
        });
    },
    showPermohonan(role) {
      fetch("/api/permohonan/" + this.id)
        .then(res => res.json())
        .then(res => {
          this.permohonan = res.permohonan;
          if (this.permohonan.jenis_id == 2 || this.permohonan.jenis_id == 5 || this.permohonan.jenis_id == 3) {
            this.canSwitchTab = true;
          }
          console.log(this.permohonan);
          this.dokumen = res.dokumen;
          this.lists = [
            {
              title: "Tajuk permohonan",
              subtitle: this.permohonan.doc_title,
              id: 1
            },
            {
              title: "Jenis permohonan",
              subtitle: this.permohonan.jenis_permohonan.huraian,
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
          if (role == "pjk") {
            if (
              (this.permohonan.jenis_id == 1 &&
                this.permohonan.status_id == 1) ||
              (this.permohonan.jenis_id == 2 &&
                this.permohonan.status_id == 1) ||
              (this.permohonan.jenis_id == 3 &&
                this.permohonan.status_id == 1) ||
              (this.permohonan.jenis_id == 5 &&
                this.permohonan.status_id == 1) ||
              (this.permohonan.jenis_id == 6 && this.permohonan.status_id == 1)
            ) {
              this.showLantikPenilai = true;
            } else if (
              (this.permohonan.jenis_id == 4 &&
                this.permohonan.status_id == 1) ||
              this.permohonan.status_id == 13
            ) {
              this.showLaporanUpload = true;
            }
          } else if (role == "penilai") {
            if (
              this.permohonan.status_id == 2 ||
              this.permohonan.status_id == 12
            ) {
              this.showLaporanUpload = true;
            }
          } else if (role == "jppa") {
            if (
              this.permohonan.status_id == 2 ||
              (this.permohonan.status_id == 1 &&
                this.permohonan.jenis_id == 8) ||
              this.permohonan.status_id == 14
            ) {
              this.showLaporanUpload = true;
            }
          } else if (role == "senat" && this.permohonan.status_id == 11) {
            if (
              this.permohonan.status_id == 11 ||
              this.permohonan.status_id == 15
            ) {
              this.showLaporanUpload = true;
            }
          }
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
    },
    hideLantikPenilai() {
      this.showLantikPenilai = false;
      this.snackbarMessage =
        "Panel penilai telah dilantik dan permohonan telah diemel kepada penilai";
      this.success = true;
    },
    hideLaporanUpload() {
      this.showLaporanUpload = false;
      this.snackbarMessage = "Laporan telah dimuat naik";
      this.success = true;
    },
    openFile(file_link) {
      return window.open("/storage/permohonan/" + file_link);
    }
  }
};
</script>
