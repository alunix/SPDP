@extends('layouts.app')

@section('content')
<div >
            
           

                <div class="section__content section__content--p30">
                    <div class="container">
                    <form method="POST" action="{{ route('analitik.permohonan.submit') }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1"> Analitik {{$fakulti->kod}} tahun {{$year_report}}</h2>
                                </div>
                            </div>
                        </div>
                        <hr>
                        
                        <h5>Dokumen permohonan dihantar : {{$dokumen_permohonans->count()}}</h5>
                        <h5>Permohonan dihantar : {{$permohonans->count()}}</h5>
                        <h5>Jumlah penambahbaikkan : {{count($jumlah_penambahbaikkan)}}</h5>

                        <div class="row m-t-25">
                        
                            <div class="col-lg-6">
                                <div class="au-card recent-report">
                                    <div class="au-card-inner">
                                        <h3 class="title-2">Jumlah permohonan</h3>
                                        <div class="chart-info">
                                        </div>
                                        <div class="recent-report__chart">
                                        {!! $bar_chart->container() !!}
										{!! $bar_chart->script() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="au-card recent-report">
                                    <div class="au-card-inner">
                                        <h3 class="title-2">Permohonan</h3>
                                       
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
                        

                        @if(! $permohonan_lulus->isEmpty())
                        <h2>Permohonan diluluskan</h2>
						<table class="table table-striped">

						<thead>
							<tr>
							<th scope="col">No</th>
							<th scope="col">Permohonan ID</th>
							<th scope="col">Tajuk Permohonan</th>
							<th scope="col">Diluluskan pada</th>
							<th scope="col"> Jumlah laporan dikeluarkan</th>
                            <th scope="col">Jumlah dokumen permohonan</th>
                            <th scope="col">Pautan</th>
							</tr>
						</thead>
						<tbody>
						@foreach($permohonan_lulus as $permohonan)
						<tr>
						<th scope="row">{{$loop->iteration}}</th>
						<td> {{$permohonan->permohonan_id}}</td> 
						<td> {{$permohonan->doc_title}}</td> 
						<td> {{$permohonan->updated_at}}</td> 
                        <td> {{$permohonan->laporans->count()}}</td> 
                        <td> {{$permohonan->version_counts()}}</td> 
                        <td><a href="{{ route('view-permohonan-baharu',$permohonan->permohonan_id) }}" class="btn btn-primary">SELECT</a></td>
						
						


                        </tr>
                       
                        
                        @endforeach
                        </tbody>
                        </table>

                        @endif

                        @if(! $improvements_list->isEmpty())
                        <h2>Permohonan penambahbaikkan</h2>
						<table class="table table-striped">

						<thead>
							<tr>
							<th scope="col">No</th>
							<th scope="col">Permohonan ID</th>
							<th scope="col">Tajuk Permohonan</th>
							<th scope="col">Diluluskan pada</th>
							<th scope="col"> Jumlah laporan dikeluarkan</th>
                            <th scope="col">Jumlah dokumen permohonan</th>
                            <th scope="col">Pautan</th>
							</tr>
						</thead>
						<tbody>
						@foreach($permohonan_lulus as $permohonan)
						<tr>
						<th scope="row">{{$loop->iteration}}</th>
						<td> {{$permohonan->permohonan_id}}</td> 
						<td> {{$permohonan->doc_title}}</td> 
						<td> {{$permohonan->updated_at}}</td> 
                        <td> {{$permohonan->laporans->count()}}</td> 
                        <td> {{$permohonan->version_counts()}}</td> 
                        <td><a href="{{ route('view-permohonan-baharu',$permohonan->permohonan_id) }}" class="btn btn-primary">SELECT</a></td>
						
						


                        </tr>
                       
                        
                        @endforeach
                        </tbody>
                        </table>

                        @endif

                        


						
						
         
                      
                        </div>
                      
                    </div>
                </div>
            

      


@endsection







