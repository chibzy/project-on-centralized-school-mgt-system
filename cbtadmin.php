<?php
require_once("connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}


#echo $_SESSION['schlid']." school id <br>";
include("link-files/header.php"); #cause redirection of request after signout

$schlid=$_SESSION['schlid'];
$schldetails=array();
$schldetails=getSchoolDetails($schlid);

$schlname=$schldetails['schlName'];
$schlstate=$schldetails['State'];
$schllocation=$schldetails['location'];

if(isset($_POST['btnupgrade'])){
	header("location:premuim_cbt_order.php");
}


#for add new test popup.
if(isset($_POST['btnSavenContinue'])){
	$testName=mysqli_escape_string($conn,$_POST['testName']);
	$testID=mysqli_escape_string($conn,$_POST['testID']);
	$instr=mysqli_escape_string($conn,$_POST['instruction']);
	$noQ=mysqli_escape_string($conn,$_POST['noofQuestion']);
	$testDuration=mysqli_escape_string($conn,$_POST['testDuration']);
	$percentTestOp=mysqli_escape_string($conn,$_POST['Testpercent']);
	$targetClass=mysqli_escape_string($conn,$_POST['targetClass']);
	$testType=mysqli_escape_string($conn,$_POST['testType']);
	$Qreshuffle=mysqli_escape_string($conn,$_POST['reshuffle']);
	if(!isset($_SESSION['cbtAccessCode'])){
		$cbtAccessCode='';
		AdminAddnewCBT($schlid,$cbtAccessCode,$testName,$testID,$instr,$noQ,$testDuration,$percentTestOp,$targetClass,$testType,$Qreshuffle);
	}else{
		$cbtAccessCode=$_SESSION['cbtAccessCode'];
	}
	#echo "Level 1<br>";
	#AdminAddnewCBT($schlid,$cbtAccessCode,$testName,$testID,$instr,$noQ,$testDuration,$percentTestOp,$targetClass,$testType,$Qreshuffle);
	
	if(isset($cbtAccessCode)){
		#update the 'premuim cbt access code ' table with the test id.
		$fields=array();
		$flagfields=array('access_code','schlid');
		$flagvalues=array($cbtAccessCode,$schlid);
		
		$ok=mysqli_query($conn,SQLretrieve('premuim_cbt_access_code',$fields,$flagfields,$flagvalues));
		
		if(mysqli_affected_rows($conn)>0){
			if($val=mysqli_fetch_array($ok)){
				#check for full usage of code.
				#if fully used, inform user, else, add to
				#the List
				
				$usage=$val['access_usage'];
				$all=explode(':',$usage);
				
				if(!in_array($testID,$all)){
				$usage_level=count($all);
				if($usage_level<10){
					$all[$usage_level]="$testID";
					if($usage==0){
						$finished=$all[$usage_level];
					}else{
						$finished=implode(':',$all);
					}
					
					$sql="update premuim_cbt_access_code set access_usage='$finished' where access_code='$cbtAccessCode'";
					#echo "$sql<br>";
					mysqli_query($conn,$sql);
					#create the test
					AdminAddnewCBT($schlid,$cbtAccessCode,$testName,$testID,$instr,$noQ,$testDuration,$percentTestOp,$targetClass,$testType,$Qreshuffle);
				}else{
					echo 'code fully used';
				}
				
			}
			}
			
		}
	}
}
if(isset($_POST['exit'])){
	header("location:admindashboard.php");
}
if(isset($_POST['updateTest'])){
	$Qreshuffle='';
	$pubStatus='';
	$testName=mysqli_escape_string($conn,$_POST['testname']);
	$testID=mysqli_escape_string($conn,$_POST['testID']);
	$instr=mysqli_escape_string($conn,$_POST['instruction']);
	$noQ=mysqli_escape_string($conn,$_POST['maxQ']);
	$testDuration=mysqli_escape_string($conn,$_POST['testDuration']);
	$percentTestOp=mysqli_escape_string($conn,$_POST['percentQ']);
	$targetClass=mysqli_escape_string($conn,$_POST['targetClass']);
	$testType=mysqli_escape_string($conn,$_POST['testType']);
	if(isset($_POST['reshuffle']))$Qreshuffle=mysqli_escape_string($conn,$_POST['reshuffle']);
	if(isset($_POST['publish']))$pubStatus=mysqli_escape_string($conn,$_POST['publish']);
	
	AdminUpdateTestproperty($schlid,$testName,$testID,$instr,$noQ,$testDuration,$percentTestOp,$targetClass,$testType,$Qreshuffle,$pubStatus);
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $schlname;?> CBT Admin | Post primary school education center.</title>
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
    <div class="span6 padding">
	<?php include("link-files/schoolheading.php");?>
    </div>
    <div class="span4 offset2 padding"><img class="pull-right" src="img/ministry_of_education.png" alt="ministry of education">
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
    <!-- menubar -->
    <div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="admindashboard.php"><img src="img/icons/icon-school-home.png" align="left" class="school-img-position" /> <?php echo $schldetails['schlName'];?></a>
            <ul class="nav pull-right">
            <li class="active"><a href="admindashboard.php">Dashboard</a></li>
            <li><a href="#" data-target="#pinOrderForm" data-toggle="modal">Order Pin</a></li>
            <li><a href="signout.php">Signout</a></li>
            </ul>
       </div>
</div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2 ">
    <div class="border">
	<?php include("link-files/schoolsidebar.php");?>
    <?php include("link-files/placeadsform.php");?>
    </div>
    <div class="row-fluid">
        <div class="span12">
        <!--google ads-->
        	<img src="img/google_ad.png">
        </div>
     </div>
    </div>
    <div class="span7 border">
    <?php include("link-files/pinorder.php");?>
    <?php include("link-files/createnewclass.php");?>
    <?php include("link-files/placeadsform.php");?>
    <?php include("link-files/adsimgform.php");?>
 <div class="school-details"><h3>Prepare online test</h3></div>
        
<div class="clear"></div>
<div class="row-fluid">
    <div class="span12">
    <div class="instruction-box">
The computer based test for students are prepared here. Below are the list of already prepared cbt, click on any of them to modify their test property.<br>
You can also add new test or remove existing ones.

    </div>
    	<?php 
			include("link-files/addtest.php");#pop up windows
			#Begining of admin test edit
				include("link-files/testproperties.php");
#				include("link-files/testpreview.php");
			#End of admin test edit
			
			include("link-files/available_cbt_page.php");
		?>
    </div>
</div>

<div class="row-fluid base-background">
<?php include("link-files/quick_link.php");?>
</div>
</div>
   <div class="span3 right-sidebar">
   <div class="breadcrumb">
   
   <?php include("link-files/ads.php");?>
   <?php include("link-files/schoolsidesupportline.php");?>
   </div>
  </div>
    <!--other information may be here-->  
  </div>
      <div class="row-fluid baselinks social-background-bottom font">
        <?php include("link-files/page_base.php");?>
      </div>
</div>
</body>
</html>