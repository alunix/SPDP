@extends('layouts.app')
@section('pageTitle', 'Carian')
@section('content')

<div class="container">
    
<p> Jumlah carian : {{$total_count}}</p>
    <p> Carian <b> {{ $query }} </b> adalah :</p>

    <div class="row">
    <div class="col-md-12">
    <form class="au-form-icon--sm" action="/search" method="post">
                                @csrf    
                                <input class="au-input--w300 au-input--style2" type="text" name="input-search" placeholder="Cari permohonan & laporan">
                                    <button class="au-btn--submit2" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
    </form>
    </div>
    </div>

    @if(! $users->isEmpty())
      
    <h2>Maklumat pengguna</h2>
    <table class="table table-striped">
        <thead>
            <tr>   
                <th>No</th>
                <th>Nama</th>
                <th>E-mel</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr> 
            <td>{{$loop->iteration}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @if(! $permohonans->isEmpty())
     
    <h2>Maklumat permohonan</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Permohonan ID</th>
                <th>Nama program/kursus</th>
                <th>Permohonan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permohonans as $permohonan)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$permohonan->permohonan_id}}</td>
                <td>{{$permohonan->doc_title}}</td>
                <td><a href="{{ route('view-permohonan-baharu',$permohonan->permohonan_id) }}" class="btn btn-primary">SELECT</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <br>

    @if(! $dokumens->isEmpty())
       
    <h2>Dokumen permohonan</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Dokumen permohonan</th>
                <th>Tajuk dokumen</th>
                <th>Dokumen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokumens as $dokumen)
            <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$dokumen->permohonan_id}}</td>
            <td>{{$dokumen->file_name}}</td>
            <td><a href ="<?php echo asset("storage/cadangan_permohonan_baharu/$dokumen->file_link")?>">{{ basename($dokumen->file_name) }}</td></a>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <br>
    @if(! $laporans->isEmpty())
    <h2>Maklumat laporan</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Laporan ID</th>
                <th>Nama fail</th>
                <th>Fail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $laporan)
            <tr>
            <td>{{$laporan->laporan_id}}</td>
            <td>{{$laporan->tajuk_fail}}</td>
            <td><a href ="<?php echo asset("storage/laporan/$laporan->tajuk_fail_link")?>">{{ basename($laporan->tajuk_fail_link) }}</a></td>

              
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif





</div>

@endsection