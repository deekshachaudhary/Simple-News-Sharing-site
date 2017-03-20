<?php
require 'connection.php';
session_start();
header("Content-type: text/html; charset=iso-8859-1");
$username = $_SESSION['username'];

// display top 5 liked stories
$top_articles_query = $mysqli->prepare("SELECT title, author, user, article_num, website, content, num_likes 
                            FROM articles ORDER BY num_likes DESC LIMIT 3");
if(!$top_articles_query) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$top_articles_query -> execute();
$top_articles_query -> bind_result($title, $author, $user, $article_num, $website, $content, $num_likes);
$format = '<br><font size ="6">%s</font><br>Author: %s &nbsp Uploaded by: %s &nbsp Article number: %d  &nbsp Number of Likes: %d <br> <br>%s';
echo "<ul>\n";
while($top_articles_query -> fetch()){
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
$top_articles_query -> close();

?> 


