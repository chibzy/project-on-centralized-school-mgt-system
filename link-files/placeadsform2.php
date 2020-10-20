<?php 
@$cost=calculateAdscost($period);
?>
<div class="span1"></div>
<div class="span10">

<?php 
if($cost!=''){
	echo @"<div class='alert alert-success'>$orderid advert successfully placed, and it will cost $cost.</div>";
}

if(isset($_POST['uploadAds'])){
	$logo=$_FILES['img'];
	//if($cost==''){
		$Adsid=$_POST['adorderid'];
	//}else{
	//	$Adsid=$orderid;
	//}
	#echo "$Adsid - <br>";
	$location=userUploadAds($logo,$Adsid);
	$sql="update advert set path='$location' where orderID='$Adsid'";
	#echo "$sql";
	mysqli_query($conn,$sql);
}
?>

<div>
<h3>UPLOAD ADVERT</h3>
<div>(in file format: jpg, max. size:20kb.)<br /><input type="file" name="img" id="img" class="input" /> </div>
</div>
<div><br /><input type="submit" name="uploadAds" value="Upload" class="btn btn-info btn-large"></div>
</div>
<div class="span1"></div>