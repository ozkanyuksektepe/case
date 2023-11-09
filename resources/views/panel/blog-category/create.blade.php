@extends('panel.layout.master')
@section('title', 'Blog Kategorisi Ekle')
@section('pageCss')
@endsection
@section('content')
    <div class="content container-fluid">
        <div class="card">
            <form action="{{ route('panel.blog-category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h4 class="card-header-title">Blog Kategorisi Ekle</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Başlık</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Sıra</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="rank" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Durum</label>
                        <div class="col-md-6">
                            <label class="toggle-switch toggle-switch d-flex align-items-center pt-1" for="customSwitchSmallSize">
                                <input type="checkbox" name="status" class="toggle-switch-input" id="customSwitchSmallSize" checked>
                                <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row mb-0">
                        <label class="col-md-3 col-form-label text-right"></label>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary mr-2 btn-spinner-show">
                                <div class="spinner-border none text-white" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span class="btn-text">Kaydet</span>
                            </button>
                            <a title="İptal" href="{{ route('panel.blog-category.index') }}" class="btn btn-soft-secondary">İptal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('pageJs')
<script src="{{ url('/backend/assets/js/custom-create.js')}}"></script>
<script src="{{ url('backend/assets/vendor/hs-unfold/dist/hs-unfold.min.js')}}"></script>
<script src="{{ url('/backend/assets/js/custom-index.js')}}"></script>
@endsection

