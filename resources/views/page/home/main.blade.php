@extends('layouts.main')
@section('title', 'Beranda')
@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3 card shadow p-4">
                    <div class="row">
                        <div class="text-center mb-15">
                            <!--begin::Title-->
                            <h2 class="fs-2hx text-gray-900 mb-5">Menu Layanan Pengajuan Surat</h2>
                            <!--end::Title-->
                            <!--begin::Text-->
                        </div>
                        <!--begin::Row-->
                        <!--begin::Col-->
                        <div class="col-sm-4">
                            <!--begin::Card-->
                            <div class="card h-100">
                                <!--begin::Card body-->
                                <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                    <!--begin::Name-->
                                    <a href="{{ route('cuti-akademik-deskripsi') }}"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="assets/media/logo/cuti.svg" style="width:200px; height:200px"
                                                class="theme-light-show" alt="" />
                                            <img src="assets/media/svg/files/pdf-dark.svg" class="theme-dark-show"
                                                alt="" />
                                        </div>
                                        <!--end::Image-->
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">Cuti Akademik</div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->
                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500"></div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Row-->
                        <!--begin::Col-->
                        <div class="col-sm-4">
                            <!--begin::Card-->
                            <div class="card h-100">
                                <!--begin::Card body-->
                                <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                    <!--begin::Name-->
                                    <a href="{{ url('deskripsi/mahasiswa-aktif') }}"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="assets/media/logo/aktif.svg" style="width:200px; height:200px"
                                                class="theme-light-show" alt="" />
                                            <img src="assets/media/svg/files/pdf-dark.svg" class="theme-dark-show"
                                                alt="" />
                                        </div>
                                        <!--end::Image-->
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">Keterangan Mahasiswa Aktif</div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->
                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500"></div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Row-->
                        <!--begin::Col-->
                        <div class="col-sm-4">
                            <!--begin::Card-->
                            <div class="card h-100">
                                <!--begin::Card body-->
                                <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                    <!--begin::Name-->
                                    <a href="{{ route('transkrip-akademik-sementara-index') }}"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="assets/media/logo/transkrip.svg" style="width:200px; height:200px"
                                                class="theme-light-show" alt="" />
                                            <img src="assets/media/svg/files/pdf-dark.svg" class="theme-dark-show"
                                                alt="" />
                                        </div>
                                        <!--end::Image-->
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">Transkrip Akademik Sementara</div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->
                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500"></div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Row-->
                        <!--begin::Col-->
                        <div class="col-sm-4">
                            <!--begin::Card-->
                            <div class="card h-100">
                                <!--begin::Card body-->
                                <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                    <!--begin::Name-->
                                    <a href="{{ url('deskripsi/pengantar-magang') }}"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="assets/media/logo/magang.svg" style="width:200px; height:200px"
                                                class="theme-light-show" alt="" />
                                            <img src="assets/media/svg/files/pdf-dark.svg" class="theme-dark-show"
                                                alt="" />
                                        </div>
                                        <!--end::Image-->
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">Pengantar Magang</div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->
                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500"></div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Row-->
                        <!--begin::Col-->
                        <div class="col-sm-4">
                            <!--begin::Card-->
                            <div class="card h-100">
                                <!--begin::Card body-->
                                <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                    <!--begin::Name-->
                                    <a href="{{ url('deskripsi/pengantar-penelitian') }}"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="assets/media/logo/penelitian.svg" style="width:200px; height:200px"
                                            class="theme-light-show" alt="" />
                                            <img src="assets/media/svg/files/pdf-dark.svg" class="theme-dark-show"
                                                alt="" />
                                        </div>
                                        <!--end::Image-->
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">Pengantar Penelitian</div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->
                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500"></div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Row-->
                        <!--begin::Col-->
                        <div class="col-sm-4">
                            <!--begin::Card-->
                            <div class="card h-100">
                                <!--begin::Card body-->
                                <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                    <!--begin::Name-->
                                    <a href="{{ route('pengunduranDiriIndex') }}"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="assets/media/logo/pengunduran.svg" style="width:200px; height:200px"
                                                class="theme-light-show" alt="" />
                                        </div>
                                        <!--end::Image-->
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">Pengunduran Diri</div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->
                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500"></div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
