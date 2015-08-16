<?php
session_start();

if(isset($_GET['msg'])) {
	$msg = $_GET['msg'];

switch ($msg) {
	case '1':
		$msg = "Wrong Credentials.";
		break;
	case '2':
		$msg = "You have been logged out due to 30 minutes of inactivity.";
		break;
	case '3':
		$msg = "You have been logged out successfully.";
		break;
	default:
		$msg = null;
		break;
}

}

if(!isset($_SESSION['auth']) || $_SESSION['auth'] != 'true') {

	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="includes/style.css">
	</head>
	<body>

		<?php 
			if(!empty($msg)) { ?>

				<div id="error">
					 <?php echo $msg; ?>
				</div><br>

		<?php } ?> 

		<div class="login">
			<form name="login" action="auth.php" method="post" autocomplete="off">
				<table id="login" align="center">
					<tr>
						<td><b>Username</b> <span style="color:red">*</span>:</td>
						<td><input type="text" name="username" required></td>
					</tr>
					<tr>
						<td><b>Password</b> <span style="color:red">*</span>:</td>
						<td><input type="password" name="password" required></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Login" required></td>
					</tr>
				</table>
			</form>
		</div>

	</body>
	</html>
	<?php

	
} else {
	header('Location:index.php');
}
?>