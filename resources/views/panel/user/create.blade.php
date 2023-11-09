@extends('panel.layout.master')
@section('title', 'Kullanıcı Ekle')
@section('pageCss')
@endsection
@section('content')
    <div class="content container-fluid">
        <div class="card">
            <form action="{{ route('panel.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h4 class="card-header-title">Kullanıcı Ekle</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                        <div class="alert alert-warning" role="alert">{{$error}}</div>
                        @endforeach
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Ad *</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="{{ old('name')?old('name'):'' }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Soyad *</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="surname" value="{{ old('surname')?old('surname'):'' }}" required>
                        </div>
                    </div>
                    <!--
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Kullanıcı Adı *</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="username" value="{{ old('username')?old('username'):'' }}" required>
                        </div>
                    </div>
                    -->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">E-Posta *</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email')?old('email'):'' }}" required>
                        </div>
                    </div>
                    <!--
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Parola *</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="password" required>
                        </div>
                    </div>
                    -->
<!--
<div class="row form-group">
    <label for="currentPasswordLabel" class="col-sm-3 col-form-label input-label">Current password</label>
    <div class="col-sm-9">
        <input type="password" class="form-control" name="currentPassword" id="currentPasswordLabel" placeholder="Enter current password" aria-label="Enter current password">
    </div>
</div>
-->
                    <!--<div class="row form-group">
                        <label for="newPassword" class="col-sm-3 col-form-label input-label text-right">Parola *</label>
                        <div class="col-sm-6">
                            <input type="password" class="js-pwstrength form-control" name="password" id="newPassword" placeholder="Bir şifre giriniz." aria-label="Bir şifre giriniz."
                            data-hs-pwstrength-options='{
                                "ui": {
                                    "container": "#changePasswordForm",
                                    "viewports": {
                                        "progress": "#passwordStrengthProgress",
                                        "verdict": "#passwordStrengthVerdict"
                                    }
                                }
                            }' onkeyup="document.getElementById('passwordLabel').value=document.getElementById('newPassword').value" maxlength="16" required>
                            <p id="passwordStrengthVerdict" class="form-text mb-2"></p>
                            <div id="passwordStrengthProgress"></div>
                        </div>
                    </div>-->
                    <div class="row form-group">
                        <label for="passwordLabel" class="col-sm-3 col-form-label input-label text-right">Parola *</label>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <input type="password" class="js-toggle-password form-control" id="passwordLabel" name="password"
                                data-hs-toggle-password-options='{
                                    "target": ".js-password-toggle-target",
                                    "defaultClass": "tio-hidden",
                                    "showClass": "tio-visible",
                                    "classChangeTarget": "#changePassIcon"
                                }' autocomplete="off">
                                <span class="input-group-text"><a class="tio-refresh" href="javascript:" onclick="
var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
var randomstring = '';
for (var i=0; i<8; i++) {
    var rnum = Math.floor(Math.random() * chars.length);
    randomstring += chars.substring(rnum,rnum+1);
}
// document.getElementById('newPassword').value=randomstring;
document.getElementById('passwordLabel').value=randomstring;
                                // document.getElementById('newPassword').value=Math.floor(Math.random()*1000)
                                "></a></span>
                                <span class="input-group-text js-password-toggle-target"><a id="changePassIcon" href="javascript:"></a></span>
                            </div>
                        </div>
                    </div>
                    {{-- <div id="accountType" class="row form-group">
                        <label class="col-sm-3 col-form-label input-label text-right">Kullanıcıya mail gönder?</label>
                        <div class="col-sm-6">
                            <div class="input-group input-group-sm-down-break">
                                <div class="form-control">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="confirm" value="1" id="confirm1" checked>
                                        <label class="custom-control-label" for="confirm1">Evet</label>
                                    </div>
                                </div>
                                <div class="form-control">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="confirm" value="0" id="confirm2">
                                        <label class="custom-control-label" for="confirm2">Hayır</label>
                                    </div>
                                </div>
                            </div>
                            <p>Evet işaretlerseniz bu bilgiler kullanıcı mail adresine gönderilir.</p>
                        </div>
                    </div> --}}
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
                            <a title="İptal" href="{{ route('panel.user.index') }}" class="btn btn-soft-secondary">İptal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('pageJs')
<script src="{{ url('/backend/assets/vendor/hs-unfold/dist/hs-unfold.min.js')}}"></script>
<script src="{{ url('/backend/assets/js/custom-create.js') }}"></script>
<script src="{{ url('/backend/assets/js/custom-index.js')}}"></script>
<script src="{{ url('/backend/assets/vendor/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js') }}"></script>
<script>
$(document).on('ready',function(){
    $('.js-pwstrength').each(function(){
        var pwstrength = $.HSCore.components.HSPWStrength.init($(this));
    })
})
</script>
<script src="{{ url('/backend/assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js') }}"></script>
<script>
$(document).on('ready', function () {
    $('.js-toggle-password').each(function () {
        new HSTogglePassword(this).init()
    });
});
</script>
@endsection
