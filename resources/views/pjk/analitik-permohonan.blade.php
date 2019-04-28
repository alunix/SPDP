@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="clear: both">
                    <h6 style="float: left; margin:5px;">Analitik permohonan</h6> 
                </div>

                <div class="card-body">
                <h5>Jumlah permohonan {{$permohonans_count}}</h5>
                <h5>Total tickets sold : {{$total_seat_sold}}  </h5>
                <h5>Total trips : {{$total_trips}}  </h5>
                <h5>Total unsold tickets : {{$unsold_ticket_year}}  </h5>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  
                    <br>
                    <div align="center">
                    </div>

                    <div id="app">
            {!! $chart->container() !!}
        </div>
       
        {!! $chart->script() !!}

        <table class="table table-striped">

            <thead>
                <tr>
                <th scope="col">Months</th>
                <th scope="col">Revenue generated(RM)</th>
                <th scope="col">Tickets sold</th>
                <th scope="col">Total trips</th>
                <th scope="col">Unsold tickets</th>
                
                


                
                </tr>
            </thead>
            <tbody>
            @foreach($sort_sum_months as $ticket)
            <tr>
            
            <td> {{$ticket->months}}</td> 
            <td> {{number_format($ticket->sums)}}</td>    
            <td> {{$ticket->pax_num_total}}</td> 
            <td> {{$ticket->total_trip}}</td> 
            <td> {{$ticket->unsold_ticket_month}}</td> 

            </tr>
            @endforeach

            


            

        
           


            </tbody>
            </table>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection