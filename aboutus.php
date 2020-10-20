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
<title>About us | Post-primary school education center.</title>
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
        <?php #include("link-files/login.php");?>
</div>
      </div>
    </div>
    <div class="span4 offset2 padding"><img class="pull-right" src="img/ministry_of_education.png" alt="ministry of education">
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
            <li class="heading"><a href="aboutus.php">About us</a></li>
            <li><a href="otherservices.php">Other Services</a></li>
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
    <div class="row-fluid">
        <div class="span12">
        <!--google ads-->
        	<img src="img/google_ad.png">
        </div>
     </div>
</div>
    <div class="span7 border">
<div class="aboutteam">
<h1>MEET OUR TEAM</h1>
We are committed to lead you to the next level, with our team of professionals, you have no cause to fear.
<ul>
<li>
<div class="staffset">
<span class="imageHolder">
<img src="img/aboutus/vincento.jpg" width="100" class="img-circle">
<p class="staffname">Vincent <br><span class="staffQ"></span></p>
</span>
	<span class="openQuote"><img src="img/icons/icon-open-quote.png" width="50px"></span><span class="staffcomment">
    A clear indication of an educated mind, though not easy to comeby, but dipicts wonders that comes from a truely educated mind, not that which only crave for paper qualification.
    </span><span class="closeQuote"><img src="img/icons/icon-close-quote.png" width="50px">
    </span>
</div>
</li>

<!--li>Member b jerry: msc imt - </li-->

<li>
<div class="staffset">
<span class="imageHolder">
<img src="img/aboutus/chibuz.jpg" width="100" class="img-circle">
<p class="staffname">Sebastian <br><span class="staffQ"></span></p>
</span>
	<span class="openQuote"><img src="img/icons/icon-open-quote.png" width="50px"></span><span class="staffcomment">Education is the best thing that can happen to a man, without it who knows
    we might be 3000 year behind civilization, so do not shy away from it, for it is a major tool to overcome.
    <br>the train is on the move again cease and dont let it slip away from you, because it is your gift to the feature.
    </span><span class="closeQuote"><img src="img/icons/icon-close-quote.png" width="50px">
    </span>
</div>
</li>
</ul>

</div>

    </div>
    <div class="span3">
    <div class="border">
    <?php #include("link-files/ads.php");?>
    <?php 
		displayAds('2x5');
	?>
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