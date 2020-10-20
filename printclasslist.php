<?php
require_once("connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}
if(isset($_REQUEST['clsid']) && isset($_REQUEST['subclass'])){
	$classid=mysqli_escape_string($conn,$_REQUEST['clsid']);
	$schlid=$_SESSION['schlid'];
	$subclass=mysqli_escape_string($conn,$_REQUEST['subclass']);
}else{
	header("location:index.php");
}
$schlid=$_SESSION['schlid'];
$schldetails=array();
$schldetails=getSchoolDetails($schlid);

$schlname=$schldetails['schlName'];
$schlstate=$schldetails['State'];
$schllocation=$schldetails['location'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $schlname;?> - Printable class list | Post primary school education center</title>
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
<div class="row-fluid titlebody">
<div class="span12">
    	<table width="100%" style="margin:10px;">
        <tr><td>Total in Class : <?php 
		$level=date('Y')-$classid;
		$level++;
		#should determined using a function by subtracting the class year from the current year.
		echo classPopulation($classid,$level,$schlid);?>
        </td><td>
        Class Admission Year : <?php echo $classid;?></td><td>
        Current class : <?php echo $level." $subclass";?></td>
        </tr>
    	</table>
    </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
        <?php
        	displayPrintClassList($schlid,$classid,$subclass);
		?>
        
        <div style="text-align:right; padding:20px;" onclick="print();" ><a style="cursor:pointer;"><span class="icon-print"></span> Print</a></div>
        </div>
    </div>
    
    <div class="row-fluid">
    	<div class="span12">
        <center>
        <?php echo $schldetails['schlName'];?> Name of <?php echo $schldetails['address'];?><br />
        on www.ppseducation.com.ng<br />
        For more information contact us on support@ppseducation.com.ng<br />
        or Call <span class="icon-user"></span> 07036765446<br />
        
        </center>
        </div>
    </div>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>