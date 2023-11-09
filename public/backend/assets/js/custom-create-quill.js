$(document).on('ready', function (){
    var quill = $.HSCore.components.HSQuill.init('.js-quill');
    quill.on('text-change', function(){
        $('#desc').text($('.js-quill .ql-editor').html());
    });
    $('.btn-spinner-show').on('click', (function(){
        var btnText = $(this).find('.btn-text');
        var text = btnText.text();
        btnText.text('')
        $('.spinner-border').removeClass('none');
        setTimeout(() => {
            $('.spinner-border').addClass('none');
            btnText.text(text);
        }, 3000);
    }));
});
