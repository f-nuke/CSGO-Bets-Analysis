<?php

session_start();
require_once('functions.php');

$afk = 1800;

ttl($afk);

if(isset($_GET['msg'])) {
	$msg = $_GET['msg'];

switch ($msg) {
	case '1':
		$msg = "Posted successfully.";
		break;
	case '2':
		$msg = "There was some error. Entry was not posted successfully.";
		break;
	default:
		$msg = null;
		break;
}

}

if(isset($_SESSION['auth']) && $_SESSION['auth'] == 'true') {
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Post An Entry</title>
		
	</head>
	<body>

		<?php 
			if(!empty($msg)) { ?>

				<div id="error">
					 <?php echo $msg; ?>
				</div><br>

		<?php } ?> 
		<a href="index.php" style="text-decoration: none;">Home</a><br>
		<a href="logout.php" style="text-decoration: none;">Logout</a><br><br>
		<div>
		<form name="post" action="write.php" method="post" autocomplete="off" style="border:1px solid black; width: 400px; padding: 10px;">
			<table style="table-layout:fixed; width:100%;" align="center">
				<tr>
					<td>Date:</td>
					<td><input type="text" name="date" required></td>
				</tr>

				<tr>
					<td>Team 1:</td>
					<td><input type="text" name="t1" required></td>
				</tr>
				<tr>
					<td>Team 2:</td>
					<td><input type="text" name="t2" required></td>
				</tr>
				<tr>
					<td>Money On:</td>
					<td><input type="text" name="mo" required></td>
				</tr>
				<tr>
					<td>Format:</td>
					<td><input type="text" name="format" required></td>
				</tr>
				<tr>
					<td>Bet Amount:</td>
					<td><input type="text" name="bet_am" required></td>
				</tr>
				<tr>
					<td>Winning Team:</td>
					<td><input type="text" name="wt" required></td>
				</tr>
				<tr>
					<td>Underdog: </td>
					<td>
						<input type="radio" name="underdog" value="1">Yes</input>
						<input type="radio" name="underdog" value="0">No</input>
					</td>
				</tr>
				<tr>
					<td>Bet Won/lost:</td>
					<td>
						<input type="radio" name="wld" value="1">Won</input>
						<input type="radio" name="wld" value="2">Lost</input>
					</td>
				</tr>
				<tr>
					<td>Winnings:</td>
					<td><input type="text" name="winnings" required></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Post"></td>
				</tr>
			</table>
		</form>
		</div>
	</body>
	</html>



	<?php
} else {
	header('Location: index.php');
}

?>