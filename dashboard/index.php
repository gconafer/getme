<?php
session_start();
include_once("config.php");
include_once("global.php");

if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $url = DASH_URL."/dashboard";
    header("Location: $url");
    die();  
}
?>

<!DOCTYPE html>
<html lang="en">
<!--[if IE 9 ]><html lang="en" class="ie9"><![endif]-->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=ABS_IMG_URL?>/favicon.ico?v=2" type="image/x-icon" />
    <title>Ecoaching.guru | Your Online Coaching Guru</title>

    <!-- Material design colors -->
    <link href="<?=ABS_CSS_URL?>/material-design-iconic-font-min.css" rel="stylesheet">
    <!-- CSS animations -->
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/animate-min.css">
    <!-- Site -->
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/app1-min.css">
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/app2-min.css">
    <!-- Page Loader JS -->
    <script src="<?=ABS_JS_URL?>/page-loader-min.js" async=""></script>
    <!-- jQuery -->
    <script src="<?=ABS_JS_URL?>/jquery-min.js"></script>
    <!-- Bootstrap -->
    <script src="<?=ABS_JS_URL?>/bootstrap-min.js"></script>

    <body>
        <!-- Start page loader -->
        <div id="page-loader" style="opacity: 0.0984771; display: none;">
            <div class="page-loader__spinner"></div>
        </div>
        <!-- End page loader -->

        <header id="header-alt">
            <a href="<?=DASH_URL?>" class="header-alt__logo hidden-xs">Dashboard</a>
        </header>

        <section id="main__content">
            <div class="main__container">
                <header class="main__title text-center">
                    <h2>Login</h2>
                    <small>Dashboard for Admin of Coaching Institute</small>
                </header>
                <div class="card hidden-print" style="padding:30px;">
                    <form id="loginForm">
                        <input type="hidden" name="flowtype" id="flowtype" value="1">
                        <div class="form-group">
                            <input name="email" id="email" class="form-control" placeholder="Email Address" type="text">
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group">
                            <input name="password" id="password" class="form-control" placeholder="Password" type="password">
                            <i class="form-group__bar"></i>
                        </div>
                        <p style="color:red;" id = "errorMsgD"></p>
                        <button type="submit" class="btn btn-primary btn-block m-t-10 m-b-10 submitBtn">Login</button>

                        <div class="text-center">
                            <a href="<?=DASH_URL?>/resetpassword"><small>Forgot Password?</small></a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <footer id="footer-alt"> 
            Copyright © Ecoaching.guru
        </footer>

        <!-- IE9 Placeholder -->
        <!--[if IE 9 ]>
        <script src="<?=ABS_JS_URL?>/jquery.placeholder.min.js"></script>
        <![endif]-->

        <script type="text/javascript">

        $(document).ready(function() {

            var dash_url = '<?=DASH_URL?>';
            var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            $(document).on("submit", "form#loginForm", function() {
                $(".submitBtn").attr("disabled", "disabled");
                var email = $('#email').val();
                var password = $('#password').val();
                var flowtype = $('#flowtype').val();
                if (!email) {
                    $('#errorMsgD').text('Please enter email');
                    $('.submitBtn').removeAttr("disabled");
                } else if (!regEx.test(email)) {
                    $('#errorMsgD').text('Please enter valid email');
                    $('.submitBtn').removeAttr("disabled");
                } else if (!password) {
                    $('#errorMsgD').text('Please enter password');
                    $('.submitBtn').removeAttr("disabled");
                } else {
                    $.post(dash_url+"/controller/login_controller.php", {email:email, password:password, flowtype:flowtype},function(data) {
                        var result = jQuery.parseJSON(data);
                        if(result.status == 'success') {
                            $('.submitBtn').removeAttr("disabled");
                            $('#errorMsgD').css('color', 'green').html('Login Successfully');
                            $("#errorMsgD").fadeOut(1000, function () {        
                                setTimeout(function(){ window.location.href = dash_url+'/dashboard'; }, 1500);     
                            });
                        } else {
                            $('#errorMsgD').text('Email and Password not match');
                            $('.submitBtn').removeAttr("disabled");
                        }
                    });
                }
                return false;
            });
        });    

        </script>
    
    </body>
</html>