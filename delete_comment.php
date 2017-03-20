<?php
	
	if(isset($_POST['edit_comment'])){
		header('Location: edit_comment.php');
	}
	else{
		require 'connection.php';
		session_start();
		$comment_num = (int) $_POST['comment_num'];
		$user = $_SESSION['username'];

		//get the original poster of the comment 
		$original_user = $mysqli -> prepare("SELECT COUNT(*), user FROM Comments where comment_num = ? AND user = ?");
		if(!$original_user){
			printf("Query Prep Failed: %s\n", $mysqli -> error);
			exit;
		}

		if($original_user -> num_rows == 0)
		$original_user -> bind_param('ds', $comment_num, $user);
		$original_user -> execute();

		$original_user -> bind_result($cnt, $user);
		$original_user -> fetch();

		//continue to delete the comment if the above did not occur
		if($cnt == 1) {
			$original_user -> close();

			$delete = $mysqli -> prepare("DELETE FROM Comments where comment_num = ?");
			if(!$delete){
				printf("Query Prep Failed: %s\n", $mysqli -> error);
				exit;
			}
			$delete -> bind_param('d', $comment_num);
			$delete -> execute();
			$delete -> close();
			echo "Your comment has been successfully deleted!";
			header("refresh:2 url=website_users.php");
		}
		else{
			echo "You are not authorized to delete this comment.";
			header("refresh:2 url=website_users.php");
			$original_user -> close();
		}

	}

?>