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
    <th scope="col">Ketua fakulti</th>
    <th scope="col">Fakulti</th>
    <th scope="col">Tarikh dihantar</th>


    
    </tr>
</thead>
<tbody>

 <!-- <table class="table  table-striped"> -->

@if( ! $permohonans->isEmpty() )
@foreach($permohonans as $program)
<tr>
<th scope="row">{{$program->id}}</th>
<td>{{$program->jenis_permohonan->jenis_permohonan_huraian}} </td>
<td><a href="/programs/{{$program->id}}">{{$program->doc_title}}</td>               
<td>{{$program->lecturer_name}} </td>
<td>{{$program->fakulti}} </td> 
<td>{{$program->created_at->format('h:i a d/m/Y')}}  </td> 
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