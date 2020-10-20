<div id="manageSubjectGroup" class="modal hide fade modalBg">
	<div class="modal-dialog">
    		<div class="modal-content">
            	<div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="hidden">&times;</button>
                <h3 class="modal-title h-line">Subject Management form</h3>
                <div class="modal-body font">
                <div class="instruction-box"><span>
Here you can create new subject group by entering an unused group id and unused group name, most preferable, use class name as a convention, for instance "jss 1 a", "ss 2 d" and so on.
Also,
You add or remove subject to and from subject group by, selecting the "select group name" drop down box to choose the concerned subject group, then clicking on "add and remove group subject(s)" button
to start updating the subject group. 
Finally you can remove an entire subject group using this form, by selecting the "select subject group name" drop down, and clicking on the "remove subject group" button.
                </span></div><div class="clear"></div><br />
                
                <form class="form-action" method="post">
                <div class="container-fluid">
                <div class="row-fluid">
                <!--div class="span1"></div-->
                <div class="span12">
                <ul class="nav nav-tabs font2">
                <li class="active disabled"><a data-toggle="tab" href="#create"><span class="icon-home"></span>CREATE SUBJECT GROUP</a></li>
                <li class="disabled"><a data-toggle="tab" href="#edit"><span class="icon-bookmark"></span>ADD AND REMOVE SUBJECT(S) TO GROUP</a></li>
                </ul>
                
                <div class="tab-content">
                <div id="create" class="tab-pane fade in active">
                  <!--div style="background-color:#CCC; text-align:justify; padding:10px;"><strong>ORDERED PIN HISTORY.</strong></div-->
                  <div id="createForm">
                  <div id="subjectMsg"></div>
                  <?php #include("link-files/pinHistory.php");?>
                  <div>
                    <div align="center">
                    Enter Group ID :
                    <input type="text" name="groupID" maxlength="20" id="groupID" />
                    </div>
                    <div align="center">Enter Group Name : <input type="text" maxlength="20"  name="groupName" id="groupName" /></div>
               		<div align="center"><button type="button" onclick="createNewGroup();" name="creategroup" id="creategroup" class="btn btn-info btn-small">Create subject group</button></div>
                    
                </div>
                  </div>
                </div>
               <div id="edit" class="tab-pane fade">
                  <p id="edtForm">
                  <!--div-->
                    <div align="center"><!--Enter Group ID :--> 
                    <select name="groupID2" id="groupID2"> 
                    <option>Select subject group name</option>
                    <?php loadSubjectGroups($_SESSION['schlid']);?>
                    </select></div>
                    
                <div align="center"><button class="btn btn-small btn-info" name="addnremovesubject" id="addnremovesubject" type="button" onclick="addSubject();">Add and remove group subject(s) </button></div>
                <!--/div-->
               
                  </p>
                </div>
               </div>
               <div>
               <div><!-- class="row-fluid"-->
                	<div style="margin:10px 0;"><!-- class="span12"-->
                    	Created subject groups can be allotted to classes to ensure that the component subjects are automatically loaded during result computation.<br /><a href="subjectallocation.php">Assign subject groups to classes</a>.
                    </div>
                </div>    
               <div><!-- class="row-fluid"-->
                	<div><!-- class="span12"-->
                    <hr />
                    	<h5>REMOVE SUBJECT GROUP</h5>
                    </div>
                </div>
                <div><!-- class="row-fluid"-->
                	<div><!-- class="span12"-->
                    	<p style="color:red; font-size:12px;">Note: Removing subject group that is in use returns a class subject group to default. therefore  enure that only subject groups which are not in use are removed.</p>
                    </div>
                    
                </div>
               <div>
                	<div>
                    <div class="control-group form-inline">
                    <select id="groups" name="groups"><!-- onchange="loadsubjectG('groups');"-->
                      <option>Select subject group name</option>
                      <?php loadSubjectGroups($_SESSION['schlid']);?>
                    </select>
                    <button type="button" class="btn btn-info btn-small" onclick="removeGroup('groups')" name="removeSubjectGroup">Remove subject group</button>
                    </div>
                    </div>
                </div>
               </div>
                <!--div id="msg">
                
                </div>
                <div class="container-fluid">
                <div class="row-fluid">
                	<div class="span4">
                    <b>Add Subject Group</b><br>
                    Enter Group ID :
                    </div>
                    <div class="span8">
                    <br>
                    <input type="text" class="pull-left" name="groupID" id="groupID" />
                    </div>
                </div>
                <div class="row-fluid">
                	<div class="span4">
                    	Enter Group Name :
                    </div>
                    <div class="span8">
                    	<input type="text" class="pull-left" name="groupName" id="groupName" />
                    </div>
                </div>
               <div class="row-fluid">
                	<div class="span12"><button type="button" onclick="createNewGroup();" name="creategroup" id="creategroup" class="btn btn-info btn-small">Create subject group</button> <button class="btn btn-small" name="addnremovesubject" id="addnremovesubject" type="button" onclick="addSubject();">Add and remove subject(s) to group</button></div>
                </div>
                <div class="row-fluid">
                	<div class="span12">
                    	Created subject groups can be allotted to classes to ensure that the component subjects are automatically loaded during result computation.<br /><a href="#">Assign subject groups to classes</a>.
                    </div>
                </div>    
               <div class="row-fluid">
                	<div class="span12">
                    <hr />
                    	<h5>Remove Subject group</h5>
                    </div>
                </div>
                <div class="row-fluid">
                	<div class="span12">
                    	<p style="color:red; font-size:12px;">Note: Removing subject group that is in use returns a class subject group to default. therefore  enure that only subject groups which are not in use are removed.</p>
                    </div>
                    
                </div>
               <div class="row-fluid">
                	<div class="span12">
                    <div class="control-group form-inline">
                    <select id="groups" name="groups">
                      <option>Select subject group name</option>
                      <?php #loadSubjectGroups($_SESSION['schlid']);?>
                    </select>
                    <button type="button" class="btn btn-info btn-small" onclick="removeGroup('groups')" name="removeSubjectGroup">Remove subject group</button>
                    </div>
                    </div>
                </div-->
               </div><!--div class="span1"></div--> 
               </div> <!--end of container fluid-->
               </div>
                </form>
                	
                </div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>                
                </div>
            </div>
    </div>
</div>