<?php
require_once("../connect/indexscripts.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>@admin - Pins for sale | Post primary school education center.</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="../ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="../ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
</head>

<body>
<div class="container-fluid">
<?php
function loadDetailedPinc($batchno){
	$details=array();
	$fields=array();
	$flagfields=array('batch_no');
	$flagvalues=array("$batchno");
	$k=mysqli_query($conn,SQLretrieve('access_pin',$fields,$flagfields,$flagvalues));
	
	if($k!=false){
	$new=0;
	$i=0;
		while($val=mysqli_fetch_array($k)){
			$details[$i]=$val;
			$i++;
		}
	}
	?>
	<div class="row">
    <?php for($j=0;$j<count($details);$j++){
		?>
    	<!--td-->
        <div class="span3" style="border:#CCC solid thin; padding:4px; margin-bottom:2px; font-size:12px;">
        	<div><b>RESULT ACCESS PIN	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><span style="text-align:right;"><b>N1000</b></span></div>
            <div><b>Direction</b><br>1. visit <i>www.ppseducation.com</i><br>2. Search your <b>School Name</b><br>3. Enter your student ID, and and pin.</div>
            <hr>
			<?php echo "S/N : {$details[$j][3]} <br><b>Pin : {$details[$j][4]}</b>";?>
        	<?php echo "<div style=\"text-align:right;\">For {$details[$j][6]} access only.</div>";?>
        </div>
    <?php }
	?>
    </div>
    <?php
}
$id='';
if($_REQUEST['id']!='') $batchno=mysqli_escape_string($conn,$_REQUEST['id']);
loadDetailedPinc($batchno);
?>
</div>
</body>
</html>