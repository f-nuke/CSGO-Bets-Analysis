<?php
session_start();
require_once('settings.php');

if(isset($_POST['username'], $_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username == $user && $password == $pass) {
		$_SESSION['auth'] = 'true';
		$_SESSION['user'] = $username;
		header('Location: index.php');
	} else {
		header('Location: login.php?msg=1');
	}
} else {
	echo 'no';
}