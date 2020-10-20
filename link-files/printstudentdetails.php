<?php 
require_once("../connect/indexscripts.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "Student Name and details";?></title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="../ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="../ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
</head>

<body>
<?php
$id=mysqli_escape_string($conn,$_REQUEST['id']);
$fields=array();
$flagfields=array("studID");
$flagvalues=array($id);

$ok=mysqli_query($conn,SQLretrieve('student',$fields,$flagfields,$flagvalues));
if($ok!=false){
	if($val=mysqli_fetch_array($ok)){
		$name=$val['name'];
		$dob=$val['dob'];
		$gender=$val['gender'];
		$address=$val['address'];
		$passport=$val['passport'];
		$parentName=$val['parentName'];
		$parentAddress=$val['parentAddress'];
		$parentPhone=$val['parentPhone'];
		$classid=$val['class_id'];
		$schlid=$val['schlid'];
		$subclass=$val['subClass'];
		?>
        <div class="container-fluid">
        <div class="row-fluid">
        	<div class="span12 padding border"><?php $school=getSchoolDetails($schlid);
			echo "<h2>{$school['schlName']}</h2><h4>{$school['address']}</h4>";
			?></div>
        </div>
        <div class="row-fluid">
        	<div class="span4">
            <div><img src="../<?php echo $passport;?>" width="200px" /></div>
            <div style="font-weight:600;"><?php echo $name;?></div>
            </div>
            <div class="span8">
            <div>STUDENT ID : <?php echo $id;?></div>
            <div>GENDER : <?php echo $gender;?></div>
            <div>DATE OF BIRTH : <?php echo $dob;?></div>
            <div>CLASS : <?php echo $subclass;?> of <?php echo $classid;?></div>
            <div><span style="float:left;">ADDRESS : </span><span><?php echo $address;?></span></div>
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span12"><div>PARENTS DETAILS.</div></div>
        </div>
        <div class="row-fluid">
        	<div class="span12">
            <div>PARENT NAME : <?php echo $parentName;?></div>
            <div>PARENT PHONE : <?php echo $parentPhone;?></div>
            <div>PARENT ADDRESS : <?php echo $parentAddress;?></div>
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span12 base-background baselinks"><?php include("page_base.php");?></div>
        </div>
        </div>
        <?php
	}
}
?>
<script>
print();
window.close();
</script>
</body>
</html>