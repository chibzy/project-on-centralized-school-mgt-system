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
<title><?php echo $schlname;?> - Results | Post primary school education center.</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="ScriptLibrary/mine.js"></script>
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
    <div class="row-fluid">
        <div class="span12">
        <!--google ads-->
        	<img src="img/google_ad.png">
        </div>
     </div>
    </div>
    <div class="span7 border">
    <div><a href="admindashboard.php">Dashboard</a> >> <a>results</a></div>
    <div class="school-details"><h3>Student Result Computing Form.</h3></div>
    <div class="clear"></div>
    <form>
        <div class="instruction-box">
The student grades and scores are computed here. <br>To enter students score, select the student class id, current class and click on the "continue" button, to populate the subject of the class, click on any of the subject to have its score registered.<br>
Save the changes and repeat the same for all other subjects.

        </div>
        <div class="form-horizontal">
        
        <select name="classid" class="input-medium" id="classid">
   	    <option>-Select class id-</option>
            <?php
				$fields=array('classid','subclass');
				$flagfields=array('schlid');
				$flagvalues=array($schlid);
				
            	$k=mysqli_query($conn,SQLretrieve('class',$fields,$flagfields,$flagvalues));
				#$i=1;
				if($k!=false){
					while($j=mysqli_fetch_array($k)){
						$lowerLimit=date('Y')-6;
						$class=$j['classid'];
						$subclass=$j['subclass'];
						if($class>$lowerLimit){
							?>
                            <option value="<?php echo "$class | $subclass";?>"><?php echo "$class - $subclass";?></option>
                            <?php
						}
					}
				}
			?>
        </select>
        <?php 
		function loadClassNGroups($schlid){
global $conn;			
if($schlid!=''){
				$fields=array();
				$flagfields=array('schlid');
				$flagvalues=array($schlid);
				
				$k=mysqli_query($conn,SQLretrieve('subject_group_allocation',$fields,$flagfields,$flagvalues));
				if(mysqli_affected_rows($conn)>0){
					while($val=mysqli_fetch_array($k)){
						?>
						<option value="<?php echo "{$val['term']} term {$val['session']} | {$val['subject_group_id']}";?>"><?php echo "{$val['term']} term {$val['session']}";?></option>
						<?php
					}
				}else{
					echo "<option>Please allocate subject groups to classes</option>";
				}
			}
		}
		?>
        <select name="curclass" class="input-medium" id="curclass">
        	<option>-Select current class-</option>
            <?php 
				loadClassNGroups($schlid);
			?>
           </select>
        
        <button type="button" class="btn btn-info" name="resultContinue" onClick="subjectList();">Continue</button>
        </div>
        <hr />
        <div class="row-fluid">
        <div class="span3">
        <span style="font-weight:600;">CLASS SUBJECT</span><br />
        <div id="sub">
        
        </div>
        </div>
        <div class="span9" id="sheet">
        <div class="sheetContent"><p></p><img class="img" src="img/logo.png"></div>
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
<div class="row-fluid baselinks social-background-bottom font">
  <?php include("link-files/page_base.php");?>
</div>
</div>
</body>
</html>