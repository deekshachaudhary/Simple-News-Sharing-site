<?php
require 'connection.php';
// Use a prepared statement
session_start();
$stmt = $mysqli->prepare("SELECT COUNT(*), username, pass_hash FROM userpw WHERE username=?");
 
// Bind the parameter
$stmt->bind_param('s', $username);
$username = $_POST['username'];
$stmt->execute();
 
// Bind the results
$stmt->bind_result($cnt, $user, $pass);
$stmt->fetch();

$password = $_POST['password'];
// Compare the submitted password to the actual password hash
// In PHP < 5.5, use the insecure: if( $cnt == 1 && crypt($pwd_guess, $pwd_hash)==$pwd_hash){
 
if($cnt == 1 && password_verify($password, $pass)){
	// Login succeeded
	$_SESSION['username'] = $user;
	echo "login successful";
	header('refresh:3 url=website_users.php ');

} else{
	echo "Login failed, please try again.";
	header('refresh:3; url=website.php ');

}
?>