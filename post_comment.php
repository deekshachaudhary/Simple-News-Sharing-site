<?php
require 'connection.php';
session_start();
//define the variables 
$username = $_SESSION['username'];
$article_num = (int)$_POST['article_num'];
$comment = $_POST['comment'];
//prep the inputs
$stmt = $mysqli -> prepare("INSERT INTO Comments (article_num, user, comment) values (?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli -> error);
	exit;
}
//input into sql
$stmt -> bind_param("iss", $article_num, $username, $comment);
$stmt -> execute();
$stmt -> close();
echo "Your comment has been added!";
header('refresh:2 url=website_users.php ');
?>