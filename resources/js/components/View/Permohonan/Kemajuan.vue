<template>
  <div>
    <!-- @if(($permohonan->status_permohonan_id == 8 or $permohonan->status_permohonan_id == 9 or $permohonan->status_permohonan_id == 10 or $permohonan->status_permohonan_id == 11  ) and (Auth::user()->role == "fakulti"))
            <a class="btn icon-btn btn-info" style="font-size:14px" href="{{ route('dokumenPermohonan.penambahbaikkan.show',$permohonan->permohonan_id) }}">
            Muat naik penambahbaikkan
    </a>-->
    <v-row
      style="padding-right:20px; padding-top:8px"
      class="padding-right"
      :align="alignment"
      :justify="end"
    >
      <v-btn small>Prev</v-btn>
      <div class="divider" />
      <v-btn small>Next</v-btn>
    </v-row>
    <div class="row justify-content-center">
      <div class="container">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Status Permohonan</th>
              <th scope="col">Tarikh/Masa</th>
            </tr>
          </thead>
          <tbody>
            <tr class="tr-shadow" v-for="(k, index) in kemajuans" v-bind:key="k.id">
              <th scope="row">{{index + 1}}</th>
              <td>{{k.status_permohonan.status_permohonan_huraian}}</td>
              <td>{{date(k.created_at)}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import dayjs from "dayjs";
export default {
  props: ["kemajuans_props"],
  data() {
    return {
      kemajuans: [
        {
          status_permohonan: {
            status_permohonan_huraian: ""
          }
        }
      ],
      laporans: [],
      alignment: "center",
      end: "end"
    };
  },
  created() {
    this.kemajuans = this.kemajuans_props;
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