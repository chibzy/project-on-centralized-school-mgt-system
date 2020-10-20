<?php
require_once("../connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['adminName'])){
	header("location:index.php");
}
?>
<!DOCTYPE HTML>
<html>
<title>@Admin - Access pins | Post primary school education center</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="../ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="../ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Welcome to post-primary school education center.</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/ppseducation.css" />
</head>

<body onLoad="loadPinSet();">
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
	<?php include("../link-files/menubar_link.php");?>
	<?php include("links/accesspinlist.php");?>    
    <?php include("links/generatepinform.php");?>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2">
    <div class="border">
    <?php include("links/left_side_link.php");?>
    </div>
    </div>
    <div class="span7 border">

    
    <div class="h-line"><img src=""><h2>Access pin batch list</h2></div>
	<form class="form-actions" method="post">
<div class="btn-group">
<button type="button" class="btn" data-target="#generatePinForm" data-toggle="modal"> Generate access pin </button> <button class="btn" type="button" name="removePin" id="removePin" onClick="removePinSet();"> Delete </button> <button class="btn" type="button" name="activatePin" id="activatePin" onClick="changePinSetStatus();"> Activate / Deactivate </button>
</div>
<div id="pinSet" style="padding:10px; height:500px; overflow:scroll;">
<?php
#loadPinSet();
?>
</div>
<div class="btn-group">
<button type="button" class="btn" data-target="#generatePinForm" data-toggle="modal"> Generate access pin </button> <button class="btn" type="button" name="removePin" id="removePin" onClick="removePinSet();"> Delete </button> <button class="btn" type="button" name="activatePin" id="activatePin" onClick="changePinSetStatus();"> Activate / Deactivate </button>
</div>
</form>
    
    </div>
    <div class="span3 border">
   <?php #include("../link-files/ads.php");?>
    
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