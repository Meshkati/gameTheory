<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ورود</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"
          integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

</head>
<body>
<div class="container">
    <div class="container">
        <div class="col-xs-10 col-sm-8 col-md-6 col-lg-4 col-xs-offset-1 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">
            <div class="login-card">
                <form method="post" action="{{ url('/login') }}" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <h1>وارد شوید</h1>
                    </div>
                    <hr/>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" value="" class="form-control" id="email" name="email"
                               placeholder="نام کاربری"/>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="رمز عبور"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" value="ورود"/>
                    </div>
                </form>
                <a href="{{ url('password/reset') }}" class="btn btn-link">رمز عبورم را فراموش کرده ام</a>
                </br>
                <a href="{{ url('register') }}" class="btn btn-link">ساخت حساب جدید</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>