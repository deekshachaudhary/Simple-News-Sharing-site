<?php
require 'connection.php';
session_start();
$username = $_SESSION['username'];

//delete the comments associated with user first
$delete_comments = $mysqli->prepare("DELETE FROM Comments WHERE user = ?");
if(!$delete_comments) {
    printf("Query Prep Failed for deletion of comments: %s\n", $mysqli->error);
    exit;
}
$delete_comments->bind_param('s', $username);
$delete_comments->execute();
$delete_comments->close();

//delete likes associated with the user
$delete_likes = $mysqli->prepare("DELETE FROM Likes WHERE username = ?");
if(!$delete_likes) {
    printf("Query Prep Failed for deletion of comments: %s\n", $mysqli->error);
    exit;
}
$delete_likes->bind_param('s', $username);
$delete_likes->execute();
$delete_likes->close();


//delete articles associated with user first 
$delete_articles = $mysqli->prepare("DELETE FROM articles WHERE user = ?");

if(!$delete_articles) {
    echo "error";
    printf("Query Prep Failed for deletion of articles: %s\n", $mysqli->error);
    exit;
}
$delete_articles->bind_param('s', $username);
$delete_articles->execute();
$delete_articles->close(); 

//now delete user
$delete_user = $mysqli->prepare("DELETE FROM userpw WHERE username = ?");
if(!$delete_user) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$delete_user->bind_param('s', $username);
$delete_user->execute();
$delete_user->close();
echo "Your account and associated posts have been successfully deleted";
header('refresh:3; url=website.php ');
?>
