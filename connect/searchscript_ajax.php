<?php
require_once("indexscripts.php");

$fxn=$_REQUEST["fxn"];

if(strtolower($fxn)==strtolower('searchForm')){
	$word="";
	
	if(isset($_REQUEST['word'])) $word=$_REQUEST['word'];
	
	getSchoolForSearch($word);
}
?>