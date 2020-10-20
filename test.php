<?php
require_once("connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
#	$_SESSION['encryption-key']=12345;
#	$_SESSION['iv']=4321;
}




$data = ($_GET['data']);
$hash=($_GET['hash']);

if (hash_hmac('sha256', $data, $_SESSION['encryption-key'])== $hash) {
  //no tampering detected, proceed with other processing
	#echo "The original text was <br><br>".decrypt($data);
	$decryptedData=decrypt($data);
	
	$oj=explode(':',$decryptedData);

	$studid=mysqli_escape_string($conn,$oj[1]);
  	$schlid=mysqli_escape_string($conn,$oj[0]);
  	$testid=mysqli_escape_string($conn,$oj[2]);


} else {
  //tampering of data detected
	echo "data tampered with.";
	header("location:index.php");
	
}
  
 /* 
  if(isset($_REQUEST['studid'])) $studid=mysqli_escape_string($conn,$_REQUEST['studid']);
  if(isset($_REQUEST['schlid'])) $schlid=mysqli_escape_string($conn,$_REQUEST['schlid']);
  if(isset($_REQUEST['testid'])) $testid=mysqli_escape_string($conn,$_REQUEST['testid']);
*/

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

<body><!-- style="margin:50px; padding:20px; line-height:25px;"-->
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
<div style="margin:0px 50px 0px 50px; padding:20px; line-height:25px;">
<div id="details" style="display:none;"><?php echo "$schlid,$studid,$testid";?></div>
<span id="timer"></span>
<div class="clear"></div>
<form id="test" name="test" method="post">
<?php 
	
	$user=getStudNameforTestResult($studid);
	
	loadTest($schlid,$testid,'preview');
	loadTest_intro_student($user);
?>
</form>
</div>
</div>
</div>
</div>
</body>
</html>