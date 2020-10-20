<?php #require_once("../connect/indexscripts.php"); #remove after test
?>
          
          <div id="myPinValidation" class="modal hide fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" type="button" data-dismiss="modal" aria-hidden="hidden">&times;</button>
                  <h3 class="modal-title h-line"><img src="img/icons/icon-admin-reg.png" />Computer based Test</h3>
                  <div class="modal-body">
                  <div class="instruction-box"> <span>This represents your result on this live test.</span></div>
                  <div id="msg"></div>
                    <form role="form" method="post" id="cbtresult">
                    
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>