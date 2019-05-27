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
	<title>Add Points</title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<script src="script.js"></script>

</head>
<body>

	<form action='leader.php' method='post'>
		
		<?php 
			require '../../rel.php';
			echo "<input type='hidden' name='leader' value='" .$leader. "'>";
		?>
		
		<button class='ok-buttons'>OK</button>
	</form>

	<?php
		$conn = mysqli_connect($servername, $username, $password, $database);
		if($conn === false) {
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		$sql1 = "SELECT id, `no`, kid_name, points FROM `main_table` WHERE leader_name='$leader' ORDER BY `main_table`.`no` ASC";
		$result = $conn->query($sql1);

		if($result->num_rows > 0) {

			while($row = mysqli_fetch_array($result)) {
				$id = $row["id"];

				if(!empty($_POST["points".$id])) {
					$points = $_POST["points".$id];
				} else {
					$points = 0;
				}

				$sql2 = "UPDATE main_table SET points=points+$points WHERE id=$id";

				if(mysqli_query($conn, $sql2) && !empty($_POST["points".$id])) {
					echo "<p>" . $row["kid_name"] . " :::: + " . $points . " individual points</p>";
				} elseif(mysqli_query($conn, $sql2) && $points == 0) {
					echo "<p>" . $row["kid_name"] . "</p>";
				} elseif(!mysqli_query($conn, $sql2)) {
					echo "<p>ERROR: Could not execute SQL ..." . mysqli_error($conn) . "</p>";
				}
			}
		}
		


		if(isset($_POST["week"])) {
			$last_week = $_POST['week'];
		}



		$sql3 = "SELECT red, blue, green, yellow FROM colors WHERE week=$last_week";
		$result = $conn->query($sql3);

		if($result->num_rows > 0) {

			while($row = mysqli_fetch_array($result)) {
				$red = $row['red'];

				$blue = $row['blue'];

				$green = $row['green'];

				$yellow = $row['yellow'];
			}
		}

		$sql4 = "SELECT id, `no`, kid_name, points FROM `main_table` WHERE leader_name='$leader' ORDER BY `main_table`.`no` ASC";
		$result = $conn->query($sql4);

		if($result->num_rows > 0) {
				
			while($row = mysqli_fetch_array($result)) {

				$id = $row["id"];

				if(!empty($_POST) && (($_POST["color".$id] == "R") || ($_POST["color".$id] == "r"))) {
					$color_points = $red;
				} elseif(!empty($_POST) && (($_POST["color".$id] == "B") || ($_POST["color".$id] == "b"))) {
					$color_points = $blue;
				} elseif(!empty($_POST) && (($_POST["color".$id] == "G") || ($_POST["color".$id] == "g"))) {
					$color_points = $green;
				} elseif(!empty($_POST) && (($_POST["color".$id] == "Y") || ($_POST["color".$id] == "y"))) {
					$color_points = $yellow;
				} elseif(empty($_POST["color".$id])) {
					$color_points = 0;
				} else {
					$color_points = 0;
				}

				$sql5 = "UPDATE main_table SET points=points+$color_points WHERE id=$id";

				if(mysqli_query($conn, $sql5) && !empty($_POST["color".$id]) && $color_points > 0) {
					echo "<p>" . $row["kid_name"] . " :::: + " . $color_points . " team points</p>";
				} elseif(mysqli_query($conn, $sql5) && $color_points == 0) {
					echo "<p>" . $row["kid_name"] . "</p>";
				} elseif(!mysqli_query($conn, $sql5)) {
					echo "<p>ERROR: Could not execute SQL ..." . mysqli_error($conn) . "</p>";
				}
			}
		}

		mysqli_close($conn);
	?>

</body>
</html>