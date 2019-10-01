<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="au-breadcrumb-content">
          <div class="au-breadcrumb-left">
            <div class="overview-wrap">
              <h2 class="title-1">Senarai permohonan dihantar</h2>
            </div>
          </div>
          <modal name="permohonan_baharu">hello, world!</modal>

          <!-- <a v-bind:href="'/permohonan-baharu'" class="btn btn-success mb-2" id="create-permohonan">
            <i class="zmdi zmdi-plus"></i>
            Permohonan Baharu
          </a>-->
          <a v-on:click="show_model()" class="btn btn-success mb-2" id="create-permohonan">
            <i class="zmdi zmdi-plus"></i>
            Permohonan Baharu
          </a>
        </div>
      </div>
      <hr />
    </div>
    <br />
    <div class="table-responsive table-responsive-data2">
      <table class="table table-data2">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">ID</th>
            <th scope="col">Jenis</th>
            <th scope="col">Bilangan penghantaran</th>
            <th scope="col">Nama program/semakan</th>
            <th scope="col">Penghantar</th>
            <th scope="col">Tarikh/Masa Penghantaran</th>
            <th scope="col">Status</th>
            <th scope="col">Tarikh/Masa Status</th>
          </tr>
        </thead>

        <tbody id="permohonans-add">
          <tr
            class="tr-shadow"
            v-for="permohonan in permohonans"
            v-bind:key="permohonan.permohonan_id"
          >
            <th scope="row">{{permohonan.permohonan_id}}</th>
            <td>{{permohonan.permohonan_id}}</td>
            <td>{{permohonan.jenis}}</td>
            <td>{{permohonan.bil_hantar}}</td>
            <td>{{permohonan.jenis}}</td>
            <td>{{permohonan.nama}}</td>
            <td>{{permohonan.created_at}}</td>
            <td>{{permohonan.status}}</td>
            <td>{{permohonan.updated_at}}</td>
            <td>
              <div class="table-data-feature">
                <button
                  v-on:click="location.href=url('/kemajuan-permohonan/{{permohonan.permohonan_id}}')"
                  class="item"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Kemajuan Permohonan"
                >
                  <i class="fas fa-spinner"></i>
                </button>
                <button
                  v-bind:href="'/senarai-dokumen-permohonan'+ permohonan.permohonan_id"
                  class="item"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Dokumen dihantar"
                >
                  <i class="fas fa-file-upload"></i>
                </button>
              </div>
            </td>
          </tr>

          <tr class="spacer"></tr>
        </tbody>
      </table>
      <!-- @else
			<p> Tiada permohonan telah dijumpai </p>
      @endif-->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      permohonans: [],
      permohonans: {
        permohonan_id: "",
        jenis: "",
        bil_hantar: "",
        doc_title: "",
        nama: "",
        created_at: "",
        status_permohonan_id: "",
        updated_at: ""
      }
    };
  },

  created() {
    this.fetchPermohonans();
  },

  methods: {
    fetchPermohonans(page_url) {
      fetch("api/permohonan_dihantar")
        .then(res => res.json())
        .then(res => {
          this.permohonans = res;
        });
    },
    show_model() {
      //   var vm = this;
      //   var URL = "resources\views\fakultimodal\fakulti_insert_permohonan.html";
      //   axios.get(URL).then(response => {
      //     vm.$modal.show(response);
      //   });
      this.$modal.show("permohonan_baharu");
    }
  }
};
</script>