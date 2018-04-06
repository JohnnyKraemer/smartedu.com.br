@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1"
             id="m_login" style="background-image: url(<?php echo asset('assets/app/media/img/bg/bg-1.jpg') ?>);">
            <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#">
                            <img src="<?php echo asset('assets/smartedu_branco.png') ?>" style="width: 300px;">
                        </a>
                    </div>

                    <div class="m-login__signin">
                        <div class="m-login__head">
                            <h3 class="m-login__title">
                                Entrar
                            </h3>
                        </div>
                        <form class="m-login__form m-form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label" style="color: #fff;">E-Mail</label>

                                <div class="">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class=" control-label" style="color: #fff;">Senha</label>

                                <div class="">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="remember"
                                                   name="remember" {{ old('remember') ? 'checked' : '' }}> Memorizar
                                            senha
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                    <!--
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #fff;">
                                        Esqueceu sua senha?
                                    </a>
                                    -->
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection