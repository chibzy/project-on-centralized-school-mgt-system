// JavaScript Document
function submitRegForm(){
	var adminName=document.getElementById("adminName").value;
	var email=document.getElementById("email").value;
	var gender=document.getElementById("gender").value;
	var phone=document.getElementById("phone").value;
	var schoolName=document.getElementById("schoolName").value;
	var state=document.getElementById("state").value;
	var location=document.getElementById("location").value;
	
	var bals=new Ajax.Updater('msg','connect/index_ajax.php?name='+adminName+'&email='+email+'&gender='+gender+'&phone='+phone+'&schoolName='+schoolName+'&state='+state+'&location='+location+'&fxn=regForm', {method:'post',parameters:''});
	
	//empty the fields
	document.getElementById("adminName").value='';
	document.getElementById("email").value='';
	document.getElementById("gender").value='';
	document.getElementById("phone").value='';
	document.getElementById("schoolName").value='';	
	document.getElementById("state").value='';
	document.getElementById("location").value='';	
}
function loadlocation(){
	var state=document.getElementById('state').value;
	if(state!=''){
	var bals=new Ajax.Updater('location','connect/index_ajax.php?fxn=loadlocation&state='+state, {method:'post',parameters:''});
	}
}
function suggest(id,suggestion){
	var word=document.getElementById(id).value;
	//alert(word);
  new Ajax.Autocompleter(id,suggestion,'connect/searchscript_ajax.php?fxn=searchForm&word='+word);
 
}
function calculateCardCost(){
	var qty=document.getElementById("qty").value;
	var orderid=document.getElementById("orderid").value;
	var shippmentMethod=document.getElementById("method").value;
	if(shippmentMethod!=''){
		if(qty!=''){
			var bals=new Ajax.Updater('result','connect/dash_ajax.php?qty='+qty+'&orderid='+orderid+'&method='+shippmentMethod+'&fxn=cardCostForm', {method:'post',parameters:''});
		}
	}
}
function printStudentDetails(studID){
	//window.open('link-files/printstudentdetails.php?id='+studID,'','','');
	messageWindow('Student Details','', 'link-files/printstudentdetails.php?id='+studID);
}
function placeOrder(){
	var qty=document.getElementById("qty").value;
	var shippmentMethod=document.getElementById("method").value;
	var cardcost=document.getElementById('cardcost').innerHTML;
	var shippmentcost=document.getElementById('shippmentcost').innerHTML;
	var totalcost=document.getElementById('totalcost').innerHTML;
	var orderid=document.getElementById('orderid').value;
	
	if(shippmentMethod!=''){
		if(qty!=''){
			var bals=new Ajax.Updater('msgAlert','connect/dash_ajax.php?qty='+qty+'&method='+shippmentMethod+'&card='+cardcost+'&shippment='+shippmentcost+'&total='+totalcost+'&order='+orderid+'&fxn=placeOrderForm', {method:'post',parameters:''});
		}
	}
}
function demoteStudent(studID,schlid,subclass,clsid){
	//if(confirm('You are about to demote the selected student(s), do you wish to continue?')==true){
		var bals=new Ajax.Updater('msg','connect/dash_ajax.php?studID='+studID+'&schlid='+schlid+'&subclass='+subclass+'&clsid='+clsid+'&fxn=demoteStud', {method:'post',parameters:''});
	//}
	
}
function removeStudent(studID,schlid,subclass,clsid){
	//if(confirm('You are about to remove the selected student(s), this will erase the entire record of the students, do you wish to continue?')==true){
		var bals=new Ajax.Updater('msg','connect/dash_ajax.php?studID='+studID+'&schlid='+schlid+'&subclass='+subclass+'&clsid='+clsid+'&fxn=removeStud', {method:'post',parameters:''});
	//}
	
}
function promoteStudent(studID,schlid,subclass,clsid){
	//if(confirm('You are about to promote the selected student(s), do you wish to continue?')==true){
		var bals=new Ajax.Updater('msg','connect/dash_ajax.php?studID='+studID+'&schlid='+schlid+'&subclass='+subclass+'&clsid='+clsid+'&fxn=promoteStud', {method:'post',parameters:''});
	//}
	
}
function allSelected(type){
	var totalCheck=document.getElementById('total').value;
	var schlid=document.getElementById('schlid').value;
	var subclass=document.getElementById('subclass').value;
	var clsid=document.getElementById('clsid').value;
	var i;
	
	if(type=='promote'){
		if(confirm('You are about to promote the selected student(s), do you wish to continue?')==true){
			for(i=1;i<=totalCheck;i++){
				
				if(document.getElementById('chk'+i).checked==true){
					
					var studID=document.getElementById('sel'+i).value;
					
						promoteStudent(studID,schlid,subclass,clsid);
				}
			}
		}
	}else if(type=='demote'){
		if(confirm('You are about to demote the selected student(s), do you wish to continue?')==true){
			for(i=1;i<=totalCheck;i++){
				
				if(document.getElementById('chk'+i).checked==true){
					
					var studID=document.getElementById('sel'+i).value;
					
						demoteStudent(studID,schlid,subclass,clsid);
				}
			}
		}
	}else if(type=='remove'){
		if(confirm('You are about to remove the selected student(s), this will erase the entire record of the students, do you wish to continue?')==true){
			for(i=1;i<=totalCheck;i++){
				
				if(document.getElementById('chk'+i).checked==true){
					
					var studID=document.getElementById('sel'+i).value;
					
						removeStudent(studID,schlid,subclass,clsid);
				}
			}
		}
	}
}
function intAlert(id){
	var val;
	val=window.document.getElementById(id).value;
	//alert("Enter numbers.");
	if(isNaN(val)){
		alert("Enter numbers.");
		window.document.getElementById(id).value="";
	}
}
//function CreateClass(id,class,subclass){
function CreateClass(id){
	var val;
	var sClass;
	var sSubclass;
	
	val=window.document.getElementById(id).value;
	sClass=window.document.getElementById('studClass').value;
	sSubclass=window.document.getElementById('studsubClass').value;
	
	//alert("Enter numbers.");
	if(window.document.getElementById(id).value==""){
		alert("Number of student field can't be empty.");
	}else{
		window.location.href="savenewclass.php?class="+sClass+'&studsubClass='+sSubclass+'&studPop='+val+'&action=create';
	}
}
/*function EditClass(){
	var sClass;
	var sSubclass;
	
	sClass=window.document.getElementById('studClass').value;
	sSubclass=window.document.getElementById('studsubClass').value;
	if(sSubclass=='None') sSubclass='';
	if(confirm('Do you wish to add new student to '+sClass+sSubclass+' class?')==true){
		window.location.href="savenewclass.php?class="+sClass+'&studsubClass='+sSubclass+'&action=edit';
	}
	
}*/
function loadImg(i){
	var stud, dob, gender, parentn, parentp, address;
	 
	stud=window.document.getElementById('stud'+i).value;
	dob=window.document.getElementById('dob'+i).value;
	gender=window.document.getElementById('gender'+i).value;
	parentn=window.document.getElementById('parentn'+i).value;
	parentp=window.document.getElementById('parentp'+i).value;
	address=window.document.getElementById('address'+i).value;
	
	//alert("file path "+stud);
	var bals=new Ajax.Updater('preview'+i,'connect/dash_ajax.php?stud='+stud+'&dob='+dob+'&gender='+gender+'&parentn='+parentn+'&parentp='+parentp+'&address='+address+'&fxn=preview', {method:'post',parameters:''});
}

function createNewGroup(){
	var id=window.document.getElementById('groupID').value;
	var name=window.document.getElementById('groupName').value;
	
	if(id=='' && name==''){
		alert("Enter a valid group name or id");
	}else{
		var bals=new Ajax.Updater('subjectMsg','connect/dash_ajax.php?id='+id+'&name='+name+'&fxn=creategroup', {method:'post',parameters:''});
		loadsubjectG('groups');
		loadsubjectG('groupID2');
	}
}
function loadsubjectG(id){
		var bals=new Ajax.Updater(id,'connect/dash_ajax.php?fxn=loadsubjectgroup', {method:'post',parameters:''});
}
function addSubject(){
	
	//var name=window.document.getElementById('groupName').value;
	var id=window.document.getElementById('groupID2').value;
	
	//if(name=='' && id=='') {
	if(id=='') {
		alert("Enter a valid group name or id");
	}else{ 
		if(confirm('Do you wish to change the content of group '+name)==true){
			window.location.href="managesubject.php?id="+id+'&action=addsubject';
//			window.location.href="managesubject.php?id="+id+'&name='+name+'&action=addsubject';
		
		}
	}
	
}
function loadAllSubjects(){
	
}
function addSubjectToList(source,i){
	var pract;
	var sele;
	
	var groupid=window.document.getElementById('id').value;
	var k=window.document.getElementById(source).value;
	if(window.document.getElementById('pract'+i).checked==false){
		pract='no';
	}else{
		pract='yes';
	}
	if(window.document.getElementById('sele'+i).checked==false){
		sele='no';
	}else{
		sele='yes';
	}
	var bals=new Ajax.Updater('subjectlist','connect/dash_ajax.php?k='+k+'&pract='+pract+'&sele='+sele+'&groupid='+groupid+'&fxn=addto', {method:'post',parameters:''});
}
function loadavailablesubjects(id){
	//alert('the value of id is '+id);
	if(id!=''){
		var bals=new Ajax.Updater('subjectlist','connect/dash_ajax.php?groupid='+id+'&fxn=loadavailablesubjects', {method:'post',parameters:''});
	}
}
function resetOthers(){
	if(window.document.getElementById('sele').checked==true) window.document.getElementById('sele').checked=false;
	if(window.document.getElementById('pract').checked==true) window.document.getElementById('pract').checked=false;
}
function removeSubject(subjectName,groupID){
	
		var bals=new Ajax.Updater('subjectlist','connect/dash_ajax.php?subjectname='+subjectName+'&groupid='+groupID+'&fxn=removeSubject', {method:'post',parameters:''});
	
}
function removesubjectOk(){
	var i=window.document.getElementById('total').value;
	i--;
	if(i>=1){
		var ans=confirm('Are you sure you want to remove the selected subjects?');
		if(ans==true){
			while(i>=1){
				if(window.document.getElementById('sub'+i).checked==true){
					
					subjectname=window.document.getElementById('sub'+i).value;
					groupID=window.document.getElementById('id').value;
					removeSubject(subjectname,groupID);
					
				}
				i--;
			}
		}
	}
}
function removeGroup(groups){
	var grp;
	if(window.document.getElementById(groups).value!='Select subject group name'){
		if(confirm("Removing this subject group removes it subjects as well, do you wish to continue?")==true){
			grp=window.document.getElementById(groups).value;
			var bals=new Ajax.Updater(groups,'connect/dash_ajax.php?grp='+grp+'&fxn=removeGroup', {method:'post',parameters:''});
			loadsubjectG('groups');// reloads the other dropdowns
			loadsubjectG('groupID2');
		}
	}
}
function removeOrderPin(group){
	if(group!=''){
		if(confirm("Removing pin order #"+group+", do you wish to continue?")==true){
		var bals=new Ajax.Updater(orderlist,'connect/dash_ajax.php?id='+group+'&fxn=removeOrderPin', {method:'post',parameters:''});
		}
	}
}
function removeOrderedAds(group){
	if(group!=''){
		if(confirm("Removing advert order #"+group+", do you wish to continue?")==true){
		var bals=new Ajax.Updater(adslist,'connect/dash_ajax.php?id='+group+'&fxn=removeOrderedAds', {method:'post',parameters:''});
		}
	}
}
function removeOrderedcbt(group){
	if(group!=''){
		if(confirm("Removing cbt order #"+group+", do you wish to continue?")==true){
		var bals=new Ajax.Updater(cbtlist,'connect/dash_ajax.php?id='+group+'&fxn=removeOrderedcbt', {method:'post',parameters:''});
		}
	}
}
function placeAdsOrder(){
	var title=window.document.getElementById('adsTitle').value;
	var dimension=window.document.getElementById('dimension').value;
	var period=window.document.getElementById('validPeriod').value;
	var orderid=window.document.getElementById('adorderid').value;
		
	if(title!='' && dimension!='Select Dimension'){
		var bals=new Ajax.Updater(adform,'connect/dash_ajax.php?fxn=placeAds&title='+title+'&dimension='+dimension+'&period='+period+'&orderid='+orderid, {method:'post',parameters:''});
	}else{
		alert('Title or dimension is empty.');	
	}
}
function loadAdsImg(orderid){
	if(orderid!=''){
		//alert("Entered "+orderid);
		var bals=new Ajax.Updater(previewedImg,'connect/dash_ajax.php?fxn=previewAds&orderid='+orderid, {method:'post',parameters:''});
	}
}
function adminloadAdsImg(orderid){
	if(orderid!=''){
		//alert("Entered "+orderid);
		var bals=new Ajax.Updater(previewedImg,'../connect/dash_ajax.php?fxn=adminpreviewAds&orderid='+orderid, {method:'post',parameters:''});
	}
}
function loadAllHistory(){
	loadpinHistory();
	loadadsHistory();
	loadcbtHistory();
	//remember to include cbt
}
function loadpinHistory(){
	var bals=new Ajax.PeriodicalUpdater(orderlist,'connect/dash_ajax.php?fxn=loadpinHistory', {method:'post', frequency:10.0,delay:2});
}
function loadadsHistory(){
	var bals=new Ajax.PeriodicalUpdater(adslist,'connect/dash_ajax.php?fxn=loadadHistory', {method:'post',frequency:10.0,delay:2});
}
function loadcbtHistory(){
	var bals=new Ajax.PeriodicalUpdater(cbtlist,'connect/dash_ajax.php?fxn=loadcbtHistory', {method:'post',frequency:10.0,delay:2});
}
function resetpsw(emailaddr){
	if(window.document.getElementById(emailaddr).value!=''){
		var email=window.document.getElementById(emailaddr).value;
		
		//window.document.getElementById('pswResetAlert').innerHTML=' hey ';
		
		var bals=new Ajax.Updater('pswResetAlert','connect/dash_ajax.php?email='+email+'&fxn=resetpsw', {method:'post',parameters:''});
	}
}
function loadStudentsSubject(subjectName,pract){
	var bals=new Ajax.Updater('entrySheet','connect/dash_ajax.php?name='+subjectName+'&pract='+pract+'&fxn=listClassStudents', {method:'post',parameters:''});
}

function subjectList(){
	//var sclass=window.document.getElementById('subjectGroup').value;
	var cls=window.document.getElementById('curclass').value;
	var adyr=window.document.getElementById('classid').value;
	
	var all=cls.split('|');
	//var sclass=parseInt(all[1]);
	var sclass=all[1];
	//alert(sclass+' the selected subject group id');
	if(adyr!='-Select class id-'){
	var bals=new Ajax.Updater('sub','connect/dash_ajax.php?subjectGroup='+sclass+'&fxn=listClassSubjects', {method:'post',parameters:''});
	}
}
function loadStudentsSubject(subjectName,pract,id){
	var classid=window.document.getElementById('classid').value;
	var curclass=window.document.getElementById('curclass').value;//yet to understand the relivance of this curclass
	//alert(subjectName+' - '+pract+' - '+id+' - '+classid+' - '+curclass);
	if(classid!='-Select class id-' && curclass!='-Select current class-'){
	var bals=new Ajax.Updater('sheet','connect/dash_ajax.php?class='+classid+'&curclass='+curclass+'&subjectname='+subjectName+'&pract='+pract+'&id='+id+'&fxn=displayScoreSheet', {method:'post',parameters:''});
	}
}
function updateResultSheet(isPract){
	var total=window.document.getElementById('total').value;
	var tscores='';
	var practscores='';
	var examscores='';
	var classid='';
	var name='';
	var id='';
	var term='';
	var session='';
	var subject='';
	var i='';
	
	term=document.getElementById('term').value;
	session=document.getElementById('session').value;
	subject=document.getElementById('subject').value;
	classid=document.getElementById('class').value;
	//alert(total);
	for(i=1;i<total;i++){	
		name=name+document.getElementById('name'+i).value+'|';
		id=id+document.getElementById('id'+i).value+'|';
		
		tscores=tscores+document.getElementById('test'+i).value+'|';
		examscores=examscores+document.getElementById('exam'+i).value+'|';

		if(isPract==true){
			practscores=practscores+document.getElementById('pract'+i).value+'|';
		}
	}
	
	var val=confirm("Do you want to update these records");
	
	if(val==true){
		var bals=new Ajax.Updater('sheet','connect/dash_ajax.php?class='+classid+'&name='+name+'&id='+id+'&session='+session+'&term='+term+'&subject_name='+subject+'&tscores='+tscores+'&practscores='+practscores+'&examscores='+examscores+'&fxn=updateSheet', {method:'post',parameters:''});
	}
}
function messageWindow(title, msg, url){

  var width="1000", height="800";

  var left = (screen.width/2) - width/2;

  var top = (screen.height/2) - height/2;

  var styleStr = 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,copyhistory=yes,width='+width+',height='+height+',left='+left+',top='+top+',screenX='+left+',screenY='+top;

  var msgWindow = window.open(url,"msgWindow", styleStr);
}
function AdminRemoveAdsOrder(pg){
	var no_of_item=document.getElementById('total').value;
	var starting_point=document.getElementById('start').value;
	var i;
	var no=0;
	var item_id="";
	starting_point++;
	//for(i=1;i<=no_of_item;i++){
		//alert("values : "+starting_point+" "+no_of_item);
		var limit=starting_point+parseInt(no_of_item);
	//verify the number of available check box before testing if they are true.
	var adform=document.adslistform;
	for(var j=0;j<adform.elements.length; j++){
		if(adform.elements[j].type=="checkbox"){
			no++;
		}
	}
	if(no<parseInt(no_of_item)) limit=starting_point+no;
	for(i=starting_point;i<limit;i++){
		//alert(i);
		
		if(document.getElementById('item'+i).checked==true){
			item_id=item_id+document.getElementById('item'+i).value+'|';
		}
	}
	
	var val=confirm("Do you really want to remove selected order no(s) ("+item_id+")");
	
	if(val==true && item_id!=''){
		//alert('scripts/dash_ajax.php?id='+item_id+'&fxn=removeOrderedPins');
		var bals=new Ajax.Updater('orderedAds','scripts/dash_ajax.php?id='+item_id+'&fxn=AdminremoveOrderedads&pg='+pg+'&start='+starting_point+'&limit='+no_of_item, {method:'post',parameters:''});
	}
}
function adminChangeAdsPubStatus(pg){
	var no_of_item=document.getElementById('total').value;
	var starting_point=document.getElementById('start').value;
	var i;
	var no=0;
	var item_id="";
	starting_point++;
	//for(i=1;i<=no_of_item;i++){
		//alert("values : "+starting_point+" "+no_of_item);
		var limit=starting_point+parseInt(no_of_item);
	//verify the number of available check box before testing if they are true.
	var adform=document.adslistform;
	for(var j=0;j<adform.elements.length; j++){
		if(adform.elements[j].type=="checkbox"){
			no++;
		}
	}
	if(no<parseInt(no_of_item)) limit=starting_point+no;
	for(i=starting_point;i<limit;i++){
		//alert(i);
		
		if(document.getElementById('item'+i).checked==true){
			item_id=item_id+document.getElementById('item'+i).value+'|';
		}
	}
	
	var val=confirm("Do you really want to change the status of the selected order no(s) ("+item_id+")");
	
	if(val==true && item_id!=''){
		//alert('scripts/dash_ajax.php?id='+item_id+'&fxn=removeOrderedPins');
		var bals=new Ajax.Updater('orderedAds','scripts/dash_ajax.php?id='+item_id+'&fxn=AdminChangeAdsPubStatus&pg='+pg+'&start='+starting_point+'&limit='+no_of_item, {method:'post',parameters:''});
	}
}
function removePinOrder(){
	var no_of_item=document.getElementById('total').value;
	var i;
	var item_id="";
	for(i=1;i<=no_of_item;i++){
		
		if(document.getElementById('order'+i).checked==true){
			item_id=item_id+document.getElementById('order'+i).value+'|';
		}
	}
	
	var val=confirm("Do you really want to remove selected order no(s)");
	
	if(val==true){
		//alert('scripts/dash_ajax.php?id='+item_id+'&fxn=removeOrderedPins');
		var bals=new Ajax.Updater('orderedPins','scripts/dash_ajax.php?id='+item_id+'&fxn=removeOrderedPins', {method:'post',parameters:''});
	}
}
function changePinOrder(){
	var no_of_item=document.getElementById('total').value;
	var i;
	var item_id="";
	for(i=1;i<=no_of_item;i++){
		
		if(document.getElementById('order'+i).checked==true){
			item_id=item_id+document.getElementById('order'+i).value+'|';
		}
	}
	
	var val=confirm("Do you really want to change the status of these selected order(s) : "+item_id);
	
	if(val==true){
		//alert('scripts/dash_ajax.php?id='+item_id+'&fxn=removeOrderedPins');
		var bals=new Ajax.Updater('orderedPins','scripts/dash_ajax.php?id='+item_id+'&fxn=changeOrderedPinsStatus', {method:'post',parameters:''});
	}
	
}
function changePinSetStatus(){
	var no_of_item=document.getElementById('total').value;
	var i;
	var item_id="";
	for(i=1;i<=no_of_item;i++){
		
		if(document.getElementById('batch'+i).checked==true){
			item_id=item_id+document.getElementById('batch'+i).value+'|';
		}
	}
	
	var val=confirm("Do you really want to change the status of these selected pinset(s) : "+item_id);
	
	if(val==true){
		//alert('scripts/dash_ajax.php?id='+item_id+'&fxn=removeOrderedPins');
		var bals=new Ajax.Updater('pinSet','scripts/dash_ajax.php?id='+item_id+'&fxn=changePinSetStatus', {method:'post',parameters:''});
	}
	
}
function removePinSet(){
	var no_of_item=document.getElementById('total').value;
	var i;
	var item_id="";
	for(i=1;i<=no_of_item;i++){
		
		if(document.getElementById('batch'+i).checked==true){
			item_id=item_id+document.getElementById('batch'+i).value+'|';
		}
	}
	
	var val=confirm("Do you really want to remove the selected pinset(s) : "+item_id);
	
	if(val==true){
		//alert('scripts/dash_ajax.php?id='+item_id+'&fxn=removeOrderedPins');
		var bals=new Ajax.Updater('pinSet','scripts/dash_ajax.php?id='+item_id+'&fxn=removePinSet', {method:'post',parameters:''});
	}
	
}
function loadOrderedPins(){
	var bals=new Ajax.Updater('orderedPins','scripts/dash_ajax.php?fxn=loadOrderedPins', {method:'post',parameters:''});
}
function loadPinSet(){
	//alert('hey');
	var bals=new Ajax.Updater('pinSet','scripts/dash_ajax.php?fxn=loadPinSet', {method:'post',parameters:''});
}
function loadDetailedPin(i){
	var batchno;
	batchno=window.document.getElementById('batch'+i).value;
	//alert(batchno+' '+' we ');
	var bals=new Ajax.Updater('pinList','scripts/dash_ajax.php?fxn=loadDetailedPin&batchno='+batchno, {method:'post',parameters:''});
}
function printPinsForMgt(){
	var id=window.document.getElementById('batch').value;
	window.open('pinsformgt.php?id='+id,'','','');
}
function printPinForsale(){
	var id=window.document.getElementById('batch').value;
	window.open('pinsforsale.php?id='+id,'','','');
}
function loadCardUsageHistory(schlid){
	
	if(schlid!=''){
	var bals=new Ajax.Updater('usageHistory','scripts/dash_ajax.php?fxn=loadCardUsageHistory&schlid='+schlid, {method:'post',parameters:''});
	}
}
function deleteSelAcc(){
	var no_of_item=parseInt(document.getElementById('total').value);
	var start=parseInt(document.getElementById('start').value);
	var limit=(start+no_of_item);
	var i;
	var item_id="";
	for(i=start+1;i<=limit;i++){
		if(document.getElementById('item'+i).checked==true){
			item_id=item_id+document.getElementById('item'+i).value+'|';
		}
	}
	
	var val=confirm("Account removal entails deleting the records of the school; students, results, subject group, school information, and accounts. It is currently not implemented for the selected items such as : "+item_id);
	
	if(val==true){
		//var bals=new Ajax.Request('scripts/dash_ajax.php?fxn=deleteSelAcc&id='+item_id, {method:'post',parameters:''});
	}	
}
function updateAccStatus(){
	
	var no_of_item=parseInt(document.getElementById('total').value);
	var start=parseInt(document.getElementById('start').value);
	var limit=(start+no_of_item);
	var i;
	var item_id="";
	for(i=start+1;i<=limit;i++){
		if(document.getElementById('item'+i).checked==true){
			item_id=item_id+document.getElementById('item'+i).value+'|';
		}
	}
	
	var val=confirm("Are sure you want to change the status of the selected account(s) : "+item_id);
	
	if(val==true){
		//alert("Account successfully changed!");
		var bals=new Ajax.Request('scripts/dash_ajax.php?fxn=updateAccStatus&id='+item_id, {method:'post',parameters:''});
	}
	
}
function chk(id){
	alert(document.getElementById(id).name+" is checked");
}
//__________________________________________________
function removeUser(){
	var no_of_item=document.getElementById('itemno').value;
	var i;
	var item_id="";
	for(i=1;i<=no_of_item;i++){
		
		if(document.getElementById('check'+i).checked==true){
			item_id=item_id+document.getElementById('id'+i).value+'|';
		}
	}
	
	var val=confirm("Do you really want to remove selected items?");
	
	if(val==true){
		var bals=new Ajax.Updater('table','styles/file.php?id='+item_id+'&fxn=deleteUser', {method:'',parameters:''});
	}
}

function removeFolder(){
	var no_of_item=document.getElementById('itemno').value;
	var i;
	var item_id="";
	for(i=1;i<=no_of_item;i++){
		
		if(document.getElementById('chk'+i).checked==true){
			item_id=item_id+document.getElementById('n'+i).value+'|';
		}
	}
	
	var val=confirm("Do you really want to remove selected item");
	
	if(val==true){
		var bals=new Ajax.Updater('table','styles/file.php?id='+item_id+'&fxn=deleteFolder', {method:'',parameters:''});
	}
}
function removeDoc(){
	var no_of_item=document.getElementById('itemno').value;
	var i;
	var item_id="";
	for(i=1;i<=no_of_item;i++){
		
		if(document.getElementById('chk'+i).checked==true){
			item_id=item_id+document.getElementById('n'+i).value+'|';
		}
	}
	
	var val=confirm("Do you really want to remove selected document"+item_id);
	
	if(val==true){
		var bals=new Ajax.Updater('table','styles/file.php?id='+item_id+'&fxn=deleteDoc', {method:'',parameters:''});
	}
}
function loadStudenttestresult(schlid,studid,testid){
	//alert('what?');
	if(schlid!='' && studid!='' && testid!=''){
		var bals=new Ajax.Updater('cbtresult','connect/index_ajax.php?studid='+studid+'&schlid='+schlid+'&testid='+testid+'&fxn=validateTestAccess', {method:'',parameters:''});
	}
}
function cbtValidateStudent(schlid){
	var studID=document.getElementById('studid').value;
	var curclass=document.getElementById('curclass').value;
	var curterm=document.getElementById('curterm').value;
	var pin=document.getElementById('pin').value;
	
	if(document.getElementById('stud').checked==true){	
		if(studID!='' && pin!=''){
			var bals=new Ajax.Updater('cbtIntro','connect/index_ajax.php?studid='+studID+'&schlid='+schlid+'&curclass='+curclass+'&curterm='+curterm+'&pin='+pin+'&fxn=validateStudent1', {method:'',parameters:''});
		}else{
			alert('Enter student ID or pin');	
		}
	}else{
		if(studID!='' && pin!=''){
			var bals=new Ajax.Updater('cbtIntro','connect/index_ajax.php?studid='+studID+'&schlid='+schlid+'&pin='+pin+'&fxn=validateStudent2', {method:'',parameters:''});
		}else{
			alert('Enter prospect id or pin');
		}
	}
}
function validateTestAccess(no){
	
	var urldata=document.getElementById('url'+no).value;
	
	//alert('ok '+urldata);
	
	if(urldata!=''){
		messageWindow('Computer base test','Test on #general knowledge',urldata);
	}
}
/*function validateTestAccess(schlid,studid,testid){
	messageWindow('Computer base test','Test on #general knowledge','test.php?schlid='+schlid+'&studid='+studid+'&testid='+testid);
}*/
function finishtest(){
	var bals=new Ajax.Updater('test','connect/index_ajax.php?fxn=finishTest', {method:'',parameters:''});
}
function applycode(){
	var cbtid=document.getElementById('testid').value;
	var cbtcode=document.getElementById('code').value;
	
	if(cbtcode!=''){
		var bals=new Ajax.Updater('alert','connect/dash_ajax.php?fxn=applycode&code='+cbtcode+'&testid='+cbtid, {method:'',parameters:''});
	}
}
function reActivate(testid){
	var bals=new Ajax.Updater('testproperty','connect/dash_ajax.php?fxn=reActivateTest&testid='+testid, {method:'',parameters:''});
}
function prepareCBT(){
	
	var bals=new Ajax.Updater('newTestDisplay','connect/dash_ajax.php?fxn=newTestDisplay', {method:'',parameters:''});
}
function preparePremuimCBT(code){
	//alert('what?');
	var cbtcode=document.getElementById(code).value;
	if(cbtcode!=''){
		var bals=new Ajax.Updater('newTestDisplay','connect/dash_ajax.php?fxn=newPremuimTestDisplay&code='+cbtcode, {method:'',parameters:''});
	}
}
function loadTestProperties(testid){
	
	if(testid!=''){
		var bals=new Ajax.Updater('testproperty','connect/dash_ajax.php?fxn=loadtestproperty&id='+testid, {method:'',parameters:''});
	}
}
function adminAddQ(type,testid){
	if(type=='viewQ' && testid!=0){
		messageWindow('List of questions in the test', 'List of questions', 'link-files/questionlist.php?id='+testid);
	}
	if(type=='viewR' && testid!=0){
		messageWindow('List of student score in the test', 'List of score', 'link-files/scores.php?id='+testid);
	}
}
function loadQform(){
var qType=window.document.getElementById('newQType').value;
var testid=window.document.getElementById('testid').value;

var bals=new Ajax.Updater('MAQ','../connect/dash_ajax.php?fxn=loadNewTestForm&type='+qType+'&testid='+testid, {method:'',parameters:''});

}
function parseOptionValues(fieldName){
	//first extract the content of field,
	//break the into options
	//break the resultant options into option id n text
	var field=window.document.getElementById(fieldName).value;
	var report='';
	var j=0;
	var option=new Array();
	var content=new Array();
	
	//alert("option entry field is empty"+field+' | '+fieldName);
	if(field!=''){
		var option=field.split(';');
		if(option.length>1){
			//alert(option.length);
				
				for(var i=0;i<option.length;i++){
					j=i+1;
					if(option[i]!=''){
						
						var content=option[i].split('.');
						
						if(content.length!=2){
							report=report+' there is/are error(s) in the pattern of option '+j+',';
							
						}
					}else{
						report=report+'empty option in '+j+',';	
					}
						
				}
		}else{
			report="Enter a minimum of two options";	
		}
	}else{
		report="option entry field is empty";
	}
	if(report!=''){
		alert(report);
		window.document.getElementById(fieldName).focus();
		window.document.getElementById(fieldName).select();
		
	}
}
function parseAnwserValues(fieldName){

	//first extract the content of field,
	//break the into options
	//break the resultant options into option id n text
	var field=window.document.getElementById(fieldName).value;
	var report='';
	var j=0;
	var answer=new Array();
	
	if(field!=''){
		var answer=field.split(';');
				
				for(var i=0;i<answer.length;i++){
					j=i+1;
					if(answer[i].length==1){
						
					}else{
						report=report+'Answer '+j+', is not prooperly written';	
					}
						
				}
	}else{
		report="option entry field is empty";
	}
	if(report!=''){
		alert(report);
		window.document.getElementById(fieldName).focus();
		window.document.getElementById(fieldName).select();
	}
	
}
/*function illustrationSelection(typeofquestion){
	
	var val=window.document.getElementById(typeofquestion).value;
	var ill=window.document.getElementById('illustration');
	
	switch(val){
		case 'Multiple Answer': ill.disabled=true;
		break;
		case 'Single Answer': ill.disabled=true;
		break;
		case 'Multiple Answer with Illustration': ill.disabled=false;
		break;
		case'Single Answer with Illustration':ill.disabled=false;
		break;
	}
}*/
//************************Question editing function **************
function loadQEditForm(val){

var newVal=val.split('|');
var qid=newVal[0];
var div=newVal[1];
var testid=newVal[2];
var qType=newVal[3].toString();

var bals=new Ajax.Updater(div,'../connect/dash_ajax.php?fxn=loadQEditForm&type='+qType+'&testid='+testid+'&qid='+qid, {method:'',parameters:''});

}
function removeTestQuestion(testID,schlid){
	//if(confirm('You are about to remove the selected student(s), this will erase the entire record of the students, do you wish to continue?')==true){
		var total=window.document.getElementById('total').value;
		var allQid='';
		var testRem=false;
		
		for(var i=0;i<total;i++){
			if(window.document.getElementById('item'+i).checked==true){
				if(i!=(total-1)){
					allQid=allQid+window.document.getElementById('id'+i).value+':';
				}else{
					allQid=allQid+window.document.getElementById('id'+i).value;
				}
				testRem=true;
			}
		}
		if(testRem==true){
			var rep=confirm("you are about to remove some question from this test, do you wish to continue?");
			//alert(allQid+' - '+testID+' - '+schlid);
			if(rep==true){
			var bals=new Ajax.Updater('questionList','../connect/dash_ajax.php?Qid='+allQid+'&schlid='+schlid+'&testid='+testID+'&fxn=removeQuestion', {method:'post',parameters:''});
		
			}
		}
	
}
function loadTest(testid,schlid,path){
	
	var bals=new Ajax.Updater('test',path+'connect/dash_ajax.php?fxn=loadTest&testid='+testid+'&schlid='+schlid, {method:'',parameters:''});
}
function loadtime(path){
	var bals=new Ajax.PeriodicalUpdater('timer',path+'connect/dash_ajax.php?fxn=loadtime', {method:'post', frequency:60.0,delay:2});
}
function startTest(id,path){
	//alert(id+','+path);
	if(window.document.getElementById('agree').checked==true){
		var bals=new Ajax.Updater('test',path+'connect/dash_ajax.php?fxn=startTest&testid='+id, {method:'',parameters:''});
	
		loadtime(path);
	}
}
function nextQuestion(path){
	var score=computeScore();
	//if(window.document.getElementById('agree').checked==true){
		var bals=new Ajax.Updater('test',path+'connect/dash_ajax.php?fxn=nextQuestion&score='+score, {method:'',parameters:''});
	
//		loadtime();
	//}
}
function computeScore(){
	var name='';
	var testform=document.test;
	for(var j=0;j<testform.elements.length; j++){
		if(testform.elements[j].type=="radio"){
			//no++;
			if(testform.elements[j].checked==true){
				//if(j){
					name=name+testform.elements[j].value;
				//}
			}
		}
		if(testform.elements[j].type=="checkbox"){
			//no++;
			
			if(testform.elements[j].checked==true){
				name=name+testform.elements[j].value+';';
				
			}
		}
		
	}
	var no=name.length;
	if(no>1){//removes the : in multi respose questions
		name=name.substr(0,(no-1));
	}
	//alert('this is the value :'+name);

	var pass=0;

	if(name==document.getElementById('answer').value){
		pass=1;
	}
	//alert('pass : '+pass);
	return pass;
}
function PrintSheet(div){
	var btn=document.getElementById(div);
	//window.document.
	print();
	close();
}
function removeTest(schlid){
	//if(confirm('You are about to remove the selected student(s), this will erase the entire record of the students, do you wish to continue?')==true){
		var total=window.document.getElementById('total').value;
		var allQid='';
		var testRem=false;
		
		for(var i=0;i<total;i++){
			if(window.document.getElementById('item'+i).checked==true){
				if(i!=(total-1)){
					allQid=allQid+window.document.getElementById('id'+i).value+':';
				}else{
					allQid=allQid+window.document.getElementById('id'+i).value;
				}
				testRem=true;
			}
		}
		if(testRem==true){
			var rep=confirm("you are about to remove the selected test, do you wish to continue?");
			//alert(allQid+' - '+schlid);
			if(rep==true){
			var bals=new Ajax.Updater('testList','connect/dash_ajax.php?schlid='+schlid+'&testid='+allQid+'&fxn=removeTest', {method:'post',parameters:''});
				
			}
		}
	
}
/*test interaction from the students perspective*/
function loadTest_student(testid,schlid,path){
	var bals=new Ajax.Updater('test',path+'connect/index_ajax.php?fxn=loadTest&testid='+testid+'&schlid='+schlid, {method:'',parameters:''});
}
function loadtime_student(path,schlid,testid){
	
	var bals=new Ajax.PeriodicalUpdater('timer',path+'connect/index_ajax.php?fxn=loadtimeforstudent', {method:'post', frequency:60.0,delay:2});
	var id=setInterval(checkstatus,5000);
	//clearInterval(id);
}
function checkstatus(){
	var details=document.getElementById('details').innerHTML;

	var all=details.split(',');

	var schlid=all[0];
	var studid=all[1];
	var testid=all[2];
	
	//alert("confirm!"+schlid+' - '+testid+' - '+studid);
	
	var path='';
	if(document.getElementById('timer').innerHTML=='00:0') {
		//alert('Your time is exhausted');
		window.location.href="test_result.php?schlid="+schlid+"&testid="+testid+"&studid="+studid;
		//clearInterval();
	}
	if(document.getElementById('test').innerHTML=='Computing score ....') {
		//alert("test_result.php?schlid="+schlid+"&testid="+testid+"&studid="+studid);
		window.location.href="test_result.php?schlid="+schlid+"&testid="+testid+"&studid="+studid;
		//clearInterval();
	}
}
function startTest_student(schlid,id,path){
	if(window.document.getElementById('agree').checked==true){
		var bals=new Ajax.Updater('test',path+'connect/index_ajax.php?fxn=startTest&testid='+id+'&schlid='+schlid, {method:'',parameters:''});
	
		loadtime_student(path,schlid,id);
		//window.location.href="test_body.php?schlid="+schlid+"&testid="+id;
		
	}
}
function nextQuestion_student(path){
	var score=computeScore_student();
	var allval=document.getElementById('details').innerHTML;
	
	var bals=new Ajax.Updater('test',path+'connect/index_ajax.php?fxn=nextQuestion&score='+score+'&details='+allval, {method:'',parameters:''});
}
function computeScore_student(){
	var name='';
	var testform=document.test;
	for(var j=0;j<testform.elements.length; j++){
		if(testform.elements[j].type=="radio"){
			//no++;
			if(testform.elements[j].checked==true){
				//if(j){
					name=name+testform.elements[j].value;
				//}
			}
		}
		if(testform.elements[j].type=="checkbox"){
			//no++;
			
			if(testform.elements[j].checked==true){
				name=name+testform.elements[j].value+';';
				
			}
		}
		
	}
	var no=name.length;
	if(no>1){//removes the : in multi respose questions
		name=name.substr(0,(no-1));
	}
	//alert('this is the value :'+name);

	var pass=0;

	if(name==document.getElementById('answer').value){
		pass=1;
	}
	//alert('pass : '+pass);
	return pass;
}
function showFaqAnswer(sele){
	//var selitem=document.getElementById('sele').value;
	if(document.getElementById(sele).style.display=="none"){
		document.getElementById(sele).style.display="block";
	}else{
		document.getElementById(sele).style.display="none";
	}
}
/*function showNonProspects(){
	var selitem=document.getElementById('sclass').value;
	if(selitem=='Prospects'){
		document.getElementById('nonprospect').style.display="none";
	}else{
		document.getElementById('nonprospect').style.display="block";
	}
}*/