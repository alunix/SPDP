@extends('layouts.app')

@section('pageTitle', 'Home')

@section('content')

                 <!-- Top  -->
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
                                <input class="au-input--w300 au-input--style2" type="text" name="input-search" placeholder="Cari permohonan & laporan">
                                    <button class="au-btn--submit2" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                            </div>                           
                        </div>
                <!-- End Top -->
               
                        <hr>
                        
                        <div class="row m-t-25">
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--green">
                                <h2 class="number" style="color:white">{{$permohonans->count()}}</h2>
                                <span class="desc" style="color:white">permohonan dihantar</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-file"></i>
                                </div>
                            </div>
                        </div>
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
                                        <h3 class="title-2">Jumlah dokumen permohonan</h3>
                                        <div class="chart-info">
                                        </div>
                                        <div class="recent-report__chart">
                                        {!! $line_chart->container() !!}
                                        {!! $line_chart->script() !!}
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
                        
                    
                
@endsection
@section('myjsfile')
@endsection





