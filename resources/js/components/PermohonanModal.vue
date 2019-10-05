<template>
  <div class="card-body">
    <h2>Permohonan baharu</h2>
    <hr />
    <form @submit.prevent="submit">
      <div class="form-group row">
        <label
          for="jenis_permohonan_id"
          class="col-md-4 col-form-label text-md-right"
        >Jenis Permohonan</label>
        <div class="col-md-6">
          <select
            class="form-control"
            name="jenis_permohonan_id"
            style="width:330px;"
            id="jenis_permohonan_id"
            v-model="jenis_permohonan_id"
            required
          >
            <option value="#">Sila pilih</option>
            <option value="1">Program Pengajian Baru</option>
            <option value="2">Semakan Program Pengajian</option>
            <option value="3">Kursus Teras Baru</option>
            <option value="4">Kursus Elektif Baru</option>
            <option value="5">Semakan Kursus Teras</option>
            <option value="6">Semakan Kursus Elektif</option>
            <option value="8">Penjumudan Program Pengajian</option>
          </select>
          <div
            v-if="errors && errors.jenis_permohonan_id"
            class="text-danger"
          >{{ errors.jenis_permohonan_id[0] }}</div>
        </div>
      </div>
      <div class="form-group row">
        <label for="doc_title" class="col-md-4 col-form-label text-md-right">Nama program/kursus</label>
        <div class="col-md-6">
          <input
            id="doc_title"
            type="text"
            class="form-control"
            name="doc_title"
            v-model="doc_title"
            required
            autofocus
          />
          <div v-if="errors && errors.doc_title" class="text-danger">{{ errors.doc_title[0] }}</div>
        </div>
      </div>
      <div class="form-group row">
        <label for="file_link" class="col-md-4 col-form-label text-md-right">Pautan kepada fail</label>
        <div class="col-md-6">
          <input
            type="file"
            id="file_link"
            v-on:change="filePreview"
            name="file_link"
            ref="file_link"
          />
        </div>
      </div>
      <div class="form-group row">
        <label
          for="summary-ckeditor"
          class="col-md-4 col-form-label text-md-right"
        >Komen( Tidak diwajibkan )</label>
        <div class="col-md-6">
          <textarea class="form-control" v-model="komen" id="komen" name="komen"></textarea>
          <div v-if="errors && errors.komen" class="text-danger">{{ errors.komen[0] }}</div>
        </div>
      </div>
      <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
          <button type="submit" class="btn btn-primary double-submit-prevent">Hantar</button>
        </div>
      </div>
      <div v-if="success" class="alert alert-success mt-3">Permohonan berjaya dihantar</div>
    </form>
    <hr />
  </div>
</template>
<script>
export default {
  data() {
    return {
      jenis_permohonan_id: "",
      doc_title: "",
      komen: "",
      errors: {},
      // file_link: {},
      success: false,
      loaded: true
    };
  },
  methods: {
    filePreview(event) {
      let selectedFile = event.target.files[0];
    },
    submit() {
      let formData = new FormData();
      formData.append("file_link", formData);
      // this.jenis_permohonan_id = {};
      // this.doc_title = {};
      // this.komen = {};
      // this.errors = {};
      this.loaded = false;
      this.success = false;
      this.errors = {};
      axios
        // .post(
        //   "api/permohonan_submit",
        //   {
        //     jenis_permohonan_id: this.jenis_permohonan_id,
        //     doc_title: this.doc_title,
        //     komen: this.komen,
        //     file_link: pdf_file
        //   },
        //   {
        //     // headers: { "Content-Type": "multipart/form-data" }
        //     // headers: {}
        //   }
        // )
        .post(
          "api/permohonan_submit",
          jenis_permohonan_id,
          doc_title,
          komen,
          formData,
          {
            // headers: { "Content-Type": "multipart/form-data" }
            // headers: {}
          }
        )
        .then(res => {
          console.log(res);
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
        });
    }
  }
};
</script>
