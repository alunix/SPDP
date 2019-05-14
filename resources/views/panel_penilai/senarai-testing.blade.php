@extends('layouts.app')

@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">gambaran keseluruhan</h2>
                                    
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="au-btn au-btn-icon au-btn--green">
                                        <i class="zmdi zmdi-plus"></i>permohonan baharu<button>
                        <div class="row m-t-25">
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--green">
                                <h2 class="number" style="color:white">{{$permohonans}}</h2>
                                <span class="desc" style="color:white">permohonan baharu</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-file"></i>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->role == "pjk"||Auth::user()->role=="jppa")
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number" style="color:white">3</h2>
                                <span class="desc" style="color:white">permohonan untuk diperakui</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-alert-circle-o"></i>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number"  style="color:white">{{$permohonan_in_progress}}</h2>
                                <span class="desc"  style="color:white">permohonan sedang dinilai</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--red">
                                <h2 class="number"  style="color:white">{{$permohonan_diluluskan}}</h2>
                                <span class="desc"  style="color:white">permohonan diluluskan</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-check"></i>
                                </div>
                            </div>
                        </div>

                        
                    
                       
                    
                        
                            <div class="col-lg-6">
                                <div class="au-card recent-report">
                                    <div class="au-card-inner">
                                        <h3 class="title-2">Jumlah permohonan</h3>
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
                  
                       
                        </div>
         
                      
                        </div>
                      
                    </div>
                </div>
            

      


@endsection

@section('myjsfile')


@endsection





