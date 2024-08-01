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
                    <label for="basic-url" class="form-label">Informasi Form Surat </label>
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
                    <div class="col-md-6"><label for="basic-url" class="form-label">Jenis Surat</label>
                        @if ($jenisFile === 'hardfile')
                        <p>Hard File</p>
                         @else
                         <p>Soft File</p>
                        @endif
                    </div>
                    <!-- Tambahkan informasi form_surat -->
                    <div class="col-md-6"><label for="basic-url" class="form-label">No HP</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="no_telepon" value="{{$formSurat->additional_fields['no_telepon']}}" name="no_telepon" id="no_telepon"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Email Mahasiswa</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="email_mahasiswa" value="{{$formSurat->additional_fields['email_mahasiswa']}}"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Jurusan</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="jurusan" value="{{ $formSurat->jurusan }}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Surat Ditujukan
                        Kepada</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="surat_ditujukan_kepada" value="{{$formSurat->surat_ditujukan_kepada}}" " id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Nama Perusahaan</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="nama_perusahaan" value="{{$formSurat->nama_perusahaan}}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Alamat Perusahaan</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="alamat_perusahaan" value="{{$formSurat->alamat_perusahaan}}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Kode Pos
                        Perusahaan</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="kode_pos_perusahaan" value="{{$formSurat->kode_pos_perusahaan}}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Dosen Pembimbing</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="dosen_pembimbing" value="{{$formSurat->dosen_pembimbing}}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Waktu Kerja
                        Praktik</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="waktu_kerja_praktik" value="{{$formSurat->waktu_kerja_praktik}}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Tugas Mata Kuliah</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="tugas_mata_kuliah" value="{{$formSurat->tugas_mata_kuliah}}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Topik/Judul yang
                        Dibahas</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="topik_judul_yang_dibahas" value="{{$formSurat->topik_judul_yang_dibahas}}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Melampirkan
                        Proposal</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="melampirkan_proposal" value="{{$formSurat->melampirkan_proposal}}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Lembar
                        Pengesahan yang Ditandatangani Dosen Pembimbing</label>
                        <div class="input-group mb-5">
                            <a target="_blank" href="{{asset('storage/pengantar-penelitian/lembar-pengesahan/'.$formSurat->lembar_pengesahan_dosen_pembimbing)}}">Lihat File</a>
                            <input type="text" disabled class="form-control" name="lembar_pengesahan_dosen_pembimbing" value="{{$formSurat->lembar_pengesahan_dosen_pembimbing}}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                    <div class="col-md-6"><label for="basic-url" class="form-label">Keperluan Surat</label>
                        <div class="input-group mb-5">
                            <input type="text" disabled class="form-control" name="keperluan_surat" value="{{$formSurat->keperluan_surat}}" id="basic-url"
                                aria-describedby="basic-addon3"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
