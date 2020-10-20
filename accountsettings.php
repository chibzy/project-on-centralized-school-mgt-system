<?php
require_once("connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}

include("link-files/header.php"); #cause redirection of request after signout

$email='';
$schlid=$_SESSION['schlid'];
$msg='';
if(isset($_POST['saveAdmin'])){
	
	$name=mysqli_escape_string($conn,$_POST['adminname']);
	$gender=mysqli_escape_string($conn,$_POST['gender']);
	$phone=mysqli_escape_string($conn,$_POST['phoneno']);
	
	saveAdminDetails($_SESSION['schlid'],$name,$gender,$phone);
}
if(isset($_POST['btnSaveChanges'])){
	$schlstate=$_POST['state'];
	$schllocation=@$_POST['location'];
	$logo=$_FILES['schllogo'];
	
	$schlname=mysqli_escape_string($conn,$_POST['schoolname']);
	$schlDescription=mysqli_escape_string($conn,$_POST['schoolDescription']);
	$schladdress=mysqli_escape_string($conn,$_POST['schoolAddress']);
	
	$midtermBreak=mysqli_escape_string($conn,$_POST['midtermBreak']);
	$InterhouseSports=mysqli_escape_string($conn,$_POST['interhouseSports']);
	$midtermTest=mysqli_escape_string($conn,$_POST['midtermTest']);
	
	$schlProg="$midtermBreak:$InterhouseSports:$midtermTest";
	if(isset($_POST['govtApproved']))$govtApproved='on';

	$gradingProfile=mysqli_escape_string($conn,$_POST['gradingProfile']);
	$promoPolicy=mysqli_escape_string($conn,$_POST['promoPolicy']);
	if(isset($_POST['publishedStatus'])){
		$publishedstatus='on';
	}else{
		$publishedstatus='';
	}
	
	$socialEmail=mysqli_escape_string($conn,$_POST['email']);
	$socialFacebook=mysqli_escape_string($conn,$_POST['facebook']);
	$socialTweeter=mysqli_escape_string($conn,$_POST['tweeter']);
	$socialGoogle=mysqli_escape_string($conn,$_POST['google']);
	$socialWhatsup=mysqli_escape_string($conn,$_POST['whatsup']);
	$socialWebsite=mysqli_escape_string($conn,$_POST['website']);
	
	$sEmail="$socialEmail:$socialFacebook:$socialTweeter:$socialGoogle:$socialWhatsup:$socialWebsite";
	#Upload script should be here;
	
	$imgPath=uploadLogo($logo,$schlid);
	
	saveSchoolDetails($_SESSION['schlid'],$schlname,$schlDescription,$schladdress,$schlProg,$govtApproved,$gradingProfile,$promoPolicy,$publishedstatus,$sEmail,$schlstate,$schllocation,$imgPath);
}
if(isset($_POST['btnExit'])){
	header("location:admindashboard.php");
}
$schldetails=array();
$schldetails=getSchoolDetails($schlid);

$curState=$schldetails[5];
$curLocation=$schldetails[4];
$schlLogo=$schldetails[15];

$schlname=$schldetails['schlName'];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $schlname;?> - Account settings | Post primary school education center.</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="ScriptLibrary/scriptaculous.js"></script>

<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>

<body onLoad="loadlocation();">
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
    <div><a href="admindashboard.php">Dashboard</a> >> <a>Account settings</a></div>
    <?php include("link-files/pinorder.php");?>
     
    <form enctype="multipart/form-data" method="post" style="font-size:14px; line-height:20px;">
    <div class="container-fluid">
    <div class="row-fluid"><div class="spa12">
    <div class="school-details"><h3>Adjust Account settings</h3></div>    
	<div class="clear"></div>

    <div class="instruction-box">
The content of this page enables you to determine the state and function of the account. change them to suit your account needed.
</div>    
        <div><?php echo "{$_SESSION['adminName']}";?> you are currently logged on as the account administrator of <?php echo "{$schldetails['schlName']}";?>. <?php echo $schlid;?> is the school id of <?php echo "{$schldetails['schlName']}";?> in ppseducation.com. <br>In the system account settings, you can change the information regarding the account.</div></div>
     </div> 
     <div class="row-fluid"><div class="span12">
       <div class="form-horizontal"><a id="pswSettings" name="pswSettings"></a>
       	<br>
        Change Account password
        <!--p--><div id="pswResetAlert"><b>Expects a reset action notification here.</b></div><!--/p-->
        Enter your email address : <input type="text" name="emailaddr" id="emailaddr">
        <button type="button" name="addtolist" id="addtolist" onClick="resetpsw('emailaddr');" class="btn">Reset password</button>
        </div></div>
        </div>
        <hr />
        <div class="row-fluid">
        <div class="span12">
        <a id="adminInfo" name="adminInfo"></a>
        Admin Details Update.<br>
        <input type="text" name="adminname" value="<?php echo $_SESSION['adminName']?>" class="input-medium pull-left" placeholder="Administrators Name" />
        <span>
        <input type="text" name="phoneno" class="input-medium" value="<?php echo $_SESSION['phone'];?>" placeholder="Phone Number" />
        <select class="input-small" name="gender">
        <?php
        	$gender=array('Male','Female');
			
			for($i=0;$i<count($gender);$i++){
				if($gender[$i]==$_SESSION['gender']){
					?>
                    	<option value="<?php echo $gender[$i];?>" selected><?php echo $gender[$i];?></option>
                    <?php
				}else{
					?>
						<option value="<?php echo $gender[$i];?>"><?php echo $gender[$i];?></option>
					<?php
				}
			}
		?>
        </select>
        </span><span>
        <input type="submit" name="saveAdmin" class="btn pull-right" value="Save admin changes" />
        </span>
        </div></div>
        <hr />
        <div class="row-fluid"><div class="span12">
        <a id="schlInfo" name="schlInfo"></a>
        <div><h5>School Details Update</h5></div>
        Enter School Name : <input type="text" name="schoolname" value="<?php echo $schldetails['schlName'];?>" placeholder="School Name" /><br />
        Enter School Description : <br>
        <textarea rows="16" cols="8" class="input-block-level" name="schoolDescription" placeholder="Enter school description"><?php echo $schldetails['description'];?></textarea><br />
        Enter School Address : <input type="text" name="schoolAddress" value="<?php echo $schldetails['address'];?>" class="input-block-level" placeholder="School Address" /><br />
        <hr>
        <div class="row-fluid">
        <div class="span6">
        <h5>School termly programs:</h5><br />
        <?php
		$midterm='';
		$InterhouseSports='';
		$midtermTest='';
			
		if($schldetails['schlProg']!=''){
			$schlProg=explode(':',$schldetails['schlProg']);
			$midterm=$schlProg[0];
			$InterhouseSports=$schlProg[1];
			$midtermTest=$schlProg[2];
		}
		?>
        <table>
        <tr>
        	<td width="150px">Midterm Break period :</td><td><input class="input-small" type="text" name="midtermBreak" value="<?php echo $midterm;?>" placeholder="Enter Midterm break date (dd/mm/yy)" /></td>
        </tr>
        <tr>
        	<td>Interhouse Sports period :</td><td><input class="input-small" type="text" name="interhouseSports" value="<?php echo $InterhouseSports;?>" placeholder="Inter House sports date (dd/mm/yy)" /></td>
        </tr>
        <tr>
        	<td>Midterm Test period :</td><td><input class="input-small" type="text" name="midtermTest" value="<?php echo $midtermTest;?>" placeholder="Midterm Test date (dd/mm/yy)" /></td>
        </tr>
        </table>
        </div>
        <div class="span6">
        <h5>School location : </h5><br>
        <table>
        <tr>
        	<td width="80px">State : </td><td>
            <select class="input-small" id="state" name="state" onChange="loadlocation();">
        			<?php
                    	loadState($curState);
					?>
            </select>
            </td>
        </tr>
        <tr>
        	<td>Location : </td><td>
            <select class="input-small" id="location" name='location'>
        			
            </select>
            </td>
        </tr>
        </table>
        <span style="font-size:13px;">
        <img  style="margin-right:10px;" src="<?php echo $schlLogo;?>" alt="school logo preview" align="left" width="60px">
        <span>
        <b>Upload School Logo </b><br>(picture format <span style="color:#F00;">'.png'</span> with tranparent background and not more than <span style="color:#F00;">20kb</span> file size.)<br>
        <input type="file" name="schllogo" class="input-small"></span>
        </span>
        </div>
        </div>
        </div></div>
  		<hr>
        <div class="row-fluid">
        <div class="span6">
        <label class="control-group">
        	<span class="checkbox form-inline"><label for="govtApproved"><input type="checkbox" name="govtApproved" <?php if($schldetails['govt_approved_status']!='') echo "checked";?> /> Government approved</label></span>
        </label>
        
        School Test Grading system :<select class="input-large" name="gradingProfile"> 
        	<option>Select Grading Profile</option>
        <?php    
		$all=array('waecGrading','schoolGrading');
          	for($i=0;$i<2;$i++){
				if($schldetails['grading_profile']==$all[$i]){?>
				<option value="<?php echo $all[$i];?>" selected><?php echo $all[$i];?></option>
                <?php
                }else{
				?>
				<option value="<?php echo $all[$i];?>"><?php echo $all[$i];?></option>	
				<?php	
				}
			}
		?>
        </select>
        <br>
        School Promotion Policy :<select class="input-large" name="promoPolicy"> 
        	<option>Select Promotion Policy</option>
        </select>
        <br>
       <b>Link your page to your school website,</b><br><span style="font-size:10px;">Copy and embed this script on your school website to start direct access to your ppseducation.com.ng page through your website.</span><br>
        <pre><?php echo "&lt;a href=\"www.ppseducation.com.ng?id=$schlid\"&gt;&lt;img src=\"ppseducation.com.ng/img/icons/icon-school-home.png\"&gt;&lt;/a&gt;";?>
        </pre>
        <br>
        <a id="pubschlInfo" name="pubschlInfo"></a>
        <span class="checkbox form-inline"><label for="publishedStatus"><input type="checkbox" name="publishedStatus" <?php if($schldetails['published']!='') echo "checked";?> /> Publish School details</label></span>
        
        </div><div class="span6">
        <?php 
			$schlEmail='';
			$schlFacebook="";
			$schlTweeter="";
			$schlGoogle="";
			$schlWhatsup="";
			$schlWebsite="";
			
			if($schldetails['email']!=''){
				$socials=explode(':',$schldetails['email']);
				for($i=0;$i<count($socials);$i++){
					if($i==0) $schlEmail=$socials[$i];
					if($i==1) $schlFacebook=$socials[$i];
					if($i==2) $schlTweeter=$socials[$i];
					if($i==3) $schlGoogle=$socials[$i];
					if($i==4) $schlWhatsup=$socials[$i];
					if($i==5) $schlWebsite=$socials[$i];
				}
			}
		?>
        
        <h5>School Social links:</h5>
        <table>
        	<tr>
            	<td>Email : </td><td><input type="text" value="<?php echo $schlEmail;?>" name="email" placeholder="Enter Email address" /></td>
            </tr>
           <tr>
            	<td>FaceBook : </td><td><input type="text" value="<?php echo $schlFacebook;?>" name="facebook" placeholder="Enter Facebook address" /></td>
            </tr>
            <tr>
            	<td>Twitter : </td><td><input type="text" value="<?php echo $schlTweeter;?>" name="tweeter" placeholder="Enter Tweeter address"/></td>
            </tr> 
            <tr>
            	<td>Google : </td><td><input type="text" value="<?php echo $schlGoogle;?>" name="google" placeholder="Google" /></td>
            </tr>
            <tr>
            	<td>Whatsup : </td><td><input type="text" value="<?php echo $schlWhatsup;?>" name="whatsup" placeholder="Whatsup" /></td>
            </tr>
            <tr>
            	<td>Website : </td><td><input type="text" value="<?php echo $schlWebsite;?>" name="website" placeholder="Website" /></td>
            </tr>
        </table>
        </div>
        
        </div>
        <div class="row-fluid">
        <div class="span12">
        	<hr>
            <input type="submit" class="btn btn-info btn-block" value="Save changes" name="btnSaveChanges" /> <button name="btnExit" class="btn btn-danger btn-block" type="submit">Exit</button>
        </div>
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