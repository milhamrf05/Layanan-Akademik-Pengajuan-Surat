@extends('layouts.main')
@section('title', 'Cuti Akademik')
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
                                <h3 class="row">Form Pengajuan Cuti Akademik</h3>
                                <!--end::Title-->

                                <!--begin::Text-->
                            </div>
                            <div class="mb-20 pb-lg-20">
                                <form action="{{route('cuti-akademik-store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                                        <div class="input-group mb-5">
                                            <input value="{{ $mahasiswa['mhs_namalengkap'] }}" type="text" class="form-control" readonly />
                                            @error('nama_mahasiswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                        <label for="nama_mahasiswa" class="form-label">NIM</label>
                                        <div class="input-group mb-5">
                                            <input value="{{ $mahasiswa['mhs_nim'] }}" type="text" class="form-control" readonly />
                                            @error('nama_mahasiswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                        <label for="nama_mahasiswa" class="form-label">Progam Studi</label>
                                        <div class="input-group mb-5">
                                            <input value="{{ $mahasiswa['prd_nama'] }}" type="text" class="form-control" readonly />
                                            @error('nama_mahasiswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                        <label for="nama_mahasiswa" class="form-label">Email</label>
                                        <div class="input-group mb-5">
                                            <input value="{{ $mahasiswa['mhs_email'] }}" type="text" class="form-control" readonly />
                                            @error('nama_mahasiswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Upload File Pengajuan</label>
                                                <input class="form-control" name="file" type="file" id="formFile">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary">
                                                <!--begin::Indicator label-->
                                                <span class="indicator-label">Submit</span>
                                            </button>
                                            <button type="cancel" class="btn btn-danger">
                                                <!--begin::Indicator label-->
                                                <span class="indicator-label">Cancel</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
    