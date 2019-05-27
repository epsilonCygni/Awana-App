<?php
	require '../../auth.php';

 	if(isset($_POST["leader"])) {
		$leader = $_POST["leader"];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title> <?php echo "$leader"; ?> </title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<script src="script.js"></script>

	<style>
		
	</style>

</head>
<body>
	
	<form action='leader.php' method='post'>

		<?php
			require '../../rel.php';
			echo "<input type='hidden' name='leader' value='" .$leader. "'>";
		?>

		<button class='back-buttons'>Back</button>
	</form>

	<div id='main-div'>

		<h2><?php echo "$leader" ?> </h2>

		<?php
			$conn = mysqli_connect($servername, $username, $password, $database);
			if($conn === false) {
				die("ERROR: Could not connect. " . mysqli_connect_error());
			}

			$sql1 = "SELECT kid_name, points FROM `main_table` WHERE leader_name='$leader' ORDER BY `main_table`.`points` DESC";
			$result = $conn->query($sql1);

			if($result->num_rows > 0) {

				echo "<table id=''><tr><th>*</th><th>Name</th><th>Points</th><th id=''>Money</th></tr>";
				
				$x = 1;
				while($row = mysqli_fetch_array($result)) {

					$points = $row["points"];
					$money = round($points/5000);

					echo "<tr><td id=''>$x</td><td>" . $row["kid_name"] . "</td><td id=''>" . $row["points"] . "</td><td id='money'>$money</td></tr>";
				
					$x += 1;
				}

				echo "</table>";

			} else {
				echo "0 results";
			}

			mysqli_close($conn);
		?>
	
	</div>
</body>
</html>