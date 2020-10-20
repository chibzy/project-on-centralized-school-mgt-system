<?php
if(isset($_POST['saveAds'])){
	$orderid=$_POST['adorderid'];
	$dimension=$_POST['dimension'];
	$period=$_POST['validPeriod'];
	$title=$_POST['adsTitle'];
	$logo=$_FILES['img'];
	
	adminPlaceAds($orderid,$dimension,$period,$title,$logo);
}
?>
<div id="editAds" class="modal fade hide">
	<div class="modal-dialog">
    		<div class="modal-content">
            	<div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="hidden">&times;</button>
                <h2 class="modal-title h-line"><img src="../img/icons/icon-placeAds.png" /> Add / Edit advert</h2>
                <div class="modal-body">
                

                <div class="instruction-box"><img src="../img/icons/icon-info.png" align="left" class="img-position"/> <span>
                 Instruction below is the list of card useage rate of school name with date.</span>
                </div>
                
                <form id="usageHistory" enctype="multipart/form-data" method="post" class="form-actions">
                <?php #include("../link-files/bank.php");?>
                <input type="hidden" name="adorderid" id="adorderid" value="<?php echo createOrderID('AO');?>" />
                <div class="container-fluid">
                    <div class="row-fluid">
                    <div class="span2"></div>
                    	<div class="span8">
                    		<div>
                            ENTER TITLE : <input type="text" maxlength="20" name="adsTitle" id="adsTitle" class="input" placeholder="Enter ads title" />
                    	</div>
                    	<div>
                    		<select name="dimension" class="input">
                            	<option>Select Dimension</option>
                                <option value="5x2">5x2</option>
                                <option value="2x5">2x5</option>
                            </select>
                    	</div>
                    	<div>
                    		<br><input type="file" name="img" id="img" class="input" />
                    	</div>
                    
                    <br />
                    <h4>VALIDITY PERIOD</h4>
                    <br />
                    	
                    		<div>
                    		AVAILABLE FOR : <br /><select name="validPeriod" id="validPeriod" class="input-small">
                            	<option value="30">30</option>
                                <option value="60">60</option>
                                <option value="90">90</option>
                                <option value="120">120</option>
                                <option value="150">150</option>
                                <option value="180">180</option>
                                <option value="210">210</option>
                                <option value="240">240</option>
                                <option value="270">270</option>
                                <option value="300">300</option>
                                <option value="330">330</option>
                                <option value="360">360</option>
                            </select> day(s). 
                        </div>
                            
                      
                    </div>
                <div class="span2"></div>    
                </div>
                </div>
                <div>
                 <button class="btn btn-block btn-info" type="submit" name="saveAds">Save new Advert</button>
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