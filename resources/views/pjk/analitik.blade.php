@extends('layouts.app')

@section('content')
<div >
            
           

                <div class="section__content section__content--p30">
                    <div class="container">
                    <form method="POST" action="{{ route('analitik.permohonan.submit') }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Analitik tahun {{$year_report}}</h2>
                                </div>
                            </div>
                        </div>
                        <hr>

                     
                        <h4>Purata masa diperlukan untuk meluluskan satu permohonan = {{$avg_duration}} jam</h4>
                        <h4>Jumlah permohonan diluluskan : {{$lulus->count()}}</h4>

                        <div class="form-group row">
                            <label for="year-report" class="col-md-4 col-form-label text-md-right">{{ __('Sila pilih tahun laporan') }}</label>

                            <div class="col-md-6">
                            <select class=”form-control” name='year_report' style="width:150px;" id='type' onchange="this.form.submit()">
                                
                                <option value=#>Please choose</option>
                                <option value=2019>1 hari lalu</option>
                                <option value=2018>7 hari lalu</option>
                                <option value=2017>30 haru lalu</option>
                                <option value=2016>90 hari lalu</option>
                                <option value=2015>12 bulan lalu</option>
                               
                            </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                   
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






