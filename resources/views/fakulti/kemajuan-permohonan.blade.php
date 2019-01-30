@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:65rem;">
                <div class="card-header" >Kemajuan Permohonan</div>

                <div class="card-body">
               
    <div class="container">
 
   <h4>Permohonan ID :{{$permohonan->id}}</h4>





         <table class="table table-striped">

<thead>
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Status Permohonan</th>
    <th scope="col">Tarikh/Masa Status</th>    

    


    
    </tr>
</thead>
<tbody>
@if( ! $kjs->isEmpty() )
@foreach($kjs as $kj)
<tr>
<th scope="row">{{$kj->id}}</th>
<td> {{$kj->status_permohonan}}</td>   
<td> {{$kj->created_at->format('h:i a d/m/Y') }}</td>               


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