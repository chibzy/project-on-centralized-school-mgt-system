<?php
include("bank.php");

#generate orderid n add to order_premuim_cbt_table and inform the user of a successful order, while instructing the user to make payment to the concerned banks, send cofirmation, and wait for an email containing the access code required to generate a new cbt.
$fields=array();
$flagfields=array('schoolid','status');
$flagvalues=array($_SESSION['schlid'],'');

$val=mysqli_query($conn,SQLretrieve('ordered_premuim_cbt',$fields,$flagfields,$flagvalues));

if(mysqli_affected_rows($conn)>0){
	?>
    <br>
    <div>
		You have pending premuim CBT request order,<br> please complete the order before request for a new one. <br>
        view <a href='admindashboard.php'>premuim cbt tab</a> on the dashboard to get premuim cbt order id.<br>
        <br>
        <a href="cbtadmin.php" class="btn btn-info"> continue with test </a>
	</div>
    <br>
    <?php
}else{
	place_premuim_cbt_order($_SESSION['schlid']);
}
function place_premuim_cbt_order($schlid){
	global $conn;
	$adminemail=$_SESSION['email'];
	$orderid=createOrderID('CBT');
	$totalcost='5000';
	$orderdate=date('d/m/Y');
	
	$sql="insert into ordered_premuim_cbt(adminEmail,schoolID,orderid,Total_cost,order_date) values('$adminemail','$schlid','$orderid','$totalcost','$orderdate')";
	
	mysqli_query($conn,$sql);
	?><br>
    <form method="post">
    Thanks for requesting a cbt premuim access code,<br>
    it only cost <?php echo "N$totalcost";?>.00, for a month, please pay the specifed amount to any of our bank account using this<br>
    order id <?php echo "$orderid";?> and your name, and the code will be sent to your email on confirmation.<br>
    for more information call : 07036765446.<br>
    <button class="btn btn-info" name="btncontinue" type="submit"> continue </button>
    </form>
	<?php
}