<aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <div class="navbar-brand-wrapper justify-content-between">
            <!-- Logo -->
                <a class="navbar-brand" href="{{ route("panel.index") }}" aria-label="Front">
                    <img class="navbar-brand-logo" src="{{ getCoverImgUrl('logo',0) }}" alt="Logo">
                    <img class="navbar-brand-logo-mini" src="{{ getCoverImgUrl('logo',0) }}" alt="Logo">
                </a>
            <!-- End Logo -->
            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                <i class="tio-clear tio-lg"></i>
            </button>
            <!-- End Navbar Vertical Toggle -->
            </div>
            <!-- Content -->
            <div class="navbar-vertical-content">
                <ul class="navbar-nav navbar-nav-lg nav-tabs">

                    <li class="nav-item {{ Str::is('*blog-category*',Route::currentRouteName())
                    ?'show':false }}">
                        <a class="js-nav-tooltip-link nav-link {{ Str::is('*.blog-category.*',Route::currentRouteName())?'active':false }}" href="{{ route('panel.blog-category.index') }}" title="Blog Kategorileri" data-placement="left">
                            <i class="tio-bookmark nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Blog Kategorileri</span>
                        </a>
                    </li>

                  <li class="nav-item {{ Str::is('*blogs*',Route::currentRouteName())
                    ?'show':false }}">
                    <a class="js-nav-tooltip-link nav-link {{ Str::is('*.blog.*',Route::currentRouteName())?'active':false }}" href="{{ route('panel.blog.index') }}" title="Blog İçerikleri" data-placement="left">
                      <i class="tio-bookmark nav-icon"></i>
                      <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Blog İçerikleri</span>
                    </a>
                  </li>

                    <li class="navbar-vertical-aside-has-menu {{ \Route::currentRouteName() == "panel.user.index" ? "show": "" }}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle " href="javascript:;" title="Kullanıcı Yönetimi"><i class="tio-user nav-icon"></i><span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Kullanıcı Yönetimi</span></a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('panel.user.index') }}" title="Kullanıcılar">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">Kullanıcılar</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a class="js-nav-tooltip-link nav-link" href="{{ route('panel.logout') }}" title="" data-placement="left">
                            {{-- <i class="tio-user nav-icon"></i> --}}
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sign-out" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa nav-icon fa-sign-out fa-w-16 fa-3x"><path fill="currentColor" d="M180 448H96c-53 0-96-43-96-96V160c0-53 43-96 96-96h84c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H96c-17.7 0-32 14.3-32 32v192c0 17.7 14.3 32 32 32h84c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm117.9-303.1l77.6 71.1H184c-13.3 0-24 10.7-24 24v32c0 13.3 10.7 24 24 24h191.5l-77.6 71.1c-10.1 9.2-10.4 25-.8 34.7l21.9 21.9c9.3 9.3 24.5 9.4 33.9.1l152-150.8c9.5-9.4 9.5-24.7 0-34.1L353 88.3c-9.4-9.3-24.5-9.3-33.9.1l-21.9 21.9c-9.7 9.6-9.3 25.4.7 34.6z" class=""></path></svg>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Çıkış Yap</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Content -->
        </div>
    </div>
</aside>
