<?php
$testid='';
if(isset($_REQUEST['id'])) $testid=$_REQUEST['id'];
?>
<div class="cotainer-fluid">
<div class="row-fluid"><div class="span1"></div><div class="span10">
<div style="font-size:14px;">
<h3 class="h-line">Add Question:</h3>
<div class="instruction-box">
Below is the list of question added to this test. You can add new test to this, by selecting the question type and clicking on "add" button to add new question to the test, also, you can change the question content of this test by removing added question or modifying the content of the individual questions. Use the preview test button to check your test before permitting students to use it.
</div>
<div class="form-inline">
Question type : 
<select name="newQType" id="newQType">
<option value="Illustration based question">Illustration based question</option>
<option value="Non-illustration based question">Non-illustration based question</option>
</select> 
<input type='hidden' name="testid" id="testid" value="<?php echo $testid;?>">
<input type="button" class="btn btn-info" onclick="loadQform();" value="Add" data-target='#multipleAnswerTest'  data-toggle="modal" />
</div>
<br />
<div id='questionList' style="height:500px; overflow:scroll;">
<?php 
#echo "$schlid - $testid<br>";
listOfTestQuestions($schlid,$testid);
?>
</div>
<br />
<div class="btn-group"><input type="button" class="btn" onclick="loadTest('<?php echo $testid;?>','<?php echo $schlid;?>','../');" data-target="#testpreview" data-toggle="modal" value="Preview test" /> <input type="button" class="btn btn-error" onclick="removeTestQuestion('<?php echo $testid;?>','<?php echo $schlid;?>');" value="Remove question" /> <input type="button" onclick="window.close();" class="btn btn-info" value="Save test and exist "/></div>
</div>
</div>
<div class="span1"></div>
</div>
</div>