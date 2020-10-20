<?php
require_once("../connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}
include("links/header.php"); #cause redirection of request after signout
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>@Admin - Dashboard | Post primary school education center.</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="../ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="../ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
</head>

<body onLoad="loadOrderedPins();">
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
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2 border">
    <?php include("links/left_side_link.php");?>
    </div>
    <div class="span7 border">
    <h2 class="h-line"><span><img src="../img/icons/icon-home.png" align="left" width="30" class="img-position" /></span> Access pin Order List </h2>
    <div class="bodytxt">
</div><form method="post" class="form-actions">
<div class="btn-group">
<button type="button" class="btn" name="removeOrder" id="removeOrder" onClick="removePinOrder();"><span  class="glyphicon glyphicon-remove"></span> Delete</button> <button type="button" class="btn" name="changeOrder" id="changeOrder" onClick="changePinOrder();"><span  class="glyphicon glyphicon-book"></span> Change Order status </button>
</div>
<div id="orderedPins" style="padding:10px; height:500px; overflow:scroll; padding:2px; border:solid #06F thin; margin:5px;">
<?php #loadOrderedPins();?>

</div>
<div class="btn-group">
<button type="button" class="btn" name="removeOrder" id="removeOrder" onClick="removePinOrder();"><span  class="glyphicon glyphicon-remove"></span> Delete</button> <button type="button" class="btn" name="changeOrder" id="changeOrder" onClick="changePinOrder();"><span  class="glyphicon glyphicon-book"></span> Change Order status </button>
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