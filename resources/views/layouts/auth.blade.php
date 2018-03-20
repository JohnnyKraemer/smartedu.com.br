<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SmartEdu" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SmartEdu - @yield('title')</title>

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--============================ Stylesheets ============================-->
    <link href="<?php echo asset('assets/vendors/base/vendors.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset('assets/demo/demo5/base/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset('assets/charts/amcharts/plugins/export/export.css') ?>" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?php echo asset('assets/demo/demo5/media/img/logo/favicon.ico') ?>" /> @yield('stylesheets')
</head>

<body class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default" style="background-color: #f2f3f8;" >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">

    <!-- begin::Body -->
@yield('content')
        <!-- end::Body -->

        <!-- begin::Footer -->
        <footer class="m-grid__item m-footer ">
            <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                <div class="m-footer__wrapper">
                    <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                        <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
								<span class="m-footer__copyright">
									2018 &copy; Desenvolvido por
									<a href="#" class="m-link">
										InnovaSis
									</a>
								</span>
                        </div>
                        <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                            <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                                <li class="m-nav__item">
                                    <a href="#" class="m-nav__link">
											<span class="m-nav__link-text">
												Sobre
											</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end::Footer -->
    </div>
    <!-- end:: Page -->

    <!-- begin::Scroll Top -->
    <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->

    <!--begin::Base Scripts -->
    <script src="<?php echo asset('assets/vendors/base/vendors.bundle.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/demo/demo5/base/scripts.bundle.js') ?>" type="text/javascript"></script>
    <!--end::Base Scripts -->
    <!--begin::Page Snippets -->
    <!--end::Page Snippets -->
    <script src="<?php echo asset('assets/js/notification.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/js/my.functions.js') ?>" type="text/javascript"></script>

    <script src="<?php echo asset('assets/charts/amcharts/amcharts.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/serial.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/radar.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/pie.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/plugins/animate/animate.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/plugins/export/export.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/themes/light.js') ?>" type="text/javascript"></script>

    <script>
        @if (Session::has('type'))
        notification('{{ Session::get('message')}}', '{{ Session::get('type')}}');
        @endif
    </script>

@yield('scripts')
</body>

</html>
