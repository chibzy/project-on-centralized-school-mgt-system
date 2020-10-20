<div id="singleAnswerTest" class="modal hide fade">
	<div class="modal-dialog">
    		<div class="modal-content">
            	<div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="hidden">&times;</button>
                <h4 class="modal-title">Single Answer Question</h4>
                <div class="modal-body">
                
                <div class="container-fluid">
				<div class="row">
                	<div class="span2"></div>
                    	<div class="span8">
                		<?php
                        if(displayQuestionAddPopup($schlid,$testid)==false){
							echo "<h3> Sorry you have reach your test Maximuim Question limit</h3>";
						}else{
						?>
                        <form id="usageHistory" enctype="multipart/form-data" method="post">
                        <div>
                        
                        Question : <textarea class="input input-xlarge" placeholder="Enter question..."></textarea><br />
                        Enter answer options (seperate answer option with semi colon ';') : <br />
                        <textarea class="input input-xlarge" placeholder="Enter Answer options..."></textarea><br />
                        Enter answer(s) (seperate multiiple answer with semi colon ';') : <br />
                        <textarea class="input input-xlarge" placeholder="Enter Answer..."></textarea><br />
                        practice test reason (seperate answer option with semi colon ';') : <br />
                        <textarea class="input input-xlarge" placeholder="describe the reason for the answer(s)..."></textarea><br />
                        
                        <input type="submit" class="btn" value="save" />
                        </div>
                        </form>
                        <?php }?>
                        </div>
                	<div class="span2"></div>
                </div>
                </div>
                	
                </div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>                
                </div>
            </div>
    </div>
</div>