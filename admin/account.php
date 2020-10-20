<?php
require_once("../connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}

include("links/header.php"); #cause redirection of request after signout

$start=0;
$limit=3;

if(isset($_GET['pg']) && is_numeric($_GET['pg'])) {
	$pg=mysqli_escape_string($conn,$_GET['pg']);
	$start=($pg-1)*$limit;
}else{
	$pg=1;
}
/*
function getAccounts($page,$start,$limit){
	?>
    <input type="hidden" name="total" id="total" value="<?php echo $limit;?>">
    <input type="hidden" name="start" id="start" value="<?php echo $start;?>">
    <?php
	#echo "$page,$start,$limit<br>";
	$sql="select * from school_admin LIMIT $start, $limit";
	$k=mysql_query($sql);
	if($k!=false){
		?>
        <table class="table table-hover">
        <thead>
    	<tr><th><input type="checkbox" id="selall" name="selall"></th><th>SN</th><th>School ID</th><th>School Details</th><th>publish Status</th><th>Active status</th></tr>
        </thead>
        <tbody>
        <?php
		$i=$start;
		while($val=mysql_fetch_array($k)){
			?>
            
            <?php
			#echo "we - $i<br>";
			$j=$i+1;
			#$details[$i]=$val;
			$schl=getSchoolDetails($val['schlid']);
			?>
            <tr><td><input type="checkbox" id="item<?php echo $j;?>" name="item<?php echo $j;?>" value="<?php echo $val['schlid'];?>"></td><td><?php echo "$j";?></td><td style="cursor:pointer;" data-target="#cardUseageRate" data-toggle="modal" onClick="loadCardUsageHistory(<?php echo $val['schlid'];?>);"><?php echo "{$val['schlid']}";?></td><td><?php echo @"<b>{$val['schoolName']}({$schl[3]})</b><br><b>Email : </b>{$val['email']}<br><b>Phone : </b>{$val['phone']}<br><b>Site Admin : </b>{$val['name']}({$val['adminID']})";?></td><td><?php echo getPublishedStatus(@$schl[14]);?></td><td><?php echo getActiveStatus($val['activation_status']);?></td></tr>
            <?php
			$i++;
		}
	}
		?>
        </tbody>
        </table>
        <?php
}
function listPages($page,$start,$limit){
	#fetch all the data from the database
		$sql="select * from school_admin";
		$g=mysql_query($sql);
		$row=mysql_num_rows($g);
		
		#calculate total page number for the given table in the database
		$total=ceil($row/$limit);
		?>
        <div class="btn-group">
        <?php
		if($page>1){
			#goto previous page to show previous 10 items. if its in page 1then it is in active
			?>
            <a href="?pg=<?php echo ($page-1);?>" class="btn">Previous</a>
            <?php
		}
		#show all the page link with page number. when click on these numbers go to a particular page.
		
        for($i=1;$i<=$total;$i++){
			if($i==$page){
				echo "<a class=\"btn\">$i</a>";
			}else{
				echo " <a class=\"btn\" href=\"?pg=$i\">$i</a>";
			}
		}
		if($page!=$total){
			#goto next page to show next 10 item
			?>
            <a href="?pg=<?php echo ($page+1);?>" class="btn">Next</a>
            <?php
		}
		?>
		</div>
        <?php
}*/
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>@Admin - Accounts | Post primary school education center.</title>
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
<div class="container-fluid">
  <div class="adminHeading row-fluid">
    <div class="span6 padding">
	<?php include("links/schoolHeading.php");?>
    </div>
    <div class="span4 offset2 padding"><img class="pull-right" src="../img/ministry_of_education.png" width="394" alt="ministry of education">
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
    <div class="span2">
    <div class="border">
    <?php include("links/left_side_link.php");?>
    <?php include("links/carduseagerate.php");?>
    </div></div>
    <div class="span7 border">
    
    <div class="h-line"><img src=""><h2>List of registered accounts</h2></div>
        <form class="form-actions" method="post">
<div class="btn-group">
<button type="submit" class="btn" name="deleteAcc" id="deleteAcc" onClick="deleteSelAcc();"> Delete </button> <button type="submit" name="updateAcc" id="updateAcc" class="btn" onClick="updateAccStatus();">  Update </button>
</div>
<div id="accountList" style="padding:10px;">
<?php
	listPages($pg,$start,$limit);#show first pagination
	getAccounts($pg,$start,$limit);#items
	listPages($pg,$start,$limit);#show last pagination
?>
</div>
<div class="btn-group">
<button type="submit" class="btn" name="deleteAcc" id="deleteAcc" onClick="deleteSelAcc();"> Delete </button> <button class="btn" type="submit" name="updateAcc" id="updateAcc" onClick="updateAccStatus();">  Update </button>
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