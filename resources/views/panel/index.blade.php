@extends('panel.layout.master')
@section('title','Kontrol Paneli')
@section('pageCss')
@endsection
@section('content')
<!-- Content -->
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0"><h1 class="page-header-title">Kontrol Paneli</h1></div>
            <div class="col-sm-auto">

            </div>
        </div>
    </div>
    <!-- End Page Header -->

    <!-- Stats -->
    <div class="row gx-2 gx-lg-3">
        {{-- <div class="col-sm-6 col-lg-6 mb-4 mb-lg-6">
            <!-- Card -->
            <a class="card card-hover-shadow h-100" href="#">
                <div class="card-body">
                    <h6 class="card-subtitle"></h6>
                    <div class="row align-items-center gx-2 mb-1">
                        <div class="col-6"><span class="card-title h2">--</span></div>
                    </div>
                    <!-- End Row -->
                </div>
            </a>
            <!-- End Card -->
        </div> --}}
        {{-- <div class="col-sm-6 col-lg-6 mb-4 mb-lg-6">
            <!-- Card -->
            <a class="card card-hover-shadow h-100" href="#">
                <div class="card-body">
                    <h6 class="card-subtitle"></h6>
                    <div class="row align-items-center gx-2 mb-1">
                        <div class="col-6"><span class="card-title h2">--</span></div>
                    </div>
                    <!-- End Row -->
                </div>
            </a>
            <!-- End Card -->
        </div> --}}
    </div>
    <!-- End Stats -->
</div>
@endsection
@section('pageJs')
<script src="{{ url('/backend/assets/vendor/hs-unfold/dist/hs-unfold.min.js')}}"></script>
<script src="{{ url('/backend/assets/js/custom-index.js') }}"></script>
@endsection
