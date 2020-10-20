<?php
if (!$_SESSION){
	session_start();
}
header("Location:index.php");
session_destroy();
?>