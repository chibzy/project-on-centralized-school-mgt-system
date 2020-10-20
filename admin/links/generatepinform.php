<?php
if(isset($_POST['btnGeneratePin'])){
	$qty='';
	$usage='';
	if($_POST['pinQty']!='') $qty=mysqli_escape_string($conn,$_POST['pinQty']);
	if($_POST['usagePeriod']!='') $usage=mysqli_escape_string($conn,$_POST['usagePeriod']);
	
	listPins($qty,$usage);
}
?>
<div id="generatePinForm" class="modal hide fade">
	<div class="modal-dialog">
    		<div class="modal-content">
            	<div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="hidden">&times;</button>
                <h3 class="modal-title h-line"><img src="" /> Pin Generation form</h3>
                <div class="modal-body">
                
                <div class="instruction-box"><img src="../img/icons/icon-info.png" align="left" class="img-position"/> <span>
                Instruction on how to generate access pin are made here.</span>
                </div>
                
                <form method="post" class="form-actions">
                	<div><select id="pinQty" name="pinQty">
                    <option>Select quantity to generate</option>
                    <option value="100">100pcs</option>
                    <option value="500">500pcs</option>
                    <option value="1000">1000pcs</option>
                    </select>
                    </div>
                
                	<div><select id="usagePeriod" name="usagePeriod">
                    <option>Select useage period</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    </select>
                    </div>
                
                    <div><button type="submit" class="btn btn-block btn-info" name="btnGeneratePin" id="btnGeneratePin">Generate Pins</button>
                 </div>               
                </form>
                	
                </div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>                
                </div>
            </div>
    </div>
</div>