@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Insert Companies Info</div>

            <div class="card-body">
                    <form method="POST" action="{{ route('admin.insertBusCompany.submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="busCompanyName" class="col-md-4 col-form-label text-md-right">{{ __('Company name') }}</label>

                            <div class="col-md-6">
                                <input id="busCompanyName" type="text" class="form-control{{ $errors->has('busCompanyName') ? ' is-invalid' : '' }}" name="busCompanyName" value="{{ old('busCompanyName') }}" required autofocus>

                                @if ($errors->has('busCompanyName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('busCompanyName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                      
                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Insert a new company') }}
                                </button>
                            </div>
                        </div>

                        <hr>

                         <h4> Existing bus companies </h4>
                        <hr>

                        @if(isset($companies))
                         @if (count($companies)>0)

                        @foreach($companies as $company)
                            <div class ='well'>
                                <h6> Company ID: {{$company->busCompanyID}} </h6>
                                <h6> Company name : {{$company->busCompanyName}}  </h6>
                                
        <hr>
        
   </div> 
   @endforeach
@else

<p> No companies found </p>

@endif
@endif

                        

                         

                        

                       
                
            </div>
        </div>
    </div>
</div>
@endsection