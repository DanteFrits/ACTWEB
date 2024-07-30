<?php
session_start();

// Jika pengguna sudah login, arahkan langsung ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: pages/dashboard.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/loginpage.css">
    <title>Login</title>
</head>
<body>
<div class="container">    
    <div class="form-container">
	<img src="assets/img/acastalogo-white.webp" class="logo">
	<p class="title">Login</p>
	<form class="form" action="authenticate.php" method="POST">
		<div class="loginfill">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" placeholder="" required>
		</div>
		<div class="loginfill">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" placeholder="" required>
		</div>
		<button class="sign">Sign in</button>
	</form>
    </div>
    </form>
</body>
</html>
