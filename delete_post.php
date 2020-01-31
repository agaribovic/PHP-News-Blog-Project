<?php 

session_start();

if(!isset($_SESSION['username'])){
	exit('You must log in first!');
}

include('include/connection.inc.php');

$id = $_GET['id'];

$deletePost = mysqli_query($conn, "DELETE FROM posts WHERE id=$id");

header("Location:dashboard.php");


?>