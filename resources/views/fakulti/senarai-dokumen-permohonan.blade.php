@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:65rem;">
                <div class="card-header" >Senarai dokumen permohonan</div>

                <div class="card-body">
               
    <div class="container">
  

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

<p> Tiada dokumen permohonan telah dihantar</p>

@endif

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection