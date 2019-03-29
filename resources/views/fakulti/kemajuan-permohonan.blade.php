@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:65rem;">
                <div class="card-header" >Kemajuan Permohonan</div>

                <div class="card-body">
               
    <div class="container">
 
   <h5>Permohonan ID :{{$permohonan->id}}</h5>
   <a class="btn icon-btn btn-info" href="{{ route('dokumenPermohonan.penambahbaikkan.show',$permohonan->permohonan_id) }}">
Muat naik penambahbaikkan
</a>
<br><br>
<h5>Dokumen yang telah dihantar</h5>

<table class="table table-striped">

<thead>
    <tr>
    <th scope="col">No</th>
    <th scope="col">Versi</th>
    <th scope="col">Dokumen</th>
    <th scope="col">Tarikh/Masa Penghantaran</th>
    
    
    </tr>
</thead>
<tbody>
@if( ! $dokumen_permohonans->isEmpty() )
@foreach($dokumen_permohonans as $dk)
<tr>
<th scope="row">{{ $loop->iteration}}</th>
<td> {{$dk->versi}}</td>   
<td><a href ="<?php echo asset("storage/cadangan_permohonan_baharu/$dk->file_link")?>">{{ basename($dk->file_name) }}</td> </a>
<td> {{$dk->created_at}}</td>             


</tr>
@endforeach



</tbody>
</table>



@else

<p> Tiada dokumen permohonna telah dihantar</p>

@endif





         <table class="table table-striped">

<thead>
    <tr>
    <th scope="col">No</th>
    <th scope="col">Status Permohonan</th>
    <th scope="col">Tarikh/Masa Status</th> 
    
    </tr>
</thead>
<tbody>
@if( ! $kjs->isEmpty() )
@foreach($kjs as $kj)
<tr>
<th scope="row">{{ $loop->iteration}}</th>
<td> {{$kj->statusPermohonan->status_permohonan_huraian}}</td>   
<td> {{$kj->created_at->format('h:i a d/m/Y') }}</td>               


</tr>
@endforeach



</tbody>
</table>



@else

<p> Tiada permohonan telah dijumpai </p>

@endif



<h5> Laporan yang telah dikeluarkan</h5>

<table class="table table-striped">

<thead>
    <tr>
    <th scope="col">No</th>
    <th scope="col">Laporan PJK</th>
    <th scope="col">Laporan Panel Penilai</th>
    <th scope="col">Laporan JPPA</th>
    <th scope="col">Laporan Senat</th>
    <th scope="col">Tarikh/Masa Laporan</th> 
    
    </tr>
</thead>
<tbody>
@if( ! $kjs->isEmpty() )
@foreach($kjs as $kj)
<tr>
<th scope="row">{{ $loop->iteration}}</th>
<td> {{$kj->statusPermohonan->status_permohonan_huraian}}</td>   
<td> {{$kj->created_at->format('h:i a d/m/Y') }}</td>               


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