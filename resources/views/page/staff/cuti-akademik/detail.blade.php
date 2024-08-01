@extends('layouts.main-staff')
@section('title', 'Detail Pengajuan cuti akademik')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>Detail Pengajuan cuti akademik</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h5>Nama</h5>
        </div>
        <div class="col-md-9">
            <h5>{{ $mahasiswa['mhs_namalengkap'] }}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h5>Email</h5>
        </div>
        <div class="col-md-9">
            <h5>{{ $mahasiswa['mhs_email'] }}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h5>NIM</h5>
        </div>
        <div class="col-md-9">
            <h5>{{ $mahasiswa['mhs_nim'] }}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h5>Prodi</h5>
        </div>
        <div class="col-md-9">
            <h5>{{ $mahasiswa['prd_nama'] }}</h5>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-primary" href="{{ route('show-surat', ['id' => $surat_id]) }}">Lihat File</a>
    </div>
</div>

@endsection