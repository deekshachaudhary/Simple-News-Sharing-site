<?php
session_start();
header("Content-type: text/html; charset=iso-8859-1");
require 'connection.php';
$article_num = (int) $_POST['article_num'];
$user = $_SESSION['username'];
//get the original poster of the comment 
$original_user = $mysqli -> prepare("SELECT COUNT(*), title, content FROM articles WHERE article_num = ? AND user = ?");
if(!$original_user){
	printf("Query Prep Failed: %s\n", $mysqli -> error);
	exit;
}

//if($original_user -> num_rows == 0)
$original_user -> bind_param('ds', $article_num, $user);
$original_user -> execute();
$original_user -> bind_result($cnt, $title, $content);
$original_user->fetch();
if($cnt == 1) {
        	echo "<h2><b>Your Title:</b></h2> $title";
        	echo "<h2><b>Your Content:</b></h2> $content";
        	$original_user -> close();
}		
else{
	$original_user -> close();
	echo "You are not permitted to edit this article!";
	header("Refresh: 2 url=edit_comment.html");
}
?>
<html>
<title>Edit Your Article</title>
<head></head>
<body>
      <h3>Edit Your Article</h3>

   <fieldset>
   <form action="edit_story2.php" method='POST'>
         <input name = "article_num" placeholder = "Enter the article number" required = "" type = "number"> <br>
         <label><b>Enter your New Title:</b></label><br>
         <input name= "title" placeholder = "Enter your new title" type ="text"></input><br>
         <label><b>Enter your New Content Below:</b></label><br>
         <textarea name= "content" placeholder = "Enter your content" rows = "15" tabindex = "3" required= "" type ="text"></textarea><br>
         <input type="submit" value="Submit">
   </form>
   </fieldset>
   </div>
</body>

</html>


