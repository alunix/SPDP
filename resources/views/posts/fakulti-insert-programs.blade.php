@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Penyediaan Dokumen Program Baharu Akreditasi Sementara</div>

            <div class="card-body">
                    <form method="POST" action="{{ route('program.page.submit') }}" enctype="multipart/form-data">
                        @csrf
                        


                        <div class="form-group row">
                            <label for="lecturer_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Ketua Fakulti') }}</label>

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
                            <label for="doc_title" class="col-md-4 col-form-label text-md-right">{{ __('Document title') }}</label>

                            <div class="col-md-6">
                                <input id="doc_title" type="text" class="form-control{{ $errors->has('doc_title') ? ' is-invalid' : '' }}" name="doc_title" value="{{ old('doc_title') }}" required autofocus>

                                @if ($errors->has('doc_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('doc_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        

                        <div class="form-group row">
                            <label for="file_link" class="col-md-4 col-form-label text-md-right">{{ __('Link PDF') }}</label>

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

<h4> Program yang dihantar  </h4>
<hr>



         <table class="table table-striped">

<thead>
    <tr>
    <th scope="col">Permohonan ID</th>
    <th scope="col">Tajuk</th>
    <th scope="col">Nama</th>
    <th scope="col">Fakulti</th>
    <th scope="col">File</th>
    <th scope="col">Status</th>
    <th scope="col">Tarikh</th>
    


    
    </tr>
</thead>
<tbody>
@if( ! $programs->isEmpty() )
@foreach($programs as $program)
<tr>
<th scope="row">{{$program->id}}</th>
<td> {{$program->doc_title}}</td>               
<td>{{$program->lecturer_name}}</td>
<td>{{$program->fakulti}}</td>
<td> <a href ="<?php echo asset("storage/cadangan_program_baharu/$program->file_link")?>">{{ basename($program->file_name) }}</td>
<td>{{$program->status_program}} </td>
<td> {{$program->created_at}}</td>

</tr>
@endforeach

</tbody>
</table>



@else

<p> Tiada cadangan program telah dijumpai </p>

@endif




                        

                         

                        

                       
                
            </div>
        </div>
    </div>
</div>
@endsection