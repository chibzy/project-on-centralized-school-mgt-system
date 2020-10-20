<div id="mySchoolSearch" class="modal hide fade modalBg">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" type="button" data-dismiss="modal" aria-hidden="hidden">&times;</button>
                  <h3 class="modal-title h-line"><img src="img/icons/icon-search_school.png" /> School Search Form</h3>
                  <div class="modal-body">
                  <div class="instruction-box"><span> Checking of results or undertaking school CBTs is only accessible through a registered school page. Enter your school name and click search, to locate your school page.</span></div>
                  <div id="msg"></div>
                  <form class="form-horizontal searchform" method="get" name="searchform">
            	<p class="pull-right search-input">
              Enter the name of your school : 
              <input id="search2" name="search2" autocomplete="off" onkeyup="suggest('search2','suggestion2');" type="text" placeholder="Search school..." /><span id="suggestion2" style="display:none;border:1px solid #CCC;background-color:white;z-index:5;">
              </span>
              <button type="submit" name="btnsearch2" class="btn"><span class="icon icon-search"></span></button>
           
           		</p>
				</form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>