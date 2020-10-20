<?php
if(!isset($_SESSION)){
	session_start();
}
require_once("connect/indexscripts.php");

$schlid=mysqli_escape_string($conn,$_REQUEST['schlid']);
$studid=mysqli_escape_string($conn,$_REQUEST['studid']);
$testid=mysqli_escape_string($conn,$_REQUEST['testid']);

$schldetails=array();
$schldetails=getSchoolDetails($schlid);

$schlname=$schldetails['schlName'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>

<body>
<div class="container-fluid">
<div class="adminHeading row-fluid">
<div class="span6">
<?php include("link-files/printschoolheading.php");?>
</div>
<div class="span4 offset2 padding"><center>
<img src="img/Coat_of_arms_of_Nigeria.svg.png" width="100" /><br />Federal Ministry of Education.</center>
</div>
</div>
<div class="row-fluid">
<div class="span12">
<?php
$testscore=computeTotalScore_student();
updateTestResult($schlid,$studid,$_SESSION['testID'],$testscore);
?>
</div>
</div>
</div>
</body>
</html>