<?php
require 'connection.php';
session_start();
$username = $_SESSION['username'];
$title = $_POST['title'];
$website = $_POST['website'];
$genre = $_POST['genre'];
$author = $_POST['author'];
$content = $_POST['content'];
$stmt = $mysqli -> prepare("INSERT INTO articles (title, website, genre, author, user, content) VALUES ( ?, ?, ?, ?, ?, ?)");
if(!stmt){
	printf("Query Prep Failed: %s\n", $mysqli -> error);
	exit;
} 
//insert into table 
$stmt -> bind_param('ssssss', $title, $website, $genre, $author, $username, $content);
$stmt -> execute();
$stmt -> close();
echo "Article has been added!";
header('refresh:2 url=website_users.php ');
?>
