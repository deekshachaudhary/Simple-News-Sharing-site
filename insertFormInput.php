<?php
require 'database.php';

$username = $_POST['username'];
$password = $_POST['password'];


$pass_hash = password_hash($password, PASSWORD_DEFAULT);

$store_user_pass = $mysqli->prepare("insert into user_pass (username, password) values (?, $pass_hash)");

if(!$store_user_pass) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$store_user_pass->bind_param('sss', $username, $pass_hash);
$store_user_pass->execute();
$store_user_pass->close();

?>
