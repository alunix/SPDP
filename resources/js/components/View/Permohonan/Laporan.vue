<template>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Laporan</th>
          <th scope="col">Dihantar</th>
          <th scope="col">Pihak</th>
          <th scope="col">Komen</th>
          <th scope="col">Versi</th>
          <th scope="col">Tarikh/Masa</th>
        </tr>
      </thead>
      <tbody>
        <tr class="tr-shadow td-cursor" v-for="(l, index) in laporans" v-bind:key="l.laporan_id">
          <th scope="row">{{index+1}}</th>
          <td>{{l.tajuk_fail_link}}</td>
          <td>{{l.id_penghantar.name}}</td>
          <td>{{l.id_penghantar.role}}</td>
          <td>{{l.komen}}</td>
          <td>{{l.versi_laporan}}</td>
          <td>{{date(l.created_at)}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import dayjs from "dayjs";
export default {
  props: ["laporans_props"],
  data() {
    return {
      laporans: []
    };
  },
  created() {
    this.laporans = this.laporans_props;
  },
  methods: {
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
    }
  }
};
</script>
