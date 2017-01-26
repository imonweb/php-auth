<?php 
session_start();
require 'assets/database.php';

if(isset($_SESSION['user_id']) ){
	$records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

}


 ?>

<!DOCTYPE! html>
<html lang="eng">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, iniatial-scale=1">
	<title>Welcome to your Web App</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>

<body>
<div class="header">
	<a href="index.php">Your App Name</a>
</div>

<?php if( !empty($user) ): ?>
	<br /> Welcome, <?= $user['email']; ?> 
	<br /> you are successfully logged in!
	<br><br>

	<a href="logout.php">Logout?</a>
<?php else: ?>
	
	<h1>Please Login or Register</h1>
	<a href="login.php">Login</a>
	<a href="register.php">Register</a>
</body>
<?php endif; ?>
</html>