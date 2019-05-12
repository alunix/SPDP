@extends('layouts.app')

@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">gambaran keseluruhan</h2>
                                    
                                </div>
                            </div>
                        </div>
                        <br>
                        <button class="au-btn au-btn-icon au-btn--green">
                                        <i class="zmdi zmdi-plus"></i>permohonan baharu<button>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-file"></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{$permohonans}}</h2>
                                                <span>permohonan baharu</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Auth::user()->role == "pjk"||Auth::user()->role=="jppa")
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-comment"></i>
                                            </div>
                                            <div class="text">
                                                <h2>3</h2>
                                                <span>permohonan untuk diperakui</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-spinner"></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{$permohonan_in_progress}}</h2>
                                                <span>permohonan sedang dinilai</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-check"></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{$permohonan_diluluskan}}</h2>
                                                <span>permohonan diluluskan</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            
                                        </div>
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





