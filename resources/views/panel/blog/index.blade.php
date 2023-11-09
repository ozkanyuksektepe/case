@extends('panel.layout.master')
@section('title', 'Blog İçerikleri')
@section('pageCss')
@endsection
@section('content')
    <div class="content container-fluid">
        <!-- Card -->
        <div class="card mb-3 mb-lg-5">
            <div class="table-disabled none">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <!-- Header -->
            <div class="card-header">
                <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-12 col-md">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-header-title">Blog İçerikleri ({{ $blog->count() }})</h4>
                    </div>
                </div>
                    <div class="col-auto">
                        <!-- Filter -->
                        <div class="row align-items-sm-center">
                            <div class="col-sm-auto">
                                <div class="d-flex align-items-center mr-2">
                                <span class="text-secondary mr-2">Durum:</span>
                                <!-- Select -->
                                <select class="js-select2-custom js-datatable-filter custom-select-sm" size="1" style="opacity: 0;" data-target-column-index="3"
                                    data-hs-select2-options='{
                                        "minimumResultsForSearch": "Infinity",
                                        "customClass": "custom-select custom-select-sm",
                                        "dropdownAutoWidth": true,
                                        "width": true
                                    }'>
                                    <option value="">Tümü</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Pasif">Pasif</option>
                                </select>
                                <!-- End Select -->
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <form>
                                    <!-- Search -->
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch" type="search" class="form-control form-control-sm" placeholder="Arama Yap" aria-label="Arama Yap">
                                    </div>
                                    <!-- End Search -->
                                </form>
                            </div>
                            <div class="mr-3 ml-4">
                                <a title="Yeni Ekle" href="{{ route('panel.blog.create') }}" class="btn btn-sm btn-success btn-spinner-show"><i class="tio-add"></i> Yeni Ekle</a>
                            </div>
                        </div>
                        <!-- End Filter -->
                    </div>
                </div>
            </div>
            <!-- End Header -->
            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table id="datatable" class="table table-hover table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                        "columnDefs": [{
                            "targets": [-1],
                            "orderable": false
                        }],
                        "order": [],
                        "info": {
                            "totalQty": "#datatableWithPaginationInfoTotalQty"
                        },
                        "search": "#datatableSearch",
                        "entries": "#datatableEntries",
                        "pageLength": 20,
                        "isResponsive": true,
                        "isShowPaging": true,
                        "pagination": "datatablePagination"
                    }'>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="table-column-pr-0">ID</th>
                            <th width="25">Resim</th>
                            <th>Kategori</th>
                            <th>Başlık</th>
                            <th>Sıra</th>
                            <th>Durum</th>
                            <th width="50">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blog as $blo)
                            @php $imgName = $blo->name ? Str::slug($blo->name) : 'blog-img'; @endphp
                            <tr>
                                <td class="table-column-pr-0">#{{ $blo->id }}</td>
                                <td>
                                    <span class="avatar avatar-xl avatar-4by3">
                                        <a title="Resim Yükle" href="{{ route('panel.image.show', ['folder' => 'blog', 'item_id' => $blo->id, 'name' => $imgName]) }}"><img class="avatar-img" src="{{ getCover($blo->cover) }}" alt="{{ $blo->name }}"></a>
                                    </span>
                                </td>
                                <td>
                                  {{ $blo->categories->name }}
                                </td>
                                <td>
                                  {{ $blo->name }}
                                </td>
                                <td>{{ $blo->rank }}</td>
                                <td><span class="legend-indicator {{ $blo->status ? 'bg-success' : 'bg-secondary' }}"></span>{{ $blo->status ? 'Aktif' : 'Pasif' }} </td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{ route('panel.blog.edit', $blo->id) }}" data-toggle="tooltip" data-html="true" title="Düzenle"><i class="tio-new-message font-20"></i></a>
                                    <a class="btn btn-sm btn-danger delete-alert" data-url="{{ route('panel.blog.destroy', $blo->id) }}" href="javascript:;" data-toggle="tooltip" data-html="true" title="Sil"><i class="tio-remove-from-trash font-20"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End Table -->
            <!-- Footer -->
            <div class="card-footer">
                <!-- Pagination -->
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                            <span class="mr-2">Gösterim:</span>
                            <!-- Select -->
                            <select id="datatableEntries" class="js-select2-custom" data-hs-select2-options='{
                                    "minimumResultsForSearch": "Infinity",
                                    "customClass": "custom-select custom-select-sm custom-select-borderless",
                                    "dropdownAutoWidth": true,
                                    "width": true
                                }'>
                                <option value="10">10</option>
                                <option value="20" selected>20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>
                            <!-- End Select -->
                            <span class="text-secondary mr-2">Kayıt</span>
                            <!-- Pagination Quantity -->
                            <span id="datatableWithPaginationInfoTotalQty"></span>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <!-- Pagination -->
                            <nav id="datatablePagination" aria-label="Activity pagination"></nav>

                        </div>
                    </div>
                </div>
                <!-- End Pagination -->
            </div>
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>
@endsection
@section('pageJs')
    <script src="{{ url('backend/assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('backend/assets/vendor/hs-sticky-header/src/hs.sticky-header.js')}}"></script>
    <script src="{{ url('backend/assets/vendor/hs-unfold/dist/hs-unfold.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('backend/assets/js/custom-index.js')}}"></script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                //timer: 3000
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                //timer: 3000
            });
        </script>
    @endif
@endsection

