<?php
session_start();
require 'connection.php';
$comment_num = (int) $_POST['comment_num'];
$user = $_SESSION['username'];
//get the original poster of the comment 
$original_user = $mysqli -> prepare("SELECT COUNT(*), comment FROM Comments WHERE comment_num = ? AND user = ?");
if(!$original_user){
	printf("Query Prep Failed: %s\n", $mysqli -> error);
	exit;
}

//if($original_user -> num_rows == 0)
$original_user -> bind_param('ds', $comment_num, $user);
$original_user -> execute();
$original_user -> bind_result($cnt, $comment);
$original_user->fetch();
if($cnt == 1) {
        	echo "<h1><b>Your Comment:</b></h1> $comment";
        	$original_user -> close();
}		
else{
	$original_user -> close();
	echo "You are not authorized to edit this comment!";
	header("Refresh: 2 url=edit_comment.html");
}
?>
<html>
<title>Edit Your Comment</title>
<head></head>
<body>
      <h3>Edit Your Comment</h3>

   <fieldset>
   <form action="edit_comment.php" method='POST'>
         <input name = "comment_num" placeholder = "Enter the comment number" required = "" type = "number"> <br>
         <label><b>Enter your New Comment Below:</b></label><br>
         <textarea name= "comment" placeholder = "Enter your comment" rows = "15" tabindex = "3" required= "" type ="text"></textarea><br>
         <input type="submit" value="Submit">
   </form>
   </fieldset>
   </div>
</body>

</html>