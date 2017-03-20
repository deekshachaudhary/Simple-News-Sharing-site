<?php
session_start();
require 'connection.php';
$user = $_SESSION['username'];
$article_num = $_POST['article_num'];
$new_content = $_POST['content'];
$title = $_POST['title'];

//get the original poster of the comment 
$original_user = $mysqli -> prepare("SELECT COUNT(*) FROM articles WHERE article_num = ? AND user = ?");
if(!$original_user){
	printf("Query Prep Failed: %s\n", $mysqli -> error);
	exit;
}
//if($original_user -> num_rows == 0)
$original_user -> bind_param('is', $article_num, $user);
$original_user -> execute();

$original_user -> bind_result($cnt);
$original_user -> fetch();
//continue to edit the comment if the above did not occur
if($cnt == 1) {
	$original_user -> close();
	$edit = $mysqli -> prepare("UPDATE articles SET content = ?, title = ? where article_num = ?");
	if(!$edit){
		printf("Query Prep Failed: %s\n", $mysqli -> error);
		exit;
	}
	$edit -> bind_param("ssi", $new_content, $title, $article_num);
	$edit -> execute();
	
	$edit -> close();
	echo "Your article has been updated.";
	header("Refresh:2  url = website_users.php");	

}
else{
	echo "Your article has not been update. You are not authorized.";
}
?>