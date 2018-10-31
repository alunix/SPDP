@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Halaman Pusat Jaminan Kualiti</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                       <form action="http://spdp.com/pjk/program-baharu">
    <input type="submit" value="Lihat Semua Program Yang Diterima" />
</form>

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection