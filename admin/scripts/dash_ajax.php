<?php
require_once("../../connect/indexScripts.php");
if(!isset($_SESSION)){
	session_start();
}

$fxn=$_REQUEST["fxn"];
#echo"$fxn | removeOrderedPins<br>";

if($fxn=='loadOrderedPins'){#use function in script file specified for  inside account files
	 loadOrderedPins();
}elseif($fxn=='removeOrderedPins'){
	$id='';
	if($_REQUEST['id']) $id=mysqli_escape_string($conn,$_REQUEST['id']);
	if($id!=''){
		$ok=explode('|',$id);
		for($i=0;$i<count($ok);$i++){
			removePinOrder($ok[$i]);
		}
	}
	loadOrderedPins();
}elseif($fxn=='changeOrderedPinsStatus'){
	$id='';
	if($_REQUEST['id']) $id=mysqli_escape_string($conn,$_REQUEST['id']);
	if($id!=''){
		$ok=explode('|',$id);
		for($i=0;$i<count($ok);$i++){
			changePinOrderStatus($ok[$i]);
		}
	}
	loadOrderedPins();
}elseif($fxn=='loadPinSet'){
	loadPinSet();
}elseif($fxn=='changePinSetStatus'){
	$id='';
	if($_REQUEST['id']) $id=mysqli_escape_string($conn,$_REQUEST['id']);
	if($id!=''){
		$ok=explode('|',$id);
		for($i=0;$i<count($ok);$i++){
			activatePinSetStatus($ok[$i]);
		}
	}
	loadPinSet();
}elseif($fxn=='removePinSet'){
	$id='';
	if($_REQUEST['id']) $id=mysqli_escape_string($conn,$_REQUEST['id']);
	if($id!=''){
		$ok=explode('|',$id);
		for($i=0;$i<count($ok);$i++){
			removePinSet($ok[$i]);
		}
	}
	loadPinSet();
}elseif($fxn=='loadDetailedPin'){
	$batchno='';
	if($_REQUEST['batchno']) $batchno=mysqli_escape_string($conn,$_REQUEST['batchno']);
	?>
    	<input type="hidden" name="batch" id="batch" value="<?php echo $batchno; ?>" />
    <?php
	loadDetailedPin($batchno);
}elseif($fxn=='loadCardUsageHistory'){
	$schlid='';
	if($_REQUEST['schlid']) $schlid=mysqli_escape_string($conn,$_REQUEST['schlid']);
	seeSchoolCardUsageHistory($schlid);
}elseif($fxn=='updateAccStatus'){
	$id='';
	if($_REQUEST['id']) $id=mysqli_escape_string($conn,$_REQUEST['id']);
	if($id!=''){
		$ok=explode('|',$id);
		for($i=0;$i<count($ok);$i++){
			updateAccStatus($ok[$i]);
		}
	}
}elseif($fxn=='deleteSelAcc'){
	$id='';
	if($_REQUEST['id']) $id=mysqli_escape_string($conn,$_REQUEST['id']);
	if($id!=''){
		$ok=explode('|',$id);
		for($i=0;$i<count($ok);$i++){
			
			#updateAccStatus($ok[$i]);
			
		}
	}
}elseif($fxn=='AdminremoveOrderedads'){
	$pg='';
	$start='';
	$limit='';
	$item_id="";
	
	if(isset($_REQUEST['pg']))$pg=mysqli_escape_string($conn,$_REQUEST['pg']);
	if(isset($_REQUEST['start']))$start=mysqli_escape_string($conn,$_REQUEST['start']);
	if(isset($_REQUEST['limit']))$limit=mysqli_escape_string($conn,$_REQUEST['limit']);
	if(isset($_REQUEST['id']))$item_id=mysqli_escape_string($conn,$_REQUEST['id']);
	#echo "$item_id<br>";
	$orderid=explode('|',$item_id);
	for($i=0;$i<count($orderid);$i++){
		adminRemoveAds($orderid[$i]);
	}
	#echo "chai<br>";
	$start--;
	getAdverts($pg,$start,$limit);
}elseif($fxn=='AdminChangeAdsPubStatus'){
	$pg='';
	$start='';
	$limit='';
	$item_id="";
	
	if(isset($_REQUEST['pg']))$pg=mysqli_escape_string($conn,$_REQUEST['pg']);
	if(isset($_REQUEST['start']))$start=mysqli_escape_string($conn,$_REQUEST['start']);
	if(isset($_REQUEST['limit']))$limit=mysqli_escape_string($conn,$_REQUEST['limit']);
	if(isset($_REQUEST['id']))$item_id=mysqli_escape_string($conn,$_REQUEST['id']);
	#echo "$item_id<br>";
	$orderid=explode('|',$item_id);
	for($i=0;$i<count($orderid);$i++){
		#adminRemoveAds($orderid[$i]);
		adminPubnUnpubAds($orderid[$i]);
	}
	#echo "chai<br>";
	$start--;
	getAdverts($pg,$start,$limit);
}
/*if($fxn=='placeOrderForm'){
	$qty="";
	$method="";
	$card="";
	$shipment="";
	$total="";
	$orderid="";
	$schlid=$_SESSION['schlid'];
	$email=$_SESSION['email'];
	
	if(isset($_REQUEST['qty'])) $qty=$_REQUEST['qty'];
	if(isset($_REQUEST['method'])) $method=$_REQUEST['method'];
	if(isset($_REQUEST['card'])) $card=$_REQUEST['card'];
	if(isset($_REQUEST['shippment'])) $shipment=$_REQUEST['shippment'];
	if(isset($_REQUEST['total'])) $total=$_REQUEST['total'];
	if(isset($_REQUEST['order'])) $orderid=$_REQUEST['order'];
	
	echo orderAccessPin($schlid,$email,$qty,$card,$method,$shipment,$total,$orderid);
	#echo calculateOrderCost($qty,$method,$location,$state);
}elseif($fxn=='promoteStud'){
	$studID="";
	if(isset($_REQUEST['studID'])) $studID=$_REQUEST['studID'];
	
	echo promoteStudent($studID);
}elseif($fxn=='demoteStud'){
	$studID="";
	if(isset($_REQUEST['studID'])) $studID=$_REQUEST['studID'];
	
	echo demoteStudent($studID);
}elseif($fxn=='removeStud'){
	$studID="";
	if(isset($_REQUEST['studID'])) $studID=$_REQUEST['studID'];
	
	echo removeStudent($studID);
}elseif($fxn=='preview'){
	$dob="";
	$stud="";
	$gender="";
	$parentn="";
	$parentp="";
	$address="";
	
	if(isset($_REQUEST['dob'])) $dob=$_REQUEST['dob'];
	if(isset($_REQUEST['stud'])) $stud=$_REQUEST['stud'];
	if(isset($_REQUEST['gender'])) $gender=$_REQUEST['gender'];
	if(isset($_REQUEST['parentn'])) $parentn=$_REQUEST['parentn'];
	if(isset($_REQUEST['parentp'])) $parentp=$_REQUEST['parentp'];
	if(isset($_REQUEST['address'])) $address=$_REQUEST['address'];
	
	#echo "<br> -".$stud." - $dob - $gender - $parentp - $parentn - $address.<br>";
	
	echo previewImg($stud,$dob,$gender,$parentn,$parentp,$address);
}elseif($fxn=='creategroup'){
	$schlid="";
	$name="";
	$id="";
	
	if(isset($_SESSION['schlid']))$schlid=$_SESSION['schlid'];
	if(isset($_REQUEST['name']))$name=$_REQUEST['name'];
	if(isset($_REQUEST['id']))$id=$_REQUEST['id'];
	
	echo createSubjectGroup($schlid,$name,$id);
}elseif($fxn=='addto'){
	$schlid="";
	$name="";
	$pract="";
	$sele='';
	$groupid='';
	
	if(isset($_SESSION['schlid']))$schlid=$_SESSION['schlid'];
	if(isset($_REQUEST['k']))$name=$_REQUEST['k'];
	if(isset($_REQUEST['pract']))$pract=$_REQUEST['pract'];
	if(isset($_REQUEST['sele']))$sele=$_REQUEST['sele'];
	if(isset($_REQUEST['groupid']))$groupid=$_REQUEST['groupid'];
	
	addSubjectToList($schlid,$name,$groupid,$pract,$sele);
	loadSubjectsTolist($schlid,$groupid);
}elseif($fxn=='removeSubject'){
	$schlid="";
	$subjectName="";
	$groupid='';
	
	if(isset($_SESSION['schlid']))$schlid=$_SESSION['schlid'];
	if(isset($_REQUEST['subjectname']))$subjectName=$_REQUEST['subjectname'];
	if(isset($_REQUEST['groupid']))$groupid=$_REQUEST['groupid'];
	#echo "$schlid - $subjectName - $groupid";
	removeSubject($subjectName,$groupid,$schlid);
	loadSubjectsTolist($schlid,$groupid);
}elseif($fxn=='removeGroup'){
	$schlid="";
	$groupid='';
	
	if(isset($_SESSION['schlid']))$schlid=$_SESSION['schlid'];
	if(isset($_REQUEST['grp']))$groupid=$_REQUEST['grp'];
	#echo "$schlid - $subjectName - $groupid";
	removeGroup($schlid,$groupid);
	loadSubjectGroups($schlid);
}elseif($fxn=='resetpsw'){
	$schlid="";
	$email='';
	
	if(isset($_SESSION['schlid']))$schlid=$_SESSION['schlid'];
	if(isset($_REQUEST['email']))$email=mysql_escape_string($_REQUEST['email']);
	
	echo resetPassword($email,$schlid);
}elseif($fxn=='listClassSubjects'){
	
	$schlid="";
	$subjectGroup='';
	
	if(isset($_SESSION['schlid']))$schlid=$_SESSION['schlid'];
	if(isset($_REQUEST['subjectGroup']))$subjectGroup=mysql_escape_string($_REQUEST['subjectGroup']);
	if($subjectGroup=='default'){
		listClassSubjects('default',$subjectGroup);
	}else{
		listClassSubjects($schlid,$subjectGroup);
	}
}elseif($fxn=='displayScoreSheet'){
	
	$schlid="";
	$classid='';
	$curClass='';
	$subjectid='';
	$group_ID='';
	$pract='';
	
	if(isset($_SESSION['schlid']))$schlid=$_SESSION['schlid'];
	if(isset($_REQUEST['class']))$classid=mysql_escape_string($_REQUEST['class']);
	if(isset($_REQUEST['curclass']))$curClass=mysql_escape_string($_REQUEST['curclass']);
	if(isset($_REQUEST['subjectname']))$subjectid=mysql_escape_string($_REQUEST['subjectname']);
	if(isset($_REQUEST['id']))$group_ID=mysql_escape_string($_REQUEST['id']);
	if(isset($_REQUEST['pract']))$pract=mysql_escape_string($_REQUEST['pract']);
	
	listClassStudents($schlid,$classid,$curClass,$subjectid,$group_ID,$pract);
}elseif($fxn=='updateSheet'){
	#class='+class+'&name='+name+'&id='+id+'&session='+session+'&term='+term+'&tscores='+tscores+'&pracscores='+practscores+'&examscores='+examscores
	
	$schlid="";
	$class='';
	$studID='';
	$name='';
	$term='';
	$session='';
	$tscores='';
	$practscores='';
	$examscores='';
	$subject_name='';
	
	if(isset($_SESSION['schlid']))$schlid=$_SESSION['schlid'];
	if(isset($_REQUEST['name']))$name=mysql_escape_string($_REQUEST['name']);
	if(isset($_REQUEST['class']))$class=mysql_escape_string($_REQUEST['class']);
	if(isset($_REQUEST['id']))$studID=mysql_escape_string($_REQUEST['id']);
	if(isset($_REQUEST['term']))$term=mysql_escape_string($_REQUEST['term']);
	if(isset($_REQUEST['session']))$session=mysql_escape_string($_REQUEST['session']);
	if(isset($_REQUEST['subject_name']))$subject_name=mysql_escape_string($_REQUEST['subject_name']);
	if(isset($_REQUEST['tscores']))$tscores=mysql_escape_string($_REQUEST['tscores']);
	
	if(isset($_REQUEST['practscores']))$practscores=mysql_escape_string($_REQUEST['practscores']);
	
	if(isset($_REQUEST['examscores']))$examscores=mysql_escape_string($_REQUEST['examscores']);
	
	$tscores=explode('|',$tscores);
	
	if(!empty($practscores))explode('|',$practscores);
	
	$examscores=explode('|',$examscores);
	$studID=explode('|',$studID);
	$name=explode('|',$name);
	
	for($i=1;$i<count($tscores);$i++){
		$j=$i-1;
		#echo "<br>({$name[$j]},$term,$session,{$tscores[$j]},{$practscores},{$examscores[$j]},{$studID[$j]},$class,$schlid);</br>";
		if(!empty($practscores)){
			updateResultSheet($subject_name,$term,$session,$tscores[$j],$practscores[$j],$examscores[$j],$studID[$j],$class,$schlid);
		}else{
			updateResultSheet($subject_name,$term,$session,$tscores[$j],'',$examscores[$j],$studID[$j],$class,$schlid);
		}
	}
}*/
?>