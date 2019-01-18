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

                       <form action="{{ route('pjk.list.permohonanBaharu') }}">
    <input type="submit" value="Lihat Semua Permohonan Yang Diterima" />
</form>


                    

 <form action="http://spdp.com/senarai-penilaian-perakuan">
    <input type="submit" value="Perakuan laporan penilaian" />
</form>

<form action="{{ route('pjk.daftar_panel_penilai.show') }}">
    <input type="submit" value="Daftar Panel Penilai" />
</form>




                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection