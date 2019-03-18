@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lampiran Perakuan JPPA </div>

            <div class="card-body">
                 
                    
                     <form method="POST" action="{{ route('jppa.perakuan.submit',['permohonan'=>$permohonan->id])}}" enctype="multipart/form-data" >
                     {!! method_field('patch') !!}                 
                


                        @csrf

                            
        
                            <div class="form-group row">
                            <label for="doc_title" class="col-md-4 col-form-label text-md-right">{{ __('Tajuk permohonan') }}</label>

                            <div class="col-md-6">
                               
                                <input id="doc_title" type="text" value="{{ $permohonan->doc_title }}"  class="form-control" name="doc_title"  required autofocus readonly>
                               
                            </div>
                        </div>
                            

                        <div class="form-group row">
                            <label for="nama_penghantar" class="col-md-4 col-form-label text-md-right">{{ __('Nama Penghantar') }}</label>

                            <div class="col-md-6">
                                <input id="nama_penghantar" type="text"  value="{{$permohonan->user->name}}" class="form-control" name="nama_penghantar"  required autofocus readonly>

                               
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="fakulti" class="col-md-4 col-form-label text-md-right">{{ __('Fakulti') }}</label>

                            <div class="col-md-6">
                                <input id="fakulti" type="text"  value="{{$permohonan->user->fakulti}}" class="form-control" name="fakulti"  required autofocus readonly>

                               
                            </div>
                        </div>
                  

                        <div class="form-group row">
                            <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Tarikh dihantar') }}</label>

                            <div class="col-md-6">
                                <input id="created_at" type="text" value="{{ $permohonan->created_at}}" class="form-control" name="created_at"  required autofocus readonly>

                               
                            </div>
                        </div> 



                              

                        <div class="form-group row">
                             
                             <label for="file_link" class="col-md-4 col-form-label text-md-right">{{ __('Lampiran permohonan') }}</label>

                                <div class="col-md-6">

                                
                                <a href ="<?php echo asset("storage/cadangan_permohonan_baharu/{$permohonan->file_link}")?>">{{ basename($permohonan->file_name) }} </a> 

                                
                                

                                </div>

                        </div>

                        @if($permohonan->penilaian->laporan->laporan_panel_penilai_link!=null)
                        <div class="form-group row">
                            <label for="laporan_panel_penilai" class="col-md-4 col-form-label text-md-right">{{ __('Lampiran laporan panel penilai') }}</label>

                            <div class="col-md-6">
                            <a href ="<?php echo asset("storage/laporan_panel_penilai/{$permohonan->penilaian->laporan->laporan_panel_penilai_link}")?>">{{ basename($permohonan->penilaian->laporan->laporan_panel_penilai) }} </a>
                            </div>

                        </div> 

                         <div class="form-group row">
                            <label for="perakuan_pjk" class="col-md-4 col-form-label text-md-right">{{ __('Lampiran perakuan PJK') }}</label>
                            
                            <div class="col-md-6">
                                
                                <a href ="<?php echo asset("storage/laporan_pjk/{$permohonan->penilaian->laporan->perakuan_pjk_link}")?>">{{ basename($permohonan->penilaian->laporan->perakuan_pjk) }} </a>
                            </div>

                        </div> 
                        @endif   

                         <div class="form-group row">
                            <label for="perakuan_jppa" class="col-md-4 col-form-label text-md-right">{{ __('Lampiran perakuan JPPA') }}</label>

                            <div class="col-md-6">
                                <input id="perakuan_jppa" type="file" class="form-control{{ $errors->has('perakuan_jppa') ? ' is-invalid' : '' }}" name="perakuan_jppa" value="{{ old('perakuan_jppa') }}" required autofocus>

                                @if ($errors->has('perakuan_jppa'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('perakuan_jppa') }}</strong>
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

      <div class="col-md-6 offset-md-5">
            <button type="submit" class="btn btn-danger" value="accept-program" name="submitbutton">
            {{ __('Tidak lulus') }}
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

