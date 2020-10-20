<?php
require_once("../connect/indexScripts.php");
if(!isset($_SESSION)){
	session_start();
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Welcome to post-primary school education center.</title>
<style type="text/css" media="screen">
    .selected { background-color: #888; }
</style>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="../ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="../ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
</head>
<body style="font-size:12px;">
<div class="container-fluid">
<div class="row-fluid">
<div class="span4"></div><div class="span4">
<form class="form-actions" method="post">
<div class="container-fluid">
      <div class="row-fluid">
      <div class="span12">
      <?php
	  if(isset($_POST['btnLogin'])){
      	echo adminLogin($_POST['adminID'],$_POST['psw']);
	  }
	  ?>
      <input type="hidden" name="schlid" id="schlid" value="">   	
      		<div class="form-group">
            	<label for="adminID">ADMIN ID</label>
                <input type="text" name="adminID" id="adminID" placeholder="Enter your id" />
         	</div>
            <div class="form-group">
            	<label for="psw">Password</label>
                <input type="password" name="psw" id="psw" placeholder="Enter your password" />
         	</div>
            
            <button class="btn btn-info" type="submit" name="btnLogin"><span class="icon-lock"></span> Login</button>
         
         
         </div>
         </div>
         </div>
 </form>
</div><div class="span4"></div>
</div>
</div>
</body>
</html>