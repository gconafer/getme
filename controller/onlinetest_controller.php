<?php 
session_start();
include_once ("../config.php");
include_once("../global.php");
include_once("../class/student_class.php");
include_once("../class/exam_test_class.php");
include_once("../class/student_test_class.php");
include_once("../class/student_question_class.php");

if((isset($_REQUEST['flowtype'])) && (isset($_POST)))
{
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{
		$Student = new Student();
		$ExamTest = new Exam_Test();
		$StudentTest = new Student_Test();
		if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['test_id']) && !empty($_POST['test_id']) && isset($_POST['url']) && !empty($_POST['url'])) {

			$testArray = $ExamTest->getTestStatusByIdAndUrl(base64_decode($_POST['test_id']), base64_decode($_POST['url']));
			if(is_array($testArray) && !empty($testArray)) {
				$studentArray = $Student->getStudentByEmail($_POST['email']);
				if(is_array($studentArray) && !empty($studentArray)) {
					$Sid = $studentArray['id'];
				} else {
					$password = rand(10000, 100000);
					$Sid = $Student->insertStudent($_POST['name'], $_POST['email'], $password, 1, '', '', 0, '', '', 1, 1);
				}
				
				$STArray = $StudentTest->insertStudentTest($Sid, $testArray['id'], 0, 0, 0, 0, 1);
				if(is_array($STArray) && !empty($STArray)) {
					$_SESSION['test_student_id'] = $Sid;
					$url = $testArray['url']."-".md5($STArray['time'])."9643adf782gh882bhjh2st".str_rot13($STArray['id']);
					$array = array('status' => 'success', 'url' => $url);
				} else {
					$array = array('status' => 'error', 'msg' => 'You already given this test. try another test.');
				}
			} else {
				$array = array('status' => 'error', 'msg' => 'Something went wrong. Please try again.');
			}
		} else {
			$array = array('status' => 'error', 'msg' => 'Something went wrong. Please try again.');
		}
		echo json_encode($array);

	} elseif (isset($_POST) && $flowtype == 2) {

		$ExamTest = new Exam_Test();
		$StudentTest = new Student_Test();
		$StudentQuestion = new Student_Question();
		if(isset($_POST['test_student_id']) && !empty($_POST['test_student_id']) && isset($_POST['string']) && !empty($_POST['string'])) {

			$qArray = explode('9643adf782gh882bhjh2st', $_POST['string']);
			$StudentTestId = str_rot13($qArray[1]);
			$StudentTestArray = $StudentTest->getStudentTest(base64_decode($_POST['test_student_id']), $StudentTestId);
		    if(is_array($StudentTestArray) && !empty($StudentTestArray) && ($qArray[0] == md5(strtotime($StudentTestArray['created_on'])))) {

		    	if(isset($_POST['q']) && !empty($_POST['q'])) {
		    		foreach ($_POST['q'] as $key => $value) {
		    			$StudentQuestion->insertStudentQuestionOfTest($StudentTestArray['student_id'], $StudentTestArray['test_id'], $key, $value);
		    		}
				}

				/*-------------------     Calculation of Test      ---------------*/
				$RightQ = $WrongQ = $UnattempQ = $TotalQ = $Marks = 0;
				$studentQuestionArray = $StudentQuestion->getStudentTestMarks($StudentTestArray['student_id'], $StudentTestArray['test_id']);
				foreach ($studentQuestionArray as $key => $value) {
		            $NumQ = $NumQ+1;
		            if (($value['exam_ans'] == $value['stu_ans']) && (!empty(trim($value['stu_ans'])))) {
		                $RightQ = $RightQ+1;
		            } elseif (($value['exam_ans'] != $value['stu_ans']) && (!empty(trim($value['stu_ans'])))) {
		                $WrongQ = $WrongQ+1;
		            } else {
		                $UnattempQ = $UnattempQ+1;
		            }
		        }

		        $Marks = $RightQ*4-$WrongQ;
		        $TotalQ = $RightQ + $WrongQ + $UnattempQ;
				$StudentTest->updateStudentTest($_POST['time'], $RightQ, $WrongQ, $UnattempQ, $TotalQ, $Marks, $StudentTestId);
				$testArray = $ExamTest->getTestStatusById($StudentTestArray['test_id']);
				$_SESSION['result_test'] = 1;
				$url = ABS_URL."/online-test-result/".$testArray['url']."-".$_POST['string'];
				header("location:".$url);
				die();
		    } else {
		    	header("location:".ABS_URL);
				die('asdd');
		    }
		} else {
			header("location:".ABS_URL);
			die('aaa');
		}
	}

} else {
	header("location:".ABS_U);
	die();
}
        


