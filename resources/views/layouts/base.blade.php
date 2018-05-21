<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="SmartEdu"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SmartEdu - @yield('title')</title>

    <link href="<?php echo asset('assets/css/Roboto.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/css/Poppins.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/vendors/base/vendors.bundle.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/demo/default/base/style.bundle.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/charts/amcharts/plugins/export/export.css') ?>" rel="stylesheet"
          type="text/css"/>
    <link rel="shortcut icon" href="<?php echo asset('assets/ico1.jpg') ?>"/>
    <link href="<?php echo asset('assets/datatables/Select-1.2.5/css/select.semanticui.min.css') ?>" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo asset('assets/datatables/Responsive-2.2.1/css/responsive.semanticui.min.css') ?>"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo asset('assets/datatables/SemanticUI-2.2.13/semantic.min.css') ?>" rel="stylesheet"
          type="text/css"/>

    <style>
        tfoot {
            display: table-header-group;
        }
    </style>
    @yield('stylesheets')
</head>
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"
      style="background-color: #f2f3f8;">
<div class="m-grid m-grid--hor m-grid--root m-page">
    <header class="m-grid__item    m-header " data-minimize-mobile="hide" data-minimize-offset="200"
            data-minimize-mobile-offset="200"
            data-minimize="minimize">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="{{ url('/') }}" class="m-brand__logo-wrapper">
                                <img alt="SmartEdu" src="<?php echo asset('assets/smartedu_branco.png')?>"
                                     style="max-width: 150px;"/>
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                            <a href="javascript:;" id="m_aside_left_minimize_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block m-brand__toggler--active">
                                <span></span>
                            </a>
                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">
                                Olá
                                <a href="{{ url('admin/user/'.auth()->user()->id.'') }}">{{auth()->user()->name}}</a>
                                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                    data-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
                                        <span class="m-topbar__userpic">
                                            <img src="<?php echo asset('assets/images/user/all.jpg') ?>"
                                                 class="m--img-rounded m--marginless m--img-centered" alt=""/>
					                    </span>
                                        <span class="m-topbar__username m--hide">
						                    {{auth()->user()->name}}
                                        </span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center"
                                                 style="background: url(<?php echo asset('assets/app/media/img/misc/user_profile_bg.jpg') ?>; background-size: cover;">
                                                <div class="m-card-user m-card-user--skin-dark">
                                                    <div class="m-card-user__pic">
                                                        <img src="<?php echo asset('assets/images/user/all.jpg') ?>"
                                                             class="m--img-rounded m--marginless" alt=""/>
                                                    </div>
                                                    <div class="m-card-user__details">
                                                        <span class="m-card-user__name m--font-weight-500">
                                                            {{auth()->user()->name}}
                                                        </span>
                                                        <a href="{{ url('admin/user/'.auth()->user()->id.'') }}"
                                                           class="m-card-user__email m--font-weight-300 m-link">
                                                            {{auth()->user()->email}}
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
                                                            <a href="{{ url('admin/user/'.auth()->user()->id.'') }}"
                                                               class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                <span class="m-nav__link-title">
                                                                    <span class="m-nav__link-wrap">
                                                                        <span class="m-nav__link-text">
                                                                            Meu perfil
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('logout') }}"
                                                               class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
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
            </div>
        </div>
    </header>
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
                 data-menu-vertical="true"
                 data-menu-scrollable="false" data-menu-dropdown-timeout="500">
                <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                    <li class="m-menu__section" style="padding-top: 15px;">
                        <h4 class="m-menu__section-text">
                            Dashboards
                        </h4>
                        <i class="m-menu__section-icon flaticon-more-v3"></i>
                    </li>
                    @if(auth()->user()->position_id == 1 || auth()->user()->position_id == 2)
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ url('/admin/institution/') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-university"></i>
                                <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Instituição
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->position_id == 1 || auth()->user()->position_id == 2 || auth()->user()->position_id == 3)
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="@if(auth()->user()->campus == '-'){{ url('/admin/campus') }}@else{{ url('/admin/campus/'.auth()->user()->campus->id) }}@endif"
                               class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-building"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Câmpus
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>
                    @endif
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="@if(auth()->user()->courses == '-'){{ url('/admin/course') }}@else{{ url('/admin/course/'.auth()->user()->courses[0]->id) }}@endif"
                           class="m-menu__link ">
                            <i class="m-menu__link-icon fa fa-home"></i>
                            <span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Curso
							</span>
						</span>
					</span>
                        </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ url('/admin/student') }}" class="m-menu__link ">
                            <i class="m-menu__link-icon fa fa-graduation-cap"></i>
                            <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">
                                        Aluno
                                    </span>
                                </span>
                            </span>
                        </a>
                    </li>
                    @if(auth()->user()->position_id == 1 || auth()->user()->position_id == 2 || auth()->user()->position_id == 3)

                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"
                            data-menu-submenu-toggle="hover">
                            <a href="#" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon fa fa-gears"></i>
                                <span class="m-menu__link-text">
						Administrativo
					</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="{{ url('admin/user') }}" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
									Usuários
								</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="{{ url('admin/position') }}" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
									Cargos
								</span>
                                        </a>
                                    </li>

                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="{{ url('admin/situation') }}" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
									Situação dos Alunos
								</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <!--
                        <li class="m-menu__section">
                            <h4 class="m-menu__section-text">
                                Administrativo
                            </h4>
                            <i class="m-menu__section-icon flaticon-more-v3"></i>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ url('admin/user') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-user-circle-o"></i>
                                <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">
                                        Usuários
                                    </span>
                                </span>
					        </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ url('admin/position') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-suitcase"></i>
                                <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">
                                        Cargos
                                    </span>
                                </span>
					        </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ url('admin/situation') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-child"></i>
                                <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">
                                        Situação dos Alunos
                                    </span>
                                </span>
					        </span>
                            </a>
                        </li>
                        -->
                    @endif
                    @if(auth()->user()->position_id == 1)
                        <li class="m-menu__section">
                            <h4 class="m-menu__section-text">
                                Desenvolvedores
                            </h4>
                            <i class="m-menu__section-icon flaticon-more-v3"></i>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ url('development/classify') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-puzzle-piece"></i>
                                <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">
                                        Classificar
                                    </span>
                                </span>
					        </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ url('development/upload') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-upload"></i>
                                <span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Upload
							</span>
						</span>
					</span>
                            </a>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"
                            data-menu-submenu-toggle="hover">
                            <a href="#" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon fa fa-gears"></i>
                                <span class="m-menu__link-text">
						Administrativo
					</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="{{ url('development/classifier') }}" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
									Classificadores
								</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="{{ url('development/variable') }}" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
									Variáveis
								</span>
                                        </a>
                                    </li>
                                    <!--
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="{{ url('development/campus') }}" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
									Campus
								</span>
                                        </a>
                                    </li>
                                    -->
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="{{ url('development/course') }}" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
									Cursos
								</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
            <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver	m-container m-container--responsive m-container--xxl m-page__container">
                <div class="m-grid__item m-grid__item--fluid m-wrapper" style="width: 80%;">
                    <div class="m-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="m-grid__item m-footer ">
        <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
            <div class="m-footer__wrapper">
                <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                    <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
								<span class="m-footer__copyright">
									2018 &copy; Desenvolvido por SmartEdu
								</span>
                    </div>
                    <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                        <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                            <li class="m-nav__item">

                                <a href="{{ url('') }}" class="m-nav__link">
											<span class="m-nav__link-text">
												Início
											</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
         data-scroll-speed="300">
        <i class="la la-arrow-up"></i>
    </div>
    <script src="<?php echo asset('assets/vendors/base/vendors.bundle.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/demo/default/base/scripts.bundle.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/js/notification.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/js/my.functions.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/amcharts.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/serial.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/radar.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/pie.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/plugins/animate/animate.min.js') ?>"
            type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/plugins/export/export.js') ?>"
    <script src="<?php echo asset('assets/charts/amcharts/plugins/export/lang/pt.js') ?>"
            type="text/javascript"></script>
    <script src="<?php echo asset('assets/charts/amcharts/themes/light.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/datatables/datatables.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo asset('assets/datatables/SemanticUI-2.2.13/semantic.min.js') ?>"
            type="text/javascript"></script>
    <script src="<?php echo asset('assets/datatables/DataTables-1.10.16/js/dataTables.semanticui.min.js') ?>"
            type="text/javascript"></script>
    <script>
        @if (Session::has('type'))
        notification('{{ Session::get('message')}}', '{{ Session::get('type')}}');
        @endif
    </script>
@yield('scripts')
</body>
</html>
