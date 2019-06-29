        <footer id="footer">
            <div class="container hidden-xs">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="footer__block">
                            <div class="footer__title">Entrance Exams</div>
                            <a href="<?=MAIN_URL?>/ca-coaching-in-<?=$cityUrl?>">CA Coaching In <?=$cityName?></a><br><br>
                            <a href="<?=MAIN_URL?>/cs-coaching-in-<?=$cityUrl?>">CS Coaching In <?=$cityName?></a><br><br>
                            <a href="<?=MAIN_URL?>/cat-coaching-in-<?=$cityUrl?>">CAT Coaching In <?=$cityName?></a><br><br>
                            <a href="<?=MAIN_URL?>/gate-coaching-in-<?=$cityUrl?>">GATE Coaching In <?=$cityName?></a><br><br>
                            <a href="<?=MAIN_URL?>/iit-jee-coaching-in-<?=$cityUrl?>">IIT JEE Coaching In <?=$cityName?></a><br><br>
                            <a href="<?=MAIN_URL?>/iift-coaching-in-<?=$cityUrl?>">IIFT Coaching In <?=$cityName?></a><br><br>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="footer__block">
                            <div class="footer__title">Competitive Exams</div>
                            <a href="<?=MAIN_URL?>/bank-po-coaching-in-<?=$cityUrl?>">Bank PO Coaching In <?=$cityName?></a><br><br>
                            <a href="<?=MAIN_URL?>/ibps-po-coaching-in-<?=$cityUrl?>">IBPO Coaching In <?=$cityName?></a><br><br>
                            <a href="<?=MAIN_URL?>/railway-rrb-coaching-in-<?=$cityUrl?>">Railway Coaching In <?=$cityName?></a><br><br>
                            <a href="<?=MAIN_URL?>/ssc-coaching-in-<?=$cityUrl?>">SSC Coaching In <?=$cityName?></a><br><br>
                            <a href="<?=MAIN_URL?>/upsc-ias-coaching-in-<?=$cityUrl?>">IAS Coaching In <?=$cityName?></a><br><br>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="footer__block">
                            <div class="footer__title">Practice Courses</div>
                            <a href="<?=ABS_URL?>/bank-clerk-test">Bank Clerk</a><br><br>
                            <a href="<?=ABS_URL?>/bank-po-test">Bank PO</a><br><br>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="footer__block footer__block--blog">
                            <!-- <div class="footer__title">Latest from our blog</div>
                            <?php if(is_array($latestBlogArray) && !empty($latestBlogArray)) { 
                                foreach ($latestBlogArray as $key => $value) {
                                    echo '<a href="'.BLOG_URL.'/'.$value['post_name'].'">'.$value['post_title'].'<small>On '.date('Y/m/d', strtotime($value['post_date'])).'</small></a>';
                                }
                            }
                            ?> -->
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="footer__block">
                            <a class="logo clearfix" href="">
                                <div class="">
                                    <span>Ecoaching.guru help you to prepare for various courses (eg. Bank, SSC, Railway etc.) through Hand-crafted practice test.</span>
                                </div>
                            </a>

                            <address class="m-t-20 m-b-20 f-14">
                                New Delhi, India-110092
                            </address>

                            <div class="f-20">+91-9560807518</div>
                            <div class="f-14 m-t-5">ecoachinguru@gmail.com</div>

                            <div class="f-20 m-t-20">
                                <a target="_blank" href="https://www.facebook.com/ecoaching.guru" class="m-r-10"><i class="zmdi zmdi-facebook"></i></a>
                                <a target="_blank" href="https://twitter.com/EcoachingGuru"><i class="zmdi zmdi-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="container">
                    <span class="footer__copyright">© Ecoaching.guru</span>

                    <a class="hide" href="<?=ABS_URL?>/blog">About Us</a>
                    <a href="<?=ABS_URL?>/blog">Blog</a>
                    <a class="hide" href="<?=ABS_URL?>/blog">Terms &amp; Conditions</a>
                    <a class="hide" href="<?=ABS_URL?>/blog">Privacy Policy</a>
                </div>

                <div class="footer__to-top" data-rmd-action="scroll-to" data-rmd-target="html">
                    <i class="zmdi zmdi-chevron-up"></i>
                </div>
            </div>
        </footer>

    </body>
</html>

<!-- Older IE warning message -->
<!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="ie-warning__inner">
        <ul class="ie-warning__download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="img/browsers/chrome.png" alt="">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="img/browsers/firefox.png" alt="">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="img/browsers/opera.png" alt="">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="img/browsers/safari.png" alt="">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="img/browsers/ie.png" alt="">
                    <div>IE (New)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->


<script type="text/javascript">

$(document).ready(function() {

    var abs_url = '<?=ABS_URL?>';
    var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    $(document).on("submit", "form#top-nav-login", function() {
        $(".submitBtnLF").attr("disabled", "disabled");
        var email = $('#loginEmail').val();
        var password = $('#loginPassword').val();
        var type = $('#registerType').children("option:selected").val();
        if(!password) {
            $('#errorMsgLF').text('Please enter password');
            $('.submitBtnLF').removeAttr("disabled");
        } else if (!email) {
            $('#errorMsgLF').text('Please enter email');
            $('.submitBtnLF').removeAttr("disabled");
        } else if (!regEx.test(email)) {
            $('#errorMsgLF').text('Please enter valid email');
            $('.submitBtnLF').removeAttr("disabled");
        } else {
            $.post(abs_url+"/controller/common_controller.php", {email:email, password:password, type:type, flowtype:3},function(data) {
                var result = jQuery.parseJSON(data);
                if(result.status == 'success') {
                    $('.submitBtnLF').removeAttr("disabled");
                    $('#errorMsgLF').css("color", "green").text(result.msg);
                    //window.location.href = abs_url+"/home";
                } else {
                    $('#errorMsgLF').text(result.msg);
                    $('.submitBtnLF').removeAttr("disabled");
                }
            });
        }
        return false;
    });

    $(document).on("submit", "form#top-nav-register", function() {
        $(".submitBtnRF").attr("disabled", "disabled");
        var name = $('#registerName').val();
        var email = $('#registerEmail').val();
        var password = $('#registerPassword').val();
        var cpassword = $('#registerCPassword').val();
        var type = $('#registerType').children("option:selected").val();

        if(!name) {
            $('#errorMsgRF').text('Please enter full name');
            $('.submitBtnRF').removeAttr("disabled");
        } else if (!email) {
            $('#errorMsgRF').text('Please enter email');
            $('.submitBtnRF').removeAttr("disabled");
        } else if (!regEx.test(email)) {
            $('#errorMsgRF').text('Please enter valid email');
            $('.submitBtnRF').removeAttr("disabled");
        } else if (!password) {
            $('#errorMsgRF').text('Please enter password');
            $('.submitBtnRF').removeAttr("disabled");
        } else if (!cpassword) {
            $('#errorMsgRF').text('Please enter confirm password');
            $('.submitBtnRF').removeAttr("disabled");
        } else if (password != cpassword) { 
            $('#errorMsgRF').text('Password and confirm password does not match');
            $('.submitBtnRF').removeAttr("disabled");
        } else {
            $.post(abs_url+"/controller/common_controller.php", {name:name, email:email, password:password, cpassword:cpassword, type:type, flowtype:4},function(data) {
                var result = jQuery.parseJSON(data);
                if(result.status == 'success') {
                    $('.submitBtnRF').removeAttr("disabled");
                    $('#errorMsgRF').css("color", "green").text(result.msg);
                    //window.location.href = abs_url+"/home";
                } else {
                    $('#errorMsgRF').text(result.msg);
                    $('.submitBtnRF').removeAttr("disabled");
                }
            });
        }
        return false;
    });

    $(document).on("submit", "form#top-nav-forgot-password", function() {
        $(".submitBtnFPF").attr("disabled", "disabled");
        var email = $('#forgetEmail').val();
        if (!email) {
            $('#errorMsgFPF').text('Please enter email');
            $('.submitBtnFPF').removeAttr("disabled");
        } else if (!regEx.test(email)) {
            $('#errorMsgFPF').text('Please enter valid email');
            $('.submitBtnFPF').removeAttr("disabled");
        } else {
            $('#errorMsgFPF').css("color", "blue").text("Please Wait...");
            $.post(abs_url+"/controller/common_controller.php", {email:email, flowtype:5},function(data) {
                var result = jQuery.parseJSON(data);
                if(result.status == 'success') {
                    $('.submitBtnFPF').removeAttr("disabled");
                    $('#errorMsgFPF').css("color", "green").text(result.msg);
                } else {
                    $('#errorMsgFPF').css("color", "red").text(result.msg);
                    $('.submitBtnFPF').removeAttr("disabled");
                }
            });
        }
        return false;
    });

});    

</script>

<!-- Waves button ripple effects -->
<script src="<?=ABS_JS_URL?>/waves-min.js"></script>

<!-- Select 2 - Custom Selects -->
<script src="<?=ABS_JS_URL?>/select2-min.js"></script>

<!-- NoUiSlider -->
<script src="<?=ABS_JS_URL?>/nouislider-min.js"></script>

<!-- Light Gallery -->
<script src="<?=ABS_JS_URL?>/lightgallery-all-min.js"></script>

<!-- rateYo - Ratings -->
<script src="<?=ABS_JS_URL?>/jquery.rateyo.js"></script>

<!-- Autosize - Auto height textarea -->
<script src="<?=ABS_JS_URL?>/autosize-min.js"></script>

<!-- jsSocials - Social link sharing -->
<script src="<?=ABS_JS_URL?>/jssocials-min.js"></script>


<!-- IE9 Placeholder -->
<!--[if IE 9 ]>
<script src="<?=ABS_JS_URL?>/jquery.placeholder.min.js"></script>
<![endif]-->

<!-- Site functions and actions -->
<script src="<?=ABS_JS_URL?>/app-min.js"></script>

<!-- Demo only -->
<script src="<?=ABS_JS_URL?>/nearby-properties.js"></script>
<script src="<?=ABS_JS_URL?>/demo.js"></script>