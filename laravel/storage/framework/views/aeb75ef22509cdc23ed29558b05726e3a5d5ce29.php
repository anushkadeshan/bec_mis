<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="user-id" content="<?php echo e(Auth::id()); ?>">
        <title>BEC MIS</title>
        <link href="<?php echo e(asset('vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

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
            <?php if(Route::has('login')): ?>
                <div class="top-right">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/home')); ?>"><button type="button" class="btn btn-primary btn-flat">Dashboard</button></a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>"><button type="button" class="btn btn-primary btn-flat">Login</button></a>
                        <a href="<?php echo e(route('register')); ?>"><button type="button" class="btn btn-success btn-flat">Register</button></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="content">
                <?php if(Route::has('login')): ?>
                <?php if(auth()->guard()->check()): ?>
                <h3>Welcome to BEC MIS.</h3>
                <a href=""><h4>Access to Dashboard</h4></a>
                <?php else: ?>
                <img src="<?php echo e(asset('images/homepage.png')); ?>" class="img img-responsive" alt="">
                <h3>Please Login to Access.</h3>
                <?php endif; ?>
                <?php endif; ?>
                
            </div>
        </div>

        <div id="app">
            
        </div>
    </body>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
</html>
