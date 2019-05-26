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
							
							</tr>
						</thead>
						<tbody>
						@foreach($notifications as $permohonan)
						<tr>
						<th scope="row">{{$loop->iteration}}</th>
						<td> {{$permohonan->status->status_permohonan_huraian}}</td> 
						<td> {{$permohonan->created_at}}</td> 
					


                        </tr>
                        
                        @endforeach

</tbody>
</table>
						
						
         
                      
                        </div>
                      
                    </div>
                </div>
            

      


@endsection







