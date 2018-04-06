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
		</div>
	</div>
@endsection