<div id="pinOrderForm" class="modal hide fade">
	<div class="modal-dialog">
    		<div class="modal-content">
            	<div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="hidden">&times;</button>
                <h3 class="modal-title h-line">Access pin order form</h3>
                <div class="modal-body font">
                <div class="instruction-box"><img src="img/icons/icon-info.png" align="left" class="img-position"/><span>
                Simply select the card quantity and method in which it can be shipped accross to you and pay into the neccessary bank account the generated amount, including the order No. as part of the depositors names.
                Shipping cost.</span>
                </div>
                <form role="form" class="form-actions" method="post">
                
                <?php include("link-files/bank.php");?>
                <table>
                <tr><td>Quantity of cards : </td><td>
                <input type="hidden" name="orderid" id="orderid" value="<?php echo createOrderID('AP');?>" />
                	<select id="qty" onchange="calculateCardCost();">
                    <option value="">Select quantity</option>
                    <option value="100">100pcs</option>
                    <option value="500">500pcs</option>
                    <option value="1000">1000pcs</option>
                    </select></td></tr>
                 <tr><td>Method of shipment : </td><td>
                	<select id="method" onchange="calculateCardCost();">
                    <option value="">Select form of shipment</option>
                    <option value="Send pins in finished form">Send pins in finished form</option>
                    <option value="Send pins only">Send pins only</option>
                    
                    </select></td></tr>
              		</table>
                    <div id="result" class="font">
                    	
                    </div>
                   <div id="msgAlert">
                	</div>
                <button type="button" class="btn btn-info btn-block" onclick="placeOrder();">Order Access Pin</button>
                
                </form>
                	
                </div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>                
                </div>
            </div>
    </div>
</div>