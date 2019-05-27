@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="clear: both">
                    <h6 style="float: left; margin:5px;">Analitik permohonan tahun {{$year_report}}</h6> 
                </div>

                <h5>Purata masa diperlukan untuk meluluskan satu permohonan = {{$avg_duration}} jam</h5>
                <h5>Jumlah permohonan diluluskan : {{$lulus->count()}}</h5>

                <div class="container">

                <div class="row">
            
            <div class="col-md-6"> 
            {!! $chart->container() !!}
            {!! $chart->script() !!}
            </div>

            
            
            <div class="col-md-6"> 
               {!! $pie_chart->container() !!}
               {!! $pie_chart->script() !!}
            </div>

            <div class="col-md-6"> 
               {!! $line_chart->container() !!}
               {!! $line_chart->script() !!}
            </div>
                </div>
                <table class="table table-striped">

<thead>
    <tr>
    <th scope="col">No</th>
    <th scope="col">Fakulti</th>
    <th scope="col">Jumlah permohonan</th>
    <th scope="col">Jumlah permohonan diluluskan</th>
    <th scope="col">Jumlah perlu penambahbaikkan</th>
    <th scope="col">Jumlah dokumen permohonan</th>
    </tr>
</thead>
<tbody>
@foreach($permohonans as $permohonan)
<tr>
<th scope="row">{{$loop->iteration}}</th>
<td> {{$permohonan["fakulti_nama"]}}</td> 
<td> {{$permohonan["jumlah_permohonan"]}}</td> 
<td> {{$permohonan["jumlah_diluluskan"]}}</td> 
<td> {{$permohonan["jumlah_penambahbaikkan"]}}</td> 
<td> {{$permohonan["jumlah_dokumen_permohonan"]}}</td> 



</tr>
@endforeach










</tbody>
</table>

            </div>
        </div>
    </div>
</div>
@endsection