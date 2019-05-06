@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="clear: both">
                    <h6 style="float: left; margin:5px;">{{$fakulti->f_nama}}</h6> 
                </div>
                <h5>Dokumen permohonan dihantar : {{$dokumen_permohonans->count()}}</h5>
                <h5>Permohonan dihantar : {{$permohonans->count()}}</h5>
                <h5>J = {{$avg_duration}} jam</h5>
                <div class="card-body">
                <div class="row">
            
            <div class="col-md-6"> 
               {!! $pie_chart->container() !!}
               {!! $pie_chart->script() !!}
            </div>
                </div>
                <table class="table table-striped">


            </div>
        </div>
    </div>
</div>
@endsection