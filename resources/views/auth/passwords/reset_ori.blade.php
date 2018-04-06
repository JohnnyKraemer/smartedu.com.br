@extends('layouts.auth') @section('content')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile 		m-login m-login--1 m-login--singin"
 id="m_login">
	<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
		<div class="m-stack m-stack--hor m-stack--desktop">
			<div class="m-stack__item m-stack__item--fluid">
				<div class="m-login__wrapper" style="padding: 10% 2rem 2rem 2rem;">
					<div class="m-login__logo">
						<a href="#">
							<img src="<?php echo asset('assets/smartedu.png') ?>" style="width: 300px;">
						</a>
					</div>
					<div class="m-login__signin">
						<div class="m-login__head">
							<h3 class="m-login__title">
								Reset
							</h3>
						</div>
						<form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
							{{ csrf_field() }}

							<input type="hidden" name="token" value="{{ $token }}">

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>									@if ($errors->has('email'))
									<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="col-md-4 control-label">Password</label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" required> @if ($errors->has('password'))
									<span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
								<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required> @if ($errors->has('password_confirmation'))
									<span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span> @endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
                                    Reset Password
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