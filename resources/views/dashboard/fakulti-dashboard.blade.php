@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Halaman Fakulti</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a class="btn icon-btn btn-success" href="http://spdp.com/permohonan-baharu">
<!-- <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span> -->
Permohonan Baharu
</a>

<a class="btn icon-btn btn-info" href="http://spdp.com/senarai-permohonan-dihantar">
<!-- <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span> -->
Permohonan Dihantar
</a>



                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection