@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Permohonan Tidak Dilulus </div>

            <div class="card-body">
                 
                    
                     <form method="POST" action="{{ route('pjk.permohonanTidakDilulus.submit',['permohonan'=>$permohonan->id])}}" enctype="multipart/form-data" >
                     {!! method_field('patch') !!}     

                        @csrf
        
                        <div class="form-group row">
                            <label for="doc_title" class="col-md-4 col-form-label text-md-right">{{ __('Tajuk Program') }}</label>

                            <div class="col-md-6">
                              
                                <input id="doc_title" type="text" value="{{ $permohonan->doc_title }}"  class="form-control" name="doc_title"  required autofocus readonly>
                               
                            </div>
                        </div>
                  

                        <div class="form-group row">
                            <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Tarikh dihantar') }}</label>

                            <div class="col-md-6">
                                <input id="created_at" type="text" value="{{ $permohonan->created_at}}" class="form-control" name="created_at"  required autofocus readonly>

                               
                            </div>
                        </div> 
                              

                        <div class="form-group row">
                             
                            <label for="file_link" class="col-md-4 col-form-label text-md-right">{{ __('Lampiran permohonan program') }}</label>

                            <div class="col-md-6">
                                
                            <a href ="<?php echo asset("storage/cadangan_permohonan_baharu/{$permohonan->dokumen_permohonan()->file_link}")?>">{{ basename($permohonan->dokumen_permohonan()->file_name) }} </a> 

                            </div>

                        </div>
                        

                       

    <div class="form-group row mb-0">
    <div class="col-md-6 offset-md-5">

        <button type="submit" class="btn btn-success" value="accept-program" name="submitbutton">
        {{ __('Hantar') }}
        </button>
        
       
     

    </div>
</div>

 <hr style="border-color:white;">


</div>
</div>
</div>
</div>
</div>

@endsection