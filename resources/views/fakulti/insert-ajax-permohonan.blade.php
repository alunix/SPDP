<div class="modal-header">
    <h5 class="modal-title">Permohonan Baharu</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
                        <div class="form-group row">
                            <label for="nama_penghantar" class="col-md-4 col-form-label text-md-right">{{ __('Penghantar') }}</label>

                            <div class="col-md-6">
                                <input id="nama_penghantar" type="text" class="form-control" name="nama_penghantar" value="{{ Auth::user()->name }}" required autofocus readonly>
                            </div>
                        </div>

                          <div class="form-group row">
                            <label for="jenis_permohonan_id" class="col-md-4 col-form-label text-md-right">{{ __('Jenis permohonan') }}</label>

                            <div class="col-md-6">
                            <select class=”form-control” name='jenis_permohonan_id' style="width:330px;" id='jenis_permohonan_id'>
                                
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


                         <div class="form-group row">
                            <label for="doc_title" class="col-md-4 col-form-label text-md-right">{{ __('Nama program/kursus') }}</label>

                            <div class="col-md-6">
                                <input id="doc_title" type="text" class="form-control{{ $errors->has('doc_title') ? ' is-invalid' : '' }}" name="doc_title" value="{{ old('doc_title') }}" required autofocus>

                                @if ($errors->has('doc_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('doc_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="file_link" class="col-md-4 col-form-label text-md-right">{{ __('Muat naik dokumen(fail pdf)') }}</label>

                            <div class="col-md-6">
                                <input id="file_link" type="file" class="form-control{{ $errors->has('file_link') ? ' is-invalid' : '' }}" name="file_link" value="{{ old('file_link') }}" required autofocus>

                                @if ($errors->has('file_link'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file_link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="summary-ckeditor" class="col-md-4 col-form-label text-md-right">{{ __('Komen(Tidak diwajibkan)') }}</label>

                        <div class="col-md-6">
                        <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea>
                        </div>
                        
                        </div>

                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Close</button>
                        <button type="submit" class="btn btn-primary double-submit-prevent">
                                    {{ __('Hantar') }}
                        </button>
                        </div>

                        

                         <hr>
                
            </div>