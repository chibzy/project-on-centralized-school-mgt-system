<?php
require_once("connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
        $_SESSION['encryption-key']=12345;
	$_SESSION['iv']=4321;
}
#$_SESSION['encryption-key']=12345;

$data = ($_GET['id']);
$hash=($_GET['hash']);
#echo "$data <br> $hash";

if (hash_hmac('sha256', $data, $_SESSION['encryption-key'])== $hash) {
  //no tampering detected, proceed with other processing
	#echo "The original text was <br><br>".decrypt($data);
	$decryptedData=decrypt($data);
	activateAccount($decryptedData);
} else {
  //tampering of data detected
	echo "data tampered with.";
	header("location:index.php");
	
}

function activateAccount($data){
global $conn;
	$isActivated=false;
	#get the id,adminid,schlid,andpsw from the encrypted text.
	#echo "$data<br>";
	$all=explode(":",$data);
	$sn=trim($all[0]);
	$adminID=trim($all[1]);
	$schlid=trim($all[2]);
	$psw=trim($all[3]);
	$state=trim($all[4]);
	$location=trim($all[5]);
	$email='';
	
	$schlname='';
	#using the extracted sn locate the record in school_admin table,
	# check if schlid,adminID and password fields are empty, if empty
	$fields=array();
	$flagfields=array('sn');
	$flagvalues=array($sn);
	$ok=mysqli_query($conn,SQLretrieve('school_admin',$fields,$flagfields,$flagvalues));
	#if($ok!=false){
	if(mysqli_affected_rows($conn)>1){
		if($val=mysqli_fetch_array($ok)){
			$email=$val['email'];
			$schlname=$val['schoolName'];
			if($val['schlid']!='' && $val['adminID']!='' && $val['password']!='') $isActivated=true;
		}
	}
	#continue with the activation process, by updating the school_admin table and creating school in the school table 
	if($isActivated!=false){
		#update school admin table n school table
		$sql="update school_admin set schlid='$schlid',adminid='$adminID',password='$psw',activation_status='on' where email='$email'";
		#echo "$sql <br>";
		mysqli_query($conn,$sql);
		$fieldlist=array('schlid','admin','schlName','state','location');
		$valuelist=array($schlid,$adminID,$schlname,$state,$location);
		mysqli_query($conn,SQLinsert($valuelist,$fieldlist,'school','',''));
	}
	
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>School Account activation | Post primary school education center.</title>
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
  <div class="heading row-fluid">
    <div class="span6 padding"><img src="img/logo.png" width="150" alt="logo">
      <div class="row-fluid">
        <div class="span12">
        <?php include("link-files/regform.php");?>
</div>
      </div>
    </div>
    <div class="span4 offset2 padding"><img class="pull-right" src="img/ministry_of_education.png" width="400" alt="ministry of education">
      <div class="row-fluid">
        <div class="span12">
          <?php include("link-files/search_form.php");?>
        </div>
      </div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
 
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2">
    
</div>
    <div class="span7 border">
    <h2 class="h-line"><span><img src="img/icons/icon-support.png" width="30"></span> School account activation. </h2>
    <div align="center">
	<h4>You have successfully activated your account on ppseducation.com.ng</h4><br>
    <a href="index.php">Login</a> to your account to start use the service
    </div>
    </div>
  </div>
  <div class="row-fluid base-background">
    	<div class="span3 offset1">
          <?php include("link-files/quick_base_link.php");?>
        </div>
        <div class="span3">
          <?php include("link-files/service_base_link.php");?>
        </div>
    	<div class="span3">
         <?php include("link-files/contactinfo.php");?>
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
<?php
}