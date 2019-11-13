<template>
  <v-container>
    <v-card class="mt-n3">
      <v-row class="left-padding" align="center" justify="start">
        <v-col class="divider mb-n2" cols="3" md="6">
          <h3>Lantik Panel Penilai</h3>
          <hr />
        </v-col>
        <modal height="30%" width="50%" :scrollable="true" name="ModalLantikPenilai">
          <ModalLantikPenilai
            :panel_penilai_props="selectedPenilai"
            :permohonan_props="permohonan"
            @event="fetchUsers"
          ></ModalLantikPenilai>
        </modal>
        <!-- <v-switch
          style="margin-left:150px"
          color="red"
          v-model="people"
          label="Penambahbaikkan"
          value="John"
        ></v-switch>-->
      </v-row>

      <v-form ref="form" @submit.prevent="submit">
        <v-row align="center" justify="center">
          <div style="padding-left:35px">
            <p v-if="!searchText">{{ pagination.total }} penilai</p>
            <p v-else>{{ users.length }} keputusan</p>
            <p>{{ selectedPenilai.length }} penilai dilantik</p>
          </div>

          <v-row style="padding-right:45px" class="padding-right" align="center" justify="end">
            <v-btn
              style="margin-left:255px"
              :disabled="!selectedPenilai.length"
              normal
              color="primary"
            >Seterusnya</v-btn>
          </v-row>
        </v-row>

        <span style="margin-left:15px">Tetapkan tarikh hantar laporan</span>

        <v-dialog ref="dialog" v-model="modal" :return-value.sync="date" persistent width="290px">
          <template v-slot:activator="{ on }">
            <v-text-field
              v-model="date"
              label="Picker in dialog"
              prepend-icon="event"
              readonly
              v-on="on"
            ></v-text-field>

            <v-btn v-on:click="showDate = !showDate" style="margin-left:15px" regular>
              <v-icon left>mdi-calendar</v-icon>
            </v-btn>
          </template>
          <v-date-picker v-model="date" scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="modal = false">Cancel</v-btn>
            <v-btn text color="primary" @click="$refs.dialog.save(date)">OK</v-btn>
          </v-date-picker>

          <v-date-picker v-if="showDate == true" v-model="selectedPenilai.due_date" scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="showDate = false">Cancel</v-btn>
            <v-btn text color="primary" @click="showDate = false">OK</v-btn>
          </v-date-picker>
        </v-dialog>

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
              <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">TARIKH DICIPTA</th>
                    <th scope="col">LANTIK</th>
                    <th scope="col">TARIKH HANTAR LAPORAN</th>
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
                    <td>
                      <v-btn v-if="selectedPenilai.includes(u.id)" small>
                        <v-icon left>mdi-calendar</v-icon>Tetapkan
                      </v-btn>
                      <!-- <v-date-picker
                        v-model="selectedPenilai.due_date"
                        color="green lighten-1"
                        header-color="primary"
                      ></v-date-picker>-->
                    </td>
                  </tr>
                </tbody>
              </table>
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
      due_date: [],
      showDate: false
    };
  },
  watch: {
    searchText: { handler: "searchUsers", immediate: true },
    selectedPenilai: "showPenilai"
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
    showPenilai() {
      console.log(this.selectedPenilai);
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
          }
        });
    },
    date(created_at) {
      if (!created_at) {
        return null;
      }
      return dayjs(created_at).format("LLL");
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
    showModel() {
      this.$modal.show("ModalLantikPenilai");
    },
    submit() {
      // this.loading = true;
      // let formData = new FormData();
      // formData.append("file_link", this.file_link);
      // formData.append("jenis_permohonan_id", this.jenis_permohonan_id);
      // formData.append("doc_title", this.doc_title);
      // formData.append("komen", this.komen);
      // this.loaded = false;
      // this.success = false;
      // this.errors = {};
      // axios
      //   .post("api/permohonan/submit", formData, {
      //     headers: {
      //       "Content-Type": "multipart/form-data"
      //     }
      //   })
      //   .then(res => {
      //     this.success = true;
      //     this.jenis_permohonan_id = "";
      //     this.doc_title = "";
      //     this.komen = "";
      //     this.file_link = "";
      //     this.fileName = "";
      //     this.loading = false;
      //     this.$emit("event");
      //   })
      //   .catch(error => {
      //     if (error.response.status === 422) {
      //       this.errors = error.response.data.errors || {};
      //       this.error = true;
      //     }
      //   });
    }
  }
};
</script>
<style>
</style>