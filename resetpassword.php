<?php
/*-------------------     Include File Start      ---------------*/

include_once("config.php");
include_once("global.php");
include_once("./class/blog_class.php");

/*-------------------     Include File End      ---------------*/

/*-------------------     Class Object Start      ---------------*/

$BlogDBLink = BlogDBConnection();
$Blog = new Blog();

/*-------------------     Class Object End      ---------------*/

if(!isset($_GET['id']) || empty($_GET['id']) || !isset($_GET['key']) || empty($_GET['key'])) {
	$url = ABS_URL.'/';
    header("Location: $url");
    die();
}

?>

<?php include_once("layout/header.php"); ?>
</header>

<section id="main__content">
    <div class="main__container main__container-sm">
        <header class="main__title">
            <h1>Forget Password</h1>
        </header>

        <form class="card new-contact" id="forgetPasswordF">
            <input type="hidden" id="flowtype" name="flowtype" value="6">
            <input type="hidden" id="id" name="id" value="<?=$_GET['id']?>">
            <input type="hidden" id="key" name="key" value="<?=$_GET['key']?>">
            <div class="card__body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input class="form-control" type="text" id="password">
                            <label>Password</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input class="form-control" type="password" id="cpassword">
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

    var abs_url = '<?=ABS_URL?>';
    $(document).on("submit", "form#forgetPasswordF", function() {
        $(".submitBtnF").attr("disabled", "disabled");
        var flowtype = $('#flowtype').val();
        var id = $('#id').val();
        var key = $('#key').val();
        var password = $('#password').val();
        var cpassword = $('#cpassword').val();
        if(!password) {
            $('#errorMsgD').text('Please enter password');
            $('.submitBtnF').removeAttr("disabled");
        } else if (!cpassword) {
            $('#errorMsgD').text('Please enter confirm password');
            $('.submitBtnF').removeAttr("disabled");
        } else if (password != cpassword) {
            $('#errorMsgD').text('Password and confirm password does not match');
            $('.submitBtnF').removeAttr("disabled");
        } else {
            $.post(abs_url+"/controller/common_controller.php", {id:id, key:key, password:password, cpassword:cpassword, flowtype:flowtype},function(data) {
                var result = jQuery.parseJSON(data);
                if(result.status == 'success') {
                    $('.submitBtnF').removeAttr("disabled");
                    $('#errorMsgD').css("color", "green").text(result.msg);
                    //window.location.href = abs_url+"/home";
                } else {
                    $('#errorMsgD').text(result.msg);
                    $('.submitBtnF').removeAttr("disabled");
                }
            });
        }
        return false;
    });

});

</script>

<?php include_once("layout/footer.php"); ?>