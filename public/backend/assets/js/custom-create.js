$(document).on('ready', function (){
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
