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
                <div class="">
                    <!--begin::Wrapper-->
                    <div class="mb">
                        <!--begin::Top-->
                        <div class="text-center mb-15">
                            <!--begin::Title-->
                            <h3 class="fs-2hx text-gray-900 mb-5">Surat Keterangan Mahasiswa Aktif</h3>
                            <!--end::Title-->
                            <!--begin::Text-->
                            @if(session('success'))
                                <!--begin::Alert-->
                                <div class="alert alert-primary d-flex align-items-center p-5">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span
                                            class="path1"></span><span class="path2"></span></i>
                                    <!--end::Icon-->

                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Title-->
                                        <!--end::Title-->

                                        <!--begin::Content-->
                                        <span>{{ session('success') }}</span>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Alert-->
                            @endif
                        </div>
                        <div class="mb-20 pb-lg-20">
                            <!--begin::Title-->
                            <h2 class="fw-bold text-gray-900 mb-8">Langkah-langkah Pengajuan Surat Keterangan Mahasiswa
                                Aktif  :</h2>
                            <!--end::Title-->
                            <!--begin::List-->
                            <div class="fs-5 fw-semibold mb-6">

                                <p class="text-gray-700">1. Surat dapat diterima mahasiswa maksimal 3 hari kerja setelah mengisi form dibawah ini "Buat Pengajuan"</p>
                                <p class="text-gray-700">2. Apabila dalam 3 hari kerja surat belum diterima mahasiswa atau terdapat kesalahan
                                    penulisan,
                                    segera konfirmasi WA </p>
                            </div>
                            <a type="button" href="{{ url('deskripsi/mahasiswa-aktif/buat') }}"
                                class="btn btn-primary">Buat
                                Pengajuan</a>
                        </div>
                    </div>
                </div>
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mt-3 card shadow p-4">
                                    <div class="row">
                                        <h2 class="fw-bold text-gray-900 mb-8">Riwayat Pengajuan</h2>
                                    </div>
                                    <table class="table align-middle table-row-dashed fs-6 gy-5"
                                    id="kt_ecommerce_products_table">
                                    <thead>

                                            <tr
                                                class="text-start text-black-500 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="w-10px pe-2">
                                                </th>
                                                <th class="min-w-200px">Nama Mahasiswa</th>
                                                <th class="min-w-150px">Jenis Surat</th>
                                                <th class="min-w-100px">Tanggal</th>
                                                <th class="min-w-100px">Status</th>
                                                <th class="min-w-100px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach ($riwayat as $r)
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                    <div class="text-gray-800">
                                                      {{ $r->user->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-gray-800">
                                                        {{ $r->kategoriSurat->nama }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-gray-800"> {{ \Carbon\Carbon::parse($r->created_at)->format('d/m/Y') }}
                                                    </div>
                                                </td>
                                                <td class="text-start pe-10" data-order="Inactive">
                                                    <!--begin::Badges-->
                                                    @if($r->status === 'pending')
                                                    <div class="badge badge-lg badge-light-warning">
                                                        Pending
                                                    </div>
                                                    @elseif($r->status === 'ditolak')
                                                    <div class="badge badge-lg badge-light-danger">
                                                        Di Tolak
                                                    </div>
                                                    @else
                                                    <div class="badge badge-lg badge-light-success">
                                                        Di setujui
                                                    </div>
                                                    @endif
                                                    <!--end::Badges-->
                                                </td>
                                                <td class="text-start">
                                                    <a href="#"
                                                        class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                        data-kt-menu-trigger="click"
                                                        data-kt-menu-placement="bottom-end">Aksi
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            @if ($r->status === 'disetujui')
                                                            <div class="menu-item px-3">
                                                                <form action="{{route('staff_page.download.surat', ['id' => $r->id])}}" method="GET">
                                                                    @csrf
                                                                    <button type="submit"
                                                                    class="menu-link btn px-3">Download</button>
                                                                </form>
                                                            </div>
                                                            @endif
                                                            @if ($r->alasan_ditolak !== null)
                                                            <div class="menu-item px-3">
                                                                <a href="{{route('showAlasanDiTolak', ['id' => $r->id])}}" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Alasan ditolak</a>
                                                            </div>
                                                            @endif
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                            </tr>
                                            @endforeach
                                    </table>
                                </div>
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
</div>
@endsection
