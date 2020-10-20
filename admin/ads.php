<?php
require_once("../connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}

include("links/header.php"); #cause redirection of request after signout

$start=0;
$limit=3;

if(isset($_GET['pg']) && is_numeric($_GET['pg'])) {
	$pg=mysqli_escape_string($conn,$_GET['pg']);
	$start=($pg-1)*$limit;
}else{
	$pg=1;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>@Admin - adverts settings | Post primary school education center</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="../ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="../ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
</head>

<body onLoad="#loadOrderedPins();">
<div class="container-fluid">
  <div class="adminHeading row-fluid">
    <div class="span6 padding">
	<?php include("links/schoolHeading.php");?>
    </div>
    <div class="span4 offset2 padding"><img class="pull-right" src="../img/ministry_of_education.png" width="394" height="103" alt="ministry of education">
      <div class="row-fluid">
        <div class="span12">
          <?php include("../link-files/search_form.php");?>
        </div>
      </div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <?php #include("../link-files/menubar_link.php");?>
    <div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand">Admin@ Post primary school education center </a><marquee vspace="10" width="600" behavior="scroll" direction="left"><?php echo determineRegisteredSchool();?> <?php echo determineUnpublishedSchool('on');?> <?php echo determineUnpublishedSchool('');?></marquee>
            <ul class="nav pull-right">
            <li><a href="signout.php">Sign out</a></li>
            </ul>
       </div>
</div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2"><div class="border">
    <?php include("links/left_side_link.php");?>
    <?php include("links/editAds.php");?>
    <?php include("links/adminAdsImgform.php");?>
    </div></div>
    <div class="span7 border">
    
    <div class="h-line"><img src=""><h2>Advert List</h2></div>
        <div class="bodytxt">
</div><form method="post" class="form-actions" name="adslistform" id="adslistform">
<div class="btn-group">
<a class="btn" data-target="#editAds" data-toggle="modal">Add new advert</a>
<button type="button" class="btn" name="removeOrder" id="removeOrder" onClick="AdminRemoveAdsOrder('<?php echo $pg;?>');"><span  class="icon-filter"></span>Remove advert</button> <button type="button" class="btn" name="changeOrder" id="changeOrder" onClick="adminChangeAdsPubStatus(<?php echo $pg;?>);"><span  class="icon-adjust"></span> Publish / unpublish Advert </button>
</div>
<div style="margin:5px 0px 5px 0px;">
<?php 

	listAdvertPages($pg,$start,$limit);#show first pagination
	?><div id="orderedAds"><?php
	getAdverts($pg,$start,$limit);#items
	?></div><?php
	listAdvertPages($pg,$start,$limit);#show last pagination

?>
</div>
<div class="btn-group">
<a class="btn" data-target="#editAds" data-toggle="modal">Add new advert</a>
<button type="button" class="btn" name="removeOrder" id="removeOrder" onClick="AdminRemoveAdsOrder('<?php echo $pg;?>');"><span  class="icon-filter"></span>Remove advert</button> <button type="button" class="btn" name="changeOrder" id="changeOrder" onClick="adminChangeAdsPubStatus(<?php echo $pg;?>);"><span  class="icon-adjust"></span> Publish / unpublish Advert </button>
</div>
</form>
    </div>
    <div class="span3 border">
   <?php #include("../link-files/ads.php");?>
    <?php #include("../link-files/schoolsidesupportline.php");?>
    </div>
  </div>
  
  <div class="row-fluid baselinks social-background-bottom font">
        <div class="span10">
          <p></p>
          <p align="center">&copy; <?php echo date('Y');?>, Signal technologies | All rights reserved.</p>
        </div>
        <div class="span2">
          <p>Powered by<br>
        Signal Technologies.</p>
        </div>
  </div>
</div>
</body>
</html>