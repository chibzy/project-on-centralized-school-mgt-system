<div>
<h4 style="font-family:Cuprum;">Available computer based test</h4><br />
<form method="post">
<div class="btn-group">
<input type="button" onclick="prepareCBT();" data-target="#addTest" data-toggle="modal" class="btn btn-danger" value="Add new test" /> <input type="button" class="btn" onclick="removeTest(<?php echo $schlid;?>);" value="Remove Test" /> <input type="submit" name="exit" class="btn btn-info" value="Exit "/></div><br>
<div id="testList" style="height:450px; overflow:auto;">
<?php
	echo listOfAdminCBT($schlid);
?>
</div>
<br /><div class="btn-group">
<input type="button" onclick="prepareCBT();" data-target="#addTest" data-toggle="modal" class="btn btn-danger" value="Add new test" /> <input type="button" class="btn" onclick="removeTest(<?php echo $schlid;?>);" value="Remove Test" /> <input type="submit" class="btn btn-info" value="Exit" name="exit"/></div><br>
</form>
</div>
<br />