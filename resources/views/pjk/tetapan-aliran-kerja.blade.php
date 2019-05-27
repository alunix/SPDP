@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tetapan aliran kerja</div>

            <div class="card-body">
            <form class="form-prevent-double-submits" method="POST" action="{{ route('aliranKerja.settings.submit') }}">
                        @csrf

                    

                        <div class="form-group row">
                            <label for="email_pjk" class="col-md-4 col-form-label text-md-right">{{ __('Email PJK') }}</label>

                            <div class="col-md-6">
                                <input id="email_pjk" type="text"  value="{{$setting->email_pjk}}" class="form-control" name="email_pjk"  required autofocus >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email_jppa" class="col-md-4 col-form-label text-md-right">{{ __('Email JPPA') }}</label>

                            <div class="col-md-6">
                                <input id="email_jppa" type="text"  value="{{$setting->email_jppa}}" class="form-control" name="email_jppa"  required autofocus >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email_senat" class="col-md-4 col-form-label text-md-right">{{ __('Email Senat') }}</label>

                            <div class="col-md-6">
                                <input id="email_senat" type="text"  value="{{$setting->email_senat}}" class="form-control" name="email_senat"  required autofocus >
                            </div>
                        </div>

                        
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

