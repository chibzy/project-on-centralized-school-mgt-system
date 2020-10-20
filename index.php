<?php
require_once("connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
	$_SESSION['encryption-key']=12345;
	$_SESSION['iv']=4321;
}

$loginMsg="";
if(isset($_POST['btnLogin'])){
	
	$schoolID=$_POST['schoolID'];
	$adminID=$_POST['adminID'];
	$psw=$_POST['psw'];
	
	login($schoolID,$adminID,$psw);
}
#searh and display school page.
if(isset($_REQUEST['btnsearch'])){
	searchschool($_REQUEST['search']);
}
if(isset($_REQUEST['btnsearch2'])){
	searchschool($_REQUEST['search2']);
}
if(isset($_REQUEST['id']) && is_numeric($_REQUEST['id']) ){
	#do other things before displaying the page
	$schlid=$_REQUEST['id'];
	$schoolDetails=getSchoolDetails($schlid);
	if(empty($schoolDetails)){
		header("location:index.php");
	}
	if($schoolDetails['published']!='on'){
		header("location:index.php");
	}
	
	$schlname=$schoolDetails['schlName'];
	$schlstate=$schoolDetails['State'];
	$schllocation=$schoolDetails['location'];
	$schlAddress=$schoolDetails['address'];
	$schlgovt=$schoolDetails['govt_approved_status'];
	$schldescription=$schoolDetails['description'];
	$schlprog=$schoolDetails['schlProg'];
	$schlemail=$schoolDetails['email'];
	$schlphone=$schoolDetails['phone'];
	$schlLogo=$schoolDetails['schlLogo'];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Welcome to <?php echo $schlname;?> on post-primary school education center.</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<?php include("link-files/schoolmeta.php");?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/prototype.js"></script>
<script type="text/javascript" src="ScriptLibrary/mine.js"></script>
<script type="text/javascript" src="ScriptLibrary/scriptaculous.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>

<body class="font">
<div class="container-fluid">
  <div class="heading row-fluid">
    <div class="span6 padding">
    <img class="pull-left" src="img/ministry_of_education.png" width="300" alt="ministry of education">
    </div>
    <div class="span4 offset2 padding">
    <p>
      <?php include("link-files/search_form.php");?>
      <?php include("link-files/pinvalidationformfortest.php");?>
    </p>  
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
    <hr>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2">
    <div class="border">
    <?php 
		displayAds('2x5');
	?>
	</div>    
    </div>
    <div class="span7 border">
    <div class="h-line">
    <?php echo displayLogo($schlLogo)?>
    <div style="display:inline-block; margin-left:10px;"><h1><?php echo " {$schoolDetails['schlName']}";?></h1>
    <h4 style="color:#F00;"><?php echo $schoolDetails['address'];?></h4>
    </div>
    </div>
        <div>
        <ul class="nav nav-tabs">
        	<li class="active disabled"><a data-toggle="tab" href="#home"><span class="icon-home"></span>  Home</a></li>
            <li class="disabled"><a data-toggle="tab" href="#menu1"><span class="icon-bookmark"></span>  Programs</a></li>
            <li class="disabled"><a data-toggle="tab" href="#menu2"><span class="icon-play"></span>  Online test</a></li>
        </ul>
        <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Brief descrption of <?php echo $schlname;?></h3>
      <p>
      	<?php echo $schldescription;?>
      </p>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3><?php echo $schlname;?> Schedules</h3>
      	<?php
    	$midtermBreak='';
	    $InterHouseSports='';
	    $MidtermTest='';
	    
	  $schedule=explode(':',$schlprog);
	  if($schedule[0]!='')$midtermBreak="<div title=\"Midterm break\" class=\"midBg\"><img src='img/icons/icon-midterm-break.png' style=\"padding-right:20px;\" align='left'> <span style=\"font-size:large; padding:20px;\"><h4>Mid Term Break Date : </h4>{$schedule[0]}</span></div><div class=\"clear\"></div>";
	  if($schedule[1]!='')$InterHouseSports="<div title=\"Inter-House sports\" class=\"midBg\"><img src='img/icons/icon-midterm-sports.png' style=\"padding-right:20px;\" align='left'>  <span style=\"font-size:large; padding:20px;\"><h4>Inter house sports Date : </h4>{$schedule[1]}</span></div><div class=\"clear\"></div>";
	  
	  if($schedule[2]!='')$MidtermTest="<div title=\"Midterm test\" class=\"midBg\"><img src='img/icons/icon-midterm-test.png' style=\"padding-right:20px;\" align='left'>  <span style=\"font-size:large; padding:20px;\"><h4>Mid Term Test Date :</h4>{$schedule[2]}</span></div><div class=\"clear\"></div>";
	   ?>
      </p>
      <p>
      <?php echo $midtermBreak;?>
      </p>
      <p>
      <?php echo $InterHouseSports;?>
      </p>
      <p>
      <?php echo $MidtermTest;?>
      </p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <div class="instruction-box">
        <span>Here, you can begin your online test, by supplying the needed information.</span>
        </div>
        <hr>
      <div id="cbtIntro">
      <?php
      include('link-files/cbt_page_1.php');
	  ?>
      </div>
    </div>
  </div>
   </div>
      <div class="row-fluid">
        <div class="span6">     
      <?php #echo $schoolDetails['description'];?>
        </div>
        
      </div>
    <div class="row-fluid base-background">
    <div class="span2"></div>
    <div class="span7">
      <h3>Join our social Networks
      </h3>
      <?php
	  $email='';
	  $facebook='';
	  $twitter='';
	  $google='';
	  $whatsup='';
	  $website='';
      
	  $socials=explode(':',$schlemail);
	  if($socials[0]!='')$email="<div>Contact us on {$socials[0]}</div>";
	  if($socials[1]!='')$facebook="<a href='https://{$socials[1]}' target='_blank'><img src='img/fb.png'></a>";
	  if($socials[2]!='')$twitter="<a href='https://{$socials[2]}' target='_blank'><img src='img/tw.png'></a>";
	  if($socials[3]!='')$google="<span> <img src='img/google.png'> Our whatsap contact -  {$socials[3]}' </span>";
	  if($socials[4]!='')$whatsup="<div> <img src='img/whatsapp.png'> Our whatsap contact -  {$socials[4]}' </div>";
	  if($socials[5]!='')$website="<a href='http://{$socials[5]}' target='_blank' class=\"btn btn-info btn-block\"> Click to visit us on {$socials[5]}</a>";
	  ?>
      <div class="row-fluid">
        <div class="span12" style="line-height:15px; color:#fff;">
          <?php echo "$facebook $twitter $google $whatsup $email ";?>
          <br>
          <p style="">You can join us on facebook, twitter, google+, and whatsapp, for updated information about our services </p>
        </div>
      </div>
    </div>
  </div>
  <div class="row-fluid">
  <div class="span6"></div><br>
    <div class="span6 breadcrumb">
          <p style="font-family:Tahoma; font-size:18px; text-align:center;"> To learn more about us </p><?php echo $website;?>
        </div>
    </div>
    </div>
    <div class="span3 border">
    <?php include("link-files/resultchecker.php");?>
    </div>
  </div>
<div class="row-fluid baselinks social-background-bottom font">
  <div class="span10">
    <p></p>
    <p align="center">
    <a href="index.php">Home</a> | <a href="aboutus.php">About us</a><br>
    &copy; <?php echo date('Y');?>, Signal technologies | All rights reserved.</p>
  </div>
  <div class="span2">
    <p>Powered by<br>
  Signal Technologies.</p>
  </div>
</div>

</div>
</body>
</html>
<?php
}else{

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Welcome to post-primary school education center.</title>
<?php include("link-files/meta.php");?>
<style type="text/css" media="screen">
    
</style>
<!--meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1"-->
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/js/carousel.js"></script>
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
        <div class="span12 font">
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
    <div class="span12 searchbg">
      <div class="carousel slide" id="myCarousel" data-ride="carousel" data-interval="5000" >
      	<ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
      	<div class="carousel-inner">
        	<div class="active item"><a href="" data-target="#myModal" data-toggle="modal"><img src="img/ads1.png"></a></div>
            <div class="item"><a href="" data-target="#myModal" data-toggle="modal"><img src="img/ads2.png"></a></div>
            <div class="item"><a href="" data-target="#myModal" data-toggle="modal"><img src="img/ads3.png"></a></div>
        </div>
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
      </div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
    <div class="navbar">
      	<div class="navbar-inner menu_content">
        	<a class="brand" href="index.php"><img src="img/icons/logo.png" width="80" /></a>
            <ul class="nav pull-right padding">
            <li class="heading"><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About us</a></li>
            <li><a href="otherservices.php">Other Services</a></li>
            <li><a href="Faq.php">Faq</a></li>
            </ul>
       </div>
	</div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2 border">
    <?php include("link-files/school_search.php");?>
    <?php include("link-files/left_side_link.php");?>
    <?php 
		displayAds('2x5');
	?>
</div>
    <div class="span7 border">
    <!--h2 class="h-line"><span><img src="img/icons/icon-home.png" width="30"></span><span class="verticalize"> Home </span></h2-->
      <!--p>
      Ppseducation center provides the best online result processing platform for post-primary schools in Nigeria, using the Nigerian education grading standards.</p>
      <p><span class="subheading">Features</span>
      <ul>
      	<li>Free web presence for registered schools</li>
        <li>Access to result checker</li>
        <li>24/7 access to students result</li>
        <li>Access  to computer based test</li>
        <li>Easy to setup</li>
        <li>The results are stored online for more than six years.</li>
        <li>No setup fee required</li>
        <li>Toll free support services</li>
        <li>Easy to incorporate into an existing website</li>
      </ul>
      </p>
      
      <p>
      <span class="subheading">Requirements</span>
      <ul>
      	<li>Functional email address</li>
        <li>A school result administrator</li>
      </ul>
      </p-->
<div><h1 class="body-instruction-box">Who we are </h1>
   
<div class="home-p" >Ppseducation center is an online platform born with sole motive of improving teaching and
Learning at secondary school level in Nigeria. It strive to attain it objective, through the use of computer technology
In automating academic and non academic activities that build secondary school students into becoming responsible individual in the society.
</div>
<div class="home-p">
At ppseducation center, we promote cultural and Religious believes of our member schools, by allowing schools to determine the content of their
Their school page on ppseducation center.This implies that, for instance, both coeducational and non-coeducational scondary schools are at liberty operate in the
Platform. To add to the benefits of the platform, individual school pages holds information that describes a member school, its events, and students access to 
Online test platform and result checker. We also promote schools social network such as facebook,tweeter on our member school page because, we understand the power of
Information in modern days teach and learning.
</div>
</div>

<div class="highlight">
<h3>Simple but powerful tool for your students teaching and learning;</h3>
Stay ahead of others
<a class="btn btn-danger" data-toggle="modal" data-target="#myModal">GET STARTED AND ENJOY UNLIMITED EXPERIENCE IN TEACHING AND LEARNING</a>
</div>
    </div>
    <div class="span3"> <!--right-sidebar"-->
    <div class="border">
    <?php include("link-files/right_side_link.php");?>
    
    
    </div>
    <div class="social-background">
    
    <div style="font-size:13px; font-family:Cuprum; text-align:justify; margin-bottom:5px; line-height:normal; color:#fff;">
Are you a secondary school properitor, principal or anybody intersted in promoting your student education? You are highly welcome to this platform, as we encourage you to 
Go through the website and chose the best services that suites your academic setup.
</div>
    
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
  <div class="row-fluid homeItems">
  <div class="span12">  
  <div class="row-fluid">
<div class="span3">
    <div class="statementBlock">
    <img src="img/icons/icon-secured.png">
    <h3>FEATURES </h3>
    <ul>
    <li>SCHOOL EVENT PUBLISHING</li>
    <li>STUDENT REPORT CARD</li>
    <li>TRANSCRIPT GENERATION</li>
    <li>DEDICATED SCHOOL PAGE</li>
    <li>COMPUTER BASE ASSESSMENT</li>
    <li>AND LOTS MORE</li>
    </ul>
    </div>
<div class="statementBlock">    
<h3>PRICING AND TESTIMONIALS</h3>
WITH AS LOW AS N500, YOUR STUDENT CAN ENJOY UNLIMITED ACCESS TO ALL THE FEATURES, WITH 24/7 SUPPORT PER TERM
<br><a class="btn btn-block btn-danger" data-toggle="modal" data-target="#myModal" href="">REGISTER NOW</a> TO START ENJOYING THIS FEATURES.
</div>

</div>
<div class="span3">
    <div class="statementBlock">
    <img src="img/icons/icon-gift.png">
    <h3>WHY YOU SHOULD CHOOSE PPSEDUCATION CENTER</h3>
    <ul>
    <li>WE SIMPLFY YOUR PROBLEM, THROUGH SOLUTION THAT ATTRACTS YOUR STUDENTS INTEREST</li> 
    <li>WE DON'T JUST THROW IT TO YOU, WE LEAD YOU THROUGH IT.</li>
    <li>WE OPERATE ON A FAST STATE OF THE ART TECHNOLGY, THAT IS CAPABLE OF WORKING ON SLOW INTERNET CONNECTION</li>
    <li>WE OPERATES A 24/7 CUSTOMER SUPPORT SERVICE TO ASSIST YOU IN YOUR DIFFICULTY.</li>
    <li>EASY TO SETUP</li>
    <li>NO SETUP FEE REQUIRED</li>
    <li>EASY TO INCOOPERATE INTO AN EXISTING WEBSITE</li>
    <li>THE RESULTS ARE STORED ONLINE FOR MORE THAN SIX YEARS</li>
    </ul>
    </div>
</div>
<div class="span3">
<div class="statementBlock">
<img src="img/icons/icon-access.png">
<h3>EASE OF ACCESS</h3>
<ul>
<li>USING THIS PLATFORM LIMITS YOU NOT ON YOUR CURRENT ENVIRNMENT, IT TAKES YOU FAR BEYOUND IMAGINATION</li>
<li>SCHOOL COMPUTER ADMINSTRATORS CAN DO THEIR WORK WITH EASE</li>
<li>EASY TO ACCESS FILE ORGANIZATION</li>
<li>SECURED AUTHOURISATION FOR SCHOOL RESULT ADMINISTRATORS</li>
<li>ACCESSIBLE ON ANY INTERNET ENABLED DEVICE. </li>
</ul>
<h3>EASY TO ADAPT</h3>
<ul>
<li>WITH OUR EFFICIENT FEEDBACK MECHANISM, BE REST ASSURED YOU CAN BE LEFT IN THE MIDDLE OF THE SEA</li>
<li>WE CAN INTEGERATE CUSTOM MADE FUNCTIONS JUST FOR YOUR SATISFACTION</li>
</ul>
</div>
</div>
<div class="span3">
<div class="statementBlock">
<img src="img/icons/icon-profit.png">
<h3>YOU CAN MAKE MORE PROFIT</h3>
<ul>
<li>WE UNDERSTAND YOU ARE IN THE BUSINESS OF TEACHING AND LEARNING, SO;</li>
<li>WE PROVIDE WITH THE INFRASTRUCURE NEEDED TO MOVE YOUR BUSINESS FOWARD</li>
<li>GUARANTING NOT LESS 5% ADDITIONAL REVENUE PER TERM.</li>
<li>SAVES YOU THE COST OF  PRINTING STUDENTS REPORT CARD.</li>
<li>BOOST YOUR SCHOOLS REPUTATION, WHICH ATTRACT MORE STUDENTS IN RETURN.</li>
<li>COST EFFECTIVE ADVERT PLATFORM THAT GET DIRECTLY TO YOUR TARGET.</li>
</ul>
</div>
</div>
</div>
<hr>
<div class="row-fluid">
<div class="span6">
<div class="statementBlock">
<h3>HOW TO REGISTER</h3>
In order to become a member of this platform, it is expected that the propective school must have a functional email address and an information technology inclined 
Personnel (computer teacher), whose expertise will be employed in carrying out some functions in the platform. However, in the absence of any information technology inclined personnel,
Our easy to understand help topics and support will always assist you whenever it is neccessary. 
<br>
To register your school,
<ol>
<li>Click on the registration button and supply the neccesary information as requested by the form.</li>
<li>Activate your new account using the activation link sent to your email address.</li>
<li>Login to your account using the admin ID and password supplied with your activation email. The you can explore the platorm to its fullness.</li>
</ol>
</div>
</div>
<div class="span6" style="text-align:center;">
<h1>TESTIMONIAL</h1>
  <div class="carousel slide" id="myTestimonial" data-ride="carousel" data-interval="5000" >
    
    <ol class="carousel-indicators">
        <li data-target="#myTestimonial" data-slide-to="0" class="active"></li>
        <li data-target="#myTestimonial" data-slide-to="1"></li>
        <li data-target="#myTestimonial" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="active item item2">
        
        <div >
        <img class="img-circle" src="img/aboutus/woman.jpg" width="180px"><br>
        <h4>AT FIRST I FELT IT WAS ONE OF THOSE SOFTWARE THAT IS DISCONTINUED AFTER ONE TERM OF USAGE, NOW I UNDERASTAND BETTER,
          THIS IS UNIQUE, KEEP IT UP GUYS</h4>
        <div class="commentor">Iwuoha Joy<p>The Computer Instructor at Joe links schools owerri.</p></div>
        </div>
        
        </div>
        <div class="item item2">
        
        <div>
        <img class="img-circle" src="img/aboutus/staff.jpg" width="180px"><br>
        <h4>I HAVE ALWAYS THOUGHT OF A CBT APPLICATION THAT WILL GIVES ME THE LEVERAGE TO PREPARE MY OWN ASSESSMENT FOR MY STUDENTS
          WITHOUT THE TECH GUYS, THIS IS A PERFECT ANSWER TO MY PRAYERS</h4>
        <div class="commentor">Anyanwu Samuel <p>The Computer Instructor at Dallas International schools owerri.</p></div>
        </div>
        
        </div>
        <div class="item item2">
        
        <div>
        <img class="img-circle" src="img/aboutus/akwi.jpg" width="180px"><br>
        <h4>IT HAS REALLY SAVED ME FROM THE EXPENSES I MAKE ON PRINTING REPORT CARDS AND ADDED MORE PROFIT TO OUR COFFER. THANKS SO  MUCH. </h4>
        <div class="commentor">Akwarwndu J. <p>The properiator Dallas International schools owerri.</p></div>
        </div>
        
        </div>
    </div>
    <a class="carousel-control left" href="#myTestimonial" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myTestimonial" data-slide="next">&rsaquo;</a>
  </div>
</div>
</div>

</div>



</div>




<!--
*remove tutorial link -

Functions that requires description
 :creation of ads
 :
      -->

  
  </div>
  <!--div-->
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
    <!--/div-->
</div>
<!---->
<div>
</body>
</html>
<?php	
}