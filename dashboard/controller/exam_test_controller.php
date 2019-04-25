<?php 
session_start();
include_once ("../config.php");
include_once("../global.php");
include_once("../class/common_class.php");
include_once("../class/exam_test_class.php");
include_once("../class/exam_chapter_class.php");
include_once("../class/exam_subject_class.php");
include_once("../class/exam_question_class.php");

if((isset($_REQUEST['flowtype'])) && (isset($_POST)) && (isset($_SESSION['id'])) && (isset($_SESSION['instituate_id'])))
{
	$Common = new Common();
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{
		$examSubject = new Exam_Subject();
		if(isset($_POST['exam_id']) && !empty($_POST['exam_id'])) {
			$ExamSubjectArray = $examSubject->getExamSubjectList($_POST['exam_id']);
			$array = array('status' => 'success', 'json' => json_encode($ExamSubjectArray));
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	} else if(isset($_POST) && $flowtype == 2) {

		$examChapter = new Exam_Chapter();
		if(isset($_POST['subject_id']) && !empty($_POST['subject_id'])) {
			$SubjectChapterArray = $examChapter->getSubjectChapterList($_POST['subject_id']);
			$array = array('status' => 'success', 'json' => json_encode($SubjectChapterArray));
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	} else if(isset($_POST) && $flowtype == 3) {

		$examTest = new Exam_Test();
		if(isset($_POST['exam_id']) && !empty($_POST['exam_id']) && isset($_POST['name']) && !empty($_POST['name'])) {
			$Url = "";
			$Tid = $examTest->insertExamTest($_SESSION['instituate_id'], $_POST['exam_id'], $_POST['subject_id'], $_POST['chapter_id'], $_POST['name'], $Url, $_POST['level'], htmlspecialchars($_POST['instruction']), 0);
			if($Tid) {
				$Url = $Common->seofriendlyurl($_POST['name'])."-".$Tid;
				$examTest->updateUrlExamTest($Tid, $Url);
				$_SESSION['test_id'] = base64_encode($Tid);
				$array = array('status' => 'success', 'id' => $Tid);
			} else {
				$array = array('status' => 'error');
			}
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	} else if(isset($_POST) && $flowtype == 4) {
		$examQuestion = new Exam_Question();
		if(isset($_POST['test_id']) && !empty($_POST['test_id']) && isset($_POST['q']) && !empty($_POST['q']) && (isset($_SESSION['test_id'])) && ($_POST['test_id'] == $_SESSION['test_id'])) {
			$test_id = base64_decode($_POST['test_id']);
			if(isset($_POST['q_id']) && !empty($_POST['q_id'])) {
				$q_id = base64_decode($_POST['q_id']);
				$QuestionArray = $examQuestion->getExamQuesByQuesID($test_id, $q_id);
				if(is_array($QuestionArray) && !empty($QuestionArray)) {
					$Status = $examQuestion->updateExamQuestion($test_id, $q_id, htmlspecialchars($_POST['q']), $_POST['a'], $_POST['b'], $_POST['c'], $_POST['d'], $_POST['r'], htmlspecialchars($_POST['s']), htmlspecialchars($_POST['desc']));
					if($Status) {
						$count = $examQuestion->getExamTotalQuesCount($test_id);
						$qNo = $count + 1;
						$array = array('status' => 'success', 'id' => $test_id, 'count' => $qNo);
					} else {
						$array = array('status' => 'error');
					}
				} else {
					$array = array('status' => 'error');
				}
			} else {
				$Qid = $examQuestion->insertExamQuestion($test_id, htmlspecialchars($_POST['q']), $_POST['a'], $_POST['b'], $_POST['c'], $_POST['d'], $_POST['r'], htmlspecialchars($_POST['s']), htmlspecialchars($_POST['desc']));
				if($Qid) {
					$count = $examQuestion->getExamTotalQuesCount($test_id);
					$qNo = $count + 1;
					$array = array('status' => 'success', 'id' => $test_id, 'count' => $qNo);
				} else {
					$array = array('status' => 'error');
				}
			}	
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	} else if(isset($_POST) && $flowtype == 5) {

		$examTest = new Exam_Test();
		if(isset($_POST['test_id']) && !empty($_POST['test_id'])) {
			$TestId = base64_decode($_POST['test_id']);
			$Tid = $examTest->updateExamTest($TestId, 1);
			if($Tid) {
				$array = array('status' => 'success');
			} else {
				$array = array('status' => 'error');
			}
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	} else if(isset($_POST) && $flowtype == 6) {

		$examTest = new Exam_Test();
		if(isset($_POST['test_id']) && !empty($_POST['test_id'])) {
			$TestId = base64_decode($_POST['test_id']);
			$Tid = $examTest->updateExamTest($TestId, 2);
			if($Tid) {
				$array = array('status' => 'success');
			} else {
				$array = array('status' => 'error');
			}
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	} else if(isset($_POST) && $flowtype == 7) {

		$examTest = new Exam_Test();
		if(isset($_POST['test_id']) && !empty($_POST['test_id'])) {
			$examArray = $examTest->getExamTestById($_POST['test_id']);
			if(!$examArray['status']) {
				$_SESSION['test_id'] = base64_encode($_POST['test_id']);
				$array = array('status' => 'success');
			} else {
				$array = array('status' => 'error');
			}
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	}

} else {
	header("location:".DASH_URL);
	die();
}
        


