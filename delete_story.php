<?php
require 'connection.php';
    session_start();
    $article_num = $_POST['article_num'];
    $username = $_SESSION['username'];
    //get the original poster of the article 
    $original_user = $mysqli -> prepare("SELECT COUNT(*) FROM articles WHERE article_num = ? AND user = ?");
    if(!$original_user){
      printf("Query Prep Failed: %s\n", $mysqli -> error);
      exit;
    }
    $original_user -> bind_param('ds', $article_num, $username);
    $original_user -> execute();
    $original_user -> bind_result($cnt);
    $original_user -> fetch();

//delete the comments associated with the story first
if($cnt == 1) {
  $original_user -> close();
  $delete_comments = $mysqli -> prepare("DELETE FROM Comments WHERE article_num = ?");
  if(!$delete_comments){
    printf("Query Prep Failed: %s\n", $mysqli -> error);
    exit;
  }
  $delete_comments -> bind_param('d', $article_num);
  $delete_comments -> execute();
  $delete_comments -> close();
      
  // delete story now
  $delete_story = $mysqli -> prepare("DELETE FROM articles WHERE article_num = ?");
  if(!$delete_story){
    printf("Query Prep Failed: %s\n", $mysqli -> error);
    exit;
  }
  $delete_story -> bind_param('d', $article_num);
  $delete_story -> execute();
  $delete_story -> close();
      
  echo "Your article and comments have been successfully deleted!";
  header("refresh:2 url=website_users.php");
}
    
else{
  echo "You are not authorized to delete this article.";
  header("refresh:2 url=website_users.php");
  $original_user -> close();
}
?>