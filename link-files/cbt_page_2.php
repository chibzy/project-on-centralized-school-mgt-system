<?php
if(!empty($studentdetails)){
	if(isset($studentdetails['name']))$studentName=$studentdetails['name'];
	?>
    <div>
    <span style="float:right">
        <a class="btn-link" href="">Exit</a>
    </span>
    <span class="clear"></span>
    <h3>
        Welcome <?php echo $studentName;?>.
    </h3>
    <div>The test list below are properly tracked, and its outcome can not be recorded more than once. Therefore, ensure that you are fully prepared to take the test especially when you are taking it for the first time.</div>
    <p style="font-size:18px; font-family:Cuprum; color:#F00;">
       Below is (are) the list of test you are eligible to take. 
    </p>
    <?php
	$startPoint=strlen($schlid);
	$class=substr($studid,$startPoint,4);
	
    echo load_elligible_student_account_details($schlid,$class);
    ?>
    </div>
    <?php
}elseif(!empty($prospectdetails)){
	if(isset($prospectdetails))$studentName=$prospectdetails['name'];
	?>
    <div>
    <span style="float:right">
        <a class="btn-link" href="">Exit</a>
    </span>
    <span class="clear"></span>
    <h3>
        Welcome <?php echo $studentName;?>.
    </h3>
    <div>The result of the test listed below are regular updated each time it is taken by you. Hence, your teach uses the latest update in computing your termly score.</div>
    <p style="font-size:18px; font-family:Cuprum; color:#F00;">
       Below is (are) the list of test you are eligible to take. 
    </p>
    <?php
	$class='Prospects';
    echo load_elligible_student_account_details($schlid,$class);
    ?>
    </div>
    <?php
}
?>
