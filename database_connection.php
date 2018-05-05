<?php
$host='localhost';
$user='root';
$pass='root';
$db='myhobbyholidays';
$conn=mysqli_connect($host,$user,$pass,$db) or die ("Break for DB");
if(!$conn) {
	echo "Connection not successful "; 
}

?>
