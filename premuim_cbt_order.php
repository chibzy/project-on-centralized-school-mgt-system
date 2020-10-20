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

#for add new test popup.
if(isset($_POST['btncontinue'])){
	header("location:cbtadmin.php");
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
        
<hr>

<div class="row-fluid">
    <div class="span12">
    	<?php 
			
			include("link-files/premuim_cbt_order_form.php")
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
</body>
</html>