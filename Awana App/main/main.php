<?php
	require '../auth.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title> <?php echo "$database"; ?> </title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<script src="../script.js"></script>
</head>
<body>
	
	<form action='../index.php'>
  	<button class='back-buttons'>Back</button>
	</form>

	<!-- Add Color Points -->
	<div id='main-div'>
		<div id='add-color-points-div'>
			<form action='add_color_points/add_color_points.php' method='post'>
				<h2>Add Color Points</h2>

				<?php
					require '../rel.php';
				?>
			
				<button id='add-color-points-button'>+</button>
			</form>
		</div>

		<?php
			// Connect
			$conn = mysqli_connect($servername, $username, $password, $database);
			if($conn === false) {
				die("ERROR: Could not connect. " . mysqli_connect_error());
			}
		?>

		<!-- Add Group Points -->
		<div id='select-leader-div'>
			<h2>Add Group Points</h2>
			
			<?php
				$sql2 = "SELECT DISTINCT leader_name FROM leaders ORDER BY leader_name";
				$result = $conn->query($sql2);

				if($result->num_rows > 0) {
					// output data of each row
					// for color
					$color = 1;

					while($row = mysqli_fetch_array($result)) {
						echo "<form id='form-leaders' action='leader/leader.php' method='post'>";
							echo "<input type='hidden' name='leader' value='" .$row['leader_name']. "'>";
							
							require '../rel.php';
							
							echo "<input type='hidden' name='color' value='" .$color. "'>";

							echo "<button class='leader-button" .$color. "'>" .$row['leader_name']. "</button>";
						echo "</form>";
				
						if($color < 7) {
							$color++;
						} else {
							$color = 1;
						}
					}
				}
			?>
			
		</div>

		<!-- Create Group -->
		<div id="create-group-div">
			<form action='action_create_group.php' method='post'>
				<h2>Create New Group:</h2>
				
				<input id='leader-name-input' type='text' name='leader' placeholder='Leader(s) Name(s)' autocomplete='off'>
	
				<?php 
					require '../rel.php';
				?>

				<input id='create-group-submit' type='submit' value='Submit'>
			</form>
		</div>

		<!-- View Final Points -->
		<div id='final-points-div'>
			<form action='final_points.php' method='post'>
				
				<?php
					require '../rel.php';
				?>
				
				<button id='final-points'>Final Points (all)</button>
			</form>
		</div>
	</div>

	<?php
		mysqli_close($conn);
	?>

</body>
</html>