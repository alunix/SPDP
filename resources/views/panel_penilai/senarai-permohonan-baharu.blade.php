@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-8">
            <div class="card" style="width:75rem;">
                <div class="card-header" >Permohonan yang dihantar</div>
                <div class="card-body">
                
               
    <div class="container-fluid">
<h5>Jumlah permohonan yang dihantar : {{$permohonans->count()}}</h5>
<hr>
<table class="table table-striped">

<thead>
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Jenis</th>
    <th scope="col">Nama program/kursus</th>
    <th scope="col">Nama penghantar</th>
    <th scope="col">Fakulti</th>
    <th scope="col">Tarikh dihantar</th>
    </tr>
</thead>
<tbody>

@if( ! $permohonans->isEmpty() )
@foreach($permohonans as $permohonan)
<tr>
<th scope="row">{{$permohonan->id}}</th>
<td>{{$permohonan->jenis_permohonan->jenis_permohonan_huraian}} </td>
<td>{{$permohonan->doc_title}}</td>   
<td>{{$permohonan->user->name}} </td>
<td>{{$permohonan->fakulti}} </td> 
<td>{{$permohonan->created_at->format('h:i a d/m/Y')}}  </td> 
<td><a href="{{ route('view-permohonan-baharu',$permohonan->permohonan_id) }}" class="btn btn-primary">SELECT</a></td>
</tr>
@endforeach
@endif
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