@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

           
                <div class="card-header">Lampiran laporan panel penilai </div>         

            <div class="card-body">
                 
                    
                     <form  class="form-prevent-double-submits"  method="POST" action="{{ route('penilai.laporan.submit',['permohonan' => $permohonan->permohonan_id,'penilaian'=>$penilaian->id])}}" enctype="multipart/form-data" >
                     {!! method_field('patch') !!}                 
                


                        @csrf

                            
        
                            <div class="form-group row">
                            <label for="doc_title" class="col-md-4 col-form-label text-md-right">{{ __('Tajuk permohonan') }}</label>

                            <div class="col-md-6">
                                
                                <input id="doc_title" type="text" value="{{ $permohonan->doc_title }}"  class="form-control" name="doc_title"  required autofocus readonly>
                               
                            </div>
                        </div>
                            

                        <div class="form-group row">
                            <label for="lecturer_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Ketua Fakulti') }}</label>

                            <div class="col-md-6">
                                <input id="lecturer_name" type="text"  value="{{ $permohonan->user->name}}" class="form-control" name="lecturer_name"  required autofocus readonly>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fakulti" class="col-md-4 col-form-label text-md-right">{{ __('Fakulti') }}</label>

                            <div class="col-md-6">
                                <input id="fakulti" type="text"  value="{{ $permohonan->user->fakulti->f_nama}}" class="form-control" name="fakulti"  required autofocus readonly>

                               
                            </div>
                        </div>
                  

                        <div class="form-group row">
                            <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Tarikh dihantar') }}</label>

                            <div class="col-md-6">
                                <input id="created_at" type="text" value="{{$permohonan->created_at}}" class="form-control" name="created_at"  required autofocus readonly>

                               
                            </div>
                        </div> 



                              

                         <div class="form-group row">
                             <label for="file_link" class="col-md-4 col-form-label text-md-right">{{ __('Link Kepada File') }}</label>

                                <div class="col-md-6">
                                <a href ="<?php echo asset("storage/cadangan_permohonan_baharu/{$permohonan->dokumen_permohonan()->file_link}")?>">{{ basename($permohonan->dokumen_permohonan()->file_name) }} </a>
                                </div>

                        </div>

                        
                      <div class="form-group row">
                            <label for="laporan_panel_penilai" class="col-md-4 col-form-label text-md-right">{{ __('Lampiran laporan panel penilai') }}</label>

                            <div class="col-md-6">
                                <input id="laporan_panel_penilai" type="file" class="form-control{{ $errors->has('laporan_panel_penilai') ? ' is-invalid' : '' }}" name="laporan_panel_penilai" value="{{ old('laporan_panel_penilai') }}" required autofocus>

                                @if ($errors->has('laporan_panel_penilai'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('laporan_panel_penilai') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group row">
                        <label for="summary-ckeditor" class="col-md-4 col-form-label text-md-right">{{ __('Komen(Tidak diwajibkan)') }}</label>

                        <div class="col-md-6">
                        <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea>
                        </div>
                        
                        </div>

 

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-5">

        <button type="submit" class="btn btn-success double-submit-prevent" value="accept-permohonan" name="submitbutton">
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