<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>{{Config('app.name')}}</title>
  <!-- Bootstrap core CSS-->
  <link href={{asset("vendor/bootstrap/css/bootstrap.min.css")}} rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href={{asset("vendor/font-awesome/css/font-awesome.min.css")}} rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href={{asset("css/sb-admin.css")}} rel="stylesheet">
</head>

<body class="bg-dark">
  <nav class="navbar navbar-expand-md navbar-laravel">
    <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name') }}
    </a>
  </nav>
  <div class="container">

    <div class="card card-login mx-auto mt-5">
      <div class="card-header">@lang('auth.login')</div>
      <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">@lang('auth.email')</label>
            <input id="email" type="email" placeholder="@lang('auth.email')" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">@lang('auth.password')</label>
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="@lang('auth.password')" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>@lang('auth.remember')
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">
              @lang('auth.login')
          </button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="{{ route('register') }}">@lang('auth.register')</a>
          <a class="d-block small" href="{{ route('password.request') }}">@lang('auth.forgotpass')?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src={{asset("vendor/jquery/jquery.min.js")}}></script>
  <script src={{asset("vendor/bootstrap/js/bootstrap.bundle.min.js")}}></script>
  <!-- Core plugin JavaScript-->
  <script src={{asset("vendor/jquery-easing/jquery.easing.min.js")}}></script>
</body>

</html>
