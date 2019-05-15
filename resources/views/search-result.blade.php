@extends('layouts.app')

@section('content')

<div class="container">
    
<p> Jumlah carian : {{$total_count}}</p>
    <p> Carian <b> {{ $query }} </b> adalah :</p>
    

    @if(! $users->isEmpty())
      
    <h2>Maklumat pengguna</h2>
    <table class="table table-striped">
        <thead>
            <tr>
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
            </tr>
        </thead>
        <tbody>
            @foreach($permohonans as $permohonan)
            <tr>
            <td>{{$loop->iteration}}</td>
                <td>{{$permohonan->permohonan_id}}</td>
                <td>{{$permohonan->doc_title}}</td>
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
                <th>Dokumen permohonan</th>
                <th>Nama program/kursus</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokumens as $dokumen)
            <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$dokumen->permohonan_id}}</td>
            <td>{{$dokumen->file_name}}</td>
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
                <th>Laporan ID</th>
                <th>Nama fail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $laporan)
            <tr>
            <td>{{$laporan->laporan_id}}</td>
                <td>{{$laporan->tajuk_fail}}</td>
              
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif





</div>

@endsection