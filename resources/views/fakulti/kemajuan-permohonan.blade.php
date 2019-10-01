@extends('layouts.app')
@section('pageTitle', 'Kemajuan permohonan')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="au-breadcrumb-content">
            <div class="au-breadcrumb-left">
                <div class="overview-wrap">
                <h2 class="title-1">kemajuan permohonan</h2>
                </div>
            </div>
            <div class="row">
            <form class="au-form-icon--sm" action="/search" method="post">
                @csrf    
                <input class="au-input--w300 au-input--style2" type="text" name="input-search" placeholder="Cari kemajuan permohonan">
                    <button class="au-btn--submit2" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </form>
                &nbsp;
            @if(($permohonan->status_permohonan_id == 8 or $permohonan->status_permohonan_id == 9 or $permohonan->status_permohonan_id == 10 or $permohonan->status_permohonan_id == 11  ) and (Auth::user()->role == "fakulti"))
            <a class="btn icon-btn btn-info" style="font-size:14px" href="{{ route('dokumenPermohonan.penambahbaikkan.show',$permohonan->permohonan_id) }}">
            Muat naik penambahbaikkan
            </a>
            <br><br>
            @else
            @endif
            </div>
        </div>
    </div>                           
</div>
<hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:65rem;">
        <div class="card-header" >Kemajuan Permohonan</div>
        <div class="card-body">
<div class="container">
<h5>Permohonan ID :{{$permohonan->id}}</h5>
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
<p> Tiada kemajuan permohonan </p>
@endif
<h5> Semua laporan yang telah dikeluarkan</h5>
<table class="table table-striped">
<thead>
    <tr>
    <th scope="col">No</th>
    <th scope="col">Laporan</th>
    <th scope="col">Dihantar</th>
    <th scope="col">Pihak</th>
    <th scope="col">Komen</th>
    <th scope="col">Versi</th>
    <th scope="col">Tarikh/Masa Laporan</th>
    </tr>
</thead>
<tbody>
@if( ! $laporans->isEmpty() )
@foreach($laporans as $laporan)
<tr>
<th scope="row">{{ $loop->iteration}}</th>
<td><a href ="<?php echo asset("storage/laporan/$laporan->tajuk_fail_link")?>">{{ basename($laporan->tajuk_fail_link) }}</a></td>
<td> {{$laporan->id_penghantar_nama->name}}</td>
<td> {{$laporan->id_penghantar_nama->role}}</td>
<td> {{$laporan->komen}}</td>
<td> {{$laporan->versi_laporan}}</td>
<td> {{$laporan->created_at->format('h:i a d/m/Y') }}</td>
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