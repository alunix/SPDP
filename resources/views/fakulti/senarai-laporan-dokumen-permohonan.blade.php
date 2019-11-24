@extends('layouts.app')


@section('pageTitle', 'Senarai laporan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:65rem;">
                <div class="card-header" >Senarai laporan</div>

                <div class="card-body">
               
    <div class="container">
  

    <h5> Laporan yang telah dikeluarkan</h5>

<table class="table table-striped">

<thead>
    <tr>
    <th scope="col">No</th>
    <th scope="col">Laporan</th>
    <th scope="col">Dihantar</th>
    <th scope="col">Pihak</th>
    <th scope="col">Versi</th>
    <th scope="col">Tarikh/Masa Laporan</th> 
    
    </tr>
</thead>
<tbody>
@if( ! $laporans->isEmpty() )
@foreach($laporans as $laporan)
<tr>
<th scope="row">{{ $loop->iteration}}</th>
<td><a href ="<?php echo asset("storage/cadangan_permohonan_baharu/$laporan->tajuk_fail_link")?>">{{ basename($laporan->tajuk_fail_link) }}</td> </a>
<td> {{$laporan->id_penghantar_nama->name}}</td>
<td> {{$laporan->id_penghantar_nama->role}}</td>
<td> {{$laporan->versi}}</td>
<td> {{$laporan->created_at}}</td>


</tr>
@endforeach



</tbody>
</table>



@else

<p> Tiada laporan telah dikeluarkan</p>

@endif


                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection