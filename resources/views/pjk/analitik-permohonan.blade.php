@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="clear: both">
                    <h6 style="float: left; margin:5px;">Analitik permohonan tahun {{$year_report}}</h6> 
                </div>

                <h5>Purata masa diperlukan untuk meluluskan satu permohonan = {{$avg_duration}} jam</h5>

                <div class="card-body">

                <div class="row">
            
            <div class="col-md-6"> 
            {!! $chart->container() !!}
            {!! $chart->script() !!}
            </div>

            
            
            <div class="col-md-6"> 
               {!! $pie_chart->container() !!}
               {!! $pie_chart->script() !!}
            </div>


            
            
           

            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection