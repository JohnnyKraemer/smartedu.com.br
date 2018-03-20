<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SmartEdu" />
	<title>SmartEdu - @yield('title')</title>

	<!--begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
                google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
                active: function () {
                    sessionStorage.fonts = true;
                }
            });
	</script>

	<!--============================ Stylesheets ============================-->
	<link href="<?php echo asset('assets/vendors/base/vendors.bundle.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo asset('assets/demo/default/base/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="<?php echo asset('assets/demo/default/media/img/logo/favicon.ico') ?>" /> @yield('stylesheets')
</head>

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
        @yield('content')	
	</div>
	<!--begin::Base Scripts -->
	<script src="<?php echo asset('assets/vendors/base/vendors.bundle.js') ?>" type="text/javascript"></script>
	<script src="<?php echo asset('assets/demo/default/base/scripts.bundle.js') ?>" type="text/javascript"></script>
	<!--end::Base Scripts -->
	<!--begin::Page Snippets -->
	<script src="<?php echo asset('assets/snippets/pages/user/login.js') ?>" type="text/javascript"></script>
	<!--end::Page Snippets -->

	@yield('scripts')
</body>

</html>