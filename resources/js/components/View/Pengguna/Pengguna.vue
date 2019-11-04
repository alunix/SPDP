<template>
  <v-container>
    <v-card>
      <v-row class="left-padding" :align="alignment" :justify="start">
        <v-col class="divider" cols="3" md="6">
          <h3>Pengguna</h3>
          <hr />
        </v-col>
        <v-row style="padding-right:45px" class="padding-right" :align="alignment" :justify="end">
          <v-btn v-on:click="showModel()" color="primary" small>
            <v-icon left dark>mdi-plus</v-icon>Baru
          </v-btn>
          <modal height="auto" width="25%" :scrollable="true" name="ModalPengguna">
            <ModalPengguna @event="fetchUsers"></ModalPengguna>
          </modal>
        </v-row>
      </v-row>

      <v-row :align="alignment" :justify="justify">
        <div style="padding-left:35px">
          <p>{{ pagination.total }} permohonan</p>
        </div>

        <v-row style="padding-right:45px" class="padding-right" :align="alignment" :justify="end">
          <v-btn
            :disabled="!pagination.prev_page_url"
            v-on:click="fetchUsers(pagination.prev_page_url)"
            small
          >Prev</v-btn>
          <div class="divider" />
          <v-btn
            :disabled="!pagination.next_page_url"
            v-on:click="fetchUsers(pagination.next_page_url)"
            small
          >Next</v-btn>
        </v-row>
      </v-row>

      <v-row :align="alignment" :justify="justify">
        <v-col>
          <table class="table table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">NO</th>
                <th scope="col">NAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">PERANAN</th>
                <th scope="col">TARIKH DICIPTA</th>
              </tr>
            </thead>

            <tbody id="permohonans-add">
              <tr class="tr-shadow td-cursor" v-for="(u, index) in users" v-bind:key="u.id">
                <th
                  scope="row"
                >{{(index + 1) + (pagination.per_page * (pagination.current_page - 1) )}}</th>
                <td>{{u.name}}</td>
                <td>{{u.email}}</td>
                <td>{{u.role|uppercase}}</td>
                <td>{{date(u.created_at)}}</td>
              </tr>
            </tbody>
          </table>
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<script>
// import PermohonansModal from "./PermohonanModal";
import dayjs from "dayjs";
export default {
  data() {
    return {
      users: [],
      permohonan_id: "",
      pagination: {},
      alignment: "center",
      justify: "center",
      start: "start",
      end: "end"
    };
  },
  filters: {
    uppercase: function(value) {
      if (!value) {
        return "";
      }
      return value.toString().toUpperCase();
    }
  },
  created() {
    this.fetchUsers();
  },
  methods: {
    fetchUsers(page_url) {
      let that = this;
      page_url = page_url || "api/users";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          console.log(res);
          this.users = res.data;
          that.makePagination(res);
        });
    },
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
    },
    show(id) {
      let that = this;
      this.$router
        .push({ name: "permohonan", params: { id: id } })
        .catch(err => {
          console.log("all good");
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
    setPermohonanId(id) {
      this.permohonan_id = id;
    },
    showModel() {
      this.$modal.show("ModalPengguna");
    }
  }
};
</script>
<style>
</style>