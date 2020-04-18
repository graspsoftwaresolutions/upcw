<!DOCTYPE html>
<html data-textdirection="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Login</title>
    <link rel="apple-touch-icon" href="{{ asset('public/app-assets/images/favicon/favicon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/app-assets/images/favicon/favicon.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/vendors.min.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/themes/vertical-modern-menu-template/materialize.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/themes/vertical-modern-menu-template/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/login.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/custom/custom.css') }}">
    <!-- END: Custom CSS-->
  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg   blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
      <div class="col s12">
        <div class="container">
		<div id="login-page" class="row">
  <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
    <form class="login-form" method="POST" action="{{ route('login') }}">
		@csrf
      <div class="row">
			<div class="ml-12">
				<img src="{{ asset('public/img/logo.png') }}" class="img-responsive" style="display:block;margin:15px auto;"/>
			</div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <label for="username" class="center-align">{{ __('E-Mail Address') }}</label>
			@error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
          <label for="password">{{ __('Password') }}</label>
			@error('password')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
        </div>
      </div>
      <div class="row">
        <div class="col s12 m12 l12 ml-2 mt-1">
          <p>
            <label class="form-check-label" for="remember">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <span>{{ __('Remember Me') }}</span>
            </label>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
			<button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
				{{ __('Login') }}
			</button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 m6 l6">
          <!--p class="margin medium-small"><a href="user-register.html">Register Now!</a></p-->
        </div>
        <div class="input-field col s6 m6 l6">
			<p class="margin right-align medium-small">
				@if (Route::has('password.request'))
					<a href="{{ route('password.request') }}">
						{{ __('Forgot Your Password?') }}
					</a>
				@endif
			</p>
        </div>
      </div>
    </form>
  </div>
</div>
        </div>
        <div class="content-overlay"></div>
      </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('public/app-assets/js/vendors.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ asset('public/app-assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('public/app-assets/js/search.min.js') }}"></script>
    <script src="{{ asset('public/app-assets/js/custom/custom-script.min.js') }}"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
  </body>
</html>