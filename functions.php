<?php

function ttl($afk) {
	if(isset($_SESSION['timeout'])) {
		$ttl = time() - $_SESSION['timeout'];
		if($ttl > $afk) {
			session_destroy();
			header('Location: login.php?msg=2');
		}
	}
	
	$_SESSION['timeout'] = time();

}


?>