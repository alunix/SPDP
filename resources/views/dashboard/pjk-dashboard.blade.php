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

                       <form action="{{ route('senaraiPermohonanBaharu') }}">
    <input type="submit" value="Lihat Semua Permohonan Yang Diterima" />
</form>


                    

 <form action="{{ route('pjk.senarai_perakuan.show') }}">
    <input type="submit" value="Perakuan laporan penilaian" />
</form>



<form action="{{ route('register.panel_penilai.show') }}">
    <input type="submit" value="Daftar Panel Penilai" />
</form>

<form action="{{ route('penilaian.show') }}">
    <input type="submit" value="Senarai penilaian" />
</form>

<form action="{{ route('analitik.permohonan.dashboard') }}">
    <input type="submit" value="Analitik permohonan" />
</form>






                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection