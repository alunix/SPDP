@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Halaman Penilai</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                     <form action="http://spdp.com/panel-penilai/program-baharu">
    <input type="submit" value="Lihat Semua Permohonan Baharu" />
</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection