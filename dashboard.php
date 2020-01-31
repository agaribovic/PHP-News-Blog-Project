<?php 

session_start();

if(!isset($_SESSION['username'])){
	exit('You must log in first!');
}

include('include/connection.inc.php');

	if (isset($_GET['filter'])) {
		if ($_GET['filter'] == 1){

	$sql = "SELECT * FROM posts where Category = 'News' " ;
	$result = mysqli_query($conn,$sql);

}
					
	else {
	$sql = "SELECT * FROM posts where Category = 'Blog' " ;
	$result = mysqli_query($conn,$sql);
	
	}
		} else {

	$sql = "SELECT * FROM posts"  ;
	$result = mysqli_query($conn,$sql);
				
				}

?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP&amp;MySQL - Admin panel | Zadaca 3</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<nav>
		<div class="logout">
			<a href="logout.php">Logout</a>
		</div>
	</nav>
	<div class="container">
		<h3>Welcome Super Admin</h3>
		<div class="left">
			<a class="addbutton" href="add_post.php">Add post</a>		
		</div>
		<div class="right">
			<form action="" method="get">
				<input type="submit" name="filter" class="addbutton" value="Filter">
				<select name="filter">
					<option value="1">News</option>
					<option value="2">Blog</option>
				</select>
			</form>
		</div>
		<table>
			<tr>
				<th>Title</th>
				<th>Category</th>
				<th>Date Created</th>
				<th style="width: 178px;">Action</th>

		
		

			<?php while($row = mysqli_fetch_assoc($result)) { ?> 
					<tr>
						<td> <?php echo $row['title']; ?> </td>
						<td> <?php echo $row['category']; ?> </td>
						<td> <?php echo $row['date_created']; ?> </td>
						<td> 
							<a class="editbutton" href=<?php echo 'edit_post.php?id='. $row['id']; ?>>Edit</a> 
							<a class="viewbutton" href=<?php echo 'view_post.php?id='. $row['id']; ?>>View</a>
							<a class="deletebutton" href=<?php echo 'delete_post.php?id='. $row['id']; ?>>Delete</a>
						</td>
					</tr>
			<?php } ?>

		</table>
	</div>
</body>
</html>