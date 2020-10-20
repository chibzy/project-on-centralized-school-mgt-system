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
<title>Frequently Asked Question | Post primary school education center.</title>
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
            <li><a href="aboutus.php">About us</a></li>
            <li><a href="otherservices.php">Other Services</a></li>
            <li class="heading"><a href="faq.php">Faq</a></li>
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
    <!--div>
   <p> 1.	How can I use this website to promote my school?
<span>Answer</span>
</p>
<p>2.	How can I use this website to compute and publish my student result?
<span>Answer</span></p>
<p>3.	How can my student use the computer based assessment / test to improve their knowledge?
<span>Answer</span></p>
<p>4.	Who is a school administrator?
<span>Answer</span>
</p>
<p>5.	How do I buy access pin?
<span>Answer</span></p>
<p>6.	How can I publish my school information on post primary school education center?
<span>Answer</span>
</p>
    </div-->   
<div class="faqbody"> 
    <h1>Frequently Asked Questions</h1>
<ol>
<li><div class="Qset"><div onClick="showFaqAnswer('a1');" class="QsetQuestion">How can I use this website to promote my school?</div>
<div id="a1" class="QsetAnswer">You can use ppseducation center to promote your school in so many ways, such as publishing your school information on your ppseducation page, or even placing advert about your school  on ppseducation  center to have advert displayed on each of pages created in this platform and more.</div></div>
</li>
<li>
<div class="Qset">
<div class="QsetQuestion" onClick="showFaqAnswer('a2');">How can I use this website to compute and publish my student result?
</div>
<div class="QsetAnswer" id="a2">
Ppseducation center is an online platform design to assist schools like yours in processing and checking their students result online, as well as carrying out computer based test/assessment online. So if your school is in need of such services, of course I know will, the first thing to do is<br>
<ol>
<li> Register your school with a valid email address,</li>
<li> Activate your account with ppseducation center,</li>
<li> Then login to your account using the admin id and password provided on your activation mail to access the main system dashboard.</li>
<li> At the main system dashboard, you are  expected to publish your school page on ppseducation center,  clicking on the "publish school info" link.</li>
<li> At this point, fill in the necessary  information about your school, check the publish button, and save changes, in order to publish your school information on ppseducation center.</li>
<li> Having published your school page on ppseducation center, return to the dashboard and click on "create class" link to create a new class for your new students whom you want to compute their result, and register the students members of the class.</li>
<li> If the student class is already created and the student members of the class already registered, then, you are expected to "add students result" by clicking the link on the dashboard.</li>
<li> The result of the student in the class is a collection of the individual subject offered by the student during the academic year. These subject, are pre-registered and assigned to the classes so that they are loaded automatically when preparing student result. However, the subjects may not be there if their subject groups are not created and assigned to class. Therefore it is important that a subject group is created alongside its subjects and assigned  to the respective classes in the school to ensure adequate subjects are made available during result processing.</li>
<li> To create and allocate subject groups to classes, click on "view class list" on main dashboard, followed by "manage subject group" button to create a new subject. After successful creation of subject group, you can add/ remove subject to the subject group by clicking on the "add and remove subject(s) to group" tab, select the subject group of interest and click the "add and remove subject" button, to modify the content of the subject group.</li>
<li> It is at this point that the subject registered to this group  are used to populate result processing sheet when allotted/assigned  to a particular class.</li>
<li> After success completion of adding subjects to result group, the next thing that follows is adding of subjects to group, the next thing that follows, is the allocation of subject group to a particular class. This is done by clicking on the "allocate subject group(s)" link on the main dashboard.</li>
<li> The old or the new created subject group can be assigned on termly bases to academic classes in the school, and changes are made saved by clicking on "save change" button.</li> 
<li> In order to add students results, click the "add student result" link on the main dashboard to start adding scores to subjects undertaken by the student.</li>
<li> To add students scores, select the class id of interest, the current class/term of the student and click on the "continue" button to continue. From the populated class subject list, select each subject to add the student's scores on it.</li> 
<li> After successful adding of students score on a subject, changes made can be saved by clicking on the "update result sheet" button. After saving change, the result can be previewed by clicking on "preview result sheet" button. The previewed results are shown using the set system "grading system". Which can be changed by altering the "school test grading system"  on the account settings page.</li>
<li> The process in 15 can be repeated for all subjects.
<li> Having succeeded in entering student scores on each of the subjects, the next thing to do is ordering access pin. The access pin comprises of group of alphanumeric values, which the students must key in, to view their results online.</li> 
<li> To order for access pin, click "order pin" link on the navigation bar, select the quantity of card you want to order, the shipment method, and click on "order access pin" button, to place an order. Use the generated order id to make payment at any of the displayed bank account, and send its payment detail to the specified phone number, to have your order delivered with three working days. On delivery, the pin will used to access results online, or undertake computer based test.</li>
</ol>
</div>
</div>
</li>
<li>
<div class="Qset">
<div class="QsetQuestion" onClick="showFaqAnswer('a3');">How can my student use the computer based assessment / test to improve their knowledge?</div>
<div id="a3" class="QsetAnswer">
The computer based assessment/test is one of the services designed to allow school Information technology administrator / any computer literate person handling the school information on ppseducation center to customize computer based assessment in the school. When they prepare these tests, they are at liberty to raise their question, outline their options, suggest their answer and give reason why their answer is correct. This alone serves as a wonderful learning tool especially when the test is published in "practice test" mode, which allows the students to see the correct answer with reasons while carrying out their online test.  
</div>
</div>
</li>
<li>
<div>
<div class="Qset">
<div class="QsetQuestion" onClick="showFaqAnswer('a4');">Who is a school administrator?</div>
<div id="a4" class="QsetAnswer">The school administrator or the school Information technology administrator, refers to any person within or outside the school, who is knowledgeable in computer operation and usage, that is assigned the responsibility handling the school functions ppseducation center. This individual must be the authourised user of the system on ppseducation center.</div>
</div>
</li>
<li>
<div class="Qset">
<div class="QsetQuestion" onClick="showFaqAnswer('a5');">Can I change my school administrator?</div> 

<div class="QsetAnswer" id="a5">
Of course you can, to change your school administrator, reach out to the website administrator on support@ppseducation.com.ng, providing your reason for the requested change, an evidence of ownership in the form of email address and phone number used in registering your school the state and location of the school and at least the name of 2 student in each class whose name are already existing online on ppseducation center.
</div>
</div>
</li>
<li>
<div class="Qset">
<div class="QsetQuestion" onClick="showFaqAnswer('a6');">How do I buy access pin?</div>
<div class="QsetAnswer" id="a6">
To buy access pin, login to the main dashboard, and click "order pin" link on the navigation bar, select the quantity of card you want to order, the shipment method, and click on "order access pin" button, to place an order. Use the generated order id to make payment at any of the displayed bank account, and send its payment detail to the specified phone number, to have your order delivered with three working days.
</div>
</div>
</li>
<li>
<div class="Qset">
<div class="QsetQuestion" onClick="showFaqAnswer('a7');">Out of the two shipment methods which should I choose?</div>

<div id="a7" class="QsetAnswer">
The shipment method describes the two possible means and form in which you ordered pin can be delivered to you. Choosing shipment method option "send pin in finished form" implies that you want the access pins to be delivered to you in finished hardcopy form, and it attracts extra cost. While the shipment method option "send pin only" implies that you want the access pin to be delivered to your registered email address in softcopy for easy printing out, which does not attract extra cost.
</div>
</div>
</li> 
<li>
<div class="Qset">
<div class="QsetQuestion" onClick="showFaqAnswer('a8');">
How can I publish my school information on post primary school education center?</div>

<div id="a8" class="QsetAnswer">Every registered school on ppseducation center has a page on which it information are published, and through which her students can access their results and practice their computer based test/assessment.
To publish your school information, login to your account main dashboard, click on "change account settings" link, change the information on the account settings page as the need may be, check the publish button and "save changes" to have your school information published on your page.
</div>
</div>
</li>
<li>
<div class="Qset">
<div class="QsetQuestion" onClick="showFaqAnswer('a9');">
How do I access my school page?</div>

<div class="QsetAnswer" id="a9">
Once your school page is published, I become accessible. This you can access by typing the name of your school on the search box located at the right top most part of the home page.
 <br>*  it is therefore advised to select the name of your school as suggested by the "dropdown", to have your school page displayed without any human error.
</div>
</div>
</li>

<li>
<div class="Qset">
<div class="QsetQuestion" onClick="showFaqAnswer('a10');">I already have a website for my school but would like to enjoy the services on ppseducation center?</div>
<div class="QsetAnswer">
There is no cause for alarm as our developers have rightly figured it out. After successful registration and activation of your account on ppseducation center, login to your account main dashboard, click on "change account settings" link, copy the embedded script on the "link your page to your website" subheading and give to your website administrator to embed on your home page. This action will ensure that each time your students wants to access their result and carry out a computer base test through your website, a click on the link will redirect them to your page on ppseducation center with easy.
</div>
</div>
</li>
<li><div class="Qset">
<div class="QsetQuestion" onClick="showFaqAnswer('a11');">
I don't have a computer Laboratory in my school, can I use this website?</div>

<div id="a11" class="QsetAnswer">Yes you can. Ppseducation center is not hosted on local server that limits the location of the user, but on the internet which is accessible anywhere hence, <br>whatsoever you desire to teach your student through ppseducation center will get to them irrespective of their location and the absence of school computer laboratory. <br>It is worth noting that ppseducation center uses computer laboratory setup to reward their loyal customer, so absence of computer laboratory will be a thing of the pass if you keep using our services over a given period of time.
</div>
</div>
</li> 

<li><div class="Qset"><div class="QsetQuestion" onClick="showFaqAnswer('a12');">
Can I prepare my own computer based test?</div>

<div id="a12" class="QsetAnswer">At ppseducation center, our CBT has no pre-installed question and answer, like you see in most online CBT's, this means that you can tailor your questions to reflect what you want to teach your student.
</div>
</div>
</li>

<li><div class="Qset"><div class="QsetQuestion" onClick="showFaqAnswer('a13');">
Where can my student access their test and check their result?</div>

<div class="QsetAnswer" id="a13">
Your students can access any published result or computer based test on your ppseducation center, school page. Therefore ensure your school page is published for easy accessibility by your students or prospects.
</div>
</div>
</li>

<li><div class="Qset"><div class="QsetQuestion" onClick="showFaqAnswer('a14');"> 
How can I place advert about my school or product?</div>

<div class="QsetAnswer" id="a14">
<ol>
You can place your advert on ppseducation center as a registered account holder or as an external user. 
<li>
To place an advert as an account holder, login to your account, </li>
<li>at the main dashboard, select the advert tab at the "history" subheading located right of the screen,</li> 
<li>click on the "order ads" button to load the place advert window.</li>
<li>At the "place advert" window, Enter the title of the advert, select the dimension of the advert and the period of time the advert is to run on the platform and click on place order to have the order submitted.</li>
<li>Then upload the advert image to have it activated on payment. </li>
<!--While to place an advert as an external user, the user pays a specific amount depending on the target period of adverts and emails the payment details, advert image and title of the advert to info@ppseducation.coom.ng, to have the adverts activated.-->
</ol>
</div>
</div>
</li>
</ol>
</div>

    
    </div>
    <div class="span3">
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