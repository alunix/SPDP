<template>
  <v-container>
    <v-card>
      <v-row class="left-padding" align="center" justify="start">
        <v-col class="divider" cols="3" md="6">
          <h3>Pengguna</h3>
          <hr />
        </v-col>

        <v-row style="padding-right:45px" class="padding-right" align="center" justify="end">
          <v-btn v-on:click="setUserId();showModel()" color="primary" small>
            <v-icon left dark>mdi-plus</v-icon>Baru
          </v-btn>
          <modal height="auto" width="25%" :scrollable="true" name="ModalPengguna">
            <ModalPengguna :user_id_props="user_id" @event="fetchUsers"></ModalPengguna>
          </modal>
        </v-row>
      </v-row>

      <v-row align="center" justify="center">
        <div style="padding-left:35px">
          <p>{{ pagination.total }} pengguna</p>
        </div>

        <v-row style="padding-right:45px" class="padding-right" align="center" justify="end">
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

      <v-row align="center" justify="center">
        <v-progress-circular v-if="!loaded" :size="25" :width="2" color="blue-grey" indeterminate></v-progress-circular>
      </v-row>

      <v-text-field
        style="width:500px"
        class="mx-4"
        flat
        hide-details
        label="Search"
        prepend-inner-icon="search"
        solo-inverted
      ></v-text-field>

      <div v-if="loaded">
        <v-row align="center" justify="center">
          <v-col>
            <table class="table table-hover">
              <thead class="thead-light">
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">NAME</th>
                  <th scope="col">EMAIL</th>
                  <th scope="col">PERANAN</th>
                  <th scope="col">FAKULTI</th>
                  <th scope="col">TARIKH DICIPTA</th>
                  <th></th>
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
                  <td>{{u.fakulti.fnama_kod}}</td>
                  <td>{{date(u.created_at)}}</td>
                  <td>
                    <!-- <v-btn v-on:click="setUserId(u.id);showModel()" color="normal" small>Edit</v-btn> -->

                    <b-dropdown
                      size="sm"
                      id="dropdown-left"
                      text="More"
                      variant="white"
                      class="m-2"
                    >
                      <b-dropdown-item v-on:click="setUserId(u.id);showModel()">Lihat pengguna</b-dropdown-item>
                      <b-dropdown-item style="color:#ff0000;" href="#">Padam/Delete pengguna</b-dropdown-item>
                    </b-dropdown>
                  </td>
                </tr>
              </tbody>
            </table>
          </v-col>
        </v-row>
      </div>
    </v-card>
  </v-container>
</template>

<script>
import dayjs from "dayjs";
export default {
  data() {
    return {
      users: [],
      emptyString: "",
      permohonan_id: "",
      pagination: {},
      start: "start",
      end: "end",
      user_id: "",
      loaded: false
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
      this.loaded = false;
      page_url = page_url || "api/users";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          console.log(res);
          this.users = res.data;
          that.makePagination(res);
          this.loaded = true;
        });
    },
    setUserId(id) {
      this.user_id = id;
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