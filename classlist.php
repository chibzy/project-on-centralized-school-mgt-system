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
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $schlname;?> - Class List | Post primary school education center.</title>
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
    </div>
    <div class="span7 border">
    <div><a href="admindashboard.php">Dashboard</a> >> <a>Class List</a></div>
    <?php include("link-files/pinorder.php");?>
    <div class="school-details"><h3>List of classes in <?php echo $schlname;?></h3></div>
    <div class="clear"></div>    
    <div class="instruction-box">Available class(es) in the school
the class list show the current list of classes available in the school within the past seven years. <br>Click to access them.</div>
    <div class="classListImg">
    <p></p>
    <img src="img/logo.png">
    </div>


    <div style="background-color:#CCC; color:#fff; padding:5px; border:#CCC thin solid; margin:2px;">
    <?php include("link-files/classes.php");?>
    </div>

<?php include("link-files/addandremovestudent.php");?>
<?php include("link-files/subjectgroupmanagement.php");?>
<?php include("link-files/createnewclass.php");?>
<hr>
<div class="row-fluid">
<div class="span6 padding border introIcon">
<img src="img/icons/icon-create-class2.png"><div class="iconIntro">
For unregistered freshers and classes in your school, click to have them add to a new class.</div>
<div class="btn btn-small btn-info" data-target="#createNewClass" data-toggle="modal">Create New Class
</div>

</div>
<div class="span6 padding border introIcon">
<img src="img/icons/icon-subject-mgt.png"> <div class="iconIntro">Everything about the subjects offered in your school and the class of students that undertake them is here.</div>
<div class="btn btn-info btn-small" data-toggle='modal' data-target='#manageSubjectGroup'>Manage subject group</div>
</div>
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