@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lampiran Perakuan Senat </div>

            <div class="card-body">
                 
                    
                     <form method="POST" action="{{ route('senat.perakuan.submit',['penilaian'=>$penilaian->id])}}" enctype="multipart/form-data" >
                     {!! method_field('patch') !!}                 
                


                        @csrf

                            
        
                            <div class="form-group row">
                            <label for="doc_title" class="col-md-4 col-form-label text-md-right">{{ __('Tajuk Program') }}</label>

                            <div class="col-md-6">
                                {{--<input id="doc_title" type="text" value="{{ old('doc_title', $program->doc_title)}}" class="form-control" name="doc_title"  required autofocus readonly>--}}
                                <input id="doc_title" type="text" value="{{ $penilaian->program['doc_title'] }}"  class="form-control" name="doc_title"  required autofocus readonly>
                               
                            </div>
                        </div>
                            

                        <div class="form-group row">
                            <label for="lecturer_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Ketua Fakulti') }}</label>

                            <div class="col-md-6">
                                <input id="lecturer_name" type="text"  value="{{$penilaian->program['lecturer_name']}}" class="form-control" name="lecturer_name"  required autofocus readonly>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fakulti" class="col-md-4 col-form-label text-md-right">{{ __('Fakulti') }}</label>

                            <div class="col-md-6">
                                <input id="fakulti" type="text"  value="{{ $penilaian->program['fakulti']}}" class="form-control" name="fakulti"  required autofocus readonly>

                               
                            </div>
                        </div>
                  

                        <div class="form-group row">
                            <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Tarikh dihantar') }}</label>

                            <div class="col-md-6">
                                <input id="created_at" type="text" value="{{ $penilaian->program['created_at']}}" class="form-control" name="created_at"  required autofocus readonly>

                               
                            </div>
                        </div> 



                              

                        <div class="form-group row">
                             
                             <label for="file_link" class="col-md-4 col-form-label text-md-right">{{ __('Lampiran permohonan program') }}</label>

                                <div class="col-md-6">

                                
                                <a href ="<?php echo asset("storage/cadangan_program_baharu/{$penilaian->program['file_link']}")?>">{{ basename($penilaian->program['file_name']) }} </a> 

                                
                                

                                </div>

                        </div>

                        <div class="form-group row">
                            <label for="laporan_panel_penilai" class="col-md-4 col-form-label text-md-right">{{ __('Lampiran laporan panel penilai') }}</label>

                            <div class="col-md-6">
                                <a href ="<?php echo asset("storage/laporan_panel_penilai/$penilaian->laporan_panel_penilai_link")?>">{{ basename($penilaian->laporan_panel_penilai) }} </a>
                            </div>

                        </div> 

                         <div class="form-group row">
                            <label for="perakuan_pjk" class="col-md-4 col-form-label text-md-right">{{ __('Lampiran perakuan PJK') }}</label>
                            
                            <div class="col-md-6">
                                <a href ="<?php echo asset("storage/perakuan_pjk/$penilaian->perakuan_pjk_link")?>">{{ basename($penilaian->perakuan_pjk) }} </a>
                            </div>

                        </div> 

                        
                        <div class="form-group row">
                            <label for="perakuan_jppa" class="col-md-4 col-form-label text-md-right">{{ __('Lampiran perakuan JPPA') }}</label>
                            
                            <div class="col-md-6">
                                <a href ="<?php echo asset("storage/perakuan_jppa/$penilaian->perakuan_jppa_link")?>">{{ basename($penilaian->perakuan_jppa) }} </a>
                            </div>

                        </div> 

                         <div class="form-group row">
                            <label for="perakuan_senat" class="col-md-4 col-form-label text-md-right">{{ __('Lampiran perakuan Senat') }}</label>

                            <div class="col-md-6">
                                <input id="perakuan_senat" type="file" class="form-control{{ $errors->has('perakuan_senat') ? ' is-invalid' : '' }}" name="perakuan_senat" value="{{ old('perakuan_senat') }}" required autofocus>

                                @if ($errors->has('perakuan_senat'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('perakuan_senat') }}</strong>
                                    </span>
                                @endif
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

<!-- @if ($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
@endif -->

@endsection

