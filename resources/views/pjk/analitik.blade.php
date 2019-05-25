@extends('layouts.app')

@section('content')
<div >
            
            <section class="au-breadcrumb2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <span class="au-breadcrumb-span">Analitik permohonan tahun {{$year_report}}</span>
									  <h5>Purata masa diperlukan untuk meluluskan satu permohonan = {{$avg_duration}} jam</h5>
									  <h5>Jumlah permohonan diluluskan : {{$lulus->count()}}</h5>
                                    
                                </div>
                                <form class="au-form-icon--sm" action="/search" method="post">
                                @csrf    
                                <input class="au-input--w300 au-input--style2" type="text" name="input-search" placeholder="Cari permohonan & laporan">
                                    <button class="au-btn--submit2" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

                <div class="section__content section__content--p30">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Analitik</h2>
                                    
                                </div>
                            </div>
                        </div>
                        <hr>
                   
                        <div class="row m-t-25">
                        
                            <div class="col-lg-6">
                                <div class="au-card recent-report">
                                    <div class="au-card-inner">
                                        <h3 class="title-2">Jumlah permohonan mengikut fakulti</h3>
                                        <div class="chart-info">
                                        </div>
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
							
							    <div class="col-lg-6">
                                <div class="au-card recent-report">
                                    <div class="au-card-inner">
                                        <h3 class="title-2">Dokumen permohonan</h3>
                                       
                                        <div class="recent-report__chart">
                                        {!! $line_chart->container() !!}
                                        {!! $line_chart->script() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                        </div>
						
						<table class="table table-striped">

						<thead>
							<tr>
							<th scope="col">No</th>
							<th scope="col">Fakulti</th>
							<th scope="col">Jumlah permohonan</th>
							<th scope="col">Jumlah permohonan diluluskan</th>
							<th scope="col">Jumlah perlu penambahbaikkan</th>
							<th scope="col">Jumlah dokumen permohonan</th>
							</tr>
						</thead>
						<tbody>
						@foreach($permohonans as $permohonan)
						<tr>
						<th scope="row">{{$loop->iteration}}</th>
						<td> {{$permohonan["fakulti_nama"]}}</td> 
						<td> {{$permohonan["jumlah_permohonan"]}}</td> 
						<td> {{$permohonan["jumlah_diluluskan"]}}</td> 
						<td> {{$permohonan["jumlah_penambahbaikkan"]}}</td> 
						<td> {{$permohonan["jumlah_dokumen_permohonan"]}}</td> 
						<td><a href="{{ route('analitik.fakulti',$permohonan['fakulti_id']) }}" class="btn btn-primary">SELECT</a></td>


                        </tr>
                        
                        @endforeach

</tbody>
</table>
						
						
         
                      
                        </div>
                      
                    </div>
                </div>
            

      


@endsection







