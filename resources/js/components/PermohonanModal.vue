<template>
  <div class="card-body">
    <h2>Permohonan baharu</h2>
    <hr />
    <!-- <form  class="form-prevent-double-submits" method="POST" action="{{ route('permohonan.index.submit') }}" enctype="multipart/form-data"> -->
    <div class="form-group row">
      <label
        for="jenis_permohonan_id"
        class="col-md-4 col-form-label text-md-right"
      >Jenis Permohonan</label>
      <div class="col-md-6">
        <select
          class="”form-control”"
          name="jenis_permohonan_id"
          style="width:330px;"
          id="jenis_permohonan_id"
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
      </div>
    </div>
    <div class="form-group row">
      <label for="doc_title" class="col-md-4 col-form-label text-md-right">Nama program/kursus</label>
      <div class="col-md-6">
        <input id="doc_title" type="text" class="form-control" name="doc_title" required autofocus />
      </div>
    </div>
    <div class="form-group row">
      <label for="file_link" class="col-md-4 col-form-label text-md-right">Pautan kepada fail</label>
      <div class="col-md-6">
        <input id="file_link" type="file" class="form-control" name="file_link" required autofocus />
      </div>
    </div>
    <div class="form-group row">
      <label
        for="summary-ckeditor"
        class="col-md-4 col-form-label text-md-right"
      >Komen( Tidak diwajibkan )</label>
      <div class="col-md-6">
        <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea>
      </div>
    </div>
    <div class="form-group row mb-0">
      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary double-submit-prevent">Hantar</button>
      </div>
    </div>
    <hr />
  </div>
</template>
<script>
export default {
  data() {
    return {
      fields: {},
      errors: {}
    };
  },
  methods: {
    submit() {
      this.errors = {};
      axios
        .post("/submit", this.fields)
        .then(response => {
          alert("Message sent!");
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
