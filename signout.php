<?php
if (!$_SESSION){
	session_start();
}
#print $_SESSION['status'];
header("Location:index.php");
session_destroy();
?>