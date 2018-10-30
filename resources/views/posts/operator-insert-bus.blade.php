@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Insert Bus Info</div>

            <div class="card-body">
                    <form method="POST" action="{{ route('operator.insertBusInfo.submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="registration_plate" class="col-md-4 col-form-label text-md-right">{{ __('Registration plate') }}</label>

                            <div class="col-md-6">
                                <input id="registration_plate" type="text" class="form-control{{ $errors->has('registration_plate') ? ' is-invalid' : '' }}" name="registration_plate" value="{{ old('registration_plate') }}" required autofocus>

                                @if ($errors->has('registration_plate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('registration_plate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="totSeat" class="col-md-4 col-form-label text-md-right">{{ __('No of seats') }}</label>

                            <div class="col-md-6">
                                <input id="totSeat" type="text" class="form-control{{ $errors->has('totSeat') ? ' is-invalid' : '' }}" name="totSeat" value="{{ old('totSeat') }}" required autofocus>

                                @if ($errors->has('totSeat'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('totSeat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Operator ID') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id" value="{{ old('id') }}" required autofocus>

                                @if ($errors->has('id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Insert a new bus') }}
                                </button>
                            </div>
                        </div>

                         <hr>

<h4> Existing bus  </h4>
<hr>

@if(isset($buses))
@if (count($buses)>0)

@foreach($buses as $bus)
   <div class ='well'>
       <h6> Bus Registration Plate: {{$bus->registration_plate}} </h6>
       <h6> Number of seats : {{$bus->totSeat}}  </h6>
       <h6> Operator ID : {{$bus->id}}  </h6>
       
<hr>

</div> 
@endforeach
@else

<p> No buses found </p>

@endif
@endif

                        

                         

                        

                       
                
            </div>
        </div>
    </div>
</div>
@endsection