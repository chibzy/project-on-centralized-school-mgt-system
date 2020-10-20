<?php
require_once("connect.php");
connectdb();

function activationMail($sn,$adminID,$psw,$link,$name,$schoolname){

$body=<<<EOD
<h3 style="background-color:#f3f; color:#fff;">Hi $name,</h3>
<p>You created an account on ppseducation.com.ng and
you are required to activate your account using this<br /><br/>
$link link.
<br/><br/>
    </p>
    <p>
    Note: after activation, you can login to your account using the following information
    Schoolname : $schoolname<br />
    <b>AdminID :</b> $adminID<br />
    <b>Password:</b> $psw<br />
    </p>
    
    <p>Thanks for registering with ppseducation.com.ng</p>
    
    <p>Neglect this message if you neither registered with ppseducation.com.ng 
    nor requested for registration through a friend.</p>
	
EOD;
$result=<<<EOT
<html>
<head>
<title>PPSEDUCATION: Your online post primary school education center.</title>
</head>
<body>
$body
</body>
</html>
EOT;
     return $result;
}

function generateAdminID($schlid){
	$newPassword="";
	
	$year=date('Y');
	$month=date('m');
	$day=date('d');
	$all=array(0=>'g','h','I','2','3','L','4','n','O','1');
	$seg="";
	$nMonthday="";
	
	$sno='';
	$ok=0;
	while($ok<=5){
		$sno.=mt_rand(1,30);
		
		if(strlen($sno)>=5){
			break;
		}
		$ok++;
	}
	for($i=0;$i<strlen($sno);$i++){
		$newPassword.=$all[$sno[$i]];
	}
	return $schlid.'/'.$newPassword;
}


function no_of_registered_school($schoolList){
		$no=$schoolList;
		if ($no<1){
			$no=12;#if no registered school set value to 12.
		}
	return "<span class=\"no_of_school\"><span class=\"no_of_school-cover\"><span class=\"circle-highlight\">$no</span></span> 
	<span class=\"writings\">schools currently registered. To enjoy the services, </span>";
}
function register_school_admin($name,$email,$gender,$phone,$school,$emailList,$state,$location){
	global $conn;
	if($name!=''){
		if($email!=''){
			if(preg_match('/@/i',$email)){#rework later
				
				#write a script to validate if email address has been used before.				
				$isPresent=false;
				for($i=0;$i<count($emailList);$i++){
					if(strtolower($email)==strtolower($emailList[$i])){
						$isPresent=true;
						break;
					}
				}
				if($isPresent!=true){
					
				if($gender!=''){
					if($phone!=""){
						if($school!=''){
							
							#store information on the database
							$valuelist=array(
											$name,
											$email,
											$gender,
											$phone,
											$school
							);
							$fieldlist=array(
											'name',
											'email',
											'gender',
											'phone',
											'schoolName'
							);
							
							if (SQLinsert($valuelist,$fieldlist,'school_admin',"","")!='field and value list mismatch') @mysqli_query($conn,SQLinsert($valuelist,$fieldlist,'school_admin',"",""));
							#retrieve the sn of the newly registered row, hash it (encrypt it) and use it to send mail.
							$fields=array('sn');
							$flagfields=array('email');
							$flagvalues=array($email);
							$sn="";
							
	/*						$ok=mysqli_query($conn,SQLretrieve('school_admin',$fields,$flagfields,$flagvalues));
							
							if($ok!=false){
								$exSn=mysqli_fetch_array($ok);
								$sn=$exSn['sn'];
							}*/
							#echo "$sn is the sn value of $email";
							
							#send an email to the user email address

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

							$message=prepareMail($sn,$state,$location,$name,$school);
							#if(mail($email,"Account Activation form ppseducation.com.ng",$message,$headers)==true){#automate location n state.
#							mail($email,'Account Activation form ppseducation.com.ng','Hi can u see this?');
mail($email,"Account Activation form ppseducation.com.ng",$message,$headers);
#echo "<div class=\"alert alert-info\">Account created successfully, <div class=\"text-error\">Check your email to activate your account.</div></div>";
						/*}else{
echo "<div class=\"alert alert-error\">Your email to address may be wrong.</div>";
}	*/
						}else{
							echo "<div class=\"alert alert-danger\">Your school name, state, and location is required</div>";
						}
					}else{
						echo "<div class=\"alert alert-danger\">Your phone number is required</div>";
					}
				}else{
					echo "<div class=\"alert alert-danger\">Select your gender</div>";
				}
				
				}else{
					echo "<div class=\"alert alert-danger\">Email address already used by another.</div>";
				}
				
			}else{
				echo "<div class=\"alert alert-danger\">Enter a valid email address</div>";
			}
		}else{
			echo "<div class=\"alert alert-danger\">Your email address is required</div>";
		}
	}else{
		echo "<div class=\"alert alert-danger\">Your name is required</div>";
	}
}
function prepare_check_result_link($schlid,$studID,$curclass,$curterm){
$link="";
$plaintext="$schlid:$studID:$curclass:$curterm:checksum";
$data=encrypt($plaintext);

$hash=hash_hmac('sha256',$data,$_SESSION['encryption-key']);
$urlData="data=$data&hash=$hash";

$link="?$urlData";
#"?schlid=$schlid&studID=$studID&curclass=$curclass&curterm=$curterm";

return $link;
}
function prepare_write_test_link($schlid,$studid,$testid){
$link="";	
$plaintext="$schlid:$studid:$testid:checksum";

$data=encrypt($plaintext);

$hash=hash_hmac('sha256',$data,$_SESSION['encryption-key']);
$urlData="data=$data&hash=$hash";

$link="test.php?$urlData";

return $link;
}
function prepareMail($sn,$state,$location,$name,$schoolname){
	#get sn
	#generate schlid
	$schlid=generateSchlID($state,$location);
	#generate adminID
	$adminID=generateAdminID($schlid);
	#generate psw
	$psw=scramblePassword();
	#encrypt them and send link to user email.
	$plainText="$sn:$adminID:$schlid:$psw:$state:$location:checksum"; #the checksum string used by me to prevent decryption error that is associated with the last value in the data. 
	$data=encrypt($plainText);
	
	$hash=hash_hmac('sha256',$data,$_SESSION['encryption-key']);
	$urlData = "data=$data&hash=$hash";
	
$link="<a href='http://www.ppseducation.com.ng/activation.php?id=$data&hash=$hash'>Activation</a>"; #activate line during production
	
	return activationMail($sn,$adminID,$psw,$link,$name,$schoolname);
	
}
function login($schoolID,$adminID,$psw){
	global $conn;
	$email=mysqli_real_escape_string($conn,$adminID);
	$psw=mysqli_real_escape_string($conn,$psw);
	
	global $loginMsg;
	#echo "$email - $psw<br>";
	if($schoolID!=""){
		#convert schoolname to id
		
		if($adminID!=''){
			
			if($psw!=''){
				
				#hash the password
				
				$field=array('name','email','gender','schlid','schoolName','adminID','phone','password');
				$flagfields=array('schlid','adminID','password','activation_status');
				$flagvalues=array($schoolID,$adminID,$psw,'on');
				#echo "$schoolID,$adminID,$psw";
				$ok=@mysqli_query($conn,SQLretrieve('school_admin',$field,$flagfields,$flagvalues));
				
				
				if($ok!=false){
					while($v=@mysqli_fetch_array($ok)){
						$details=$v;
					}
					if(!empty($details)){
						#set session variables
						$_SESSION['adminName']=$details['name'];
						$_SESSION['email']=$details['email'];
						$_SESSION['gender']=$details['gender'];
						$_SESSION['schlid']=$details['schlid'];
						$_SESSION['schoolName']=$details['schoolName'];
						$_SESSION['adminID']=$details['adminID'];
						$_SESSION['phone']=$details['phone'];
						$_SESSION['psw']=$details['password'];
						#echo "{$_SESSION['schlid']} - school id";
						header("location:admindashboard.php");
						#$isLogin=true;
					}else{
						$loginMsg="<div class=\"alert alert-error\">Incorrect user info.</div>";
					}
				}else{
					$loginMsg="<div class=\"alert alert-error\">Invalid user info.</div>";
				}
				
			}else{
		$loginMsg="<div class=\"alert alert-error\">Password field can't be empty </div>";
			}
		}else{
		$loginMsg="<div class=\"alert alert-error\">Admin ID can't be empty.</div>";
		}
	}else{
		$loginMsg="<div class=\"alert alert-error\">Select a valid school </div>";
	}
}
function getSchools($tablename){
	global $conn;
	$fields=array();
	$flagfields=array();
	$flagvalues=array();
	$ok=@mysqli_query($conn,SQLretrieve($tablename,$fields,$flagfields,$flagvalues));
	
	$schools=array();
	$i=1;
	if($ok!=false){
		while($v=mysqli_fetch_array($ok)){
			$schools[$i]=$v;
			$i++;
		}
	}
	return $schools;
}
function getSchoolForControl(){
	
	$schools=array();
	
	$schools=getSchools('school');
	#remeber to sort the output alphabetically
	$i=count($schools);
	while($i>0){
		$schlid=$schools[$i]['schlid'];
		$schlname=$schools[$i]['schlName'];
		$schladdr=$schools[$i]['address'];
		$schladmin=$schools[$i]['admin'];
		
		if($schladmin!=''){
			echo "<option value=\"$schlid\">$schlname of $schladdr</option>";
		}
		$i--;
	}
}
function getSchoolDetails($schlid){
	$schools=array();
	
	$schools=getSchools('school');
	#remeber to sort the output alphabetically
	$i=count($schools);
	$schldetails=array();
	
	while($i>0){
		
		if($schlid==$schools[$i]['schlid']){
			$schldetails=$schools[$i];
			break;
		}
		$i--;
	}
	return $schldetails;
}
function getSchoolForSearch($letter){
	$schools=array();
	
	$schools=getSchools('school');
	#remember to sort the output alphabetically
	
	$i=count($schools);

	echo "<ul>";
	while($i>0){
		$schlname=$schools[$i]['schlName'];
		$schladdr=$schools[$i]['address'];
		$schladmin=$schools[$i]['admin'];
		$complete="$schlname of $schladdr";
		if($schladmin!=''){
			if(preg_match("/$letter/i",$complete)>0){
				echo "<li class=\"selectme\">$schlname of $schladdr</li>";
			}
		}
		$i--;
	}
	echo "</ul>";
}
function searchSchool($school){
	$schlname="";
	$schladdr="";
	$schlDB=array();
	$schlid="";
	$isPresent=false;
	global $conn;
	
	if($school!=''){
		$school=@mysqli_real_escape_string($conn,$school);
		
		$part=explode('of',$school);
		
		if(count($part)>0 && count($part)<=2){
			$schlname=trim($part[0]);
			$schladdr=trim($part[1]);
						#echo "entered first<br>";
			if(isset($schlname) && isset($schladdr)){
				#search for the existence of name and address with the neccessary info.
				
				$schlDB=getSchools('school');
				$i=count($schlDB);
				#echo "entered option 1<br>";
				while($i>0){			
					#echo "{$schlDB[$i]['schlName']} - - {$schlDB[$i]['schlid']}<br>";		
					if($schlDB[$i]['schlName']==$schlname && $schlDB[$i]['address']==$schladdr){
						$isPresent=true;
						$schlid=$schlDB[$i]['schlid'];
						break;
					}
					$i--;
				}
			}
		}
		if($isPresent=true){
			header("location:index.php?id=$schlid");
			
		}
	}
}
function load_elligible_student_account_details($schlid,$adminYr){
	global $conn,$studid;
	$availcbt=array();
	$msg='';
	
	$testList=determinecbtpubstatus($schlid,$adminYr);
	if($testList!='No published test'){
		#echo "entered<br>";
		$i=0;
		$j=0;
		while($j<count($testList)){
			#echo "entered 2<br>";
			$testid=$testList[$j][3]; #test the content pf test_titile_id
			$premuim_status=$testList[$j][10];
			if($premuim_status==''){#test for available free version to load instantly
				#echo "entered 3<br>";
				$availcbt[$i]=$testList[$j];
				$i++;
			}else{
				#echo "entered 4<br>";
				$fields=array();
				$flagfields=array('schlid','access_code');
				$flagvalues=array($schlid,$premuim_status);
				
				$ok=@mysqli_query($conn,SQLretrieve('premuim_cbt_access_code',$fields,$flagfields,$flagvalues));
				if(@mysqli_affected_rows($conn)>0){
					#echo "entered 5<br>";
					if($val=@mysqli_fetch_array($ok)){
						#check expiration date, and check if content is in access_usage, if yes, update availcbt;
						if(date('d/m/Y')<$val['expiration_date']){
							$all=explode(':',$val['access_usage']);
					#		echo count($all).'<br>';
							if(in_array($testid,$all)){
								$availcbt[$i]=$testList[$j];
								$i++;
							}
						}
					}
				}else{
					#echo "entered 6<br>";
					$msg='<p class=\"alert alert-info\">Test can not be display.</p>';
				}
				
				
			}
			$j++;
		}
		#if($msg!='Test can not display.'){
			$msg=liststudAvailableTest($availcbt);
		#}
	}else{
		$msg="<p class=\"alert alert-info\">$testList</p>";
	}
	return $msg;
}
function liststudAvailableTest($list){
	global $studid;
	if(isset($list)){
		$total=count($list);
		#echo "$total<br>";
		for($i=0;$i<$total;$i++){
			#echo "loadStudenttestresult('{$list[$i][1]}','$studid','{$list[$i][3]}')<br>";
			$url=prepare_write_test_link($list[$i][1],$studid,$list[$i][3]);
			?>
			<input type="hidden" id="url<?php echo $i;?>" value="<?php echo $url;?>">
			<?php
            
			?>
            <p style="font-size:16px; font-family:Cuprum; border-bottom:thin #F00 solid; padding: 0px 5px 10px 5px;"><?php echo $list[$i][2];?> <span style="cursor:pointer;" data-toggle="modal" data-target="#myPinValidation" onClick='loadStudenttestresult(<?php echo "\"{$list[$i][1]}\",\"$studid\",\"{$list[$i][3]}\"";?>);' class="btn-link"> View Result </span> | <span style="cursor:pointer;" onClick='validateTestAccess(<?php echo $i; ?>);' class="btn-link"> Take Test </span><br /><span style="font-size:11px; color:#666;"><span><?php echo $list[$i][9];?></span> | <span>Created on <?php echo $list[$i][13];?></span> | <span><?php echo "Test duration : {$list[$i][5]} mins.";?></span></span></p>
            <?php
		}
	}
}
function getTestName($id){
	global $conn,$schlid;
	$fields=array();
	$flagfields=array('schlid','test_title_id');
	$flagvalues=array($schlid,$id);
	$msg='';
	
	$ok=@mysqli_query($conn,SQLretrieve('testproperty',$fields,$flagfields,$flagvalues));
	if(@mysqli_affected_rows($conn)>0){
		if($val=@mysqli_fetch_array($ok)){
			$msg=$val['test_title'];
		}
	}
	return $msg;
}
function getStudNameforTestResult($id){
	global $conn,$schlid;
	$fields=array();
	$flagfields=array('schlid','studID');
	$flagvalues=array($schlid,$id);
	$msg='';
	
	$ok=@mysqli_query($conn,SQLretrieve('student',$fields,$flagfields,$flagvalues));
	if(@mysqli_affected_rows($conn)>0){
		if($val=@mysqli_fetch_array($ok)){
			$msg=$val['name'];
		}
	}else{#search the propects table
		$fields=array();
		$flagfields=array('schlid','id');
		$flagvalues=array($schlid,$id);
		$msg='';
		
		$ok=@mysqli_query($conn,SQLretrieve('prospectlist',$fields,$flagfields,$flagvalues));
		if(@mysqli_affected_rows($conn)>0){
			if(@$val=mysqli_fetch_array($ok)){
				$msg=$val['name'];
			}
		}
	}
	return $msg;
}
function loadTestResult($schlid,$studid,$testid){
	global $conn;
	$fields=array();
	$flagfields=array('schlid','stud_id','testid');
	$flagvalues=array($schlid,$studid,$testid);
	$msg='';
	
	$ok=mysqli_query($conn,SQLretrieve('teststudent',$fields,$flagfields,$flagvalues));
	if(@mysqli_affected_rows($conn)>0){
		if($val=@mysqli_fetch_array($ok)){
			$testname=getTestName($val[4]);
			$studname=getStudNameforTestResult($val[2]);
			$score=$val[5];
			$tdate=$val[3];
			$nooftrials=$val[6];
			
			$msg="<div style=\"text-align:center; line-height:30px; font-size:20px;\">
            	<p>Test score of $studname<br> <span style=\"font-family:Cuprum;font-size:24px;\">in $testname ($testid) is </span><br />
                <span style=\"font-size:20px; color:#f00;\">$score%</span><br />
                <span style=\"color:blue; font-size:14px;\">test taken on $tdate</span>
                
            </div>
            ";
			
		}
	}else{
		$msg="<p class=\"alert alert-info\">No available result.</p>";
	}
	return $msg;
}

function determinecbtpubstatus($schlid,$adminYr){
	global $conn;
	$fields=array();
	$flagfields=array('schlid','designated_class','publish_status');
	$flagvalues=array($schlid,$adminYr,'on');
	$msg='';
	
	$ok=@mysqli_query($conn,SQLretrieve('testproperty',$fields,$flagfields,$flagvalues));
	if(@mysqli_affected_rows($conn)>0){
		$all_published=array();
		$i=0;
		while($val=@mysqli_fetch_array($ok)){
			$all_published[$i]=$val;
			$i++;
		}
		$msg=$all_published;
	}else{
		$msg='No published test';
	}
	return $msg;
}
function SQLinsert($valuelist,$fieldList,$tableName,$flagField,$flagValue){
	
	global $conn;
	if(count($valuelist)!=count($fieldList)){
		$err="field and value list mismatch";
		return $err;
	}else{
		#organize value for use.
		$fields="";
		$values="";
		
		for($i=0;$i<count($valuelist);$i++){
			if((count($valuelist)-1)-$i!=0){
				$fields.=$fieldList[$i].",";
				$values.="'".mysqli_real_escape_string($conn,$valuelist[$i])."',";
			}else{
				$fields.=$fieldList[$i];
				$values.="'".mysqli_real_escape_string($conn,$valuelist[$i])."'";
			}
		}
		if($flagField=="" && $flagValue==""){
			$sqlStatement="insert into $tableName($fields) values($values)";
		}else{
			$sqlStatement="insert into $tableName($fields) values($values) where $flagField='$flagValue'";
		}
		#echo "<br><b>$sqlStatement</b><br>";
		return $sqlStatement;
	}
	
}
function SQLretrieve($tablename,$fields,$flagfields,$flagvalues){
	#check if the flags are array
	$statement="";
	if(count($flagvalues)!=count($flagfields)){
		$err="field and value list mismatch";
		return $err;
	}else{
		if(count($flagfields)!=0){
			for($i=0;$i<count($flagfields);$i++){
				if((count($flagfields)-1)-$i!=0){
				$statement.="{$flagfields[$i]}='{$flagvalues[$i]}'  and ";
				}else{
					$statement.="{$flagfields[$i]}='{$flagvalues[$i]}'";
				}
			}
			
		}else{
			$statement="";
		}
		#spread the fields
		$spread="";
		if(count($fields)!=0){
			for($j=0;$j<count($fields);$j++){
				#if((count($flagfields)-1)-$j!=0){
				if((count($fields)-1)-$j!=0){
					$spread.="{$fields[$j]},";
				}else{
					$spread.="{$fields[$j]}";
				}
				#echo $spread." spread <br>";
			}
		}else{
			$spread="*";
		}
		
		#form the statement
		if($statement!=''){
			$sqlstatement="select $spread from $tablename where $statement";
			#echo "$sqlstatement<br>";
		}else{
			$sqlstatement="select $spread from $tablename";
			#echo "$sqlstatement<br>";
		}
		#echo $sqlstatement."<br>";
		return $sqlstatement;
	}
}
function getDomainname(){
	$url=$_SERVER['REQUEST_URI'];
	#echo $url;
	$page=explode('/', $url);
	if (count($page)>0) return $page[1];
}
function classPopulation($admissionYear,$level,$schlid){
	#ensure the admission year is between 7yr from the current year
	#check if there are people in that level using the school id.
	$curYear=date('Y');
	$lastYear=$curYear-6;
	$no="";
	$val="";
	$ok=array();
	global $conn;
	if($admissionYear<=$curYear && $admissionYear>=$lastYear){
		#echo "$curYear : <br>$lastYear :";
		$fields=array('session_1','session_2','session_3','session_4','session_5','session_6');
		$flagfields=array('schlid','class_id');
		$flagvalues=array($schlid,$admissionYear);
		
		$val=@mysqli_query($conn,SQLretrieve('student',$fields,$flagfields,$flagvalues));
		
		if($val!=false){
			#echo "first test <br>";
			$no=0;
			while($ok=@mysqli_fetch_array($val)){
				#echo "second test <br>";
				if($ok[$fields[$level-1]]==1){
					$no++;
				}
			}
		}
	}
	return $no;
}
function orderAccessPin($schlid,$email,$qty,$qty_cost,$shipmentMethod,$shippmentCost,$totalCost,$orderID){
	#validate the content of the requirements,
	#get the shippment cost table,
	#get the accesspin cost table
	#Determine the shipment method, if the shippment method is "send pins only", get the admins email,schid,access pin cost, total cost and save to database
	#if the shipment method is "Send pin in finished form",
	#get the school location, admin email, qty, pin cost, total cost and send to database.
	
	global $conn;
	
	if($schlid!='' && $email!='' && $qty!='' && $shipmentMethod!=''){
		#check if order id already exist in the database
		
		$field=array();
		$flagfield=array('orderID');
		$flagvalue=array($orderID);
		
		$table=@mysqli_query($conn,SQLretrieve('ordered_access_pin',$field,$flagfield,$flagvalue));
		if($table!=false){
			if($v=@mysqli_fetch_array($table)){
				$msg="<span class='alert alert-info'>Order already placed.</span>";
			}else{
				$orderDate=date("d-m-Y");
				#insert record into new the accesspin order table.
				$valuelist=array(
									"$email",
									"$schlid",
									"$orderID",
									"$qty",
									"$qty_cost",
									"$shipmentMethod",
									"$shippmentCost",
									"$totalCost",
									"$orderDate",
									"on"
								);
				$fieldlist=array(
									"adminEmail",
									"schoolID",
									"orderID",
									"Qty",
									"Qty_cost",
									"Shippment_method",
									"Shippment_cost",
									"Total_cost",
									"order_date",
									"user_enabled"
								);
				#echo SQLinsert($valuelist,$fieldlist,'access_pin_order','','');				
				@mysqli_query($conn,SQLinsert($valuelist,$fieldlist,'ordered_access_pin','',''));
				$msg="<span class='alert alert-success'>access pin Order successfully completed</span>";
			}
	}
		
		
	}else{
		$msg="<span class='alert alert-error'>One of the arguments is empty</span>";
	}
	return $msg;
}
function createOrderID($in){
	$id=$in.date("ymdHi");
	return $id;
}
function calculateOrderCost($qty,$shippmentMethod,$location,$state){
	#validate the content of the requirements,
	#get the shippment cost table,
	#get the accesspin cost table
	#match the content and generate the result based on prices on the database.
	$fields=array();
	$flagfield=array();
	$flagvalue=array();
	
	global $conn;
	
	$shippmentCostTable=array();
	$accesspinCostTable=array();
	
	$msg="";
	$accesspincost="";
	$shippmentCost="";
	
	
	$qty=@mysqli_real_escape_string($conn,$qty);
	if($qty==''){
		$msg="Select a valid quantity";
	}else{
		if($shippmentMethod!="Send pins only"){
			#get shipment list
			$fields=array(
							"location",
							"state",
							"region",
							"Cost"
						);
			$flagfield=array("location","state");
			$flagvalue=array($location,$state);
			
			$ok=@mysqli_query($conn,SQLretrieve('shippment_cost',$fields,$flagfield,$flagvalue));
			if($ok!=false){
				
				$countOfShippment=1;
				
				while($val=@mysqli_fetch_array($ok)){
					$shippmentCostTable=$val;
					
				}
				
			}
			#get accesspin cost list
			
			$fields=array("Qty","cost","status");
			$flagfield=array("Qty","status");
			$flagvalue=array($qty,"on");
			
			$ok=@mysqli_query($conn,SQLretrieve('accesspin_cost',$fields,$flagfield,$flagvalue));
			
			if($ok!=false){
				while($sval=@mysqli_fetch_array($ok)){
					$accesspinCostTable=$sval;
				}
			}
			#get shippmentcost
			if($shippmentCostTable['state']==$state && $shippmentCostTable['location']==$location){
					$shippmentCost=$shippmentCostTable['Cost'];
			
			}
			
			#get accespin cost
			if($accesspinCostTable["Qty"]==$qty){
					$accesspincost=$accesspinCostTable['cost']+(0.2*$accesspinCostTable['cost']);
			}
			
			$totalcost=$shippmentCost+$accesspincost;
			$msg="<p align='center'>
					Card cost : <span id=\"cardcost\">$accesspincost</span><br>
					Shippment Cost : <span id=\"shippmentcost\">$shippmentCost</span><br>
					Total Cost : <span id=\"totalcost\">$totalcost</span>
				</p>";
			
		}else{
			#get accesspin cost list
			
			$fields=array("Qty","cost","status");
			$flagfield=array("Qty","status");
			$flagvalue=array($qty,"on");
			
			$ok=mysqli_query($conn,SQLretrieve('accesspin_cost',$fields,$flagfield,$flagvalue));
			
			if($ok!=false){
				while($sval=@mysqli_fetch_array($ok)){
					$accesspinCostTable=$sval;
				}
			}
			#get accespin cost
			if($accesspinCostTable["Qty"]==$qty){
					$accesspincost=$accesspinCostTable['cost'];
			}
			
			$totalcost=$accesspincost;
			$msg="<p align='center'>
					Card cost : <span id=\"cardcost\">$accesspincost</span><br>
					Shippment Cost : <span id=\"shippmentcost\">0</span><br>
					Total Cost : <span id=\"totalcost\">$totalcost</span>
				</p>";
			
		}
		return $msg;
	}
}
function displayPrintClassList($schlid,$clsid,$subclass){
	global $conn;
	$fields=array();
	$flagfields=array("schlid","class_id","subClass");
	$flagvalues=array($schlid,$clsid,$subclass);
	
	$ok=@mysqli_query($conn,SQLretrieve('student',$fields,$flagfields,$flagvalues));
	
	if($ok!=false){
		?>
		<table width="100%" class="table">
        <thead>
        	<tr>
        		<th>Sn</th><th>Name</th><th>Student ID</th><th>Gender</th>
        	</tr>
        </thead>
        <tbody>
		<?php
		$i=1;
		while($val=@mysqli_fetch_array($ok)){
			?>
            <tr>
            	<td><?php echo $i;?></td><td><?php echo $val['name'];?></td><td><?php echo $val['studID'];?></td><td><?php echo $val['gender'];?></td>
            </tr>
            <?php
			$i++;
		}
		?>
		</tbody>
        </table>
		<?php
	}
}
function viewClassList($schlid,$clsid,$subclass){
	global $conn;
	$fields=array();
	$flagfields=array("schlid","class_id","subClass");
	$flagvalues=array($schlid,$clsid,$subclass);
	
	$ok=@mysqli_query($conn,SQLretrieve('student',$fields,$flagfields,$flagvalues));
	?>
    <input type="hidden" name="schlid" id="schlid" value="<?php echo $schlid?>" />
    <input type="hidden" name="clsid" id="clsid" value="<?php echo $clsid?>" />
    <input type="hidden" name="subclass" id="subclass" value="<?php echo $subclass?>" />
            
    <?php
	if($ok!=false){
		?>
		<table width="100%" class="table table-hover">
        <thead>
        	<tr>
        		<th><!--input type="checkbox" name="selectall" id="selectall" /--></th><th>Sn</th><th>Name</th><th>Student ID</th><th>Gender</th><th>Current Class</th>
        	</tr>
        </thead>
        <tbody>
		<?php
		$i=1;
		while($val=@mysqli_fetch_array($ok)){
			?>
            <tr>
            	<td><input type="checkbox" name="<?php echo "chk$i";?>" id="<?php echo "chk$i";?>" /></td><td><?php echo $i;?></td><td><span class="btn-group">
                <a href="#" data-toggle="dropdown" class="btn btn-link remove-underline dropdown-toggle"><h4><?php echo $val['name'];?> <span class="caret"></span></h4></a>
                <ul class="dropdown-menu"  role="menu" aria-labelledby="dlabel">
                    <li>
                    	<div class="sdropdown">
                        <div class="inner"><img src="<?php echo $val['passport']?>"/></div>
                        <!--hr /-->
                        <div class="font" style="display:inline-block;"><b>Parent name :</b> <br /><?php echo $val['parentName']?><br /><b>Phone :</b> <?php echo $val['parentPhone']?>
                        <p><b>Parent Address : </b><br /><span><?php echo $val['parentAddress']?></span></p> 
                        </div>
                        <div class="clear"></div>
                        <button class="btn btn-info btn-small pull-right" onclick="printStudentDetails('<?php echo "{$val['studID']}";?>')"><span class="icon-print"></span> Print</button> 
                        </div>
                    </li>
                </ul>
                </span>
                	<small>	
						<div><?php echo $val['dob'];?><span> admitted in <?php echo $val['class_id'];?> and subclass <?php echo $val['subClass'];?></span></div>
                    </small>
            
            </td><td><input type="hidden" name="sel<?php echo $i;?>" id="sel<?php echo $i;?>" value="<?php echo $val['studID'];?>" /><?php echo $val['studID'];?></td><td><?php echo $val['gender'];?></td>
            <td><?php echo determineStudentCurrentClass($val['studID']);?></td>
            </tr>
            <?php
			$i++;
		}
		?>
		</tbody>
        </table>
        <div><input type="hidden" name="total" id="total" value="<?php echo $i;?>" /></div>
        <div class="btn-group">
        	<button class="btn btn-info" onclick="allSelected('promote');"><span class="icon icon-edit"></span> Promote</button><button class="btn btn-info" onclick="allSelected('demote');"><span class="icon icon-edit"></span> Demote</button><button class="btn btn-info" onclick="allSelected('remove');"><span class="icon icon-remove"></span> Remove</button><button class="btn btn-info" data-toggle="modal" data-target="#createNewClass"><span class="icon icon-user"></span> Addnew</button>
        </div>
		<?php
	}
}
function determineStudentCurrentClass($studID){
	global $conn;
	$curClass=6;
	$fields=array(
					"session_1",
					"session_2",
					"session_3",
					"session_4",
					"session_5",
					"session_6",
					);
	$flagfields=array("studID");
	$flagvalue=array($studID);
	
	
	$ok=@mysqli_query($conn,SQLretrieve('student',$fields,$flagfields,$flagvalue));
	if($ok!=false){
		if($val=@mysqli_fetch_array($ok)){
			$i=count($val)/2; #The two is because the newly assigned array considers the title columns as part of the array and so includes them in its counting.
			while($val[$i-1]==0){
				$i--;
				$curClass=$i;
				
			}
		}
		
	}
	
	return "level $curClass";
}
function promoteStudent($studID){
	global $conn;
	$msg="";
	$curlevel=explode(" ",determineStudentCurrentClass($studID));
	$curlevel=trim($curlevel[1]);
	$nxtlevel=$curlevel+1;
	if($nxtlevel<=6){
		$sql="update student set session_$nxtlevel=1 where studID=$studID";
		@mysqli_query($conn,$sql);
		$msg="done";
	}else{
		$msg="Student promotion limit is exceeded";	
	}
	return $msg;
}
function demoteStudent($studID){
	global $conn;
	$msg="";
	$curlevel=explode(" ",determineStudentCurrentClass($studID));
	$curlevel=$curlevel[1];
	$prevlevel=trim($curlevel);
	if($prevlevel>=1){
		$sql="update student set session_$prevlevel=0 where studID=$studID";
		#echo "<br>$sql<br>";
		@mysqli_query($conn,$sql);
		$msg="done";
	}else{
		$msg="Student demotion limit is exceeded";	
	}
	return $msg;
}
function removeStudent($studID){
	#to remove student is to remove its name and all other record of the student in the school
	#the records include
	#the ones in student table, and it picture files
	#and the ones in result table
	global $conn;
	
	$msg="";
	$field=array('passport');
	$flagfields=array('studID');
	$flagvalues=array($studID);
	
	$passportFile=@mysqli_query($conn,SQLretrieve("student",$field,$flagfields,$flagvalues));
	
	if($passportFile!=false){
		$val=@mysqli_fetch_array($passportFile);
		#sql to removes record from student table
		$sql="delete from student where studID=$studID";
		#sql to remove records from result table
		$rsql="delete from result where studID=$studID";
		
		#execute actions
		@mysqli_query($conn,$sql);
		@mysqli_query($conn,$rsql);
		$msg=removeFile($val[0]);
	}
	return $msg;
}
function removeClass($admYear,$schlid){
	#to remove a class is to clear its students and their result, not removal of class name
	#but must come after series of confirmation and warning.
	#it should get the number of student in the
	global $conn;
	$msg="";
	$field=array('passport','studID');
	$flagfields=array('class_id','schlid');
	$flagvalues=array($admYear,$schlid);
	
	$passportFile=@mysqli_query($conn,SQLretrieve("student",$field,$flagfields,$flagvalues));
	
	if($passportFile!=false){
		while ($val=@mysqli_fetch_array($passportFile)){
			$studID=$val['studID'];
			
			#sql to removes record from student table
			$sql="delete from student where studID=$studID";
			#sql to remove records from result table
			$rsql="delete from result where studID=$studID";
			
			#execute actions
			@mysqli_query($conn,$sql);
			@mysqli_query($conn,$rsql);
			$msg=removeFile($val[0]);//remove passport
		}
	}
	return $msg;
}
function removeFile($name){
	$msg="";
	if($name!=""){
		$path=explode("/",$name);
		$filename=$path[1];
		$path=$path[0];
		#echo "$filename :: $path";
		chdir('../'.$path);
		
		@unlink($filename);
		
	}	
	$msg="removed";
	return $msg;
}
function loadNewCreateClassForm(){
	$action="";
	$class='';
	$subclass='';
	$pop='';
	$promotion_policy="";
	$schlid=$_SESSION['schlid'];
	$adminID=$_SESSION['adminID'];
	
	global $values,$conn; #declared a global scope variable
	
	if(isset($_REQUEST['class'])) $class=mysqli_real_escape_string($conn,$_REQUEST['class']);
	if(isset($_REQUEST['studsubClass'])) $subclass=mysqli_real_escape_string($conn,$_REQUEST['studsubClass']);
	#if(!is_numeric($subclass) ) $subclass="";
	if(isset($_REQUEST['studPop'])) $pop=mysqli_real_escape_string($conn,$_REQUEST['studPop']);
	if(isset($_REQUEST['action'])) $action=mysqli_real_escape_string($conn,$_REQUEST['action']);
	$admission_year=$class;
	
	#$values=array($pop);
	
	?><div class="school-details"><h3>The student Registration form for <?php echo $class.$subclass?> class.</h3></div><hr /><div class="clear"></div>
    <div class="instruction-box">
The details of the student(s) required for the class are entered here. Enter the student name, date of birth, gender, parent name, phone number, parent address, and students' passport (file size<=20kb and jpeg file format) to register a new student.
Repeat this for the remaining number of students, and click on "upload record" button to register the student.
    </div>
    <?php 
		clickUploadRecords();
		#applyChangesnExit();
	?>
    
	<div style="height:500px; width:100%; font-size:14px; overflow:scroll;">
    <form enctype="multipart/form-data" method="post">
    <input type="hidden" name="class" id="class" value="<?php echo $class;?>" />
    <input type="hidden" name="pop" id="pop" value="<?php echo $pop;?>" />
    <input type="hidden" name="subclass" id="subclass" value="<?php echo $subclass;?>" />
    <input type="hidden" name="promo" id="promo" value="<?php echo $promotion_policy;?>" />
    <input type="hidden" name="schlid" id="schlid" value="<?php echo $schlid;?>" />
    
    <button type="submit" class="btn btn-block" name="btnUpload" id="btnUpload"><span class="icon-upload"></span> Upload record<?php if($pop>1) echo 's';?></button>
    <table class="table table-hover">
	<?php
		
		$values=array();
		$studIDs=generateStudID($_SESSION['schlid'],$class,$pop);
		
		for($i=1;$i<=$pop;$i++){
			?><tr><?php
			?><td><?php echo $i;?></td><?php
			?><td>
			<?php 
				$name="";
				$dob="";
				$gender="";
				$pName="";
				$pPhone="";
				$pAddress="";
				$sPassport='';
				
				if(isset($_POST['stud'.$i]))$name=$_POST['stud'.$i];
				if(isset($_POST['dob'.$i]))$dob=$_POST['dob'.$i];
				if(isset($_POST['gender'.$i]))$gender=$_POST['gender'.$i];
				if(isset($_POST['parentn'.$i]))$pName=$_POST['parentn'.$i];
				if(isset($_POST['parentp'.$i]))$pPhone=$_POST['parentp'.$i];
				if(isset($_POST['address'.$i]))$pAddress=$_POST['address'.$i];
				if(isset($_FILES['passport'.$i]['name']))$sPassport=$_FILES['passport'.$i]['name'];
				#echo "<br> is $sPassport : | {$_FILES['passport'.$i]['name']}<br>";
				
				
				$j=$i-1;
				$values[$j]=array($name,$dob,$gender,$pName,$pPhone,$pAddress,$sPassport);
				echo addnRemoveSingleStudentForm($i,$values,$studIDs);
			
			?>
            </td><?php
			?></tr><?php
		}
	?></table>
    <button type="submit" class="btn btn-block" name="btnUpload" id="btnUpload"><span class="icon-upload"></span> Upload record<?php if($pop>1) echo 's';?></button>
    <button name="btnExitReg" id="btnExitReg" class="btn btn-info btn-block" type="submit"> Exit registration</button>
    </form>
	</div>
	<?php
}
function clickUploadRecords(){
	if(isset($_POST['btnUpload'])){
		$schlid=$_POST['schlid'];
		$subclass=$_POST['subclass'];
		$pop=$_POST['pop'];
		echo uploadRecords($schlid,$subclass,$pop);
	}
}
function uploadRecords($schlid,$subClass,$pop){
	#checks if class already existing, if no create 
	#a new class n upload else add record only.
	#should upload records
	#global $var;
	$msg="";
	$fmsg="";
	$isOk=true;
	global $conn;
	#echo "$schlid,$subClass,$pop<br>";
	#validation of available controls
	for($i=0;$i<$pop;$i++){
		$j=$i+1;
		
		if($_POST["stud$j"]!=""){#test for student name.
			if($_POST["dob$j"]!=""){# && $_POST["$dob$j"]==preg){ put up a match for date pattern here
				
				if(!empty($_POST["gender$j"]) && $_POST["gender$j"]!='Select gender'){#check for gender
					if($_FILES["passport$j"]['name']!='' && $_FILES["passport$j"]['size']<=22000){
						$ext=explode('.',$_FILES["passport$j"]['name']);
						if($ext[1]=='jpg'){
							if(!empty($_POST["parentn$j"])){
								
								if(isset($_POST["parentp$j"]) && is_numeric($_POST["parentp$j"])){
									
									if(!empty($_POST["address$j"])){
										
										#if($_POST['subclass']=='')$_POST['subclass']="No";
										if($subClass=='')$_POST['subclass']="No";
										
										#check if class already existing.
										$fields=array('classid');
										$flagfields=array('schlid','classid','subClass');
										#$flagvalues=array($_POST['schlid'],$_POST['class'],$_POST['subclass']);
										$flagvalues=array($schlid,$_POST['class'],$subClass);
										
										$k=@mysqli_query($conn,SQLretrieve('class',$fields,$flagfields,$flagvalues));
										if($k!=false){
											if($isthere=mysqli_fetch_array($k)){
												
											}else{
												#create a new class.
												
												#$sql="insert into class(schlid,classid,subClass,adminID,admission_year) values('{$_POST['schlid']}','{$_POST['class']}','{$_POST['subclass']}','{$_SESSION['adminID']}','{$_POST['class']}')";
												$sql="insert into class(schlid,classid,subClass,adminID,admission_year) values('$schlid','{$_POST['class']}','$subClass','{$_SESSION['adminID']}','{$_POST['class']}')";
												
												#echo "<br>$sql</br>";
												@mysqli_query($conn,$sql);
												
											}
										}
									}else{
										$msg.="empty parent address in entry $j,<br> ";
										$isOk=false;
									}
								}else{
									$msg.="Invalid or empty parent/guardian phone number in entry $j,<br> ";
									$isOk=false;
								}
							}else{
								$msg.="Empty parent/guardian name in entry $j,<br> ";
								$isOk=false;
							}
							
						}else{
							$msg.='Select a valid student passport format in entry $j,<br>';
							$isOk=false;
						}
					}else{
						$msg.="Select students passport in entry $j,<br>";
						$isOk=false;
					}
				}else{
					$msg.="Select valid student gender in entry $j,<br>";
					$isOk=false;
				}
			}else{
				$msg.="invalid date in entry $j,<br>";
				$isOk=false;
			}
		}else{
			$msg.="invalid student name in entry $j,<br>";
			$isOk=false;
		}
	}
	
	if($isOk==true){
		for($i=0;$i<$pop;$i++){
			$j=$i+1;
			
			if($_FILES["passport$j"]['tmp_name']!=''){
				$studID=$_POST["studID$j"];
				$dest="passport/$studID.jpg";
				#move_uploaded_file($_FILES["passport$j"]['tmp_name'],$dest);
				
				$name=mysqli_real_escape_string($conn,$_POST["stud$j"]);
				$dob=mysqli_real_escape_string($conn,$_POST["dob$j"]);
				$gender=mysqli_real_escape_string($conn,$_POST["gender$j"]);
				$parentn=mysqli_real_escape_string($conn,$_POST["parentn$j"]);
				$parentp=mysqli_real_escape_string($conn,$_POST["parentp$j"]);
				$address=mysqli_real_escape_string($conn,$_POST["address$j"]);
				
				#check if the student information is already existing
				$fields=array('name');
				$flagfields=array('name','dob','gender','address','schlid','class_id','parentName','parentPhone');
				$flagvalues=array($name,$dob,$gender,$address,$_POST['schlid'],$_POST['class'],$parentn,$parentp);
				
				$k=@mysqli_query($conn,SQLretrieve('student',$fields,$flagfields,$flagvalues));
				if($k!=false){
					if($w=mysqli_fetch_array($k)){
						
					}else{
						
						#since non, insert it into student
						move_uploaded_file($_FILES["passport$j"]['tmp_name'],$dest);
						
						$fieldlist=array('name','dob','gender','address','passport','parentName','parentAddress','parentPhone','class_id','schlid','studID','session_1','subClass');
						$valuelist=array($name,$dob,$gender,$address,$dest,$parentn,$address,$parentp,$_POST['class'],$_POST['schlid'],$studID,'1',$subClass);
						
						$flagfields=array();
						$flagvalues=array();
						
						@mysqli_query($conn,SQLinsert($valuelist,$fieldlist,'student','',''));
					$_FILES["passport$j"]['name']="$studID.jpg";
						#echo "<br> ".$_FILES["passport$j"]['name']."";
					}
				}
					
				#check if it is jpeg format picture
				#copy file into the needed folder
				#
				
			}else{
				$msg.="student ".$j.",";
			}
			
		}
	}else{
		$fmsg="<div class=\"alert alert-error\"><br>The following errors were found within your form :<br> $msg</div>";
	}
	return $fmsg;
	
}
function applyChangesnExit(){
	#should ensure the changes are reflects what we have in student record and folder
	#should redirect to studentlist with the class id set to current class.
	if(isset($_POST['btnExitReg'])){
		#echo "<br><b> hey!!! <b></br>";
		header("location:studentlist.php?clsid={$_POST['class']}&subclass={$_POST['subclass']}");
	}
}
function addnRemoveSingleStudentForm($i,$values,$studIDs){
	$j=$i-1;
	
	?>
	<div class="container-fluid">
    	<div class="row-fluid">
        	<div class="span4">
            <input type="hidden" name="studID<?php echo $i;?>" id="studID<?php echo $i;?>" value="<?php echo $studIDs[$j];?>" />
            <input type="text" class="" name="stud<?php echo $i;?>" id="stud<?php echo $i;?>" placeholder='Student name <?php echo $i;?>' value="<?php echo $values[$j][0];?>" /></div>
            <div class="span4"><input type="text" class="input-medium pull-right" name="dob<?php echo $i;?>" id="dob<?php echo $i;?>" placeholder='Date of birth <?php echo $i;?> (dd-mm-yyyy)' value="<?php echo $values[$j][1];?>" /></div>
            <div class="span4"><select name="gender<?php echo $i;?>" id="gender<?php echo $i;?>" class="input-medium pull-right">
            					<option>Select gender</option>
                                <?php 
									$gender=array(1=>"Male","Female");
									for($k=1;$k<=2;$k++){
										if($gender[$k]==$values[$j][2]){
								?>
                                        <option value="<?php echo $gender[$k];?>" selected="selected"><?php echo $gender[$k];?></option>
                                <?php }else{?>
                                        <option value="<?php echo $gender[$k];?>"><?php echo $gender[$k];?></option>

                                <?php }}?>
                                </select>
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span4"><div class="img-polaroid" style="width:150px; cursor:pointer; height:150px; vertical-align:middle;" id="img<?php echo $i;?>"> <div class="well-small" id="preview<?php echo $i;?>" onclick="loadImg('<?php echo $i;?>');">Uploaded Image Click to preview passport</div></div>
            <input type="file" value="<?php echo $values[$j][6]?>" class="btn btn-small" name="passport<?php echo $i;?>" id="passport<?php echo $i;?>" placeholder='Upload student passport <?php echo $i;?>' /></div>
            <div class="span4"><input type="text" class="input-medium pull-right" name="parentn<?php echo $i;?>" id="parentn<?php echo $i;?>" value="<?php echo $values[$j][3];?>" placeholder='Parent Name <?php echo $i;?>' /><br />
            <input type="text" class="input-medium pull-right" name="parentp<?php echo $i;?>" id="parentp<?php echo $i;?>" placeholder='Phone <?php echo $i;?> (080xxxxxxxx)' value="<?php echo $values[$j][4];?>" />
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span12">
            
            	<textarea class="input-block-level" rows="5" cols="20" name="address<?php echo $i;?>" id="address<?php echo $i;?>" placeholder="..type parent address <?php echo $i;?>"><?php echo $values[$j][5];?></textarea>
            </div>
        </div>
    </div>
	<?php
}
function previewImg($stud,$dob,$gender,$parentn,$parentp,$address){
	$img="<img src=\"passport/dummy.jpg\" width=\"100%\">";
	$path='';
	
	global $conn;
	$field=array("passport");
	$flagfields=array('name','dob','gender','parentName','parentPhone','parentAddress');
	$flagvalues=array($stud,$dob,$gender,$parentn,$parentp,$address);
	
	$k=@mysqli_query($conn,SQLretrieve('student',$field,$flagfields,$flagvalues));
	
	if($k!=false){
		if($val=@mysqli_fetch_array($k)){
			$path=$val['passport'];
			$img="<img src=\"$path\" width=\"100%\">";
		}
	}
	
	return $img;	
	
}
function createSubjectGroup($schlid,$name,$id){
	$msg="";
	$fields=array();
	$flagfields=array('subject_group_name','subject_group_id','schlid');
	$flagvalues=array($name,$id,$schlid);
	global $conn;
	
	$k=@mysqli_query($conn,SQLretrieve('subject_groups',$fields,$flagfields,$flagvalues));
	if($k!=false){
		if($val=@mysqli_fetch_array($k)){
			$msg="<div class=\"alert-error\">Subject group already existing.</div>";
		}else{
			#SQLinsert($flagvalues,$flagfields,'subject_groups','','');
			@mysqli_query($conn,SQLinsert($flagvalues,$flagfields,'subject_groups','',''));
			$msg="<div class=\"alert-success\">Subject group $name created continue to start adding subject.</div>";
		}
	}
	return $msg;
	
}
function addSubjectToList($schlid,$subjectName,$groupID,$pract,$selective){
	global $conn;
	if($schlid!='' && $subjectName && $groupID){
		if($pract!='' && $selective!='');
			#verify whether subject is already added
			$field=array("subject_name");
			$flagfields=array('group_id','schlid','subject_name');
			$flagvalues=array($groupID,$schlid,$subjectName);
			
			$k=@mysqli_query($conn,SQLretrieve('subject',$field,$flagfields,$flagvalues));
			if($k!=false){
				if($val=mysqli_fetch_array($k)){
					
				}else{
					$valuelist=array($subjectName,$pract,$selective,$groupID,$schlid);
					$fieldlist=array('subject_name','practical_oriented','selective','group_id','schlid');
					
					@mysqli_query($conn,SQLinsert($valuelist,$fieldlist,'subject','',''));
				}
			}
				
	}
}
function loadSubjectsTolist($schlid,$groupID){
	global $conn;
	if($schlid!='' && $groupID!=''){
		$fields=array('subject_name');
		$flagfields=array('schlid','group_id');
		$flagvalues=array($schlid,$groupID);
		
		$k=@mysqli_query($conn,SQLretrieve('subject',$fields,$flagfields,$flagvalues));
		if($k!=false){
			$i=1;
			while($val=mysqli_fetch_array($k)){
				$subject=$val['subject_name'];
				?>
                <label class="checkbox" for="<?php echo "sub$i";?>"><input type="checkbox" name="<?php echo "sub$i";?>" id="<?php echo "sub$i";?>" value="<?php echo $subject;?>" /> <?php echo $subject;?> </label>
                <?php
				$i++;
			}
			echo "<input type=\"hidden\" name=\"total\" id=\"total\" value=\"$i\">";
		}
	}
}
function removeSubject($subjectName,$groupID,$schlid){
	global $conn;
	$msg="";
	
	$sql="delete from subject where subject_name='$subjectName' and group_id='$groupID' and schlid='$schlid'";
	#echo "$sql";
	@mysqli_query($conn,$sql);
	$msg="subject removed successfully";
	return $msg;
}
function removeGroup($schlid,$groupID){
	global $conn;
	$msg='';
	$sql="delete from subject_groups where schlid='$schlid' and subject_group_id='$groupID'";
	$dsql="delete from subject where schlid='$schlid' and group_id='$groupID'";
	
	@mysqli_query($conn,$sql);
	@mysqli_query($conn,$dsql);
	$msg="subject group successfully removed";
	return $msg;
}
function loadSubjectGroups($schlid){
	global $conn;
	if($schlid!=''){
		$fields=array('subject_group_name','subject_group_id');
		$flagfields=array('schlid');
		$flagvalues=array($schlid);
		
		$k=@mysqli_query($conn,SQLretrieve('subject_groups',$fields,$flagfields,$flagvalues));
		
		if($k!=false){
			while($val=mysqli_fetch_array($k)){
				$name=$val['subject_group_name'];
				$id=$val['subject_group_id'];
				
				?>
				<option value="<?php echo $id;?>"><?php echo $name.' - '.$id;?></option>
                <?php
			}
		}
	}
}
function resetPassword($email,$schlid){
		global $conn;
		if(isset($email) && isset($schlid)){
			$msg='';
			$fields=array('email','name','schoolName','adminID');
			$flagfields=array('schlid');
			$flagvalues=array($schlid);
			
			$k=@mysqli_query($conn,SQLretrieve('school_admin',$fields,$flagfields,$flagvalues));
			if($k!=false){
				if($val=@mysqli_fetch_array($k)){
					$realEmail=$val['email'];
					$name=$val['name'];
					$schoolName=$val['schoolName'];
					$id=$val['adminID'];
					
					if(strtolower($realEmail)==strtolower($email)){
						$psw=scramblePassword();
						#remember to encode password before storage.
						$sql="update school_admin set password='$psw' where schlid='$schlid' and email='$email'";
						@mysqli_query($conn,$sql);
						#send new pass to email address
						#mail($email,'Password reset'," Hi, $name<br> You requested for password reset on your $schoolName account with post primary school education centre, below is the new password as generated by our system.<br><br><b>Login ID : $id<br> Password : $psw</b>  <br>Remember to use this on your next login.");
						
						mail($email,'Password reset',resetMail($name,$schoolName,$id,$psw));
						
						$msg="<p class=\"alert alert-success\">Password successfully resetted, check your email for details.</p>";
					}else{
						$msg="<p class=\"alert alert-error\">Invalid email address.</p>";
					}
				}
			}
		return $msg;
		}
		
}
function resetMail($name,$schoolName,$adminID,$psw){
	?>
    Hi, <?php echo $name;?><br>
    You requested for password reset on your <?php echo $schoolName;?> account with ppseducation.com.ng, below is the new password as generated by our system.<br><br>
    <b>Admin ID : <?php echo $adminID; ?><br> 
    Password : <?php echo $psw; ?></b>  <br>
    Remember to use this on your next login.
    <?php
}
function scramblePassword(){
	$newPassword="";
	
	$year=date('Y');
	$month=date('m');
	$day=date('d');
	$all=array(0=>'g','h','I','J','23','L','4','n','O','1');
	$seg="";
	$nMonthday="";
	
	$sno='';
	$ok=0;
	while($ok<=7){
		$sno.=mt_rand(1,30);
		
		if(strlen($sno)>=7){
			break;
		}
		$ok++;
	}
	for($i=0;$i<strlen($sno);$i++){
		$newPassword.=$all[$sno[$i]];
	}
	return trim($newPassword);
}
function saveAdminDetails($schlid,$name,$gender,$phone){
	#update the details of the school admin
	#and update the contents  of the admin based session variables.
	$msg="";
	if($schlid!='' && $name!='' && $gender!='' && $phone!=''){
		$sql="update school_admin set name='$name', gender='$gender', phone='$phone' where schlid='$schlid'";
		@mysqli_query($conn,$sql);
		#echo "<br>$sql";
		$_SESSION['adminName']=$name;
		$_SESSION['gender']=$gender;
		$_SESSION['phone']=$phone;
		
		$msg="Admin details saved successfully.";
	}
	#echo $msg;
}
function saveSchoolDetails($schlid,$schoolname,$schoolDescription,$schoolAddress,$schlProg,$govtApproved,$gradingProfile,$Promopolicy,$publishedStatus,$email,$schlstate,$schllocation,$imgPath){
	global $conn;
	#update the details of school.
	#and update the contents of the school based session variable.
	$msg="";
	$sql="";
	$dsql="";
	#echo "$publishedStatus - <br>";
	
	if($imgPath!='') $imgPath=",sclLogo='$imgPath'";
	
	if(isset($publishedStatus)){
		#ensure other values are not empty
		if($schoolname!='' && $schoolDescription!='' && $schoolAddress!='' && $schlProg!='' && $govtApproved!='' && $gradingProfile!='' && $Promopolicy!='' && $email!=''){
			
			$sql="update school set address='$schoolAddress', schlName='$schoolname', description='$schoolDescription',schlProg='$schlProg', govt_approved_status='$govtApproved', grading_profile='$gradingProfile', promotion_policy='$Promopolicy', published='$publishedStatus', email='$email',state='$schlstate',location='$schllocation' $imgPath where schlid=$schlid";
			$dsql="update school_admin set schoolName='$schoolname' where schlid='$schlid'";
		}
		
	}else{
			$sql="update school set address='$schoolAddress', schlName='$schoolname', description='$schoolDescription',schlProg='$schlProg', govt_approved_status='$govtApproved', grading_profile='$gradingProfile', promotion_policy='$Promopolicy', email='$email' $imgPath where schlid=$schlid";
			$dsql="update school_admin set schoolName='$schoolname' where schlid='$schlid'";
	}
	
	@mysqli_query($conn,$sql);
	@mysqli_query($conn,$dsql);
}
function listClassSubjects($schlid,$subjectGroupid){
	$subjectGroupid=trim($subjectGroupid);
	$fields=array('subject_name','practical_oriented','group_id');
	$flagfields=array('schlid','group_id');
	$flagvalues=array($schlid,$subjectGroupid);
	global $conn;
	$k=@mysqli_query($conn,SQLretrieve('subject',$fields,$flagfields,$flagvalues));
	
	if($k!=false){
		
		while($val=@mysqli_fetch_array($k)){
			
			$subjectName=$val['subject_name'];
			$pract=$val['practical_oriented'];
			$id=$val['group_id'];
			?>
            <div style="cursor:pointer; border-bottom:#ccc thin solid; padding:2px;" onclick="loadStudentsSubject('<?php echo $subjectName;?>','<?php echo $pract;?>','<?php echo $id;?>');"><?php echo $subjectName;?></div>
            <?php
		}
	}
}
function isPracticalSubject($schlid,$subjectGroupID,$subject){
	$fields=array('practical_oriented');
	$flagfields=array('schlid','group_id','subject_name');
	$flagvalues=array($schlid,$subjectGroupID,$subject);
	global $conn;
	$ok=false;
	
	$k=@mysqli_query($conn,SQLretrieve('subject',$fields,$flagfields,$flagvalues));
	if($k!=false){
		if($val=@mysqli_fetch_array($k)){
			if($val['practical_oriented']=='yes') $ok=true;
		}
	}
	return $ok;
}
function listClassStudents($schlid,$classid,$curClass,$subjectid,$group_ID,$pract){
		global $conn;
#echo "$classid<br>";
		$cls=explode("|",$classid);
		$classid=trim($cls[0]);
		$subclass=trim($cls[1]);
		
		$fields=array();
		$flagfields=array('schlid','class_id','subclass');
		$flagvalues=array($schlid,$classid,$subclass);
		$k=mysqli_query($conn,SQLretrieve('student',$fields,$flagfields,$flagvalues));
		
		if($k!=false){
			$all=explode(' ',$curClass);
			$term="{$all[0]} {$all[1]}";
			$session="{$all[2]} {$all[3]}";
			
			
			?>
			The <?php echo $subjectid;?> score sheet of <?php echo $classid;?> class at <?php echo $curClass;?> level<br />
			
            <input type="hidden" name="session" id="session" value="<?php echo $session;?>" />
            <input type="hidden" name="term" id="term" value="<?php echo $term;?>" />
            <input type="hidden" name="class" id="class" value="<?php echo $classid;?>" />
            <input type="hidden" name="subject" id="subject" value="<?php echo $subjectid;?>" />
            
            <table class="table table-hover">
			<?php
			$i=1;
		  while($val=mysqli_fetch_array($k)){
			  #create record for scoresheet.
			  $id=$val['studID'];
			  $studName=$val['name'];
			  
			  $testscore='';
			  $practscore='';
			  $examscore='';
			  
			  $result=exractRecordFromResult($schlid,$classid,$curClass,$subjectid,$group_ID,$pract,$id);
			  if(!empty($result)){
				  $testscore=$result[0];
				  $practscore=$result[1];
				  $examscore=$result[2];
			  }
			  
			  
			  if($group_ID=='default'){
				  if($pract=='yes'){ 
					  echo practScoreSheetInt($i,$id,$studName,$testscore,$practscore,$examscore);
				  }else{
					  echo nonPractScoreSheetInt($i,$id,$studName,$testscore,$examscore);
				  }
			  }else{
				  if($pract=='yes'){ 
					  echo practScoreSheetInt($i,$id,$studName,$testscore,$practscore,$examscore);
				  }else{
					  echo nonPractScoreSheetInt($i,$id,$studName,$testscore,$examscore);
				  }
			  }
			$i++;  
		  }
		
		}		
		#get record from student table.	
		# find a way to integrate promotion policy here.
		
		?>
        </table>
        <div><button class="btn btn-default" type="button" onclick="updateResultSheet(<?php if($pract=='yes') echo true;?>);"><span class="icon-ok"></span> Update result sheet</button>
        
        <a target="_blank" href="resultcomputationpreview.php?subject=<?php echo $subjectid;?>&class=<?php echo $classid;?>&session=<?php echo $session;?>&term=<?php echo $term;?>" class="btn btn-default"><span class="icon-check"></span> Preview result sheet</a>
        </div>
        <input type="hidden" name="total" id="total" value="<?php echo $i;?>">
        Not in the right grading system?<br />
        <a href="accountsettings.php#schlInfo">Change grading system</a>.
        <?php
	
}
function exractRecordFromResult($schlid,$classid,$curClass,$subjectid,$group_ID,$pract,$studID){
	#check if subject is already existing in student table, for this particular class
	#if not load students in the sheet
	global $conn;
	$all=explode(' ',$curClass);
	$term="{$all[0]} {$all[1]}";
	$session="{$all[2]} {$all[3]}";
#	$fields=array('subject_name','term','session','tscore','practscore','examscore','studID');
	$fields=array('tscore','practscore','examscore');
	$flagfields=array('schlid','class_id','session','term','subject_name','studID');
	$flagvalues=array($schlid,$classid,$session,$term,$subjectid,$studID);
	
	$studScores=array();
	
	$k=@mysqli_query($conn,SQLretrieve('result',$fields,$flagfields,$flagvalues));
	if($k!=false){
		
		$i=0;
		if($val=mysqli_fetch_array($k)){
			
			$studScores=$val;
		}
	}
	return $studScores;
}
function updateResultSheet($subject_name,$term,$session,$tscore,$practscore,$examscore,$studID,$class_id,$schlid){
	#check if record already existing?
	#if yes update record
	#else insert new record
	global $conn;
	$fields=array();
	$flagfields=array('schlid','session','term','class_id','studID','subject_name');
	$flagvalues=array($schlid,$session,$term,$class_id,$studID,$subject_name);
	
	$k=@mysqli_query($conn,SQLretrieve('result',$fields,$flagfields,$flagvalues));
	if($k!=false){
		if($val=@mysqli_fetch_array($k)){
			$sql="update result set tscore='$tscore', practscore='$practscore', examscore='$examscore' where schlid='$schlid' and subject_name='$subject_name' and term='$term' and session='$session' and studID='$studID' and class_id='$class_id'";
			
			#echo "<br>$sql<br>";
			
			@mysqli_query($conn,$sql);
			
		}else{
			$fieldlist=array('subject_name','term','session','tscore','practscore','examscore','studID','class_id','schlid');
			$valuelist=array($subject_name,$term,$session,$tscore,$practscore,$examscore,$studID,$class_id,$schlid);
			
			@mysqli_query($conn,SQLinsert($valuelist,$fieldlist,'result','',''));
		}
	}
}
function getStudName($studID,$schlid){
	global $conn;
	$fields=array('name');
	$flagfields=array('schlid','studID');
	$flagvalues=array($schlid,$studID);
	$studName='';
	
	$k=@mysqli_query($conn,SQLretrieve('student',$fields,$flagfields,$flagvalues));
	if($k!=false){
		if($val=@mysqli_fetch_array($k)){
			$studName=$val['name'];
		}
	}
	return $studName;
}
function practScoreSheetInt($i,$studID,$studName,$testScore,$practScore,$examScore){
	?>

        <tr>
        	<td><?php echo "$i";?></td>
            <td><?php echo "$studID";?><input type="hidden" name="id<?php echo $i;?>" id="id<?php echo $i;?>" value="<?php echo "$studID";?>" /></td>
            <td><?php echo "$studName";?><input type="hidden" name="name<?php echo $i;?>" id="name<?php echo $i;?>" value="<?php echo "$studName";?>" /></td>
            <td><input type="text" class="input-mini" maxlength="2" placeholder="Test" value="<?php echo $testScore;?>" name="<?php echo "test$i";?>" id="<?php echo "test$i";?>" /></td>
            <td><input type="text" class="input-mini" maxlength="2" placeholder="Practical" value="<?php echo $practScore;?>" name="<?php echo "pract$i";?>" id="<?php echo "pract$i";?>"/></td>
            <td><input type="text" class="input-mini" maxlength="2" placeholder="Exam" value="<?php echo $examScore;?>" name="<?php echo "exam$i";?>" id="<?php echo "exam$i";?>" /></td>
        </tr>
    <?php
}
function nonPractScoreSheetInt($i,$studID,$studName,$testScore,$examScore){
	?>
    
        <tr>
        	<td><?php echo "$i";?></td>
            <td><?php echo "$studID";?><input type="hidden" name="id<?php echo $i;?>" id="id<?php echo $i;?>" value="<?php echo "$studID";?>" /></td>
            <td><?php echo "$studName";?><input type="hidden" name="name<?php echo $i;?>" id="name<?php echo $i;?>" value="<?php echo "$studName";?>" /></td>
            <td><input type="text" class="input-mini" maxlength="2" placeholder="Test" value="<?php echo $testScore;?>" name="<?php echo "test$i";?>" id="<?php echo "test$i";?>" /></td>
            <td><input type="text" class="input-mini" maxlength="2" placeholder="Exam" value="<?php echo $examScore;?>" name="<?php echo "exam$i";?>" id="<?php echo "exam$i";?>" /></td>
        </tr>
    <?php
}
function grade($totalscore,$selectedGrading){
	$gradingSystem=array('waecGrading'=>'waecGrading','schoolGrading'=>'schoolGrading');
	#echo var_dump($totalscore)."- <br>";
	$totalscore=floatval($totalscore);
	if($totalscore!=''){
		return $gradingSystem["$selectedGrading"]($totalscore);
	}
}
function waecGrading($score){
	#echo "$score<br>";
	$grade='';
	switch ($score) {
		case ($score<=39):
			$grade='F9';
			break;
		case ($score>=40 && $score<45):
			$grade='P8';
			break;
		case ($score>=45 && $score<50):
			$grade='P7';
			break;
		case ($score>=50 && $score<55):
			$grade='C6';
			break;
		case ($score>=55 && $score<60):
			$grade='C5';
			break;
		case ($score>=60 && $score<=69):
			$grade='C4';
			break;
		case ($score>=70 && $score<75):
			$grade='A3';
			break;
		case ($score>=75 && $score<80):
			$grade='A2';
			break;
		case ($score>=80 && $score<100):
			$grade='A1';
			break;
	}
	return $grade;
}
function schoolGrading($score){
	$grade='';
	switch ($score) {
		case ($score<=39):
			$grade='F';
			break;
		case ($score>=40 && $score<50):
			$grade='P';
			break;
		case ($score>=50 && $score<55):
			$grade='C';
			break;
		case ($score>=55 && $score<70):
			$grade='B';
			break;
		case ($score>=70 && $score<100):
			$grade='A';
			break;
	}
	return $grade;
}
function remark($score){
	$grade='';
	if($score!=''){
	switch ($score) {
		case ($score<=39):
			$grade='Fail';
			break;
		case ($score>=40 && $score<50):
			$grade='Pass';
			break;
		case ($score>=50 && $score<55):
			$grade='Good';
			break;
		case ($score>=55 && $score<70):
			$grade='Better';
			break;
		case ($score>=70 && $score<100):
			$grade='Excellent';
			break;
	}
	return $grade;
	}
}
function determinePosition($subject,$schlid,$class,$session,$term,$studID){
	#retrieve record
	global $conn;
	$fields=array('studID','tscore','examscore','practscore');
	$flagfields=array('subject_name','schlid','class_id','session','term');
	$flagvalues=array($subject,$schlid,$class,$session,$term);
	$sorted=array();
	$id=array();
	
	$k=@mysqli_query($conn,SQLretrieve('result',$fields,$flagfields,$flagvalues));
	if($k!=false){
		$i=0;
		$lscore=0;
		
		while($val=@mysqli_fetch_array($k)){
			$tscore=$val['tscore'];
			$examscore=$val['examscore'];
			$practscore=$val['practscore'];
			
			$totalscore=$tscore+$practscore+$examscore;
			$sorted[$i]=$totalscore;
			$id[$i]=$val['studID'];
			
			$i++;
		}
	}
	#sort the position array
	array_multisort($sorted,$id);
	
	for($j=0;$j<count($sorted);$j++){
		if($studID==$id[$j]){
			break;
		}
	}
	return count($sorted)-$j;
}
function getProspectName($schlid,$id){
	global $conn;
	$name='';
	if($schlid!='' && $id!=''){
		#search the prospectlist table for valid prospect info.
		$fields=array();
		$flagfields=array('schlid','id');
		$flagvalues=array($schlid,$id);
		$ok=@mysqli_query($conn,SQLretrieve('prospectlist',$fields,$flagfields,$flagvalues));
		
		if(mysqli_affected_rows($conn)>0){
			if($val=@mysqli_fetch_array($ok)){
				$name=$val['name'];
			}
		}
	}
	return $name;
}
function prospectCBTAccess($schlid,$studID,$pin){
	global $conn;
	#check pin validity
	#match studID with the pin
	#check result
	#if available load result in a new page.
	/*$all=explode(' ',$curClass);
	$startPoint=strlen($schlid);
	
	$adminYr=substr($studID,$startPoint,4);
	*/
	$term="-";#"{$all[0]} {$all[1]}";
	$session="-";#"{$all[2]} {$all[3]}";
	
	$msg='';
	$fields=array();
	$flagfields=array('pin');
	$flagvalues=array($pin);
	if($pin!='' || $studID!=''){
	$k=@mysqli_query($conn,SQLretrieve('access_pin',$fields,$flagfields,$flagvalues));
	if(mysqli_affected_rows($conn)>0){
		
		if($val=mysqli_fetch_array($k)){
			
			$activated=$val['activate_for_use_status'];
			$card_status=$val['card_status'];
			$leasePeriod=$val['leasing_period'];
			$cardOwner=$val['student_id'];
			$noOfUseage=$val['no_of_login'];
			$cardOwnerSession=$val['session'];
			$cardOwnerTerm=$val['term'];
			
			if($activated=='on'){
				if($card_status!='used'){
					# that means, it is a new card.
					#check if studID is correct? if yes, update access_pin table with student details,
					#and load result
					$today=date('d/m/Y');
					if(getProspectName($schlid,$studID)!=''){
						$noOfUseage++;
						$sql="update access_pin set no_of_login='$noOfUseage', student_id='$studID', session='$session', term='$term', card_status='used', first_login_date='$today' where pin='$pin'";
						@mysqli_query($conn,$sql);
						?>
						  <!--script type="text/javascript">
							messageWindow('student result','the result of students','studentresult.php<?php #echo "?schlid=$schlid&studID=$studID&curClass=$curClass";?>');

                          </script-->
                         
                        <?php
						
						$msg="ok";
					}else{
						$msg="<p class=\"alert alert-error\">Enter a valid student ID.</p>";
					}
				}else{
					# that means, it is not a new card.
					#therefore, match the studid with the cardOwner,
					#if correct, check if leaseperiod is exhausted, if yes alert user of card exhaustion limit, else update  access_pin table, and load result
					#if cardowner id does not match studID, alert user of card already used by another.
					if($studID==$cardOwner){
						if($leasePeriod>$noOfUseage){
							$noOfUseage++;
							$sql="update access_pin set no_of_login='$noOfUseage' where pin='$pin'";
							@mysqli_query($conn,$sql);
							#echo "loadresult";
							?>
                            <!--script>
								messageWindow('student result','the result of students','studentresult.php<?php #echo "?schlid=$schlid&studID=$studID&curClass=$curClass";?>');
                            </script-->
                            
                            <?php
							$msg="ok";
						}else{
							$msg="<p class=\"alert alert-error\">You have exhausted your card useage limit, buy a new one.</p>";
						}
					}else{
						$msg="<p class=\"alert alert-error\">Card already used by another.</p>";
					}
					
				}
			}else{
				$msg="<p class=\"alert alert-error\">Card not currently activated for use.</p>";
			}
		}
	}else{
		$msg="<p class=\"alert alert-error\">Invalid pin entered</p>";
	}
	}else{
		$msg="<p class=\"alert alert-error\">Pin or student ID fields can\'t be empty.</p>";
	}
	return "$msg";
}
function studentCBTAccess($schlid,$studID,$pin,$curclass,$curterm){
	global $conn;
	#check pin validity
	#match studID with the pin
	#check result
	#if available load result in a new page.
	#$all=explode(' ',$curClass);
	$startPoint=strlen($schlid);
	
	$adminYr=substr($studID,$startPoint,4);
	
	$term=$curterm;#"{$all[0]} {$all[1]}";
	$session=$curclass;#"{$all[2]} {$all[3]}";
	#echo "enterd 1<br>";
	$msg='';
	$fields=array();
	$flagfields=array('pin');
	$flagvalues=array($pin);
	if($pin!='' || $studID!=''){
	$k=@mysqli_query($conn,SQLretrieve('access_pin',$fields,$flagfields,$flagvalues));
	#echo "enterd 1 |$pin| -1<br>";
	if(mysqli_affected_rows($conn)>0){
		#echo "enterd 2<br>";
		if($val=@mysqli_fetch_array($k)){
			#echo "enterd 3<br>";
			$activated=$val['activate_for_use_status'];
			$card_status=$val['card_status'];
			$leasePeriod=$val['leasing_period'];
			$cardOwner=$val['student_id'];
			$noOfUseage=$val['no_of_login'];
			$cardOwnerSession=$val['session'];
			$cardOwnerTerm=$val['term'];
			
			if($activated=='on'){
				#echo "enterd 4<br>";
				if($card_status!='used'){
					#echo "enterd 5<br>";
					# that means, it is a new card.
					#check if studID is correct? if yes, update access_pin table with student details,
					#and load result
					$today=date('d/m/Y');
					if(getStudName($studID,$schlid)!=''){
						#echo "enterd 6<br>";
						$noOfUseage++;
						$sql="update access_pin set no_of_login='$noOfUseage', student_id='$studID', session='$session', term='$term', card_status='used', first_login_date='$today' where pin='$pin'";
						@mysqli_query($conn,$sql);
						?>
						  <!--script type="text/javascript">
							messageWindow('student result','the result of students','studentresult.php<?php #echo "?schlid=$schlid&studID=$studID&curClass=$curClass";?>');

                          </script-->
                         
                        <?php
						
						$msg="ok";
					}else{
						$msg="<p class=\"alert alert-error\">Enter a valid student ID.</p>";
					}
				}else{
					# that means, it is not a new card.
					#therefore, match the studid with the cardOwner,
					#if correct, check if leaseperiod is exhausted, if yes alert user of card exhaustion limit, else update  access_pin table, and load result
					#if cardowner id does not match studID, alert user of card already used by another.
					#echo "enterd 7<br>";
					if($studID==$cardOwner){
						#echo "enterd 8<br>";
						if($leasePeriod>$noOfUseage){
							#echo "$cardOwnerSession|$session - $cardOwnerTerm|$term<br>";
							
							if($cardOwnerSession==$session && $cardOwnerTerm==$term){
							$noOfUseage++;
							$sql="update access_pin set no_of_login='$noOfUseage' where pin='$pin'";
							@mysqli_query($conn,$sql);
							#echo "loadresult";
							?>
                            <!--script>
								messageWindow('student result','the result of students','studentresult.php<?php #echo "?schlid=$schlid&studID=$studID&curClass=$curClass";?>');
                            </script-->
                            
                            <?php
							$msg="ok";
							
							}else{
								$msg="<p class=\"alert alert-error\">Card has been  used for other term. </p>";
							}
						}else{
							$msg="<p class=\"alert alert-error\">You have exhausted your card useage limit, buy a new one.</p>";
						}
					}else{
						$msg="<p class=\"alert alert-error\">Card already used by another.</p>";
					}
					
				}
			}else{
				$msg="<p class=\"alert alert-error\">Card not currently activated for use.</p>";
			}
		}
	}else{
		$msg="<p class=\"alert alert-error\">Invalid pin entered</p>";
	}
	}else{
		$msg="<p class=\"alert alert-error\">Pin or student ID fields can\'t be empty.</p>";
	}
	return "$msg";
}
function updateTestResult($schlid,$studid,$testid,$testscore){
	global $conn;
	$cdate=date('d/m/Y');
	$fields=array();
	$flagfields=array('testid','schlid','stud_id');
	$flagvalues=array($testid,$schlid,$studid);
	
	#echo "($testid,$schlid,$studid)";
	
	$ok=@mysqli_query($conn,SQLretrieve('teststudent',$fields,$flagfields,$flagvalues));
	
	if(mysqli_affected_rows($conn)<1){
		$sql="insert into teststudent(schlid,stud_id,tdate,testid,test_score,no_of_trial) values('$schlid','$studid','$cdate','$testid','$testscore','1')";
		
	}else{
		
		$sql="update teststudent set test_score='$testscore',tdate='$cdate' where testid='$testid' and schlid='$schlid' and stud_id='$studid'";
	}
	#echo $sql;
	@mysqli_query($conn,$sql);
}
function checkResult($schlid,$studID,$pin,$curclass,$curterm){
	global $conn;
	#check pin validity
	#match studID with the pin
	#check result
	#if available load result in a new page.
	#$all=explode(' ',$curClass);
	$term=$curterm;#"{$all[0]} {$all[1]}";
	$session=$curclass;#"{$all[2]} {$all[3]}";
	
	$msg='';
	$fields=array();
	$flagfields=array('pin');
	$flagvalues=array($pin);
	if($pin!='' || $studID!=''){
	$k=@mysqli_query($conn,SQLretrieve('access_pin',$fields,$flagfields,$flagvalues));
	if(mysqli_affected_rows($conn)>0){
		
		if($val=@mysqli_fetch_array($k)){
			
			$activated=$val['activate_for_use_status'];
			$card_status=$val['card_status'];
			$leasePeriod=$val['leasing_period'];
			$cardOwner=$val['student_id'];
			$noOfUseage=$val['no_of_login'];
			$cardOwnerSession=$val['session'];
			$cardOwnerTerm=$val['term'];
			
			if($activated=='on'){
				if($card_status!='used'){
					# that means, it is a new card.
					#check if studID is correct? if yes, update access_pin table with student details,
					#and load result
					$today=date('d/m/Y');
					if(getStudName($studID,$schlid)!=''){
						$noOfUseage++;
						$tterm=$term;
						if($tterm=='Annual') $tterm='Third term';
						$sql="update access_pin set no_of_login='$noOfUseage', student_id='$studID', session='$session', term='$tterm', card_status='used', first_login_date='$today' where pin='$pin'";
						@mysqli_query($conn,$sql);
						#echo "$sql<br>";
						$url=prepare_check_result_link($schlid,$studID,$curclass,$curterm);
						?>
						  <script type="text/javascript">
							messageWindow('student result','the result of students','studentresult.php<?php echo "$url";?>');

//messageWindow('student result','the result of students','studentresult.php<?php #echo "?schlid=$schlid&studID=$studID&curclass=$curclass&curterm=$curterm";?>');
                          </script>
                         
                        <?php
						$msg="<p class=\"alert alert-success\">Done</p>";
					}else{
						$msg="<p class=\"alert alert-error\">Enter a valid student ID.</p>";
					}
				}else{
					# that means, it is not a new card.
					#therefore, match the studid with the cardOwner,
					#if correct, check if leaseperiod is exhausted, if yes alert user of card exhaustion limit, else update  access_pin table, and load result
					#if cardowner id does not match studID, alert user of card already used by another.
					if($studID==$cardOwner){
						if($leasePeriod>$noOfUseage){
							$tterm=$term;
							if($tterm=='Annual') $tterm='Third term';
							if($cardOwnerSession==$session && $cardOwnerTerm==$tterm){ #checkmate the use of prevous cards on new term
							$noOfUseage++;
							$sql="update access_pin set no_of_login='$noOfUseage' where pin='$pin'";
							@mysqli_query($conn,$sql);
							#echo "loadresult";
							$url=prepare_check_result_link($schlid,$studID,$curclass,$curterm);
							?>
                            <script>
								
								messageWindow('student result','the result of students','studentresult.php<?php echo "$url";?>');
                            </script>
                            
                            <?php
							}else{
								$msg="<p class=\"alert alert-error\">Your card has been used for other term.</p>";
							}
						
						}else{
							$msg="<p class=\"alert alert-error\">You have exhausted your card useage limit, buy a new one.</p>";
						}
					}else{
						$msg="<p class=\"alert alert-error\">Card already used by another.</p>";
					}
					
				}
			}else{
				$msg="<p class=\"alert alert-error\">Card not currently activated for use.</p>";
			}
		}
	}else{
		$msg="<p class=\"alert alert-error\">Pin not found.</p>";
	}
	}else{
		$msg="<p class=\"alert alert-error\">Pin or student ID fields can\'t be empty.</p>";
	}
	return "$msg";
}
function getTermlyScore($result,$subject,$term){
	if(count($result)!=0){
		for($i=0;$i<count($result);$i++){
			if($result[$i][1]==$subject && $result[$i][2]==$term){
				return $result[$i];
			}
		}
	}
}
function loadAnnualResult($schlid,$studID,$curclass,$curterm){
	
	#check pin validity
	#match studID with the pin
	#check result
	#if available load result in a new page.
	global $conn;
	
	#$all=explode(' ',$curClass);
	$term=$curterm;#"{$all[0]} {$all[1]}";
	$session=$curclass;#"{$all[2]} {$all[3]}";
	
	$fields=array();
	$flagfields=array('schlid','studID','session');
	$flagvalues=array($schlid,$studID,$session);
	$k=@mysqli_query($conn,SQLretrieve('result',$fields,$flagfields,$flagvalues));
	
	if($k!=false){
		?>
        	<div class="row-fluid">
            <div class="span4"><b>NAME : </b><?php echo getStudName($studID,$schlid);?></div><div class="span4">
            <b>SESSION : </b><?php echo $session;?></div><div class="span4">
            <b>TERM : </b><?php echo $term;?></div>
            </div>
            <hr />
            <table class="table table-hover">
            <thead>
            <tr><th>SUBJECT</th><th>FIRST TERM</th><th>SECOND TERM</th><th>THIRD TERM</th><th>AVE. SCORE</th><th>CLS. AVE.</th><th>GRADE</th><th>REMARK</th></tr>
            </thead>
        <?php
		$result=array();
		$allsubjects=array();
		$j=0;
		$l=0;
		while($val=@mysqli_fetch_array($k)){
			$result[$j]=$val;
			if(!in_array($val[1],$allsubjects)){
				$allsubjects[$l]=$val[1];
				$l++;
			}
			$j++;
		/*	
		*/
		}
		for($i=0;$i<count($allsubjects);$i++){
			
			?>
            <tr><td><?php echo $allsubjects[$i];?></td><td><?php 
			#first term
			$firstterm=getTermlyScore($result,$allsubjects[$i],'First term');
			
			$classid=$firstterm[10];
			$tscore=$firstterm[4];
			$practscore=$firstterm[5];
			$examscore=$firstterm[6];
			$totalscore1=$tscore+$practscore+$examscore;
			
			$classLowest=getClassLowest($allsubjects[$i],$schlid,$classid,$session,'First term');
			$classHighest=getClassHighest($allsubjects[$i],$schlid,$classid,$session,'First term');
			$classAve1=($classHighest+$classLowest)/2;
			#echo "$classAve1 - $totalscore1<br>";
			
			echo $totalscore1;
			
			?></td><td><?php 
			#second term
			$secondterm=getTermlyScore($result,$allsubjects[$i],'Second term');
			
			$classid=$secondterm[10];
			$tscore=$secondterm[4];
			$practscore=$secondterm[5];
			$examscore=$secondterm[6];
			$totalscore2=$tscore+$practscore+$examscore;
			
			$classLowest=getClassLowest($allsubjects[$i],$schlid,$classid,$session,'Second term');
			$classHighest=getClassHighest($allsubjects[$i],$schlid,$classid,$session,'Second term');
			$classAve2=($classHighest+$classLowest)/2;
			#echo "$classAve2 - $totalscore2<br>";
			
			echo $totalscore2;
			
			?></td><td><?php 
			#third term
			$thirdterm=getTermlyScore($result,$allsubjects[$i],'Third term');
			
			$classid=$thirdterm[10];
			$tscore=$thirdterm[4];
			$practscore=$thirdterm[5];
			$examscore=$thirdterm[6];
			$totalscore3=$tscore+$practscore+$examscore;
			
			$classLowest=getClassLowest($allsubjects[$i],$schlid,$classid,$session,'Third term');
			$classHighest=getClassHighest($allsubjects[$i],$schlid,$classid,$session,'Third term');
			$classAve3=($classHighest+$classLowest)/2;
			#echo "$classAve3 - $totalscore3<br>";
			echo $totalscore3;
			
			?></td><td><?php 
			#Annual
			$annualtotalscore=round(($totalscore1+$totalscore2+$totalscore3)/3);
			echo $annualtotalscore;
			
			?></td><td><?php 
			#class average
			$annualClassAve=round(($classAve1+$classAve2+$classAve3)/3);
			echo $annualClassAve;
			
			?></td><td><?php 
			#grade
			$grade=grade($annualtotalscore,getSchoolGrading($schlid));
			echo $grade;
			
			?></td><td><?php 
			#remark
			$remark=remark($annualtotalscore);
			echo $remark;?></td></tr>
            <?php
			
		}
		$teachersRemark='';
		?>
        </table>
        <p>Teacher's REMARK : <ul><?php echo $teachersRemark;?></ul></p>
        <?php
	}

}
function loadResults($schlid,$studID,$curclass,$curterm){
	#check pin validity
	#match studID with the pin
	#check result
	#if available load result in a new page.
	global $conn;
	
	#$all=explode(' ',$curClass);
	$term=$curterm;#"{$all[0]} {$all[1]}";
	$session=$curclass;#"{$all[2]} {$all[3]}";
	
	$fields=array();
	$flagfields=array('schlid','studID','session','term');
	$flagvalues=array($schlid,$studID,$session,$term);
	$k=@mysqli_query($conn,SQLretrieve('result',$fields,$flagfields,$flagvalues));
	
	if($k!=false){
		?>
        	<div class="row-fluid">
            <div class="span4"><b>NAME : </b><?php echo getStudName($studID,$schlid);?></div><div class="span4">
            <b>SESSION : </b><?php echo $session;?></div><div class="span4">
            <b>TERM : </b><?php echo $term;?></div>
            </div>
            <hr />
            <table class="table table-hover">
            <thead>
            <tr><th>SUBJECT</th><th>ASS.</th><th>PRACT.</th><th>EXAM.</th><th>TOTAL</th><th>CLS. LW. SC.</th><th>CLS. HI. SC.</th><th>CLS. AV. SC.</th><th>POS.</th><th>GRADE</th><th>REMARK</th></tr>
            </thead>
        <?php
		while($val=mysqli_fetch_array($k)){
			$subject=$val['subject_name'];
			$classid=$val['class_id'];
			$tscore=$val['tscore'];
			$practscore=$val['practscore'];
			$examscore=$val['examscore'];
			$totalscore=$tscore+$practscore+$examscore;
			$classLowest=getClassLowest($subject,$schlid,$classid,$session,$term);
			$classHighest=getClassHighest($subject,$schlid,$classid,$session,$term);
			$classAve=($classHighest+$classLowest)/2;
			$position=determinePosition($subject,$schlid,$classid,$session,$term,$studID);
			$grade=grade($totalscore,getSchoolGrading($schlid));
			$remark=remark($totalscore);
			?>
            <tr><td><?php echo $subject;?></td><td><?php echo $tscore;?></td><td><?php echo $practscore;?></td><td><?php echo $examscore;?></td><td><?php echo $totalscore;?></td><td><?php echo $classLowest;?></td><td><?php echo $classHighest;?></td><td><?php echo $classAve;?></td><td><?php echo $position;?></td><td><?php echo $grade;?></td><td><?php echo $remark;?></td></tr>
            <?php
		}
		$teachersRemark='';
		?>
        </table>
        <p>Teacher's REMARK : <ul><?php echo $teachersRemark;?></ul></p>
        <?php
	}
}
function adminLogin($adminID,$psw){
	$email=mysqli_real_escape_string($conn,$adminID);
	$psw=mysqli_real_escape_string($conn,$psw);
	global $conn;
	
	$loginMsg='';	
		if($adminID!=''){
			
			if($psw!=''){
				
				#hash the password
				
				$field=array();
				$flagfields=array('name','password');
				$flagvalues=array($adminID,$psw);
				
				$ok=@mysqli_query($conn,SQLretrieve('site_admin',$field,$flagfields,$flagvalues));
				
				
				if($ok!=false){
					while($v=mysqli_fetch_array($ok)){
						$details=$v;
					}
					if(!empty($details)){
						#set session variables
						$_SESSION['adminName']=$details['name'];
						$_SESSION['access_level']=$details['access_level'];
						
						header("location:home.php");
						#$isLogin=true;
					}else{
						$loginMsg="<div class=\"alert alert-error\">Incorrect admin info. entered</div>";
					}
				}else{
					$loginMsg="<div class=\"alert alert-error\">Invalid admin info.</div>";
				}
				
			}else{
		$loginMsg="<div class=\"alert alert-error\">Password field can't be empty </div>";
			}
		}else{
		$loginMsg="<div class=\"alert alert-error\">Admin ID can't be empty.</div>";
		}
	
	return $loginMsg;
}
function determineUnattendedOrder(){
	$fields=array();
	$flagfields=array('status');
	$flagvalues=array('');
	
	global $conn;
		
	$ok=@mysqli_query($conn,SQLretrieve('ordered_access_pin',$fields,$flagfields,$flagvalues));
	if($ok!=false){
		$i=0;
		while($val=@mysqli_fetch_array($ok)){
			$i++;
		}
	}
	return "<a href=\"home.php?status=unattended\">$i Unattended Order</a>";
}
function determineAccessPinUsage(){
global $conn;
	$fields=array();
	$flagfields=array('activate_for_use_status');
	$flagvalues=array('on');
	
	$ok=@mysqli_query($conn,SQLretrieve('access_pin',$fields,$flagfields,$flagvalues));
	if($ok!=false){
		$used=0;
		$unused=0;
		$i=0;
		while($val=mysqli_fetch_array($ok)){
			if($val['card_status']=='used'){
				$used++;
			}
			$i++;
		}
		$unused=$i-$used;
		$percentUsed=($used/$i)*100;
		$percentUnused=100-$percentUsed;
	}
	return "<a href=\"accesspins.php\">Out of $i access pin sold, $percentUsed% has been used, while $percentUnused% has not been used.</a>";
}
function determineRegisteredSchool(){
global $conn;
	$fields=array();
	$flagfields=array();
	$flagvalues=array();
	
	$ok=@mysqli_query($conn,SQLretrieve('school',$fields,$flagfields,$flagvalues));
	if($ok!=false){
		$published=0;
		$i=0;
		while($val=mysqli_fetch_array($ok)){
			if($val['published']=='on'){
				$published++;
			}
			$i++;
		}
	}
	return "<a href=\"account.php\">We have $i registerd school, with only $published school(s) accessible on our domain.</a>";
}
function determineUnpublishedSchool($pub){
global $conn;
	$fields=array();
	$flagfields=array('published');
	$flagvalues=array($pub);
	
	$ok=@mysqli_query($conn,SQLretrieve('school',$fields,$flagfields,$flagvalues));
	if($ok!=false){
		$published='';
		$i=0;
		while($val=mysqli_fetch_array($ok)){
			#echo "$i<br>";
			$i++;
			$published.="{$val['schlName']} (".getSchoolPop($val['schlid']).") of {$val['address']} in {$val['location']} <b>{$val['State']}</b>,";
			
		}
	}
	if($pub=='on'){
		return "the published school are : $published";
	}else{
		return "the unpublished school are : $published";
	}
}
function getSchoolPop($schlid){
	#determine period
	$curYr=date('Y');
	$start=$curYr-5;
	$details=array();
	global $conn;
	
	$fields=array();
	$flagfields=array('schlid');
	$flagvalues=array($schlid);
	$k=@mysqli_query($conn,SQLretrieve('student',$fields,$flagfields,$flagvalues));
	if($k!=false){
	$new=0;
	$i=0;
	while($val=mysqli_fetch_array($k)){
		$details[$i]=$val;
		$i++;
	}
	
	  for($i=$start;$i<=$curYr;$i++){
		  #echo "$curYr & $start";
		  $count=0;
		  $j=count($details);
		while($j>0){
			if($details[$j-1][9]==$i){
					$count++;
			}
			$j--;
		}
		$new=$new+$count;
	  }
	}
	return $new;
}
function loadOrderedPins(){
	global $conn;
	$fields=array();
	$flagfields=array();
	$flagvalues=array();
	$k=@mysqli_query($conn,SQLretrieve('ordered_access_pin',$fields,$flagfields,$flagvalues));
	if($k!=false){
	$new=0;
	$i=0;
		while($val=@mysqli_fetch_array($k)){
			$details[$i]=$val;
			$i++;
		}
	}
	?>
    <input type="hidden" name="total" id="total" value="<?php echo count($details);?>" />
    <table class="table table-hover">
    <thead>
    	<th><input type="checkbox" name="seleAll" id="seleAll" /></th><th>SN</th><th>Order No.</th><th>Sender Details</th><th>Date</th><th>Quantity</th><th>Status</th>
    </thead>
    <tbody>
    <?php
	$j=1;
	for($i=(count($details)-1);$i>=0;$i--){
		$school=getSchoolDetails($details[$i][2]);
		$admin=getAdminDetails($school[2]);
		?>
        <tr><td><input type="checkbox" name="<?php echo "order$j";?>" id="<?php echo "order$j";?>" value="<?php echo "{$details[$i][3]}";?>" /></td><td><?php echo "$j.";?></td><td><?php echo "{$details[$i][3]}";?></td><td><?php echo "Senders Email : {$details[$i][1]}<br>{$school[8]}<br>{$school[3]}<br> Admin Name: {$admin[1]}<br> Phone : {$admin[7]}";?></td><td><?php echo "{$details[$i][9]}";?></td><td><?php echo "{$details[$i][4]}";?></td><td><?php echo getOrderStatus($details[$i][10]);?></td></tr>
        <?php
		$j++;
	}
	?>
    </tbody>
    </table>
    <?php
}
function removePinOrder($id){
global $conn;
	if($id!=''){
		$sql="delete from ordered_access_pin where orderID='$id'";		
		@mysqli_query($conn,$sql);
	}
}
function changePinOrderStatus($id){
global $conn;
	$msg="";
	$field=array();
	$flagfields=array('orderID');
	$flagvalues=array($id);
	
	$passportFile=@mysqli_query($conn,SQLretrieve("ordered_access_pin",$field,$flagfields,$flagvalues));
	
	if($passportFile!=false){
		if($val=@mysqli_fetch_array($passportFile)){
		#sql to removes record from student table
			if($val['status']==''){
				$sql="update ordered_access_pin set status='done' where orderID='$id'";
			}else{
				$sql="update ordered_access_pin set status='' where orderID='$id'";
			}
			@mysqli_query($conn,$sql);

		}
	}
}
function getOrderStatus($orderStatus){
	$msg='';
	if($orderStatus==''){
		$msg='Pending';
	}else{
		$msg='Sold';
	}
	return $msg;
}
function getAdminDetails($adminID){
global $conn;
	$admin='';
	$fields=array();
	$flagfields=array('adminID');
	$flagvalues=array($adminID);
	$k=@mysqli_query($conn,SQLretrieve('school_admin',$fields,$flagfields,$flagvalues));
	if($k!=false){
		if($val=@mysqli_fetch_array($k)){
			$admin=$val;
		}
	}
	return $admin;
}
function loadPinSet(){
global $conn;
	$fields=array('batch_no','cdate','activate_for_use_status');
	$flagfields=array();
	$flagvalues=array();
	$k=@mysqli_query($conn,SQLretrieve('access_pin',$fields,$flagfields,$flagvalues));
	if($k!=false){
	$new=0;
	$i=0;
	$details=array();
	$batch='';
		while($val=@mysqli_fetch_array($k)){
			if($batch!=$val['batch_no']){
				$batch=$val['batch_no'];
				$details[$i]=$val;
				$i++;
			}
		}
	}
	?>
    <input type="hidden" name="total" id="total" value="<?php echo count($details);?>" />
    <table class="table table-hover">
    <thead>
    	<th><input type="checkbox" name="seleAll" id="seleAll" /></th><th>SN</th><th>Batch No.</th><th>No. of Pins</th><th>Date Generated</th><th>Activation status</th>
    </thead>
    <tbody>
    <?php
	$j=1;
	for($i=(count($details)-1);$i>=0;$i--){
		?>
        <tr><td><input type="checkbox" name="<?php echo "batch$j";?>" id="<?php echo "batch$j";?>" value="<?php echo "{$details[$i][0]}";?>" /></td><td><?php echo "$j.";?></td><td><button class="btn btn-link" type="button" onclick="loadDetailedPin(<?php echo "$j";?>)" data-target="#accessPinList" data-toggle="modal"><?php echo "{$details[$i][0]}";?></button></td><td><?php echo getNoOfPins($details[$i][0]);?></td><td><?php echo "{$details[$i][1]}";?></td><td><?php echo getActivationStatus($details[$i][2]);?></td></tr>
        <?php
		$j++;
	}
	?>
    </tbody>
    </table>
    <?php
}
function loadDetailedPin($batchno){
global $conn;
	$details=array();
	$fields=array();
	$flagfields=array('batch_no');
	$flagvalues=array("$batchno");
	$k=@mysqli_query($conn,SQLretrieve('access_pin',$fields,$flagfields,$flagvalues));
	
	if($k!=false){
	$new=0;
	$i=0;
		while($val=@mysqli_fetch_array($k)){
			#echo "we - $i<br>";
			$details[$i]=$val;
			$i++;
		}
	}
	?>
    <input type="hidden" name="dtotal" id="dtotal" value="<?php echo count($details);?>" />
    <?php
    	#echo "2 - <br>$batchno ".count($details);
	?>
    <table class="table table-responsive table-hover">
    <thead>
    	<!--th><input type="checkbox" name="seleAll" id="seleAll" /></th--><th>SN</th><th>CNo.</th><th>Pin</th><th>Rem. usage</th><th>userID</th><th>Purp.</th>
    </thead>
    <tbody>
    <?php
	$j=1;
	for($i=(count($details)-1);$i>=0;$i--){
		?>
        <tr><!--td><input type="checkbox" name="<?php #echo "pin$j";?>" id="<?php #echo "pin$j";?>" value="<?php #echo "{$details[$i][3]}";?>" /></td--><td><?php echo "$j.";?></td><td><?php echo "{$details[$i][3]}";?></td><td><?php 
		echo "{$details[$i][4]}";
		?></td><td><?php 
		$period=$details[$i][6];
		$login=$details[$i][7];
		$remaining=$period-$login;
		echo "$remaining";
		?></td><td><?php echo "{$details[$i][8]}";?></td><td><?php echo "{$details[$i][10]} {$details[$i][9]}";?></td></tr>
        <?php
		$j++;
	}
	?>
    </tbody>
    </table>
    <?php
}
function activatePinSetStatus($id){
global $conn;
	$msg="";
	$field=array();
	$flagfields=array('batch_no');
	$flagvalues=array($id);
	
	$passportFile=@mysqli_query($conn,SQLretrieve("access_pin",$field,$flagfields,$flagvalues));
	
	if($passportFile!=false){
		if($val=mysqli_fetch_array($passportFile)){
		#sql to removes record from student table
			if($val['activate_for_use_status']==''){
				$sql="update access_pin set activate_for_use_status='on' where batch_no='$id'";
			}else{
				$sql="update access_pin set activate_for_use_status='' where batch_no='$id'";
			}
			@mysqli_query($conn,$sql);

		}
	}
}
function getPublishedStatus($pubstatus){
	$msg='';
	if($pubstatus==''){
		$msg='Pending';
	}else{
		$msg='Published';
	}
	return $msg;
}
function getActiveStatus($activeStatus){
	$msg='';
	if($activeStatus==''){
		$msg='Suspended';
	}else{
		$msg='Active';
	}
	return $msg;
}
function seeSchoolCardUsageHistory($schlid){
	$school=getSchoolDetails($schlid);
	global $conn;	
	$fields=array('batch_no','cdate','student_id','card_status','first_login_date');
	$flagfields=array('card_status','activate_for_use_status');
	$flagvalues=array('used','on');
	$all=array();
	
	$k=@mysqli_query($conn,SQLretrieve('access_pin',$fields,$flagfields,$flagvalues));
	#get students id
	if($k!=false){
		$i=0;
		while($val=@mysqli_fetch_array($k)){
			$all[$i]=$val;
		}
	}
	
	?>
    <div>
    <b>Below is the list of access pins and their useage rate of </b><br /><?php echo $school[8]." ".$school[3]?> <br />with their batch nos.<br />
    </div>
    <div>
        <hr />
        <?php
        	monthlyCardUsage($schlid);
		?>
    </div>
    
    <div>
     <a class="btn btn-block" href="schoolstatics.php?id=<?php echo "$schlid";?>" target="_new" style="background:#060; color:#FFF;"> View details </a>
     
    </div>
    <?php
}
function yearlyCardUsageForDetails(){
	#get year of registration
	#search through the result table to get the pins produced in that year
	#from the list, get the number of users that came from this school.
	#determine the percentage and out put it in a percentage format.
}
function monthlyCardUsage($schlid){
	#get year of registration
	#search through the result table to get the pins produced in that year
	#from the list, get the number of users that came from this school.
	#determine the percentage and out put it in a percentage format.
	okCheck($schlid);
}
function monthlyPinUsed($arrays,$month,$batchno){
	$alldate='';
	$count=0;
	$used=0;
	
	for($i=0;$i<count($arrays);$i++){
		$alldate=explode('/',$arrays[$i][1]);#take the content of date field
		$cmonth=$alldate[1];
		
		if($cmonth==$month && $batchno=$arrays[$i][0]){#validate using the content of batchno field
			
			if(!empty($arrays[$i][3])){#validate the content of card status field.
				$used++;
			}
			$count++;
		}
	}
	echo "<br> {$arrays[0][0]} : {$arrays[0][1]} : {$arrays[0][2]} : {$arrays[0][3]}- <br>";
	$percentage_used=($used/$count)*100;
	$unused=100-$percentage_used;
	echo "$batchno : % used = $percentage_used | % unused = $unused <br>";
}
function batchPercentageUsage($batchno,$schlid){
	#get access pins batches with on status.
	#if status is used, and schlid is part of student id, count increment count by one.
	#finally, calculate % usage of the batch, by the said school. 
	
}
function allBatches(){
	global $conn;
	$fields=array("batch_no");
	$flagfields=array();
	$flagvalues=array();
	
	$k=@mysqli_query($conn,SQLretrieve('access_pin',$fields,$flagfields,$flagvalues));
	if($k!=false){
		$i=0;
		$batch_no="";
		$allBatches=array();
		while($val=mysqli_fetch_array($k)){
			if($batch_no!=$val["batch_no"]){
				$batch_no=$val["batch_no"];
				$allBatches[$i]=$val["batch_no"];
				$i++;
			}
		}
	}
	
	return $allBatches;
}
function okCheck($schlid){#there is no cause for alarm. this function behaves this way because, the school id are just single digit items.
	$batch_nos=allBatches();
	$avails='';
	global $conn;
	
	echo "<h4> No. of batches in access pin table, ".count($batch_nos)."</h4>";
	
	for($i=0;$i<count($batch_nos);$i++){
		$fields=array('student_id');
		$flagfields=array('batch_no');
		$flagvalues=array("{$batch_nos[$i]}");
		
		$k=@mysqli_query($conn,SQLretrieve('access_pin',$fields,$flagfields,$flagvalues));
		
		if($k!=false){
			$count=0;
			$cardno=0;
			while($val=@mysqli_fetch_array($k)){
				$cardno++;
				if(stristr($val['student_id'],$schlid)==true){
					$count++;
				}
				
			}
			if($count>0){
				$perUsage=($count/$cardno)*100;
				$perUnused=100-$perUsage;
				#add to set
				$avails.="{$batch_nos[$i]} : $count - $perUsage% used : $perUnused% unused |";
			}
		}
	}
	if($avails!=""){
		$usage=explode("|",$avails);
		for($i=0;$i<count($usage);$i++){
			echo "{$usage[$i]}</br>";
		}
	}else{
		echo "School has not started using pin.";
	}
}
function updateAccStatus($schlid){
	$fields=array('activation_status');
	$flagfields=array('schlid');
	$flagvalues=array("$schlid");
	$sql='';
	global $conn;
		
	$k=mysqli_query($conn,SQLretrieve('school_admin',$fields,$flagfields,$flagvalues));
	if($k!=false){
		if($val=@mysqli_fetch_array($k)){
			if($val['activation_status']==''){
				$sql="update school_admin set activation_status='on' where schlid='$schlid'";
			}else{
				$sql="update school_admin set activation_status='' where schlid='$schlid'";
			}
		}
	}
	#echo "$sql<br>";
	@mysqli_query($conn,$sql);
						
}
function removePinSet($id){
	if($id!=''){
		$sql="delete from access_pin where batch_no='$id'";		
		@mysqli_query($conn,$sql);
	}
}
function getNoOfPins($batchno){
	global $conn;
	
	$admin='';
	$fields=array();
	$flagfields=array('batch_no');
	$flagvalues=array($batchno);
	$k=@mysqli_query($conn,SQLretrieve('access_pin',$fields,$flagfields,$flagvalues));
	$no=0;
	if($k!=false){
		while($val=mysqli_fetch_array($k)){
			$no++;
		}
	}
	return $no;
}
function getActivationStatus($pinStatus){
	$msg='';
	if($pinStatus==''){
		$msg='Pending';
	}else{
		$msg='Activated';
	}
	return $msg;
}

function getAccounts($page,$start,$limit){
	global $conn;
	?>
    <input type="hidden" name="total" id="total" value="<?php echo $limit;?>">
    <input type="hidden" name="start" id="start" value="<?php echo $start;?>">
    <?php
	#echo "$page,$start,$limit<br>";
	$sql="select * from school_admin LIMIT $start, $limit";
	$k=@mysqli_query($conn,$sql);
	if($k!=false){
		?>
        <table class="table table-hover">
        <thead>
    	<tr><th><input type="checkbox" id="selall" name="selall"></th><th>SN</th><th>School ID</th><th>School Details</th><th>publish Status</th><th>Active status</th></tr>
        </thead>
        <tbody>
        <?php
		$i=$start;
		while($val=mysqli_fetch_array($k)){
			?>
            
            <?php
			$j=$i+1;
			
			$schl=getSchoolDetails($val['schlid']);
			?>
            <tr><td><input type="checkbox" id="item<?php echo $j;?>" name="item<?php echo $j;?>" value="<?php echo $val['schlid'];?>"></td><td><?php echo "$j";?></td><td style="cursor:pointer;" data-target="#cardUseageRate" data-toggle="modal" onClick="loadCardUsageHistory(<?php echo $val['schlid'];?>);"><div class="btn"><?php echo "{$val['schlid']}";?></div></td><td><?php echo @"<b>{$val['schoolName']}({$schl[3]})</b><br><b>Email : </b>{$val['email']}<br><b>Phone : </b>{$val['phone']}<br><b>Site Admin : </b>{$val['name']}({$val['adminID']})";?></td><td><?php echo getPublishedStatus(@$schl[14]);?></td><td><?php echo getActiveStatus($val['activation_status']);?></td></tr>
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
global $conn;
	#fetch all the data from the database
		$sql="select * from school_admin";
		$g=@mysqli_query($conn,$sql);
		$row=mysqli_num_rows($g);
		
		#calculate total page number for the given table in the database
		$total=ceil($row/$limit);
		?>
        <div class="btn-group">
        <?php
		if($page>1){
			#goto previous page to show previous 10 items. if its in page 1then it is in active
			?>
            <a href="" class="btn">Previous</a>
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
            <a href="" class="btn">Next</a>
            <?php
		}
		?>
		</div>
        <?php
}
#############################################################################

function getAdverts($page,$start,$limit){
global $conn;
	?>
    <input type="hidden" name="total" id="total" value="<?php echo $limit;?>">
    <input type="hidden" name="start" id="start" value="<?php echo $start;?>">
    <?php
	#echo "$page,$start,$limit<br>";
	$sql="select * from Advert LIMIT $start, $limit";
	$k=@mysqli_query($conn,$sql);
	if($k!=false){
		?>
        <table class="table table-hover">
        <thead>
    	<tr><th><!--input type="checkbox" id="selall" name="selall"--></th><th>SN</th><th>Title</th><th>Dimension (px)</th><th>Validity Period</th><th>publish Status</th></tr>
        </thead>
        <tbody>
        <?php
		$i=$start;
		while($val=mysqli_fetch_array($k)){
			?>
            
            <?php
			#echo "we - $i<br>";
			$j=$i+1;
			#$details[$i]=$val;
			$schl=getSchoolDetails($val['schlid']);
			?>
            <tr><td><input type="checkbox" id="item<?php echo $j;?>" name="item<?php echo $j;?>" value="<?php echo $val['orderID'];?>"></td><td><?php echo "$j";?></td><td style="cursor:pointer;" data-target="#adminPreviewAds" onclick="adminloadAdsImg('<?php echo "{$val['orderID']}";?>');" data-toggle="modal"><?php echo "{$val['ads_title']}";?></td><td><?php echo @"{$val['ads_dimension']}<br><b>Install date : </b>{$val['install_date']}<br><b>Start date : </b>{$val['start_date']}<br><b>Owner : </b>{$schl[8]}<br><b>Order id : </b>{$val['orderID']}<br><b>User enabled status</b> : {$val['user_enabled']}<br><b>Cost : </b>N".calculateAdscost($val['availability_period']);?></td><td><?php echo "{$val['availability_period']}";?></td><td><?php 
			adminMonitorAdsexpiration($val['orderID']);
			echo getPublishedStatus($val['publish_status']);?></td></tr>
            <?php
			$i++;
		}
	}
		?>
        </tbody>
        </table>
        <?php
}
function listAdvertPages($page,$start,$limit){
global $conn;
	#fetch all the data from the database
		$sql="select * from Advert";
		$g=@mysqli_query($conn,$sql);
		$row=mysqli_num_rows($g);
		
		#calculate total page number for the given table in the database
		$total=ceil($row/$limit);
		?>
        <div class="btn-group">
        <?php
		if($page>1){
			#goto previous page to show previous 10 items. if its in page 1then it is in active
			?>
            <a href="" class="btn">Previous</a>
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
            <a href="" class="btn">Next</a>
            <?php
		}
		?>
		</div>
        <?php
}


function getSchoolGrading($schlid){
global $conn;
	$grading='';
	$fields=array();
	$flagfields=array('schlid');
	$flagvalues=array($schlid);
	$k=@mysqli_query($conn,SQLretrieve('school',$fields,$flagfields,$flagvalues));
	if($k!=false){
		if($val=@mysqli_fetch_array($k)){
			$grading=$val['grading_profile'];
		}
	}
	return $grading;
}
function getClassLowest($subject,$schlid,$class,$session,$term){
global $conn;
	#retrieve record
	$fields=array('studID','tscore','examscore','practscore');
	$flagfields=array('subject_name','schlid','class_id','session','term');
	$flagvalues=array($subject,$schlid,$class,$session,$term);
	$sorted=array();
	$id=array();
	
	$k=@mysqli_query($conn,SQLretrieve('result',$fields,$flagfields,$flagvalues));
	if($k!=false){
		$i=0;
		$lscore=100;
		
		while($val=@mysqli_fetch_array($k)){
			$tscore=$val['tscore'];
			$examscore=$val['examscore'];
			$practscore=$val['practscore'];
			
			$totalscore=$tscore+$practscore+$examscore;
			
			if($totalscore<$lscore){
				$lscore=$totalscore;
			}
		}
	}
	return $lscore;
}
function getClassHighest($subject,$schlid,$class,$session,$term){
global $conn;
	#retrieve record
	$fields=array('studID','tscore','examscore','practscore');
	$flagfields=array('subject_name','schlid','class_id','session','term');
	$flagvalues=array($subject,$schlid,$class,$session,$term);
	$sorted=array();
	$id=array();
	
	$k=@mysqli_query($conn,SQLretrieve('result',$fields,$flagfields,$flagvalues));
	if($k!=false){
		$i=0;
		$Highestscore=0;
		
		while($val=@mysqli_fetch_array($k)){
			$tscore=$val['tscore'];
			$examscore=$val['examscore'];
			$practscore=$val['practscore'];
			
			$totalscore=$tscore+$practscore+$examscore;
			
			if($totalscore>$Highestscore){
				$Highestscore=$totalscore;
			}
		}
	}
	return $Highestscore;
}	
function getClassAve($schlid,$subject,$classid){
	
}
function getStudentRemark($schlid,$subject){
	
}
function generateStudID($schlid,$yearofad,$pop){
	#get the existing studid for this class
	#if already existing, check for the highest of them,
	#start counting from there.
	#if non already existing for the class, start counting from 1
	#the pattern for the Id is schlid|classid|001
	
	#get others in student table
global $conn;
	if(isset($schlid) && isset($yearofad)){
		
		$fields=array('studID');
		$flagfields=array('schlID','class_id');
		$flagvalues=array($schlid,$yearofad);
		
		$studID=array();
		$finalvalue="";
		$highestNo="";
		
		$test=0;
		
		$val=@mysqli_query($conn,SQLretrieve("student",$fields,$flagfields,$flagvalues));
		while($ok=@mysqli_fetch_array($val)){
			$sub='';
			$count=strlen($ok['studID']);
			$we=$ok['studID'];
			
			$set=$ok['studID'];
			for($i=($count-3);$i<=$count;$i++){
				$sub.=substr($set,$i,1);
			}
			
			if($sub>$test){
				$test=$sub;
			}
		}
		$highestNo=$test;
		
		$i=0;
		
		$curSchlid=$highestNo+1;
		for($j=$curSchlid;$j<($curSchlid+$pop);$j++){
			if(strlen($j)==2){
				$finalvalue="0".$j;
				
			}elseif(strlen($j)==1){
				$finalvalue="00".$j;
				
			}else{
				$finalvalue=$j;
			}
			$studID[$i]="$schlid$yearofad$finalvalue";
			$i++;	
		}
	}
	return $studID;
}
function generateSchlID($state,$location){
	#get school location
	#get the existing school in similar location, and check the heighest of them,
	#start counting from there.
	#if non already existing in the area/location, start counting from 1
	#the format for the id is stateid|areaID|001
global $conn;	
	#get others in school table
	$fields=array('schlid');
	$flagfields=array('State','location');
	$flagvalues=array($state,$location);
	
	$highestNo="";
	
	$IDs=explode(":",getLocationID($state,$location));
	
	$stateID=$IDs[0];
	$locationID=$IDs[1];
	
	#echo "Original State : $state ($stateID) | Location : $location($locationID)<br>______<br>";
	
	$val=@mysqli_query($conn,SQLretrieve("school",$fields,$flagfields,$flagvalues));
	if($val!=false){
		$test=0;
		#echo "No of records in the array ".mysqli_affected_rows($conn)."<br>";
		while($ok=mysqli_fetch_array($val)){
			$sub='';
			
			#echo "current ID : {$ok['schlid']}<br>";
			
			$count=strlen($ok['schlid']);
			$we=$ok['schlid'];
			
			$set=$ok['schlid'];
			for($i=($count-3);$i<=$count;$i++){
				$sub.=substr($set,$i,1);
			}
			
			if($sub>$test){
				$test=$sub;
			}
			#echo "Current Highest: $test<br>";
		}
		$highestNo=$test;
		
		$curSchlid=$highestNo+1;
		if(strlen($curSchlid)==2){
			$curSchlid="0".$curSchlid;
			
		}elseif(strlen($curSchlid)==1){
			$curSchlid="00".$curSchlid;
			
		}
		$schlid="$stateID$locationID$curSchlid";	
	}
	return $schlid;
}
function getLocationID($state,$location){
	$stateID="";
	$locationID="";
	
	global $conn;
		
	$fields=array('stateID','locationID','location');
	$flagfields=array('state');
	$flagvalues=array($state);
	
	$val=@mysqli_query($conn,SQLretrieve("shippment_cost",$fields,$flagfields,$flagvalues));
	
	if($val!=false){
		while($ok=mysqli_fetch_array($val)){
			$stateID=$ok['stateID'];
			#echo "this is the location ID : $location-{$ok['location']}-{$ok['locationID']}<br>";
			if($location==$ok['location']){
				$locationID=$ok['locationID'];
				break;
			}else{
				$locationID="000";
			}
		}
		$value="$stateID:$locationID";
	}
	return $value;
}

function generateBatchID($validityPeriod){#batches are produced once for every group
	#get year,month,day n validity period
	#check the batch no to detect the last batch
	#increase the batch no by 1
	#add 5 to years
	#convert year n month into alphabet, using this convention
	#:array(0=>'A','B','C','D','E','F','I','J','K','L');
	#The format for batchID is no|validityno|month|year
	
	global $conn;
		
	$batchno='';
	$year=date('Y');
	$month=date('m');
	$day=date('d');
	
	$year=$year+5;
	#echo "$month | $year<br>";
	if(strlen($month)==1) $month="0$month";
	$newMonth='';
	$newYear='';
	
	$all=array(0=>'A','B','C','D','E','F','I','J','K','L');
	
	$fields=array('batch_no');
	$flagfields=array('leasing_period');

	$flagvalues=array($validityPeriod);
	
	$val=@mysqli_query($conn,SQLretrieve("access_pin",$fields,$flagfields,$flagvalues));
	
	if($val!=false){
		$test=0;
		while($ok=mysqli_fetch_array($val)){
			$sub='';
			$count=strlen($ok['batch_no']);
			$we=$ok['batch_no'];
			
			$set=$ok['batch_no'];
			$sub=substr($set,0,3);
			#echo "$set | $sub <br>";
			if($sub>$test){
				$test=$sub;
			}
		}
		$highestNo=$test;
		$newNo=$highestNo+1;
		
		if(strlen($newNo)==2){
			$newNo="0".$newNo;
			
		}elseif(strlen($newNo)==1){
			$newNo="00".$newNo;
			
		}
		
		for($i=0;$i<strlen($year);$i++){
			$newYear.=$all[substr($year,$i,1)];
		}
		for($j=0;$j<strlen($month);$j++){
			$newMonth.=$all[substr($month,$j,1)];
		}
		$batchno="$newNo$validityPeriod$newMonth$newYear";
	}
	return $batchno;
}
function formulatePin($no){
	#get year, month, day, time, n 4 numbers generated from scrambling
	#reshuffle the numbers to get the pins
	#also list serial number, which is batchno + sn of each pin
	#which is presented in this format : sn|batchno
	
	$year=date('Y');
	$month=date('m');
	$day=date('d');
	$all=array(0=>'G','H','I','J','K','L','M','N','O','P');
	$seg="";
	$nMonthday="";
	
	$sno='';
	$ok=0;
	while($ok<=9){
		$sno.=mt_rand(1,30);
		
		if(strlen($sno)>=9){
			break;
		}
		$ok++;
	}
	$remainder=strlen($sno)-9;
	if($remainder!=0) $sno=substr($sno,0,9);
	
	if(strlen($month)<2) $month="0$month";
	if(strlen($day)<2) $day="0$day";
	
	$monthday=trim("$month$day");
	
	for($j=0;$j<strlen($monthday);$j++){
		$nMonthday.=$all[substr($monthday,$j,1)];
		#echo "<hr>".substr($nMonthday,$j,1)."wow <b>".strlen($nMonthday)."is the string length</b> <hr>";
	}
	for($i=0;$i<9;$i=$i+3){
		#echo "<br>$i.<br>";
		$locate=mt_rand(0,3);
		#if(strlen($seg)<=10){
		if(($i)<=3){
			$seg.=substr($sno,$i,3).substr($nMonthday,$locate,1)."-";
		}else{
			$seg.=substr($sno,$i,3).substr($nMonthday,$locate,1);
		}
	}
	return $seg;
}
function listPins($no,$period){
	$batchno=generateBatchID('3');
	$records=array();
	
	global $conn;	
	$fields=array('batch_no');
	$flagfields=array('batch_no');
	$flagvalues=array("$batchno");
	$k=@mysqli_query($conn,SQLretrieve('access_pin',$fields,$flagfields,$flagvalues));
	
	if($k!=false){
		if($val=mysqli_fetch_array($k)){
			
		}else{
			for($j=1;$j<=$no;$j++){
				if(strlen($j)==2) $k="0$j";
				if(strlen($j)==1) $k="00$j";
				$newPin=formulatePin($no);
				
				$records[$j]="$batchno|$k$batchno|$newPin|$period|".date('d/m/Y');
				
			}
			$i=1;
			while($i<=count($records)){
				$rec=explode('|',$records[$i]);
				$bno=$rec[0];
				$sno=$rec[1];
				$pin=$rec[2];
				$peri=$rec[3];
				$cdate=$rec[4];
				
				$sql="insert into access_pin set batch_no='$bno', cdate='$cdate', pinSN='$sno', leasing_period='$peri', pin='$pin'";
				@mysqli_query($conn,$sql);
				$i++;
			}
		}
	}
	
	#echo $batchno;
}
function decrypt($encrypted_string) { 
    $dirty = array("+", "/", "=");
    $clean = array("_PLUS_", "_SLASH_", "_EQUALS_");

    $string = base64_decode(str_replace($clean, $dirty, $encrypted_string));

    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $_SESSION['encryption-key'],$string, MCRYPT_MODE_ECB, $_SESSION['iv']);
    return $decrypted_string;
}
function encrypt($pure_string) {
    $dirty = array("+", "/", "=");
    $clean = array("_PLUS_", "_SLASH_", "_EQUALS_");
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $_SESSION['iv'] = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $_SESSION['encryption-key'], utf8_encode($pure_string), MCRYPT_MODE_ECB, $_SESSION['iv']);
    $encrypted_string = base64_encode($encrypted_string);
    return str_replace($dirty, $clean, $encrypted_string);
}
function loadState($curState){
	//if($schlid!=''){
		$states=array();
		
		global $conn;
				
		$fields=array('state','stateid');
		$flagfields=array();
		$flagvalues=array();
		
		$k=@mysqli_query($conn,SQLretrieve('shippment_cost',$fields,$flagfields,$flagvalues));
		
		if($k!=false){
			$i=0;
			while($val=mysqli_fetch_array($k)){
				$name=$val['state'];
				$id=$val['stateid'];
				$all="$name:$id";
				
				if(!in_array($all,$states)){
						$states[$i]=$all;
						$i++;
				}
			
			}
		}
		
		for($j=0;$j<count($states);$j++){
			$value=explode(':',$states[$j]);
			
			$name=$value[0];
			$id=$value[1];
			
			if($curState!=''){
				if($curState==$name){
					?>
                    	<option selected="selected" value="<?php echo $name;?>"><?php echo $name;?></option>
                    <?php
				}else{
					?>
                    <option value="<?php echo $name;?>"><?php echo $name;?></option>
                    <?php	
				}	
			}else{
			?>
				<!--option value="<?php echo $id;?>"><?php echo $name;?></option-->
                <option value="<?php echo $name;?>"><?php echo $name;?></option>
            <?php
			}
		}
		
	//}
}
function loadlocation($state,$curlocation){
global $conn;
	if($state!=''){
		$fields=array('location','locationid');
		$flagfields=array('state');
		$flagvalues=array($state);
		
		$k=@mysqli_query($conn,SQLretrieve('shippment_cost',$fields,$flagfields,$flagvalues));
		
		if($k!=false){
			while($val=mysqli_fetch_array($k)){
				$location=$val['location'];
				$id=$val['locationid'];
				if($curlocation!=''){
					if($curlocation==$location){
						?>
                        <option value="<?php echo $location;?>" selected="selected"><?php echo $location;?></option>
                        <?php
					}else{
						?>
                        <option value="<?php echo $location;?>"><?php echo $location;?></option>
                        <?php
					}
				}else{
				?>
				<option value="<?php echo $location;?>"><?php echo $location;?></option>
                <?php
				}
			}
		}
	}
}
function uploadLogo($logo,$schlid){
$msg="";
if($logo['name']!='' && $logo['size']<=20000){
	$ext=explode('.',$logo['name']);
		if($ext[1]=='png'){
			
			if($logo['tmp_name']!=''){
				
				$dest="school/$schlid.png";
				move_uploaded_file($logo['tmp_name'],$dest);
				return $dest;
			}
			
		}else{
			$msg='<p class="alert alert-error">The picture file format is not supported</p>';	
		}		
}else{
	$msg='<p class="alert alert-error">The selected file size is bigger than 20kb</p>';
}
	#if($msg!='') return $msg;
}
function displayLogo($schlLogo){
	if($schlLogo!=''){
		return "<img src='$schlLogo' align='left' width=\"80px\">";
	}else{
		return "<img src='img/icons/icon-home.png' align='left' width=\"80px\">";
	}
}
function displayAds($dimension){
	if($dimension=='2x5'){
		echo "<img src='".getAds($dimension)."' width='200px' height='500px'>";
	}elseif($dimension=='5x2'){
		echo "<img src='".getAds($dimension)."' width='500px' height='200px'>";
	}
}
function getAds($dim){
	#get the dimension
	#search through the db to extract ads with the required ads dimension
	#get the total number of records
	#randomly generate from the extracted records.
	
	global $conn;
	
	$fields=array('install_date','availability_period','start_date','path');
	$flagfields=array('ads_dimension','publish_status');
	$flagvalues=array($dim,'on');
	$ads=array();
	
	$isAvailable=false;
	
	$ok=@mysqli_query($conn,SQLretrieve('advert',$fields,$flagfields,$flagvalues));
	
	#$recordNo=mysqli_affected_rows($conn);
	
	if($ok!=false){
		$i=0;
		#while($val=mysqli_fetch_array($ok)){
		while($val=mysqli_fetch_array($ok)){
			$startDate=$val['start_date'];
			$period=$val['availability_period'];
			
			$alldate=explode('/',$startDate);
			
			$sDay=$alldate[0];
			$sMonth=$alldate[1];
			$sYear=$alldate[2];
			
			$j=$sDay;
			
			while($j<=$period){
				$sDay++;
				if($sDay==28){
					if($sMonth<12){ 
						$sMonth++;
					}else{
						$sYear++;
						$sMonth=1;
					}
					$sDay=1;
				}
				$j++;
			}
			#assemble expiration period
			$expDate="$sDay/$sMonth/$sYear";
			
			$curDate=date("d/m/Y");
			#echo "$expDate ---<br>";
			if($curDate<=$expDate){
				$ads[$i]=$val['path'];
				$isAvailable=true;
				$i++;
			}
			
		}
	}
	if($isAvailable==true){
		#generate number from the record size
		$i--;
		return $ads[mt_rand(1,$i)];
	}
}
function viewOrderedCBTHistroy($schlid){
global $conn;	
	$fields=array();
	$flagfields=array("schoolID");
	$flagvalues=array($schlid);
	
	$ok=@mysqli_query($conn,SQLretrieve('ordered_premuim_cbt',$fields,$flagfields,$flagvalues));
	
	if($ok!=false){
		?>
		<table width="100%" class="table table-hover font2">
        <tbody>
		<?php
		$i=1;
		while($val=mysqli_fetch_array($ok)){
			?>
            <tr>
            	<td><?php echo $val['order_date'];?> | 
                <strong>Total Cost (N) : </strong><?php echo $val['Total_cost']?>
                <span class="btn-group">
                <div class="btn btn-small"><?php echo $val['orderID'];?> <span><?php echo displayStatus($val["status"]);?></span></div>
                 <?php #if($val['status']!='done'){?>
                   <button class="btn btn-info btn-small" onclick="removeOrderedcbt('<?php echo $val['orderID'];?>');"> Remove </button>
                 <?php #} ?>       
                </span>
				
            </td>
            </tr>
            <?php
			$i++;
		}
		?>
		</tbody>
        </table>
        <div><input type="hidden" name="total" id="total" value="<?php echo $i;?>" /></div>
        <!--div><input type="button" name="btnOrderPin" id="btnOrderPin" value="Order pins" data-target="#pinOrderForm" data-toggle="modal" class="btn btn-block btn-info" /></div-->
        	
		<?php
	}

}
function viewOrderedAdHistroy($schlid){
global $conn;
	$fields=array();
	$flagfields=array("schlid",'user_enabled');
	$flagvalues=array($schlid,'on');
	
	$ok=@mysqli_query($conn,SQLretrieve('advert',$fields,$flagfields,$flagvalues));
	
	if($ok!=false){
		?>
		<table width="100%" class="table table-hover font2">
        <tbody>
		<?php
		$i=1;
		while($val=mysqli_fetch_array($ok)){
			?>
            <tr>
            	<td><?php echo $val['install_date'];?> | <span class="btn btn-info btn-small" onclick="loadAdsImg('<?php echo $val['orderID'];?>');" data-target="#previewAds" data-toggle="modal">Preview ads</span> <br /><div class="btn-group adsTitle">
                <a href="#" data-toggle="dropdown" class="btn btn-link btn-small remove-underline dropdown-toggle"><?php echo $val['ads_title'];?> <span class="caret"></span></a>
                <ul class="dropdown-menu"  role="menu" aria-labelledby="dlabel">
                    <li>
                    	<div class="sdropdown2 font2">
                        <div><strong>Start date : </strong><br /><?php echo $val['start_date']?></div>
                        <div><strong>Advert period : </strong><br /><?php echo $val['availability_period']?></div>
                        <div><strong>Advert Dimension : </strong><br /><?php echo $val['ads_dimension']?></div>
                        
                        <div class="clear"></div>
                        <?php if($val['publish_status']!='on'){?>
                        <button class="btn btn-info btn-small" onclick="removeOrderedAds('<?php echo $val['orderID'];?>');"> Remove Ads </button>
                        <?php }?>
                        </div>
                    </li>
                </ul>
                </div>
				<span><?php echo displayStatus($val["publish_status"]);?></span>
            </td>
            </tr>
            <?php
			$i++;
		}
		?>
		</tbody>
        </table>
        <div>
        <input type="hidden" name="total" id="total" value="<?php echo $i;?>" />
        </div>
        
        <div><input type="button" name="btnOrderAds" id="btnOrderAds" value="Order Ads" data-target="#placeAds" data-toggle="modal" class="btn btn-block btn-info" /></div>
        	
		<?php
	}
	
}
function viewOrderedPinHistroy($schlid){
global $conn;
	$fields=array();
	$flagfields=array("schoolID",'user_enabled');
	$flagvalues=array($schlid,'on');
	
	$ok=@mysqli_query($conn,SQLretrieve('ordered_access_pin',$fields,$flagfields,$flagvalues));
	
	if($ok!=false){
		?>
		<table width="100%" class="table table-hover font2">
        <tbody>
		<?php
		$i=1;
		while($val=mysqli_fetch_array($ok)){
			?>
            <tr>
            	<td><?php echo $val['order_date'];?><br /><div class="btn-group adsTitle">
                <a href="#" data-toggle="dropdown" class="btn btn-link btn-small remove-underline dropdown-toggle"><?php echo $val['orderID'];?> <span class="caret"></span></a>
                <ul class="dropdown-menu"  role="menu" aria-labelledby="dlabel">
                    <li>
                    	<div class="sdropdown2 font2">
                        <div><strong>Pin Quantity : </strong><br /><?php echo $val['Qty']?></div>
                        <div><strong>Total Cost (N) : </strong><br /><?php echo $val['Total_cost']?></div>
                        <div><strong>Method of shippment : </strong><br /><?php echo $val['Shippment_method']?></div>
                        
                        <div class="clear"></div>
                        <?php if($val['status']!='done'){?>
                        <button class="btn btn-info btn-small" onclick="removeOrderPin('<?php echo $val['orderID'];?>');"> Remove </button>
                        <?php } ?>
                        </div>
                    </li>
                </ul>
                </div>
				<span><?php echo displayStatus($val["status"]);?></span>
            </td>
            </tr>
            <?php
			$i++;
		}
		?>
		</tbody>
        </table>
        <div><input type="hidden" name="total" id="total" value="<?php echo $i;?>" /></div>
        <div><input type="button" name="btnOrderPin" id="btnOrderPin" value="Order pins" data-target="#pinOrderForm" data-toggle="modal" class="btn btn-block btn-info" /></div>
        	
		<?php
	}
}
function removePinID($orderid){
global $conn;
	#$sql="delete from ordered_access_pin where orderID='$orderid'";
	$sql="update ordered_access_pin set user_enabled='' where orderID='$orderid'";
	mysqli_query($conn,$sql);
	
}
function removeAdsID($orderID){
global $conn;
	if($orderID!==''){
		$sql="update advert set user_enabled='' where orderID='$orderID'";
		mysqli_query($conn,$sql);
	}
}
function removecbtID($orderID){
global $conn;
	if($orderID!==''){
		$schlid=$_SESSION['schlid'];
		$sql="delete from ordered_premuim_cbt where schoolID='$schlid' and orderID='$orderID'";
		@mysqli_query($conn,$sql);
	}
}
function userPlaceAds($title,$dimension,$period,$schlid,$orderid){
	
	#validate the content of the requirements,
	#get the shippment cost table,
	#get the accesspin cost table
	#Determine the shipment method, if the shippment method is "send pins only", get the admins email,schid,access pin cost, total cost and save to database
	#if the shipment method is "Send pin in finished form",
	#get the school location, admin email, qty, pin cost, total cost and send to database.
	#echo "<br>$title,$dimension,$period,$schlid,$orderid";
global $conn;
	if($schlid!='' && $dimension!='' && $period!='' && $title!=''){
		#check if order id already exist in the database
		
		$field=array();
		$flagfield=array('orderID');
		$flagvalue=array($orderid);
		
		$table=@mysqli_query($conn,SQLretrieve('advert',$field,$flagfield,$flagvalue));
		if($table!=false){
			if($v=mysqli_fetch_array($table)){
				$msg="Order already placed.";
			}else{
				$orderDate=date("d/m/Y");
				#insert record into new the accesspin order table.
				$valuelist=array(
									"$title",
									"$dimension",
									"$schlid",
									"$orderid",
									"$period",
									"$orderDate",
									"on",
									"$orderid"
								);
				$fieldlist=array(
									"ads_title",
									"ads_dimension",
									"schlid",
									"orderID",
									"availability_period",
									"install_date",
									"user_enabled",
									"ads_id"
								);
				#echo SQLinsert($valuelist,$fieldlist,'access_pin_order','','');				
				@mysqli_query($conn,SQLinsert($valuelist,$fieldlist,'advert','',''));
				$msg="Advert Order successfully completed";
			}
	}
		
		
	}else{
		$msg='One of the arguments is empty';
	}
	return $msg;

}
function calculateAdscost($days){
global $conn;	
	#validate the content of the requirements,
	#get the shippment cost table,
	#get the accesspin cost table
	#match the content and generate the result based on prices on the database.

			#get accesspin cost list
			$advertCostTable=array();
			$advertcost="";
			#echo "$days<br>";
			$fields=array("Days","cost","status");
			$flagfield=array("Days","status");
			$flagvalue=array($days,"on");
			
			$ok=@mysqli_query($conn,SQLretrieve('advert_cost',$fields,$flagfield,$flagvalue));
			$i=0;
			if($ok!=false){
				while($sval=mysqli_fetch_array($ok)){
					$advertCostTable[$i]=$sval;
					$i++;
				}
			}
			#get accespin cost
			for($j=0;$j<count($advertCostTable);$j++){
				if($advertCostTable[$j][0]==$days){# take Days
						$advertcost=$advertCostTable[$j][1];# take cost
				}
			}
		return $advertcost;
	#}

}
function userUploadAds($logo,$Adsid){
global $conn;
$msg="";
#echo $logo['name']." ".$logo['size']." oooo<br>";
if($logo['name']!='' && $logo['size']<=20000){
	$ext=explode('.',$logo['name']);
		if($ext[1]=='jpg'){
			#echo "entered 1 <br>";
			if($logo['tmp_name']!=''){
				#echo "entered 2 <br>";
				$dest="ads/$Adsid.jpg";
				move_uploaded_file($logo['tmp_name'],$dest);
				return $dest;
			}
			
		}else{
			$msg='<p class="alert alert-error">The picture file format is not supported</p>';	
		}		
}else{
	$msg='<p class="alert alert-error">The selected file size is bigger than 20kb</p>';
}
	#if($msg!='') return $msg;
}
function adminRemoveAds($orderid){
	#to remove a class is to clear its students and their result, not removal of class name
	#but must come after series of confirmation and warning.
	#it should get the number of student in the
global $conn;	
	$msg="";
	$field=array();
	$flagfields=array('orderID');
	$flagvalues=array($orderid);
	
	$adsFile=@mysqli_query($conn,SQLretrieve("advert",$field,$flagfields,$flagvalues));
	#echo "1- $orderid<br>";
	if($adsFile!=false){
		#echo "2 - $orderid<br>";
		if($val=@mysqli_fetch_array($adsFile)){
			#echo "3<br>";
			$path=$val['path'];
			
			#sql to removes record from student table
			$sql="delete from advert where orderID='$orderid'";
			#sql to remove records from result table
			#$rsql="delete from result where studID=$studID";
			#echo "$sql<br>";
			#execute actions
			@mysqli_query($conn,$sql);
			#mysqli_query($conn,$rsql);
			$msg=adminRemoveFile($path);//remove passport
		}
	}
	return $msg;
}
function adminRemoveFile($name){
	$msg="";
	#echo "$name<br>";
	if($name!=""){
		$path=explode("/",$name);
		$filename=$path[1];
		$path=$path[0];
		#echo "$filename :: $path";
		chdir('../../'.$path);
		
		@unlink($filename);
		
	}	
	$msg="removed";
	return $msg;
}
function adminPubnUnpubAds($orderID){
	global $conn;
	if($orderID!=''){
		$field=array('path','publish_status');
		$flagfields=array('orderID');
		$flagvalues=array($orderID);
		
		$adsFile=@mysqli_query($conn,SQLretrieve("advert",$field,$flagfields,$flagvalues));
		if($adsFile!=false){
			if($val=mysqli_fetch_array($adsFile)){
				if($val['path']!=''){#ensure ads without pictures are not published
					$orderDate=date("d/m/Y");
					if($val['publish_status']!='on'){
						$sql="update advert set publish_status='on', start_date='$orderDate' where orderID='$orderID'";
					}else{
						$sql="update advert set publish_status='' where orderID='$orderID'";
					}
					@mysqli_query($conn,$sql);
				}
			}
		}
	}
}
function adminMonitorAdsexpiration($orderID){
	#should check any time ads list is being opened by admin,
	#and update the the publish status of the ads using their their start date and period,
	#before listing the ads.
	
	#get the dimension
	#search through the db to extract ads with the required ads dimension
	#get the total number of records
	#randomly generate from the extracted records.
global $conn;	
	$fields=array('install_date','availability_period','start_date','path');
	$flagfields=array('publish_status','orderID');
	$flagvalues=array('on',$orderID);
	$ads=array();
	
	$isAvailable=false;
	
	$ok=@mysqli_query($conn,SQLretrieve('advert',$fields,$flagfields,$flagvalues));
	#echo "1 -<br>";
	#$recordNo=mysqli_affected_rows($conn);
	
	if($ok!=false){
		$i=0;
		#echo "2 -<br>";
		if($val=mysqli_fetch_array($ok)){
			#echo "3 -<br>";
			$startDate=$val['start_date'];
			$period=$val['availability_period'];
			
			$alldate=explode('/',$startDate);
			
			$sDay=$alldate[0];
			$sMonth=$alldate[1];
			$sYear=$alldate[2];
			
			$j=$sDay;
			
			while($j<=$period){
				$sDay++;
				if($sDay==28){
					if($sMonth<12){ 
						$sMonth++;
					}else{
						$sYear++;
						$sMonth=1;
					}
					$sDay=1;
				}
				$j++;
			}
			#assemble expiration period
			$expDate="$sDay/$sMonth/$sYear";
			
			$curDate=date("d/m/Y");
			echo "<b>Expiration Date :</b> <br>$expDate <br>";
			#echo "$curDate ---<br>";
			if(strtotime($curDate)<=strtotime($expDate)){
			#echo "4 -<br>";
				$ads[$i]=$val['path'];
				$isAvailable=true;
				$i++;
			}
			
		}
	}
	if($isAvailable!=true){
		#update the published status of the record.
		$sql="update advert set publish_status='' where orderID='$orderID'";
		mysqli_query($conn,$sql);
	}

}
function adminPlaceAds($orderid,$dimension,$period,$title,$logo){
	#validate the content of the requirements,
	#get the shippment cost table,
	#get the accesspin cost table
	#Determine the shipment method, if the shippment method is "send pins only", get the admins email,schid,access pin cost, total cost and save to database
	#if the shipment method is "Send pin in finished form",
	#get the school location, admin email, qty, pin cost, total cost and send to database.
	#echo "<br>$title,$dimension,$period,$schlid,$orderid";
global $conn;
	if($orderid!='' && $dimension!='' && $period!='' && $title!=''){
		#check if order id already exist in the database
		
		$field=array();
		$flagfield=array('orderID');
		$flagvalue=array($orderid);
		
		$table=@mysqli_query($conn,SQLretrieve('advert',$field,$flagfield,$flagvalue));
		if($table!=false){
			if($v=mysqli_fetch_array($table)){
				$msg="Advert already placed.";
			}else{
				$orderDate=date("d/m/Y");
				#insert record into new the accesspin order table.
				$dest=adminUploadAds($logo,$orderid);#copy file  to required location.
				$valuelist=array(
									"$title",
									"$dimension",
									"$orderid",
									"$period",
									"$orderDate",
									"on",
									"$orderid",
									"$dest"
								);
				$fieldlist=array(
									"ads_title",
									"ads_dimension",
									"orderID",
									"availability_period",
									"install_date",
									"user_enabled",
									"ads_id",
									"path"
								);
				#echo SQLinsert($valuelist,$fieldlist,'access_pin_order','','');				
				@mysqli_query($conn,SQLinsert($valuelist,$fieldlist,'advert','',''));
				$msg="Advert placed successfully completed";
			}
	}
		
		
	}else{
		$msg='One of the arguments is empty';
	}
	return $msg;
}
function adminUploadAds($logo,$Adsid){

$msg="";
#echo $logo['name']." ".$logo['size']." oooo<br>";
if($logo['name']!='' && $logo['size']<=20000){
	$ext=explode('.',$logo['name']);
		if($ext[1]=='jpg'){
			#echo "entered 1 <br>";
			if($logo['tmp_name']!=''){
				#echo "entered 2 <br>";
				$dest="ads/$Adsid.jpg";
				$adDest="../$dest";
				move_uploaded_file($logo['tmp_name'],$adDest);
				return $dest;
			}
			
		}else{
			$msg='<p class="alert alert-error">The picture file format is not supported</p>';	
		}		
}else{
	$msg='<p class="alert alert-error">The selected file size is bigger than 20kb</p>';
}
	#if($msg!='') return $msg;	
}
function displayStatus($status){
	if($status=='done'){
		return "<img src='img/icons/icon-on.png'>";
	}elseif($status=='pending'){
		return "<img src='img/icons/icon-off.png'>";
	}elseif($status=='on'){
		return "<img src='img/icons/icon-on.png'>";
	}else{
		return "<img src='img/icons/icon-inactive.png'>";
	}
}
##################################################Subject allocation######################################
function retrieveAllocationTable($schlid){
global $conn;
	if($schlid!=''){
		$fields=array();
		$flagfields=array();
		$flagvalues=array();
		
		echo "<table class='table table-hover'>";
		
		echo "<tr>
				<td>Sn</td>
				<td>Class</td>
				<td>Assigned group</td>
			</tr>";
		$ok=@mysqli_query($conn,SQLretrieve('subject_group_allocation',$fields,$flagfields,$flagvalues));
		#if($ok!=false){
		if(mysqli_affected_rows($conn)>0){
			#get the settings from the table
			#echo "Entered 1<br>";
			$i=1;
			while($val=mysqli_fetch_array($ok)){
				echo "<tr>
				<td>$i.</td>
				<td>{$val['term']} term {$val['session']}</td>";
				?>
				<td>
				<input type="hidden" value="<?php echo "{$val['term']} term {$val['session']}";?>" name="asso<?php echo $i;?>">
				<select name='allot<?php echo $i;?>'>
					<?php echo loadAllotedSubjectGroup($schlid,$val['subject_group_id']);?>
				</select></td><?php
				echo "</tr>";					
				$i++;
			}
		}else{

			for($j=1;$j<=6;$j++){
				defaultSubjectAllot($j,$schlid);
			}
		}
		
		echo "</table>";
	}

} 
function defaultSubjectAllot($i,$schlid){
	global $k;
	$session='';
	switch ($i) {
		case ($i==1):
			$session='JSS 1';
			break;
		case ($i==2):
			$session='JSS 2';
			break;
		case ($i==3):
			$session='JSS 3';
			break;
		case ($i==4):
			$session='SS 1';
			break;
		case ($i==5):
			$session='SS 2';
			break;
		case ($i==6):
			$session='SS 3';
			break;
	}
	if($k==0)$k=1;
	#echo "$session<br>";
	$term=array(1=>'First','Second','Third');
	for($j=1;$j<=3;$j++){
		
		echo "<tr>
				<td>$k.</td>
				<td>{$term[$j]} term $session</td>";
				?>
				<td>
				<input type="hidden" value="<?php echo "{$term[$j]} term $session";?>" name="asso<?php echo $k;?>">
				<select name='allot<?php echo $k;?>'>
                	<option value="default">default</option>
					<?php echo loadAllotedSubjectGroup($schlid,'');?>
				</select></td><?php
			echo "</tr>";						
	$k++;
	}
}
function loadAllotedSubjectGroup($schlid,$cur){
global $conn;	
	if($schlid!=''){
		$fields=array('subject_group_name','subject_group_id');
		$flagfields=array('schlid');
		$flagvalues=array($schlid);
		
		$k=@mysqli_query($conn,SQLretrieve('subject_groups',$fields,$flagfields,$flagvalues));
		
		if($k!=false){
			while($val=mysqli_fetch_array($k)){
				$name=$val['subject_group_name'];
				$id=$val['subject_group_id'];
				if($id==$cur){
				?>
				<option selected value="<?php echo $id;?>"><?php echo $name.' - '.$id;?></option>
				<?php
				}else{
				?>
				<option value="<?php echo $id;?>"><?php echo $name.' - '.$id;?></option>
				<?php
				}
			}
		}
	}
}
function saveChanges($schlid){
global $conn;
	for($i=1;$i<=18;$i++){
		$vs=mysqli_real_escape_string($conn,$_POST["asso$i"]);
		$s=explode('term',$vs);
		$session=trim($s[1]);
		$term=trim($s[0]);
		$id=mysqli_real_escape_string($conn,$_POST["allot$i"]);
		
		$fields=array();
		$flagfields=array('schlid','session','term');
		$flagvalues=array($schlid,$session,$term);
		
		$k=@mysqli_query($conn,SQLretrieve('subject_group_allocation',$fields,$flagfields,$flagvalues));
		#echo "$i - <br>";
		if(mysqli_affected_rows($conn)>0){
		#if($k!=false){
			#UPDATE row
			$sql="update subject_group_allocation set subject_group_id='$id' where schlid='$schlid' and session='$session' and term='$term'";
			#echo "$sql<br>";
			@mysqli_query($conn,$sql);
		}else{
			$sql="insert into subject_group_allocation(session,term,schlid,subject_group_id) values('$session','$term','$schlid','$id')";
			#echo "$sql<br>";
			@mysqli_query($conn,$sql);	
		}
	}
}
function checkFreeVersion($schlid){
global $conn;
	if($schlid!=''){
		$freeVersion=true;
#		$usedAccessCode=array();
		
		$fields=array();
		$flagfields=array('schlid','premum_status');
		$flagvalues=array($schlid,'');
#		echo "1 <br>";
		$ok=@mysqli_query($conn,SQLretrieve('testproperty',$fields,$flagfields,$flagvalues));
		if(mysqli_affected_rows($conn)>=1){
			$freeVersion=false;
		}
		return $freeVersion;
}

}
function verifyCBTaccountType($schlid){

#check if test with empty premuim_status exit?
	#if no create one test for the account.
	
	#else, check for an existing test 
		#if the access code on the existing test in the premuim cbt is active
			#check for due date, if due, deactivate in the prmuim cbt
			
			#else, check for exhaustion of useage, 
				#if not exhausted, create new account
				#else get new access code request.
		#if the access code on the existing test in the premuim cbt is not active
			#get new access code request
$loadNew=true;
global $conn;
if(checkFreeVersion($schlid)==false){
	#check for existing test with premum capability
		$loadNew=false;
		#$isNew=true;
		$usedAccessCode=array();
		
		$fields=array();
		$flagfields=array('schlid');
		$flagvalues=array($schlid);
		echo "1 <br>";
		$ok=@mysqli_query($conn,SQLretrieve('testproperty',$fields,$flagfields,$flagvalues));
		if(mysqli_affected_rows($conn)>1){
			#check if their is a valid premuim account payment running
			echo "2 <br>";
			$no=0;
			#$j=1;
			while($val=mysqli_fetch_array($ok)){
				#check number Accesscode associated with account
				echo "3 <br>";
				if(strlen($val['premum_status'])>0 && !in_array($val['premum_status'],$usedAccessCode)){
					echo "4 <br>";
					$usedAccessCode[$no]=$val['premum_status'];
					$no++;
					#$j=1;
				}
			}
		}else{
			#request of access pin purchase is triggered;	
			
		}
		for($i=0;$i<count($usedAccessCode);$i++){
				echo "5 $usedAccessCode[$i],$schlid <br>";
				if(verifyCBTAccessCode($usedAccessCode[$i],$schlid)==true){
					#check if a limit of ten test is reach<br>";
					echo "6 <br>";
					$limit=3;#10;
					if(checkTestlimit($usedAccessCode[$i],$limit,$schlid)==false){
						$loadNew=true;
					}else{
						$loadNew=false;
					}
				}
		}
}else{
	#create new account.
	$loadNew=true;
	
}


#################################################
}
function checkTestlimit($accessCode,$limit,$schlid){
	if($accessCode!=''){
		$limitExceeded=true;
		$fields=array();
		$flagfields=array('schlid','premum_status');
		$flagvalues=array($schlid,$accessCode);
		
		$ok=@mysqli_query($conn,SQLretrieve('testproperty',$fields,$flagfields,$flagvalues));
		if(mysqli_affected_rows($conn)<$limit){
			$limitExceeded=false;
		}
		return $limitExceeded;
	}
}
function verifyCBTAccessCode($accessCode,$schlid){
	if($accessCode!=''){
global $conn;		
		$allowAccess=false;
		$fields=array();
		$flagfields=array('access_code','schlid');
		$flagvalues=array($accessCode,$schlid);
		
		$ok=mysqli_query($conn,SQLretrieve('premuim_cbt_access_code',$fields,$flagfields,$flagvalues));
		if(mysqli_affected_rows($conn)==1){
			#verify active status
			#verify expiration date
			#if current date falls within expiration date, set allow access to true
			#else update active status to nothing. and set allow access to false
			#echo "in 1 <br>";
			if($val=mysqli_fetch_array($ok)){
				echo "in 2 <br>";
				if($val['active_status']=='on'){
					echo "in 3 <br>";
					$curDate=date("d/m/Y");#strtotime(date("d/m/Y"));
					$expDate=$val['expiration_date'];#strtotime(trim($val['expiration_date']));
					
					echo date("d/m/Y")." ".$val["expiration_date"]."<br>";
					
					echo " - $expDate<br>";
					echo "$curDate <= $expDate<br>";
					if($curDate<=$expDate){
						#echo "in 4 <br>";
						$_SESSION['cbtAccessCode']=$val['access_code'];
						$allowAccess=true;
					}else{
						$sql="update premuim_cbt_access_code set active_status='' where access_code='$accessCode' and schlid='$schlid'";
						@mysqli_query($conn,$sql);
						$allowAccess=true;
					}
				}
			}
			
		}
	return $allowAccess;	
	}
}

function checkForAvailableFreeVersion($schlid){
global $conn;
	if($schlid!=''){
		$available=false;
		#if($testName!=''){
			$fields=array();
			$flagfields=array('schlid','premum_status');
			$flagvalues=array($schlid,'');
			
			$k=@mysqli_query($conn,SQLretrieve('testproperty',$fields,$flagfields,$flagvalues));
			#echo "level 2<br>";
			if(mysqli_affected_rows($conn)>0){
				$available=true;
			}
		#}
		return $available;
	}
}
function AdminAddnewCBT($schlid,$cbtAccessCode,$testName,$testID,$instr,$noQ,$testDuration,$percentTestOp,$targetClass,$testType,$Qreshuffle){
	#echo "level 1- 1<br>";
global $conn;
	if($schlid!=''){
	#	if(checkForAvailableFreeVersion($schlid)==false){	
			if($testName!=''){
				$fields=array();
				$flagfields=array('schlid','test_title_id');
				$flagvalues=array($schlid,$testID);
				
				$k=@mysqli_query($conn,SQLretrieve('testproperty',$fields,$flagfields,$flagvalues));
				#echo "level 2<br>";
				if(mysqli_affected_rows($conn)==0){
				#	echo "Level 3<br>";
					if($instr!=''){
						$curDate=date("d/m/Y");
						$sql="insert into testproperty(schlid,test_title,test_title_id,no_of_question_per_test,test_duration,designated_class,instruction,practice_test,premum_status,testPercent,testReshuf,rdate) values('$schlid','$testName','$testID','$noQ','$testDuration','$targetClass','$instr','$testType','$cbtAccessCode','$percentTestOp','$Qreshuffle','$curDate')";
						#echo "$sql<br>";
						@mysqli_query($conn,$sql);
					}
				}else{
					#echo "testID already used.";
				}
			}
		#}
	}
	
}
function applyReactivationCode($schlid,$testid,$cbtcode){
	/*
	validate the code,
	apply the code and return  an alert.
	*/
	global $conn;
	$msg='';
	$fields=array();
	$flagfields=array('access_code','schlid');
	$flagvalues=array($cbtcode,$schlid);
	
	$ok=@mysqli_query($conn,SQLretrieve('premuim_cbt_access_code',$fields,$flagfields,$flagvalues));
	
	if(mysqli_affected_rows($conn)>0){
		if($val=mysqli_fetch_array($ok)){
			$expdate=$val['expiration_date'];
			$curdate=date('d/m/Y');
			if($curdate<$expdate){
				#check being fully used.
				
				#$usage=substr($val['access_usage'],1);
				$usage=$val['access_usage'];
				
				$all=explode(':',$usage);
				$usage_level=count($all);
				
				if($usage_level<10){#test for exhaustion of code
					#check for code already beig used by test
					if(!in_array($testid,$all)){
						#add to list
						$all[$usage_level]=$testid;
						if($usage_level==0){
							$accessusage=$all[$usage_level];
						}else{
							$accessusage=implode(':',$all);
						}
						$psql="update testproperty set premum_status='$cbtcode' where schlid='$schlid' and test_title_id='$testid'";
						$sql="update premuim_cbt_access_code set access_usage='$accessusage' where schlid='$schlid' and access_code='$cbtcode'";
						@mysqli_query($conn,$psql);
						@mysqli_query($conn,$sql);
						$msg='<p class=\'alert alert-success\'>Test has been activated.</p>';
					}else{
						$msg='<p class=\'alert alert-info\'>Code already being used by test</p>';
					}
				}else{
					$msg='<p class=\'alert alert-danger\'>Code is fully used.</p>';
				}
			}else{
				$msg='<p class=\'alert alert-info\'>Your entered premuim cbt code is has expired. <br> Please purchase another one.</p>';
			}
		}
	}else{
		$msg='<p class=\'alert alert-danger\'>Invalid or unactivated premuim cbt access code,<br>please contact admin.</p>';	
	}
	return $msg;
}
function listOfAdminCBT($schlid){
global $conn;
	if($schlid!=''){
		//if($testName!=''){
			$fields=array();
			$flagfields=array('schlid');
			$flagvalues=array($schlid);
			
			$k=@mysqli_query($conn,SQLretrieve('testproperty',$fields,$flagfields,$flagvalues));
			#echo "level 2<br>";
			if(mysqli_affected_rows($conn)>0){
				$total=mysqli_affected_rows($conn);
				?>
                	<input type="hidden" name="total" value="<?php echo $total;?>" id="total" />
                    <table class="table">
<tr><td><input type="checkbox" value="" /></td><td>SN</td><td>Name</td><td>Date</td></tr>

<?php
			$j=0;
			while($val=mysqli_fetch_array($k)){
            	$i=$j+1;
				?>
                <tr><td><input type="checkbox" name='<?php echo "item$j";?>' id='<?php echo "item$j";?>' /><input type="hidden" value="<?php echo "{$val['test_title_id']}";?>" name='<?php echo "id$j";?>' id='<?php echo "id$j";?>'></td><td><?php echo $i;?>.</td><td><a href="#" data-target="#Testproperties" onclick="loadTestProperties('<?php echo "{$val['test_title_id']}";?>')" data-toggle="modal"><?php echo strtoupper("{$val['test_title']}")."<b>[{$val['test_title_id']}]</b>";?></a><br>For <?php echo "{$val['designated_class']}";?> <br>Current Published status: <?php getPublishedStatus($val['publish_status']);?> <br /><button class="btn btn-danger" type="button" name="reAcivateTest" id="reAcivateTest" data-toggle="modal" data-target="#Testproperties" onclick="reActivate('<?php echo $val['test_title_id'];?>');">Reactivate test</button></td><td><?php echo "{$val['rdate']}";?></td></tr>
                <?php
            	$j++;
			}
			
?>
</table>
                <?php
			}else{
				echo "<div class='alert alert-info'>You are eligible to run one CBT, but currenty, you have non.</div>";	
			}
		//}
	}
}
function loadtestProperty($schlid,$testid){
global $conn;
	if($schlid!='' && $testid!=''){
		//if($testName!=''){
			$fields=array();
			$flagfields=array('schlid','test_title_id');
			$flagvalues=array($schlid,$testid);
			
			$k=@mysqli_query($conn,SQLretrieve('testproperty',$fields,$flagfields,$flagvalues));
			#echo "level 2<br>";
			if(mysqli_affected_rows($conn)>0){
				if($val=mysqli_fetch_array($k)){
					#load the values
					$testName=$val['test_title'];
					$noOfQ=$val['no_of_question_per_test'];
					$percentQ=$val['testPercent'];
					$testDuration=$val['test_duration'];
					$testType=$val['practice_test'];
					$testInst=$val['instruction'];
					$testTarget=$val['designated_class'];
					$testReshuf=$val['testReshuf'];
					$pubStatus=$val['publish_status'];
					$testStatistics=determineTestStat($schlid,$testid);#determines test statistics
					?>
                    <div class="container-fluid">
				<div class="row-fluid">
                	
                    	<div class="span8">
                
                        
                        <input type="hidden" name="testID" value="<?php echo $testid;?>" />
                        <b>TEST NAME</b> : <input type="text" name="testname" maxlength="20" id="testname" class="input input-small" value="<?php echo $testName;?>" /><br />
                        
                        <b>NO. OF QUESTIONS: 50.</b><br />
                        
                        Max. question per test :
                        <select class="input input-small" name="maxQ" id="maxQ">
                        	<?php
                            $Q=array('10','20','30');
							for($i=0;$i<count($Q);$i++){
								if($noOfQ==$Q[$i]){
									?><option value="<?php echo $Q[$i];?>" selected="selected"><?php echo $Q[$i];?></option><?php
								}else{
									?><option value="<?php echo $Q[$i];?>"><?php echo $Q[$i];?></option><?php	
								}
							}
							?>
                        </select>
                        <!--br /-->
                        
                        </div>
                	<div class="span4">
                    <div style="margin:2px 0px 2px 0px;"><button class="btn btn-small btn-block" onclick="adminAddQ('viewQ','<?php echo $testid;?>')" type="button">View question <!--(should contain edit/remove question)--></button></div>
                    <div style="margin:2px 0px 2px 0px;"><button class="btn btn-small btn-block" type="button" onclick="adminAddQ('viewQ','<?php echo $testid;?>')">Add new question</button></div>
                    <div style="margin:2px 0px 2px 0px;"><button class="btn btn-small btn-block" onclick="adminAddQ('viewR','<?php echo $testid;?>')" type="button">View test score</button></div>
                    </div>
                </div>
                <div class="row-fluid">
                	<div class="span12">
                     Percentage question to take during test operation is :
                        <select class="input input-small" name="percentQ" id="percentQ">
                        	<?php
                            $Q=array('100','90','80');
							for($i=0;$i<count($Q);$i++){
								if($percentQ==$Q[$i]){
									?><option value="<?php echo $Q[$i];?>" selected="selected"><?php echo $Q[$i];?></option><?php
								}else{
									?><option value="<?php echo $Q[$i];?>"><?php echo $Q[$i];?></option><?php	
								}
							}
							?>
                        </select>
                        <br />Test duration :<select class="input input-small" name="testDuration" id="testDuration">
                        		<?php
                            $Q=array('10','20','30','45','60','90');
							for($i=0;$i<count($Q);$i++){
								if($testDuration==$Q[$i]){
									?><option value="<?php echo $Q[$i];?>" selected="selected"><?php echo $Q[$i].'min';?></option><?php
								}else{
									?><option value="<?php echo $Q[$i];?>"><?php echo $Q[$i].'min';?></option><?php	
								}
							}
							?>
                        	</select>
                        Test type :<select class="input input-small" name="testType" id="testType">
                        <?php
                            $Q=array('Live test','Practice test');
							for($i=0;$i<count($Q);$i++){
								if($testType==$Q[$i]){
									?><option value="<?php echo $Q[$i];?>" selected="selected"><?php echo $Q[$i];?></option><?php
								}else{
									?><option value="<?php echo $Q[$i];?>"><?php echo $Q[$i];?></option><?php	
								}
							}
							?>
                            </select>
                        <div>
                        <span><b>INSTRUCTION</b></span><br />
                        <textarea rows="1" class="input-xlarge" name="instruction" id="instruction"><?php echo $testInst;?>
                        </textarea>
                        </div>
                        Targeted student : <select name="targetClass" id="targetClass" class="input-small">
                        	<?php
							$Q=array();
							$nowYear=date("Y");
							$k=0;
							for($j=$nowYear;$j>($nowYear-6);$j--){
								$Q[$k]=$j;
								$k++;
							}
							$Q[$k++]='Prospects';
                            #$Q=array('JSS 1','JSS 2','JSS 3','SS 1','SS 2','SS 3','Prospects');
							for($i=0;$i<count($Q);$i++){
								if($testTarget==$Q[$i]){
									?><option value="<?php echo $Q[$i];?>" selected="selected"><?php echo $Q[$i];?></option><?php
								}else{
									?><option value="<?php echo $Q[$i];?>"><?php echo $Q[$i];?></option><?php	
								}
							}
							?>
                        </select>
                        </span>
                        <span class="checkbox form-inline"><label for="reshuffle"><input name="reshuffle" <?php 
						if($testReshuf=='on'){
							echo "checked='checked'";
						}
						?> id="reshuffle" type="checkbox" /> Reshuffle question during test </label></span> 
                        <span>
                        <!--hr />
                    <b>QUESTION STATISTICS</b><br />
                    <?php
                    	echo determineTestStat($schlid,$testid);
					?>-->

<span class="checkbox form-inline"><label for="publish"><input name="publish" <?php 
						if($pubStatus=='on'){
							echo "checked='checked'";
						}
						?> id="publish" type="checkbox" /> Publish </label></span>
                        <br />
                        <input class="btn btn-info btn-block" type="submit" name="updateTest" id="updateTest" value="Save" />
                    </div>
                </div>
                </div>
                    <?php
				}
			}
		}
	
}
function determineTestStat($schlid,$testid){
	$msg="<div style='text-align:center;'> 1. Multiple answer : ".determineQtype('Multiple answer',$schlid,$testid)." 2. Single answer : ".determineQtype('Single answer',$schlid,$testid)." 3. illustrative multiple :".determineQtype('illustrative multiple',$schlid,$testid)." 4. illustrative Single : ".determineQtype('illustrative Single',$schlid,$testid)."</div>";
	return $msg;
}
function determineQtype($Qtype,$schlid,$testID){
global $conn;
	if($schlid!='' && $testID!='' && $Qtype!=''){
		//if($testName!=''){
			$fields=array();
			$flagfields=array('schlid','test_title_id','type_of_question');
			$flagvalues=array($schlid,$testID,$Qtype);
			
			$k=@mysqli_query($conn,SQLretrieve('testproperty',$fields,$flagfields,$flagvalues));
			#echo "level 2<br>";
			
			if(mysqli_affected_rows($conn)==-1){
				$l=0;
			}else{
				$l=mysqli_affected_rows($conn);
			}
			return $l;
			
			
		}
			
}
function AdminUpdateTestproperty($schlid,$testName,$testID,$instr,$noQ,$testDuration,$percentTestOp,$targetClass,$testType,$Qreshuffle,$pubStatus){
global $conn;
	$curDate=date("d/m/Y");
	if($schlid!='' & $testID!=''){
		
		$sql="update testproperty set test_title='$testName',no_of_question_per_test='$noQ',test_duration='$testDuration',publish_status='$pubStatus',designated_class='$targetClass',instruction='$instr',practice_test='$testType',testPercent='$percentTestOp',testReshuf='$Qreshuffle',rdate='$curDate' where test_title_id='$testID' and schlid='$schlid'";
		#echo "$sql<br>";
		@mysqli_query($conn,$sql);
		
	}
	
}
function listOfTestQuestions($schlid,$testid){
global $conn;
	if($schlid!=''){
		//if($testName!=''){
			$fields=array();
			$flagfields=array('schlid','test_title_id');
			$flagvalues=array($schlid,$testid);
			
			$k=mysqli_query($conn,SQLretrieve('testdb',$fields,$flagfields,$flagvalues));
			#echo "level 2<br>";
			if(mysqli_affected_rows($conn)>0){
				$total=mysqli_affected_rows($conn);
				?>
                	<table class="table">
<tr><td><!--input type="checkbox" value="" /--><input type="hidden" name="total" id="total" value="<?php echo $total;?>"><input type="hidden" name="testid" id="testid" value="<?php echo $testid;?>"></td><td>SN</td><td>Type</td><td>Illustration</td></tr>

<?php
			$i=0;
			
			while($val=mysqli_fetch_array($k)){
			$j=$i+1;
				?>
                <tr><td><input type="checkbox" name='<?php echo "item$i";?>' id='<?php echo "item$i";?>' /><input type="hidden" value="<?php echo "{$val['Qid']}";?>" name='<?php echo "id$i";?>' id='<?php echo "id$i";?>'></td><td><?php echo $j;?>.</td><td><a href="" <?php echo qIllustDeterminant($val['type_of_question'],$val['Qid'],$val['test_title_id']);?> data-toggle="modal"><?php echo QtypeDescription($val['type_of_question']);?></a><br />
                <?php echo substr($val['question'],0,20)."...";?>
                </td><td><?php echo qIllustPopupDeterminant($val['type_of_question']);?></td></tr>
                <?php
            	$i++;
			}
			
?>
</table>
                <?php
			}else{
				echo "<div class='alert alert-info'>No Question in your selected test.</div>";	
			}
		//}
	}
}
function qIllustDeterminant($typeofquestion,$Qid,$testid){
	if($typeofquestion!=''){
		$msg='';
		
		if($typeofquestion=='Non-illustration based question'){
			$merged="$Qid|ENBQ|$testid|$typeofquestion";
			$msg='data-target="#enbq" onclick="loadQEditForm(\''.$merged.'\');"';
		}elseif($typeofquestion=='Illustration based question'){
			$merged="$Qid|EIBQ|$testid|$typeofquestion";		
			$msg='data-target="#eibq" onclick="loadQEditForm(\''.$merged.'\');"';
		}
		
		return $msg;
	}
}
function qIllustPopupDeterminant($typeofquestion){
	if($typeofquestion!=''){
		$msg='';
		
		if($typeofquestion=='Non-illustration based question'){
			$msg='No';
		}elseif($typeofquestion=='Illustration based question'){
			$msg='Yes';
		}
		return $msg;
	}
}
function QtypeDescription($typeofquestion){
	if($typeofquestion!=''){
		$msg='';
		
		if($typeofquestion=='Non-illustration based question'){
			$msg='Non-illustration based question';
		}elseif($typeofquestion=='Illustration based question'){
			$msg='Illustration based question';
		}
		return $msg;
	}
}
function newTestQuestionVerif($schlid,$testid){
global $conn;
	if($schlid!='' && $testid!=''){
		$fields=array();
		$flagfields=array('schlid','test_title_id');
		$flagvalues=array($schlid,$testid);
		
		$k=@mysqli_query($conn,SQLretrieve('testproperty',$fields,$flagfields,$flagvalues));
		#get no of question in the test to check for test limit
		if(mysqli_affected_rows($conn)>0){
			if($val=mysqli_fetch_array($k)){
				$noQ=$val['no_of_question_per_test'];
			}
		}
		return $noQ;
	}
}
function displayQuestionAddPopup($schlid,$testid){
global $conn;
	$add=false;
	if($schlid!='' && $testid!=''){
	  $fields=array();
	  $flagfields=array('schlid','test_title_id');
	  $flagvalues=array($schlid,$testid);
	  
	  $k=@mysqli_query($conn,SQLretrieve('testdb',$fields,$flagfields,$flagvalues));
	  #get no of question in the test to check for test limit
	  if(mysqli_affected_rows($conn)>0){
		  $noQ=mysqli_affected_rows($conn);
	  }else{
		  $noQ=0;
	  }
		if(newTestQuestionVerif($schlid,$testid)>$noQ){
			#add new question
			$add=true;
		}
	}
	return $add;
	
}
function uploadIllustrationForIMAQ($logo,$schlid,$testid,$Qid){
$msg="";
if($logo['name']!='' && $logo['size']<=20000){
	#echo "1<br>";
	$ext=explode('.',$logo['name']);
#		if($ext[1]=='png'){
		if($logo['type']=='image/png' || $logo['type']=='image/pjpeg' || $logo['type']=='image/jpeg' ){
			#echo "2<br>";
			if($logo['tmp_name']!=''){
				#echo "3<br>";
				#check for the ../cbt/question/schlid/testid/ directory, before transfering file
				$dir="cbt/question/";#$schlid/$testid/";
				$newQid="$schlid-$testid-$Qid";
				$dest=$dir."$newQid.{$ext[1]}";
				
				move_uploaded_file($logo['tmp_name'],"../$dest");
				return "$dest";
			}
			
		}else{
			$msg='<p class="alert alert-error">The picture file format is not supported</p>';	
		}		
}else{
	$msg='<p class="alert alert-error">The selected file size is bigger than 20kb</p>';
}
	#if($msg!='') return $msg;
}
function uploadIllustration($logo,$schlid,$testid,$Qid){
$msg="";
if($logo['name']!='' && $logo['size']<=20000){
	#echo "1<br>";
	$ext=explode('.',$logo['name']);
#		if($ext[1]=='png'){
		if($logo['type']=='image/png' || $logo['type']=='image/pjpeg' || $logo['type']=='image/jpeg' ){
			#echo "2<br>";
			if($logo['tmp_name']!=''){
				#echo "3<br>";
				#check for the ../cbt/question/schlid/testid/ directory, before transfering file
				$dir="cbt/question/";#$schlid/$testid/";
				$newQid="$schlid-$testid-$Qid";
				$dest=$dir."$newQid.{$ext[1]}";
				
				move_uploaded_file($logo['tmp_name'],"../$dest");
				return "$dest|$newQid";
			}
			
		}else{
			$msg='<p class="alert alert-error">The picture file format is not supported</p>';	
		}		
}else{
	$msg='<p class="alert alert-error">The selected file size is bigger than 20kb</p>';
}
	#if($msg!='') return $msg;
}
function checkIfQuestionExist($schlid,$testid,$question,$ansOption,$answer){
global $conn;
	$existing=false;
	$fields=array();
	$flagfields=array('schlid','test_title_id','question','options','answer');
	$flagvalues=array($schlid,$testid,$question,$ansOption,$answer);
	
	$ok=@mysqli_query($conn,SQLretrieve('testdb',$fields,$flagfields,$flagvalues));
	if(mysqli_affected_rows($conn)>0){
		$existing=true;
	}
	return $existing;
}
function determineNoOfUploaded(){
	$activeUploads=array();
	$out='';
	
	for($i=0;$i<5;$i++){
		$j=$i+1;
		if($_FILES["option$j"]['name']!=''){
			#get the name
			$activeUploads[$i]="option$j";
		}
	}
	
	if(empty($activeUploads)){
		$out='empty';
	}else{
		if(count($activeUploads)>2){
			$out=$activeUploads;
		}else{
			$out='empty';
		}
	}
	
	return $out; 
	
}
function addIMAQ($schlid,$testid,$Qtitle,$ill,$ansOption,$answer,$testReasoning,$Qtype){
	
	$msg='';
	
if(checkIfQuestionExist($schlid,$testid,$Qtitle,$ansOption,$answer)==false){
global $conn;
	if($schlid!='' && $testid!=''){
		if($Qtitle!=''){
			#validate the partern in ans option and answer,
			#validate the presence of test reasoning
			#check for the presence of ill
		
		#validate the option field for error. n validate the answer parttern for error.
		#if(determine_answer_pattern_success($answer)==false && determine_option_pattern_success($ansOption)==false){
		$no=determineNoOfUploaded();
		if($no!='empty'){
			
			if($testReasoning!=''){
				
				$path='';
				if($ill!=''){
					#save the content of the test to database, extract its question id as qid, upload file, n update the content of the record with the path of the image dirctory
					#echo "enter 5<br>";
					#get the content of this no upload
					
					$sql="insert into testdb(schlid,test_title_id,type_of_question,question,answer,explanation) values('$schlid','$testid','$Qtype','$Qtitle','$answer','$testReasoning')";
					
					@mysqli_query($conn,$sql);
					$Qid=retrieveQuestionID($schlid,$testid);
					
					$illPath=uploadIllustrationForIMAQ($ill,$schlid,$testid,$Qid);
					for($i=0;$i<count($no);$i++){
						if(($i+1)!=count($no)){
							$path="$path".uploadIllustrationForIMAQ($_FILES["{$no[$i]}"],$schlid,$testid,"$Qid-$i").":";
						}else{
							$path="$path".uploadIllustrationForIMAQ($_FILES["{$no[$i]}"],$schlid,$testid,"$Qid-$i");
						}
					}
					$newQid="$schlid-$testid-$Qid";
					
					$uSql="update testdb set image_Question='$illPath',Qid='$newQid',image_option='$path' where sn='$Qid' and schlid='$schlid' and test_title_id='$testid'";
					
					@mysqli_query($conn,$uSql);
					
				}else{
					
					$sql="insert into testdb(schlid,test_title_id,type_of_question,question,answer,explanation) values('$schlid','$testid','$Qtype','$Qtitle','$answer','$testReasoning')";
					
					@mysqli_query($conn,$sql);
					$Qid=retrieveQuestionID($schlid,$testid);
					
					for($i=0;$i<count($no);$i++){
						if(($i+1)!=count($no)){
							$path="$path".uploadIllustrationForIMAQ($_FILES["{$no[$i]}"],$schlid,$testid,"$Qid-$i").":";
						}else{
							$path="$path".uploadIllustrationForIMAQ($_FILES["{$no[$i]}"],$schlid,$testid,"$Qid-$i");
						}
					}
					$newQid="$schlid-$testid-$Qid";
					
					$uSql="update testdb set Qid='$newQid',image_option='$path' where sn='$Qid' and schlid='$schlid' and test_title_id='$testid'";
					
					@mysqli_query($conn,$uSql);
					
				}
			}else{
				$msg='Please state reason for your answer';	
			}
		}else{
			$msg='Please Upload at least two option image.';
		}
		}else{
			$msg='Enter you question';
		}
	}else{
		$msg='school or test id missing';	
	}
}
}
function addMAQ($schlid,$testid,$Qtitle,$ill,$ansOption,$answer,$testReasoning,$Qtype){
	
	$msg='';
	global $conn;
	$anserr=false;
	#echo "enter 1<br>";
if(checkIfQuestionExist($schlid,$testid,$Qtitle,$ansOption,$answer)==false){
	if($schlid!='' && $testid!=''){
		if($Qtitle!=''){
			#validate the partern in ans option and answer,
			#validate the presence of test reasoning
			#check for the presence of ill
		#echo "enter 2<br>";
		#validate the option field for error. n validate the answer parttern for error.
		if(determine_answer_pattern_success($answer)==false && determine_option_pattern_success($ansOption)==false){
			#echo "enter 3<br>";
			if($testReasoning!=''){
				#echo "enter 4<br>";
				if($ill!=''){
					#save the content of the test to database, extract its question id as qid, upload file, n update the content of the record with the path of the image dirctory
					#echo "enter 5<br>";
					$sql="insert into testdb(schlid,test_title_id,type_of_question,question,options,answer,explanation) values('$schlid','$testid','$Qtype','$Qtitle','$ansOption','$answer','$testReasoning')";
					#echo "$sql<br>";
					#return true;
					@mysqli_query($conn,$sql);
					$Qid=retrieveQuestionID($schlid,$testid);
					$path=uploadIllustration($ill,$schlid,$testid,$Qid);
					$path=explode("|",$path);
					#update the image path in the record.
					$uSql="update testdb set image_Question='{$path[0]}',Qid='{$path[1]}' where sn='$Qid' and schlid='$schlid' and test_title_id='$testid'";
					#echo "$uSql<br>";
					@mysqli_query($conn,$uSql);
				}else{
					#echo "enter 6<br>";
					
					$sql="insert into testdb(schlid,test_title_id,type_of_question,question,options,answer,explanation) values('$schlid','$testid','$Qtype','$Qtitle','$ansOption','$answer','$testReasoning')";
					#echo "$sql<br>";
					@mysqli_query($conn,$sql);
					$Qid=retrieveQuestionID($schlid,$testid);
					$newQid="$schlid-$testid-$Qid";
					
					$uSql="update testdb set Qid='$newQid' where sn='$Qid' and schlid='$schlid' and test_title_id='$testid'";
					#echo "$uSql<br>";
					@mysqli_query($conn,$uSql);
				}
			}else{
				$msg='Please state reason for your answer';	
			}
		}else{
			$msg='Your answer or option pattern is inconsistent';
		}
		//if($err==false && $anserr==false){
			
		//}
		}else{
			$msg='Enter you question';
		}
	}else{
		$msg='school or test id missing';	
	}
}
}
function retrieveQuestionID($schlid,$testid){
	#get the hightest sn of all the no in a particular test_id and assume to be the most recent.
global $conn;
	$fields=array();
	$flagfields=array('schlid','test_title_id');
	$flagvalues=array($schlid,$testid);
	$ok=@mysqli_query($conn,SQLretrieve('testdb',$fields,$flagfields,$flagvalues));
	
	$sub=0;
	$highestNo='';
	
	if(mysqli_affected_rows($conn)>0){
		while($val=mysqli_fetch_array($ok)){
			
			$test=$val['sn'];
			
			if($sub>$test){
				$test=$sub;
			}
		}
		$highestNo=$test;
	}

	return $highestNo;
}
function determine_answer_pattern_success($field){
	$report=false;
	$j=0;
	$answer=array();
	
	if($field!=''){
		$answer=explode(';',$field);
				
				for($i=0;$i<count($answer);$i++){
					$j=$i+1;
					if(count($answer[$i])==1){
						
					}else{
						$report=true;	
					}
						
				}
	}else{
		$report=true;
	}
	return $report;
}
function determine_option_pattern_success($ansOption){
	$j=0;
	$option=array();
	$content=array();
	$err=false;
	
	if($ansOption!=''){
		$option=explode(';',$ansOption);
		if(count($option)>1){
			//alert(option.length);
				
				for($i=0;$i<count($option);$i++){
					$j=$i+1;
					if($option[$i]!=''){
						
						$content=explode('.',$option[$i]);
						
						if(count($content)!=2){
							$err=true;
							
						}
					}else{
						$err=true;	
					}
						
				}
		}else{
			$err=true;	
		}
		}else{
			$err=true;
		}
		return $err;
}
function multipleTestPopupDisplays($schlid,$testid,$Qtype){
	?>
    	<div class="container-fluid">
				<div class="row-fliud">
                	<div class="span1"></div>
                    	<div class="span5 font">
                		<?php
                        if(displayQuestionAddPopup($schlid,$testid)==false){
							echo "<h3> Sorry you have reach your test Maximuim Question limit</h3>";
						}else{
						?>
                        <div>
                        <input type="hidden" name="qtype" id='qtype' value="<?php echo $Qtype;?>">
                        Question : <br /><textarea class="input input-xlarge" name="Question" id="Question" placeholder="Enter question..."></textarea><b>
                        <span class='checkbox form-line'><label for="sill"><input type="checkbox" style="cursor:pointer;" onclick="Effect.toggle('imgAttach','BLIND');" name="sill" id="sill" /> Attach illustration </label></span><br />
                        <div style="display:none;" id="imgAttach">
                        <input type="file" name="sillAttach" />
                        </div>
                        <hr />
                        Enter answer options (<a rel="tooltip" href="" title='eg : A.Cup; B.Plate; C.Ginger'>seperate answer option with semi colon</a> ';') : <br />
                        <textarea name="testOption" id="testOption" onblur="parseOptionValues('testOption');" class="input input-xlarge" placeholder="Enter Answer options..."></textarea><br />
                        Enter answer(s) (<a rel="tooltip" href="" title='eg : A ; B ; C'>seperate multiiple answer with semi colon</a> ';') : <br />
                        <textarea class="input input-xlarge" name="AnswerValues" id="AnswerValues" onblur="parseAnwserValues('AnswerValues')" placeholder="Enter Answer..."></textarea><br />
                        Practice test reason : <br />
                        <textarea class="input input-xlarge" name="PracticeReason" id="PracticeReason" placeholder="describe the reason for the answer(s)..."></textarea><br />
                        
                        <input type="submit" class="btn btn-block btn-info" name="addMAQ" value="Add Question" />
                        </div>
                        
                        <?php }?>
                        </div>
                	<div class="span1"></div>
                </div>
                </div>
    <?php
}
function illMultipleTestPopupDisplay($schlid,$testid,$Qtype){
	?>
    	<div class="container-fluid">
				<div class="row">
                	<div class="span1"></div>
                    	<div class="span5 font">
                        
                        <?php
                        if(displayQuestionAddPopup($schlid,$testid)==false){
							echo "<h3> Sorry you have reach your test Maximuim Question limit</h3>";
						}else{
						?>
                        
                        <div>
                        <input type="hidden" name="qtype" id='qtype' value="<?php echo $Qtype;?>">
                        Question : <br /><textarea class="input input-xlarge" placeholder="Enter question..." name="Question"></textarea><br />
                        <span class="checkbox form-inline"><label for="addIllustration"><input type="checkbox" style="cursor:pointer;" onclick="Effect.toggle('imgAttach','BLIND');" name="addIllustration" id='addIllustration' /> Add Illustration <br /></label></span><div style="display:none;" id='imgAttach'><input type="file" name="qillustration"/></div><hr />
                        Upload illustration options (Maximuim of 5 option permitted) : <br />
                        <ul>
                        	<li>A. <input type="file" name="option1" /></li>
                            <li>B. <input type="file" name="option2" /></li>
                            <li>C. <input type="file" name="option3" /></li>
                            <li>D. <input type="file" name="option4" /></li>
                            <li>E. <input type="file" name="option5" /></li>
                        </ul><br />
                        
                        Correct Answer : <br /><input type="text" name="ans" placeholder="Enter correct answer" class="input" /><br />
                        Practice test reason (Describe the reasons for the correct answer.) : <br />
                        <textarea class="input input-xlarge" name="ansReasoning" placeholder="describe the reason for the answer(s)..."></textarea><br />
                        
                        <input type="submit" class="btn btn-info btn-block" value="Add Question" name="addIMAQ" />
                        </div>
                        <?php }?>
                        
                        </div>
                	<div class="span1"></div>
                </div>
                </div>
    <?php
}
######################################### EDITING FUNCTION ####################
function loadNQforEditing($schlid,$testid,$Qid){
global $conn;
	if($schlid!='' && $testid!='' && $Qid!=''){
		$fields=array();
		$flagfields=array('schlid','test_title_id','Qid');
		$flagvalues=array($schlid,$testid,$Qid);
		
		$ok=mysqli_query($conn,SQLretrieve('testdb',$fields,$flagfields,$flagvalues));
		if(mysqli_affected_rows($conn)>0){
			if($val=mysqli_fetch_array($ok)){
				$question=$val['question'];
				
				$attached='';
				if($val['image_Question']!=''){
					$attached=$val['image_Question'];
				}
				$options=$val['options'];
				$ans=$val['answer'];
				$explain=$val['explanation'];
			}
		?>
        <div class="container-fluid">
				<div class="row-fliud">
                	<div class="span1"></div>
                    	<div class="span5 font">
                		
                        <div>
                        
                        <input type="hidden" name="qtype" id='qtype' value="<?php echo $Qtype;?>">
                        <input type="hidden" name="qid" id='qid' value="<?php echo $Qid;?>">
                        <b>Question : </b><br /><span id="question" style="display:inline-block;"><textarea name="question" id="question" class="input input-xlarge"><?php echo $question;?></textarea></span><br />
                        <?php if($attached!=''){
							echo "<img name=\"questionImg\" src=\"../$attached\" width=\"100px\">";
							?>
							<span class='checkbox form-line'><label for="chng"><input type="checkbox" style="cursor:pointer;" onclick="Effect.toggle('chngImg','BLIND');" name="chng" id="chng" /> Change Image </label></span><br />
                        <div style="display:none;" id="chngImg">
                        <input type="file" name="chngAttach" />
                        </div>
							<?php
						}
						?>
                        <hr />
                        <b>Question options :</b><br /> <span style="display:inline-block;"><textarea class="input input-xlarge" onblur="parseOptionValues('option')" name="option" id="option"><?php echo $options;?></textarea></span><br />
                        <b>Answer(s) : </b><br /><span style="display:inline-block;"><textarea class="input input-xlarge" onblur="parseAnswerValues('ans')" name="ans" id="ans"><?php echo $ans;?></textarea></span>
                        <br />
                        <b>Practice test reason : </b><br /><span style="display:inline-block;"><textarea class="input input-xlarge" name="explain" id="explain"><?php echo $explain;?></textarea></span>
                        <br />
                        <br>
                        <input type="submit" class="btn btn-block btn-info" name="updateQnExit" value="Update Question and Exit" />
                        </div>
                        
                        </div>
                	<div class="span1"></div>
                </div>
                </div>
        <?php
	}
	}
}
function updatedEditedNQ($img,$Qid,$question,$option,$ans,$explain){
global $conn;
	if($Qid!=''){
		if($question!='' && $option!='' && $ans!='' && $explain!=''){
			if(determine_answer_pattern_success($ans)==false && determine_option_pattern_success($option)==false){
				if($img!=''){
					#replace the already existing image
					#and update all the values where where Qid is $Qid
					$imgPath=updateQImg($img,$Qid);
					$sql="update testdb set question='$question',image_Question='$imgPath',options='$option',answer='$ans', explanation='$explain' where Qid='$Qid'";
				}else{
					#update all the values where Qid is $Qid
					$sql="update testdb set question='$question',options='$option',answer='$ans', explanation='$explain' where Qid='$Qid'";
					
				}
				@mysqli_query($conn,$sql);
			}
		}
	}
}
function updateQImg($logo,$Qid){
$msg="";
if($logo['name']!='' && $logo['size']<=20000){
	#echo "1<br>";
	$ext=explode('.',$logo['name']);
#		if($ext[1]=='png'){
		if($logo['type']=='image/png' || $logo['type']=='image/pjpeg' || $logo['type']=='image/jpeg' ){
			#echo "2<br>";
			if($logo['tmp_name']!=''){
				#echo "3<br>";
				#check for the ../cbt/question/schlid/testid/ directory, before transfering file
				$dir="cbt/question/";#$schlid/$testid/";
				#$newQid="$schlid-$testid-$Qid";
				$dest=$dir."$Qid.{$ext[1]}";
				
				move_uploaded_file($logo['tmp_name'],"../$dest");
				return $dest;
			}
			
		}else{
			$msg='<p class="alert alert-error">The picture file format is not supported</p>';	
		}		
}else{
	$msg='<p class="alert alert-error">The selected file size is bigger than 20kb</p>';
}
	#if($msg!='') return $msg;
}
function loadIQforEditing($schlid,$testid,$Qid){
global $conn;
	if($schlid!='' && $testid!='' && $Qid!=''){
		$fields=array();
		$flagfields=array('schlid','test_title_id','Qid');
		$flagvalues=array($schlid,$testid,$Qid);
		
		$ok=@mysqli_query($conn,SQLretrieve('testdb',$fields,$flagfields,$flagvalues));
		if(mysqli_affected_rows($conn)>0){
			if($val=mysqli_fetch_array($ok)){
				$question=$val['question'];
				
				$attached='';
				if($val['image_Question']!=''){
					$attached=$val['image_Question'];
				}
				$options=$val['image_option'];
				$ans=$val['answer'];
				$explain=$val['explanation'];
				
				$picture=explode(':',$options);
				$noofOption=count($picture);
			}
		?>
        <div class="container-fluid">
				<div class="row-fliud">
                	<div class="span1"></div>
                    	<div class="span5 font">
                		
                        <div>
                        
                        <input type="hidden" name="qtype" id='qtype' value="<?php echo $Qtype;?>">
                        <input type="hidden" name="qid" id='qid' value="<?php echo $Qid;?>">
                        <input type="hidden" name="testid" id='testid' value="<?php echo $testid;?>">
                        <div style="padding:5px;">
                        <b>Question : </b><br /><span id="question" style="display:inline-block; float:left;"><textarea name="question" id="question" class="input"><?php echo $question;?></textarea></span><span style="margin-left:5px;">
                        <?php if($attached!=''){
							echo "<img name=\"questionImg\" src=\"../$attached\" width=\"100px\">";
							?>
                            </span>
							<div class="clear"></div>
                            <div class='checkbox form-line'><label for="chng"><input type="checkbox" style="cursor:pointer;" onclick="Effect.toggle('chngImg','BLIND');" name="chng" id="chng" /> Change Image </label></div>
                        <div style="display:none;" id="chngImg">
                        <input type="file" name="chngAttach" />
                        </div>
							<?php
						}
						?>
                        </div>
                        <hr />
                        <!--table-->
                        
                        <b><u>Options</u></b><br />
                        <table>
                        <tr>
                        
                        <?php
						
                        	for($i=0;$i<$noofOption;$i++){
								
								
								$all=explode('/',$picture[$i]);
								if(isset($all[2])){
									$file_name=$all[2];
									$na=explode('.',$file_name);
									$imgID=$na[0];
									?>
									
                                    <td>
									<?php #echo "<$file_name> {$picture[$i]} - <br>";?>
									<img name="<?php echo "$imgID";?>" style="cursor:pointer;" onclick="Effect.toggle('chngImg<?php echo $i;?>','BLIND');" src="<?php echo "../{$picture[$i]}";?>" width='80px'/>
                                        
                                        <div style="display:none;" id="chngImg<?php echo $i;?>">
                                        <input type="file" style="font-size:8px;" name="chngAttach<?php echo $i;?>" />
                                        </div>
                                        </td>
                                    	
									<?php
								}else{
									$imgID="$schlid-$testid-$Qid-$i";
									?>
                                    
                                    <td>
                                    <img name="<?php echo $imgID;?>" onclick="Effect.toggle('chngImg<?php echo $i;?>','BLIND');" src="" width='150px'/>
                                    <img name="" onclick="Effect.toggle('chngImg<?php echo $i;?>','BLIND');" width='80px' />
                                    <div style="display:none;" id="chngImg<?php echo $i;?>">
                                        <input type="file" style="font-size:8px;" name="chngAttach<?php echo $i;?>" />
                                        </div>
                                    </td>
                                    
									<?php
								}
							}
						?>
                        <!--/div></div-->
                        </tr>
                        </table>
                        <!--/table-->
                        <hr />
                        <b>Answer : </b><br /><span style="display:inline-block;"><textarea class="input input-xlarge" name="ans" id="ans"><?php echo $ans;?></textarea></span>
                        <br />
                        <b>Practice test reason : </b><br /><span style="display:inline-block;"><textarea class="input input-xlarge" name="explain" id="explain"><?php echo $explain;?></textarea></span>
                        <br />
                        <br>
                        <input type="submit" class="btn btn-block btn-info" name="updateQnExit2" value="Update Question and Exit" />
                        </div>
                        
                        </div>
                	<div class="span1"></div>
                </div>
                </div>
        <?php
	}
	}
	
}
function updatedEditedIQ($img,$Qid,$question,$option,$ans,$explain,$schlid,$testid){
global $conn;
	if($Qid!=''){
		#echo "Entered 1<br>";
		if($question!='' && $ans!='' && $explain!=''){
				$imgPath='';
				$qimgPath='';
		#		echo "Entered 2<br>";
				if($img!=''){
		#			echo "Entered 3<br>";
					$qimgPath=updateQImg($img,$Qid);
					
				}
				$strOption='';

				for($i=0;$i<5;$i++){
		#			echo "Entered 4<br>";
					$opt="$Qid-$i";
					if($option[$i]!=''){
		#				echo "Entered 5<br>";
						#replace the already existing image
						#and update all the values where where Qid is $Qid
						
						$imgPath=updateQImg($option[$i],$opt);
						
					}
					#formulate the option string
					if($i!=4){
		#				echo "Entered 6<br>";
						$strOption="$strOption$imgPath:";
					}else{
		#				echo "Entered 7<br>";
						$strOption="$strOption$imgPath";
					}
				}
				#compare the contents of the image_option
				$original='';
				$avail=false;
				
				$fields=array();
				$flagfields=array('schlid','test_title_id','Qid');
				$flagvalue=array($schlid,$testid,$Qid);
				
				$k=@mysqli_query($conn,SQLretrieve('testdb',$fields,$flagfields,$flagvalue));
				
				if(mysqli_affected_rows($conn)>0){
		#			echo "Entered 8<br>";
					if($val=mysqli_fetch_array($k)){
		#				echo "Entered 9 {$val['image_option']} <br>";
						$original=trim($val['image_option']);
						$avail=true;
					
					}
				}
				
				if($avail==true){
		#			echo "Entered 10<br>";
					$strO=explode(':',$strOption);
					$strOrigin=explode(':',$original);

		#			echo "<b>{$strOrigin[0]} - {$strOrigin[1]} - {$strOrigin[2]} - {$strOrigin[3]} - {$strOrigin[4]}<br></b>";
					

					$together='';
					for($i=0;$i<count($strOrigin);$i++){
						$ch=count($strOrigin);
		#				echo "<b><br>NO of strOrigin array : $ch<br>{$strO[0]} - {$strO[1]} - {$strO[2]} - {$strO[3]} - {$strO[4]}<br></b>";
		#				echo "<br></br><b>{$strOrigin[0]} - {$strOrigin[1]} - {$strOrigin[2]} - {$strOrigin[3]} - {$strOrigin[4]}<br></b>";
						
							if(strlen($strO[$i])>0 && array_search(trim($strO[$i]),$strOrigin)==false){
		#						echo "<br>Content : $strO[$i]</br>";
								
		#							echo "Entered 12 -| {$strO[$i]} | {$strOrigin[$i]}<br>";
									if(($i+1)<count($strOrigin)){
										$together="$together{$strO[$i]}:";
									}else{
										$together="$together{$strO[$i]}";
									}
							}else{
								
									if(($i+1)<count($strOrigin)){
										$together="$together{$strOrigin[$i]}:";
									}else{
										$together="$together{$strOrigin[$i]}";
									}
							}
						
					}
		#			echo "<br><b>$together</b><br>";
					
					#erase the files already existing in cbt/question/ folder
					erasePix($together,$strOrigin);
					
					$strOrigin=$together;
					}
				
				
					if($qimgPath!=''){
						$sql="update testdb set question='$question', image_Question='$qimgPath',answer='$ans', explanation='$explain' where Qid='$Qid'";
						#echo "1. $sql<br>";
						@mysqli_query($conn,$sql);
					}elseif($qimgPath!='' && isset($strOrigin)){
						$sql="update testdb set question='$question', image_option='$strOrigin', image_Question='$qimgPath',answer='$ans', explanation='$explain' where Qid='$Qid'";
						#echo "2. $sql<br>";
						@mysqli_query($conn,$sql);
					}elseif(isset($strOrigin)){
					#update all the values where Qid is $Qid
						$sql="update testdb set question='$question', answer='$ans',image_option='$together', explanation='$explain' where Qid='$Qid'";
						#echo "3. $sql<br>";
						@mysqli_query($conn,$sql);
					}
			#}
		}
	}
}
function erasePix($array1,$array2){
	$array1=explode(':',$array1);
	@$array2=explode(':',$array2);
	
	if(isset($array1) && isset($array2)){
		for($i=0;$i<count($array2);$i++){
			if($array1!=$array2){
				@unlink('../'.$array2[$i]);
			}
		}
	}
}
function removeTestQuestion($Qid){
	#extract question
	#determine the question type
	#if question type is non-ilustration based question without image_Question field set, remove
	#if question type is non-ilustration based question with image_Question field set, remove image file, then record file
	#if question type is illustration based question  with image_Question field set, remove image file, option images, then remove record
	#if question type is illustration based question  without image_Question field set, remove option images, then remove record
global $conn;
	$fields=array();
	$flagfield=array('Qid');
	$flagvalues=array($Qid);
	
	$sql='';
	#echo "enterd 1 <br>";
	$ok=@mysqli_query($conn,SQLretrieve('testdb',$fields,$flagfield,$flagvalues));
	if(mysqli_affected_rows($conn)>0){
		#echo "enterd 2 <br>";
		if($val=mysqli_fetch_array($ok)){
			
			$qtype=$val['type_of_question'];

			$qImage=$val['image_Question'];
			$image_option=$val['image_option'];
		#	echo "enterd 3 <br>";
		}
		if(strtolower($qtype)==strtolower('Non-illustration based question')){
		#	echo "enterd 4 <br>";
			if(strlen($qImage)>0){
		#		echo "enterd 5 <br>";
				unlink("../$qImage");
				$sql="delete from testdb where Qid='$Qid'";
			}else{
		#		echo "enterd 5 <br>";
				$sql="delete from testdb where Qid='$Qid'";
			}
		}elseif(strtolower($qtype)==strtolower('Illustration based question')){
		#	echo "enterd 6 <br>";
			if(strlen($qImage)>0){
		#		echo "enterd 7 - $image_option<br>";
				if(strlen($image_option)>0){
		#			echo "enterd 8 <br>";
					$img=explode(':',$image_option);
					$number=count($img);
					for($i=0;$i<$number;$i++){
						if(strlen($img[$i])>0){
							unlink("../$img[$i]");
						}
					}
				}
				unlink("../$qImage");
				$sql="delete from testdb where Qid='$Qid'";
			}else{
		#		echo "enterd 9  - $image_option<br>";
				if(strlen($image_option)>0){
		#			echo "enterd 10 <br>";
					$img=explode(':',$image_option);
					$number=count($img);
					for($i=0;$i<$number;$i++){
						if(strlen($img[$i])>0){
							unlink("../$img[$i]");
						}
					}
				}
				$sql="delete from testdb where Qid='$Qid'";
			}
		}
		#echo "<br>$sql<br>";
		@mysqli_query($conn,$sql);
	}
}
function removeTest($testid){
global $conn;
	$fields=array();
	$flagfield=array('test_title_id');
	$flagvalues=array($testid);
	
	$sql='';
	#echo "enterd 1 <br>";
	$ok=@mysqli_query($conn,SQLretrieve('testdb',$fields,$flagfield,$flagvalues));
	if(mysqli_affected_rows($conn)>0){
		#echo "enterd 2 <br>";
		
		if($val=mysqli_fetch_array($ok)){
			$Qid=$val['Qid'];
			removeTestQuestion($Qid);
		}
	}
	#remove the record from testProperty table
	$sql="delete from testproperty where test_title_id='$testid'";
	@mysqli_query($conn,$sql);
}
function loadTest($schlid,$testid,$status){
global $conn;
	#global $testName,$testNoOfQuestion,$testPercent,$testDuration,$testType,$testInstruction,$testtarget,$testReshuffle,$testID,$schlid;
	#load testproperties into session variables
	#load the instruction
	#followed by questions in the order loadded in the session variables
	#and time loaded in the session variable.
	#if test type is practice display practice answer and otherwise.
	#if status is not preview, incooperate answer and return them.
	$fields=array();
	$flagfields=array('schlid','test_title_id');
	$flagvalues=array($schlid,$testid);
	#echo $testid."<br>";
	$ok=mysqli_query($conn,SQLretrieve('testproperty',$fields,$flagfields,$flagvalues));
	
	if(mysqli_affected_rows($conn)>0){
		
		if($val=mysqli_fetch_array($ok)){
			$_SESSION['testName']=$val['test_title'];
			$_SESSION['testNoOfQuestion']=$val['no_of_question_per_test'];
			$_SESSION['testPercent']=$val['testPercent'];
			$_SESSION['testDuration']=$val['test_duration'];
			$_SESSION['testType']=$val['practice_test'];
			$_SESSION['testInstruction']=$val['instruction'];
			$_SESSION['testTarget']=$val['designated_class'];
			$_SESSION['testReshuffle']=$val['testReshuf'];
			$_SESSION['testID']=$testid;
			#echo "{$_SESSION['testID']}<br>";
		}
	}
	#echo mysqli_affected_rows($conn);
}
function loadTest_intro($name){
	#global $testInstruction,$testName,$testNoOfQuestion,$testPercent,$testDuration,$testType,$availableQ,$testID;
	$_SESSION['availableQ']=round(($_SESSION['testPercent']/100)*$_SESSION['testNoOfQuestion']);
	?>
    <div>
    	<h3>Welcome <?php echo $name;?>,</h3><br />
        <p>
        You are on to <?php echo $_SESSION['testName'];?> online test. Read the instruction below carefully, and proceed with the test.
        </p>
        <p><?php echo $_SESSION['testInstruction'];?></p>
        <p>In addition, the test comprises of <?php echo $_SESSION['testNoOfQuestion'];?> question(s) in which you are expect to answer <?php echo $_SESSION['availableQ'];?>, correctly, within a time frame of <?php echo $_SESSION['testDuration'];?> minutes. </p>
        <p>Also, the test will come in the form of "<?php echo $_SESSION['testType'];?>", in which your scores in the questions will be tracked and recorded at the end of the test. Therefore, utmost discipline is expected as such will justify your final score on this test.</p><br />
        <div class="checkbox form-inline font"><label for="agree"><input type="checkbox" name="agree" id="agree" /> I agree with the terms and conditions of this test as specified by the school, within and outside this publication.</label></div>
        <div><button type="button" onclick="startTest(<?php echo $_SESSION['testID'];?>,'../');" id="btnStartTest" class="btn btn-block btn-success"> START TEST </button></div>
    </div>
    <?php
}
function loadTest_intro_student($name){
	global $schlid; 
	#$testInstruction,$testName,$testNoOfQuestion,$testPercent,$testDuration,$testType,$availableQ,$testID;
	$_SESSION['availableQ']=round(($_SESSION['testPercent']/100)*$_SESSION['testNoOfQuestion']);
	?>
    <div>
    	<h3>Welcome <?php echo $name;?>,</h3><br />
        <p>
        You are on to <?php echo $_SESSION['testName'];?> online test. Read the instruction below carefully, and proceed with the test.
        </p>
        <p><?php echo $_SESSION['testInstruction'];?></p>
        <p>In addition, the test comprises of <?php echo $_SESSION['testNoOfQuestion'];?> question(s) in which you are expect to answer <?php echo $_SESSION['availableQ'];?>, correctly, within a time frame of <?php echo $_SESSION['testDuration'];?> minutes. </p>
        <p>Also, the test will come in the form of "<?php echo $_SESSION['testType'];?>", in which your scores in the questions will be tracked and recorded at the end of the test. Therefore, utmost discipline is expected as such will justify your final score on this test.</p><br />
        <div class="checkbox form-inline font"><label for="agree"><input type="checkbox" name="agree" id="agree" /> I agree with the terms and conditions of this test as specified by the school, within and outside this publication.</label></div>
        <div><button type="button" onclick="startTest_student('<?php echo $schlid;?>',<?php echo $_SESSION['testID'];?>,'');" id="btnStartTest" class="btn btn-block btn-success"> START TEST </button></div>
    </div>
    <?php
}
function loadTest_start($schlid,$testid){
global $conn;
#	global $testInstruction,$testName,$testNoOfQuestion,$testPercent,$testDuration,$testType,$availableQ,$testID,$schlid,$testReshuf;
	#echo $_SESSION['schlid'].','.$_SESSION['testID'].' -sessions <br>';
	$questions=array();
	
	#$fields=array('type_of_question','question','options','answer','image_Question','image_option','explanation','Qid');
	$fields=array();
	$flagfields=array('schlid','test_title_id');
#	$flagvalues=array($_SESSION['schlid'],$_SESSION['testID']);
	$flagvalues=array($schlid,$testid);
	
	$ok=mysqli_query($conn,SQLretrieve('testdb',$fields,$flagfields,$flagvalues));
	
	if(mysqli_affected_rows($conn)>0){
		$_SESSION['testNoOfQuestion']=mysqli_affected_rows($conn);
		$_SESSION['availableQ']=round(($_SESSION['testPercent']/100)*$_SESSION['testNoOfQuestion']);
		$i=0;
		while($val=mysqli_fetch_array($ok)){
			if($i<$_SESSION['availableQ']){
				$questions[$i]=$val;
			}
			#echo "{$questions[$i][3]}<br>";
			$i++;
		}
	}
	return $questions;
}
function questionTimer($curTime){
	global $schlid,$studid,$testid;
	#echo "$curTime-<br>";
	if($curTime>0){
		$curTime=$curTime-1;
		#echo "<span class=\"innerTimer\">00:$curTime</span>";
		echo "00:$curTime";
		return $curTime;
	}/*else{
		#call termination function 
		#computeTotalScore();
		$testscore=computeTotalScore();
		updateTestResult($schlid,$studid,$testid,$testscore);
	}*/
}
function displayQuestion($index,$question,$Qindex){
	
	#echo @"Index : $index, Available Question : {$_SESSION['availableQ']}, Qindex: {$Qindex[$indx]}, No of Question in the array : ".count($question)."<br>";
	if($index!='' && $index<=$_SESSION['availableQ'] && isset($question)){
			$indx=$index-1; #ensures the question index counting starts from the first value in the array.
			$val=$question[$Qindex[$indx]];
			
			$testType=$val[3];
			$question=$val[4];
			$option=$val[5];
			$answer=$val[6];
			$image_question=$val[7];
			$image_option=$val[8];
			$explanation=$val[9];
			$Qid=$val[10];
			#echo "the content of image_option is : ".$image_option."<br>";
			?><input type="hidden" name="answer" id="answer" value="<?php echo $answer;?>"><?php
			if(strtolower($testType)==strtolower('Non-illustration based question')){
				
				if(strlen($image_question)>0){
					#load the concerned image
					#then load the routines in the other side of the else.
					
					loadNonIllustrationQuestion($index,$testType,$question,$option,$answer,$image_question,$image_option,$explanation,$Qid);
					
				}else{
					loadNonIllustrationQuestion($index,$testType,$question,$option,$answer,$image_question,$image_option,$explanation,$Qid);
				}
				
			}elseif(strtolower($testType)==strtolower('Illustration based question')){
				
				#echo "illustration part entered<br>";
				
				loadIllustrationQuestion($index,$testType,$question,$option,$answer,$image_question,$image_option,$explanation,$Qid);
			}
	}
}
function loadIllustrationQuestion($index,$testType,$question,$option,$answer,$image_question,$image_option,$explanation,$Qid){
	
	?>
                    	<div>
                        <div><b>Question <?php echo $index;?></b></div>
                        <div><?php echo $question;?></div>
                        <div>
                        <?php
                        	if($image_question!=''){
								?>
								<img src="<?php echo "../$image_question";?>" class="padding Q_img_for_test" style="width:250px;
	border:#CCC solid thin;" />
								<?php
							}
						?>
                            <!--ul-->
                            <table>
                            <tr>
                            <?php 
							#check if multiple answer is given for multiple input useage for response
							#if multiple answer is given, use check box
							#else use radio button.
							
							$k=array();
								
								if(strlen($answer)>1){
									$k=explode(';',$answer);
								}else{
									$k[0]=$answer;
								}
								$id=array('A','B','C','D','E');
								if(count($k)>1){
									#break option into units and display them
									$opt=explode(':',$image_option);
									for($i=0;$i<count($opt);$i++){
										#$id=explode('.',$opt[$i]);
										?><td class="checkbox form-inline" style="list-style:none; width:150px; height:200px; background-color:#FFF; border:#CCC solid thin;"><label>  <?php #echo strtoupper($id[$i]);?> <input type="checkbox" name="option" id="option" value="<?php echo $id[$i];?>"/> <?php echo $id[$i];?> <img src="../<?php echo $opt[$i];?>" class="padding" style="width:150px; height:200px;"></label></td> <?php
									}
								}else{
									$opt=explode(':',$image_option);
									#echo "<br>".count($opt)."<br>";
									for($i=0;$i<count($opt);$i++){
										#$id=explode('.',$opt[$i]);
										?><td class="checkbox form-inline" style="list-style:none; width:150px; height:200px; background-color:#FFF; border:#CCC solid thin;"><label> <?php #echo strtoupper($id[$i]);?> <input type="radio" name="option" id="option" value="<?php echo $id[$i];?>"/> <?php echo $id[$i];?> <img src="../<?php echo $opt[$i];?>" class="padding" style="width:150px; height:200px;"></label></td> <?php
									}
								}
							?>
                            </tr>
                            </table>
                            <!--/ul-->
                        </div>
                        <?php if(strtolower($_SESSION['testType'])==strtolower('Practice test')){?>
                        <div><b onclick="Effect.toggle('testExplain','BLIND');" style="cursor:pointer;">View solution </b><br />
                            <div style="display:none;" id='testExplain'>
                                <?php echo "$explanation";?>
                            </div>
                        </div>
                        <?php }?>
                        <div style="margin-top:10px;"><button type="button" onclick="nextQuestion('../')" class="btn btn-danger"> Next </button></div>
                        </div>
                    <?php
	
}
function loadNonIllustrationQuestion($index,$testType,$question,$option,$answer,$image_question,$image_option,$explanation,$Qid){
	
	?>
                    	<div>
                        <div><b>Question <?php echo $index;?></b></div>
                        <div><?php echo $question;?></div>
                        <div>
                        <?php
                        	if($image_question!=''){
								?>
								<img src="<?php echo "../$image_question";?>" width="250px" />
								<?php
							}
						?>
                            <ul>
                            <?php 
							#check if multiple answer is given for multiple input useage for response
							#if multiple answer is given, use check box
							#else use radio button.
							
							$k=array();
								
								if(strlen($answer)>1){
									$k=explode(';',$answer);
								}else{
									$k[0]=$answer;
								}
								if(count($k)>1){
									#break option into units and display them
									$opt=explode(';',$option);
									for($i=0;$i<count($opt);$i++){
										$id=explode('.',$opt[$i]);
										?><li style="list-style:none;" class="checkbox form-inline"><label>  <?php echo strtoupper($id[0]);?> <input type="checkbox" name="option" id="option" value="<?php echo $id[0];?>"/> <?php echo $id[1];?></label></li> <?php
									}
								}else{
									$opt=explode(';',$option);
									for($i=0;$i<count($opt);$i++){
										$id=explode('.',$opt[$i]);
										?><li style="list-style:none;" class="checkbox form-inline"><label> <?php echo strtoupper($id[0]);?> <input type="radio" name="option" id="option" value="<?php echo $id[0];?>"/> <?php echo $id[1];?></label></li> <?php
									}
								}
							?>
                            </ul>
                        </div>
                        <?php if(strtolower($_SESSION['testType'])==strtolower('Practice test')){?>
                        <div><b onclick="Effect.toggle('testExplain','BLIND');" style="cursor:pointer;">View solution </b><br />
                            <div style="display:none;" id='testExplain'>
                                <?php echo "$explanation";?>
                            </div>
                        </div>
                        <?php }?>
                        <div><button type="button" onclick="nextQuestion('../')" class="btn btn-danger"> Next </button></div>
                        </div>
                    <?php
}
function computeTotalScore_student(){
	#get student details
	#multiply the total score by the 100/$_SESSION['availableQ']
	#save and
	#display the result to student
	$totalScore=round(($_SESSION['score']*100)/$_SESSION['availableQ']);
	?>
	<div class="rsdisplay">You score is <?php echo $totalScore.'%';?></div>
	<button onclick="window.close()" class="btn btn-block btn-info" type="button"> OK </button>
    <?php
	return $totalScore;
}
function computeTotalScore(){
	#get student details
	#multiply the total score by the 100/$_SESSION['availableQ']
	#save and
	#display the result to student
	$totalScore=round(($_SESSION['score']*100)/$_SESSION['availableQ']);
	?>
	<div>You score is <?php echo $totalScore.'%';?></div>
	<!--button class="btn btn-block btn-info" type="button"> OK </button-->
    <?php
	return $totalScore;
}
function listStudentCBTScores($schlid,$testid){
	global $conn;
	if($schlid!=''){
		//if($testName!=''){
			$fields=array();
			$flagfields=array('schlid','testid');
			$flagvalues=array($schlid,$testid);
			
			$k=@mysqli_query($conn,SQLretrieve('teststudent',$fields,$flagfields,$flagvalues));
			#echo "level 2 ";
			if(mysqli_affected_rows($conn)>0){
				$total=mysqli_affected_rows($conn);
				?>
                <div>
                <h3 class="h-line">Students Score Sheet.</h3>
                </div>
                <br />
                	<table class="table">
<tr><td>SN</td><td>Student ID</td><td>Test Date</td><td>Score</td><td>No of Trial(s)</td></tr>
<?php
			$i=0;
			
			while($val=mysqli_fetch_array($k)){
			$j=$i+1;
				?>
                <tr><td><?php echo $j;?>.</td><td><?php echo "{$val['stud_id']}";?>
                </td><td><?php echo "{$val['tdate']}";?></td><td><?php echo "{$val['test_score']}";?></td><td><?php echo "{$val['no_of_trial']}";?></td></tr>
                <?php
            	$i++;
			}
			
?>
</table>
<br />
<div><button type="button" onclick="PrintSheet('prntBtn');" id="prntBtn" class="btn btn-info btn-block"> Print sheet </button></div>
                <?php
			}else{
				echo "<div class='alert alert-info'>Test has not been taken by any student..</div>";	
			}
		//}
	}

}
#from student view
function displayQuestion_student($index,$question,$Qindex){
	
	#echo @"Index : $index, Available Question : {$_SESSION['availableQ']}, Qindex: {$Qindex[$indx]}, No of Question in the array : ".count($question)."<br>";
	if($index!='' && $index<=$_SESSION['availableQ'] && isset($question)){
			$indx=$index-1; #ensures the question index counting starts from the first value in the array.
			$val=$question[$Qindex[$indx]];
			
			$testType=$val[3];
			$question=$val[4];
			$option=$val[5];
			$answer=$val[6];
			$image_question=$val[7];
			$image_option=$val[8];
			$explanation=$val[9];
			$Qid=$val[10];
			#echo "the content of image_option is : ".$image_option."<br>";
			?><input type="hidden" name="answer" id="answer" value="<?php echo $answer;?>"><?php
			if(strtolower($testType)==strtolower('Non-illustration based question')){
				
				if(strlen($image_question)>0){
					#load the concerned image
					#then load the routines in the other side of the else.
					
					loadNonIllustrationQuestion_student($index,$testType,$question,$option,$answer,$image_question,$image_option,$explanation,$Qid);
					
				}else{
					loadNonIllustrationQuestion_student($index,$testType,$question,$option,$answer,$image_question,$image_option,$explanation,$Qid);
				}
				
			}elseif(strtolower($testType)==strtolower('Illustration based question')){
				
				#echo "illustration part entered<br>";
				
				loadIllustrationQuestion_student($index,$testType,$question,$option,$answer,$image_question,$image_option,$explanation,$Qid);
			}
	}
}
function loadIllustrationQuestion_student($index,$testType,$question,$option,$answer,$image_question,$image_option,$explanation,$Qid){
	
	?>
                    	<div>
                        <div class="questionno"><b>Question <?php echo $index;?></b></div>
                        <div class="question"><?php echo $question;?></div>
                        <div>
                        <?php
                        	if($image_question!=''){
								?>
								<img src="<?php echo "$image_question";?>" width="250px" style="margin-bottom:10px;"/>
								<?php
							}
						?>
                            <table>
                            <tr>
                            <?php 
							#check if multiple answer is given for multiple input useage for response
							#if multiple answer is given, use check box
							#else use radio button.
							
							$k=array();
								
								if(strlen($answer)>1){
									$k=explode(';',$answer);
								}else{
									$k[0]=$answer;
								}
								$id=array('A','B','C','D','E');
								if(count($k)>1){
									#break option into units and display them
									$opt=explode(':',$image_option);
									for($i=0;$i<count($opt);$i++){
										#$id=explode('.',$opt[$i]);
										?><td class="checkbox form-inline" style="list-style:none; width:150px; height:200px; background-color:#FFF; border:#CCC solid thin;"><label>  <?php #echo strtoupper($id[$i]);?> <input type="checkbox" name="option" id="option" value="<?php echo $id[$i];?>"/> <?php echo $id[$i];?> <img src="<?php echo $opt[$i];?>" width="150px" height="200px"></label></td> <?php
									}
								}else{
									$opt=explode(':',$image_option);
									#echo "<br>".count($opt)."<br>";
									for($i=0;$i<count($opt);$i++){
										#$id=explode('.',$opt[$i]);
										?><td class="checkbox form-inline" style="list-style:none; width:150px; height:200px; background-color:#FFF; border:#CCC solid thin;"><label> <?php #echo strtoupper($id[$i]);?> <input type="radio" name="option" id="option" value="<?php echo $id[$i];?>"/> <?php echo $id[$i];?> <img src="<?php echo $opt[$i];?>" width="150px" height="200px"></label></td> <?php
									}
								}
							?>
                            </tr>
                            </table>
                        </div>
                        <?php if(strtolower($_SESSION['testType'])==strtolower('Practice test')){?>
                        <div><b onclick="Effect.toggle('testExplain','BLIND');" style="cursor:pointer;">View solution </b><br />
                            <div style="display:none;" id='testExplain'>
                                <?php echo "$explanation";?>
                            </div>
                        </div>
                        <?php }?>
                        <div style="margin-top:15px;"><button type="button" name="btnNext" onclick="nextQuestion_student('')" class="btn btn-danger"> Next </button>
                        <!--button type="submit" name="btnNext" class="btn btn-danger"> Next </button-->
                        </div>
                        </div>
                    <?php
	
}
function loadNonIllustrationQuestion_student($index,$testType,$question,$option,$answer,$image_question,$image_option,$explanation,$Qid){
	
	?>
                    	<div>
                        <div class="questionno"><b>Question <?php echo $index;?></b></div>
                        <div class="question"><?php echo $question;?></div>
                        <div>
                        <?php
                        	if($image_question!=''){
								?>
								<img src="<?php echo "$image_question";?>" width="250px" />
								<?php
							}
						?>
                            <ul class="option">
                            <?php 
							#check if multiple answer is given for multiple input useage for response
							#if multiple answer is given, use check box
							#else use radio button.
							
							$k=array();
								
								if(strlen($answer)>1){
									$k=explode(';',$answer);
								}else{
									$k[0]=$answer;
								}
								if(count($k)>1){
									#break option into units and display them
									$opt=explode(';',$option);
									for($i=0;$i<count($opt);$i++){
										$id=explode('.',$opt[$i]);
										?><li style="list-style:none;" class="checkbox form-inline"><label>  <?php echo strtoupper($id[0]);?> <input type="checkbox" name="option" id="option" value="<?php echo $id[0];?>"/> <?php echo $id[1];?></label></li> <?php
									}
								}else{
									$opt=explode(';',$option);
									for($i=0;$i<count($opt);$i++){
										$id=explode('.',$opt[$i]);
										?><li style="list-style:none;" class="checkbox form-inline"><label> <?php echo strtoupper($id[0]);?> <input type="radio" name="option" id="option" value="<?php echo $id[0];?>"/> <?php echo $id[1];?></label></li> <?php
									}
								}
							?>
                            </ul>
                        </div>
                        <?php if(strtolower($_SESSION['testType'])==strtolower('Practice test')){?>
                        <div><b onclick="Effect.toggle('testExplain','BLIND');" style="cursor:pointer;">View solution </b><br />
                            <div style="display:none;" id='testExplain'>
                                <?php echo "$explanation";?>
                            </div>
                        </div>
                        <?php }?>
                        <div><button type="button" onclick="nextQuestion_student('')" class="btn btn-danger"> Next </button></div>
                        </div>
                    <?php
}

?>