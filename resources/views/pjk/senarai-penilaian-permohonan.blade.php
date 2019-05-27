@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Senarai penilaian permohonan</div>

            <div class="card-body" style="width:500px;">
    
                  
            
                        <table class="table table-striped">                  
                        

                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Jenis permohonan</th>
                            <th scope="col">Tajuk Dokumen</th>
                            <th scope="col">PJK</th>
                            <th scope="col">Panel Penilai</th>                          
                            <th scope="col">JPPA</th>
                            <th scope="col">Senat</th>


                            
                            </tr>
                        </thead>
                        <tbody>
                       
                        @if( ! $penilaians->isEmpty() )

                       
        @foreach($penilaians as $penilaian)
            <tr>
                 {{--<th scope="row"><a href="/permohonans/{permohonan}/lampiran-pusat-jaminan-kualiti/{penilaian}">{{ $penilaian->id }}</th>--}}
                 
                 @if(Auth::user()->role == "pjk")
                <th scope="row"><a href="/penilaian/{{$penilaian->id}}">{{ $penilaian->id }}</th>
                
                @elseif(Auth::user()->role=="jppa")
                <th scope="row"><a href="/jppa/penilaian/{{$penilaian->id}}">{{ $penilaian->id }}</th>
                @endif
                
                <th scope="row>">{{$penilaian->permohonan->jenis_permohonan->jenis_permohonan_huraian}}</th>
                <th scope="row>">{{$penilaian->permohonan->doc_title}}</th>
                <th scope="row">{{ $penilaian->pjk->name }}</th>
               <th scope="row">{{ $penilaian->panel_penilai->name}}</th>           
                <th scope="row">{{ $penilaian->jppa }}</th>
                <th scope="row">{{ $penilaian->senat}}</th>
            </tr>
        @endforeach
        @else
            No penilaian are found

    @endif
    </tbody>
                        </table>

                         <hr style="border-color:white;">
                        
                </div>
            </div>
        </div>
    </div>
</div>

@endsection