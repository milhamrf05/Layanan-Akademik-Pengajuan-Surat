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
                            <h3 class="fs-2hx text-gray-900 mb-5">Surat Transkrip Akademik Sementara</h3>
                            <!--end::Title-->
                            <!--begin::Text-->
                        </div>
                        <div class="mb-20 pb-lg-20">
                            <!--begin::Title-->
                            <h2 class="fw-bold text-gray-900 mb-8">Langkah-langkah Mengunduh Transkrip Akademik Sementara :</h2>
                            <!--end::Title-->
                            <!--begin::List-->
                            <div class="fs-5 fw-semibold mb-6">
                                <p>Deskripsi :</p>
                                <p class="text-gray-700">Traskrip Akademik Sementara Mahasiswa dapat diunduh langsung melalui halaman ini</p>
                                <br>
                            </div>
                            <form action="{{route('transkrip-akademik-sementara-store')}}" method="POST">
                                @csrf
                                <input type="hidden" name="lang" value="id">
                            <button class="btn btn-primary" type="submit">Download (Bahasa Indonesia)</button>
                            </form>
                            <form action="{{route('transkrip-akademik-sementara-store')}}" method="POST" class="mt-3">
                                @csrf
                                <input type="hidden" name="lang" value="en">
                            <button class="btn btn-primary" type="submit">Download (English)</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
