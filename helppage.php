<?php
require_once("connect/indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}

include("link-files/header.php"); #cause redirection of request after signout

$schlid=$_SESSION['schlid'];
$schldetails=array();
$schldetails=getSchoolDetails($schlid);

$schlname=$schldetails['schlName'];
$schlstate=$schldetails['State'];
$schllocation=$schldetails['location'];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $schlname;?> - Help page | Post primary school education center.</title>
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
  <div class="adminHeading row-fluid">
    <div class="span6 padding">
	<?php include("link-files/schoolheading.php");?>
    <?php include("link-files/placeadsform.php");?>
    </div>
    <div class="span4 offset2 padding"><img class="pull-right" src="img/ministry_of_education.png" alt="ministry of education">
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
    <!-- menubar -->
    <div class="navbar">
      	<div class="navbar-inner">
        	<a class="brand" href="admindashboard.php"><img src="img/icons/icon-school-home.png" align="left" class="school-img-position" /> <?php echo $schldetails['schlName'];?></a>
            <ul class="nav pull-right">
            <li class="active"><a href="admindashboard.php">Dashboard</a></li>
            <li><a href="#" data-target="#pinOrderForm" data-toggle="modal">Order Pin</a></li>
            <li><a href="signout.php">Signout</a></li>
            </ul>
       </div>
</div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2 ">
    <div class="border">
	<?php include("link-files/schoolsidebar.php");?>
    </div>
    <div class="row-fluid">
        <div class="span12">
        <!--google ads-->
        	<img src="img/google_ad.png">
        </div>
     </div>
    </div>
    <div class="span7 border">
    <?php include("link-files/pinorder.php");?>
    <?php include("link-files/createnewclass.php");?>
 <div><h1>How to use application</h1></div>

<div class="help">
<h3><a name="cbtprep"></a>CBT PREPARATION</h3>
Note that you are allowed to one free cbt on a newly created account, to create more than one cbt, attracts a charge which
is payable on any of our displayed bank account.
<br>
To prepare cbt question for your student,
<ol>
<li>click on the "conduct cbt" link on the main dashboard,</li>
<li>Then "add new test" button to prepare a new test, enter  the test properties and save the changes.</li>
<li>After sucessful creation of new test, it is time to add question to the test, this is done by clicking the add new button
   on the test property of your newly created test, to start adding question.</li>
<li>At the "add question" window, you can add two main type of question, which includes "illustration based question" and "non illustration based question"
to add any of them select them from the "question type" dropdown box then click on "add" button to load the "add new question" window.<br>
Follow the instruction to have a new question added to your new test.</li>
<li>Repeat the process in no 5 to add more question to your new test. </li>

<li>You can preview your new test by clicking the "preview" button on the add question window, and pre-examin the test before your student will use it.</li>
<li>click the "save test and exit" button to exit the add question window.</li>

</ol>
</div>

<div class="help">
<h3><a name="chngpg"></a>CHANGING YOUR PAGE SETTINGS</h3>
The settings page holds information that displays on the school page on ppseducation center, as well as the relivant setting needed to process data in your account.
<br>To change your page settings,
<ol>
<li>
Click on the "change account settings" link on the main dashboard to access the account setting page.</li>
<li>Change the content of "school details update" subheading to change the inittal content of the page.</li>
<li>Click on "save changes" button to have your new inputs reflect on the ppseducation center school page. </li>
</ol>
</div>

<div class="help">
<h3><a name="creatcls"></a>CREATING CLASS</h3>
Class creation allows user to entrer the students of the school in classes to ensure easy management by the school adminstrator. to do this,
<ol>
<li>Click on the "create class" link on the main dashboard to access the class registration window</li>
<li>Select the admission year of the student that will makeup the class, choose the subclass of the class, and the number of student that you currently wanyt to add to the class</li>
and click on "create class/add student(s) to class" button, to create and add student to the new class.
<li>Dependening on the number of students selected to add to the newly created class, enter the students information such as students name, date of birth, gender, passport parent name, phone number
 and address</li>
<li>Repeat step three for the remaining number of students</li>
<li>And click on "upload record" to save the students information to the class.</li>
<li>click on "exit registration " button to view the list of student registered to the class.</li>
</ol>
</div> 
<div class="help">
<h3><a name="prevsc"></a>PREVIEW SCHOOL PAGE</h3>
To preview the ppseducation center school page, click on "school page preview" link on the quick links below.
</div>

<div class="help">  
<h3><a name="placads"></a>PLACING ADS FOR YOUR SCHOOL</h3>
Schools can place adverts on their products and service, which will be shown to the visitors of ppseducation center website visitor,
by 
<ol>
<li>Clicking on the "advert" tab on the history subheading,</li>
<li>and "place order" button to load the advert order window.</li>
<li>Follow the instructions carefully to place the advert on ppseducation center.</li>
</ol>
</div>
 
<div class="help"> 
<h3><a name="chngsslinks"></a>CHANGING YOUR SCHOOL SOCIAL LINKS</h3>
The settings page holds information that displays on the school page on ppseducation center, as well as the relivant setting needed to process data in your account.
<br>To change your page settings,
<ol>
<li>Click on the "change account settings" link on the main dashboard to access the account setting page.</li>
<li>Change the settings at the "school social links" link subheading to add new link to your school socials. </li>
<li>Click on "save changes" button to have your new inputs reflect on the ppseducation center school page.
</li>
</ol>
</div>

<div class="help">
<h3><a name="addsr"></a>ADDING STUDENT RESULTS</h3>
This is one of the last phase involve in the process of computing students result on ppseducation center. it is the phase that follows after successful creation of classs,
adding of student to class, creating subject group, and allocating subject group to class.
<br>To add student result,
<ol>
<li>
Click on "add students result" link on main dashboard,</li>
<li>On the add result page, select the class id of the student, and select the current class and click the "continue" button, to have the list of subjects allocated to the current class,
displayed.</li>
<li>Click on the  subjects to have the score sheet of displayed for entry of of students score.</li>
<li>nter the score of the student in their respective provisions, and click on "update score sheet" button to have the scores updated.</li>
<li>Click on "preview score sheet" button to have a preview of the students score and their respective grade.</li>
<li>Repeat the process in step 4 on the remaining subjects, to mark the successful result update of the specified class id, in that particular class term.
<li>Repeat the process using different class id and current class term to have the class result updated.
</li>
</ol>
</div>

<div class="help">
<h3><a name="chngschgs"></a>CHANGING SCHOOL GRADING SYSTEM</h3>
The settings page holds information that displays on the school page on ppseducation center, as well as the relivant setting needed to process data in your account.<br>
To change your page settings,
<ol>
<li>Click on the "change account settings" link on the main dashboard to access the account setting page.</li>
<li>Change the content of "school  test grading system" dropdown to change the initial content of your school ppseducation account grading system.</li>
<li>lick on "save changes" button to have your new inputs reflect on the ppseducation center school page.
</li>
</ol>
</div>

<div class="help">
<h3><a name="previewrs"></a>PREVIEWING RESULT SHEETS</h3>
This is one of the last step in the last phase involve in the process of computing students result on ppseducation center. it is the phase that follows after successful creation of classs,
adding of student to class, creating subject group, and allocating subject group to class.
<br>To preview result sheet, 
<br>Click on "preview score sheet" button to have a preview of the students score and their respective grade in the selected subject.
</div>

<div class="help">
<h3><a name="accesspin"></a>PLACING ACCESS PIN ORDER</h3>
The access pin is used by students to check their result online and undertake other school task such as computer based test/asessment on ppseducation center, to order for access pin,
<ol>
<li>Click on the "order pin" link on the main dashboard,</li>
<li>Select the quanity you wish to order, and the mode in which you want access pin to be delivered to you.</li>
<li>Click on "place order" button to have your order placed</li>
<li>Follow the payment instruction to have the order confirmed and delivered to you.</li>
</ol>
</div>

<div class="help">
<h3><a name="allsubj"></a>ALLOCATE SUBJECT GROUP TO CLASS</h3>
The subject group houses the subject the student underatke at every level of their study.
to allocate subject group to the class terms,
<ol>
<li>Click on "allocate subject group to class" link</li>
<li>On the subject allocation page, assign the subject group to the class terms</li>
<li>Click the "save changes" button to save the change.
</li>
</ol>
</div>

<div class="row-fluid base-background">
<?php include("link-files/quick_link.php");?>
</div>
</div>
   <div class="span3 right-sidebar">
   <div class="breadcrumb">
   <a class="btn btn-large btn-info" href="#">View pin order history.</a>
   </div>
   <?php include("link-files/ads.php");?>
   <?php include("link-files/schoolsidesupportline.php");?>
   </div>
  </div>
    <!--other information may be here-->  
  </div>
      <div class="row-fluid baselinks social-background-bottom font">
        <?php include("link-files/page_base.php");?>
      </div>
</body>
</html>