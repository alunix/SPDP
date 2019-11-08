<template>
  <v-card class="pa-2" outlined tile>
    <div class="container">
      <div class="table-data__tool">
        <div class="table-data__tool-left"></div>
      </div>
      <div>
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
export default {
  props: ["permohonan_id_props"],
  data() {
    return {
      loaded: false,
      dataBind: [],
      currentTab: "tab-kemajuan",
      tabs: ["Kemajuan", "Laporan", "Dokumen"],
      dokumens: [],
      kemajuans: [],
      laporans: [],
      lists: [],
      pagination: {},
      permohonan_id: this.permohonan_id_props,
      alignment: "center",
      justify: "center",
      start: "start",
      end: "end"
    };
  },
  methods: {
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
      return { permohonan_id_props: this.permohonan_id };
    }
  }
};
</script>