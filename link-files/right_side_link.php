<h4 class="h-line"><img src="img/icons/icon-admin-login.png" align="left" class="img-position" /> School Adminstrator Access</h4>
    <div>
    <?php echo $loginMsg;?>
    </div>
      <form class="form-action" method="post">
      <div class="form-group" role="form">
         	
            <select name="schoolID" class="input">
            	<option>Select school </option>
                <?php
                	getSchoolForControl();
				?>
            </select><br />
         	Admin ID :<br />
            <input class="input" type="text" placeholder="Admin ID" name="adminID"><br />
            Password<br/>
            <input type="password" name="psw" placeholder="****">

            <button class="btn" type="submit" name="btnLogin"><span class="icon-lock"></span> Login</button>
         
         </div>
         </form>
         <!--p>Forgot your password? <a href="#">reset</a> now.</p-->
         <p><a href="" data-target="#myModal" data-toggle="modal">Register</a> new account</p>