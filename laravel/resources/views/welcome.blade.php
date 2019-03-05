<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BEC BIS</title>
        <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right">
                    @auth
                        <a href="{{ url('/home') }}"><button type="button" class="btn btn-primary btn-flat">Dashboard</button></a>
                    @else
                        <a href="{{ route('login') }}"><button type="button" class="btn btn-primary btn-flat">Login</button></a>
                        <a href="{{ route('register') }}"><button type="button" class="btn btn-success btn-flat">Register</button></a>
                    @endauth
                </div>
            @endif

            <div class="content">
                @if (Route::has('login'))
                @auth
                <h3>Welcome to BEC MIS.</h3>
                <a href=""><h4>Access to Dashboard</h4></a>
                @else
                <img src="{{asset('images/homepage.png')}}" class="img img-responsive" alt="">
                <h3>Please Login to Access.</h3>
                @endauth
                @endif
                
            </div>
        </div>
    </body>
</html>
