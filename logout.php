<?php

    session_start();

    unset($_SESSION['username']);
    	echo "You have been successfully logged out!";
	header('refresh:3 url=website.php');

?>