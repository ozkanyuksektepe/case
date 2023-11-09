$(document).on("ready", function () {
    var datatable = $.HSCore.components.HSDatatables.init($("#datatable"), {
        select: {
            style: "multi",
            classMap: {
                checkAll: "#datatableCheckAll",
                counter: "#datatableCounter",
                counterInfo: "#datatableCounterInfo",
            },
        },
        language: {
            zeroRecords:
                '<div class="text-center p-4">' +
                '<img class="mb-3" src="/backend/assets/svg/illustrations/sorry.svg" alt="" style="width: 7rem;">' +
                '<p class="mb-0">Çok aradık ama kayıt bulamadık, üzgünüz <i class="tio-sad"></i></p>' +
                "</div>",
        },
        dom: "Bfrtip",
        buttons: [
            {
                extend: "copy",
                className: "d-none",
            },
            {
                extend: "excel",
                className: "d-none",
            },
            {
                extend: "csv",
                className: "d-none",
            },
            {
                extend: "pdf",
                className: "d-none",
            },
            {
                extend: "print",
                className: "d-none",
            },
        ],
    });

    $("#export-copy").click(() => {
        datatable.button(".buttons-copy").trigger();
    });

    $("#export-excel").click(() => {
        datatable.button(".buttons-excel").trigger();
    });

    $("#export-csv").click(() => {
        datatable.button(".buttons-csv").trigger();
    });

    $("#export-pdf").click(() => {
        datatable.button(".buttons-pdf").trigger();
    });

    $("#export-print").click(() => {
        datatable.button(".buttons-print").trigger();
    });

    // var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
    //     select: {
    //         style: 'multi',
    //         classMap: {
    //             checkAll: '#datatableCheckAll',
    //             counter: '#datatableCounter',
    //             counterInfo: '#datatableCounterInfo'
    //         }
    //     },
    //     language: {
    //         zeroRecords: '<div class="text-center p-4">' +
    //             '<img class="mb-3" src="/panel/assets/svg/illustrations/sorry.svg" alt="" style="width: 7rem;">' +
    //             '<p class="mb-0">Çok aradık ama kayıt bulamadık, üzgünüz <i class="tio-sad"></i></p>' +
    //             '</div>'
    //     }
    // });

    $(".js-datatable-filter").on("change", function () {
        var $this = $(this),
            elVal = $this.val(),
            targetColumnIndex = $this.data("target-column-index");
        datatable.column(targetColumnIndex).search(elVal).draw();
    });
    $("#datatableSearch").on("mouseup", function (e) {
        deleteAlert();
        var $input = $(this),
            oldValue = $input.val();
        if (oldValue == "") return;
        setTimeout(function () {
            var newValue = $input.val();
            if (newValue == "") {
                datatable.search("").draw();
            }
        }, 1);
    });

    $(".btn-spinner-show").on("click", function () {
        $(".table-disabled").removeClass("none");
        setTimeout(() => {
            $(".table-disabled").addClass("none");
        }, 3000);
    });
    $("#datatablePagination *").on("click", function () {
        //alert('tıklandı');
        deleteAlert();
    });
    deleteAlert();
});

var unfold = new HSUnfold(".js-hs-unfold-invoker").init();

function deleteAlert() {
    $(".delete-alert").click(function () {
        var dataUrl = $(this).data("url");
        Swal.fire({
            customClass: {
                confirmButton: "btn btn-primary mr-1",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
            title: "Silmek istediğinize emin misiniz?",
            text: "Bu işlemin geri dönüşü yoktur..",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Evet, Sil",
            cancelButtonText: "Vazgeç",
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: dataUrl,
                    type: "DELETE",
                }).done(function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Kayıt Silindi!!",
                        showConfirmButton: false,
                    });
                    setTimeout(() => {
                        window.location.href = response;
                    }, 1000);
                });
            }
        });
    });
}
