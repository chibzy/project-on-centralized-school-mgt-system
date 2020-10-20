<?php 

$url=$_SERVER['REQUEST_URI'];
$page=explode('/', $url);
$count=count($page);
$curPage=strtolower($page[$count-1]);

if($curPage=='index.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="index.php"><img src="img/logo.png" width="80" /></a>
            <ul class="nav pull-right padding">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About us</a></li>
            <li><a href="Support.php">Support</a></li>
            <li><a href="Faq.php">Faq</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='aboutus.php'){ ?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="index.php">Post primary school education center</a>
            <ul class="nav pull-right">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="aboutus.php">About us</a></li>
            <li><a href="Support.php">Support</a></li>
            <li><a href="Faq.php">Faq</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='support.php'){ ?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="index.php">Post primary school education center</a>
            <ul class="nav pull-right">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About us</a></li>
            <li class="active"><a href="Support.php">Support</a></li>
            <li><a href="Faq.php">Faq</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='faq.php'){ ?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="index.php">Post primary school education center</a>
            <ul class="nav pull-right">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About us</a></li>
            <li><a href="Support.php">Support</a></li>
            <li class="active"><a href="Faq.php">Faq</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='accountsettings.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="AdminDashboard.php">DashBoard of <?php echo $schldetails['schlName'];?></a>
            <ul class="nav pull-right">
            <li class="active"><a href="AdminDashboard.php">Dashboard</a></li>
            <li><a href="#" data-target="#pinOrderForm" data-toggle="modal">Order Pin</a></li>
            <li><a href="Signout.php">Signout</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='studentmgt.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="AdminDashboard.php">DashBoard of <?php echo $schldetails['schlName'];?></a>
            <ul class="nav pull-right">
            <li class="active"><a href="AdminDashboard.php">Dashboard</a></li>
            <li><a href="#" data-target="#pinOrderForm" data-toggle="modal">Order Pin</a></li>
            <li><a href="Signout.php">Signout</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='managesubject.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="AdminDashboard.php">DashBoard of <?php echo $schldetails['schlName'];?></a>
            <ul class="nav pull-right">
            <li class="active"><a href="AdminDashboard.php">Dashboard</a></li>
            <li><a href="#" data-target="#pinOrderForm" data-toggle="modal">Order Pin</a></li>
            <li><a href="Signout.php">Signout</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='admindashboard.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="AdminDashboard.php">DashBoard of <?php echo $schldetails['schlName'];?></a>
            <ul class="nav pull-right">
            <li class="active"><a href="AdminDashboard.php">Dashboard</a></li>
            <li><a href="#" data-target="#pinOrderForm" data-toggle="modal">Order Pin</a></li>
            <li><a href="Signout.php">Signout</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='subjectallocation.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="AdminDashboard.php">DashBoard of <?php echo $schldetails['schlName'];?></a>
            <ul class="nav pull-right">
            <li class="active"><a href="AdminDashboard.php">Dashboard</a></li>
            <li><a href="#" data-target="#pinOrderForm" data-toggle="modal">Order Pin</a></li>
            <li><a href="Signout.php">Signout</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='classlist.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="AdminDashboard.php">DashBoard of <?php echo $schldetails['schlName'];?></a>
            <ul class="nav pull-right">
            <li class="active"><a href="AdminDashboard.php">Dashboard</a></li>
            <li><a href="#" data-target="#pinOrderForm" data-toggle="modal">Order Pin</a></li>
            <li><a href="Signout.php">Signout</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='resultchecker.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="index.php">Post primary school education center</a>
            <ul class="nav pull-right">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About us</a></li>
            <li><a href="Support.php">Support</a></li>
            <li><a href="Faq.php">Faq</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='results.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="AdminDashboard.php">DashBoard of <?php echo $schldetails['schlName'];?></a>
            <ul class="nav pull-right">
            <li class="active"><a href="AdminDashboard.php">Dashboard</a></li>
            <li><a href="#" data-target="#pinOrderForm" data-toggle="modal">Order Pin</a></li>
            <li><a href="Signout.php">Signout</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='account.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand">Admin@ Post primary school education center </a><marquee vspace="10" width="600" behavior="scroll" direction="left">#total registered <a href="#">school</a>, address, and population</marquee>
            <ul class="nav pull-right">
            <li><a href="signout.php">Sign out</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='accesspins.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand">Admin@ Post primary school education center </a><marquee vspace="10" width="600" behavior="scroll" direction="left">#total registered <a href="#">school</a>, address, and population</marquee>
            <ul class="nav pull-right">
            <li><a href="signout.php">Sign out</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='ads.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand">Admin@ Post primary school education center </a><marquee vspace="10" width="600" behavior="scroll" direction="left"><?php echo determineRegisteredSchool();?> <?php echo determineUnpublishedSchool('on');?> <?php echo determineUnpublishedSchool('');?></marquee>
            <ul class="nav pull-right">
            <li><a href="signout.php">Sign out</a></li>
            </ul>
       </div>
</div>
<?php }if($curPage=='home.php'){?>
<div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand">Admin@ Post primary school education center </a><marquee vspace="10" width="600" behavior="scroll" direction="left"><?php echo determineRegisteredSchool();?> <?php echo determineUnpublishedSchool('on');?> <?php echo determineUnpublishedSchool('');?></marquee>
            <ul class="nav pull-right">
            <li><a href="signout.php">Sign out</a></li>
            </ul>
       </div>
</div>
<?php }?>