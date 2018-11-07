@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pelantikan Panel Penilai </div>

            <div class="card-body">
                      {{--<form method="POST" action="{{ route('pelantik_penilai.submit',['program' => $program->id])}}" enctype="multipart/form-data" > --}}
                     {{--<form method="POST" action="{{ route('program.show.submit')}}" enctype="multipart/form-data" > --}}
                    
                     <form method="POST" action="{{ route('pelantikan_penilai.submit',['program' => $program->id])}}" >
                     {!! method_field('patch') !!}                 
                


                        @csrf

                            
        
                            <div class="form-group row">
                            <label for="doc_title" class="col-md-4 col-form-label text-md-right">{{ __('Tajuk Program') }}</label>

                            <div class="col-md-6">
                                {{--<input id="doc_title" type="text" value="{{ old('doc_title', $program->doc_title)}}" class="form-control" name="doc_title"  required autofocus readonly>--}}
                                <input id="doc_title" type="text" value="{{ @$program['doc_title'] }}"  class="form-control" name="doc_title"  required autofocus readonly>
                               
                            </div>
                        </div>
                            

                        <div class="form-group row">
                            <label for="lecturer_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Ketua Fakulti') }}</label>

                            <div class="col-md-6">
                                <input id="lecturer_name" type="text"  value="{{ @$program['lecturer_name']}}" class="form-control" name="lecturer_name"  required autofocus readonly>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fakulti" class="col-md-4 col-form-label text-md-right">{{ __('Fakulti') }}</label>

                            <div class="col-md-6">
                                <input id="fakulti" type="text"  value="{{ @$program['fakulti']}}" class="form-control" name="fakulti"  required autofocus readonly>

                               
                            </div>
                        </div>
                  

                        <div class="form-group row">
                            <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Tarikh dihantar') }}</label>

                            <div class="col-md-6">
                                <input id="created_at" type="text" value="{{ @$program['created_at']}}" class="form-control" name="created_at"  required autofocus readonly>

                               
                            </div>
                        </div> 



                              

                         <div class="form-group row">
                             <label for="file_link" class="col-md-4 col-form-label text-md-right">{{ __('Link Kepada File') }}</label>

                                <div class="col-md-6">
                                <a href ="<?php echo asset("storage/cadangan_program_baharu/$program->file_link")?>">{{ basename($program->file_name) }} </a>
                                </div>

                        </div>   

                        

                        <table class="table table-striped">

<thead>
    <tr>
    <th scope="col">No</th>
    <th scope="col">Nama</th>
    <th scope="col">Email</th>
    <th scope="col">Pelantikan</th>


    
    </tr>
</thead>
<tbody>
@if( ! $users->isEmpty() )
@foreach($users as $user)
<tr>
<th scope="row">{{ $user->id }}</th>
<td>{{ $user->name }}</td>               
<td>{{ $user->email }}</td>
<td> <input type="checkbox" name="checked[]" value="{{ $user->id }}"> </td> 
</tr>
@endforeach
@endif
</tbody>
</table>



 

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