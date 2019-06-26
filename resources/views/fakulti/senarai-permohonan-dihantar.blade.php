@extends('layouts.app')

@section('pageTitle', 'Senarai permohonan')
@section('content')

<div class="container">
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
                <h4>Jumlah permohonan dihantar : {{$permohonans->count()}}</h4>
                <br>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Bilangan penghantaran</th>
                            <th scope="col">Nama program/semakan</th>
                            <th scope="col">Penghantar</th>
                            <th scope="col">Tarikh/Masa Penghantaran</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tarikh/Masa Status</th>  
                            </tr>
                        </thead>
                        <tbody id="permohonans-add">

                        @if( ! $permohonans->isEmpty() )
                        @foreach($permohonans as $permohonan)
                            <tr class="tr-shadow">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td> {{$permohonan->permohonan_id}}</td>  
                                <td> {{$permohonan->jenis_permohonan->jenis_permohonan_huraian}}</td>   
                                <td> {{$permohonan->version_counts()}}</td>
                                <td> {{$permohonan->doc_title}}</td>                 
                                <td>{{$permohonan->user->name}}</td>
                                <td> {{$permohonan->created_at->format('h:i a d/m/Y') }}</td>
                                <td>{{$permohonan->status_permohonan->status_permohonan_huraian}} </td>
                                <td> {{$permohonan->updated_at->format('h:i a d/m/Y') }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <button onclick="location.href='{{ route('fakulti.kemajuanPermohonan',$permohonan->permohonan_id) }}'" class="item" data-toggle="tooltip" data-placement="top" title="Kemajuan Permohonan">
                                            <i  class="fas fa-spinner"></i>
                                        </button>
                                        <button onclick="location.href='{{ route('dokumenPermohonan.dihantar',$permohonan->permohonan_id) }}'" class="item" data-toggle="tooltip" data-placement="top" title="Dokumen dihantar">
                                            <i class="fas fa-file-upload"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                            
                            <tr class="spacer"></tr>
                        </tbody>
                    </table>
                    @else
                    <p> Tiada permohonan telah dijumpai </p>
                    @endif
                </div>
</div>


@endsection