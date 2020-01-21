<template>
  <div>
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
        <v-simple-table fixed-header height="auto">
          <template v-slot:default>
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
                <td>{{k.status_permohonan.huraian}}</td>
                <td>{{k.created_at | date}}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["permohonan_id_props"],
  data() {
    return {
      kemajuans: [
        {
          status_permohonan: {
            huraian: ""
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
      axios.get(page_url)
        .then(res => {
          this.kemajuans = res.data.data;
          console.log(this.kemajuans);
          this.makePagination(res.data);
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
    }
  }
};
</script>