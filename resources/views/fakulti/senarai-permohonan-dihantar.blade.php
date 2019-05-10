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
    <th scope="col">No</th>
    <th scope="col">ID</th>
    <th scope="col">Jenis</th>
    <th scope="col">Bilangan penghantaran</th>
    <th scope="col">Nama program/semakan</th>
    <th scope="col">Penghantar</th>
    <th scope="col">Tarikh/Masa Penghantaran</th>    
    <th scope="col">Status</th>
    <th scope="col">Tarikh/Masa Status</th>  
    </tr>
</thead>
<tbody>
@if( ! $permohonans->isEmpty() )
@foreach($permohonans as $permohonan)
<tr>
<th scope="row">{{$loop->iteration}}</th>
<td> {{$permohonan->permohonan_id}}</td>  
<td> {{$permohonan->jenis_permohonan->jenis_permohonan_huraian}}</td>   
<td> {{$permohonan->version_counts()}}</td>
<td> {{$permohonan->doc_title}}</td>                 
<td>{{$permohonan->user->name}}</td>
<td> {{$permohonan->created_at->format('h:i a d/m/Y') }}</td>
<td>{{$permohonan->status_permohonan->status_permohonan_huraian}} </td>
<td> {{$permohonan->updated_at->format('h:i a d/m/Y') }}</td>
<td><a href="{{ route('fakulti.kemajuanPermohonan',$permohonan->permohonan_id) }}" class="btn btn-primary">Kemajuan</a></td>
<td><a href="{{ route('dokumenPermohonan.dihantar',$permohonan->permohonan_id) }}" class="btn btn-primary">Dokumen</a></td>
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