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
    <title>Forget Password | Ecoaching.guru | Your Online Coaching Guru</title>

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

        <?php if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['key']) && !empty($_GET['key'])) { ?>
            <section id="main__content">
                <div class="main__container">
                    <header class="main__title text-center">
                        <h2>Update Password</h2>
                    </header>
                    <div class="card hidden-print" style="padding:30px;">
                        <form id="loginFormP">
                            <input type="hidden" id="id" name="id" value="<?=$_GET['id']?>">
                            <input type="hidden" id="key" name="key" value="<?=$_GET['key']?>">
                            <div class="form-group">
                                <input id="password" class="form-control" placeholder="Password" type="text">
                                <i class="form-group__bar"></i>
                            </div>

                            <div class="form-group">
                                <input id="cpassword" class="form-control" placeholder="Confirm Password" type="password">
                                <i class="form-group__bar"></i>
                            </div>
                            <p style="color:red;" id = "errorMsgP"></p>
                            <button type="submit" class="btn btn-primary btn-block m-t-10 m-b-10 submitBtnP">Update Password</button>
                        </form>
                    </div>
                </div>
            </section>
        <?php } else { ?>
            <section id="main__content">
                <div class="main__container">
                    <header class="main__title text-center">
                        <h2>Forget Password</h2>
                    </header>
                    <div class="card hidden-print" style="padding:30px;">
                        <form id="loginFormE">
                            <div class="form-group">
                                <input name="forgetEmail" id="forgetEmail" class="form-control" placeholder="Email Address" type="text">
                                <i class="form-group__bar"></i>
                            </div>
                            <p style="color:red;" id = "errorMsgE"></p>
                            <button type="submit" class="btn btn-primary btn-block m-t-10 m-b-10 submitBtnE">Reset Password</button>

                            <div class="text-center">
                                Click here to <a href="<?=DASH_URL?>"><small>Login</small></a>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        <?php } ?>

        <footer id="footer-alt"> 
            Copyright © Ecoaching.guru
        </footer>

        <!-- IE9 Placeholder -->
        <!--[if IE 9 ]>
        <script src="<?=ABS_JS_URL?>/jquery.placeholder.min.js"></script>
        <![endif]-->

        <script type="text/javascript">

        $(document).ready(function() {

            var abs_url = '<?=DASH_URL?>';
            var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            $(document).on("submit", "form#loginFormE", function() {
                $(".submitBtnE").attr("disabled", "disabled");
                var email = $('#forgetEmail').val();
                if (!email) {
                    $('#errorMsgE').text('Please enter email');
                    $('.submitBtnE').removeAttr("disabled");
                } else if (!regEx.test(email)) {
                    $('#errorMsgE').text('Please enter valid email');
                    $('.submitBtnE').removeAttr("disabled");
                } else {
                    $('#errorMsgE').css("color", "blue").text("Please Wait...");
                    $.post(abs_url+"/controller/login_controller.php", {email:email, flowtype:3},function(data) {
                        var result = jQuery.parseJSON(data);
                        if(result.status == 'success') {
                            $('.submitBtnE').removeAttr("disabled");
                            $('#errorMsgE').css("color", "green").text(result.msg);
                            $("#errorMsgE").fadeOut(2500);
                        } else {
                            $('#errorMsgE').css("color", "red").text(result.msg);
                            $('.submitBtnE').removeAttr("disabled");
                        }
                    });
                }
                return false;
            });

            $(document).on("submit", "form#loginFormP", function() {
                $(".submitBtnP").attr("disabled", "disabled");
                var id = $('#id').val();
                var key = $('#key').val();
                var password = $('#password').val();
                var cpassword = $('#cpassword').val();
                if(!password) {
                    $('#errorMsgP').text('Please enter password');
                    $('.submitBtnP').removeAttr("disabled");
                } else if (!cpassword) {
                    $('#errorMsgP').text('Please enter confirm password');
                    $('.submitBtnP').removeAttr("disabled");
                } else if (password != cpassword) {
                    $('#errorMsgP').text('Password and confirm password does not match');
                    $('.submitBtnP').removeAttr("disabled");
                } else {
                    $.post(abs_url+"/controller/login_controller.php", {id:id, key:key, password:password, cpassword:cpassword, flowtype:4},function(data) {
                        var result = jQuery.parseJSON(data);
                        if(result.status == 'success') {
                            $('.submitBtnP').removeAttr("disabled");
                            $('#errorMsgP').css("color", "green").text(result.msg);
                            $("#errorMsgP").fadeOut(2000, function () {
                                setTimeout(function(){ window.location.href = abs_url; }, 500);
                            });
                        } else {
                            $('#errorMsgP').text(result.msg);
                            $('.submitBtnP').removeAttr("disabled");
                        }
                    });
                }
                return false;
            });


        });  

        </script>
    
    </body>
</html>