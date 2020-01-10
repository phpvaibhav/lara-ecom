@extends('layouts.login')
@section('title', 'Login')
@section('content')
<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v6 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
					<div class="kt-grid__item  kt-grid__item--order-tablet-and-mobile-2  kt-grid kt-grid--hor kt-login__aside">
						<div class="kt-login__wrapper">
							<div class="kt-login__container">
								<div class="kt-login__body">
									<div class="kt-login__logo">
										<a href="javascript:void(0);">
											<img src="{{asset('backend_assets/media/company-logos/logo-2.png')}}">
										</a>
									</div>
									<div class="kt-login__signin">
										<div class="kt-login__head">
											<h3 class="kt-login__title">Sign In To Admin</h3>
										</div>
										<div class="kt-login__form">
											<form class="kt-form" method="POST" action="{{ route('login') }}">
												@csrf
												<div class="form-group">
													<input class="form-control @error('email') is-invalid @enderror" type="text" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="off">

					                                @error('email')
					                                    <span class="invalid-feedback" role="alert">
					                                        <strong>{{ $message }}</strong>
					                                    </span>
					                                @enderror
												</div>
												<div class="form-group">
													<input class="form-control form-control-last @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" >
													@error('password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
												<div class="kt-login__extra">
													<label class="kt-checkbox">
														<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
														<span></span>
													</label>
													<a href="javascript:;" id="kt_login_forgot">Forget Password ?</a>
												</div>
												<div class="kt-login__actions">
													<button type="submit" id="kt_login_signin_submit" class="btn btn-brand btn-pill btn-elevate">Sign In</button>
												</div>
											</form>
										</div>
									</div>
									<div class="kt-login__signup">
										<div class="kt-login__head">
											<h3 class="kt-login__title">Sign Up</h3>
											<div class="kt-login__desc">Enter your details to create your account:</div>
										</div>
										<div class="kt-login__form">
											<form class="kt-form" method="POST" action="{{ route('register') }}">
												 @csrf
												<div class="form-group">
													<input class="form-control" type="text" placeholder="Fullname" name="name" value="{{ old('name') }}">
													@error('name')
														<span class="error invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>
												<div class="form-group">
													<input class="form-control" type="text" placeholder="Email"  name="email" value="{{ old('email') }}" autocomplete="off">
												</div>
												<div class="form-group">
													<input class="form-control" type="password" placeholder="Password" name="password">

					                                @error('password')
					                                    <span class="invalid-feedback" role="alert">
					                                        <strong>{{ $message }}</strong>
					                                    </span>
					                                @enderror
												</div>
												<div class="form-group">
													<input class="form-control form-control-last" type="password" placeholder="Confirm Password" name="password_confirmation" autocomplete="new-password">
												</div>
												
												<div class="kt-login__actions">
													<button type="submit" id="kt_login_signup_submit" class="btn btn-brand btn-pill btn-elevate">Sign Up</button>
													<button id="kt_login_signup_cancel" class="btn btn-outline-brand btn-pill">Cancel</button>
												</div>
											</form>
										</div>
									</div>
									<div class="kt-login__forgot">
										<div class="kt-login__head">
											<h3 class="kt-login__title">Forgotten Password ?</h3>
											<div class="kt-login__desc">Enter your email to reset your password:</div>
										</div>
										<div class="kt-login__form">
											<form class="kt-form" method="POST" action="{{ route('password.email') }}">
												<div class="form-group">
													<input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
													@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
												</div>
												<div class="kt-login__actions">
													<button type="submit" id="kt_login_forgot_submit" class="btn btn-brand btn-pill btn-elevate">Request</button>
													<button id="kt_login_forgot_cancel" class="btn btn-outline-brand btn-pill">Cancel</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="kt-login__account">
								<span class="kt-login__account-msg">
									Don't have an account yet ?
								</span>&nbsp;&nbsp;
								<a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>
							</div>
						</div>
					</div>
					<div class="kt-grid__item kt-grid__item--fluid kt-grid__item--center kt-grid kt-grid--ver kt-login__content" style="background-image: url({{asset('backend_assets/media/bg/bg-4.jpg')}});">
						<div class="kt-login__section">
							<div class="kt-login__block">
								<h3 class="kt-login__title">Join Our Community</h3>
								<div class="kt-login__desc">
									Lorem ipsum dolor sit amet, coectetuer adipiscing
									<br>elit sed diam nonummy et nibh euismod
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->
@endsection