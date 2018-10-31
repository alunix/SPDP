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
                    
                    
                     <form action="http://spdp.com/program-baharu"  >
    <input type="submit" value="Permohonan Program Pengajian Mod Campuran" />
</form>

     <form action="http://spdp.com/program-baharu"  >
    <input type="submit" value="Permohonan Program Pengajian Mod Penyelidikan(Pascasiswaszah)" />
</form>

     <form action="http://spdp.com/program-baharu"  >
    <input type="submit" value="Permohonan Semakan Program: Kerja Kursus dan Mod Campuran" />
</form>

<form action="http://spdp.com/program-baharu"  >
    <input type="submit" value="Permohonan Semakan Program: Mod Penyelidikan" />
</form>

<form action="http://spdp.com/program-baharu"  >
    <input type="submit" value="Permohonan Kursus Baharu" />
</form>

<form action="http://spdp.com/program-baharu"  >
    <input type="submit" value="Permohonan Kursus Elektif Bebas" />
</form>

<form action="http://spdp.com/program-baharu"  >
    <input type="submit" value="Permohonan Penjumudan Program" />
</form>
                            
                           

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection