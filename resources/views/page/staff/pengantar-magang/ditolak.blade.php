@extends('layouts.main-staff')
@section('title', 'Beranda')
@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row">
                    <form action="{{ route('staff_page.tolak.surat', $pengajuanSurat->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Alasan Menolak</label>
                            <textarea name="alasan_ditolak" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                          </div>
                        <div class="col-md-12">
                        <button class="mt-10 btn btn-primary" type="submit">Tolak</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
