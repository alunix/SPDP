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
                            <th scope="col">Penilaian ID</th>
                            <th scope="col">Tajuk Dokumen</th>
                            <th scope="col">Kelulusan PJK</th>
                            <th scope="col">Kelulusan Panel Penilai Pertama</th>                          
                            <th scope="col">Kelulusan JPPA</th>
                            <th scope="col">Kelulusan Senat</th>


                            
                            </tr>
                        </thead>
                        <tbody>
                       
                        @if( ! $penilaians->isEmpty() )

                       
        @foreach($penilaians as $penilaian)
            <tr>
                 {{--<th scope="row"><a href="/programs/{program}/lampiran-pusat-jaminan-kualiti/{penilaian}">{{ $penilaian->id }}</th>--}}
                 
                 @if(Auth::user()->type == "pjk")
                <th scope="row"><a href="/penilaian/{{$penilaian->id}}">{{ $penilaian->id }}</th>
                
                @elseif(Auth::user()->type=="jppa")
                <th scope="row"><a href="/jppa/penilaian/{{$penilaian->id}}">{{ $penilaian->id }}</th>
                @endif

                <th scope="row>">{{$penilaian->program['doc_title']}}</th>
                <th scope="row">{{ $penilaian->penilaian_pjk }}</th>
                <th scope="row">{{ $penilaian->penilaian_panel_1}}</th>               
                <th scope="row">{{ $penilaian->jppa }}</th>
                <th scope="row">{{ $penilaian->senat}}</th>
            </tr>
        @endforeach
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