<?php 

$err = '';
session_start();

if(isset($_POST['login']))
{
   include('include/connection.inc.php');

   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($username) && !empty($password)){

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $hashedPasswordCheck = password_verify($password, $row['password']);

    if($hashedPasswordCheck) {

        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        header('Location: dashboard.php');
    
   } else {
        $err = "Username or password incorrect!";
            }

} else { 
        $err = "All fields must be filled!";
}
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="css/style.css" > 
    <title>PHP&amp;MySQL: Login | Zadaca 3</title>
</head>
<body>
    <div class="login-form">
    	<div class="login-header">
        	<h2 align="center">Login</h2>
        </div>
        <p class="error"><?php echo $err; ?></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label class="loginlabel">Username</label><input type="text" name="username" />
            </div>
            <div class="form-group">
                <label class="loginlabel">Password</label><input type="password" name="password" />
            </div>
            <div class="form-group>">
                <input type="submit" name="login" class="login-button" value="Login">
            </div>
        </form>
    </div>
</body>
</html>