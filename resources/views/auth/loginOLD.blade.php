<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>Fullscreen Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="loginassets/css/reset.css">
        <link rel="stylesheet" href="loginassets/css/supersized.css">
        <link rel="stylesheet" href="loginassets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="page-container">
            <h1>Login</h1>
            <form action="" method="post">
                 {!! csrf_field() !!}

               @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input type="email" class="username" name="email" value="{{ old('email') }}" placeholder="email" style="opacity:1;" />
                          
                  <input type="password" class="password" name="password"  placeholder="password" >
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                <button class="btn btn-primary" type="submit">Sign me in</button>
                <div class="error"><span>+</span></div>
            </form>
            <br>
             <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
             <a class="btn btn-link" href="{{ url('/register') }}">signup?</a>
        </div>

        <!-- Javascript -->
        <script src="loginassets/js/jquery-1.8.2.min.js"></script>
        <script src="loginassets/js/supersized.3.2.7.min.js"></script>
        <script src="loginassets/js/supersized-init.js"></script>
        <script src="loginassets/js/scripts.js"></script>

    </body>

</html>

