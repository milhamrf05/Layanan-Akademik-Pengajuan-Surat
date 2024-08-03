@extends('layouts.main')
@section('title', 'pengantar magang')
@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::About card-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body p-lg-17">
                <!--begin::About-->
                <div class="mb-18">
                    <!--begin::Wrapper-->
                    <div class="mb-10">
                        <!--begin::Top-->
                        <div class="text-center mb-15">
                            <!--begin::Title-->
                            <h3 class="row">Form Pengajuan Surat Pengantar Magang</h3>
                            <!--end::Title-->
                            <!--begin::Text-->

                        </div>
                        <div class="mb-20 pb-lg-20">
                            <form action="{{ route('store.pengantar-magang') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!--begin::List-->
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for=""  class="form-label">Keperluan Surat</label>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input"  value="Magang Reguler" type="radio" name="keperluan" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Magang Reguler
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input"  value="Magang MBKM" type="radio" name="keperluan" id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Magang MBKM (Konversi Matakuliah)
                                            </label>
                                          </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">Nama
                                            Mahasiswa 1</label>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" id="basic-url"
                                                value="{{ $data_mahasiswa['mhs_namalengkap'] }}"
                                                aria-describedby="basic-addon3" name="nama_mahasiswa_1" readonly />

                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">NIM 1</label>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" id="basic-url"
                                                aria-describedby="basic-addon3" name="nim_1"
                                                value="{{ $data_mahasiswa['mhs_nim'] }}"
                                                readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">No Telepon</label>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                                 name="no_hp" value="{{ old('no_hp') }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">Email
                                            Mahasiswa 1</label>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" id="basic-url"
                                                aria-describedby="basic-addon3" name="email_mahasiswa"
                                                value="{{ $data_mahasiswa['mhs_email'] }}"
                                                readonly />
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                            <label for="basic-url" class="form-label">Nama Mahasiswa 2</label>
                                            <div class="mb-5">
                                                <select class="js-data-basic-single form-control" id="nama_mahasiswa_2" data-nim-input="#nim2" data-name-input="#hidden_nama_mahasiswa_2">
                                                    <option></option>
                                                </select>
                                                <div class="sugesstions" id="suggestions1"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="basic-url" class="form-label">NIM 2</label>
                                            <div class="input-group mb-5">
                                                <input type="text" class="form-control" id="nim2" aria-describedby="basic-addon3" name="nim_2" readonly />
                                            </div>
                                        </div>
                                        <!-- Input Tersembunyi untuk Nama Mahasiswa 2 -->
                                        <input type="hidden" id="hidden_nama_mahasiswa_2" name="nama_mahasiswa_2" />
                                        
                                    <div class="col-md-6"><label for="basic-url" class="form-label">Nama Mahasiswa
                                            3</label>
                                        <div class="mb-5">
                                            <select class="js-data-basic-single-mahasiswa-3 form-control"
                                             id="nama_mahasiswa_3">
                                                <option ></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">NIM 3</label>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" id="nim3"
                                                aria-describedby="basic-addon3" name="nim_3" readonly />
                                        </div>
                                    </div>
                                    <input type="hidden" id="hidden_nama_mahasiswa_3" name="nama_mahasiswa_3" />
                                    <div class="col-md-6"><label for="basic-url" class="form-label">Nama Mahasiswa
                                            4</label>
                                        <div class="mb-5">
                                              <select class="js-data-basic-single-mahasiswa-4 form-control"
                                            id="nama_mahasiswa_4">
                                            <option></option>
                                        </select>
                                            <div class="sugesstions" id="suggestions3"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">NIM 4</label>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" id="nim4"
                                                aria-describedby="basic-addon3" name="nim_4" readonly />
                                        </div>
                                    </div>
                                    <input type="hidden" id="hidden_nama_mahasiswa_4" name="nama_mahasiswa_4" />
                                    <div class="col-md-6">
                                        <label for="jurusan" class="form-label">Progam Studi</label>
                                        <div class="input-group mb-5">
                                            <input value="{{ $data_mahasiswa['prd_nama'] }}"
                                                type="text" class="form-control @error('prd_nama') is-invalid @enderror"
                                                id="jurusan" name="jurusan"
                                                value="{{ old('jurusan') }}" />
                                            @error('jurusan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">Surat Ditujukan
                                            Kepada</label>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" id="basic-url"
                                                aria-describedby="basic-addon3" name="ditujukan_kepada" />
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">Nama
                                            Perusahaan</label>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" id="basic-url"
                                                aria-describedby="basic-addon3" name="nama_perusahaan" />
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">Alamat
                                        Perusahaan</label>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" name="alamat_perusahaan" />
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">Nama
                                            Dosen Pembimbing</label>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" id="basic-url"
                                                aria-describedby="basic-addon3" name="dosen_pembimbing" />
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">Kode Pos</label>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" id="basic-url"
                                                aria-describedby="basic-addon3" name="kode_pos" />
                                        </div>
                                    </div>

                                    <div class="col-md-6"><label for="basic-url" class="form-label">Tanggal Mulai
                                            Magang</label>
                                        <div class="input-group mb-5">
                                            <input type="date" class="form-control" id="basic-url"
                                                aria-describedby="basic-addon3" name="tanggal_mulai_magang" />
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">Tanggal Akhir
                                            Magang</label>
                                        <div class="input-group mb-5">
                                            <input type="date" class="form-control" id="basic-url"
                                                aria-describedby="basic-addon3" name="tanggal_akhir_magang" />
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">Opsi surat</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="opsi_surat"
                                                value="hardfile" id="hardfile" />
                                            <label class="form-check-label" for="hardfile">
                                                Hard File
                                            </label>
                                        </div>
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="radio" name="opsi_surat"
                                                value="softfile" id="softfile" />
                                            <label class="form-check-label" for="softfile">
                                                Soft File
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="basic-url" class="form-label">Melampirkan Berkas
                                            Proposal</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="berkas_proposal"
                                                value="Melampirkan 1 berkas proposal" id="iya" />
                                            <label class="form-check-label" for="iya">
                                                Iya
                                            </label>
                                        </div>
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="radio" name="berkas_proposal"
                                                value="-" id="tidak" />
                                            <label class="form-check-label" for="tidak">
                                                Tidak
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="formFile" class="form-label">Melampirkan lembar pengesahan yang sudah ditanda tangani dosen pembimbing/bukti persetujuan mengajukan MBKM dari dosen wali atau pembimbing</label>
                                        <input class="form-control" type="file" name="lembar_pengesahan" id="formFile">
                                      </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <br>
                                            <button type="submit" class="btn btn-primary">
                                                <!--begin::Indicator label-->
                                                <span class="indicator-label">Submit</span>
                                            </button>
                                            <button type="button" class="btn btn-danger" onclick="window.history.back();">
                                                <span class="indicator-label">Cancel</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

            <script>
$(document).ready(function() {
    $('.js-data-basic-single').each(function() {
        var selectElement = $(this);
        var nimInput = selectElement.data('nim-input');
        var nameInput = selectElement.data('name-input');
        

        selectElement.select2({
            allowClear: true,
            placeholder: 'Cari Mahasiswa',
            ajax: {
                url: function(params) {
                    var keyword = params.term;
                    return `http://localhost:8000/api/getfilteredmahasiswa/${keyword}`;
                },
                dataType: 'json',
                processResults: function(data) {
                    var rows = data.query_result.data.rows;
                    
                    var formattedData = rows.map(function(row) {
                        return {
                            id: row.nim,
                            text: row.nama
                        };
                    });
                    
                    return {
                        results: formattedData
                    };
                },
                minimumInputLength: 2,
                data: function(params) {
                    return {
                        term: params.term
                    };
                }
            }
        }).on('select2:select', function (e) {
            var selectedData = e.params.data;

            // Isi nilai NIM ke dalam input tersembunyi terkait
            $(nimInput).val(selectedData.id);

            // Isi nilai nama mahasiswa ke dalam input tersembunyi terkait
            $(nameInput).val(selectedData.text);
           
        }).on("select2:close", function (e) {
            $(nimInput).val(null)
         });
    });

    $('.js-data-basic-single-mahasiswa-3').each(function() {
        var selectElement = $(this);
        var nimInput = selectElement.data('nim-input');
        var nameInput = selectElement.data('name-input');

        selectElement.select2({
            allowClear: true,
            placeholder: 'Cari Mahasiswa',
             width: 'resolve',
            ajax: {
                url: function(params) {
                    var keyword = params.term;
                    return `http://localhost:8000/api/getfilteredmahasiswa/${keyword}`;
                },
                dataType: 'json',
                processResults: function(data) {
                    var rows = data.query_result.data.rows;

                    var formattedData = rows.map(function(row) {
                        return {
                            id: row.nim,
                            text: row.nama
                        };
                    });

                    return {
                        results: formattedData
                    };
                },
                minimumInputLength: 2,
                data: function(params) {
                    return {
                        term: params.term
                    };
                }
            }
        }).on('select2:select', function (e) {
            var selectedData = e.params.data;

            // Isi nilai NIM ke dalam input tersembunyi terkait
            $('#nim3').val(selectedData.id);

            // Isi nilai nama mahasiswa ke dalam input tersembunyi terkait
            $('#hidden_nama_mahasiswa_3').val(selectedData.text);
        }).on("select2:close", function (e) {
            $('#nim3').val(null)
         });
    });
    $('.js-data-basic-single-mahasiswa-4').each(function() {
        var selectElement = $(this);
        var nimInput = selectElement.data('nim-input');
        var nameInput = selectElement.data('name-input');

        selectElement.select2({
        allowClear: true,
        placeholder: 'Cari Mahasiswa',
         width: 'resolve',
            ajax: {
                url: function(params) {
                    var keyword = params.term;
                    return `http://localhost:8000/api/getfilteredmahasiswa/${keyword}`;
                },
                dataType: 'json',
                processResults: function(data) {
                    var rows = data.query_result.data.rows;

                    var formattedData = rows.map(function(row) {
                        return {
                            id: row.nim,
                            text: row.nama
                        };
                    });

                    return {
                        results: formattedData
                    };
                },
                minimumInputLength: 2,
                data: function(params) {
                    return {
                        term: params.term
                    };
                }
            }
        }).on('select2:select', function (e) {
            var selectedData = e.params.data;
            // Isi nilai NIM ke dalam input tersembunyi terkait
            $('#nim4').val(selectedData.id);

            // Isi nilai nama mahasiswa ke dalam input tersembunyi terkait
            $('#hidden_nama_mahasiswa_4').val(selectedData.text);
        }).on("select2:close", function (e) {
            $('#nim4').val(null)
         });
    });
});




            </script>
            @endsection
