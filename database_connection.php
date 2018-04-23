<?php
$host='127.0.0.1';
$user='root';
$pass='root';
$db='myhobbyholidays';
$conn=mysqli_connect($host,$user,$pass,$db) or die ("Break for DB");
if(!$conn) {
	echo "Connection not successful "; 
}

?>
