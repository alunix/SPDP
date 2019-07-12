@extends('layouts.app')
@section('pageTitle', 'Analitik')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="clear: both">
                    <h6 style="float: left; margin:5px;">Analitik papan pemuka </h6>
                </div>

                <div class="card-body">
               
                <form method="POST" action="{{ route('analitik.permohonan.submit') }}">
              
                <h5>Jenis permohonan tertinggi: {{$highest_jp_id->jenis_permohonan->jenis_permohonan_huraian}} dengan {{$highest_count_jp}} kali</h5>

                @csrf

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   
                    

                    <div class="form-group row">
                            <label for="year-report" class="col-md-4 col-form-label text-md-right">{{ __('Sila pilih tahun laporan') }}</label>

                            <div class="col-md-6">
                            <select class=”form-control” name='year_report' style="width:150px;" id='type' onchange="this.form.submit()">
                                
                                <option value=#>Please choose</option>
                                <option value=2019>2019</option>
                                <option value=2018>2018</option>
                                <option value=2017>2017</option>
                                <option value=2016>2016</option>
                                <option value=2015>2015</option>
                                <option value=2014>2014</option>
                            </select>
                            </div>
                    </div>
                    

                    

                   

        <div class="row">
            
            <div class="col-md-6"> 
            {!! $chart->container() !!}
            {!! $chart->script() !!}
            </div>

            
            
            <div class="col-md-6"> 
               {!! $pie_chart->container() !!}
               {!! $pie_chart->script() !!}
            </div>


        <table class="table table-striped">

<thead>
    <tr>
    <th scope="col">Tahun</th>
    <th scope="col">Jumlah permohonan</th>
    </tr>
</thead>
<tbody>
@foreach($sort_sum_years as $permohonan)
<tr>

<td> {{$permohonan->years}}</td> 
<td> {{$permohonan->total_permohonans}}</td> 


</tr>
@endforeach










</tbody>
</table>

       
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection