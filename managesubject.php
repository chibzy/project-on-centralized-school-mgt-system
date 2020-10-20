<?php
require_once("connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}

include("link-files/header.php"); #cause redirection of request after signout

$schlid=$_SESSION['schlid'];
$schldetails=array();
$schldetails=getSchoolDetails($schlid);
if(isset($_POST['btnExit'])){
	header("location:classlist.php");
}
$schlname=$schldetails['schlName'];
$schlstate=$schldetails['State'];
$schllocation=$schldetails['location'];

$id="";
$name="";

if(isset($_REQUEST['id'])) $id=mysqli_escape_string($conn,$_REQUEST['id']);
if(isset($_REQUEST['name'])) $name=mysqli_escape_string($conn,$_REQUEST['name']);
			
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $schlname;?> - Subject Management | Post primary school education center.</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>

<body onLoad="loadavailablesubjects('<?php echo $id;?>');">
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
    <div><a href="admindashboard.php">Dashboard</a> >> <a>Subject management</a></div>
    <?php include("link-files/pinorder.php");?>
    <form  method="post" style="font-size:14px;">
        <div class="school-details"><h3>Subject management form for group <?php echo $id;?> </h3></div>    
		<div class="clear"></div>
        <div class="instruction-box">Here the component subjects of this subject group is modified. <br>You can add subject to the group, remove subject to the group, or even create a custom subject which can be added to the group.</div>
        <!--div>The subject group id of <?php echo $name;?> is <?php echo $id;?>.</div-->
        
        <div>
        <div class="container-fluid">
        <div class="span5">
        	<b>ADD SUBJECT TO THE GROUP</b>
        <!--div-->
        <div class="form-inline">
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <label class="checkbox" for="pract"> 
        	<input class="input" type="checkbox" name="pract" id="pract"> Practical Oriented
        </label>
        <label class="checkbox" for="sele">
        	<input type="checkbox" name="sele" id="sele"> Selective 
        </label><br>
        <select id="subjects" name="subjects" onChange="resetOthers();" class="input-medium">
        	<option value="English">English</option>
            <option value="Mathematics">Mathematics</option>
            <option value="Economics">Economics</option>
            <option value="Lit. in English">Lit. in English</option>
            <option value="Agric Science">Agric Science</option>
            <option value="Biology">Biology</option>
            <option value="Physics">Physics</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Geography">Geography</option>
            <option value="Commerce">Commerce</option>
            <option value="Government">Government</option>
            <option value="Accounts">Accounts</option>
            <option value="Fine Art">Fine Art</option>
        </select>
        <button type="button" class="btn btn-small" onClick="addSubjectToList('subjects','');" name="addtolist">Add to list</button>
        </div>
        </div>
        <div class="span7">
        	<b>ADD NEW SUBJECT</b>
        <div class="form-inline">
         <label class="checkbox" for="pract1"><input type="checkbox" name="pract1" id="pract1">Practical Oriented </label>
        <label class="checkbox" for="sele1"><input type="checkbox" name="sele1" id="sele1"> Selective </label>
        <br>
        <input type="text" placeholder="Add new subject" id="newSubjectName" name="newSubjectName" />
        <button class="btn btn-small" onClick="addSubjectToList('newSubjectName','1');" id="addtolist" type="button" name="addtolist">Add to list</button>
        </div>
        </div>
        <!--/div-->
        
        
        
        
        
        <!--/div-->
        
        <div class="span12">
        	
        <b>List of Added subject(s) in <subject group name>.</b>
        <div id="subjectlist" style="height:200px; overflow:auto;" class="border">
        
        </div>
        <button class="btn" id="removeSubject" onClick="removesubjectOk();" type="button">Remove from the list</button>
        </div>
        <!--hr /-->
        <div><!--button class="btn btn-block btn-info">Save changes to subject group</button-->
        <br><br>
        <button type="submit" name="btnExit" id='btnExit' class="btn btn-block btn-info">Exit</button></div> 
            
        </div>
        
        
        </div>
        
        
    </form>
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