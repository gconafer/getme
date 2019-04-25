<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();
}

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<section id="main__content">
    <div class="main__container">
        <header class="main__title" style="padding:0px;">
            <h1>Change Password</h1>
        </header>

        <form class="card new-contact" id="changePasswordF">
            <input type="hidden" id="flowtype" name="flowtype" value="1">
            <div class="card__body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input class="form-control" type="text" id="old_password">
                            <label>Old Password</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input class="form-control" type="text" id="new_password">
                            <label>New Password</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input class="form-control" type="password" id="c_password">
                            <label>Confirm Password</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                <div class="clearfix"></div>
                <p style="color:red;" id = "errorMsgD"></p>
                <div class="m-t-20">
                    <button type="submit" class="submitBtnF btn btn-primary">Update Password</button>
                </div>
            </div>
        </form>

    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {         

        var dash_url = '<?=DASH_URL?>';

        $(document).on("submit", "form#changePasswordF", function() {
            $(".submitBtn").attr("disabled", "disabled");
            var flowtype = $('#flowtype').val();
            var old_password = $('#old_password').val();
            var new_password = $('#new_password').val();
            var c_password = $('#c_password').val();
            if(!old_password) {
                $('#errorMsgD').text('Please enter old password');
                $('.submitBtn').removeAttr("disabled");
            } else if(!new_password) {
                $('#errorMsgD').text('Please enter new password');
                $('.submitBtn').removeAttr("disabled");
            } else if(!c_password) {
                $('#errorMsgD').text('Please enter confirm password');
                $('.submitBtn').removeAttr("disabled");
            } else if(new_password != c_password) {
                $('#errorMsgD').text('New password and Confirm password does not match');
                $('.submitBtn').removeAttr("disabled");
            } else {
                $.post(dash_url+"/controller/setting_controller.php", {flowtype:flowtype, old_password:old_password, new_password:new_password, c_password:c_password},function(data) {
                    var result = jQuery.parseJSON(data);
                    if(result.status == 'success') {
                        $('.submitBtn').removeAttr("disabled");
                        $('#errorMsgD').css('color', 'green').html(result.msg);
                        $("#errorMsgD").fadeOut(1000, function () {
                            setTimeout(function(){ window.location.href = dash_url+'/dashboard'; }, 1500);
                        });
                    } else {
                        $('#errorMsgD').text(result.msg);
                        $('.submitBtn').removeAttr("disabled");
                    }
                });
            }
            return false;
        });
    });
</script>

<?php include_once("layout/footer.php"); ?>