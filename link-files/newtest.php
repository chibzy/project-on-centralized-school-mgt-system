<div class="instruction-box"><span>
The test settings of this cbt is created here, enter the test name,id,instruction,number of question,duration, % test displayed question during operation, target class,<br />
Test type and question display pattern, and click on "save and continue" to add a new cbt.
</span>
</div>
<form  method="post" style="font-size:13px;">
<div class="container-fluid">
<div class="row-fluid">
<div class="span12">
<div>
<div style="text-align:justify;">
TEST Name : <input type="text" name="testName" value="" maxlength="20" placeholder="Enter test name" /><br />
TEST ID : <input type="text" name="testID" class="input-small" value="" maxlength="5" placeholder="Enter test id" /><br />
</div>
<div style="border-top:#CCC solid thin; padding:5px 0 0 0;">
<span><b>ADD INSTRUCTION</b></span><br />
<textarea rows="2" class="input-xlarge" name="instruction" id="instruction">
</textarea>
</div>
<div style="border-top:#CCC solid thin; padding:5px 0 0 0;">
No. of Question per test : 
<select class="input-small" name="noofQuestion" id="noofQuestion">
    <option value="10">10</option>
    <option value="20">20</option>
    <option value="30">30</option>
</select>

Test Duration : 
<select class="input-small" id="testDuration" name="testDuration">
    <option value="10">10 min</option>
    <option value="20">20 min</option>
    <option value="30">30 min</option>
    <option value="45">45 min</option>
    <option value="60">60 min</option>
    <option value="90">90 min</option>
</select>

<div>
Percentage question to take during test operation is :
<select class="input input-small" name="Testpercent">
    <option value="100">100</option>
    <option value="90">90</option>
    <option value="80">80</option>
</select>
</div>

Select target class : <select class="input-small" name="targetClass" id='targetClass'>
    <?php
    	$Q=array();
		$nowYear=date("Y");
		$k=0;
		for($j=$nowYear;$j>($nowYear-6);$j--){
			$Q[$k]=$j;
			$k++;
		}
		$Q[$k++]='Prospects';
		$t=count($Q);
		$t=$t-1;
		while($t>-1){
			?><option value="<?php echo $Q[$t];?>"><?php echo $Q[$t];?></option><?php
			$t--;
		}
	?>
</select>

Test type : 
<select class="input-small" name="testType" id="testType">
    <option value="Live test">Live test</option>
    <option value="Practice test">Practice test</option>
</select>
</div>
<div>
</span>
<span class="checkbox form-inline"><label for="reshuffle"><input checked name="reshuffle" id="reshuffle" type="checkbox" /> Reshuffle question during test </label></span> 
<span>
<div>
</div>
</div> 
</div>
<div>
 <button class="btn btn-block btn-info" type="submit" name="btnSavenContinue">Save and continue </button>
</div>
</div>
</div>
</div>
</form>
