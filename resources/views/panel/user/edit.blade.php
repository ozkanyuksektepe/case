@extends('panel.layout.master')
@section('title', 'Kullanıcı Güncelle')
@section('pageCss')
@endsection
@section('content')
    <div class="content container-fluid">
        <div class="card">
            <form action="{{ route('panel.user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('put')
                @if($errors->any())
                    @foreach($errors->all() as $error)
                    <div class="alert alert-warning" role="alert">{{$error}}</div>
                    @endforeach
                @endif
                <div class="card-header">
                    <h4 class="card-header-title">Kullanıcı Güncelle</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Ad *</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="{{ old('name')?old('name'):$item->name }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Soyad *</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="surname" value="{{ old('surname')?old('surname'):$item->surname }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">E-Posta *</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email')?old('email'):$item->email }}" required>
                        </div>
                    </div>
                    <!--
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Telefon</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="phone" value="{{ old('phone')?old('phone'):$item->phone }}">
                        </div>
                    </div>
                    -->
                    <!--
                    <div class="form-group row">
                        <label for="password" class="input-label col-md-3 col-form-label text-right">Parola</label>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge">
                                <input type="password" class="js-toggle-password form-control" id="password" name="password" placeholder="Mevcut şifreyi değiştirmek için giriniz."
                                data-hs-toggle-password-options='{
                                    "target": ".js-password-toggle-target",
                                    "defaultClass": "tio-hidden",
                                    "showClass": "tio-visible",
                                    "classChangeTarget": "#changePassIcon"
                                }' autocomplete="new-password">
                                <a class="input-group-append js-password-toggle-target" href="javascript:;"><span class="input-group-text"><i id="changePassIcon"></i></span></a>
                            </div>
                        </div>
                    </div>
                    -->
                    <!--<div class="row form-group">
                        <label for="newPassword" class="col-sm-3 col-form-label input-label text-right">Parola</label>
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
                            }' onkeyup="document.getElementById('passwordLabel').value=document.getElementById('newPassword').value" maxlength="16" >
                            <p id="passwordStrengthVerdict" class="form-text mb-2"></p>
                            <div id="passwordStrengthProgress"></div>
                        </div>
                    </div>-->
                    <div class="row form-group">
                        <label for="passwordLabel" class="col-sm-3 col-form-label input-label text-right">Parola</label>
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <input type="password" class="js-toggle-password form-control" id="passwordLabel" name="password"
                                data-hs-toggle-password-options='{
                                    "target": ".js-password-toggle-target",
                                    "defaultClass": "tio-hidden",
                                    "showClass": "tio-visible",
                                    "classChangeTarget": "#changePassIcon"
                                }' placeholder="Mevcut şifreyi değiştirmek için bir şifre giriniz." autocomplete="off">
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
                        <label class="col-sm-3 col-form-label input-label text-right">Mail gönderilsin mi?</label>
                        <div class="col-sm-6">
                            <div class="input-group input-group-sm-down-break">
                                <div class="form-control">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="confirm" value="1" id="confirm1">
                                        <label class="custom-control-label" for="confirm1">Evet</label>
                                    </div>
                                </div>
                                <div class="form-control">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="confirm" value="0" id="confirm2" checked>
                                        <label class="custom-control-label" for="confirm2">Hayır</label>
                                    </div>
                                </div>
                            </div>
                            <p>Evet işaretlerseniz bu bilgiler kullanıcı mail adresine gönderilir.</p>
                        </div>
                    </div> --}}
                    <!--
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Durum</label>
                        <div class="col-md-6">
                            <label class="toggle-switch toggle-switch d-flex align-items-center pt-1" for="customSwitchSmallSize">
                                <input type="checkbox" name="status" class="toggle-switch-input" id="customSwitchSmallSize" {{ $item->status ? 'checked' : '' }}>
                                <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    -->
<!-- Form Group -->
<div class="row">
    <label class="col-sm-3 col-form-label input-label text-right">Durum</label>
    <div class="col-sm-6">
        <div class="input-group input-group-sm-down-break">
            <!-- Custom Radio -->
            <div class="form-control">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="status" value="0" id="status0" {{ $item->status==0 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="status0">Pasif</label>
                </div>
            </div>
            <!-- End Custom Radio -->
            <!-- Custom Radio -->
            <div class="form-control">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="status" value="1" id="status1" {{ $item->status==1 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="status1">Aktif</label>
                </div>
            </div>
            <!-- End Custom Radio -->
            <!-- Custom Radio -->
            <div class="form-control">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="status" value="2" id="status2" {{ $item->status==2 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="status2">Onay Bekliyor</label>
                </div>
            </div>
            <!-- End Custom Radio -->
        </div>
    </div>
</div>
<!-- End Form Group -->
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
<script src="{{ url('/backend/assets/js/custom-create.js') }}"></script>
<script src="{{ url('/backend/assets/js/custom-index.js')}}"></script>
<script src="{{ url('/backend/assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js') }}"></script>
<script>
$(document).on('ready',function(){
    $('.js-toggle-password').each(function () {
        new HSTogglePassword(this).init()
    })
})
</script>
@endsection
