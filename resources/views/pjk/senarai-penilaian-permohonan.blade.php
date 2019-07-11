@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Senarai Penilaian Panel Penilai</div>

            <div class="card-body" style="width:700px;">
    
                  
            
                        <table class="table table-striped">                  
                        

                        <thead>
                            <tr>
                            <th scope="col">Penilaain ID</th>
                            <th scope="col">Permohonan ID</th>
                            <th scope="col">Pelantik(PJK)</th>
                            <th scope="col">Penilai</th>
                            <th scope="col">Tarikh penilaian bermula</th>
                            <th scope="col">Tarikh Akhir/Deadline</th>                          
                            <th scope="col">Tempoh(Hari)</th>
                            <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                       
                        @if( ! $penilaians->isEmpty() )

                       
        @foreach($penilaians as $penilaian)
            <tr>
                <th scope="row>">{{$penilaian->penilaian_id}}</th>
                <th scope="row>">{{$penilaian->permohonanID}}</th>
                <th scope="row">{{ $penilaian->pelantik->name }}</th>
               <th scope="row">{{ $penilaian->penilai->name}}</th>   
               <th scope="row">{{ $penilaian->created_at}}</th>                
                <th scope="row">{{ $penilaian->tarikhAkhir }}</th>
                <th scope="row">{{ $penilaian->tempoh}}</th>
                <td><a href="{{ route('view-permohonan-baharu',$penilaian->permohonanID) }}" class="btn btn-primary">SELECT</a></td>
            </tr>
        @endforeach
        @else
            No penilaian are found

    @endif
    </tbody>
                        </table>

                         <hr style="border-color:white;">
                        
                </div>
            </div>
        </div>
    </div>
</div>

@endsection