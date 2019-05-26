@extends('layouts.app')

@section('content')
<div >
            
           

                <div class="section__content section__content--p30">
                    <div class="container">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Notifikasi</h2>
                                </div>
                            </div>
                        </div>
                        <hr>
						
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
						<!-- @foreach($permohonans as $permohonan)
						<tr>
						<th scope="row">{{$loop->iteration}}</th>
						<td> {{$permohonan["fakulti_nama"]}}</td> 
						<td> {{$permohonan["jumlah_permohonan"]}}</td> 
						<td> {{$permohonan["jumlah_diluluskan"]}}</td> 
						<td> {{$permohonan["jumlah_penambahbaikkan"]}}</td> 
						<td> {{$permohonan["jumlah_dokumen_permohonan"]}}</td> 
						<td><a href="{{ route('analitik.fakulti',$permohonan['fakulti_id']) }}" class="btn btn-primary">SELECT</a></td>


                        </tr>
                        
                        @endforeach -->

</tbody>
</table>
						
						
         
                      
                        </div>
                      
                    </div>
                </div>
            

      


@endsection







