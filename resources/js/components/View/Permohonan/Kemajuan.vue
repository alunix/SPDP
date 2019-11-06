<template>
  <div>
    <!-- @if(($permohonan->status_permohonan_id == 8 or $permohonan->status_permohonan_id == 9 or $permohonan->status_permohonan_id == 10 or $permohonan->status_permohonan_id == 11  ) and (Auth::user()->role == "fakulti"))
            <a class="btn icon-btn btn-info" style="font-size:14px" href="{{ route('dokumenPermohonan.penambahbaikkan.show',$permohonan->permohonan_id) }}">
            Muat naik penambahbaikkan
    </a>-->
    <v-row :align="alignment" :justify="justify">
      <div style="padding-left:20px; padding-top:20px">
        <p>{{ pagination.total }} keputusan</p>
      </div>
      <v-row
        style="padding-right:25px; padding-top:8px; "
        class="padding-right"
        :align="alignment"
        :justify="end"
      >
        <v-btn
          :disabled="!pagination.prev_page_url"
          v-on:click="fetchKemajuans(pagination.prev_page_url)"
          small
        >Prev</v-btn>
        <div class="divider" />
        <v-btn
          :disabled="!pagination.next_page_url"
          v-on:click="fetchKemajuans(pagination.next_page_url)"
          small
        >Next</v-btn>
      </v-row>
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
              <th
                scope="row"
              >{{(index + 1) + (pagination.per_page * (pagination.current_page - 1) )}}</th>
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
  props: ["permohonan_id_props"],
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
      end: "end",
      justify: "center",
      pagination: {},
      permohonan_id: this.permohonan_id_props
    };
  },
  created() {
    this.fetchKemajuans();
  },
  methods: {
    fetchKemajuans(page_url) {
      page_url = page_url || "/api/senarai-kemajuan/" + this.permohonan_id;
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.kemajuans = res.data;
          this.makePagination(res);
        });
    },
    makePagination(res) {
      let pagination = {
        total: res.total,
        current_page: res.current_page,
        next_page_url: res.next_page_url,
        prev_page_url: res.prev_page_url,
        per_page: res.per_page
      };
      this.pagination = pagination;
    },
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
    }
  }
};
</script>