@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="clear: both">
                    <h6 style="float: left; margin:5px;">Analitik permohonan</h6> 
                </div>

                <div class="card-body">
                <h5>Jumlah permohonan : {{$total_permohonan}}</h5>
                <h5>Jumlah permohonan yang diluluskan : {{$permohonans_count}}</h5>
                <h5>Purata masa yang diperlukan untuk meluluskan satu permohonan : {{$average}} jam / {{$average/24}} hari  </h5>
               
               

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection