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
                            <label for="id_pjk" class="col-md-4 col-form-label text-md-right">{{ __('Pusat Jaminan Kualiti') }}</label>

                            <div class="col-md-6">
                            <select class=”form-control” name="id_pjk" style="width:330px;" id='id_pjk' required>
                                
                            @if ($pjks->count())
                            @foreach($pjks as $pjk)
                            <option value="{{ $pjk->id }}" {{ $selectedPjk == $pjk->id ? 'selected="selected"' : '' }}>{{ $pjk->name }}</option>    
                            @endforeach
                            @endif
                            
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_jppa" class="col-md-4 col-form-label text-md-right">{{ __('JPPA') }}</label>

                            <div class="col-md-6">
                            <select class=”form-control” name="id_jppa" style="width:330px;" id="id_jppa" required>
                                
                            @if ($jppas->count())
                            @foreach($jppas as $jppa)
                            <option value="{{ $jppa->id }}" {{ $selectedJppa == $jppa->id ? 'selected="selected"' : '' }}>{{ $jppa->name }}</option> 
                            @endforeach   
                            @endif
                            
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_senat" class="col-md-4 col-form-label text-md-right">{{ __('Senat') }}</label>

                            <div class="col-md-6">
                            
                            <select class=”form-control” name='id_senat' style="width:330px;" id='id_senat' required>
                                
                                @if ($senats->count())
                                @foreach($senats as $senat)
                                <option value="{{ $senat->id }}" {{ $selectedSenat == $senat->id ? 'selected="selected"' : '' }}>{{ $senat->name }}</option>   
                                @endforeach
                                @endif
                                
                            </select>

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

