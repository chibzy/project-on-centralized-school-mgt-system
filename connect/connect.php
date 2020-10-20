<?php
/*function connectdb()
{
global $conn;
$hostname_school = "localhost";
$database_school = "id801866_postprimary";
$username_school = "id801866_chibzy";
$password_school = "goodluck";

#$conn=mysql_connect($hostname_school,$username_school,$password_school);
$conn=mysqli_connect($hostname_school,$username_school,$password_school);
#$db=mysql_select_db($database_school);
$db=mysqli_select_db($conn,$database_school);
#echo "connected";
}*/
function connectdb()
{
global $conn;
$hostname_school = "localhost";
$database_school = "postprimary";
$username_school = "root";
$password_school = "";

#$conn=mysql_connect($hostname_school,$username_school,$password_school);
@$conn=mysqli_connect($hostname_school,$username_school,$password_school);
#$db=mysql_select_db($database_school);
@$db=mysqli_select_db($conn,$database_school);
#echo "connected";
}
?>