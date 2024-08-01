@extends('layouts.main-staff')
@section('title', 'Beranda')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-3 card shadow p-4">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="text" data-kt-ecommerce-product-filter="search"
                                        class="form-control form-control-solid w-250px ps-12" placeholder="Search" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <div class="w-100 mw-150px">
                                    <form action="{{ route('staff_page') }}" method="get">
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="status" data-control="select2"
                                        data-hide-search="true" data-placeholder="Status"
                                        data-kt-ecommerce-product-filter="status">
                                        <option value="all">All</option>
                                        <option value="disetujui">Disetujui</option>
                                        <option value="pending">Dipending</option>
                                        <option value="ditolak">Ditolak</option>
                                    </select>
                                    <button class="mt-2 btn btn-primary btn-sm" type="submit">Filter</button>
                                </form>
                                    <!--end::Select2-->
                                </div>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <div class="row justify-center">
                            <div class="col-md-6 col-sm-10 col-xs-10">
                                @if (session('success'))
                                    <div class="alert alert-danger">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-black-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                    </th>
                                    <th class="min-w-200px">Nama Mahasiswa</th>
                                    <th class="min-w-100px">Email</th>
                                    <th class="min-w-150px">Jenis Surat</th>
                                    <th class="min-w-100px">Tanggal</th>
                                    <th class="min-w-100px">Status</th>
                                    <th class="min-w-70px">Aksi</th>
                                </tr>
                            </thead>
                            @forelse ($pengajuanSurat as $p)
                                <tbody class="fw-semibold text-gray-600">
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <div class="text-gray-800 ">
                                                {{ $p->user->name }}</div>
                                        </td>
                                        <td>
                                            <div class="text-gray-800">
                                                {{ $p->user->email }}</div>
                                        </td>
                                        <td>
                                            <div class="text-gray-800">
                                                {{ $p->kategoriSurat->nama }}</div>
                                        </td>
                                        <td>
                                            <div class="text-gray-800"> {{ \Carbon\Carbon::parse($p->created_at)->format('d-M-Y') }}
                                            </div>
                                        </td>
                                        @if ($p->status === 'disetujui')
                                            <td class="text-start pe-10" data-order="Inactive">
                                                <!--begin::Badges-->
                                                <div class="badge badge-lg badge-light-success">Disetujui</div>
                                                <!--end::Badges-->
                                            </td>
                                        @elseif ($p->status === 'pending')
                                            <td class="text-start pe-10" data-order="Inactive">
                                                <!--begin::Badges-->
                                                <div class="badge badge-lg badge-light-warning">Pending</div>
                                                <!--end::Badges-->
                                            </td>
                                        @else
                                            <td class="text-start pe-10" data-order="Inactive">
                                                <!--begin::Badges-->
                                                <div class="badge badge-lg badge-light-danger">Ditolak</div>
                                                <!--end::Badges-->
                                            </td>
                                        @endif
                                        <td class="text-start">
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi <i
                                                    class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    @if ($p->kategoriSurat->nama === 'surat pengantar magang')
                                                        <form
                                                            action="{{ route('staff_page.setujui.surat', ['id' => $p->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                class="menu-link px-3 btn btn-light">Setujui</button>
                                                        </form>
                                                    @elseif ($p->kategoriSurat->nama === 'surat keterangan mahasiswa aktif')
                                                        <form
                                                            action="{{ route('setujuiMahasiswaAktif', ['id' => $p->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                class="menu-link px-3 btn btn-light">Setujui</button>
                                                        </form>
                                                    @elseif ($p->kategoriSurat->nama === 'surat pengantar penelitian')
                                                        <form
                                                            action="{{ route('staff-pengantar-penelitian-setujui', ['id' => $p->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                class="menu-link px-3 btn btn-light">Setujui</button>
                                                        </form>
                                                    @elseif ($p->kategoriSurat->nama === 'Surat Cuti Akademik')
                                                        <form
                                                            action="{{ route('cuti-akademik-setujui', ['id' => $p->id]) }}"
                                                            method="get">
                                                            @csrf
                                                            <button type="submit"
                                                                class="menu-link px-3 btn btn-light">Setujui</button>
                                                        </form>
                                                    @elseif ($p->kategoriSurat->nama === 'Surat Pengunduran Diri')
                                                    <form
                                                        action="{{ route('setujui-surat-pengunduran-diri', ['id' => $p->id]) }}"
                                                        method="get">
                                                        @csrf
                                                        <button type="submit"
                                                        class="menu-link px-3 btn btn-light">Setujui</button>
                                                    </form>
                                                    @endif
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('staff_page.show.tolak.surat', ['id' => $p->id]) }}"
                                                        class="menu-link px-3 btn btn-light"
                                                        data-kt-ecommerce-product-filter="delete_row">Tolak</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('staff_page.download.surat', ['id' => $p->id]) }}"
                                                        class="menu-link px-3"
                                                        data-kt-ecommerce-product-filter="delete_row">Download</a>
                                                    </div>
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('redirectToLihat', ['id' => $p->id]) }}"
                                                        class="menu-link px-3"
                                                        data-kt-ecommerce-product-filter="delete_row">Lihat</a>
                                                </div>
                                                {{-- <div class="menu-item px-3">
                                                    @if ($p->kategoriSurat->nama == 'surat pengantar magang')
                                                        <a href="{{ route('staff_page.edit.pengantar_magang', ['id' => $p->id]) }}"
                                                            class="menu-link px-3"
                                                            data-kt-ecommerce-product-filter="delete_row">Edit</a>
                                                    @elseif ($p->kategoriSurat->nama == 'surat keterangan mahasiswa aktif')
                                                        <a href="{{ route('mahasiswa-aktif-edit', ['id' => $p->id]) }}"
                                                            class="menu-link px-3"
                                                            data-kt-ecommerce-product-filter="delete_row">Edit</a>
                                                    @endif
                                                </div> --}}
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No data found</td>
                                    </tr>
                            @endforelse
                            </tbody>
                        </table>
                        </div>
                        <!-- Pagination links -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $pengajuanSurat->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
