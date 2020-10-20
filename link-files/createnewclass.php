<div id="createNewClass" class="modal hide fade modalBg">
	<div class="modal-dialog">
    		<div class="modal-content">
            	<div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="hidden">&times;</button>
                <h3 class="modal-title h-line">New Class</h3>
                <div class="modal-body font">
                <div class="instruction-box"><span>
To create new class, select the year of admission, the subclass and the number of student you want to currently add to the class.
</span></div>
                <div class="clear"></div>
                <form action="saveNewClass.php" method="get">
                <div class="container-fluid">
                <div class="row-fluid">
                <div class="span5">
                Enter year of admission : 
                </div><div class="span7">
                <?php
                	$curYear=date('Y');
					$lastYear=$curYear-6;
					
					?><select name="studClass" id="studClass" class="input input-small"><?php
					for($i=$curYear;$i>=$lastYear;$i--){
					?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php	
					}
					?></select><?php
				?>
                </div>
                </div><div class="row-fluid">
                <div class="span5">
                Choose sub class :
                </div><div class="span7">
                <select name="studsubClass" id="studsubClass" class="input input-small">
                						<!--option class="None">None</option-->
                                        <option class="A">A</option>
                                        <option class="B">B</option>
                                        <option class="C">C</option>
                                        <option class="D">D</option>
                                    	<option class="E">E</option>
                                        <option class="F">F</option>
                                    </select>
                </div>
                </div><div class="row-fluid">
                <div class="span5">Number of student(s) :</div><div class="span7"> <!--input type="text" id="studPop" name="studPop" size="3" maxlength="3" onblur="intAlert('studPop');" /-->
                <select name="studPop" id="studPop" class="input input-small" onblur="intAlert('studPop');" >
                						<!--option class="None">None</option-->
                                        <option class="1">1</option>
                                        <option class="2">2</option>
                                        <option class="3">3</option>
                                        <option class="4">4</option>
                                    	<option class="5">5</option>
                                        <option class="6">6</option>
                                        <option class="7">7</option>
                                        <option class="8">8</option>
                                        <option class="9">9</option>
                                        <option class="10">10</option>
                                    	</select>
                
                </div>
                </div><div class="row-fluid">
                <div class="span12"><button type="button" onclick="CreateClass('studPop');" class="btn btn-block btn-info">Create class / add student (s) to class </button></div><!--div class="span6"><button type="button" onclick="EditClass();" class="btn btn-block btn-danger"> Add class student(s)</button>
                </div-->
                <p></p>
                <div class="span12">
                    Change the subjects your student are eligible to take every term, using the <a href="subjectallocation.php">subject allocation</a> table.</div>
                </div></div>
                </form>
                	
                </div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>                
                </div>
            </div>
    </div>
</div>