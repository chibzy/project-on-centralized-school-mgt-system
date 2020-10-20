<?php
require_once("../connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}


#echo $_SESSION['schlid']." school id <br>";
include("header.php"); #cause redirection of request after signout

$schlid=$_SESSION['schlid'];
$schldetails=array();
$schldetails=getSchoolDetails($schlid);

$schlname=$schldetails['schlName'];
$schlstate=$schldetails['State'];
$schllocation=$schldetails['location'];
$testid=mysqli_escape_string($conn,$_REQUEST['id']);

if(isset($_POST['addMAQ'])){#adds new non-illustration based question
	$Qtitle='';
	$ill='';
	$ansOption='';
	$answer='';
	$testReasoning='';
	$Qtype='';
	
	if(isset($_POST['Question'])) $Qtitle=mysqli_escape_string($conn,$_POST['Question']);
	if(isset($_POST['testOption'])) $ansOption=mysqli_escape_string($conn,$_POST['testOption']);
	if(isset($_POST['PracticeReason'])) $testReasoning=mysqli_escape_string($conn,$_POST['PracticeReason']);
	if(isset($_POST['sill']) && $_POST['sill']=='on') $ill=$_FILES['sillAttach'];
	if(isset($_POST['qtype'])) $Qtype=mysqli_escape_string($conn,$_POST['qtype']);
	if(isset($_POST['AnswerValues'])) $answer=mysqli_escape_string($conn,$_POST['AnswerValues']);
	
	#echo "$schlid,$testid,$Qtitle,$ill,$ansOption,$answer,$testReasoning,$Qtype<br>";
	addMAQ($schlid,$testid,$Qtitle,$ill,$ansOption,$answer,$testReasoning,$Qtype);
	
}
if(isset($_POST['addIMAQ'])){#adds new illustration based question
	$Qtitle='';
	$ill='';
	$ansOption='';
	$answer='';
	$testReasoning='';
	$Qtype='';
	
	if(isset($_POST['Question'])) $Qtitle=mysqli_escape_string($conn,$_POST['Question']);
	if(isset($_POST['testOption'])) $ansOption=mysqli_escape_string($conn,$_POST['testOption']);
	if(isset($_POST['ansReasoning'])) $testReasoning=mysqli_escape_string($conn,$_POST['ansReasoning']);
	if(isset($_POST['addIllustration']) && $_POST['addIllustration']=='on') $ill=$_FILES['qillustration'];
	if(isset($_POST['qtype'])) $Qtype=mysqli_escape_string($conn,$_POST['qtype']);
	if(isset($_POST['ans'])) $answer=mysqli_escape_string($conn,$_POST['ans']);
	
	#echo "$schlid,$testid,$Qtitle,$ill,$ansOption,$answer,$testReasoning,$Qtype<br>";
	addIMAQ($schlid,$testid,$Qtitle,$ill,$ansOption,$answer,$testReasoning,$Qtype);
	
}
if(isset($_POST['updateQnExit'])){#updates non-illustration based questions
	$img='';
	$Qid='';
	$question='';
	$option='';
	$ans='';
	$explain='';
	
	if(isset($_POST['question'])) $question=mysqli_escape_string($conn,$_POST['question']);
	if(isset($_POST['option'])) $option=mysqli_escape_string($conn,$_POST['option']);
	if(isset($_POST['explain'])) $explain=mysqli_escape_string($conn,$_POST['explain']);
	if(isset($_POST['chng']) && $_POST['chng']=='on') $img=$_FILES['chngAttach'];
	if(isset($_POST['qid'])) $Qid=mysqli_escape_string($conn,$_POST['qid']);
	if(isset($_POST['ans'])) $ans=mysqli_escape_string($conn,$_POST['ans']);
	
	updatedEditedNQ($img,$Qid,$question,$option,$ans,$explain);
}
if(isset($_POST['updateQnExit2'])){#updates illustration based questions
	$img='';
	$Qid='';
	$question='';		#still on this
	$option=array();
	$ans='';
	$explain='';
	$testid='';
	
	if(isset($_POST['question'])) $question=mysqli_escape_string($conn,$_POST['question']);
	
#	if(isset($_POST['option'])) $option=mysqli_escape_string($conn,$_POST['option']);
	
	for($i=0;$i<=4;$i++){
		if(isset($_FILES["chngAttach$i"])) {
			$option[$i]=$_FILES["chngAttach$i"];
		}	
	}
	if(isset($_POST['explain'])) $explain=mysqli_escape_string($conn,$_POST['explain']);
	if(isset($_POST['chng']) && $_POST['chng']=='on') $img=$_FILES['chngAttach'];
	if(isset($_POST['qid'])) $Qid=mysqli_escape_string($conn,$_POST['qid']);
	if(isset($_POST['testid'])) $testid=mysqli_escape_string($conn,$_POST['testid']);
	if(isset($_POST['ans'])) $ans=mysqli_escape_string($conn,$_POST['ans']);
	
	#echo "($img,$Qid,$question,$option,$ans,$explain,$schlid,$testid)<br>";
	
	updatedEditedIQ($img,$Qid,$question,$option,$ans,$explain,$schlid,$testid);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="../ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="../ScriptLibrary/mine.js"></script>
<style type="text/css" media="screen">
    .inplaceeditor-saving { background: url(../wait.gif) bottom right no-repeat; }
  </style>
</head>

<body class="modalBg">
<?php
include("test_preparation_page.php");
include("multipleq_page.php");#pop up windows
include("editnquestion.php");#pop up windows
include("editiquestion.php");#pop up windows
include("testpreview.php");#pop up windows


?>
</body>
</html>