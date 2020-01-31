<?php 

session_start();

if(!isset($_SESSION['username'])){
	exit('You must log in first!');
}

session_destroy();

header("location: login.php");
exit();

?>