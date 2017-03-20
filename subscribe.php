<?php
//cite source:
// http://stackoverflow.com/questions/12886612/send-php-mail-in-intervals
require 'connection.php';
$to      = $_POST['email'];
$subject = 'CSE503 Newsletter';
$get_message = $mysqli->prepare("SELECT title, website, content FROM articles WHERE num_likes=(SELECT max(num_likes) FROM articles)");
if(!$get_message){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
} 

$get_message -> execute();
$get_message -> bind_result($title, $website, $content);
//$get_message -> fetch();
while($get_message -> fetch()){
	$message = 'The hottest article for this week is:
"' . $title . '" 
"' . $content . '"
See more here: "' . $website . '"';
    }

$result = mail($to, $subject, $message);

//usually sent periodically but did not want to clutter email. 
//sleep(4);

$get_message -> close();    


if($result == true ) {
	echo "Message sent successfully...";
	header("refresh:2 url= website_users.php");
}
else {
	echo "Message could not be sent...";
	header("refresh2: url= website_users.php");
}


?>

