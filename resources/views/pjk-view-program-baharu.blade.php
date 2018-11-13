@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Senarai permohonanan dokumen program baharu</div>

            <div class="card-body">
            <!-- <form method="POST" action="{{ route('program.page.submit') }}" enctype="multipart/form-data">
                        @csrf           -->

                     

                                             

      <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                      
<h4> Program yang diterima  </h4>


<table class="table table-striped">

<thead>
    <tr>
    <th scope="col">Permohonan ID</th>
    <th scope="col">Tajuk dokumen</th>
    <th scope="col">Ketua fakulti</th>
    <th scope="col">Fakulti</th>
    <th scope="col">Tarikh dihantar</th>


    
    </tr>
</thead>
<tbody>

 <!-- <table class="table  table-striped"> -->

@if( ! $programs->isEmpty() )
@foreach($programs as $program)
<tr>
<th scope="row">{{$program->id}}</th>
<td><a href="/programs/{{$program->id}}">{{$program->doc_title}}</td>               
<td>{{$program->lecturer_name}} </td>
<td>{{$program->fakulti}} </td> 
<td>{{$program->created_at}}  </td> 
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