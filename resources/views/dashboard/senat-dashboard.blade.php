@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Halaman Urus Setia Senat</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <form action="{{ route('senaraiPermohonanBaharu') }}">
    <input type="submit" value="Lihat Semua Permohonan Yang Diterima" />
</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection