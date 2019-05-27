<?php
	require '../../../auth.php';

	if(isset($_POST["leader"])) {
		$leader = $_POST["leader"];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Move Kid</title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<script src="script.js"></script>

</head>
<body>

	<?php
		$conn = mysqli_connect($servername, $username, $password, $database);
		if($conn === false) {
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}
	?>

	<form action='../leader.php' method='post'>

		<?php 
			require '../../../rel.php';
			echo "<input type='hidden' name='leader' value='" .$leader. "'>";
		?>
		
		<button class='back-buttons'>Back</button>
	</form>

	<div id='main-div'>

		<form action='action_change_leader.php' method='post'>
			
			<div id='kid-name'>

				<?php
					$sql1 = "SELECT id, kid_name FROM main_table WHERE leader_name='$leader' ORDER BY `no` ASC, id ASC";
					$result = $conn->query($sql1);

					if($result->num_rows > 0) {

						echo "<h4>Kid's name:</h4>";

						echo "<select id='kids-select-button' name='posted_kid'>";

						while($row = mysqli_fetch_array($result)) {
							echo "<option value='" .$row["id"]. "'>" .$row["kid_name"]. "</option>";
						}
					} else {
						echo "0 results";
					}
					echo "</select>";

					echo "<i>move to ...</i>";
				?>
				
			</div>

			<div id='leader-name'>

				<?php
					$sql2 = "SELECT DISTINCT leader_name FROM main_table ORDER BY leader_name";
					$result = $conn->query($sql2);

					if($result->num_rows > 0) {
	
						echo "<h4>Leader(s) name:</h4>";

						echo "<select id='leaders-select-button' name='posted_leader'>";
		
						while($row = mysqli_fetch_array($result)) {

							if($row["leader_name"] != $leader) {
    						echo "<option value='" .$row["leader_name"]. "'>" .$row["leader_name"]. "</option>";
    					}
						}
						echo "</select>";
					} else {
		  			echo "0 results";
					}
					
					require '../../../rel.php';
					echo "<input type='hidden' name='leader' value='" .$leader. "'>";
				?>
				
					<input id='submit-buttons' type='submit' value='Move'>
			</div>
		</form>
	</div>

	<?php 
		mysqli_close($conn);
	?>
</body>
</html>