@extends('layouts.main-staff')
@section('title', 'Edit Mahasiswa Aktif')
@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body p-lg-17">
                <div class="mb-18">
                    <div class="mb-10">
                        <div class="text-center mb-15">
                            <h3 class="fs-2hx text-gray-900 mb-5">Form Lihat Pengajuan Surat Mahasiswa Aktif</h3>
                        </div>
                        <div class="mb-20 pb-lg-20">
                            <form action="{{ route('mahasiswa-aktif-update', ['id' => $id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!--begin::List-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                                        <div class="input-group mb-5">
                                            <input type="text" value="{{$formSurat->nama_mahasiswa}}" class="form-control @error('nama_mahasiswa') is-invalid @enderror" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}" readonly/>
                                            @error('nama_mahasiswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nim" class="form-label">NIM</label>
                                        <div class="input-group mb-5">
                                            <input type="text" value="{{$formSurat->nim}}" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim') }}" readonly/>
                                            @error('nim')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="jurusan" class="form-label">Progam Studi</label>
                                        <div class="input-group mb-5">
                                            <input type="text" value="{{$formSurat->jurusan}}" class="form-control @error('jurusan') is-invalid @enderror" id="nim" name="jurusan" value="{{ old('jurusan') }}" readonly/>
                                            @error('jurusan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <div class="input-group mb-5">
                                            <input value="{{$formSurat->alamat}}" type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}" readonly/>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <div class="input-group mb-5">
                                            <input value="{{$formSurat->tempat_lahir}}" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" readonly/>
                                            @error('tempat_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <div class="input-group mb-5">
                                            <input value="{{$formSurat->tanggal_lahir}}" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" readonly/>
                                            @error('tanggal_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                                        <div class="input-group mb-5">
                                            <input type="text" value="{{$formSurat->tahun_akademik}}" class="form-control @error('tahun_akademik') is-invalid @enderror" id="tahun_akademik" name="tahun_akademik" value="{{ old('tahun_akademik') }}" readonly/>
                                            @error('tahun_akademik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nama_orang_tua" class="form-label">Nama Orang Tua</label>
                                        <div class="input-group mb-5">
                                            <input value="{{$formSurat->nama_orang_tua}}" type="text" class="form-control @error('nama_orang_tua') is-invalid @enderror" id="nama_orang_tua" name="nama_orang_tua" value="{{ old('nama_orang_tua') }}" />
                                            @error('nama_orang_tua')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="pekerjaan_orang_tua" class="form-label">Pekerjaan Orang Tua</label>
                                        <div class="input-group mb-5">
                                            <input value="{{$formSurat->pekerjaan_orang_tua}}" type="text" class="form-control @error('pekerjaan_orang_tua') is-invalid @enderror" id="pekerjaan_orang_tua" name="pekerjaan_orang_tua" value="{{ old('pekerjaan_orang_tua') }}" readonly/>
                                            @error('pekerjaan_orang_tua')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="alamat_orang_tua" class="form-label">Alamat Orang Tua</label>
                                        <div class="input-group mb-5">
                                            <input value="{{$formSurat->alamat_orang_tua}}" type="text" class="form-control @error('alamat_orang_tua') is-invalid @enderror" id="alamat_orang_tua" name="alamat_orang_tua" value="{{ old('alamat_orang_tua') }}" readonly/>
                                            @error('alamat_orang_tua')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="keperluan" class="form-label">Keperluan</label>
                                        <div class="input-group mb-5">
                                            <input value="{{$formSurat->keperluan}}" type="text" class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" name="keperluan" value="{{ old('keperluan') }}" readonly/>
                                            @error('keperluan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="opsi_surat" class="form-label">Opsi Surat</label>
                                        <div class="input-group mb-5">
                                            <input value="{{$formSurat->opsi_surat}}" type="text" class="form-control @error('opsi_surat') is-invalid @enderror" id="opsi_surat" name="opsi_surat" value="{{ old('opsi_surat') }}" readonly/>
                                            @error('opsi_surat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection
