<?php
session_start();
// /*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/student_class.php");
// include_once("./class/exam_question_class.php");

$N = 0;

// /*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

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

$Student = new Student();

$arrayF = $Student->getStudentById($_SESSION['id'], 1);

if(isset($_GET['n']) && $_GET['n'] > 0) {
    $N = $_GET['n'];
    $arrayF['formNumber'] = 0;
}


/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/dashboard-header.php");
include_once("layout/left-menu.php");
//echo $questionCount; echo '<pre>'; print_R($questionArray); die('aaa');
?>

<title>Dummy Text</title>
<section id="main__content">

    <div class="main__container" style="padding: 30px 10px 30px 10px;">
    <?php if(!$N) { ?>
        <div class="submit-property">
            <ul class="submit-property__steps">
            <?php 
            for ($i=1; $i <= 4; $i++) {
                if($i == $arrayF['formNumber']) $active = "class='active'"; else $active = "";
                echo "<li ".$active."><a href='#'>".$i."</a></li>";
            } ?>
                <li class="submit-property__caret"></li>
            </ul>
        </div>
    <?php } ?>
        <br /><br /><br />
		
		<?php if ($arrayF['formNumber'] == 1 || $N == 1) { ?>
		<!-- first form start  -->
        <form class="card new-contact" id="eFormNo1">
            <div class="card__body">
                <div class="row">

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="phone" id="pphone" class="form-control" value="<?php echo $arrayF['contactNo']; ?>">
                            <label>Phone</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="sname" id="sname" class="form-control" value="<?php echo $arrayF['startupName']; ?>">
                            <label>Startup name</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="website" id="website" class="form-control" value="<?php echo $arrayF['websiteUrl']; ?>">
                            <label>Website url</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="number" name="cofounder" id="cofounder" class="form-control" value="<?php echo $arrayF['noOfCofounder']; ?>">
                            <label>No. Of Cofounder</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="number" name="member" id="member" class="form-control" value="<?php echo $arrayF['noOfTeamMember']; ?>">
                            <label>No. Of Team Member</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>


                </div>
                <p style="color:red;" id = "errorMsgD"></p>
                <div class="clearfix"></div>
                <div class="m-t-20">
                    <button type="submit" class="btn btn-lg btn-primary submitBtn1" title="Click here to Add Question into this Test and Proceed for next Question">&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
		<!-- first form end  -->
		<?php } ?>
		
		<?php if ($arrayF['formNumber'] == 2 || $N == 2) { ?>
		<!-- second form start  -->
        <form class="card new-contact" id="eFormNo2">
            <div class="card__body">
                <div class="row">
    
                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <select  id='cregistered' class='form-control'>
                                <option value='1'>Yes</option>
                                <option value='2'>No</option>
							</select>
                            <label>is company registered?</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="date"  id="dataofinception" class="form-control" >
                            <label>date of inception</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text"  id="location" class="form-control" value="<?php echo $arrayF['locationName']; ?>">
                            <label>Location (Country/City)</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select id='sector' class='form-control'>
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
						<select id='tstartup' class='form-control'>
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
						<select  id='fundingraised' class='form-control'>
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
                            <input type="text"  id="competitorname" class="form-control" value="<?php echo $arrayF['nearestCompetitorName']; ?>">
                            <label>nearest competitor name</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

					<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select id='stage' class='form-control'>
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
                    <button type="submit" class="btn btn-lg btn-primary submitBtn2" title="Click here to Add Question into this Test and Proceed for next Question">&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
		<!-- second form end  -->
		<?php } ?>
		
		<?php if ($arrayF['formNumber'] == 3 || $N == 3) { ?>
		<!-- third form start  -->
        <form class="card new-contact" id="eFormNo3">
            <div class="card__body">
                <div class="row">
    
				<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='avgM' id='avgM' class='form-control'>
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
						<select name='totalR' id='totalR' class='form-control'>
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
						<select name='expM' id='expM' class='form-control'>
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
						<select name='amtW' id="amtW" class='form-control'>
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
						<select name='equD' id='equD' class='form-control'>
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
						<select name='amtI' id='amtI' class='form-control'>
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
                    <button type="submit" class="btn btn-lg btn-primary submitBtn3" title="Click here to Add Question into this Test and Proceed for next Question">&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
		<!-- third form end  -->
		<?php } ?>
		
		<?php if ($arrayF['formNumber'] == 4 || $N == 4) { ?>
		<!-- fourth form start  -->
        <form class="card new-contact" id="eFormNo4" >
            <div class="card__body">
                <div class="row">

				<div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="abtS" id="abtS" class="form-control" value="<?php echo $arrayF['aboutUs']; ?>">
                            <label>about startup</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

				<div class="col-sm-12">
                        <div class="form-group form-group--float">
						<select name='tags' id='tags' class='form-control'>
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
                    <button type="submit" class="btn btn-lg btn-primary submitBtn4" title="Click here to Add Question into this Test and Proceed for next Question">&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
		<!-- fourth form end  -->
		<?php } ?>

    </div>
</section>

<script type="text/javascript" src="<?php echo DASH_URL;?>/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {         

        var abs_url = '<?=ABS_URL?>';
        var N = <?=$N?>;
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
                alert(N);
                if (N) {
                    $('.submitBtn1').removeAttr("disabled");
				    window.location.href = abs_url+"/gallery.php";
                } else {
                    $('.submitBtn1').removeAttr("disabled");
				    window.location.href = abs_url+"/e_form.php";
                }
				
			} else {
				$('.submitBtn1').removeAttr("disabled");
			}
		});
        return false;
    });
     
	
	$(document).on("submit", "form#eFormNo2", function() {
		$(".submitBtn2").attr("disabled", "disabled");
		var cregistered = $('#cregistered').children("option:selected").val();
		var dataofinception = $('#dataofinception').val();
		var location = $('#location').val();
		var competitorname = $('#competitorname').val();
		var sector = $('#sector').children("option:selected").val();
		var tstartup = $('#tstartup').children("option:selected").val();
		var fundingraised = $('#fundingraised').children("option:selected").val();
		var stage = $('#stage').children("option:selected").val();
		$.post(abs_url+"/controller/common_controller.php", {cregistered:cregistered, dataofinception:dataofinception, location:location, competitorname:competitorname, sector:sector, tstartup:tstartup, fundingraised:fundingraised, stage:stage, flowtype:8},function(data) {
			var result = jQuery.parseJSON(data);
			if(result.status == 'success') {
                if (N) {
                    $('.submitBtn1').removeAttr("disabled");
				    window.location.href = abs_url+"/gallery.php";
                } else {
                    $('.submitBtn1').removeAttr("disabled");
				    window.location.href = abs_url+"/e_form.php";
                }
			} else {
				$('.submitBtn1').removeAttr("disabled");
			}
		});
		return false;
	});

	$(document).on("submit", "form#eFormNo3", function() {
		$(".submitBtn3").attr("disabled", "disabled");
		var avgM = $('#avgM').children("option:selected").val();
		var totalR = $('#totalR').children("option:selected").val();
		var expM = $('#expM').children("option:selected").val();
		var amtW = $('#amtW').children("option:selected").val();
		var equD = $('#equD').children("option:selected").val();
		var amtI = $('#amtI').children("option:selected").val();
		$.post(abs_url+"/controller/common_controller.php", {avgM:avgM, totalR:totalR, expM:expM, amtW:amtW, equD:equD, amtI:amtI, flowtype:9},function(data) {
			var result = jQuery.parseJSON(data);
			if(result.status == 'success') {
                if (N) {
                    $('.submitBtn1').removeAttr("disabled");
				    window.location.href = abs_url+"/gallery.php";
                } else {
                    $('.submitBtn1').removeAttr("disabled");
				    window.location.href = abs_url+"/e_form.php";
                }
			} else {
				$('.submitBtn3').removeAttr("disabled");
			}
		});
		return false;
	});

	$(document).on("submit", "form#eFormNo4", function() {
		$(".submitBtn4").attr("disabled", "disabled");
		var abtS = $('#abtS').val();
		var tags = $('#tags').children("option:selected").val();
		$.post(abs_url+"/controller/common_controller.php", {abtS:abtS, tags:tags, flowtype:10},function(data) {
			var result = jQuery.parseJSON(data);
			if(result.status == 'success') {
				$('.submitBtn4').removeAttr("disabled");
				window.location.href = abs_url+"/gallery.php";
			} else {
				$('.submitBtn3').removeAttr("disabled");
			}
		});
		return false;
	});

});
</script>
<?php include_once("layout/dashboard-footer.php"); ?>