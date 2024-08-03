@extends('layouts.main')
@section('title', 'Pengantar Penelitian')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body p-lg-17">
                    <div class="mb-18">
                        <div class="mb-10">
                            <div class="text-center mb-15">
                                <h3 class="row">Form Pengajuan Surat Pengantar Penelitian</h3>
                            </div>
                            <div class="mb-20 pb-lg-20">
                                <form action="{{ route('post-pengantar-penelitian') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="keperluan_surat" class="form-label">Keperluan Surat</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="keperluan_surat"
                                                    value="Skripsi" id="keperluan_surat_skripsi" />
                                                <label class="form-check-label"
                                                    for="keperluan_surat_skripsi">Skripsi</label>
                                            </div>
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="radio" name="keperluan_surat"
                                                    value="Wawancara atau observasi tugas mata kuliah"
                                                    id="keperluan_surat_wawancara" />
                                                <label class="form-check-label" for="keperluan_surat_wawancara">Wawancara
                                                    atau observasi tugas mata kuliah</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa 1</label>
                                            <input type="text" class="form-control" id="nama_mahasiswa"
                                                name="nama_mahasiswa" autocomplete="off"  value="{{$data_mahasiswa['mhs_namalengkap']}}" readonly>
                                            <div id="mahasiswaList"
                                                class="position-absolute start-0 mt-2 w-100 bg-light border rounded-3 shadow-sm d-none">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="no_telepon" class="form-label">NIM</label>
                                            <input id="nim" type="number" name="nim" class="form-control"  value="{{$data_mahasiswa['mhs_nim']}}" readonly/>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="basic-url" class="form-label">Nama Mahasiswa 2</label>
                                            <div class="mb-5">
                                                <select class="js-data-basic-single form-control" id="nama_mahasiswa_2" data-nim-input="#nim2" data-name-input="#hidden_nama_mahasiswa_2">  <option></option></select>
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
                                             id="nama_mahasiswa_3">  <option></option></select>
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
                                            id="nama_mahasiswa_4">  <option></option></select>
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

                                        <div class="col-md-6 mb-5">
                                            <label for="no_telepon" class="form-label">Email Mahasiswa 1</label>
                                            <input id="email" type="email" class="form-control" name="email_mahasiswa"  value="{{$data_mahasiswa['mhs_email']}}" readonly/>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="no_telepon" class="form-label">No Telepon</label>
                                            <input type="text" class="form-control" name="no_telepon" id="no_telepon" />
                                        </div>
                                        <!-- Add similar fields for additional students if needed -->

                                        <div class="col-md-6">
                                        <label for="jurusan" class="form-label">Progam Studi</label>
                                        <div class="input-group mb-5">
                                                <input value="{{$data_mahasiswa['prd_nama']}}" type="text" class="form-control @error('prd_nama') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan') }}" readonly />
                                            @error('jurusan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                        <div class="col-md-6">
                                            <label for="surat_ditujukan_kepada" class="form-label">Surat Ditujukan
                                                Kepada</label>
                                            <input type="text" class="form-control" name="surat_ditujukan_kepada"
                                                id="surat_ditujukan_kepada" />
                                        </div>

                                        <div class="col-md-6 mb-5">
                                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                            <input type="text" class="form-control" name="nama_perusahaan"
                                                id="nama_perusahaan" />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                                            <input type="text" class="form-control" name="alamat_perusahaan"
                                                id="alamat_perusahaan" />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="kode_pos_perusahaan" class="form-label">Kode Pos
                                                Perusahaan</label>
                                            <input type="text" class="form-control" name="kode_pos_perusahaan"
                                                id="kode_pos_perusahaan" />
                                        </div>

                                        <div class="col-md-6 mb-5">
                                            <label for="dosen_pembimbing" class="form-label">Dosen Pembimbing</label>
                                            <input type="text" class="form-control" name="dosen_pembimbing"
                                                id="dosen_pembimbing" />
                                        </div>

                                        <div class="col-md-6 mb-5">
                                            <label for="waktu_kerja_praktik" class="form-label">Waktu Kerja
                                                Praktik</label>
                                            <input type="text" class="form-control" name="waktu_kerja_praktik"
                                                id="waktu_kerja_praktik" />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="tugas_mata_kuliah" class="form-label">Tugas Mata Kuliah</label>
                                            <input type="text" class="form-control" name="tugas_mata_kuliah"
                                                id="tugas_mata_kuliah" />
                                        </div>

                                        <div class="col-md-6 mb-5">
                                            <label for="topik_judul_yang_dibahas" class="form-label">Topik/Judul yang
                                                Dibahas</label>
                                            <input type="text" class="form-control" name="topik_judul_yang_dibahas"
                                                id="topik_judul_yang_dibahas" />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="melampirkan_proposal" class="form-label">Melampirkan
                                                Proposal</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="melampirkan_proposal" value="1"
                                                    id="melampirkan_proposal_ya" />
                                                <label class="form-check-label" for="melampirkan_proposal_ya">Iya</label>
                                            </div>
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="radio"
                                                    name="melampirkan_proposal" value="0"
                                                    id="melampirkan_proposal_tidak" />
                                                <label class="form-check-label"
                                                    for="melampirkan_proposal_tidak">Tidak</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="lembar_pengesahan_dosen_pembimbing" class="form-label">Lembar
                                                Pengesahan yang Ditandatangani Dosen Pembimbing</label>
                                            <input class="form-control" type="file"
                                                name="lembar_pengesahan_dosen_pembimbing"
                                                id="lembar_pengesahan_dosen_pembimbing" />
                                        </div>

                                        <div class="col-md-6">
                                            <br>
                                            <label for="opsi_surat" class="form-label">Opsi Surat</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="opsi_surat[]"
                                                    value="Hard File" id="opsi_surat_hard" />
                                                <label class="form-check-label" for="opsi_surat_hard">Hard File</label>
                                            </div>
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="radio" name="opsi_surat[]"
                                                    value="Soft File" id="opsi_surat_soft" />
                                                <label class="form-check-label" for="opsi_surat_soft">Soft File</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <br>
                                            <button type="submit" class="btn btn-primary">
                                                <span class="indicator-label">Submit</span>
                                            </button>
                                            <button type="button" class="btn btn-danger" onclick="window.history.back();">
                                                <span class="indicator-label">Cancel</span>
                                            </button>
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
         });;
    });

    $('.js-data-basic-single-mahasiswa-3').each(function() {
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
            $('#nim3').val(selectedData.id);

            // Isi nilai nama mahasiswa ke dalam input tersembunyi terkait
            $('#hidden_nama_mahasiswa_3').val(selectedData.text);
        }).on("select2:close", function (e) {
            $('#nim3').val(null);
         });;
    });
    $('.js-data-basic-single-mahasiswa-4').each(function() {
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
            $('#nim4').val(selectedData.id);

            // Isi nilai nama mahasiswa ke dalam input tersembunyi terkait
            $('#hidden_nama_mahasiswa_4').val(selectedData.text);
        }).on("select2:close", function (e) {
            $('#nim4').val(null);
         });;
    });
});


            </script>
            @endsection
