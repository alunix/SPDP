<template>
  <v-container>
    <div class="au-breadcrumb-left">
      <div class="overview-wrap">
        <h2 class="title-1">Senarai permohonan</h2>
        <hr />
      </div>
    </div>
    <v-divider></v-divider>

    <v-row style="height:20px">
      <!-- <div class="table-data__tool">
        <div class="table-data__tool-left"></div>
      </div>
      <div>
        <b-tabs content-class="mt-3" justified>
          <b-tab title="Baharu" active>
            <senaraiPermohonan></senaraiPermohonan>
          </b-tab>
          <b-tab title="Untuk diperakui">
          </b-tab>
          <b-tab title="Penilaian panel">
          </b-tab>
        </b-tabs>
      </div>-->

      <v-col cols="5" md="12">
        <v-card class="pa-2" outlined tile>
          <div class="container">
            <div class="table-data__tool">
              <div class="table-data__tool-left"></div>
            </div>
            <div>
              <v-tabs fixed-tabs>
                <v-tab v-for="tab in tabs" v-bind:key="tab">{{tab}}</v-tab>
              </v-tabs>
              <keep-alive>
                <component v-bind:is="currentTab" v-bind="getDataBind()"></component>
              </keep-alive>
            </div>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      currentTab: "tab-baru",
      tabs: ["Baru", "Perakuan", "Penilaian panel"]
    };
  },
  created() {},
  methods: {
    currentTabComponent(tab) {
      this.currentTab = "tab-" + tab.toString().toLowerCase();
      if (this.currentTab == "tab-baru") {
        this.dataBind = this.kemajuans;
      } else if (this.currentTab == "tab-perakuan") {
        this.dataBind = this.dokumens;
      } else {
        this.dataBind = this.laporans;
      }
      return this.currentTab;
    },
    getDataBind() {
      // if (this.currentTab == "tab-kemajuan") {
      //   return { permohonan_id_props: this.permohonan.permohonan_id };
      // } else if (this.currentTab == "tab-dokumen") {
      //   return { permohonan_id_props: this.permohonan.permohonan_id };
      // } else {
      //   return { permohonan_id_props: this.permohonan.permohonan_id };
      // }
      return;
    }
  }
};
</script>