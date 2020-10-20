<div id="placeAds" class="modal fade hide modalBg">
	<div class="modal-dialog">
    		<div class="modal-content">
            	<div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="hidden">&times;</button>
                <h2 class="modal-title h-line"><img src="img/icons/icon-placeAds.png" /> Place advert</h2>
                <div class="modal-body">
                

                <div class="instruction-box"><span>
                 Provide the requested information to place an advert order.</span>
                </div>
                
                <form id="usageHistory" enctype="multipart/form-data" method="post">
                <div style="line-height:20px; text-align:justify"><?php include("link-files/bank.php");?></div>
                <input type="hidden" name="adorderid" id="adorderid" value="<?php echo createOrderID('AO');?>" />
                <div id="adform" class="container-fluid">
                
                    <div class="row-fluid">
                    <div class="span2">
                        </div>
                    	<div class="span8">
                    		<div>ENTER TITLE : <input name="adsTitle" type="text" class="input" id="adsTitle" maxlength="20" placeholder="Enter ads title"  /></div>
                    		<div>
                            <select name="dimension" id="dimension">
                            	<option>Select Dimension</option>
                                <option value="5x2">5x2</option>
                                <option value="2x5">2x5</option>
                            </select>
                            </div>
                        
                        <h5>VALIDITY PERIOD.</h5>
                        <div>
                    		AVAILABLE FOR : <select name="validPeriod" id="validPeriod" class="input-small">
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
                            <div>
                             <button class="btn btn-info" type="button" onclick="placeAdsOrder();">Place order</button>
                            </div>
                        </div>
                        
                        <div class="span2">
                        
                        </div>
                    </div>
                    
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