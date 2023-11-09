<header id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container navbar-bordered">
    <div class="navbar-nav-wrap">
        <div class="navbar-brand-wrapper">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route("panel.index") }}" aria-label="Front">
                <img class="navbar-brand-logo" src="{{ getCoverImgUrl('logo',2) }}" alt="Logo">
                <img class="navbar-brand-logo-mini" src="{{ getCoverImgUrl('logo',2) }}" alt="Logo">
            </a>
            <!-- End Logo -->
        </div>
        <div class="navbar-nav-wrap-content-left">
            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-3">
                <i class="tio-chevron-left navbar-vertical-aside-toggle-short-align" data-toggle="tooltip" data-placement="right" title="Menü Gizle"></i>
                <i class="tio-chevron-right navbar-vertical-aside-toggle-full-align" data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-toggle="tooltip" data-placement="right" title="Menü Göster"></i>
            </button>
            <!-- End Navbar Vertical Toggle -->
        </div>
    </div>
</header>
