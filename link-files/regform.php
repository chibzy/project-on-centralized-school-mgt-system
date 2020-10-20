<?php #require_once("../connect/indexscripts.php"); #remove after test
$field=array();
$flagfields=array();
$flagvalues=array();
$schoollist='';

$ok=mysqli_query($conn,SQLretrieve('school',$field,$flagfields,$flagvalues));
if(mysqli_affected_rows($conn)>0){
$schoollist=mysqli_affected_rows($conn);
}

?>
          
		  <?php echo no_of_registered_school($schoollist);?>
          
          <span><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Register now</button></span></span>
          <div id="myModal" class="modal hide fade modalBg">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" type="button" data-dismiss="modal" aria-hidden="hidden">&times;</button>
                  <h3 class="modal-title h-line"><img src="img/icons/icon-admin-reg.png" /> School Adminstrator Registration Form</h3>
                  <div class="modal-body">
                  <div class="instruction-box"><span>Provide the requested information to open your account with us.</span></div>
                  <div id="msg"></div>
                    <form role="form" method="post">
                    <div class="form-group">
                    <table>
                    <tr><td>Name :</td> 
                    <td><input type="text" name="adminName" id="adminName" class="input-xlarge" placeholder="Name" /></td></tr>
                    <tr><td>Email address :</td> 
                    <td><input name="email" type="text" class="input-xlarge" id="email" maxlength="25" placeholder="Email (Enter a valid email Address)" /></td></tr>
                   <tr><td>Gender :</td>  
                   <td><select name="gender" id="gender" class="input-xlarge">
                <option selected="selected">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                    </select></td></tr>
                    <tr><td>Phone number :</td> 
                    <td><input type="text" name="phone" id="phone" class="input-xlarge" placeholder="Phone Number (e.g 070XXXXXXXX)" maxlength="11"/></td></tr>
                    <tr><td>Enter School Name :</td>
                    <td><input type="text" name="schoolName" id="schoolName" class="input-xlarge" placeholder="School Name" maxlength="50" /></td></tr>
                    <tr><td>Select State :</td>
                    <td>
                    <select id="state" name="state" class="input-xlarge" onchange="loadlocation();">
                    	<option>Select state</option>
                        <?php loadState('');?>
                    </select>
                    </td></tr>
                    <tr><td>Select Location :</td>
                    <td>
                    <select id="location" name="location" class="input-xlarge">
                    	<option>Select location</option>
                    </select>
                    </td></tr>
                    </table>
                    <button type="button" class="btn btn-info btn-block" name="register" onclick="submitRegForm();">Submit</button>
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
          <!--div>today and starting checking your school result online.</div-->