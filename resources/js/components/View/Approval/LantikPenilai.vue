<template>
  <v-container>
    <v-card class="mt-n3">
      <v-alert type="error" v-if="error">
        <b></b>
        <ul>
          <li v-for="error in errors" v-bind:key="error[0]">{{ error[0] }}</li>
        </ul>
      </v-alert>
      <v-row class="left-padding" align="center" justify="start">
        <v-col class="divider mb-n2" cols="3" md="6">
          <h3>Lantik Panel Penilai</h3>
          <hr />
        </v-col>
      </v-row>

      <v-form ref="form" method="post" @submit.prevent="submit">
        <v-row align="center" justify="center">
          <div style="padding-left:35px">
            <p v-if="!searchText">{{ pagination.total }} penilai</p>
            <p v-else>{{ users.length }} keputusan</p>
            <p>{{ selectedPenilai.length }} penilai dilantik</p>
          </div>

          <v-row style="padding-right:45px" class="padding-right" align="center" justify="end">
            <v-btn
              @click="submit"
              style="margin-left:255px;"
              :disabled="!selectedPenilai.length"
              normal
              color="primary"
            >Hantar</v-btn>
          </v-row>
        </v-row>

        <span style="margin-left:15px">Tetapkan tarikh hantar laporan</span>

        <v-dialog
          ref="dialog"
          v-model="modal"
          :return-value.sync="due_date"
          persistent
          width="290px"
        >
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" v-model="due_date" style="margin-left:30px;" regular>
              <v-icon left>mdi-calendar</v-icon>
              {{due_date_format(due_date)}}
            </v-btn>
          </template>
          <v-date-picker :min="min_date" v-model="due_date" scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="modal = false">Cancel</v-btn>
            <v-btn text color="primary" @click="$refs.dialog.save(due_date)">OK</v-btn>
          </v-date-picker>
        </v-dialog>

        <span style="margin-left:260px">{{tempoh}} hari diberikan</span>

        <v-layout row class="px-3 pt-1">
          <v-flex xs6>
            <v-text-field
              v-model="searchText"
              style="width:500px"
              class="mx-4"
              flat
              hide-details
              label="Search"
              prepend-inner-icon="search"
              solo-inverted
            ></v-text-field>
          </v-flex>

          <v-row justify="end" class="mr-4">
            <v-btn
              :disabled="!pagination.prev_page_url || searchText.length > 0"
              v-on:click="fetchUsers(pagination.prev_page_url)"
              small
            >Prev</v-btn>
            <div class="divider" />
            <v-btn
              :disabled="!pagination.next_page_url || searchText.length > 0"
              v-on:click="fetchUsers(pagination.next_page_url)"
              small
            >Next</v-btn>
          </v-row>
        </v-layout>

        <v-row align="center" justify="center">
          <v-progress-circular
            class="my-10"
            v-if="!loaded"
            :size="25"
            :width="2"
            color="blue-grey"
            indeterminate
          ></v-progress-circular>
        </v-row>

        <div v-if="loaded">
          <v-row align="center" justify="center">
            <v-col>
              <v-simple-table fixed-header height="auto">
                <template v-slot:default>
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">NO</th>
                      <th scope="col">NAME</th>
                      <th scope="col">EMAIL</th>
                      <th scope="col">TARIKH DICIPTA</th>
                      <th scope="col">LANTIK</th>
                    </tr>
                  </thead>

                  <tbody id="permohonans-add">
                    <tr class="tr-shadow" v-for="(u, index) in users" v-bind:key="u.id">
                      <th
                        scope="row"
                      >{{(index + 1) + (pagination.per_page * (pagination.current_page - 1) )}}</th>
                      <td>{{u.name}}</td>
                      <td>{{u.email}}</td>
                      <td>{{date(u.created_at)}}</td>
                      <td>
                        <v-checkbox v-model="selectedPenilai" :value="u.id">Lantik Penilai</v-checkbox>
                      </td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table>
            </v-col>
          </v-row>
        </div>
      </v-form>
    </v-card>
  </v-container>
</template>

<script>
import dayjs from "dayjs";
export default {
  props: ["permohonan_props"],
  data() {
    return {
      users: [],
      emptyString: "",
      permohonan_id: "",
      pagination: {},
      start: "start",
      end: "end",
      user_id: "",
      loaded: false,
      searchText: "",
      selectedPenilai: [],
      permohonan: this.permohonan_props,
      showDate: false,
      due_date: new Date().toISOString().substr(0, 10),
      min_date: new Date().toISOString().substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,
      tempoh: 0,
      error: false
    };
  },
  watch: {
    searchText: { handler: "searchUsers", immediate: true },
    due_date: "setTempoh"
  },
  methods: {
    searchUsers(text) {
      if (text) {
        this.loaded = false;
        fetch("/api/panel-penilai/search/" + text)
          .then(res => res.json())
          .then(res => {
            this.users = res;
            this.loaded = true;
          });
      } else {
        this.fetchUsers();
      }
    },
    setTempoh() {
      const today = dayjs(new Date());
      const due_date = dayjs(this.due_date);
      let tempoh = due_date.diff(today, "day");
      this.tempoh = tempoh;
    },
    fetchUsers(page_url) {
      let that = this;
      this.loaded = false;
      page_url = page_url || "/api/senarai-panel-penilai";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.users = res.data;
          that.makePagination(res);
          this.loaded = true;
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
            this.error = true;
            console.log(error);
          }
        });
    },
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
    },
    due_date_format(date) {
      return dayjs(date).format("DD-MM-YYYY");
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
    submit() {
      this.loading = true;
      this.loaded = false;
      this.success = false;
      this.errors = {};
      axios
        .post("/api/" + this.permohonan.id + "/pelantikan-penilai", {
          selectedPenilai: this.selectedPenilai,
          due_date: this.due_date,
          _method: "patch"
        })
        .then(res => {
          this.error = false;
          this.selectedPenilai = [];
          this.due_date = new Date().toISOString().substr(0, 10);
          this.loading = false;
          //Show success message and hide component
          this.$emit("event");
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.error = false;
            this.errors = error.response.data.errors || {};
            this.error = true;
            this.loaded = true;
          }
        });
    }
  }
};
</script>
<style>
</style>