<?php
require 'database.php';

// Use a prepared statement
$stmt = $mysqli->prepare("SELECT COUNT(*), username, pass_hash FROM user_pass WHERE username=?");

// Bind the parameter
$stmt->bind_param('s', $username);
$username = $_POST['username'];
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $user_id, $pwd_hash);
$stmt->fetch();

$pwd_guess = $_POST['password'];
// Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
        // Login succeeded!
        $_SESSION['user_id'] = $user_id;
        // Redirect to your target page
} else{
        // Login failed; redirect back to the login screen
}
$stmt -> close();
?>