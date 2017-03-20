<?php
require 'connection.php';
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $mysqli->prepare("SELECT username FROM userpw WHERE username=?");
 
// Bind the parameter
$stmt->bind_param('s', $username);
$username = $_POST['username'];
$stmt->execute();
 
// Bind the results
$stmt->bind_result($user);
$stmt->fetch();
$stmt -> close();

// Compare the submitted password to the actual password hash
// In PHP < 5.5, use the insecure: if( $cnt == 1 && crypt($pwd_guess, $pwd_hash)==$pwd_hash){
 
if(strcmp($username, $user) == 0){
	echo "This username has been taken please try again.";
	header('refresh:2 url=website.php ');
	exit;
} 
else{
$pass_hash = password_hash($password, PASSWORD_DEFAULT);

$store_user_pass = $mysqli->prepare("insert into userpw (username, pass_hash) values (?, ?)");

if(!$store_user_pass) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$store_user_pass->bind_param('ss', $username, $pass_hash);
$store_user_pass->execute();
$store_user_pass->close();
echo "Your account has be successfully created";
header('refresh:2 url=website.php ');
}
?>
