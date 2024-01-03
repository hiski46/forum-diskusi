<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('/assets') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- Helpers -->
    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/assets/js/config.js') }}"></script>
    
  </head>

  <body>
    {{-- Page Loader --}}
    <div class="loading" style="">Loading&#8230;</div>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @if (!isset($hide_sidebar))
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="/" class="app-brand-link">
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Forum Diskusi</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none no-load">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                
                <div data-i18n="Analytics">Home</div>
              </a>
            </li>
            <li class="menu-item @yield('forum')">
              <a href="/forum" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                <div data-i18n="Analytics">Forum</div>
              </a>
            </li>

            @can('view users')
    <li class="menu-header small text-uppercase">
                                                              <span class="menu-header-text">Pegawai</span>
                                                            </li>
                                                            <li class="menu-item @yield('pegawai')">
                                                              <a href="/pegawai" class="menu-link">
                                                                <i class="menu-icon tf-icons bx bx-user"></i>
                                                                <div data-i18n="Analytics">Daftar Pegawai</div>
                                                              </a>
                                                            </li>
@endcan



            <!-- Components -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Forum</span></li>
            @if (Auth::user()->hasRole('administrator'))
<li class="menu-item @yield('approve')">
              <a href="/approve-forum" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-hourglass"></i>
                <div data-i18n="Analytics">Need Approve</div>
              </a>
            </li>
@endif
            <!-- User interface -->
            <li class="menu-item @yield('semua-forum')">
              <a href="javascript:void(0)" class="menu-link menu-toggle no-load ">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">Postingan Saya</div>
              </a>
              <ul class="menu-sub ">
                <li class="menu-item @yield('forum-all')">
                  <a href="/get-forum" class="menu-link">
                    <div data-i18n="Accordion">Semua Forum</div>
                  </a>
                </li>
                <li class="menu-item @yield('forum-normal')">
                  <a href="/get-forum?type=normal" class="menu-link">
                    <div data-i18n="Carousel">Forum Tanpa File</div>
                  </a>
                </li>
                <li class="menu-item @yield('forum-gambar')">
                  <a href="/get-forum?type=gambar" class="menu-link">
                    <div data-i18n="Alerts">Forum Dengan Gambar</div>
                  </a>
                </li>
                <li class="menu-item @yield('forum-video')">
                  <a href="/get-forum?type=video" class="menu-link">
                    <div data-i18n="Badges">Forum Dengan Video</div>
                  </a>
                </li>
                <li class="menu-item @yield('forum-document')">
                  <a href="/get-forum?type=document" class="menu-link">
                    <div data-i18n="Buttons">Forum Dengan Dokumen</div>
                  </a>
                </li>
                
                
              </ul>
            </li>
        </aside>
@endif
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page {{ isset($hide_sidebar) ? 'ps-0' : '' }}">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-transparent"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4 no-load" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  
                  
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow no-load" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ Auth::user()->foto ? asset('storage/foto_profil/' . Auth::user()->foto) : asset('assets/img/elements/2.jpg') }}" alt class="w-px-40 rounded-circle" style="object-fit: cover"/>
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item no-load" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ Auth::user()->foto ? asset('storage/foto_profil/' . Auth::user()->foto) : asset('assets/img/elements/2.jpg') }}" alt class="w-px-40 rounded-circle" style="object-fit: cover"/>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                            <small class="text-muted">{{ ucfirst(Auth::user()->getRoleNames()[0]) }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="/self-edit">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="/logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              @yield('content')
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                      document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️
                </div>
                
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('/assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('/assets/js/pages-account-settings-account.js') }}"></script>
    <script src="{{ asset('/assets/js/custom.js') }}"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    
    @yield('js')
  </body>
</html>
