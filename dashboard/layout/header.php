<!DOCTYPE html>
<html lang="en">
<!--[if IE 9 ]><html lang="en" class="ie9"><![endif]-->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=ABS_IMG_URL?>/favicon.ico?v=2" type="image/x-icon" />
    <!-- Material design colors -->
    <link href="<?=ABS_CSS_URL?>/material-design-iconic-font-min.css" rel="stylesheet">
    <!-- CSS animations -->
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/animate-min.css">
    <!-- SweetAlert2 - Custom Alerts -->
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/sweetalert2-min.css">
    <!-- Select2 - Custom Selects -->
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/select2-min.css">
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
            <a href="<?=DASH_URL?>" class="header-alt__trigger hidden-lg" data-rmd-action="block-open" data-rmd-target="#main__sidebar">
                <i class="zmdi zmdi-menu"></i>
            </a>

            <a href="<?=DASH_URL?>" class="header-alt__logo hidden-xs">Dashboard</a>

            <ul class="header-alt__menu">
                <li class="header-alt__profile dropdown">
                    <a href="#" data-toggle="dropdown">
                        <i class="zmdi zmdi-settings"></i>
                    </a>

                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?=DASH_URL?>/changepassword">Change Password</a></li>
                        <li><a href="<?=DASH_URL?>/controller/login_controller.php?flowtype=2">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </header>