@extends('layouts.main')
@section('title', 'Mahasiswa Aktif')
@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body p-lg-17">
                <div class="mb-18">
                    <div class="mb-10">
                        <div class="text-center mb-15">
                            <h3 class="row">Form Pengajuan Surat Mahasiswa Aktif</h3>
                        </div>
                        <div class="mb-20 pb-lg-20">
                            <form action="{{ route('mahasiswa-aktif-store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                                        <div class="input-group mb-5">
                                            <input value="{{ $data_mahasiswa['mhs_nama'] }}"
                                                type="text"
                                                class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                                                id="nama_mahasiswa" name="nama_mahasiswa"
                                                value="{{ old('nama_mahasiswa') }}" readonly />
                                            @error('nama_mahasiswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nim" class="form-label">NIM</label>
                                        <div class="input-group mb-5">
                                            <input value="{{ $data_mahasiswa['mhs_nim'] }}"
                                                type="text" class="form-control @error('nim') is-invalid @enderror"
                                                id="nim" name="nim" value="{{ old('nim') }}"
                                                readonly />
                                            @error('nim')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="jurusan" class="form-label">Progam Studi</label>
                                        <div class="input-group mb-5">
                                            <input value="{{ $data_mahasiswa['mhs_prodi'] }}"
                                                type="text" class="form-control @error('prd_nama') is-invalid @enderror"
                                                id="jurusan" name="jurusan"
                                                value="{{ old('jurusan') }}" readonly />
                                            @error('jurusan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <div class="input-group mb-5">
                                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                                id="alamat"
                                                name="alamat">{{ old('alamat', $data_mahasiswa['mhs_alamat']) }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <div class="input-group mb-5">
                                            <input type="text"
                                                value="{{ $data_mahasiswa['mhs_tempatlahir'] }}"
                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                id="tempat_lahir" name="tempat_lahir"
                                                value="{{ old('tempat_lahir') }}" readonly />
                                            @error('tempat_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <div class="input-group mb-5">
                                            <input type="date"
                                                value="{{ $data_mahasiswa['mhs_tgllahir'] }}"
                                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                id="tanggal_lahir" name="tanggal_lahir"
                                                value="{{ old('tanggal_lahir') }}" readonly />
                                            @error('tanggal_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    @php
                                    $currentYear = date('Y');
                                    $nextYear = $currentYear + 1;
                                    $nextNextYear = $nextYear + 1;
                                    $currentSemester = [
                                        "Gasal {$currentYear}/{$nextYear}" => "Gasal {$currentYear}/{$nextYear}",
                                        "Genap {$currentYear}/{$nextYear}" => "Genap {$currentYear}/{$nextYear}",
                                        "Gasal {$nextYear}/{$nextNextYear}" => "Gasal {$nextYear}/{$nextNextYear}"
                                    ];
                                    @endphp
                                    
                                    <div class="col-md-6">
                                        <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                                        <div class="input-group mb-5">
                                            <select class="form-select @error('tahun_akademik') is-invalid @enderror" name="tahun_akademik" id="tahun_akademik">
                                                <option value="">Open this select menu</option>
                                                @foreach ($currentSemester as $key => $value)
                                                    <option value="{{ $key }}" {{ old('tahun_akademik') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('tahun_akademik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-6">
                                        <label for="nama_orang_tua" class="form-label">Nama Orang Tua</label>
                                        <div class="input-group mb-5">
                                            <input type="text"
                                                value="{{ $data_mahasiswa['mhs_namaayah'] }}"
                                                class="form-control @error('nama_orang_tua') is-invalid @enderror"
                                                id="nama_orang_tua" name="nama_orang_tua"
                                                value="{{ old('nama_orang_tua') }}" readonly />
                                            @error('nama_orang_tua')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="pekerjaan_orang_tua" class="form-label">Pekerjaan Orang Tua</label>
                                        <div class="input-group mb-5">
                                            <input type="text"
                                                value="{{ $data_mahasiswa['mhs_pekerjaanayah'] }}"
                                                class="form-control @error('pekerjaan_orang_tua') is-invalid @enderror"
                                                id="pekerjaan_orang_tua" name="pekerjaan_orang_tua"
                                                value="{{ old('pekerjaan_orang_tua') }}" />
                                            @error('pekerjaan_orang_tua')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="alamat_orang_tua" class="form-label">Alamat Orang Tua</label>
                                        <div class="input-group mb-5">
                                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                            id="alamat"
                                            name="alamat_orang_tua">{{ old('alamat', $data_mahasiswa['mhs_alamat']) }}</textarea>
                                            @error('alamat_orang_tua')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="keperluan" class="form-label">Keperluan</label>
                                        <div class="input-group mb-5">
                                            <input type="text"
                                                class="form-control @error('keperluan') is-invalid @enderror"
                                                id="keperluan" name="keperluan"
                                                value="{{ old('keperluan') }}" />
                                            @error('keperluan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="opsi_surat" class="form-label">Opsi Surat</label>
                                        <div class="form-check">
                                            <input class="form-check-input @error('opsi_surat') is-invalid @enderror"
                                                type="radio" name="opsi_surat" value="hardfile" id="hardfile"
                                                {{ is_array(old('opsi_surat')) && in_array('hardfile', old('opsi_surat')) ? 'checked' : '' }} />
                                            <label class="form-check-label" for="hardfile">Hard File</label>
                                            @error('opsi_surat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-check mt-3">
                                            <input class="form-check-input @error('opsi_surat') is-invalid @enderror"
                                                type="radio" name="opsi_surat" value="softfile" id="softfile"
                                                {{ is_array(old('opsi_surat')) && in_array('softfile', old('opsi_surat')) ? 'checked' : '' }} />
                                            <label class="form-check-label" for="softfile">Soft File</label>
                                            @error('opsi_surat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <br>
                                            <button type="submit" class="btn btn-primary">
                                                <span class="indicator-label">Submit</span>
                                            </button>
                                            <button type="submit" class="btn btn-danger" id="kt_contact_submit_button">
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
            <script>
                const button = document.getElementById('kt_docs_sweetalert_basic');

                button.addEventListener('click', e => {
                    e.preventDefault();

                    Swal.fire({
                        html: `Berhasil`,
                        icon: "success",
                        buttonsStyling: false,
                        showCancelButton: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                });

            </script>
            @endsection
