@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Insert Ticket Info</div>
            


            <div class="card-body">
                    <form method="POST" action="{{ route('operator.insertTicketInfo.submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Company name') }}</label>

                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}" required autofocus>

                                @if ($errors->has('company_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="busID" class="col-md-4 col-form-label text-md-right">{{ __('Registration Plate') }}</label>

                            <div class="col-md-6">
                                <input id="busID" type="text" class="form-control{{ $errors->has('busID') ? ' is-invalid' : '' }}" name="busID" value="{{ old('busID') }}" required autofocus>

                                @if ($errors->has('busID'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('busID') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       

                        <div class="form-group row">
                            <label for="date_depart" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date_depart" type="date" class="form-control{{ $errors->has('date_depart') ? ' is-invalid' : '' }}" name="date_depart" value="{{ old('date_depart') }}" required autofocus>

                                @if ($errors->has('date_depart'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_depart') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time_depart" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>

                            <div class="col-md-6">
                                <input id="time_depart" type="time" class="form-control{{ $errors->has('time_depart') ? ' is-invalid' : '' }}" name="time_depart" value="{{ old('time_depart') }}" required autofocus>

                                @if ($errors->has('time_depart'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('time_depart') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="ticket_price" class="col-md-4 col-form-label text-md-right">{{ __('Price(RM)') }}</label>

                            <div class="col-md-6">
                                <input id="ticket_price" type="text" class="form-control{{ $errors->has('ticket_price') ? ' is-invalid' : '' }}" name="ticket_price" value="{{ old('ticket_price') }}" required autofocus>

                                @if ($errors->has('ticket_price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ticket_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Insert a new ticket') }}
                                </button>
                            </div>
                        </div>
                        <hr>

                        <h4> Trips </h4>
                        <hr>

                        @if(isset($tickets))
                         @if (count($tickets)>0)

                        @foreach($tickets as $ticket)
                            <div class ='well'>
                                <h6> TripID: {{$ticket->tripID}} </h6>                            
                                <h6> Date Depart : {{$ticket->date_depart}} </h6>
                                <h6> Time Depart : {{$ticket->time_depart}} </h6>
                                <h6> Ticket price (RM) : {{$ticket->ticket_price}} </h6>
        <hr>
        
   </div> 
   @endforeach
@else

<p> No previous trips are found </p>

@endif
@endif


                      

                        
                        

                         

                        

                       
                
            </div>

             




        </div>
    </div>



</div>

  


@endsection