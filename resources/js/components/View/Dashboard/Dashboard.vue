<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="au-breadcrumb-content">
          <div class="au-breadcrumb-left">
            <div class="overview-wrap">
              <h2 class="title-1">gambaran keseluruhan</h2>
            </div>
          </div>
          <form class="au-form-icon--sm" action="/search" method="post">
            @csrf
            <input
              class="au-input--w300 au-input--style2"
              type="text"
              name="input-search"
              placeholder="Cari permohonan dan laporan"
            />
            <button class="au-btn--submit2" type="submit">
              <i class="zmdi zmdi-search"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="row m-t-25">
      <div class="col-md-6 col-lg-3">
        <div class="statistic__item statistic__item--green">
          <h2 class="number" style="color:white">{{permohonans}}</h2>
          <span class="desc" style="color:white">permohonan baharu</span>
          <div class="icon">
            <i class="zmdi zmdi-file"></i>
          </div>
        </div>
      </div>@if(Auth::user()->role == "pjk")
      <div class="col-md-6 col-lg-3">
        <div class="statistic__item statistic__item--orange">
          <h2 class="number" style="color:white">{{permohonan_diperakui.length}}</h2>
          <span class="desc" style="color:white">permohonan untuk diperakui</span>
          <div class="icon">
            <i class="zmdi zmdi-alert-circle-o"></i>
          </div>
        </div>
      </div>@endif
      <div class="col-md-6 col-lg-3">
        <div class="statistic__item statistic__item--blue">
          <h2 class="number" style="color:white">{{permohonan_in_progress}}</h2>
          <span class="desc" style="color:white">permohonan sedang dinilai</span>
          <div class="icon">
            <i class="zmdi zmdi-calendar-note"></i>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="statistic__item statistic__item--red">
          <h2 class="number" style="color:white">{{permohonan_diluluskan}}</h2>
          <span class="desc" style="color:white">permohonan diluluskan</span>
          <div class="icon">
            <i class="zmdi zmdi-check"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="au-card recent-report">
          <div class="au-card-inner">
            <h3 class="title-2">Jumlah permohonan</h3>
            <div class="chart-info"></div>
            <div class="recent-report__chart">
              {!! $chart->container() !!}
              {!! $chart->script() !!}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="au-card recent-report">
          <div class="au-card-inner">
            <h3 class="title-2">Jenis permohonan</h3>

            <div class="recent-report__chart">
              {!! $pie_chart->container() !!}
              {!! $pie_chart->script() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      permohonans: [],
      permohonan_id: "",
      permohonans: {
        permohonan_id: "",
        jenis_permohonan: "",
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
    fetchPermohonans() {
      fetch("api/permohonan_dihantar")
        .then(res => res.json())
        .then(res => {
          this.permohonans = res;
        });
    },
    setPermohonanId(id) {
      this.permohonan_id = id;
    },
    showModel() {
      this.$modal.show("permohonan_baharu");
    },
    showKemajuanModel() {
      this.$modal.show("kemajuan_permohonan");
    },
    showDokumenModel() {
      this.$modal.show("dokumen_permohonan");
    }
  }
};
</script>