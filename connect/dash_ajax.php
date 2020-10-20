<?php
require_once("indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}
/*$testInstruction;
$testName;
$testNoOfQuestion;
$testPercent;
$testDuration;
$testType;
$availableQ;
$testID;
*/
$fxn=$_REQUEST["fxn"];

if($fxn=='cardCostForm'){#use function in script file specified for  inside account files
	$qty="";
	$method="";
	$orderid="";
	
	#get location and state
	$schools=array();
	$schools=getSchools('school');
	
	$i=count($schools);
	
	while($i>0){
		if($schools[$i]['schlid']== $_SESSION['schlid']){
			$location=$schools[$i]['location'];
			$state=$schools[$i]['State'];
			break;
		}
		$i--;
	}
	
	if(isset($_REQUEST['qty'])) $qty=$_REQUEST['qty'];
	if(isset($_REQUEST['method'])) $method=$_REQUEST['method'];
	if(isset($_REQUEST['orderid'])) $orderid=$_REQUEST['orderid'];
	
	echo "<p align='center' class=''>Order id : <b>$orderid</b> <br>view your order <a href='admindashboard.php'>history</a></p>";
	echo calculateOrderCost($qty,$method,$location,$state);
}
if($fxn=='placeOrderForm'){
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
	
	echo "<p align='center'>".orderAccessPin($schlid,$email,$qty,$card,$method,$shipment,$total,$orderid)."</p>";
	#echo calculateOrderCost($qty,$method,$location,$state);
}elseif($fxn=='promoteStud'){
	$studID="";
	$schlid='';
	$subclass='';
	$clsid='';
	
	if(isset($_REQUEST['studID'])) $studID=$_REQUEST['studID'];
	if(isset($_REQUEST['schlid'])) $schlid=$_REQUEST['schlid'];
	if(isset($_REQUEST['subclass'])) $subclass=$_REQUEST['subclass'];
	if(isset($_REQUEST['clsid'])) $clsid=$_REQUEST['clsid'];
	
	#echo 
	promoteStudent($studID);
	echo viewClassList($schlid,$clsid,$subclass);
}elseif($fxn=='demoteStud'){
	$studID="";
	$schlid='';
	$subclass='';
	$clsid='';
	
	if(isset($_REQUEST['studID'])) $studID=$_REQUEST['studID'];
	if(isset($_REQUEST['schlid'])) $schlid=$_REQUEST['schlid'];
	if(isset($_REQUEST['subclass'])) $subclass=$_REQUEST['subclass'];
	if(isset($_REQUEST['clsid'])) $clsid=$_REQUEST['clsid'];
	
	#echo 
	demoteStudent($studID);
	echo viewClassList($schlid,$clsid,$subclass);
}elseif($fxn=='removeStud'){
	$studID="";
	$schlid='';
	$subclass='';
	$clsid='';
	
	if(isset($_REQUEST['studID'])) $studID=$_REQUEST['studID'];
	if(isset($_REQUEST['schlid'])) $schlid=$_REQUEST['schlid'];
	if(isset($_REQUEST['subclass'])) $subclass=$_REQUEST['subclass'];
	if(isset($_REQUEST['clsid'])) $clsid=$_REQUEST['clsid'];
	
	#echo 
	removeStudent($studID);
	echo viewClassList($schlid,$clsid,$subclass);
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
}elseif($fxn=='loadavailablesubjects'){
	$groupid='';
	if(isset($_REQUEST['groupid']))$groupid=$_REQUEST['groupid'];
	loadSubjectsTolist($_SESSION['schlid'],$groupid);
	
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
	if(isset($_REQUEST['email']))$email=mysqli_escape_string($conn,$_REQUEST['email']);
	
	echo resetPassword($email,$schlid);
}elseif($fxn=='listClassSubjects'){
	
	$schlid="";
	$subjectGroup='';
	
	if(isset($_SESSION['schlid']))$schlid=$_SESSION['schlid'];
	if(isset($_REQUEST['subjectGroup']))$subjectGroup=mysqli_escape_string($conn,$_REQUEST['subjectGroup']);
	
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
	if(isset($_REQUEST['class']))$classid=mysqli_escape_string($conn,$_REQUEST['class']);
	if(isset($_REQUEST['curclass']))$curClass=mysqli_escape_string($conn,$_REQUEST['curclass']);
	if(isset($_REQUEST['subjectname']))$subjectid=mysqli_escape_string($conn,$_REQUEST['subjectname']);
	if(isset($_REQUEST['id']))$group_ID=mysqli_escape_string($conn,$_REQUEST['id']);
	if(isset($_REQUEST['pract']))$pract=mysqli_escape_string($conn,$_REQUEST['pract']);
	
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
	if(isset($_REQUEST['name']))$name=mysqli_escape_string($conn,$_REQUEST['name']);
	if(isset($_REQUEST['class']))$class=mysqli_escape_string($conn,$_REQUEST['class']);
	if(isset($_REQUEST['id']))$studID=mysqli_escape_string($conn,$_REQUEST['id']);
	if(isset($_REQUEST['term']))$term=mysqli_escape_string($conn,$_REQUEST['term']);
	if(isset($_REQUEST['session']))$session=mysqli_escape_string($conn,$_REQUEST['session']);
	if(isset($_REQUEST['subject_name']))$subject_name=mysqli_escape_string($conn,$_REQUEST['subject_name']);
	if(isset($_REQUEST['tscores']))$tscores=mysqli_escape_string($conn,$_REQUEST['tscores']);
	
	if(isset($_REQUEST['practscores']))$practscores=mysqli_escape_string($conn,$_REQUEST['practscores']);
	
	if(isset($_REQUEST['examscores']))$examscores=mysqli_escape_string($conn,$_REQUEST['examscores']);
	
	$tscores=explode('|',$tscores);
	
	if(!empty($practscores))$practscores=explode('|',$practscores);
	
	$examscores=explode('|',$examscores);
	$studID=explode('|',$studID);
	$name=explode('|',$name);
	
	for($i=1;$i<count($tscores);$i++){
		$j=$i-1;
		#echo "<br>({$name[$j]},$term,$session,{$tscores[$j]},{$practscores[$j]},{$examscores[$j]},{$studID[$j]},$class,$schlid);</br>";
		if(!empty($practscores)){
			updateResultSheet($subject_name,$term,$session,$tscores[$j],$practscores[$j],$examscores[$j],$studID[$j],$class,$schlid);
		}else{
			updateResultSheet($subject_name,$term,$session,$tscores[$j],'',$examscores[$j],$studID[$j],$class,$schlid);
		}
	}
}elseif($fxn=='removeOrderPin'){
	$orderID='';
	if(isset($_REQUEST['id']))$orderID=mysqli_escape_string($conn,$_REQUEST['id']);
	removePinID($orderID);
	include("../link-files/pinhistory.php");
}elseif($fxn=='loadpinHistory'){
	include("../link-files/pinhistory.php");
}elseif($fxn=='loadadHistory'){
	include("../link-files/adshistory.php");
}elseif($fxn=='loadcbtHistory'){
	include("../link-files/cbthistory.php");
}elseif($fxn=='removeOrderedAds'){
	$orderID='';
	if(isset($_REQUEST['id']))$orderID=mysqli_escape_string($conn,$_REQUEST['id']);
	removeAdsID($orderID);
	include("../link-files/adshistory.php");
}elseif($fxn=='removeOrderedcbt'){
	$orderID='';
	if(isset($_REQUEST['id']))$orderID=mysqli_escape_string($conn,$_REQUEST['id']);
	removecbtID($orderID);
	include("../link-files/adshistory.php");
}elseif($fxn=='placeAds'){
	$title='';
	$dimension='';
	$period='';
	$orderid='';
	$schlid=$_SESSION['schlid'];
	$cost='';
	
	if(isset($_REQUEST['title']))$title=mysqli_escape_string($conn,$_REQUEST['title']);
	if(isset($_REQUEST['dimension']))$dimension=mysqli_escape_string($conn,$_REQUEST['dimension']);
	if(isset($_REQUEST['period']))$period=mysqli_escape_string($conn,$_REQUEST['period']);
	if(isset($_REQUEST['orderid']))$orderid=mysqli_escape_string($conn,$_REQUEST['orderid']);
	
	#calls the ads add function
	#echo "$title,$dimension,-$period-,$schlid,$orderid -<br>";
	#$cost=calculateAdscost($period);
	userPlaceAds($title,$dimension,$period,$schlid,$orderid);
	include("../link-files/placeAdsform2.php");
}elseif($fxn=='previewAds'){
	$orderID='';
	if(isset($_REQUEST['orderid']))$orderID=mysqli_escape_string($conn,$_REQUEST['orderid']);
	?>
    <input type="hidden" name="adorderid" id="adorderid" value="<?php echo $orderID;?>" />
    <?php
	$fields=array();
	$flagfields=array('orderID');
	$flagvalues=array("$orderID");
	$file='';
	
	$ok=mysqli_query($conn,SQLretrieve('advert',$fields,$flagfields,$flagvalues));
	if($ok!=false){
		if($value=mysqli_fetch_array($ok)){
			$file=$value["path"];
			#echo @"exe 1 <br> - {$value['path']} - $orderID ";
		}
	}
	if($file!=''){
	?>
    <img src="<?php echo "$file";?>" width="200">
    <?php	
	}else{
	?>
    <img src="img/icons/icon-adsimage.png" width="200">
    <?php
	}
	#removeAdsID($orderID);
	#include("../link-files/adshistory.php");
}elseif($fxn=='adminpreviewAds'){
	$orderID='';
	if(isset($_REQUEST['orderid']))$orderID=mysqli_escape_string($conn,$_REQUEST['orderid']);
	?>
    <input type="hidden" name="adorderid" id="adorderid" value="<?php echo $orderID;?>" />
    <?php
	$fields=array();
	$flagfields=array('orderID');
	$flagvalues=array("$orderID");
	$file='';
	
	$ok=mysqli_query($conn,SQLretrieve('advert',$fields,$flagfields,$flagvalues));
	if($ok!=false){
		if($value=mysqli_fetch_array($ok)){
			$file=$value["path"];
		}
	}
	if($file!=''){
	?>
    <img src="<?php echo "../$file";?>" width="300">
    <?php	
	}else{
	?>
    <img src="../img/icons/icon-adsimage.png" width="300">
    <?php
	}
}elseif($fxn=='loadsubjectgroup'){
	?> 
      <option>Select subject group name</option>
      <?php loadSubjectGroups($_SESSION['schlid']);?>
    <?php
}elseif($fxn=='newPremuimTestDisplay'){
	$code='';
	if(isset($_REQUEST['code'])) $code=mysqli_escape_string($conn,$_REQUEST['code']);
	#verify the availability of the code, check it validity,
	#if it is valid, load newtest. popup error.
	
	$fields=array();
	$flagfields=array('access_code','schlid');
	$flagvalues=array($code,$_SESSION['schlid']);
	
	$ok=mysqli_query($conn,SQLretrieve('premuim_cbt_access_code',$fields,$flagfields,$flagvalues));
	
	if(mysqli_affected_rows($conn)>0){
		if($val=mysqli_fetch_array($ok)){
			$expdate=$val['expiration_date'];
			$curdate=date('d/m/Y');
			if($curdate<$expdate){
				$_SESSION['cbtAccessCode']=$code;
				include("../link-files/newtest.php");
			}else{
				echo '<p class=\'alert alert-info\'>Your entered premuim cbt code is has expired. <br> Please purchase another one.</p>';
			}
		}
	}else{
		echo '<p class=\'alert alert-danger\'>Invalid or unactivated premuim cbt access code,<br>please contact admin.</p>';	
	}
}elseif($fxn=='newTestDisplay'){
	
	if(checkFreeVersion($_SESSION['schlid'])==true){
		include("../link-files/newtest.php");
	}else{
		include("../link-files/premuimtestaccess.php");
	}
}elseif($fxn=='reActivateTest'){
	$testID='';
	if(isset($_REQUEST['testid']))$testID=mysqli_escape_string($conn,$_REQUEST['testid']);
	?>
    <input type="hidden" name="testid" id="testid" value="<?php echo $testID;?>">
    <?php
	include("../link-files/testreactivation.php");

}elseif($fxn=='applycode'){
	$code='';
	$testid='';
	if(isset($_REQUEST['testid']))$testid=mysqli_escape_string($conn,$_REQUEST['testid']);
	if(isset($_REQUEST['code']))$code=mysqli_escape_string($conn,$_REQUEST['code']);
	
	echo applyReactivationCode($_SESSION['schlid'],$testid,$code);

}elseif($fxn=='loadtestproperty'){
	$testID='';
	if(isset($_REQUEST['id']))$testID=mysqli_escape_string($conn,$_REQUEST['id']);
	
	loadtestProperty($_SESSION['schlid'],$testID);
	
}elseif($fxn=='loadNewTestForm'){
	#$ill='';
	$type='';
	$testid='';
	
	if(isset($_REQUEST['type']))$type=mysqli_escape_string($conn,$_REQUEST['type']);
	#if(isset($_REQUEST['ill']))$ill=mysqli_escape_string($conn,$_REQUEST['ill']);
	if(isset($_REQUEST['testid']))$testid=mysqli_escape_string($conn,$_REQUEST['testid']);
	
	#echo "$type | $ill | $testid <br>";
	
	if($type=='Non-illustration based question'){
		echo "<h5>$type</h5>";
		multipleTestPopupDisplays($_SESSION['schlid'],$testid,$type);
	}elseif($type=='Illustration based question'){
		echo "<h5>$type</h5>";
		illMultipleTestPopupDisplay($_SESSION['schlid'],$testid,$type);
	}
}elseif($fxn=='loadQEditForm'){
	#sleep(5);
	$type='';
	$testid='';
	$Qid='';
	
	
	if(isset($_REQUEST['type']))$type=mysqli_escape_string($conn,$_REQUEST['type']);
	if(isset($_REQUEST['testid']))$testid=mysqli_escape_string($conn,$_REQUEST['testid']);
	if(isset($_REQUEST['qid']))$Qid=mysqli_escape_string($conn,$_REQUEST['qid']);
	
	#echo "Entered - $type - $testid - $Qid ########################################<br>";
	
	if(trim($type)==trim('Non-illustration based question')){
		#echo "Entered - $type - $testid - $Qid<br>";
		loadNQforEditing($_SESSION['schlid'],$testid,$Qid);
		
	}elseif(trim($type)==trim('Illustration based question')){
	#}else{
		#echo "Entered - $type - $testid - $Qid<br>";	
		loadIQforEditing($_SESSION['schlid'],$testid,$Qid);
		
	}
	
}elseif($fxn=='removeQuestion'){
	$testID='';
	$Qid='';
	$schlid='';
	
	if(isset($_REQUEST['schlid']))$schlid=mysqli_escape_string($conn,$_REQUEST['schlid']);
	if(isset($_REQUEST['testid']))$testID=mysqli_escape_string($conn,$_REQUEST['testid']);
	if(isset($_REQUEST['Qid']))$Qid=mysqli_escape_string($conn,$_REQUEST['Qid']);
	
	$Qid=explode(':',$Qid);
	
	for($i=0;$i<count($Qid);$i++){
		removeTestQuestion($Qid[$i]);	
	}
	listOfTestQuestions($schlid,$testID);

}elseif($fxn=='loadTest'){
	
	$testID='';
	$schlid='';
	
	if(isset($_REQUEST['schlid']))$schlid=mysqli_escape_string($conn,$_REQUEST['schlid']);
	if(isset($_REQUEST['testid']))$testID=mysqli_escape_string($conn,$_REQUEST['testid']);
	
	loadTest($schlid,$testID,'preview');
	loadTest_intro('User');
	#echo "Entered?";
}elseif($fxn=='startTest'){
	$testID='';
	if(isset($_REQUEST['testid']))$testID=mysqli_escape_string($conn,$_REQUEST['testid']);
	
	$QIndex=array();
	$questions=loadTest_start($_SESSION['schlid'],$_SESSION['testID']);
	if(!empty($questions)){
	$noofQ=count($questions);
	
	if($_SESSION['testReshuffle']=='on'){
		#randomly arrange question Index
		$i=0;
		while($i<$noofQ){
			$no=mt_rand(0,($noofQ-1));#ensure that newly created question index are among the entries in question.
			if(!in_array($no,$QIndex)){
				$QIndex[$i]=$no;
			$i++;
			}
		}
		#echo "index reshuffled";
	}else{
		for($i=0;$i<$noofQ;$i++){
			$QIndex[$i]=$i;
		}
		#echo "index un-reshuffled";
	}
	$_SESSION['curQ']=1;
	$_SESSION['QIndex']=$QIndex;
	$_SESSION['Question']=$questions;
	$_SESSION['score']=0;#initialize score
	
	displayQuestion($_SESSION['curQ'],$_SESSION['Question'],$_SESSION['QIndex']);
}else{
	echo "<h3 align=\"center\">Sorry no question <br>currently available in the selected test.</h3>";
}	
	
}elseif($fxn=='loadtime'){
	/*echo "
			<strong>{$_SESSION['testName']} <br>
			{$_SESSION['testNoOfQuestion']}<br>
			{$_SESSION['testPercent']}<br>
			{$_SESSION['testDuration']} duration <br>
			{$_SESSION['testType']}<br>
			{$_SESSION['testInstruction']}<br>
			{$_SESSION['testTarget']}<br>
			{$_SESSION['testReshuffle']}<br>
			{$_SESSION['testID']}</strong>
			";*/
	$_SESSION['testDuration']=questionTimer($_SESSION['testDuration']);
}elseif($fxn=='nextQuestion'){
	#get previous quesrion score
	#increase current record id
	#dusplay qyestion
	$score='';
	if(isset($_REQUEST['score']))$score=mysqli_escape_string($conn,$_REQUEST['score']);
	
	$_SESSION['score']=$_SESSION['score']+$score;
	
	$_SESSION['curQ']++;
	
	if($_SESSION['curQ']<=$_SESSION['availableQ']){
		displayQuestion($_SESSION['curQ'],$_SESSION['Question'],$_SESSION['QIndex']);
	}else{
		computeTotalScore();
	}
}elseif($fxn=='removeTest'){
	
	$testID='';
	$schlid='';
	
	if(isset($_REQUEST['schlid']))$schlid=mysqli_escape_string($conn,$_REQUEST['schlid']);
	if(isset($_REQUEST['testid']))$testID=mysqli_escape_string($conn,$_REQUEST['testid']);
	
	$testID=explode(':',$testID);
	
	for($i=0;$i<count($testID);$i++){
		removeTest($testID[$i]);	
	}
	listOfAdminCBT($schlid);
}
?>