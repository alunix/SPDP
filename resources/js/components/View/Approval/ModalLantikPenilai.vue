<template>
  <div>
    <v-row align="center" justify="center">
      <v-card-text>
        <v-layout row class="my-n5 px-3 pt-1">
          <v-flex xs6>
            <p>Tajuk Permohonan</p>
            <p>Jenis Permohonan</p>
          </v-flex>
          <v-flex v-model="permohonan" xs6>
            <div class="text--primary">{{permohonan.doc_title}}</div>
            <div class="text--primary">{{permohonan.jenis_permohonan_id}}</div>
          </v-flex>
        </v-layout>
      </v-card-text>

      <v-col>
        <table class="table table-hover">
          <thead class="thead-light">
            <tr>
              <th scope="col">NO</th>
              <th scope="col">NAMA</th>
              <th scope="col">EMAIL</th>
            </tr>
          </thead>

          <tbody id="permohonans-add">
            <tr class="tr-shadow" v-for="(p, index) in selectedPenilai" v-bind:key="p.id">
              <th scope="row">{{(index + 1)}}</th>
              <td>{{p.name}}</td>
              <td>{{p.email}}</td>
            </tr>
          </tbody>
        </table>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import dayjs from "dayjs";
export default {
  props: ["panel_penilai_props", "permohonan_props"],
  data() {
    return {
      // users: [],
      // emptyString: "",
      // permohonan_id: "",
      // pagination: {},
      // start: "start",
      // end: "end",
      // user_id: "",
      // loaded: false,
      // searchText: "",
      selectedPenilai: this.panel_penilai_props,
      permohonan: this.permohonan_props
    };
  },
  created() {
    this.showData();
  },
  methods: {
    selectedPenilaiWatch() {
      console.log(this.selectedPenilai);
    },
    showData() {
      console.log(this.selectedPenilai);
      console.log(this.permohonan);
    },
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
    },
    submit() {}
  }
};
</script>