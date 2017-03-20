<?php
// Content of database.php
 
$mysqli = new mysqli('localhost', 'cwzhang', 'wdlvdm83', 'articles');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>

