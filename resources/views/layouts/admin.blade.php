<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="SmartEdu"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link href="<?php echo asset('assets/vendors/base/vendors.bundle.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/demo/demo5/base/style.bundle.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/charts/amcharts/plugins/export/export.css') ?>" rel="stylesheet"
          type="text/css"/>
    <link rel="shortcut icon"
          href="<?php echo asset('assets/demo/demo5/media/img/logo/favicon.ico') ?>"/> @yield('stylesheets')
</head>

<body class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default"
      style="background-color: #f2f3f8;">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- begin::Header -->
    <header class="m-grid__item		m-header " data-minimize="minimize" data-minimize-offset="200"
            data-minimize-mobile-offset="200">
        <div class="m-header__top">
            <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <!-- begin::Brand -->
                    <div class="m-stack__item m-brand">
                        <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="{{ url('/') }}" class="m-brand__logo-wrapper">
                                    <img alt="" src="<?php echo asset('assets/smartedu.png') ?>" style="max-height: 25px;"/>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- end::Brand -->
                    <!-- begin::Topbar -->
                    <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-topbar__nav-wrapper">
                                <ul class="m-topbar__nav m-nav m-nav--inline">
                                    <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                        data-dropdown-toggle="click">
                                        <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__welcome">
													Hello,&nbsp;
												</span>
                                            <span class="m-topbar__username">
													Nick
												</span>
                                            <span class="m-topbar__userpic">
													<img src="<?php echo asset('assets/app/media/img/users/user4.jpg')?>"
                                                         class="m--img-rounded m--marginless m--img-centered" alt=""/>
												</span>
                                        </a>
                                        <div class="m-dropdown__wrapper">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__header m--align-center"
                                                     style="background: url(<?php echo asset('assets/app/media/img/misc/user_profile_bg.jpg')?>); background-size: cover;">
                                                    <div class="m-card-user m-card-user--skin-dark">
                                                        <div class="m-card-user__pic">
                                                            <img src="<?php echo asset('assets/app/media/img/users/user4.jpg')?>"
                                                                 class="m--img-rounded m--marginless" alt=""/>
                                                        </div>
                                                        <div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	Mark Andre
																</span>
                                                            <a href=""
                                                               class="m-card-user__email m--font-weight-300 m-link">
                                                                mark.andre@gmail.com
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-dropdown__body">
                                                    <div class="m-dropdown__content">
                                                        <ul class="m-nav m-nav--skin-light">
                                                            <li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">
																		Section
																	</span>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="profile.html" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                    <span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">
																					My Profile
																				</span>
																				<span class="m-nav__link-badge">
																					<span class="m-badge m-badge--success">
																						2
																					</span>
																				</span>
																			</span>
																		</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="profile.html" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-share"></i>
                                                                    <span class="m-nav__link-text">
																			Activity
																		</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="profile.html" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                    <span class="m-nav__link-text">
																			Messages
																		</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__separator m-nav__separator--fit"></li>
                                                            <li class="m-nav__item">
                                                                <a href="profile.html" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-info"></i>
                                                                    <span class="m-nav__link-text">
																			FAQ
																		</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="profile.html" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                    <span class="m-nav__link-text">
																			Support
																		</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__separator m-nav__separator--fit"></li>
                                                            <li class="m-nav__item">
                                                                <a href="snippets/pages/user/login-1.html"
                                                                   class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                                    Logout
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end::Topbar -->
                </div>
            </div>
        </div>
        <div class="m-header__bottom">
            <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <!-- begin::Horizontal Menu -->
                    <div class="m-stack__item m-stack__item--middle m-stack__item--fluid">
                        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light "
                                id="m_aside_header_menu_mobile_close_btn">
                            <i class="la la-close"></i>
                        </button>
                        <div id="m_header_menu"
                             class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                            <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
                                    <a href="{{ url('/') }}" class="m-menu__link ">
                                        <span class="m-menu__item-here"></span>
                                        <span class="m-menu__link-text">
												Dashboard
											</span>
                                    </a>
                                </li>
                                <li class="m-menu__item  m-menu__item" aria-haspopup="true">
                                    <a href="{{ url('/instituicao') }}" class="m-menu__link ">
                                        <span class="m-menu__item-here"></span>
                                        <span class="m-menu__link-text">
												Instituição
											</span>
                                    </a>
                                </li>
                                <li class="m-menu__item  m-menu__item" aria-haspopup="true">
                                    <a href="{{ url('/campus') }}" class="m-menu__link ">
                                        <span class="m-menu__item-here"></span>
                                        <span class="m-menu__link-text">
												Câmpus
											</span>
                                    </a>
                                </li>
                                <li class="m-menu__item  m-menu__item" aria-haspopup="true">
                                    <a href="{{ url('/course') }}" class="m-menu__link ">
                                        <span class="m-menu__item-here"></span>
                                        <span class="m-menu__link-text">
												Curso
											</span>
                                    </a>
                                </li>
                                <li class="m-menu__item  m-menu__item" aria-haspopup="true">
                                    <a href="{{ url('/student') }}" class="m-menu__link ">
                                        <span class="m-menu__item-here"></span>
                                        <span class="m-menu__link-text">
												Aluno
											</span>
                                    </a>
                                </li>
                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"
                                    data-menu-submenu-toggle="click" aria-haspopup="true">
                                    <a href="#" class="m-menu__link m-menu__toggle">
                                        <span class="m-menu__item-here"></span>
                                        <span class="m-menu__link-text">
												Administrativo
											</span>
                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">
                                            <li class="m-menu__item " aria-haspopup="true">
                                                <a href="{{ url('admin/user') }}" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-diagram"></i>
                                                    <span class="m-menu__link-title">
															<span class="m-menu__link-wrap">
																<span class="m-menu__link-text">
																	Usuários
																</span>
															</span>
														</span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                <a href="{{ url('admin/position') }}" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                    <span class="m-menu__link-text">
															Cargos
														</span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                <a href="{{ url('admin/campus') }}" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                    <span class="m-menu__link-text">
															Campus
														</span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                <a href="{{ url('admin/course') }}" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                    <span class="m-menu__link-text">
															Cursos
														</span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                <a href="{{ url('admin/student') }}" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                    <span class="m-menu__link-text">
															Alunos
														</span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                <a href="{{ url('admin/situation') }}" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                    <span class="m-menu__link-text">
															Situação dos Alunos
														</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="m-menu__item  m-menu__item" aria-haspopup="true">
                                    <a href="{{ url('development/upload') }}" class="m-menu__link ">
                                        <span class="m-menu__item-here"></span>
                                        <span class="m-menu__link-text">
												Upload
											</span>
                                    </a>
                                </li>
                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"
                                    data-menu-submenu-toggle="click" aria-haspopup="true">
                                    <a href="#" class="m-menu__link m-menu__toggle">
                                        <span class="m-menu__item-here"></span>
                                        <span class="m-menu__link-text">
												Classificação
											</span>
                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">
                                            <li class="m-menu__item " aria-haspopup="true">
                                                <a href="{{ url('development/classify') }}" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-diagram"></i>
                                                    <span class="m-menu__link-title">
															<span class="m-menu__link-wrap">
																<span class="m-menu__link-text">
																	Geral
																</span>
															</span>
														</span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                <a href="{{ url('development/classify/period') }}"
                                                   class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                    <span class="m-menu__link-text">
															Período
														</span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                <a href="{{ url('development/classify/test') }}" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                    <span class="m-menu__link-text">
															Teste Único
														</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"
                                    data-menu-submenu-toggle="click" aria-haspopup="true">
                                    <a href="#" class="m-menu__link m-menu__toggle">
                                        <span class="m-menu__item-here"></span>
                                        <span class="m-menu__link-text">
												Geral
											</span>
                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">
                                            <li class="m-menu__item " aria-haspopup="true">
                                                <a href="{{ url('development/variable') }}" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-diagram"></i>
                                                    <span class="m-menu__link-title">
															<span class="m-menu__link-wrap">
																<span class="m-menu__link-text">
																	Variáveis
																</span>
															</span>
														</span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                <a href="{{ url('development/classifier') }}" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                    <span class="m-menu__link-text">
															Classificadores
														</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- end::Horizontal Menu -->
                </div>
            </div>
        </div>
    </header>
    <!-- end::Header -->


    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
        <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver	m-container m-container--responsive m-container--xxl m-page__container">

            @yield('aside')

            <!---->
            <div class="m-grid__item m-grid__item--fluid m-wrapper" style="width: 80%;">
                <!-- BEGIN: Subheader -->
                <!--
                <div class="m-subheader ">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="m-subheader__title ">
                                Dashboard
                            </h3>
                        </div>
                    </div>
                </div>
                -->
                <!-- END: Subheader -->
                <div class="m-content">
                    @yield('content')
                </div>
            </div>
        </div>
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
    <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
         data-scroll-speed="300">
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
    <script src="<?php echo asset('assets/charts/amcharts/plugins/animate/animate.min.js') ?>"
            type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/plugins/export/export.min.js') ?>"
            type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/themes/light.js') ?>" type="text/javascript"></script>

    <script>
        @if (Session::has('type'))
        notification('{{ Session::get('message')}}', '{{ Session::get('type')}}');
        @endif
    </script>

@yield('scripts')
</body>

</html>
