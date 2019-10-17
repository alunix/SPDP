<template>
  <div class="container">
    <div class="au-breadcrumb-left">
      <div class="overview-wrap">
        <h2 class="title-1">Permohonan</h2>
        <hr />
      </div>
    </div>
    <div class="table-data__tool">
      <div class="table-data__tool-left"></div>
    </div>
    <div>
      <b-tabs content-class="mt-3" justified>
        <b-tab title="Baharu" active>
          <senaraiPermohonan></senaraiPermohonan>
        </b-tab>
        <b-tab title="Untuk diperakui">
          <!-- <p>I'm the second tab</p> -->
        </b-tab>
        <b-tab title="Penilaian panel">
          <!-- <p>I'm the tab with the very, very long title</p> -->
        </b-tab>
      </b-tabs>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  created() {},
  methods: {}
};
</script>