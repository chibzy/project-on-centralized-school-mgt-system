<?php
require_once("indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}

$fxn=$_REQUEST["fxn"];

if($fxn=='regForm'){
	$adminName="";
	$email="";
	$gender="";
	$schoolName="";
	$phone="";
	$emaillist=array();
	$state="";
	$location="";
	
	if(isset($_REQUEST['name'])) $adminName=$_REQUEST['name'];
	if(isset($_REQUEST['email'])) $email=$_REQUEST['email'];
	if(isset($_REQUEST['gender']))$gender=$_REQUEST['gender'];
	if(isset($_REQUEST['schoolName'])) $schoolName=$_REQUEST['schoolName'];
	if(isset($_REQUEST['phone']))$phone=$_REQUEST['phone'];
	if(isset($_REQUEST['state']))$state=$_REQUEST['state'];
	if(isset($_REQUEST['location']))$location=$_REQUEST['location'];
	
	$mail=array("email");
	$field=array("email");
	$value=array($email);
	
	
	$ok=mysqli_query($conn,SQLretrieve('school_admin',$field,$mail,$value));
	
	while($v=mysqli_fetch_array($ok)){
		$emaillist=$v;
	}
	
	register_school_admin($adminName,$email,$gender,$phone,$schoolName,$emaillist,$state,$location);

}elseif($fxn=='loadlocation'){
	$state='';
	if(isset($_REQUEST['state'])) $state=$_REQUEST['state'];
	$local='';
	if(isset($_SESSION['schlid'])){
		$fields=array();
		$flagfields=array('schlid');
		$flagvalues=array($_SESSION['schlid']);
		$ok=mysqli_query($conn,SQLretrieve('school',$fields,$flagfields,$flagvalues));
		if($ok!=false){
			
			if($val=mysqli_fetch_array($ok)){
				$local=$val['location'];
			}
		}
	}

	loadlocation($state,$local);
}elseif($fxn=='validateStudent1'){
	#write a function that validates the student information before loading the page below
	$studid='';
	$schlid='';
	$curterm='';
	$curclass='';
	$pin='';
	
	if(isset($_REQUEST['studid'])) $studid=mysqli_escape_string($conn,$_REQUEST['studid']);
	if(isset($_REQUEST['schlid'])) $schlid=mysqli_escape_string($conn,$_REQUEST['schlid']);
	if(isset($_REQUEST['curclass'])) $curclass=mysqli_escape_string($conn,$_REQUEST['curclass']);
	if(isset($_REQUEST['pin'])) $pin=mysqli_escape_string($conn,$_REQUEST['pin']);
	if(isset($_REQUEST['curterm'])) $curterm=mysqli_escape_string($conn,$_REQUEST['curterm']);
	
	$studentdetails=array();
	
/*	if(strtolower($class)=='prospects'){
		#search the prospectlist table for valid prospect info.
		$fields=array();
		$flagfields=array('schlid','id');
		$flagvalues=array($schlid,$studid);
		$ok=mysqli_query($conn,SQLretrieve('prospectlist',$fields,$flagfields,$flagvalues));
		
		if(mysqli_affected_rows($conn)>0){
			#echo "prospects";
			$val=mysqli_fetch_array($ok);
			
			$prospectdetails=$val;
			include("../link-files/cbt_page_2.php");
		}else{
			echo '<p class=\'alert alert-danger\'>Invalid prospect id, <br> please confirm your id and re-enter.</p>';
			include("../link-files/cbt_page_1.php");
		}
	}else{*/
		#search the student table for valid student info.	
	$outcome=studentCBTAccess($schlid,$studid,$pin,$curclass,$curterm);
	  #echo "$outcome - <br>";
	  if($outcome=='ok'){
		  $fields=array();
		  $flagfields=array('schlid','studid');
		  $flagvalues=array($schlid,$studid);
		  $ok=mysqli_query($conn,SQLretrieve('student',$fields,$flagfields,$flagvalues));
		  
		  if(mysqli_affected_rows($conn)>0){
		  #echo "student";
			  $val=mysqli_fetch_array($ok);
			  
			  $studentdetails=$val;
			  include("../link-files/cbt_page_2.php");
		  }
	  }else{
		  echo $outcome;
		  #echo '<p class=\'alert alert-danger\'>Invalid student id, <br> please confirm your id and re-enter.</p>';
		include("../link-files/cbt_page_1.php");
	  }

}elseif($fxn=='validateStudent2'){#for prospects
	#write a function that validates the student information before loading the page below
	$studid='';
	$schlid='';
	$pin='';
	
	if(isset($_REQUEST['studid'])) $studid=mysqli_escape_string($conn,$_REQUEST['studid']);
	if(isset($_REQUEST['schlid'])) $schlid=mysqli_escape_string($conn,$_REQUEST['schlid']);
	if(isset($_REQUEST['pin'])) $pin=mysqli_escape_string($conn,$_REQUEST['pin']);
	
	$prospectdetails=array();
	
	#
	$outcome=prospectCBTAccess($schlid,$studid,$pin);
	  if($outcome=='ok'){
		  $fields=array();
		  $flagfields=array('schlid','id');
		  $flagvalues=array($schlid,$studid);
		  $ok=mysqli_query($conn,SQLretrieve('prospectlist',$fields,$flagfields,$flagvalues));
		  
		  if(mysqli_affected_rows($conn)>0){
		  #echo "student";
			  $val=mysqli_fetch_array($ok);
			  
			  $prospectdetails=$val;
			  include("../link-files/cbt_page_2.php");
		  }
	  }else{
		  echo $outcome;
		include("../link-files/cbt_page_1.php");
	  }
	/*if(strtolower($class)=='prospects'){
		#search the prospectlist table for valid prospect info.
		$fields=array();
		$flagfields=array('schlid','id');
		$flagvalues=array($schlid,$studid);
		$ok=mysqli_query($conn,SQLretrieve('prospectlist',$fields,$flagfields,$flagvalues));
		
		if(mysqli_affected_rows($conn)>0){
			#echo "prospects";
			$val=mysqli_fetch_array($ok);
			
			$prospectdetails=$val;
			include("../link-files/cbt_page_2.php");
		}else{
			echo '<p class=\'alert alert-danger\'>Invalid prospect id, <br> please confirm your id and re-enter.</p>';
			include("../link-files/cbt_page_1.php");
		}
	}*/
	#include("../link-files/cbt_page_2.php");#this is subject to be modified to this include("link-files/cbt_page_2.php") when included in the indexscript
}elseif($fxn=='validateTestAccess'){
	$studid='';
	$schlid='';
	$testid='';
	
	if(isset($_REQUEST['studid'])) $studid=mysqli_escape_string($conn,$_REQUEST['studid']);
	if(isset($_REQUEST['schlid'])) $schlid=mysqli_escape_string($conn,$_REQUEST['schlid']);
	if(isset($_REQUEST['testid'])) $testid=mysqli_escape_string($conn,$_REQUEST['testid']);
	
	echo loadTestResult($schlid,$studid,$testid);
/*}elseif($fxn=="startTest"){
	include("../link-files/cbt_page_4.php");*/
}elseif($fxn=="finishTest"){
	include("../link-files/cbt_finish_page.php");
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
	$schlid='';
	if(isset($_REQUEST['testid']))$testID=mysqli_escape_string($conn,$_REQUEST['testid']);
	if(isset($_REQUEST['schlid']))$schlid=mysqli_escape_string($conn,$_REQUEST['schlid']);
	
	$QIndex=array();
	//echo "$schlid - $testID - {$_SESSION['testID']}<br>";
	$questions=loadTest_start($schlid,$_SESSION['testID']);
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
	
	displayQuestion_student($_SESSION['curQ'],$_SESSION['Question'],$_SESSION['QIndex']);
}else{
	echo "<h3 align=\"center\">Sorry no question <br>currently available in the selected test.</h3>";
}
	
}elseif($fxn=='loadtime'){
	$_SESSION['testDuration']=questionTimer($_SESSION['testDuration']);
}elseif($fxn=='loadtimeforstudent'){
	$_SESSION['testDuration']=questionTimer($_SESSION['testDuration']);
}elseif($fxn=='calltermination'){
	//else{
		#call termination function 
		#computeTotalScore();
/*		$testscore=computeTotalScore();
		updateTestResult($schlid,$studid,$testid,$testscore);*/
	
}elseif($fxn=='nextQuestion'){
	#get previous quesrion score
	#increase current record id
	#dusplay qyestion
	$score='';
	$details='';
	
	if(isset($_REQUEST['score']))$score=mysqli_escape_string($conn,$_REQUEST['score']);
	if(isset($_REQUEST['details']))$details=mysqli_escape_string($conn,$_REQUEST['details']);
	
	$ok=explode(',',$details);
	$schlid=$ok[0];
	$studid=$ok[1];
	$testid=$ok[2];
	
	$_SESSION['score']=$_SESSION['score']+$score;
	
	$_SESSION['curQ']++;
	
	#echo "{$_SESSION['curQ']} <= {$_SESSION['availableQ']}<br>";
	if($_SESSION['curQ']<=$_SESSION['availableQ']){
		displayQuestion_student($_SESSION['curQ'],$_SESSION['Question'],$_SESSION['QIndex']);
	}else{
		/*$testscore=computeTotalScore();
		updateTestResult($schlid,$studid,$testid,$testscore);*/
		//echo "<h3 align=\"center\">Computing score ....</h3>";
		echo "Computing score ....";
	}
}
?>