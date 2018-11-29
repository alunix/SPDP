@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" >Halaman Ketua Fakulti</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form action="http://spdp.com/permohonan-baru"  >
    <input type="submit" value="Permohonan Baharu" />
</form>
                    
                            
                           

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection