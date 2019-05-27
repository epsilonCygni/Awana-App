<?php
	require '../../auth.php';

 	if(isset($_POST["leader"])) {
		$leader = $_POST["leader"];
	}

	if(isset($_POST["color"])) {
		$colorNumber = $_POST["color"];
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title> <?php echo "$leader"; ?> </title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="../script.js"></script>
</head>
<body>
	
	<form action='../main.php' method='post'>

		<?php 
			require '../../rel.php';
		?>

		<button class='back-buttons'>Back</button>
	</form>

	<div id='main-div'>

		<?php
			if($colorNumber==1) {
				$color = '#E33B2C';
			} elseif($colorNumber==2) {
				$color = '#DF8620';
			} elseif($colorNumber==3) {
				$color = '#E3CA3A';
			} elseif($colorNumber==4) {
				$color = '#90B743';
			} elseif($colorNumber==5) {
				$color = '#346AA7';
			} elseif($colorNumber==6) {
				$color = '#5239C1';
			} elseif($colorNumber==7) {
				$color = '#8B1887';
			}

			echo "<h2>Leader(s): <h1 id='leader-h1' style='color:" .$color. "'>$leader</h1></h2>";
		?>

		<div id='leader-table-div'>

			<?php
				// Connect
				$conn = mysqli_connect($servername, $username, $password, $database);
				if($conn === false) {
					die("ERROR: Could not connect. " . mysqli_connect_error());
				}

				$sql2 = "SELECT week FROM colors";

				$result = $conn->query($sql2);
			
				$last_week = 0;
				if($result->num_rows > 0) {
					while($row = mysqli_fetch_array($result)) {
						$last_week = $row['week'];
					}
				}

				$sql1 = "SELECT id, `no`, kid_name, points FROM `main_table` WHERE leader_name='$leader' ORDER BY `main_table`.`no` ASC";
				$result = $conn->query($sql1);

				if($result->num_rows > 0) {
		
					// <form>
					echo "<form class='points-form' id='points-form' action='action_add_points.php' autocomplete='off' method='post'>";

					echo "<table id='leader-table'><tr><th>No.</th><th>Name</th><th>Points</th><th id='color-head'>Color</th><th id='points-head'>Points</th><th id='week-head'>Week:<input id='week-input' type='text' name='week' value=" .$last_week. "></th></tr>";
				
					while($row = mysqli_fetch_array($result)) {
						$no = $row["no"];
						$id = $row["id"];

						if($no != 777) {
							$style_kids = 'kids-in';
						} elseif($no = 777) {
							$style_kids = 'kids-out';
						}

						if($no != 777) {
			
							$style_colors = 'colors-in';
							$style_points = 'points-in';

							echo "<tr><td id=$style_kids>" . $row["no"] . "</td><td class='name-table' id=$style_kids>" . $row["kid_name"] . "</td><td id=$style_kids>" . $row["points"] . "</td><td id=$style_colors><input id='colors-inputs' type='text' name='color" .$id. "' placeholder='" . $no . "'></td><td id=$style_points><input id='points-inputs' type='text' name='points" . $id . "' placeholder='" . $no . "'></td></tr>";
						} elseif($no = 777) {
							echo "<tr><td id=$style_kids></td><td class='name-table' id=$style_kids>" . $row["kid_name"] . "</td><td id=$style_kids>" . $row["points"] . "</td></tr>";
						}
					}

						require '../../rel.php';

						echo "<input type='hidden' name='leader' value='" .$leader. "''>";

						echo "</table>";

						echo '<input id="submit-button-leader" type="submit" value="Add Points" form="points-form">';
					echo '</form>';
				}	
			?>

		</div>

		<!-- Add Kids -->
		<div id='leader-side-div'>

			<form action='add_kids/add_kids.php' method='post'>
				<h2>Add Kids:</h2>

				<input id='add-kids-number-input' type='number' name='number' placeholder='How many?' autocomplete='off'>

				<?php 
					require '../../rel.php';

					echo "<input type='hidden' name='leader' value='" .$leader. "'>";
				?>

				<input id='add-kids-submit' type='submit' value='Next'>
			</form>

			<!-- Change Numbers (new page) -->
			<form action='change_no_new/change_no_new.php' method='post'>

				<?php 
					require '../../rel.php';
					
					echo "<input type='hidden' name='leader' value='" .$leader. "'>";
				?>

				<button id='change-no-new-button'>Change order/numbers (new page)</button>
			</form>

			<!-- Change Numbers (same page) -->
			<form action='change_no_same/change_no_same.php' method='post'>
				
				<?php 
					require '../../rel.php';

					echo "<input type='hidden' name='leader' value='" .$leader. "'>";
				?>

				<button id='change-no-same-button'>Change order/numbers (same page)</button>
			</form>

			<!-- Change Numbers (individual) -->
			<form action='change_no_individual/change_no_individual.php' method='post'>

				<?php 
					require '../../rel.php';

					echo "<input type='hidden' name='leader' value='" .$leader. "'>";
				?>

				<button id='change-no-individual-button'>Change order/numbers (individually)</button>
			</form>

			<!-- Change Leader -->
			<form action='change_leader/change_leader.php' method='post'>

				<?php 
					require '../../rel.php';

					echo "<input type='hidden' name='leader' value='" .$leader. "'>";
				?>
				
				<button id='change-leader-button'>Move Kid</button>
			</form>

			<!-- View Final Points (leader) -->
			<form action='leader_final_points.php' method='post'>

				<?php 
					require '../../rel.php';

					echo "<input type='hidden' name='leader' value='" .$leader. "'>";
				?>
			
				<button id='leader-final-points'>Final Points (this leader)</button>
			</form>
		</div>
	</div>
	
	<?php
		mysqli_close($conn);
	?>

</body>
</html>