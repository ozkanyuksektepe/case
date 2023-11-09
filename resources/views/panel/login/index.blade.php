<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Panel Giriş</title>
        <link rel="shortcut icon" href="{{ getCoverImgUrl('icon',0) }}">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('/backend/assets/vendor/icon-set/style.css') }}">
        <link rel="stylesheet" href="{{ url('/backend/assets/css/theme.min.css') }}">
        <link rel="stylesheet" href="{{ url('/backend/assets/css/custom.css') }}">
    </head>

        <body>
        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main" class="main">
            <div class="position-fixed top-0 right-0 left-0 bg-img-hero" style="height: 32rem; background-image: url({{ url('/backend/assets/svg/components/abstract-bg-4.svg') }});">
                <!-- SVG Bottom Shape -->
                <figure class="position-absolute right-0 bottom-0 left-0">
                    <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 273">
                    <polygon fill="#fff" points="0,273 1921,273 1921,0 "/>
                    </svg>
                </figure>
                <!-- End SVG Bottom Shape -->
            </div>

            <!-- Content -->
            <div class="container py-5 py-sm-7">

                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-5">
                    <!-- Card -->
                    <div class="card card-lg mb-5">
                        <div class="card-body">
                            <!-- Form -->
                            <form class="js-validate" action="{{ route('panel.login.auth') }}" method="POST">
                                @csrf
                                <div class="text-center">
                                    <div class="mb-5">
                                        <h1 class="display-4">Giriş Yap</h1>
                                        <p>Lütfen kullanıcı adı ve şifre bilgilerini doldurunuz</p>
                                    </div>
                                </div>
                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="input-label" for="signinSrEmail">E-Posta</label>
                                    <input type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" id="signinSrEmail" tabindex="1" placeholder="E-posta adresiniz" aria-label="E-posta adresiniz" data-msg="E-postanızı doğru formatta yazınız" required>
                                </div>
                                <!-- End Form Group -->
                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="input-label" for="signupSrPassword" tabindex="0">
                                        <span class="d-flex justify-content-between align-items-center">
                                        Şifre
                                        {{-- <a class="input-label-secondary" href="authentication-reset-password-basic.html">Forgot Password?</a> --}}
                                        </span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <input type="password" class="js-toggle-password form-control form-control-lg" name="password" value="{{ old('password') }}" id="signupSrPassword" placeholder="Şifre yazınız" aria-label="Şifre yazınız" required
                                            data-msg="Şifre alanı boş bırakılamaz"
                                            data-hs-toggle-password-options='{
                                                "target": "#changePassTarget",
                                                "defaultClass": "tio-hidden-outlined",
                                                "showClass": "tio-visible-outlined",
                                                "classChangeTarget": "#changePassIcon"
                                            }'>
                                        <div id="changePassTarget" class="input-group-append">
                                            <a class="input-group-text" href="javascript:;">
                                                <i id="changePassIcon" class="tio-visible-outlined"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <!-- Checkbox -->
                                {{-- <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="termsCheckbox" name="termsCheckbox">
                                        <label class="custom-control-label text-muted" for="termsCheckbox"> Remember me</label>
                                    </div>
                                </div> --}}
                                <!-- End Checkbox -->
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-lg btn-block btn-primary btn-spinner-show">
                                    <div class="spinner-border none text-white" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <span class="btn-text">Giriş Yap</span>
                                </button>
                            </form>
                            <!-- End Form -->
                            </div>
                        </div>
                        <!-- End Card -->
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Content -->
        </main>
        <!-- ========== END MAIN CONTENT ========== -->

        <!-- JS Global Compulsory  -->
        <script src="{{ url('/backend/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ url('/backend/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
        <script src="{{ url('/backend/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

        <!-- JS Implementing Plugins -->
        <script src="{{ url('/backend/assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js') }}"></script>
        <script src="{{ url('/backend/assets/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>

        <!-- JS Front -->
        <script src="{{ url('/backend/assets/js/theme.min.js') }}"></script>

        <!-- JS Plugins Init. -->
        <script>
            $(document).on('ready', function () {
                $('.js-toggle-password').each(function () {
                    new HSTogglePassword(this).init()
                });
                $('.js-validate').each(function() {
                    $.HSCore.components.HSValidation.init($(this));
                });
                $('.btn-spinner-show').on('click', (function(){
                    var btnText = $(this).find('.btn-text');
                    var text = btnText.text();
                    btnText.text('')
                    $('.spinner-border').removeClass('none');
                    setTimeout(() => {
                        $('.spinner-border').addClass('none');
                        btnText.text(text);
                    }, 2000);
                }));
            });
        </script>
    </body>
</html>
