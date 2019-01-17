@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Senarai permohonanan baharu</h4></div>

            <div class="card-body">
           

                     

                                             

      <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                      



<table class="table table-striped">

<thead>
    <tr>
    <th scope="col">Permohonan ID</th>
    <th scope="col">Jenis permohonan</th>
    <th scope="col">Nama program/kursus</th>
    <th scope="col">Nama penghantar</th>
    <th scope="col">Fakulti</th>
    <th scope="col">Tarikh dihantar</th>


    
    </tr>
</thead>
<tbody>

 <!-- <table class="table  table-striped"> -->

@if( ! $permohonans->isEmpty() )
@foreach($permohonans as $permohonan)
<tr>
<th scope="row">{{$permohonan->id}}</th>
<td>{{$permohonan->jenis_permohonan->jenis_permohonan_huraian}} </td>
<!-- <td><a href="/permohonan/{{$permohonan->id}}">{{$permohonan->doc_title}}</td>                -->
<td>{{$permohonan->doc_title}}</td>   
<td>{{$permohonan->user->name}} </td>
<td>{{$permohonan->fakulti}} </td> 
<td>{{$permohonan->created_at->format('h:i a d/m/Y')}}  </td> 
<td><a href="{{ route('view-permohonan-baharu',$permohonan->id) }}" class="btn btn-primary">SELECT</a></td>
</tr>
@endforeach
@endif
</tbody>
</table>


                        

                         

                        

                       
                
            </div>
        </div>
    </div>
</div>
@endsection