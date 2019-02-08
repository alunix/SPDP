@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Senarai penilaian program </div>

            <div class="card-body" style="width:500px;">
        {{--<form method="GET" action="{{ ['program' => $program->id,'penilaian'=>$penilaian->id]}}" >  --}}
                  
            
                        <table class="table table-striped">                  
                        

                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Jenis permohonan</th>
                            <th scope="col">Tajuk Dokumen</th>
                            <th scope="col">PJK</th>
                            <th scope="col">Panel Penilai Pertama</th>                          
                            <th scope="col">JPPA</th>
                            <th scope="col">Senat</th>


                            
                            </tr>
                        </thead>
                        <tbody>
                       
                        @if( ! $penilaians->isEmpty() )

                       
        @foreach($penilaians as $penilaian)
            <tr>
               <th scope="row"><a href="/jppa/penilaian/{{$penilaian->id}}">{{ $penilaian->id }}</th>
                <th scope="row>">{{$penilaian->permohonan->jenis_permohonan->jenis_permohonan_huraian}}</th>
                <th scope="row>">{{$penilaian->permohonan->doc_title}}</th>
                <th scope="row">{{ $penilaian->pjk->name }}</th>
                <th scope="row">{{ $penilaian->panel_penilai->name}}</th>               
                <th scope="row">{{ $penilaian->jppa->name }}</th>
                <th scope="row">{{ $penilaian->senat->name}}</th>
            </tr>
        @endforeach

        @forelse ($penilaianss as $penilaian)
                <li>{{ $penilaian->panel_penilai->name }}</li>
        @empty
                <p></p>
        @endforelse



        @else
            No penilaian are found

    @endif
    </tbody>
                        </table>

                        

                        

                         
              
                        <!-- <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                       
                                <button type="submit" class="btn btn-success" value="accept-program" name="submitbutton">
                                {{ __('Hantar') }}
                                </button>
                                
                               
                             

                            </div>
                        </div> -->

                        
                        

                     
                      

                         <hr style="border-color:white;">
                        

                       
                </div>
            </div>
        </div>
    </div>
</div>

@endsection