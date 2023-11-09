@extends('panel.layout.master')
@section('title', 'Blog Güncelle')
@section('pageCss')
@endsection
@section('content')
    <div class="content container-fluid">
        <div class="card">
            <form action="{{ route('panel.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="card-header">
                    <h4 class="card-header-title">Blog Güncelle</h4>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label text-right">Kategori Güncelle *</label>
                    <div class="col-md-6">
                      <select name="blog_category_id" required class="js-select2-custom custom-select" size="1" style="opacity: 0;" data-hs-select2-options='{"placeholder": "Lütfen Seçiniz", "searchInputPlaceholder": "Arama Yap" }'>
                        <option label="empty"></option>
                        @foreach($category as $cat)
                          <option {{ $cat->id == $blog->blog_category_id ? 'selected' : '' }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Başlık</label>
                        <div class="col-md-6">
                            <input type="text" required class="form-control" name="name" value="{{ $blog->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Açıklama</label>
                        <div class="col-md-6">
                            <textarea class="ckeditor form-control" name="description">{{ $blog->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Sıra</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="rank" value="{{ $blog->rank }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Durum</label>
                        <div class="col-md-6">
                            <label class="toggle-switch toggle-switch d-flex align-items-center pt-1" for="customSwitchSmallSize">
                                <input type="checkbox" name="status" class="toggle-switch-input" id="customSwitchSmallSize" {{ $blog->status ? 'checked' : '' }}>
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
                            <a title="İptal" href="{{ route('panel.blog.index') }}" class="btn btn-soft-secondary">İptal</a>
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
<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
@endsection

