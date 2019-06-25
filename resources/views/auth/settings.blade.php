@extends('layouts.app')
@section('pageTitle', 'Tetapan')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tetapan profil</div>

            <div class="card-body">
            <form class="form-prevent-double-submits" method="POST" action="{{ route('settings.submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"  value="{{ @$user->name}}" class="form-control" name="name"  required autofocus readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text"  value="{{$user->email}}" class="form-control" name="email"  required autofocus >
                            </div>
                        </div>
                        
                        @if(Auth::user()->role != "pjk")
                               
                    

                        <div class="form-group row">
                            <label for="fakulti" class="col-md-4 col-form-label text-md-right">{{ __('Fakulti') }}</label>

                            <div class="col-md-6">

                            <select class=”form-control” name='fakulti' style="width:330px;" id='fakulti' required>
                                
                                @if ($fakultis->count())
                                @foreach($fakultis as $fakulti)
                                <option value="{{ $fakulti->fakulti_id }}" {{ $selectedFakulti == $fakulti->fakulti_id ? 'selected="selected"' : '' }}>{{ $fakulti->f_nama}}</option>   
                                @endforeach
                                @endif
                                
                            </select>

                            </div>
                        </div>
                        @endif

                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary double-submit-prevent">
                                    {{ __('Kemaskini') }}
                                </button>
                            </div>
                        </div>

                         <hr style="border-color:white;">
                        

                       
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

