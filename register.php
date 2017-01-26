<?php 
 
session_start();

if(isset($_SESSION['user_id']) ){
	header("Location: index.php");
}
 
require 'assets/database.php';
$message = ''; 
if(!empty($_POST['email']) && !empty($_POST['password'])) :
	// Enter the new user  in the database
	$sql = "INSERT INTO users (email,password) VALUES (:email, :password)";
	$stmt = $conn->prepare($sql);

	$passw = password_hash($_POST['password'],PASSWORD_BCRYPT);

	$stmt->bindParam(':email',$_POST['email']);	 	
	$stmt->bindParam(':password',$passw);	 

	if( $stmt->execute() ):
		$message = 'Successfully created new user';
	else: 
		$message = 'Sorry there must have been an issue creating your account';
	endif;
endif;


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register Below</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>
<body>
<div class="header">
	<a href="index.php">Your App Name</a>
</div>
<?php if(!empty($message)): ?>
	<p><?php echo $message; ?></p>
<?php endif; ?>
<h1>Register</h1>
<span>or <a href="login.php">Login here</a></span>

<form action="register.php" method="post">
	<input type="text" placeholder="Enter email" name="email">
	<input type="password" placeholder="Enter password" name="password">
	<input type="password" placeholder="Confirm password" name="confirm_password">
	<input type="submit">
</form>

</body>
</html>