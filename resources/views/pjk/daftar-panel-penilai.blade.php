@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Daftar pengguna') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.panel_penilai.submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nama" class="col-md-3">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required autofocus>

                                @if ($errors->has('nama'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3">{{ __('Alamat e-mel') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="name@ukm.edu.my" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Peranan pengguna</label>
                                                </div>
                                                <div class="col col-md-9">
                                                    <div class="form-check">
                                                        <div class="radio">
                                                            <label for="radio1" class="form-check-label ">
                                                                <input type="radio" id="radio1" name="peranan" value="penilai" class="form-check-input">Panel Penilai
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio2" class="form-check-label ">
                                                                <input type="radio" id="radio2" name="peranan" value="pjk" class="form-check-input">PJK
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio3" class="form-check-label ">
                                                                <input type="radio" id="radio3" name="peranan" value="jppa" class="form-check-input">JPPA
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio4" class="form-check-label ">
                                                                <input type="radio" id="radio4" name="peranan" value="senat" class="form-check-input">Senat
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3">{{ __('Kata laluan') }}</label>

                            <div class="col col-md-9">
                                                    <div class="form-check">
                                                        <div class="radio">
                                                            <label for="autoGenerate" class="form-check-label ">
                                                                <input type="radio" onclick="myFunction()" id="autoGenerate" name="radios" value="autoGenerate"  class="form-check-input">Auto jana kata laluan
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="manualGenerate" class="form-check-label ">
                                                                <input type="radio" onclick="myFunction()" id="manualGenerate" name="radios" value="manualGenerate" class="form-check-input">Biar saya tetapkan kata laluan
                                                            </label>
                                                        </div>  
                                                        
                            <div id ='showPassword' style='display:none' class="form-group row" >

                            <br>
                            <label for="password" style="font-size:12px" >{{ __('Kata laluan') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" onkeyup='check();'  name="password" value="{{ old('password') }}" required >
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="password-confirm" style="font-size:12px"  >{{ __('Taip semula kata laluan') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" onkeyup='check();' name="password_confirmation" value="{{ old('password-confirm') }}" required >
                            </div>
                            <span class="col-md-6" id='message'></span>
                            
                            </div>                                                      
                                                    </div>
                            </div>


                            
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Daftar pengguna') }}
                                </button>
                            </div>
                        </div>

                        <br>

                        <table class="table table-striped">

<thead>
    <tr>
    <th scope="col">No</th>
    <th scope="col">Nama</th>
    <th scope="col">Peranan</th>
    <th scope="col">Email</th>
    <th scope="col">Tarikh pendaftaran</th>

    

    
    </tr>
</thead>
<tbody>
@if( ! $users->isEmpty() )
@foreach($users as $user)
<tr>
<th scope="row">{{ $user->id }}</th>
<td>{{ $user->name }}</td>    
<td>{{ $user->role }}</td>                  
<td>{{ $user->email }}</td>
<td>{{ $user->created_at }}</td>

</tr>
@endforeach
@endif
</tbody>
</table>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@if($errors->any())
        <div class="row collapse">
            <ul class="alert-box warning radius">
                @foreach($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
        @endif

<script >
function myFunction() {
   var auto = document.getElementById("autoGenerate");
   var manual = document.getElementById("manualGenerate");
   var showPassword = document.getElementById('showPassword');
   var password = document.getElementById("password");
   var confirmed = document.getElementById("password-confirm");
   
  
  if (auto.checked == true){
    showPassword.style.display = "none";
    password.removeAttribute('required');
    confirmed.removeAttribute('required');
    
  } else if (manual.checked == true){
    showPassword.style.display = "block";
        
  }
  else{

  }
}


var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('password-confirm').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Padan';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Tidak padan';
  }
}
</script>
