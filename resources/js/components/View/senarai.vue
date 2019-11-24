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
      <v-col cols="5" md="12">
        <v-card outlined tile>
          <v-tabs fixed-tabs>
            <v-tab
              v-for="tab in tabs"
              @click="currentTabComponent(tab.value)"
              v-bind:key="tab.value"
            >{{tab.title}}</v-tab>
          </v-tabs>
          <keep-alive>
            <component v-bind:is="currentTab"></component>
          </keep-alive>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      tabs: [
        { title: "baru", value: "tabSenaraiBaru", id: 1 },
        { title: "perakuan", value: "tabSenaraiPerakuan", id: 2 },
        { title: "penilaian panel", value: "tabPenilaianPanel", id: 3 }
      ],
      currentTab: "tabSenaraiBaru"
    };
  },
  created() {},
  methods: {
    currentTabComponent(tab) {
      this.currentTab = tab;
      return this.currentTab;
    }
  }
};
</script>