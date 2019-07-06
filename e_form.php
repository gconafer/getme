<?php
// session_start();
// /*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
// include_once("./class/exam_test_class.php");
// include_once("./class/exam_question_class.php");

// /*-------------------     Include File End      ---------------*/

// if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
//     header("Location: ".DASH_URL);
//     die();  
// }

// /*-------------------     Class Object Start      ---------------*/

// $ExamTest = new Exam_Test();
// $ExamQuestion = new Exam_Question();

// /*-------------------     Class Object End      ---------------*/

// $quesNo = $_GET['q'];
// $questionCount = $ExamQuestion->getExamTotalQuesCount($_GET['id']);
// if(isset($_GET['q']) && !empty($_GET['q']) && isset($_GET['id']) && !empty($_GET['id']) && isset($_SESSION['test_id']) && ($_GET['id'] == base64_decode($_SESSION['test_id']))) {
    
//     if (($quesNo > 0) && ($quesNo <= $questionCount+1)) {
//         $questionArray = $ExamQuestion->getExamQuesByQuesNumber($_GET['id'], $_GET['q']);
//         $examTestArray = $ExamTest->getExamTestById($_GET['id']);
//     } else {
//         $url = DASH_URL."/create-exam-test?id=".$_GET['id']."&q=1";
//         header("Location: ".$url);
//         die();
//     }

// } else {
//     header("Location: ".DASH_URL);
//     die();
// }

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/dashboard-header.php");
include_once("layout/left-menu.php");
//echo $questionCount; echo '<pre>'; print_R($questionArray); die('aaa');
?>

<title>Add Exam Test | Ecoaching.guru | Your Online Coaching Guru</title>
<section id="main__content">

    <div class="main__container" style="padding: 30px 10px 30px 10px;">
        <div class="submit-property">
            <ul class="submit-property__steps">
            <?php 
            for ($i=1; $i <= $questionCount+1; $i++) { 
                if($i == $_GET['q']) $active = "class='active'"; else $active = "";
                echo "<li ".$active."><a href='".DASH_URL."/create-exam-test?id=".$_GET['id']."&q=".$i."'>".$i."</a></li>";
            } ?>
                <li class="submit-property__caret"></li>
            </ul>
        </div>
        <br /><br /><br />
        
		<!-- first form start  -->
        <form class="card new-contact" id="eFormNo1">
            <div class="card__body">
                <div class="row">

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="phone" id="pphone" class="form-control">
                            <label>Phone</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="sname" id="sname" class="form-control">
                            <label>Startup name</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="website" id="website" class="form-control">
                            <label>Website url</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="number" name="cofounder" id="cofounder" class="form-control">
                            <label>No. Of Cofounder</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="number" name="member" id="member" class="form-control">
                            <label>No. Of Team Member</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>


                </div>
                <p style="color:red;" id = "errorMsgD"></p>
                <div class="clearfix"></div>
                <div class="m-t-20">
                    <button type="submit" class="btn btn-lg btn-primary submitBtn1" title="Click here to Add Question into this Test and Proceed for next Question">&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
		<!-- first form end  -->
		

		<!-- second form start  -->
        <form class="card new-contact" >
            <div class="card__body">
                <div class="row">
    
                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="name" id="name" class="form-control">
                            <label>is company registered?</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="date" name="email" id="email" class="form-control" >
                            <label>date of inception</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="phone" id="pphone" class="form-control">
                            <label>Location (Country/City)</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='' class='form-control'>
                              <?php foreach ($sector as $key => $value) { ?>
                                        <option value='<?php echo $key; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
							</select>
                            <label>Sector/market</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='' class='form-control'>
                              <?php foreach ($type_of_startup as $key => $value) { ?>
                                        <option value='<?php echo $key; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
							</select>
                            <label>Type of startup</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='' class='form-control'>
                              <?php foreach ($funding_raised_already as $key => $value) { ?>
                                        <option value='<?php echo $key; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
							</select>
                            <label>funding raised already</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="member" id="member" class="form-control">
                            <label>nearest competitor name</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='' class='form-control'>
                              <?php foreach ($stage as $key => $value) { ?>
                                        <option value='<?php echo $key; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
							</select>
                            <label>Stage</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>


                </div>
                <p style="color:red;" id = "errorMsgD"></p>
                <div class="clearfix"></div>
                <div class="m-t-20">
                    <button type="submit" class="btn btn-lg btn-primary submitBtn" title="Click here to Add Question into this Test and Proceed for next Question">&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
		<!-- second form end  -->

		<!-- third form start  -->
        <form class="card new-contact" >
            <div class="card__body">
                <div class="row">
    
				<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='' class='form-control'>
                              <?php foreach ($Avg_monthly_revenue as $key => $value) { ?>
                                        <option value='<?php echo $key; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
							</select>
                            <label>avg monthly revenue</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='' class='form-control'>
                              <?php foreach ($total_revenue_till_now as $key => $value) { ?>
                                        <option value='<?php echo $key; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
							</select>
                            <label>total revenue till now</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='' class='form-control'>
                              <?php foreach ($expected_monthly_revenue_in_next_5_years as $key => $value) { ?>
                                        <option value='<?php echo $key; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
							</select>
                            <label>expected revenue in next 5 years</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='' class='form-control'>
                              <?php foreach ($amount_wants_to_raise as $key => $value) { ?>
                                        <option value='<?php echo $key; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
							</select>
                            <label>looking to raise</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='' class='form-control'>
                              <?php foreach ($equity_diluted_for_above_amount as $key => $value) { ?>
                                        <option value='<?php echo $key; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
							</select>
                            <label>equity diluted for above amount</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='' class='form-control'>
                              <?php foreach ($Amount_Invested_already as $key => $value) { ?>
                                        <option value='<?php echo $key; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
							</select>
                            <label>Amount Invested already</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                </div>
                <p style="color:red;" id = "errorMsgD"></p>
                <div class="clearfix"></div>
                <div class="m-t-20">
                    <button type="submit" class="btn btn-lg btn-primary submitBtn" title="Click here to Add Question into this Test and Proceed for next Question">&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
		<!-- third form end  -->

		<!-- fourth form start  -->
        <form class="card new-contact" >
            <div class="card__body">
                <div class="row">

				<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="member" id="member" class="form-control">
                            <label>about startup</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

				<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='' class='form-control'>
                              <?php foreach ($Suggested_Tags as $key => $value) { ?>
                                        <option value='<?php echo $key; ?>'><?php echo $value; ?></option>
                                    <?php } ?>
							</select>
                            <label>tags</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    

                </div>
                <p style="color:red;" id = "errorMsgD"></p>
                <div class="clearfix"></div>
                <div class="m-t-20">
                    <button type="submit" class="btn btn-lg btn-primary submitBtn" title="Click here to Add Question into this Test and Proceed for next Question">&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
		<!-- fourth form end  -->

    </div>
</section>

<script type="text/javascript" src="<?php echo DASH_URL;?>/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {         

        var abs_url = '<?=ABS_URL?>';
		$(document).on("submit", "form#eFormNo1", function() {
        $(".submitBtn1").attr("disabled", "disabled");
        var pphone = $('#pphone').val();
        var sname = $('#sname').val();
		var website = $('#website').val();
		var cofounder = $('#cofounder').val();
		var member = $('#member').val();
		$.post(abs_url+"/controller/common_controller.php", {pphone:pphone, sname:sname, website:website, cofounder:cofounder, member:member, flowtype:7},function(data) {
			var result = jQuery.parseJSON(data);
			if(result.status == 'success') {
				$('.submitBtn1').removeAttr("disabled");
				window.location.href = abs_url+"/e_form.php";
			} else {
				$('.submitBtn1').removeAttr("disabled");
			}
		});
        return false;
    });
    });
</script>
<?php include_once("layout/dashboard-footer.php"); ?>