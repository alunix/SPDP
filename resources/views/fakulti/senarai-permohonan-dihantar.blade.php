@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:65rem;">
                <div class="card-header" >Permohonan yang dihantar</div>

                <div class="card-body">
               
    <div class="container">
 
   
<h5>Jumlah permohonan yang dihantar : {{$permohonans->count()}}</h5>
<hr>



         <table class="table table-striped">

<thead>
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Jenis</th>
    <th scope="col">Nama program/semakan</th>
    <th scope="col">Penghantar</th>
    <th scope="col">Dokumen</th>
    <th scope="col">Tarikh/Masa Penghantaran</th>    
    <th scope="col">Status</th>
    <th scope="col">Tarikh/Masa Status</th>    

    


    
    </tr>
</thead>
<tbody>
@if( ! $permohonans->isEmpty() )
@foreach($permohonans as $program)
<tr>
<th scope="row">{{$program->id}}</th>
<td> {{$program->jenis_permohonan->jenis_permohonan_huraian}}</td>   
<td> {{$program->doc_title}}</td>               
<td>{{$program->user->name}}</td>
<td> <a href ="<?php echo asset("storage/cadangan_permohonan_baharu/$program->file_link")?>">{{ basename($program->file_name) }}</td>
<td> {{$program->created_at->format('h:i a d/m/Y') }}</td>
<td>{{$program->status_permohonan}} </td>
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