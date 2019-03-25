@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Memuat naik penambahbaikkan</div>

            <div class="card-body">
                 
                    
                     <form method="POST" action="{{ route('pjk.perakuanLulus.submit',['permohonan'=>$permohonan->id])}}" enctype="multipart/form-data" >
                     {!! method_field('patch') !!} 
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
                  

                        @if( ! empty($penilaian['perakuan_pjk']))

                            
                            <div class="form-group row">
                            <label for="perakuan_pjk" class="col-md-4 col-form-label text-md-right">{{ __('Fail penambahbaikkan') }}</label>

                            <div class="col-md-6">
                                <a href ="<?php echo asset("storage/perakuan_pjk/$penilaian->perakuan_pjk_link")?>">{{ basename($penilaian->perakuan_pjk) }} </a>
                            </div>

                        </div> 

                       
                        
                        
                        @else
                         <div class="form-group row">
                            <label for="perakuan_pjk" class="col-md-4 col-form-label text-md-right">{{ __('Fail penambahbaikkan') }}</label>

                            <div class="col-md-6">
                                <input id="perakuan_pjk" type="file" class="form-control{{ $errors->has('perakuan_pjk') ? ' is-invalid' : '' }}" name="perakuan_pjk" value="{{ old('perakuan_pjk') }}" required autofocus>

                                @if ($errors->has('perakuan_pjk'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('perakuan_pjk') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        @endif

                        
         <table class="table table-striped">

<thead>
    <tr>
    <th scope="col">No/Versi</th>
    <th scope="col">Fail yang telah dimuat naik</th>
    <th scope="col">Tarikh/Masa </th> 
    
    </tr>
</thead>
<tbody>



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