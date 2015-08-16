<?php
$q = $conn->query("SELECT * FROM bets");
$num_bets = $q->rowCount();

$q = $conn->prepare("SELECT * FROM bets WHERE wld = :wld");
$a = 1;
$q->bindParam(':wld', $a);
$q->execute();
$num_wins = $q->rowCount();
$a = 2;
$q->bindParam(':wld', $a);
$q->execute();
$num_loses = $q->rowCount();

$win_per = $num_wins/$num_bets * 100;
$win_per = round($win_per, 2);

$q = $conn->query("SELECT * FROM bets WHERE underdog = 1");
$num_un_bets = $q->rowCount();

$un_bets_per = $num_un_bets/$num_bets * 100;
$un_bets_per = round($un_bets_per, 2);

$q = $conn->query("SELECT * FROM bets WHERE underdog = 1 AND wld = 1");
$num_un_wins = $q->rowCount();

$un_win_per = $num_un_wins/$num_un_bets * 100;
$un_win_per = round($un_win_per, 2);

$q = $conn->query("SELECT SUM(bet_am) AS t_b_am FROM bets");
$row = $q->fetch(PDO::FETCH_ASSOC);
$total_bet_amount = round($row['t_b_am'], 2);

$q = $conn->query("SELECT SUM(winnings) AS t_w_am FROM bets");
$row = $q->fetch(PDO::FETCH_ASSOC);
$total_winnings = round($row['t_w_am'], 2);

$q = $conn->query("SELECT SUM(bet_am) AS t_ret FROM bets WHERE wld = 1");
$row = $q->fetch(PDO::FETCH_ASSOC);
$total_returned = $row['t_ret'];
$total_returned = round($total_returned, 2);

$roi = $total_winnings/$total_bet_amount * 100;
$roi = round($roi, 2);

$q = $conn->prepare("SELECT * FROM bets ORDER BY bet_am DESC")
?>
<br>

<table id="left" width="30%">
	<tr>
		<th colspan="2">Performance Overview</th>
	</tr>
	<tr>
		<td>Total Number of Bets</td>
		<td><?php echo $num_bets ?></td>
	</tr>
	<tr>
		<td>Total Number of Wins</td>
		<td><?php echo $num_wins ?></td>
	</tr>
	<tr>
		<td>Total Number of Loses</td>
		<td><?php echo $num_loses ?></td>
	</tr>
	<tr>
		<td>Win Percentage</td>
		<td><?php echo $win_per ?>%</td>	
	</tr>
	<tr>
		<td>Number of Underdog Bets</td>
		<td><?php echo $num_un_bets ?></td>
	</tr>
	<tr>
		<td>Percentage of Underdog Bets</td>
		<td><?php echo $un_bets_per ?>%</td>
	</tr>
	<tr>
		<td>Number of Underdog Wins</td>
		<td><?php echo $num_un_wins ?></td>
	</tr>
	<tr>
		<td>Underdogs Win Percentage</td>
		<td><?php echo $un_win_per ?>%</td>
	</tr>
	<tr>
		<td>Total Wagered</td>
		<td>$<?php echo $total_bet_amount ?></td>
	</tr>
	<tr>
		<td>Total Returned</td>
		<td>$<?php echo $total_returned ?></td>
	</tr>
	<tr>
		<td>Total Net Profit</td>
		<td>$<?php echo $total_winnings ?></td>
	</tr>
	<tr>
		<td>ROI</td>
		<td><?php echo $roi ?>%</td>
	</tr>
</table>
<br>
