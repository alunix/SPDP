@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tetapan profil</div>

            <div class="card-body">
            <form class="form-prevent-double-submits" method="POST" action="{{ route('settings.submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"  value="{{ @$user->name}}" class="form-control" name="name"  required autofocus readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text"  value="{{$user->email}}" class="form-control" name="email"  required autofocus >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fakulti" class="col-md-4 col-form-label text-md-right">{{ __('Fakulti') }}</label>

                            <div class="col-md-6">
                            <select class=”form-control” name='fakulti' style="width:330px;" id='fakulti'>
                                
                            <option value="FSSK">FSSK-Fakulti Sains Sosial dan Kemanusiaan</option>
                                    <option value="FST">FST-Fakulti Sains dan Teknologi</option>
                                    <option value="FEP">FEP-Fakulti Ekonomi dan Pengurusan</option>
                                    <option value="FARMASI">Farmasi-Fakulti Farmasi</option>
                                    <option value="FPI">FPI-Fakulti Pengajian Islam</option>
                                    <option value="FSK">FSK-Fakulti Sains Kesihatan</option>
                                    <option value="JURUTERA">FKAB-Fakulti Kejuruteraan dan Alam Bina</option>
                                    <option value="FUU">FUU-Fakulti Undang-Undang</option>
                                    <option value="FPERG">FPERG-Fakulti Pergigian</option>
                                    <option value="FPENDIDIKAN">FPEND-Fakulti Pendidikan</option>
                                    <option value="PPUKM">FPER-Fakulti Perubatan</option>
                                    <option value="FTSM">FTSM-Fakulti Teknologi dan Sains Maklumat</option>
                                    <option value="GSB">GSB-UKM-GSB Pusat Pengajian Siswazah Perniagaan</option>
                            </select>
                            </div>
                        </div>

                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary double-submit-prevent">
                                    {{ __('Kemaskini') }}
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

