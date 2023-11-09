<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') - Crealive Case</title>
        <link rel="shortcut icon" href="{{ getCoverImgUrl("icon",0) }}">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('/backend/assets/vendor/icon-set/style.css') }}">
        @yield('pageCss')
        <link rel="stylesheet" href="{{ url('/backend/assets/vendor/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ url('/backend/assets/css/theme.min.css') }}">
        <link rel="stylesheet" href="{{ url('/backend/assets/css/custom.css') }}">
    </head>
    <body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl footer-offset">
        @include('panel.layout.include.header')
        @include('panel.layout.include.aside')
        <main id="content" role="main" class="main">
            <!-- Content -->
            @yield('content')
            <!-- End Content -->
            @include('panel.layout.include.footer')
        </main>
        <!-- JS Global Compulsory  -->
        <script src="{{ url('/backend/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ url('/backend/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
        <script src="{{ url('/backend/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <!-- JS Implementing Plugins -->
        <script src="{{ url('/backend/assets/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside.min.js') }}"></script>
        <script src="{{ url('/backend/assets/vendor/select2/dist/js/select2.full.min.js') }}"></script>
        <!-- JS Front -->
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script src="{{ url('/backend/assets/js/theme.min.js') }}"></script>
        <!-- JS Plugins Init. -->
        @yield('pageJs')
        <script>
            $(document).on('ready', function(){
                var sidebar = $('.js-navbar-vertical-aside').hsSideNav();
                $('.js-select2-custom').each(function (){
                    var select2 = $.HSCore.components.HSSelect2.init($(this));
                });
                var path = $(location).attr('href');
                $('ul.navbar-nav li a[href="'+path+'"]').parent('li').addClass('active');
            });
        </script>
    </body>
</html>
