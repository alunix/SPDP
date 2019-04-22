@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Memuat naik penambahbaikkan</div>

            <div class="card-body">
                 
                    
                     <form class="form-prevent-double-submits" method="POST" action="{{ route('dokumenPermohonan.penambahbaikkan.submit',['permohonan'=>$permohonan->permohonan_id])}}" enctype="multipart/form-data" >
                     
                        @csrf
                            <div class="form-group row">
                            <label for="doc_title" class="col-md-4 col-form-label text-md-right">{{ __('Tajuk Permohonan') }}</label>

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
                            <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Tarikh dihantar') }}</label>

                            <div class="col-md-6">
                                <input id="created_at" type="text" value="{{ $permohonan->created_at}}" class="form-control" name="created_at"  required autofocus readonly>

                               
                            </div>
                        </div> 
                        
                        
                         <div class="form-group row">
                            <label for="dokumen" class="col-md-4 col-form-label text-md-right">{{ __('Fail penambahbaikkan') }}</label>

                            <div class="col-md-6">
                                <input id="dokumen" type="file" class="form-control{{ $errors->has('dokumen') ? ' is-invalid' : '' }}" name="dokumen" value="{{ old('dokumen') }}" required autofocus>

                                @if ($errors->has('dokumen'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dokumen') }}</strong>
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

        <button type="submit" class="btn btn-success double-submit-prevent" value="accept-program" name="submitbutton">
        {{ __('Hantar') }}
        </button>

    </div>
</div>
<br>

                        

                        
         <table class="table table-striped">

<thead>
    <tr>
    <th scope="col">No/Versi</th>
    <th scope="col">Fail </th>
    <th scope="col">Saiz</th>
    <th scope="col">Komen</th>
    
    <th scope="col">Tarikh/Masa </th> 
    
    </tr>
</thead>
<tbody>
@if( ! $dps->isEmpty() )
@foreach($dps as $dp)
<tr>
<th scope="row">{{$dp->versi}}</th>
<td><a href ="<?php echo asset("storage/cadangan_permohonan_baharu/{$dp->file_link}")?>">{{ basename($dp->file_name) }} </a></td>  
<td> {{$dp->file_size}} KB</td> 
<td> {{$dp->komen}}</td> 
<td> {{$dp->created_at->format('h:i a d/m/Y')}} </td> 
  

              



</tr>
@endforeach

</tbody>
</table>

@else

<p> Tiada dokumen permohonan telah dijumpai</p>

@endif



    

                        

                        




 








 <hr style="border-color:white;">



</div>
</div>
</div>
</div>
</div>

@endsection