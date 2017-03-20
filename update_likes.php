<?php
require 'connection.php';
session_start();

$username = $_SESSION['username'];
$article_num = $_POST['article_num'];

// check if the user as already liked the story
$is_liked = $mysqli -> prepare("SELECT COUNT(*) FROM Likes WHERE username = ? AND article_num = ?");
if(!$is_liked) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$is_liked -> bind_param("sd", $username, $article_num);
$is_liked -> execute();
$is_liked -> bind_result($user_liked);
$is_liked -> fetch();

// check if the user has already liked the story
// if not, increment the number of likes of the article and insert
// username into likes table if not liked
if($user_liked == 1) {
    $is_liked -> close();
    if(!isset($_POST['like'])){
        //remove like from Likes table 
        $delete_like = $mysqli->prepare("DELETE FROM Likes WHERE username = ?");
        if(!$delete_like) {
            printf("Query Prep Failed for deletion of comments: %s\n", $mysqli->error);
            exit;
        }
        $delete_like->bind_param('s', $username);
        $delete_like->execute();
        $delete_like->close();
        //update the likes in articles
        $update_article = $mysqli -> prepare("UPDATE articles SET num_likes = num_likes - 1 WHERE article_num = ?");
        if(!$update_article){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
        }
        $update_article -> bind_param('d', $article_num);
        $update_article -> execute();
        $update_article -> close();
        header("Location: website_users.php");
        exit;

    }
    else{
        echo "You have already liked the story!";
        header("Refresh:2 url= website_users.php");
        exit;
    }   
}

//if user has not liked the article before:
else {
    $is_liked ->close();
    
    if(!isset($_POST['like'])){
        echo "You have not liked this article yet!";
         header("Refresh:2 url= website_users.php");
        exit;
    }
    else{
        $add_into_db = $mysqli -> prepare("INSERT INTO Likes (username, article_num) VALUES(?, ?)");
        if(!$add_into_db) {
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }

        $add_into_db -> bind_param("sd", $username, $article_num);
        $add_into_db -> execute();
        $add_into_db -> close();
        
        //update the articles table to tabulate the likes. 
        $update_article = $mysqli -> prepare("UPDATE articles SET num_likes = num_likes + 1 WHERE article_num = ?");
        if(!$update_article){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $update_article -> bind_param('d', $article_num);
        $update_article -> execute();
        $update_article -> close();
        header("Location: website_users.php");
    }

}
?> 

