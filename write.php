<?php
session_start();

require_once('functions.php');
require_once('includes/connection.php');

$afk = 1800;

ttl($afk);

if(isset($_SESSION['auth']) && $_SESSION['auth'] == 'true') {

	$date = $_POST['date'];
	$t1 = $_POST['t1'];
	$t2 = $_POST['t2'];
	$mo = $_POST['mo'];
	$format = $_POST['format'];
	$bet_am = $_POST['bet_am'];
	$wt = $_POST['wt'];
	$underdog = $_POST['underdog'];
	$wld = $_POST['wld'];
	$winnings = $_POST['winnings'];

	$q = $conn->prepare("INSERT INTO bets VALUES ('' ,:date, :t1, :t2, :mo, :format, :bet_am, :wt, :underdog, :wld, :winnings)");
	$q->bindParam(':date', $date);
	$q->bindParam(':t1', $t1);
	$q->bindParam(':t2', $t2);
	$q->bindParam(':mo', $mo);
	$q->bindParam(':format', $format);
	$q->bindParam(':bet_am', $bet_am);
	$q->bindParam(':wt', $wt);
	$q->bindParam(':underdog', $underdog);
	$q->bindParam(':wld', $wld);
	$q->bindParam(':winnings', $winnings);
	$status = $q->execute();
	
	if($status) {
		header('Location:post.php?msg=1');
	} else {
		header('Location:post.php?msg=2');
	}

} else {
	header('Location: login.php');
}