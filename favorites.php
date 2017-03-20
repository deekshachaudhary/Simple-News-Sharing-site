<?php
require 'connection.php';
session_start();
header("Content-type: text/html; charset=iso-8859-1");
$username = $_SESSION['username'];


// display stories liked by the user
$fav_articles_query = $mysqli->prepare("SELECT articles.title, articles.author, articles.user, articles.article_num, articles.website, articles.content, articles.num_likes 
                                FROM articles JOIN Likes ON (articles.article_num =Likes.article_num)
                                WHERE Likes.username = ?");

if(!$fav_articles_query) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$fav_articles_query -> bind_param('s', $username);
$fav_articles_query -> execute();
$fav_articles_query -> bind_result($title, $author, $user, $article_num, $website, $content, $num_likes);

$format = '<br><font size ="6">%s</font><br>Author: %s &nbsp Uploaded by: %s &nbsp Article number: %d  &nbsp Number of Likes: %d <br> <br>%s';

echo "<ul>\n";
while($fav_articles_query -> fetch()){
         printf($format,
                htmlspecialchars( $title ),
                htmlspecialchars( $author ),
                htmlspecialchars( $user ),
                htmlspecialchars( $article_num ),
                htmlspecialchars( $num_likes),
                $content
        );
        echo '<br><b>See full story at: </b><a href="' . $website . '" target="_blank">' . $website . '</a>';
        echo '<br><form action = "update_likes.php" method = "POST">  <input type="hidden" name="article_num" value=" ' . $article_num . '">  <input type = "submit" value = "Like" name = "like"> <input type = "submit" value = "Unlike" name = "unlike"> </form>';
}

$fav_articles_query -> close();

?> 