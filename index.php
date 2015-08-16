<?php
session_start();
require_once('functions.php');
require_once('includes/connection.php');

$afk = 1800;

ttl($afk);


if(isset($_SESSION['auth']) && $_SESSION['auth'] == 'true') {
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>CS:GO Bets</title>
		<style>

			* {
				font-family: verdana;
			}

			.login {
				border: 1px solid black;
				width: 310px;
				height: 120px;
				margin: auto;
			}

			table#login td {
				padding: 5px;
			}

			#error {
				background-color: #FFE6E6;
				color: #FF3333;
				text-align: center;
				margin: auto;
				padding: 10px;
				border:1px solid black;
			}

			#nav {
				text-align: center;
				font-size: 24px;
				border: 1px solid black;
				padding: 10px;
				background-color: #E6F5E6;

			}

			#nav, a {
				text-decoration: none;
				color: black;
			}

			#nav:hover {
				background-color: #66C266;
			}

			#logout a {
				text-decoration: none;
				padding: 5px;
				float: right;
				font-weight: bold;
			}

			table {
				border-collapse: collapse;
			}

			table, th, td {
				border: 1px solid black;
				padding: 5px;
			}

			table.one {
				float: left;
				width: 100%;
			}

			table tr:hover td {
				background-color: #F0F0FF;
			}

		</style>
	</head>
	<body>
		<a href="post.php"><div id="nav">Post An Entry</div></a><br>
		<div id="logout"><a href="logout.php">Logout</a></div><br><br>
		<hr>
		<?php require_once('ov.php'); ?>
		<div id="table">
			<table class="one">
				<tr> 
					<th>Date</th>
					<th>Team #1</th> 
					<th>Team #2</th> 
					<th>Money On</th> 
					<th>Format</th>	
					<th>Bet Amount</th> 
					<th>Winning Team</th> 
					<th>Bet on UG</th> 
					<th>Bet Won/Lost/Draw</th>
					<th>Winnings</th>
				</tr>
		
	<?php

		$q = $conn->query("SELECT * FROM bets ORDER BY id DESC");
		$result = $q->fetchAll();

		foreach ($result as $row) { 
			switch ($row['underdog']) {
				case '1':
					$row['underdog'] = 'YES';
					break;
				case '0':
					$row['underdog'] = 'NO';
					break;
				default:
					$row['underdog'] = '';
					break;

				}
			switch ($row['wld']) {
				case '1':
					$row['wld'] = '<td bgcolor="#66C266">WIN</td>';
					break;
				case '2':
					$row['wld'] = '<td bgcolor="#FF6666">LOST</span>';
					break;
 				default:
					$row['wld'] = '';
					break;
			}
			
			?>

			<tr><td><?php echo $row['date'] ?></td>
			<td><?php echo $row['team_1'] ?></td>
			<td><?php echo $row['team_2'] ?></td>
			<td><?php echo $row['mo'] ?></td>
			<td><?php echo $row['format'] ?></td>
			<td>$<?php echo $row['bet_am'] ?></td>
			<td><?php echo $row['wt'] ?></td>
			<td><?php echo $row['underdog'] ?></td>
			<?php echo $row['wld'] ?>
			<td>$<?php echo $row['winnings'] ?></td></tr>


		<?php
		 }

		

	?>
		</table>
		</div>
	</body>
	</html>

	<?php
} else {
	header('Location:login.php');
}

?>