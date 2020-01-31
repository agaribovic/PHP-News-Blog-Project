<?php 

session_start();

if(!isset($_SESSION['username'])){
    exit('You must log in first!');
}

$error_message = $success_message = '';

include('include/connection.inc.php');

$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if(isset($_POST['update'])){


$id = $_GET['id'];
$title = mysqli_real_escape_string($conn, $_POST['title']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$date_created = mysqli_real_escape_string($conn, $_POST['date']);
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
$image = mysqli_real_escape_string($conn, $_POST['image']);
$content = mysqli_real_escape_string($conn, $_POST['content']);

if(!empty($title) && !empty($image) && !empty($content) && !empty($date_created) ){

$sql = "UPDATE posts SET title = '$title', category = '$category', date_created = '$date_created', image = '$image', content = '$content' WHERE id = '$id'";

$result = mysqli_query($conn, $sql);


$success_message = 'Post successfully updated.';

} else {

$error_message = 'All fields are
required!';

}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP&amp;MySQL - Edit post</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<nav>
		<div class="logout">
			<a href="logout.php">Logout</a>
		</div>
	</nav>
	<div class="container">
		<h2>Edit post</h2>
		<hr>
        <form action="" method="POST">
        	<p class="add-success"><?php echo $success_message; ?></p>
        	<p class="post-error"><?php echo $error_message; ?></p>
            <div class="form-group">
                <label class="label-post">Title</label><input type="text" name="title" value="<?php echo $row['title']; ?>"/>
            </div>
            <div class="form-group">
                <label class="label-post">Category</label><select name="category">
					<option value=<?php if ($row['category'] == 'News') echo '1 selected'; else '1'; ?>>News</option>
					<option value=<?php if ($row['category'] == 'Blog') echo '2 selected'; else '2'; ?>>Blog</option>
					<option value=<?php if ($row['category'] == 'Other') echo '3 selected'; else '3'; ?>>Other</option>
				</select>
            </div>
            <div class="form-group">
                <label class="label-post">Path to image</label><input type="text" name="image" value="<?php echo $row['image']; ?>"/>
            </div>
            <div class="form-group">
                <label class="label-post">Date</label><input type="date" name="date" value="<?php echo $row['date_created']; ?>"/>
            </div>
            <div class="form-group">
                <label class="label-post" style="vertical-align: top;">Content</label><textarea type="text" name="content" rows="10" cols="80"><?php echo $row['content']; ?></textarea>
            </div>
            <div class="form-group>">
                <input type="submit" name="update" class="login-button add-post" value="Update post">
            </div>
            <p>Back to <a href="dashboard.php">Dashboard</a></p>
        </form>
    </div>
</body>
</html>