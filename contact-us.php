<?php
/*-------------------     Include File Start      ---------------*/

include_once("config.php");
include_once("global.php");

/*-------------------     Include File End      ---------------*/


/*-------------------     Class Object Start      ---------------*/


$pageTitle = "Connecting Investors with Entrepreneurs | Discover startups looking for funding";
$pageDesc = "Connecting Investors with Entrepreneurs | Discover startups looking for funding";
$ogTitle = "TesConnecting Investors with Entrepreneurst";
$ogType = "website";
$ogUrl = ABS_URL;
$ogSiteName = "Get me a funding";
$ogDesc = $pageDesc;
$ogImage = ABS_IMG_URL."/logo.png";
$ogImageHeight = 200;
$ogImageWidth = 150;

?>

<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<!--[if IE 9 ]><html lang="en" class="ie9"><![endif]-->
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=ABS_IMG_URL?>/favicon.ico?v=2" type="image/x-icon" />
    <title><?=$pageTitle?></title>
    <meta name="description" content="<?=$pageDesc?>" />
    <meta property="og:title" content="<?=$ogTitle?>"/>
    <meta property="og:type" content="<?=$ogType?>"/>
    <meta property="og:url" content="<?=$ogUrl?>"/>
    <meta property="og:site_name" content="<?=$ogSiteName?>"/>
    <meta property="og:description" content="<?=$ogDesc?>"/>
    <meta property="og:image" content="<?=$ogImage?>"/>
    <meta property="og:image:height" content="<?=$ogImageHeight?>"/>
    <meta property="og:image:width" content="<?=$ogImageWidth?>"/>

    <!-- Material design colors -->
    <link href="<?=ABS_CSS_URL?>/material-design-iconic-font-min.css" rel="stylesheet">

    <!-- CSS animations -->
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/animate-min.css">

    <!-- Select2 - Custom Selects -->
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/select2-min.css">

    <!-- NoUiSlider - Input Slider -->
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/nouislider-min.css">

    <!-- Site -->
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/app1-min.css">
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/app2-min.css">

    <!-- Page Loader JS -->
    <script src="<?=ABS_JS_URL?>/page-loader-min.js" async=""></script>
    <!-- Javascript -->
    <script src="<?=ABS_JS_URL?>/jquery-min.js"></script>

    <!-- Bootstrap -->
    <script src="<?=ABS_JS_URL?>/bootstrap-min.js"></script>
    <?php include_once("googleanalytics.php"); ?>
</head>

<body>
    <!-- Start page loader -->
    <div id="page-loader" style="opacity: 0.0984771; display: none;">
        <div class="page-loader__spinner"></div>
    </div>
    <!-- End page loader -->

        <header id="header" class="<?=$headerClass?>">
            <div class="header__top">
                <div class="container">
                    <ul class="top-nav">
                        <li class="pull-right dropdown top-nav__guest">
                            <a data-toggle="dropdown" href="" aria-expanded="false">Register</a>

                            <form class="dropdown-menu stop-propagate" id="top-nav-register">
                                <div class="form-group">
                                    <input name="name" id="registerName" type="text" class="form-control" placeholder="Full Name">
                                    <i class="form-group__bar"></i>
                                </div>

                                <div class="form-group">
                                    <input name="email" id="registerEmail" type="text" class="form-control" placeholder="Email Address">
                                    <i class="form-group__bar"></i>
                                </div>

                                <div class="form-group">
                                    <input name="password" id="registerPassword" type="password" class="form-control" placeholder="Password">
                                    <i class="form-group__bar"></i>
                                </div>

                                <div class="form-group">
                                    <input name="cpasswod" id="registerCPassword" type="password" class="form-control" placeholder="Confirm Password">
                                    <i class="form-group__bar"></i>
                                </div>

                                <div class="form-group">
                                    <select name="registerType" id="registerType" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        <option value='1'>Entrepreneur</option>
                                        <option value='2'>Investor</option>
                                    </select>
                                    <i class="form-group__bar"></i>
                                </div>
                                <p style="color:red;" id="errorMsgRF"></p>
                                <button type="submit" class="submitBtnRF btn btn-primary btn-block m-t-10 m-b-10">Register</button>

                                <!-- <div class="top-nav__auth">
                                    <span>or</span>

                                    <div>Sign in using</div>

                                    <a href="<?//=$fbUrl?>" class="mdc-bg-blue-500">
                                        <i class="zmdi zmdi-facebook"></i>
                                    </a>

                                    <a href="<?//=$googleUrl?>" class="mdc-bg-red-400">
                                        <i class="zmdi zmdi-google"></i>
                                    </a>
                                </div> -->

                            </form>
                        </li>

                        <li class="pull-right dropdown top-nav__guest">
                            <a data-toggle="dropdown" href="" data-rmd-action="switch-login" aria-expanded="false">Login</a>

                            <div class="dropdown-menu">
                                <div class="tab-content">
                                    <form class="tab-pane fade active in" id="top-nav-login">
                                        <div class="form-group">
                                            <input name="email" id="loginEmail" type="text" class="form-control" placeholder="Email Address">
                                            <i class="form-group__bar"></i>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" id="loginPassword" class="form-control" placeholder="Password">
                                            <i class="form-group__bar"></i>
                                        </div>

                                        <div class="form-group">
                                            <select name="loginType" id="loginType" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                <option value='1'>Entrepreneur</option>
                                                <option value='2'>Investor</option>
                                            </select>
                                            <i class="form-group__bar"></i>
                                        </div>

                                        <p style="color:red;" id="errorMsgLF"></p>
                                        <button type="submit" class="submitBtnLF btn btn-primary btn-block m-t-10 m-b-10">Login</button>

                                        <div class="text-center">
                                            <a href="#top-nav-forgot-password" data-toggle="tab"><small>Forgot Password?</small></a>
                                        </div>

                                        <!-- <div class="top-nav__auth">
                                            <span>or</span>

                                            <div>Sign in using</div>

                                            <a href="<?=$fbUrl?>" class="mdc-bg-blue-500">
                                                <i class="zmdi zmdi-facebook"></i>
                                            </a>

                                            <a href="<?=$googleUrl?>" class="mdc-bg-red-400">
                                                <i class="zmdi zmdi-google"></i>
                                            </a>
                                        </div> -->
                                    </form>

                                    <form class="tab-pane fade forgot-password" id="top-nav-forgot-password">
                                        <a href="#top-nav-login" class="top-nav__back" data-toggle="tab"></a>

                                        <p>Email Address</p>

                                        <div class="form-group">
                                            <input name="email" id="forgetEmail" type="text" class="form-control" placeholder="Enter your email">
                                            <i class="form-group__bar"></i>
                                        </div>

                                        <div class="form-group">
                                            <select name="registerType1" id="registerType1" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                <option value='1'>Entrepreneur</option>
                                                <option value='2'>Investor</option>
                                            </select>
                                            <i class="form-group__bar"></i>
                                        </div>

                                        <p style="color:red;" id="errorMsgFPF"></p>
                                        <button type="submit" class="submitBtnFPF btn btn-warning btn-block">Reset Password</button>
                                    </form>
                                </div>
                            </div>
                        </li>

                        <li class="pull-right top-nav__icon">
                            <a target="_blank" href="https://www.facebook.com/ecoaching.guru"><i class="zmdi zmdi-facebook"></i></a>
                        </li>
                        <li class="pull-right top-nav__icon">
                            <a target="_blank" href="https://twitter.com/EcoachingGuru"><i class="zmdi zmdi-twitter"></i></a>
                        </li>

                        <li class="pull-right hidden-xs"><span><i class="zmdi zmdi-email"></i>ecoachinguru@gmail.com</span></li>
                        <li class="pull-right hidden-xs"><span><i class="zmdi zmdi-phone"></i>+91-9560807518</span></li>
                    </ul>
                </div>
            </div>
</header>

<br /><br /><br /><br /><br /><br />

<script type="text/javascript" src="http://assets.freshdesk.com/widget/freshwidget.js"></script>
<style type="text/css" media="screen, projection">
	@import url(http://assets.freshdesk.com/widget/freshwidget.css); 
</style> 
<iframe title="Feedback Form" class="freshwidget-embedded-form" id="freshwidget-embedded-form" src="https://getmeafunding.freshdesk.com/widgets/feedback_widget/new?&widgetType=embedded&formTitle=Contact+Us&submitTitle=Submit&submitThanks=Thank+you+for+reaching+us.+We+will+get+back+on+your+message+soon.&screenshot=No&searchArea=no" scrolling="no" height="400px" width="100%" frameborder="0" >
</iframe>

<br /><br /><br /><br /><br /><br />

<?php include_once("layout/footer.php"); ?>