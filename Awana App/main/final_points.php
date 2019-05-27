<?php
	require '../auth.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Final Points</title>
	<link rel="stylesheet" type="text/css" href="">
	<script src=""></script>
</head>
<body>

	<form action='main.php' method='post'>

		<?php
			require '../rel.php';
		?>
		
		<button class='back-buttons'>Back</button>
	</form>

	<div id='main-div'>

		<?php
			// Connect 
			$conn = mysqli_connect($servername, $username, $password, $database);
			if($conn === false) {
				die("ERROR: Could not connect. " . mysqli_connect_error());
			}
		
			// View Points Desc 
			$sql1 = "SELECT `kid_name` , `points` FROM `main_table` ORDER BY `main_table`.`points` DESC";
			$result = $conn->query($sql1);

			if($result->num_rows > 0) {
			
				echo "<table><tr><th>*</th><th>Name</th><th>Points</th><th>Money</th></tr>";
			
				$x = 0;

				$total_points = 0;

				$min_points = infinity;
				$max_points = 0;

				while($row = mysqli_fetch_array($result)) {
					$x += 1;

					$points = $row["points"];
					$money = round($points/5000);

					if($x <= 5) {
						echo "<tr><td class='podium" .$x. "'>$x</td><td class='' id=''>" . $row["kid_name"] . "</td><td id=''>" . $row["points"] . "</td><td id='money'>$money</td></tr>";
					} else {
						echo "<tr><td>$x</td><td class='' id=''>" . $row["kid_name"] . "</td><td id=''>" . $row["points"] . "</td><td id='money'>$money</td></tr>";
					}

					$total_points += $points;

					if($min_points > $points) {
						$min_points = $points;
					}

					if($max_points < $points) {
						$max_points = $points;
					}
				}

				echo "<div id='final-results'>";
					echo "<i>(if 1 banknote = 5000 points)</i>";
					
					$min_money = round($min_points / 5000);
					echo "The least: " . $min_money . " banknotes (~" .(round($min_points / 5000) * 5000). " points)";

					$avg_points = $total_points / $x;
					$avg_money = round($avg_points / 5000);
						echo "Average: " . $avg_money . " banknotes (~" .(round($avg_points / 5000) * 5000). " points)";

					$max_money = round($max_points / 5000);
					echo "The most: " . $max_money . " banknotes (~" .(round($max_points / 5000) * 5000). " points)";
				echo "</div>";

				echo "</table>";
			} else {
				echo "0 results";
			}

			mysqli_close($conn);
		?>
		
	</div>
</body>
</html>