<h3><?php #echo $schlname;
$curclass='';
$curterm='';
?></h3>
        
        <div class="row-fluid">
        <div class="span3"></div>
    	<div class="span6">
        
        <form class="form-actions">
            <span class="form-inline checkbox"><label for="stud"><input type="checkbox" name="stud" id="stud" onclick="Effect.toggle('nonprospect','BLIND');" /> I am a student </label></span>
            <br />
            <div id="nonprospect" style="display:none;">
            	Select class : <br /><select id="curclass" name="curclass">
                	<?php
                    $class=array("jss 1","jss 2","jss 3","ss 1","ss 2","ss 3");
					for($i=0;$i<count($class);$i++){
						if(strtolower($curclass)==$class[$i]){
							?><option selected="selected" value="<?php echo $class[$i];?>"><?php echo $class[$i];?></option><?php
						}else{
							?><option value="<?php echo $class[$i];?>"><?php echo $class[$i];?></option><?php
						}
					}
					?>
                </select><br />
                Select term : <br /><select id="curterm" name="curterm">
                	<?php
                    $term=array("First term","Second term","Third term");
					for($i=0;$i<count($term);$i++){
						if(strtolower($curterm)==$term[$i]){
							?><option selected="selected" value="<?php echo $term[$i];?>"><?php echo $term[$i];?></option><?php
						}else{
							?><option value="<?php echo $term[$i];?>"><?php echo $term[$i];?></option><?php
						}
					}
					?>
                </select>
            </div>
            Pin :<br>
            <input type="password" name="pin" id="pin" placeholder="Enter pin">
            <br>
            Student id :<br>
            <input type="text" name="studid" id="studid" placeholder="Enter student ID">
            <br>
            <button type="button" class="btn btn-large btn-block btn-small btn-info" onClick="cbtValidateStudent('<?php echo $schlid;?>')"> Continue </button>
        </form>
        </div>
        <div class="span3"></div>
        </div>