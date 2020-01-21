<template>
  <v-card class="pa-2" outlined tile>
    <div class="container">
      <div class="table-data__tool">
        <div class="table-data__tool-left"></div>
      </div>
      <div>
        <modal height="auto" width="25%" :scrollable="true" name="uploadDokumenModal">
          <ModalUploadDokumen :permohonan_id_props="permohonan.id"></ModalUploadDokumen>
        </modal>

        <v-row v-show="isFakulti" align="center" justify="end">
          <v-btn
            v-on:click="showModel()"
            v-show="upload"
            style="margin-bottom:20px; margin-right:15px"
            small
          >
            Penambahbaikkan
            <v-icon right dark>mdi-plus</v-icon>
          </v-btn>
        </v-row>

        <v-tabs fixed-tabs>
          <v-tab v-for="tab in tabs" v-bind:key="tab" @click="currentTabComponent(tab)">{{tab}}</v-tab>
        </v-tabs>
        <keep-alive>
          <component v-bind:is="currentTab" v-bind="getDataBind()"></component>
        </keep-alive>
      </div>
    </div>
  </v-card>
</template>
<script>
import ModalUploadDokumen from "../../Modal/ModalUploadDokumen";
export default {
  props: ["permohonan_props"],
  data() {
    return {
      loaded: false,
      dataBind: [],
      currentTab: "TabLaporan",
      tabs: ["Laporan", "Dokumen", "Kemajuan"],
      dokumens: [],
      kemajuans: [],
      laporans: [],
      lists: [],
      pagination: {},
      permohonan: this.permohonan_props,
      upload: false,
      isFakulti: false
    };
  },
  components: {
    ModalUploadDokumen
  },
  created() {
    this.$store
      .dispatch("fetchUser")
      .then(res => res.json())
      .then(res => {
        if (res.role == "fakulti") {
          this.isFakulti = true;
          if (
            this.permohonan.status_id == 8 ||
            this.permohonan.status_id == 9 ||
            this.permohonan.status_id == 10 ||
            this.permohonan.status_id == 11
          ) {
            this.upload = true;
          }
        }
      })
      .catch(error => {
        console.log(error);
      });
  },
  methods: {
    currentTabComponent(tab) {
      this.currentTab = "Tab" + tab;
      return this.currentTab;
    },
    getDataBind() {
      return { permohonan_id_props: this.permohonan.id };
    },
    showModel() {
      this.$modal.show("uploadDokumenModal");
    }
  }
};
</script>