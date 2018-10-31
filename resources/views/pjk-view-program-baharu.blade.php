@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Senarai permohonanan dokumen program baharu</div>

            <div class="card-body">
                    <form method="GET" >
                        @csrf          

                     

                                             

      <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                      
<h4> Program yang diterima  </h4>
<hr>

@if(isset($programs))
@if (count($programs)>0)

@foreach($programs as $program)
   <div class ='well'>
       <h6><a href="/programs/{{$program->id}}">{{$program->doc_title}} </a> </h6>
       <h6> Permohonan ID: {{$program->id}} </h6>
       <h6> Nama Ketua Fakulti: {{$program->lecturer_name}} </h6>
       <h6> Fakulti : {{$program->fakulti}}  </h6>    
       <h6> Status Program : {{$program->status_program}}  </h6>       
       <h6> Tarikh dihantar : {{$program->created_at}}  </h6>
       <h6> Tarikh dikemaskini : {{$program->updated_at}}  </h6>
       
       
       
<hr>

</div> 
@endforeach
@else

<p> Tiada cadangan program telah dijumpai </p>

@endif
@endif

                        

                         

                        

                       
                
            </div>
        </div>
    </div>
</div>
@endsection