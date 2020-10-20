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

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $schlname;?> dashboard | Post primary school education center.</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>

<body onLoad="loadAllHistory()">
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
    <?php include("link-files/subjectgroupmanagement.php");?>
 <div class="school-details"><h3>Things you can do,</h3></div>
        
<hr>
<div class="row-fluid">
<div class="span3 margin offset1">
	<div class="img-polaroid">
    <a href="classlist.php">
    <img src="img/icons/icon-class-list.png" class="padding">
    </a>
    <div class="cap"><a href="classlist.php">View Class List</a></div>
    </div>
</div>
<div class="span3 margin">
	<div class="img-polaroid">
    <a href="accountsettings.php">
    <img src="img/icons/icon-psw-settings.png" class="padding">
    </a>
    <div class="cap"><a href="accountsettings.php">Changes Account Settings</a></div>
    </div>
</div>
<div class="span3 margin">
	<div class="img-polaroid">
    <a class="hand" data-target="#createNewClass" data-toggle="modal">
    <img src="img/icons/icon-create-class.png" class="padding">
    </a>
    <div class="cap"><a class="hand" data-target="#createNewClass" data-toggle="modal">Create class</a></div>
    </div>
</div>
</div>

<div class="row-fluid">
<div class="span3 margin offset1">
	<div class="img-polaroid">
    <a href="results.php">
    <img src="img/icons/icon-add-result.png" class="padding">
    </a>
    <div class="cap"><a href="results.php">Add studentI(s) result</a></div>
    </div>
</div>
<div class="span3 margin">
	<div class="img-polaroid">
    <a href="accountsettings.php#pubschlInfo">
    <img src="img/icons/icon-publish.png" class="padding">
    </a>
    <div class="cap"><a href="accountsettings.php#pubschlInfo">Publish school Info.</a></div>
    </div>
</div>
<div class="span3 margin">
	<div class="img-polaroid">
    <a href="subjectallocation.php">
    <img src="img/icons/icon-edit.png" class="padding">
    </a>
    <div class="cap"><a href="subjectallocation.php">Allocate Subject Group(s)</a></div>
    </div>
</div>
</div>
<div class="row-fluid">
<div class="span3 margin offset1">
	<div class="img-polaroid">
    <a href="cbtadmin.php">
    <img src="img/icons/icon-cbt.png" class="padding">
    </a>
    <div class="cap"><a href="cbtadmin.php">Conduct CBT</a></div>
    </div>
</div>
<div class="span3 margin">
	<div class="img-polaroid">
    <a href="" data-toggle='modal' data-target='#manageSubjectGroup'>
    <img src="img/icons/icon-subject-mgt.png" class="padding">
    </a>
    <div class="cap"><a href="" data-toggle='modal' data-target='#manageSubjectGroup'>Manage subject group</a></div>
    </div>
</div>
<div class="span3 margin">
	<div class="img-polaroid">
    <a href="index.php?id=<?php echo $schlid;?>" target="_new">
    <img src="img/icons/icon-preview.png" class="padding">
    </a>
    <div class="cap"><a href="index.php?id=<?php echo $schlid;?>" target="_new">Preview school page</a></div>
    </div>
</div>

</div>
<div class="row-fluid base-background">
<?php include("link-files/quick_link.php");?>
</div>
</div>
   <div class="span3 right-sidebar">
   <div class="breadcrumb">
   <!--a class="btn btn-large btn-info" href="#">View pin order history.</a-->
   <div class="lead"> History </div>
   <div class="instruction-box">
   Below is the breakdown of the access pin purchase,advert order, and premium cbt order carried out in this account. Click on the tabs to view them.
   </div>
   <ul class="nav nav-tabs font2">
        	<li class="active disabled"><a data-toggle="tab" href="#order"><span class="icon-home"></span>Pin</a></li>
            <li class="disabled"><a data-toggle="tab" href="#ads"><span class="icon-bookmark"></span>Advert</a></li>
            <li class="disabled"><a data-toggle="tab" href="#cbt"><span class="icon-play"></span>CBT</a></li>
        </ul>
        <div class="tab-content">
    <div id="order" class="tab-pane fade in active Hbg">
      <div style="background-color:#CCC; text-align:justify; padding:10px;"><strong>ORDERED PIN HISTORY.</strong></div>
      <p id="orderlist" style="height:350px;">
      <?php #include("link-files/pinhistory.php");?>
      </p>
    </div>
   <div id="ads" class="tab-pane fade Hbg">
      <div style="background-color:#CCC; text-align:justify; padding:10px;"><strong>ORDERED ADVERTS HISTORY.</strong></div>
      <p id="adslist" style="height:350px;">
      <?php #include("link-files/adshistory.php");?>
      </p>
    </div>
    <div id="cbt" class="tab-pane fade Hbg">
      <p id="cbtlist" style="height:350px;">
      <?php #include("link-files/cbthistory.php");?>
      </p>
    </div>
   </div>
   <div style="height:30px;"></div>
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