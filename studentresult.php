<?php
require_once("connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}

$data = ($_GET['data']);
$hash=($_GET['hash']);

if (hash_hmac('sha256', $data, $_SESSION['encryption-key'])== $hash) {
  //no tampering detected, proceed with other processing
	#echo "The original text was <br><br>".decrypt($data);
	$decryptedData=decrypt($data);
	
	$oj=explode(':',$decryptedData);
	
	$schlid=mysqli_escape_string($conn,$oj[0]);
	$curclass=mysqli_escape_string($conn,$oj[2]);
	$curterm=mysqli_escape_string($conn,$oj[3]);
	$studID=mysqli_escape_string($conn,$oj[1]);


} else {
  //tampering of data detected
	echo "data tampered with.";
	header("location:index.php");
	
}


$schldetails=array();
$schldetails=getSchoolDetails($schlid);

$schlname=$schldetails['schlName'];
#$schlstate=$schoolDetails['State'];
#$schllocation=$schoolDetails['location'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo "$schlname - $studID Result ";?> | Post primary school education center.</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>

<body style="font-size:11px;">
<div class="container-fluid">
<div class="adminHeading row-fluid">
<div class="span6">
<?php include("link-files/printschoolheading.php");?>
</div>
<div class="span4 offset2 padding"><center>
<img src="img/Coat_of_arms_of_Nigeria.svg.png" width="100" /><br />Federal Ministry of Education.</center>
</div>
</div>
<!--div class="container-fluid"-->
<div class="row-fluid">
<div class="span12">
<?php
	loadResults($schlid,$studID,$curclass,$curterm);
?>
</div>
</div>
<div class="pull-right" style="padding:20px;" onclick="print();"><a style="cursor:pointer;"><span class="icon icon-print"></span> Print</a></div>
<div class="row-fluid">
<div class="span12" style="line-height:15px;">
<center>
<?php echo $schldetails['schlName'];?> of <?php echo $schldetails['address'];?><br />
on www.ppseducation.com.ng<br />
For technical information contact us on support@ppseducation.com.ng<br />
or Call <span class="icon-user"></span> 07036765446<br />

</center>
</div>
</div>
</div>
</body>
</html>