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
<title><?php echo $schlname;?> - Student Management | Post primary school education center.</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>

<body>
<div class="container-fluid">
  <div class="adminHeading row-fluid">
    <div class="span6">
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
    </div>
    </div>
    <div class="span7 border">
    <div><a href="admindashboard.php">Dashboard</a> >> <a>Student management</a></div>
    <?php include("link-files/pinorder.php");?>
    <form class="form-actions">
    <div>Student Management Form</div>
        <div><#Class> is the current student class that is being managed. They include students admitted in <#class admission year> year.</div>
        
        <div>
        Add student to the class
        <p class="alert">#error</p>
        <hr />
        <input type="text" name="newStudentName" placeholder="Add student name (Surname first)"/><br /> 
        <input type="text" placeholder="Date of birth" /><br />
        
        <select>
        	<option>Select Gender</option>
        	<option>Male</option>
            <option>Female</option>
        </select><br />
        Upload Passport : <br>
        <input type="file"/>
        <button name="addtolist" class="btn">Add to list >></button>
        <hr />
        List of Added student(s) in <subject group name>.
        <div>
        <div><input type="checkbox" class="checkbox" /> Select all</div>
        <div><input type="checkbox" class="checkbox" /> Chima Edeh</div>
        <div><input type="checkbox" class="checkbox" /> Amanda Opara</div>
        </div>
        <button class="btn">Remove from the list</button>
        </div>
        <hr />
        <div><button class="btn btn-block btn-info">Save changes made on student class</button> <button class="btn btn-block btn-danger">Exit</button></div>
        
        <div style="font-family:verdana; font-size:13px; margin:5px 5px 5px 5px;">
        	<a href="#">Print Class list</a><br />
            <a href="#">Set Class Subject</a><br />
            <a href="#">Add Student Result</a><br />
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
  <div class="row-fluid" style="background-color:#000; color:#FFF;">
    <div class="span2"></div>
    <div class="span7">
      <div class="row-fluid">
        <div class="span12">
          <!--other information may be here-->
        </div>
      </div>
    </div>
    <div class="span3"></div>
  </div>
  <div class="row-fluid" style="background-color:#999; color:#FFF;">
    <div class="span2">
      
    </div>
    <div class="span10">
      <div class="row-fluid">
        
      </div>
    </div>
</div>
</div>
<div class="row-fluid baselinks social-background-bottom font">
  <?php include("link-files/page_base.php");?>
</div>
</body>
</html>