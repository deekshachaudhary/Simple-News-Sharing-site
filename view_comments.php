<?php
session_start();
    //view the comments page 
    require 'connection.php';
    $article_num = $_POST['article_num'];
    $stmt = $mysqli->prepare("SELECT comment, user, comment_num FROM Comments WHERE article_num = ?");
    if (!$stmt) {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt -> bind_param("i", $article_num);
    $stmt->execute();
    $stmt -> bind_result($comment, $user, $comment_num);
    $format = '<br><font size ="5">%s</font><br> Commented by user: %s Comment Number: %d';
    echo "Comments for Article $article_num";
    echo "<ul>\n";
    while ($stmt->fetch()) {
        printf($format, 
        	     htmlspecialchars($comment), 
        	     htmlspecialchars($user),
               htmlspecialchars($comment_num)
        	     );
        //echo '<br><a href="' . $. '" target="_blank">' . $website . '</a>';
    }
    echo "</ul>\n";
    $stmt->close();
?>
<html>
 <fieldset>
  <form action="edit_comment_new.php" method='POST'>
         <legend><b><h3>Edit and Delete Articles or Comments</h3></b></legend>
         <label>Edit Comment: </label>
         <input name="comment_num" placeholder="Enter comment number" required="" type="text">
         <input type = "submit" value = "Enter" name = "edit_comment">
  </form>
  <form action = "delete_comment.php" method = 'POST'>
         <label>Delete Comment: </label>
         <input name="comment_num" placeholder="Enter comment number" required="" type="text">
         <input type = "submit" value = "Enter" name = "delete_comment">
  </form>
  <form action = "post_comment.html" method = 'POST'>
         <input type = "submit" value = "Post A Comment" name = "post_comment">
  </form>
 </fieldset>
</html>