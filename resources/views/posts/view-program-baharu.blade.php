@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Permohonan Program Pengajian Baharu </div>

            <div class="card-body">
                    <!-- <form method="POST" action="{{ route('program.page.submit') }}" enctype="multipart/form-data">
                        @csrf -->  

                        <!-- disable for now, will add later for post action -->

                         <div class="form-group row">
                            <label for="doc_title" class="col-md-4 col-form-label text-md-right">{{ __('Tajuk Dokumen') }}</label>

                            <div class="col-md-6">
                                <input id="doc_title" type="text" value="{{ old('doc_title', $program->doc_title)}}" class="form-control" name="doc_title"  required autofocus readonly>

                               
                            </div>
                        </div>
                            

                        <div class="form-group row">
                            <label for="lecturer_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Ketua Fakulti') }}</label>

                            <div class="col-md-6">
                                <input id="lecturer_name" type="text" value="{{ old('lecturer_name', $program->lecturer_name)}}" class="form-control" name="lecturer_name"  required autofocus readonly>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fakulti" class="col-md-4 col-form-label text-md-right">{{ __('Fakulti') }}</label>

                            <div class="col-md-6">
                                <input id="fakulti" type="text" value="{{ old('fakulti', $program->fakulti)}}" class="form-control" name="fakulti"  required autofocus readonly>

                               
                            </div>
                        </div>
                  

                        <div class="form-group row">
                            <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Tarikh dihantar') }}</label>

                            <div class="col-md-6">
                                <input id="created_at" type="text" value="{{ old('created_at', $program->created_at)}}" class="form-control" name="created_at"  required autofocus readonly>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="updated_at" class="col-md-4 col-form-label text-md-right">{{ __('Tarikh dikemaskini') }}</label>

                            <div class="col-md-6">
                                <input id="updated_at" type="text" value="{{ old('updated_at', $program->created_at)}}" class="form-control" name="updated_at"  required autofocus readonly>

                               
                            </div>
                        </div>

                              </div>

                        <div class="form-group row">
                             <label for="file_link" class="col-md-4 col-form-label text-md-right">{{ __('Link Kepada File') }}</label>

                                <div class="col-md-6">
                                <a href ="<?php echo asset("storage/cadangan_program_baharu/$program->file_link")?>">{{ basename($program->file_name) }} </a>
                        </div>
                                </div>

                     

                        

                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Hantar') }}
                                </button>
                            </div>
                        </div>

                         <hr>                           

                        

                       
                
            </div>
        </div>
    </div>
</div>
@endsection