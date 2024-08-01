@extends('layouts.main-admin')
@section('title', 'Admin')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body p-lg-17">
                    <div class="mb-18">
                        <div class="mb-10">
                            <div class="text-row mb-15">
                                <h10 class="fs-2hx text-gray-900 mb-5">Template Surat</h10>
                                @if(session('success'))
                                    <div class="alert alert-primary d-flex align-items-center p-5">
                                        <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                        <div class="d-flex flex-column">
                                            <span>{{ session('success') }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-20 pb-lg-20">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                                    <thead>
                                        <tr class="text-start text-black-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-200px">Nama Template </th>
                                            <th class="min-w-70px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach ($surat as $index => $item)
                                            <tr>
                                                <td>
                                                    <a href="{{ url('admin/template/' . basename($item))}}" target="_blank" class="text-gray-800 ">
                                                        {{ basename($item) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/template/' . basename($item)) }}" class="btn btn-sm btn-primary">
                                                        Download
                                                    </a>
                                                    <a href="#" type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ubahtemplate{{ $index }}">
                                                        <span class="indicator-label">Ubah</span>
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('page.admin.modal-ubah')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
