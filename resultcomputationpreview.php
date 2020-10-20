<?php
require_once("connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}

$schlid=$_SESSION['schlid'];
if(isset($_REQUEST['subject']))$subject=mysqli_escape_string($conn,$_REQUEST['subject']);
if(isset($_REQUEST['class']))$class=mysqli_escape_string($conn,$_REQUEST['class']);
if(isset($_REQUEST['session']))$session=mysqli_escape_string($conn,$_REQUEST['session']);
if(isset($_REQUEST['term']))$term=mysqli_escape_string($conn,$_REQUEST['term']);

$schldetails=array();
$schldetails=getSchoolDetails($schlid);

$schlname=$schldetails['schlName'];
$schlstate=$schldetails['State'];
$schllocation=$schldetails['location'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo "$schlname - $subject results for class $class $term $session " ;?> | Post primary school education center</title>
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
<div class="adminHeading row-fluid">
<div class="span6">

<!--h1><?php echo $schldetails['schlName'];?></h1>
<h2>on Post Primary School.com</h2-->
<?php include("link-files/printschoolheading.php");?>
</div>
<div class="span4 offset2 padding"><center>
<img src="img/Coat_of_arms_of_Nigeria.svg.png" width="100" /><br />Federal Ministry of Education.</center>
</div>
</div>

	<div class="row-fluid titlebody navbar-static-top">
    <div class="span12">
    	<table width="100%" style="color:#FFF;">
        <tr><td>subject : <?php echo $subject;?>
        </td><td>
        Class admission year : <?php echo $class;?></td><td>
        Current class : <?php echo "$session $term";?></td>
        </tr>
    	</table>
    </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
        
        <table width="100%" class="table table-hover">
        	<tr>
            <th>Sn</th>
            <th>Name</th>
            <th>Reg. No.</th>
            <th>Test Score</th>
            <th>Practical Score</th>
            <th>Exam. Score</th>
            <th>Total Score</th>
            <th>Grade</th>
            <th>Position</th>
            </tr>
            <?php
				$fields=array();
				$flagfields=array('subject_name','schlid','class_id','session','term');
				$flagvalues=array($subject,$schlid,$class,$session,$term);
				$selectedGrading=$schldetails['grading_profile'];
				
				$k=mysqli_query($conn,SQLretrieve('result',$fields,$flagfields,$flagvalues));
				if($k!=false){
					$i=1;
					while($val=mysqli_fetch_array($k)){
						$name=getStudName($val['studID'],$schlid);
						$studID=$val['studID'];
						$tscore=$val['tscore'];
						$practscore=$val['practscore'];
						$examscore=$val['examscore'];
						$totalscore=$tscore+$practscore+$examscore;
						#echo "<br>$totalscore<br>";
						$grade=grade($totalscore,$selectedGrading);
						$position=determinePosition($subject,$schlid,$class,$session,$term,$studID);
						?>
							<tr>
                            <td><?php echo "$i.";?></td>
                            <td><?php echo "$name";?></td>
                            <td><?php echo "$studID";?></td>
                            <td><?php echo "$tscore";?></td>
                            <td><?php echo "$practscore";?></td>
                            <td><?php echo "$examscore";?></td>
                            <td><?php echo "$totalscore";?></td>
                            <td><?php echo "$grade";?></td>
                            <td><?php echo "$position";?></td>
                            </tr>
                        <?php
						$i++;
					}
				}
			?>
        </table>
        
        
        </div>

    </div>
    <div class="pull-right" style="padding:20px;" onclick="print();"><a style="cursor:pointer;"><span class="icon icon-print"></span> Print</a></div>
    <div class="row-fluid">
    	<div class="span12">
        <center>
        <?php echo $schldetails['schlName'];?> Name of <?php echo $schldetails['address'];?><br />
        on www.ppseducation.com.ng<br />
        For more information contact us on support@ppseducation.com.ng<br />
        or Call <span class="icon-user"></span> 07036765446<br />
        
        </center>
        </div>
    </div>
</div>
</div>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>