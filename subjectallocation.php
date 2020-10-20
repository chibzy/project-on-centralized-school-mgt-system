<?php
require_once("connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}

include("link-files/header.php"); #cause redirection of request after signout

$schlid=$_SESSION['schlid'];
$schldetails=array();
$schldetails=getSchoolDetails($schlid);

$schlname=$schldetails['schlName'];
$schlstate=$schldetails['State'];
$schllocation=$schldetails['location'];

if(isset($_POST['btnExit'])){
  	header("location:admindashboard.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $schlname;?> - Subject Allocation | Post primary school education center.</title>
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
      <?php #include("link-files/menubar_link.php");?>
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
    <div class="span2">
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
    <div><a href="admindashboard.php">Dashboard</a> >> <a>Subject Allocation</a></div>
    <?php include("link-files/pinorder.php");?>
    <?php include("link-files/subjectgroupmanagement.php");?>

    <form method="post">
        <div class="bodytitle"></div>
        <div class="school-details"><h3>Subject Allocation Settings.</h3></div>    
<div class="clear"></div>
<div class="instruction-box">
Assign subjects to classes to enable automatic loading of subjects during result computation
</div>
        
       <?php 
	   	if(isset($_POST['btnSave'])){
		   saveChanges($schlid);
		}
	   retrieveAllocationTable($schlid);
	   ?>
       <hr />
       <button class="btn btn-block btn-info" name="btnSave">Save Changes</button>
       <button class="btn btn-block btn-danger" name="btnExit">Exit</button>
    </form>
    <div style="text-align:center; font-size:16px;">
    	<p> Are you new to the system? <span  class="btn btn-info btn-small" data-target="#manageSubjectGroup" data-toggle="modal">Click to create new subject group</span> </p>
    </div>
    <div class="row-fluid base-background">
<?php include("link-files/quick_link.php");?>
</div>

    </div>
    <div class="span3 right-sidebar">
   <?php include("link-files/ads.php");?>
    <?php include("link-files/schoolsidesupportline.php");?>
    </div>
  </div>
  
</div>
<div class="row-fluid baselinks social-background-bottom font">
<?php include("link-files/page_base.php");?>
</div>
</body>
</html>