@extends('layouts.app')
@section('pageTitle', 'Permohonan Baharu')
@section('content')
<div class = "container">
<div class="row">
                            <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Senarai permohonan dihantar</h2>
                                </div>
                                </div>
                                <a href="{{route('permohonan.index')}}" class="btn btn-success mb-2" id="create-permohonan"> <i class="zmdi zmdi-plus"></i>
                                        Permohonan Baharu</a> 
                            </div>
                            </div>                           
                    </div>
<hr>
                <!-- <h4>Jumlah permohonan dihantar : {{$permohonans->count()}}</h4> -->
                <br>
      
<permohonans>
</permohonans>
</div>
@endsection