<?php
session_start();
require 'connection.php';
$user = $_SESSION['username'];
$comment_num = $_POST['comment_num'];
$new_comment = $_POST['comment'];
//get the original poster of the comment 
$original_user = $mysqli -> prepare("SELECT COUNT(*), comment FROM Comments WHERE comment_num = ? AND user = ?");
if(!$original_user){
	printf("Query Prep Failed: %s\n", $mysqli -> error);
	exit;
}
//if($original_user -> num_rows == 0)
$original_user -> bind_param('is', $comment_num, $user);
$original_user -> execute();

$original_user -> bind_result($cnt, $comment);
$original_user -> fetch();

//continue to edit the comment if the above did not occur
if($cnt == 1) {
	$original_user -> close();
	$edit = $mysqli -> prepare("UPDATE Comments SET comment = ? where comment_num = ?");
	if(!$edit){
		printf("Query Prep Failed: %s\n", $mysqli -> error);
		exit;
	}
	$edit -> bind_param("si", $new_comment, $comment_num);
	$edit -> execute();
	
	$edit -> close();
	echo "Your comment has been updated.";
	header("Refresh:2  url = website_users.php");	

}
else{
	echo "Your comment has not been update. You are not authorized.";
}
?>
