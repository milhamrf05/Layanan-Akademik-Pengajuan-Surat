@extends('layouts.main')
@section('title', 'Riwayat')
@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3 card shadow p-4">
                    <div class="row">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-ecommerce-product-filter="search"
                                class="form-control form-control-solid w-250px ps-12" placeholder="Search Product" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                        <thead>
                            <tr class="text-start text-black-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                </th>
                                <th class="min-w-200px">Nama Mahasiswa</th>
                                <th class="min-w-150px">Jenis Surat</th>
                                <th class="min-w-100px">Tanggal</th>
                                <th class="min-w-100px">Prodi</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                        data-kt-ecommerce-product-filter="product_name">Mochammad Ilham Ramadhan
                                        Firmansyah
                                    </div>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                        data-kt-ecommerce-product-filter="product_name">Surat Pengantar Magang
                                    </div>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                        data-kt-ecommerce-product-filter="product_name">28 Mei 2024
                                    </div>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                        data-kt-ecommerce-product-filter="product_name">Informatika
                                    </div>
                                </td>
                                <td class="text-start pe-10" data-order="Inactive">
                                    <!--begin::Badges-->
                                    <div class="badge badge-lg badge-light-danger">Tolak</div>
                                    <!--end::Badges-->
                                </td>
                                <td class="text-start">
                                    <a href="#"
                                        class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                class="menu-link px-3">Setujui</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-product-filter="delete_row">Tolak</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-product-filter="delete_row">Lihat</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-product-filter="delete_row">Edit</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                        data-kt-ecommerce-product-filter="product_name">Mochammad Ilham Ramadhan
                                        Firmansyah
                                    </div>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                        data-kt-ecommerce-product-filter="product_name">Surat Pengantar Magang
                                    </div>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                        data-kt-ecommerce-product-filter="product_name">28 Mei 2024
                                    </div>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                        data-kt-ecommerce-product-filter="product_name">Informatika
                                    </div>
                                </td>
                                <td class="text-start pe-10" data-order="Inactive">
                                    <!--begin::Badges-->
                                    <div class="badge badge-lg badge-light-warning">proses</div>
                                    <!--end::Badges-->
                                </td>
                                <td class="text-start">
                                    <a href="#"
                                        class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                class="menu-link px-3">Setujui</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-product-filter="delete_row">Tolak</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-product-filter="delete_row">Lihat</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-product-filter="delete_row">Edit</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                        data-kt-ecommerce-product-filter="product_name">Mochammad Ilham Ramadhan
                                        Firmansyah
                                    </div>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                        data-kt-ecommerce-product-filter="product_name">Surat Pengantar Magang
                                    </div>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                        data-kt-ecommerce-product-filter="product_name">28 Mei 2024
                                    </div>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                        data-kt-ecommerce-product-filter="product_name">Informatika
                                    </div>
                                </td>
                                <td class="text-start pe-10" data-order="Inactive">
                                    <!--begin::Badges-->
                                    <div class="badge badge-lg badge-light-success">succes</div>
                                    <!--end::Badges-->
                                </td>
                                <td class="text-start">
                                    <a href="#"
                                        class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                class="menu-link px-3">Setujui</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-product-filter="delete_row">Tolak</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-product-filter="delete_row">Lihat</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-product-filter="delete_row">Edit</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
