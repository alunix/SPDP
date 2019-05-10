@extends('layouts.app')
@section('content')

<h3 class="title-5 m-b-35">Senarai permohonan baharu</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                       
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>permohonan baharu</button>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                
                                                <th>id</th>
                                                <th>jenis</th>
                                                <th>bil penghantaran</th>
                                                <th>nama program/kursus</th>
                                                <th>penghantar</th>
                                                <th>fakulti</th>
                                                <th>tarikh</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @if( ! $permohonans->isEmpty() )
                                        @foreach($permohonans as $permohonan)
                                            <tr class="tr-shadow">
                                           
                                                <td>{{$permohonan->permohonan_id}}</td>
                                                <td>{{$permohonan->jenis_permohonan->jenis_permohonan_huraian}}</td>
                                                <td>{{$permohonan->version_counts()}}</td>
                                                <td>{{$permohonan->doc_title}}</td>   
                                                <td>{{$permohonan->user->name}} </td>
                                                <td>{{$permohonan->user->fakulti->fnama_kod}} </td> 
                                                <td>{{$permohonan->created_at->format('h:i a d/m/Y')}}  </td> 
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button onclick="location.href='{{ route('view-permohonan-baharu',$permohonan->permohonan_id) }}'" class="item" data-toggle="tooltip" data-placement="top" title="Lihat permohonan">
                                                            <i  class="zmdi zmdi-zoom-in"></i>
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
@endsection