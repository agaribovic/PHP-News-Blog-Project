<?php 

session_start();

if(!isset($_SESSION['username'])){
	exit('You must log in first!');
}

include('include/connection.inc.php');

$id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP&amp;MySQL - View post | Zadaca 3</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<nav>
		<div class="logout">
			<a href="">Logout</a>
		</div>
	</nav>
	
	<div class="container">
		<h1> <?php echo $row['title']; ?> </h1>
		<img src="<?php echo $row['image']; ?>">
		<p><b> Published: </b> <?php echo $row['date_created']; ?> </p>
		<p> <?php echo $row['content']; ?> </p>

		<p>Back to <a href="dashboard.php">Dashboard</a></p>
	</div>
</body>
</html>