@extends('panel.layout.master')
@section('title', 'Dosya Düzenle')
@section('pageCss')
@endsection
@section('content')
<div class="content container-fluid">
    <div class="card">
        <form action="{{ route('panel.file.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- @method('PUT') --}}
            <div class="card-header"><h4 class="card-header-title">Dosya Düzenle</h4></div>
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <h3 class="alert-heading h4 my-2">Uyarı</h3>
                    @foreach($errors->all() as $error)
                    <p class="mb-0">{{$error}}</p>
                    @endforeach
                </div>
                @endif
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Başlık</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="title" value="{{ old('title')?old('title'):$item->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Açıklama</label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="description" rows="5">{{ old('description')?old('description'):$item->description }}</textarea>
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
                            @php
                                if($item->folder == "catalog"){
                                    $surname = App\Models\Catalog::where('id',$item->item_id)->value("slug");
                                }                
                            @endphp 
                            <a href="{{route('panel.file.show',['folder'=>$item->folder,'item_id'=>$item->item_id,'name'=>$surname])}}" class="btn btn-soft-secondary">İptal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('pageJs')
<script src="{{ url('/backend/assets/js/custom-create.js') }}"></script>
<script src="{{ url('/backend/assets/js/custom-index.js') }}"></script>
@endsection

