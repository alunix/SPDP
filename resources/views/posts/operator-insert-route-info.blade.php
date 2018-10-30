@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Insert Route Info</div>
            


            <div class="card-body">
                    <form method="POST" action="{{ route('operator.insertRouteInfo.submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="route_name" class="col-md-4 col-form-label text-md-right">{{ __('Route name') }}</label>

                            <div class="col-md-6">
                                <input id="route_name" type="text" class="form-control{{ $errors->has('route_name') ? ' is-invalid' : '' }}" name="route_name" value="{{ old('route_name') }}" required autofocus>

                                @if ($errors->has('route_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('route_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="origin_terminal" class="col-md-4 col-form-label text-md-right">{{ __('Depart From') }}</label>

                            <div class="col-md-6">
                                <input id="origin_terminal" type="text" class="form-control{{ $errors->has('origin_terminal') ? ' is-invalid' : '' }}" name="origin_terminal" value="{{ old('origin_terminal') }}" required autofocus>

                                @if ($errors->has('origin_terminal'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('origin_terminal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="destination_terminal" class="col-md-4 col-form-label text-md-right">{{ __('Arrive To') }}</label>

                            <div class="col-md-6">
                                <input id="destination_terminal" type="text" class="form-control{{ $errors->has('destination_terminal') ? ' is-invalid' : '' }}" name="destination_terminal" value="{{ old('destination_terminal') }}" required autofocus>

                                @if ($errors->has('destination_terminal'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('destination_terminal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="operatorID" class="col-md-4 col-form-label text-md-right">{{ __('Operator ID') }}</label>

                            <div class="col-md-6">
                                <input id="operatorID" type="text" class="form-control{{ $errors->has('operatorID') ? ' is-invalid' : '' }}" name="operatorID" value="{{ old('operatorID') }}" required autofocus>

                                @if ($errors->has('operatorID'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('operatorID') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        


                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Insert a new route') }}
                                </button>
                            </div>
                        </div>
                        <hr>

                        <h4> Existing Routes </h4>
                        <hr>

                        @if(isset($routes))
                         @if (count($routes)>0)

                        @foreach($routes as $route)
                            <div class ='well'>
                                <h6> RouteID: {{$route->routeID}} </h6>
                                <h6> Route Name : {{$route->route_name}} </h6>
                                <h6> Origin Terminal : {{$route->origin_terminal}}  </h6>
                                <h6> Destination Terminal : {{$route->destination_terminal}} </h6>                            
                                
        <hr>
        
   </div> 
   @endforeach
@else

<p> No previous routes are found </p>

@endif
@endif


                      

                        
                        

                         

                        

                       
                
            </div>

             




        </div>
    </div>



</div>

  


@endsection