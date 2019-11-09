<template>
  <v-card min-height="360px" class="pa-2" outlined tile>
    <h3>Muat naik laporan</h3>
    <v-divider></v-divider>
    <!-- <v-row align="center" justify="center">
      <div style="padding-left:20px; padding-top:20px"></div>
      <v-row
        style="padding-right:40px; padding-top:8px; padding-bottom:8px"
        class="padding-right"
        align="center"
        justify="end"
      >
        <v-btn color="error">Penambahbaikkan</v-btn>
        <div class="divider" />
        <v-btn>Next</v-btn>
      </v-row>
    </v-row>-->

    <v-col cols="12" md="12">
      <v-radio-group v-model="radios" :mandatory="false">
        <v-radio color="success" label="Lulus" value="true"></v-radio>
        <v-radio color="red" label="Perlu penambahbaikkan" value="false"></v-radio>
      </v-radio-group>
      <v-file-input label="Laporan"></v-file-input>
      <v-textarea solo name="input-7-4" label="Komen laporan(Tidak diwajibkan)"></v-textarea>
    </v-col>
    <v-row style="padding-right:20px;padding-bottom:20px" allign="center" justify="end">
      <v-btn small color="primary">Hantar laporan</v-btn>
    </v-row>
  </v-card>
</template>
<script>
export default {
  props: ["permohonan_id_props"],
  data() {
    return {
      loaded: false,
      radios: [],
      permohonan_id: this.permohonan_id_props
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
      this.currentTab = "Tab" + tab;
      return this.currentTab;
    },
    getDataBind() {
      return { permohonan_id_props: this.permohonan_id };
    }
  }
};
</script>