@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Permohonan Baharu</div>

            <div class="card-body">
                    <form method="POST" action="{{ route('program.page.submit') }}" enctype="multipart/form-data">
                        @csrf
                        


                        <div class="form-group row">
                            <label for="lecturer_name" class="col-md-4 col-form-label text-md-right">{{ __('Penghantar') }}</label>

                            <div class="col-md-6">
                                <input id="lecturer_name" type="text" class="form-control" name="lecturer_name" value="{{ Auth::user()->name }}" required autofocus readonly>

                               
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="fakulti" class="col-md-4 col-form-label text-md-right">{{ __('Fakulti') }}</label>

                            <div class="col-md-6">
                                <input id="fakulti" type="text" class="form-control{{ $errors->has('fakulti') ? ' is-invalid' : '' }}" name="fakulti" value="{{ old('fakulti') }}" required autofocus>

                                @if ($errors->has('fakulti'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fakulti') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group row">
                            <label for="jenis_permohonan_id" class="col-md-4 col-form-label text-md-right">{{ __('Jenis permohonan') }}</label>

                            <div class="col-md-6">
                            <select class=”form-control” name='jenis_permohonan_id' style="width:330px;" id='jenis_permohonan_id'>
                                
                                <option value=#>Sila pilih</option>
                                <option value=1>Program Pengajian Baru</option>
                                <option value=2>Semakan Program Pengajian</option>
                                <option value=3>Kursus Baru</option>
                                <option value=4>Semakan Kursus</option>
                                <option value=5>Akreditasi Penuh/Audit Pemantauan</option>
                                <option value=6>Penjumudan Program Pengajian</option>
                            </select>
                            </div>
                        </div>


                         <div class="form-group row">
                            <label for="doc_title" class="col-md-4 col-form-label text-md-right">{{ __('Nama program/kursus') }}</label>

                            <div class="col-md-6">
                                <input id="doc_title" type="text" class="form-control{{ $errors->has('doc_title') ? ' is-invalid' : '' }}" name="doc_title" value="{{ old('doc_title') }}" required autofocus>

                                @if ($errors->has('doc_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('doc_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="versi_dokumen" class="col-md-4 col-form-label text-md-right">{{ __('Versi') }}</label>

                            <div class="col-md-6">
                                <input id="versi_dokumen" type="text" class="form-control{{ $errors->has('versi_dokumen') ? ' is-invalid' : '' }}" name="versi_dokumen" value="1.0" required autofocus readonly>

                                @if ($errors->has('versi_dokumen'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('versi_dokumen') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->


                        <div class="form-group row">
                            <label for="file_link" class="col-md-4 col-form-label text-md-right">{{ __('Muat naik dokumen(fail pdf)') }}</label>

                            <div class="col-md-6">
                                <input id="file_link" type="file" class="form-control{{ $errors->has('file_link') ? ' is-invalid' : '' }}" name="file_link" value="{{ old('file_link') }}" required autofocus>

                                @if ($errors->has('file_link'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file_link') }}</strong>
                                    </span>
                                @endif
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