@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Semakan Kursus Elektif</div>

            <div class="card-body">
                     
                     

                        @csrf
                    

                        

                         <div class="form-group row">
                            <label for="doc_title" class="col-md-4 col-form-label text-md-right">{{ __('Tajuk Semakan') }}</label>

                            <div class="col-md-6">
                               
                                <input id="doc_title" type="text" value="{{ $permohonan->doc_title }}"  class="form-control" name="doc_title"  required autofocus readonly>
                               
                            </div>
                        </div>
                            

                        <div class="form-group row">
                            <label for="nama_penghantar" class="col-md-4 col-form-label text-md-right">{{ __('Nama penghantar') }}</label>

                            <div class="col-md-6">
                                <input id="nama_penghantar" type="text"  value="{{ $permohonan->user->name}}" class="form-control" name="nama_penghantar"  required autofocus readonly>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fakulti" class="col-md-4 col-form-label text-md-right">{{ __('Fakulti') }}</label>

                            <div class="col-md-6">
                                <input id="fakulti" type="text"  value="{{ $permohonan->user->fakulti}}" class="form-control" name="fakulti"  required autofocus readonly>

                               
                            </div>
                        </div>
                  

                        <div class="form-group row">
                            <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Tarikh dihantar') }}</label>

                            <div class="col-md-6">
                                <input id="created_at" type="text" value="{{ $permohonan->created_at}}" class="form-control" name="created_at"  required autofocus readonly>

                               
                            </div>
                        </div>



                              
                             
                        <div class="form-group row">
                             <label for="file_link" class="col-md-4 col-form-label text-md-right">{{ __('Link Kepada File') }}</label>

                                <div class="col-md-6">                       
                                                    
                               
                               
                                <!-- <a href ="<?php echo asset("storage/cadangan_permohonan_baharu/{{$permohonan->file_link}}")?>">{{ basename(@$permohonan[file_name]) }} </a> -->
                                <a href ="<?php echo asset("storage/cadangan_permohonan_baharu/{{$permohonan->file_link}}")?>">{{ basename($permohonan->file_name) }} </a>
                                </div>
                                
                        </div>
                                
              
                        <div class="form-group row mb-0">

                            <div class="col-md-6 offset-md-5">
                       
                            @if(Auth::user()->role == "pjk")

                             <a href="{{ route('pjk.perakuanLulus.show', ['permohonan' => $permohonan->id])  }}">
                                    <input type="button" class="btn btn-success" value="Lulus permohonan" />
                                    
                            </a> 
                                 
                            <a href="{{ route('pelantikan_penilai.show', ['permohonan' => $permohonan->id])  }}">
                                    <input type="button" class="btn btn-success" value="Lantik penilai" />
                                    
                            </a>
                                
                                
                            
                            <a href="{{ route('laporan.permohonanTidakDilulus', ['permohonan' => $permohonan->id])  }}">
                                    <input type="button" class="btn btn-danger" value="Penambahbaikan" />
                                    
                            </a>
                            
                            @elseif(Auth::user()->role=="penilai")
                            
                            <a href="/permohonans/{{$permohonan->id}}/kelulusan-permohonan">
                                    <input `type`="button" class="btn btn-success" value="Lulus permohonan" />
                                    
                            </a>
                            
                            <a href="{{ route('laporan.permohonanTidakDilulus', ['permohonan' => $permohonan->id])  }}">
                                    <input type="button" class="btn btn-danger" value="Penambahbaikan" />
                                    
                            </a>
                            
                            @endif   

                            </div>
                        </div>

                         <hr style="border-color:white;">
                        

                       
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- @if($errors->any())
        <div class="row collapse">
            <ul class="alert-box warning radius">
                @foreach($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
        @endif -->