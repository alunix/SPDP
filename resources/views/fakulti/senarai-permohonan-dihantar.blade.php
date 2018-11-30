@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:60rem;">
                <div class="card-header" >Permohonan yang dihantar</div>

                <div class="card-body">
                @push('styles')
                <link href="{{ asset('css/styles.scss') }}" rel="stylesheet">
                @endpush

    <div class="container">
 
    <h5> Program yang dihantar  </h5>
<h5>Jumlah permohonan yang dihantar : {{$programs->count()}}</h5>
<hr>



         <table class="table table-striped">

<thead>
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Jenis Permohonan</th>
    <th scope="col">Nama program/semakan</th>
    <th scope="col">Penghantar</th>
    <th scope="col">Fakulti</th>
    <th scope="col">Dokumen dimuat naik</th>
    <th scope="col">Tarikh/Masa Penghantaran</th>    
    <th scope="col">Status</th>
    <th scope="col">Tarikh/Masa Status</th>    

    


    
    </tr>
</thead>
<tbody>
@if( ! $programs->isEmpty() )
@foreach($programs as $program)
<tr>
<th scope="row">{{$program->id}}</th>
<td> {{$program->jenis_permohonan->jenis_permohonan_huraian}}</td>   
<td> {{$program->doc_title}}</td>               
<td>{{$program->lecturer_name}}</td>
<td>{{$program->fakulti}}</td>
<td> <a href ="<?php echo asset("storage/cadangan_program_baharu/$program->file_link")?>">{{ basename($program->file_name) }}</td>
<td> {{$program->created_at->format('h:i a d/m/Y') }}</td>
<td>{{$program->status_program}} </td>
<td> {{$program->updated_at->format('h:i a d/m/Y') }}</td>

</tr>
@endforeach

</tbody>
</table>



@else

<p> Tiada permohonan telah dijumpai </p>

@endif



                
                    
    
                            
                           

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection