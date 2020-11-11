<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title>Login</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="<?=base_url('includes')?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url('includes')?>/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url('includes')?>/bower_components/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="<?=base_url('includes')?>/bower_components/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="<?=base_url('includes')?>/bower_components/themify-icons/css/themify-icons.css">
        <!-- endinject -->

        <!-- Main Style  -->
        <link rel="stylesheet" href="<?=base_url('includes')?>/dist/css/main.css">

        <script src="<?=base_url('includes')?>/assets/js/modernizr-custom.js"></script>
    </head>
    <body>

        <div class="sign-in-wrapper">
            <div class="sign-container">
                <div class="text-center">
                    <h2 class="logo"><img src="<?=base_url('includes')?>/imgs/logo-dark.png" width="130px" alt=""/></h2>
                    <h4>Login to Admin</h4>
                </div>

                <form class="sign-in-form" role="form" action="<?php echo base_url() .('Template/aksi_login'); ?> " method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" required="" name="username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" required="" name="password">
                    </div>
                    <div class="form-group text-center">
                        <label class="i-checks">
                            <input type="checkbox">
                            <i></i>
                        </label>
                        Remember me
                    </div>
                    <button type="submit" class="btn btn-info btn-block">Login</button>
<!--                    <div class="text-center help-block">
                        <a href="<?=base_url('includes')?>/forgot-password.html"><small>Forgot password?</small></a>
                        <p class="text-muted help-block"><small>Do not have an account?</small></p>
                    </div>
                    <a class="btn btn-md btn-default btn-block" href="registration.html">Create an account</a>-->
                </form>
                <div class="text-center copyright-txt">
                    <small>MegaDin - Copyright © 2017</small>
                </div>
            </div>
        </div>

        <!-- inject:js -->
        <script src="<?=base_url('includes')?>/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?=base_url('includes')?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?=base_url('includes')?>/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
        <script src="<?=base_url('includes')?>/bower_components/autosize/dist/autosize.min.js"></script>
        <!-- endinject -->

        <!-- Common Script   -->
        <script src="<?=base_url('includes')?>/dist/js/main.js"></script>

    </body>
</html>
