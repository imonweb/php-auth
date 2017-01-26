<!-- YouTube devdojo Create a PHP Login Script -->
<?php 
session_start();

if(isset($_SESSION['user_id']) ){
	header("Location: index.php");
}

require 'assets/database.php';
	if(!empty($_POST['email']) && !empty($_POST['password'])) :
	 	$records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
	 	$records->bindParam(':email', $_POST['email']);
	 	$records->execute();
	 	$results = $records->fetch(PDO::FETCH_ASSOC);

	 	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){
	 		$_SESSION['user_id'] = $results['id'];
	 		header("Location: index.php");
	 	} else {
	 		$message = 'Sorry, those credentials do not match';
	 	}

	endif;
	
	
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Below</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>
<body>

<div class="header">
	<a href="index.php">Your App Name</a>
</div>
<h1>Login</h1>
<span>or <a href="register.php">Register here</a></span>

<form action="login.php" method="post">
	<input type="text" placeholder="Enter email" name="email">
	<input type="password" placeholder="Enter password" name="password">
	<input type="submit">
</form>
	
</body>
</html>