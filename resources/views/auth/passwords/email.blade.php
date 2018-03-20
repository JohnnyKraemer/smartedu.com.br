@extends('layouts.auth') @section('content')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile 		m-login m-login--1 m-login--singin"
 id="m_login">
	<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
		<div class="m-stack m-stack--hor m-stack--desktop">
			<div class="m-stack__item m-stack__item--fluid">
				<div class="m-login__wrapper" style="padding: 10% 2rem 2rem 2rem;">
					<div class="m-login__logo">
						<a href="#">
							<img src="<?php echo asset('assets/app/media/img//logos/logo-2.png') ?>">
						</a>
					</div>
					<div class="m-login__signin">
						<div class="m-login__head">
							<h3 class="m-login__title">
								Recuperar Senha
							</h3>
						</div>
						@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
						@endif

						<form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="control-label">E-Mail</label>

								<div>
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required> @if ($errors->has('email'))
									<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
								</div>
							</div>

							<div class="form-group">
								<div class="">
									<button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="m-stack__item m-stack__item--center">
				<div class="m-login__account">
					<span class="m-login__account-msg">
									Não tem uma conta?
								</span> &nbsp;&nbsp;
					<a href="{{ url('/') }}" id="m_login_signup" class="m-link m-link--focus m-login__account-link">
						Saiba mais
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content"
	 style="background-image: url(<?php echo asset('assets/app/media/img//bg/bg-4.jpg') ?>">
		<div class="m-grid__item m-grid__item--middle">
			<h3 class="m-login__welcome">
				Ainda não tem uma conta?
			</h3>
			<p class="m-login__msg">
				Descubra agora todo o poder do SmartEdu o software de combate a evasão!
			</p>
		</div>
	</div>
</div>
@endsection