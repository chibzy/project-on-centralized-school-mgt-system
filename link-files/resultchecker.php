<h4 class="h-line"><img src="img/icons/icon-admin-login.png" align="left" class="img-position" />  <span class="pull-right" style="display:inline; width:175px;"><?php echo $schoolDetails['schlName']." <br>result checker";?></span>
<div class="clear"></div>
</h4>
    <div>
    <div id="Msg">
    <?php
	$curclass='';
	$curterm='';
	$studID='';
	
		if(isset($_POST['btnCheckResult'])){
			if(isset($_POST['schlid']))$schlid=mysqli_escape_string($conn,$_POST['schlid']);
			if(isset($_POST['pin']))$pin=mysqli_escape_string($conn,$_POST['pin']);
			if(isset($_POST['curclass']))$curclass=mysqli_escape_string($conn,$_POST['curclass']);
			if(isset($_POST['curterm']))$curterm=mysqli_escape_string($conn,$_POST['curterm']);
			if(isset($_POST['studID']))$studID=mysqli_escape_string($conn,$_POST['studID']);
			
			echo checkResult($schlid,$studID,$pin,$curclass,$curterm);
		}
    ?>
    </div>
    </div>
      <form method="post">
      <div class="container-fluid">
      <div class="row-fluid">
      <div class="span12">
      
      <input type="hidden" name="schlid" id="schlid" value="<?php echo $schoolDetails['schlid'];?>">   	
      		<div class="form-group">
            	<label for="studID">STUDENT ID</label>
                <input type="text" name="studID" id="studID" value="<?php echo $studID;?>" placeholder="Enter your student id" />
         	</div>
            <div class="form-group">
            	<label for="pin">PIN</label>
                <input type="password" name="pin" id="pin" placeholder="Enter the card hidden pin" />
         	</div>
            <div class="form-group">
                SELECT CLASS : <br /><select id="curclass" name="curclass">
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
                SELECT TERM : <br /><select id="curterm" name="curterm">
                	<?php
                    $term=array("First term","Second term","Third term","Annual");
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
            <button class="btn btn-info" type="submit" name="btnCheckResult"><span class="icon-lock"></span> Check result</button>
         
         
         </div>
         </div>
         </div>
         </form>
        <div>
        <span></span> Support line<br />
        Call : +234 7036 7654 46.<br />
        <span class="icon-envelope"></span> : ensy2006@yahoo.com
        </div>