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
                                <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-permohonan"> <i class="zmdi zmdi-plus"></i>
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

@section('div')

<div class="modal fade" id="permohonan-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="permohonanModal"></h4>
        </div>
        <div class="modal-body">
            <form id="permohonanForm" name="permohonanForm" class="form-horizontal">
               <input type="hidden" name="user_id" id="user_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Penghantar</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ Auth::user()->name }}" required autofocus readonly>
                    </div>
                </div>
 

                <div class="form-group">
                <label class="col-sm-2 control-label" style="white-space: nowrap;">{{ __('Jenis permohonan*') }}</label>

                            <div class="col-md-12">
                            <select class=”form-control” name='jenis_permohonan_id' style="width:432px;" id='jenis_permohonan_id'>
                                
                                <option value=#>Sila pilih</option>
                                <option value=1>Program Pengajian Baru</option>
                                <option value=2>Semakan Program Pengajian</option>
                                <option value=3>Kursus Teras Baru</option>
                                <option value=4>Kursus Elektif Baru</option>
                                <option value=5>Semakan Kursus Teras</option>
                                <option value=6>Semakan Kursus Elektif</option>                                
                                <option value=8>Penjumudan Program Pengajian</option>
                            </select>
                            </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"  style="white-space: nowrap;">Nama program/kursus</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="doc_title" name="doc_title" placeholder="Contoh : Sarjana Muda Sains Komputer"  required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"  style="white-space: nowrap;">Muat naik dokumen(fail pdf)</label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control" id="file_link" name="file_link"  required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"  style="white-space: nowrap;">Komen(Tidak diwajibkan)</label>
                    <div class="col-sm-12">
                    <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea>
                    </div>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary double-submit-prevent" id="btn-save" value="create">Hantar
            </button>
        </div>
    </div>
  </div>
</div>

@endsection

@section('myjsfile')

<script>
  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*  When user click add user button */
    $('#create-permohonan').click(function () {
        $('#btn-save').val("create-permohonan");
        $('#permohonanForm').trigger("reset");
        $('#permohonanModal').html("Permohonan Baharu");
        $('#permohonan-modal').modal('show');
    });
 
 if ($("#permohonanForm").length > 0) {
      $("#permohonanForm").validate({
 
     submitHandler: function(form) {
 
      var actionType = $('#btn-save').val();
      
      $('#btn-save').html('Sending..');
      
      $.ajax({
          data: $('#permohonanForm').serialize(),
          url: '/senarai-permohonan-dihantar/create',
          type: "POST",
          dataType: 'json',
          success: function (data) {
              var permohonan = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>';
              permohonan += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
              permohonan += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user">Delete</a></td></tr>';
               
              
              if (actionType == "create-permohonan") {
                  $('#permohonans-add').prepend(user);
              } else {
                  $("#user_id_" + data.id).replaceWith(user);
              }
 
              $('#permohonanForm').trigger("reset");
              $('#permohonan-modal').modal('hide');
              $('#btn-save').html('Save Changes');
              
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}
   
  
</script>
@endsection

@endsection