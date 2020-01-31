<?php 

session_start();

if(!isset($_SESSION['username'])){
	exit('You must log in first!');
}

$error_message = $success_message = '';

if(isset($_POST['add'])){

include('include/connection.inc.php');

$title = mysqli_real_escape_string($conn, $_POST['title']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$category_number = mysqli_real_escape_string($conn, $_POST['category']);
switch($category_number){
	case 1:
		$category = 'News';
		break;
	case 2:
		$category = 'Blog';
		break;
	case 3:
		$category = 'Other';
		break;
	default:
		echo $category = 'Error!';
}
$date_created = mysqli_real_escape_string($conn, $_POST['date']);
$image = mysqli_real_escape_string($conn, $_POST['image']);
$content = mysqli_real_escape_string($conn, $_POST['content']);

if(!empty($title) && !empty($image) && !empty($content) && !empty($date_created) ){

$sql = "INSERT INTO posts (title, category, date_created, image, content)
VALUES ('$title', '$category', '$date_created', '$image', '$content')";

$result = mysqli_query($conn, $sql);

/*
if(!$result){
	echo 'Greska';
} else {echo 'Sve radi!';}
*/

$success_message = 'Post successfully added.';

} else {

$error_message = 'All fields are
required!';

}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP&amp;MySQL - Add post</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<nav>
		<div class="logout">
			<a href="">Logout</a>
		</div>
	</nav>
	<div class="container">
		<h2>Add post</h2>
		<hr>
        <form action="" method="POST">
        	<p class="add-success"><?php echo $success_message; ?></p>
        	<p class="post-error"><?php echo $error_message; ?></p>
            <div class="form-group">
                <label class="label-post">Title</label><input type="text" name="title" />
            </div>
            <div class="form-group">
                <label class="label-post">Category</label><select name="category">
					<option value="1">News</option>
					<option value="2">Blog</option>
					<option value="3">Other</option>
				</select>
            </div>
            <div class="form-group">
                <label class="label-post">Path to image</label><input type="text" name="image" />
            </div>
            <div class="form-group">
                <label class="label-post">Date</label><input type="date" name="date" />
            </div>
            <div class="form-group">
                <label class="label-post" style="vertical-align: top;">Content</label><textarea type="text" name="content" rows="10" cols="80"></textarea>
            </div>
            <div class="form-group>">
                <input type="submit" name="add" class="login-button add-post" value="Insert">
            </div>
            <p>Back to <a href="dashboard.php" >Dashboard</a></p>
        </form>
    </div>
</body>
</html>