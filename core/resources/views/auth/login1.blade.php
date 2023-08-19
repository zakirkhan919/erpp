
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Shopantik</title>

    <!-- Scripts -->
    <script src="{{ asset('assets/admin/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('assets/admin/images/shop-antik-red.png')}}" type="image/x-icon"/>

    <!-- Styles -->
    <link href="{{ asset('assets/admin/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/admin/css/login.css')}}">
</head>

<body class="bg1">
<div class="conainer block-center">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="login-block">
            <div class="page-logo"><a href="" target="_blank">
                <img height="auto" width="250" src="{{asset('assets/admin/images/shop-antik-red.png')}}" class="logo-image"></a>
            </div>
                
            <form method="POST" action="{{ route('admin') }}">
                        @csrf
                <div class="form-group">
                    <label for="Email Address">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="TxtPassword">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div> 
                <input name="btn_login" type="submit" id="btn_login" tabindex="3" class="btn login-button" value="Login">
                <br>
                <span id="lblmsg" style="color:Red;"></span>
                </div>
            </form>
        <div class="login-footer">
            <p style="color:#fff">Powered by Time Research & Innovation</p>
        </div>
    </div>
</div>
</body>
</html>
