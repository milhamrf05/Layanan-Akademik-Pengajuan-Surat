@extends('layouts.main-staff')
@section('title', 'Detail Pengantar Magang')
@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="row">
            <div class="mb-20 pb-lg-20">

                <!--begin::List-->
                <div class="row items-center">
                    
                    <label for="basic-url" class="form-label">Informasi Form Surat</label>
                    <div class="col-md-6">
                        <label for=""  class="form-label">Keperluan Surat : {{ $additionalFields['keperluan'] }}</label>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Nama Mahasiswa yang mengajukan</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" value="{{ $user->name }}" id="basic-url"
                                aria-describedby="basic-addon3" disabled/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Jenis Surat</label>
                        @if ($jenisFile === 'hardfile')
                        <p>Hard File</p>
                         @else
                         <p>Soft File</p>
                        @endif
                    </div>
                    <!-- Tambahkan informasi form_surat -->
                    <div class="col-md-6"><label for="basic-url" class="form-label">Nama Mahasiswa 1</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="nama_mahasiswa_1" value="{{ $formSurat->nama_mahasiswa_1 }}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">NIM Mahasiswa 1</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="nim_1" value="{{ $formSurat->nim_1 }}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">No HP</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="no_hp" value="{{ $formSurat->no_hp }}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Email Mahasiswa</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="email_mahasiswa" value="{{ $formSurat->email_mahasiswa }}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Jurusan</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="jurusan" value="{{ $formSurat->jurusan }}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <!-- Tambahkan informasi additional_fields jika ada -->
                    @if (!empty($additionalFields))
                    @foreach ($additionalFields as $key => $value)
                    @if ($key !== 'tanggal_surat' && $key !== 'nomor_surat')
                            <div class="col-md-6"><label for="basic-url" class="form-label">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                                <div class="input-group mb-5">
                                    <input type="text" disabled class="form-control" name="additional_fields[{{ $key }}]" value="{{ $value }}" id="basic-url"
                                        aria-describedby="basic-addon3"/>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endif
                    <h6>Lembar Pengesahaan : <a target="_blank" class="btn btn-primary text-white" href="{{ asset('storage/pengantar-magang/lembar-pengesahan/' . $formSurat->lembar_pengesahan) }}">Lihat File</a></h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
