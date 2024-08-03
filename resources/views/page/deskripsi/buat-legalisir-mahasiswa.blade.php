@extends('layouts.main')
@section('title', 'Mahasiswa Aktif')
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
                            <h3 class="fs-2hx text-gray-900 mb-5">Form Pengajuan Surat Legalisir Mahasiswa</h3>
                            <!--end::Title-->
                            <!--begin::Text-->
                        </div>
                        <div class="mb-20 pb-lg-20">
                            <!--begin::List-->
                            <div class="row">
                                <div class="col-md-6"><label for="basic-url" class="form-label">Upload File</label>
                                    <div class="input-group mb-5">
                                        <input class="form-control" type="file" id="formFile"
                                            aria-describedby="basic-addon3" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary" id="kt_docs_sweetalert_basic">
                                            <!--begin::Indicator label-->
                                            <span class="indicator-label">Submit</span>
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="window.history.back();">
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
