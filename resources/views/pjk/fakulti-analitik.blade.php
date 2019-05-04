@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="clear: both">
                    <h6 style="float: left; margin:5px;">{{$fakulti_nama}}</h6> 
                </div>

                <h5>Jumlah permohonan dihantar = {{$permohonans->count()}} jam</h5>
                <h5>Pengguna tertinggi menghantar permohonan = {{$nama_penghantar}} jam</h5>


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
                <table class="table table-striped">

<thead>
    <tr>
    <th scope="col">Fakulti</th>
    <th scope="col">Jumlah permohonan</th>
    <th scope="col">Jumlah permohonan diluluskan</th>
    <th scope="col">Jumlah perlu penambahbaikkan</th>
    </tr>
</thead>
<tbody>
@foreach($permohonans as $permohonan)
<tr>

<td> {{$permohonan["fakulti_nama"]}}</td> 
<td> {{$permohonan["jumlah_permohonan"]}}</td> 
<td> {{$permohonan["jumlah_diluluskan"]}}</td> 
<td> {{$permohonan["jumlah_penambahbaikkan"]}}</td> 



</tr>
@endforeach










</tbody>
</table>

            </div>
        </div>
    </div>
</div>
@endsection