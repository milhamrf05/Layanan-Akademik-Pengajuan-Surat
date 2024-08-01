@extends('layouts.main')
@section('title', 'Mahasiswa Aktik')
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
                            <h3 class="row">Form Pengajuan Surat Pengunduran Diri</h3>
                            <!--end::Title-->
                            <!--begin::Text-->
                        </div>
                        <div class="mb-20 pb-lg-20">
                            <!--begin::List-->
                            <div class="row">
                                <div class="col-md-6"><label for="basic-url" class="form-label">Nama Mahasiswa</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Email</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">NIM</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Jurusan</label>
                                    <div class="input-group mb-5">
                                        <select class="form-select" aria-label="Select example">
                                            <option>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"/>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Pria
                                        </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"/>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Agama</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Alamat</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Tempat Lahir</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Tanggal lahir</label>
                                    <div class="input-group mb-5">
                                        <input type="date" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">No Telepon</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Tahun Masuk</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">IPK/IPS Terakhir</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Jumlah SKS Terakhir yang lulus</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Alasan Mengundurkan Diri</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Nama Orang Tua</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Pekerjaan Orang Tua</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-md-6"><label for="basic-url" class="form-label">Alamat Orang Tua</label>
                                    <div class="input-group mb-5">
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary" id="kt_docs_sweetalert_basic">
                                            <!--begin::Indicator label-->
                                            <span class="indicator-label">Submit</span>
                                        </button>
                                        <button type="submit" class="btn btn-danger" id="kt_contact_submit_button">
                                            <!--begin::Indicator label-->
                                            <span class="indicator-label">Cancel</span>
                                        </button>
                                    </div>
                                </div>
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
