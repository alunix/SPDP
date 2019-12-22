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
          <v-switch
            v-model="switchLaporan"
            @change="changeLaporan(switchLaporan)"
            label="Muat naik laporan"
            color="primary"
            :value="true"
            hide-details
          ></v-switch>
        </v-col>
        <LantikPenilai
          v-if="showLantikPenilai"
          :permohonan_props="permohonan"
          @event="hideLantikPenilai"
        ></LantikPenilai>
        <LaporanUpload
          v-if="showLaporanUpload"
          :permohonan_id_props="id"
          @event="hideLaporanUpload"
        ></LaporanUpload>
        <PermohonanTab :permohonan_props="permohonan"></PermohonanTab>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
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
      switchLaporan: false,
      canSwitchTab: false
    };
  },
  created() {
    this.$store
      .dispatch("fetchUser")
      .then(res => res.json())
      .then(res => {
        this.role = res.role;
        if (this.role != "fakulti") {
          this.showDefaultDashboard = true;
        }
      })
      .catch(error => {
        console.log(error);
      });
    this.showPermohonan();
  },
  methods: {
    changeLaporan(value) {
      if (value == true) {
        this.showLantikPenilai = false;
        this.showLaporanUpload = true;
      } else {
        this.showLantikPenilai = true;
        this.showLaporanUpload = false;
      }
    },
    showPermohonan() {
      fetch("/api/permohonan/" + this.id)
        .then(res => res.json())
        .then(res => {
          this.permohonan = res.permohonan;
          // pjk can switch between lantik and upload if jenis permohonan match
          if (
            (this.permohonan.jenis_id == 2 ||
              this.permohonan.jenis_id == 5 ||
              this.permohonan.jenis_id == 3) &&
            this.role == "pjk"
          ) {
            this.canSwitchTab = true;
          }
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
          if (this.role == "pjk") {
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
          } else if (this.role == "penilai") {
            if (
              this.permohonan.status_id == 2 ||
              this.permohonan.status_id == 12
            ) {
              this.showLaporanUpload = true;
            }
          } else if (this.role == "jppa") {
            if (
              this.permohonan.status_id == 2 ||
              (this.permohonan.status_id == 1 &&
                this.permohonan.jenis_id == 8) ||
              this.permohonan.status_id == 14
            ) {
              this.showLaporanUpload = true;
            }
          } else if (this.role == "senat" && this.permohonan.status_id == 11) {
            if (
              this.permohonan.status_id == 11 ||
              this.permohonan.status_id == 15
            ) {
              this.showLaporanUpload = true;
            }
          }
          this.loaded = true;
        })
        .catch(error => {
          console.log(error);
        });
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
