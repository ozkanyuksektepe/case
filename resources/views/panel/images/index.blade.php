@extends('panel.layout.master')
@section('title', 'Resim Listesi')
@section('pageCss')
@endsection
@section('content')
    <div class="content container-fluid">
        <div class="card mb-3">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- Dropzone -->
                    <div id="dropzoneFile" class="js-dropzone dropzone-custom custom-file-boxed border-primary">
                        <div class="dz-message custom-file-boxed-label">
                            <img class="avatar avatar-xl avatar-4by3 mb-3" src="{{ url('/backend/assets/svg/illustrations/browse.svg') }}" alt="Image Description">
                            <h4 class="text-secondary">Resimleri Sürükleyin veya Yüklemek İçin Tıklayın</h4>
                        </div>
                    </div>
                    <!-- End Dropzone -->
                </div>
            </form>
        </div>
        <!-- Card -->
        <div class="card">
            <div class="table-disabled none">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="card-header">
                <h5 class="card-header-title">Yüklenen Resimler</h5>
            </div>
            <div class="card-body">
                <!-- Table -->
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Görsel</th>
                            <th scope="col">Resim Adı</th>
                            <th scope="col">Sırala</th>
                            <th scope="col">Sıra</th>
                            <th scope="col">Durum</th>
                            <th scope="col">Kapak</th>
                            <th scope="col">Sil</th>
                        </tr>
                    </thead>
                    <tbody class="m-sortable" data-url="{{ route('panel.image.rank') }}">
                        @forelse($items as $item)
                            <tr id="ord-{{ $item->id }}">
                                <th scope="row">{{ $item->id }}</th>
                                <td>
                                    <span class="avatar avatar-xl avatar-4by3">
                                        <img class="avatar-img" src="@if( env('CDN') == true ){{ env('CDN_IMG_PREFIX') }}w_200/storage/{{ $item->folder }}/{{ $item->name }}  @else /storage/{{ $item->folder }}/{{ $item->name }}  @endif" alt="Image Description">
                                    </span>
                                </td>
                                <td>{{ $item->name }}</td>
                                <td><a class="item-sortable btn btn-sm btn-info" href="javascript:;" data-toggle="tooltip" data-html="true" title="Sırala"><i class="font-20 tio-expand-all"></i></a></td>
                                <td>{{ $item->rank }}</td>
                                <td>
                                    <label class="toggle-switch toggle-switch d-flex align-items-center pt-1" for="customSwitchSmallSize{{ $item->id }}">
                                        <input type="checkbox" name="status" data-url="{{ route('panel.image.status', ['id' => $item->id]) }}" class="toggle-switch-input" id="customSwitchSmallSize{{ $item->id }}" {{ $item->status ? 'checked' : '' }}>
                                        <span class="toggle-switch-label">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                    </label>
                                </td>
                                <td>
                                    <label class="toggle-switch toggle-switch d-flex align-items-center pt-1" for="customSwitchSmallSize2{{ $item->id }}">
                                        <input type="checkbox" name="cover" data-url="{{ route('panel.image.cover', ['id' => $item->id]) }}" class="toggle-switch-input" id="customSwitchSmallSize2{{ $item->id }}" {{ $item->cover ? 'checked' : '' }}>
                                        <span class="toggle-switch-label">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                    </label>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-danger delete-alert" data-url="{{ route('panel.image.destroy', $item->id) }}" href="javascript:;" data-toggle="tooltip" data-html="true" title="Sil"><i class="tio-remove-from-trash font-20"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr class="odd">
                                <td valign="top" colspan="8" class="dataTables_empty">
                                    <div class="text-center p-4">
                                        <img class="mb-3" src="{{ url('/backend/assets/svg/illustrations/sorry.svg') }}" alt="" style="width: 7rem;">
                                        <p class="mb-0">Çok aradık ama kayıt bulamadık, üzgünüz <i class="tio-sad"></i></p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- End Table -->
            </div>
        </div>
        <!-- End Card -->
    </div>
@endsection
@section('pageJs')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ url('/backend/assets/vendor/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('ready', function () {
            var myDropzone = new Dropzone( '#dropzoneFile', {
                url: "{{ route('panel.image.store') }}",
                paramName: "img",
                params: {
                    folder: '{{ $folder }}',
                    item_id: '{{ $item_id }}',
                    name: '{{ $name }}',
                },
                maxFiles: 30,
                maxFilesize: 1, // MB
                uploadMultiple: false,
                parallelUploads: 1,
                previewTemplate: '<div> <div class="col h-100 px-1 mb-2"> <div class="dz-preview dz-file-preview"> <div class="d-flex justify-content-end dz-close-icon"> <small class="tio-clear" data-dz-remove></small> </div> <div class="dz-details media"> <div class="media-body dz-file-wrapper"> <h6 class="dz-filename"> <span class="dz-title" data-dz-name></span> </h6> <div class="dz-size" data-dz-size></div> </div> </div> <div class="dz-progress progress"> <div class="dz-upload progress-bar bg-success" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div> </div> <div class="d-flex align-items-center"> <div class="dz-success-mark"> <span class="tio-checkmark-circle"></span> </div> <div class="dz-error-mark"> <span class="tio-checkmark-circle-outlined"></span> </div> <div class="dz-error-message"> <small data-dz-errormessage></small> </div> </div> </div> </div></div>',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            myDropzone.on("complete", function(file) {
                $(".dz-message").hide();
                var items = JSON.parse(file.xhr.response);
                var tbody = $('.table tbody');
                setTimeout(() => {
                    myDropzone.removeFile(file);
                    $(".dz-message").show();
                }, 1000);
                tbody.html('');
                items.forEach( (item) => {
                    tbody.append(`
                        <tr id="ord-${item.id}">
                            <th scope="row">${item.id}</th>
                            <td>
                                <span class="avatar avatar-xl avatar-4by3">
                                    <img class="avatar-img" src="@if( env('CDN') == true ){{ env('CDN_IMG_PREFIX') }}w_200/storage/${item.folder}/${item.name}  @else /storage/${item.folder}/${item.name}  @endif" alt="">
                                </span>
                            </td>
                            <td>${item.name}</td>
                            <td><a class="item-sortable btn btn-sm btn-info" data-url="#" href="javascript:;" data-toggle="tooltip" data-html="true" title="Sırala"><i class="font-20 tio-expand-all"></i></a></td>
                            <td>${item.rank}</td>
                            <td>
                                <label class="toggle-switch toggle-switch d-flex align-items-center pt-1" for="customSwitchSmallSize${item.id}">
                                    <input type="checkbox" name="status" data-url="/panel/image/status/${item.id}" class="toggle-switch-input" id="customSwitchSmallSize${item.id}" ${item.status ? 'checked' : ''}>
                                    <span class="toggle-switch-label">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                            <td>
                                <label class="toggle-switch toggle-switch d-flex align-items-center pt-1" for="customSwitchSmallSize2${item.id}">
                                    <input type="checkbox" name="cover" data-url="/panel/image/cover/${item.id}" class="toggle-switch-input" id="customSwitchSmallSize2${item.id}" ${item.cover ? 'checked' : ''}>
                                    <span class="toggle-switch-label">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-danger delete-alert" data-url="/panel/image/destroy/${item.id}" href="javascript:;" data-toggle="tooltip" data-html="true" title="Sil"><i class="tio-remove-from-trash font-20"></i></a>
                            </td>
                        </tr>
                    `);
                });
                deleteAlert();
                swichToggle();
                sortable();
            });
            function sortable(){
                $(".m-sortable").sortable({
                    connectWith: ".m-sortable",
                    placeholder: "sortable-highlight",
                    handle: ".item-sortable",
                });
                $( ".m-sortable" ).disableSelection();
                $(".m-sortable").on("sortupdate", function(){
                    $('.table-disabled').removeClass('none');
                    var $data = $(this).sortable("serialize");
                    var $dataUrl = $(this).data("url");
                    $.post($dataUrl, {data: $data}, function(response){
                        //alert(response);
                        setTimeout(function(){
                            window.location.reload();
                        }, 80);
                    });
                });
            }
            function deleteAlert(){
                $(".delete-alert").click(function() {
                    var $dataUrl = $(this).data("url");
                    Swal.fire({
                        customClass: {
                            confirmButton: 'btn btn-primary mr-1',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false,
                        title: "Silmek istediğinize emin misiniz?",
                        text: "Bu işlemin geri dönüşü yoktur..",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Evet, Sil",
                        cancelButtonText: "Vazgeç",
                    }).then(function(result){
                        if (result.value) {
                            window.location.href = $dataUrl;
                        }
                    });
                });
            }
            function swichToggle(){
                $(".toggle-switch-input").change(function(){
                    $('.table-disabled').removeClass('none');
                    var $data = $(this).prop("checked");
                    var $dataUrl = $(this).data("url");
                    if( $data != "undefined" && $dataUrl != "undefined" ){
                        $.post( $dataUrl, {data : $data}, function(response){
                            console.log(response);
                            setTimeout(function(){
                                window.location.reload();
                            }, 80);
                        });
                    }
                });
            }
            deleteAlert();
            swichToggle();
            sortable();
        });
    </script>
@endsection
