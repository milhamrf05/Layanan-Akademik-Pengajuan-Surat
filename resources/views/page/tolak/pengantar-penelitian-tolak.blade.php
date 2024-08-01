@extends('layouts.main')
@section('title', 'Alasan di tolak Pengantar Penelitian')
@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::About card-->
        <div class="row">
            <div class="col-md-8 col-sm-10 col-xs-12">
                <h1>Alasan Di Tolak</h1>
                <p>
                    {{$alasan}}
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
