<?php
require_once("connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}
if(isset($_REQUEST['btnsearch'])){
	searchschool($_REQUEST['search']);
}
if(isset($_REQUEST['btnsearch2'])){
	searchschool($_REQUEST['search2']);
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Other services | Post primary school education center.</title>
<?php include("link-files/meta.php");?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>

<body>
<div class="container-fluid">
  <div class="heading row-fluid">
    <div class="span6 padding"><img src="img/logo.png" width="150" alt="logo">
      <div class="row-fluid">
        <div class="span12">
        <?php include("link-files/regform.php");?>
</div>
      </div>
    </div>
    <div class="span4 offset2 padding"><img class="pull-right" src="img/ministry_of_education.png" width="400" alt="ministry of education">
      <div class="row-fluid">
        <div class="span12">
          <?php include("link-files/search_form.php");?>
        </div>
      </div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <?php #include("link-files/menubar_link.php");?>
      <div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="index.php"><img src="img/icons/logo.png" width="80" /></a>
            <ul class="nav pull-right padding">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About us</a></li>
            <li><a href="support.php">Support</a></li>
            <li class="heading"><a href="otherservices.php">Other Services</a></li>
            <li><a href="faq.php">Faq</a></li>
            </ul>
       </div>
	</div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2">
    <div class="border">
    <?php include("link-files/school_search.php");?>
    <?php include("link-files/left_side_link.php");?>
	</div>
    <?php 
		displayAds('2x5');
	?>
</div>
    <div class="span7 border">
    <h2 class="h-line"><span><img src="img/icons/icon-support.png" width="30"></span> Other things we can do for you. </h2>
    <div>
    Our service remains the best as long as you let us know where and what you are experiencing difficulties.  
    </div>
    <div>
    <a name="tutorial" id="tutorial"></a>
    
    <a name="graphicDesign" id="graphicDesign"></a>
    
    <a name="webDesign" id="webDesign"></a>
    
    <a name="appDev" id="appDev"></a>
    
    <a name="bookPub" id="bookPub"></a>
    
    <a name="broDesign" id="broDesign"></a>
    
    <a name="calDesign" id="calDesign"></a>
    
    <a name="tShirtBranding" id="tShirtBranding"></a>
    
    <a name="vehicleBranding" id="vehicleBranding"></a>
    
    <a name="invoice" id="invoice"></a>
    
    <a name="busProfile" id="busProfile"></a>
    
    <a name="flierDesign" id="flierDesign"></a>
    
    <a name="signages" id="signages"></a>
    </div>
    </div>
    <div class="span3"> <!--right-sidebar"-->
    <div class="border">
    <?php include("link-files/ads.php");?>
    </div>
    <div class="social-background">
      <h4 class="h-line">Join us on social Networks</h4>
      <div>
        <div>
          <a href="#"><img src="img/fb.png"></a><a href="#"><img src="img/google.png"></a><a href="#"><img src="img/tw.png"></a><a href="#"><img src="img/whatsapp.png"></a>
          <p class="font">You can join us facebook, twitter, google+, and whatsapp, for weekly updates on our services </p>
        </div>
      </div>
  </div>
    </div>
  </div>
  <div class="row-fluid base-background">
    	<div class="span3 offset1">
          <?php include("link-files/quick_base_link.php");?>
        </div>
        <div class="span3">
          <?php include("link-files/service_base_link.php");?>
        </div>
    	<div class="span3">
         <?php include("link-files/contactinfo.php");?>
        </div>
    </div>
    <div class="row-fluid baselinks social-background-bottom font">
        <div class="span10">
          <p></p>
          <p align="center">&copy; <?php echo date('Y');?>, Signal technologies | All rights reserved.</p>
        </div>
        <div class="span2">
          <p>Powered by<br>
        Signal Technologies.</p>
        </div>
      </div>
</div>
</body>
</html>