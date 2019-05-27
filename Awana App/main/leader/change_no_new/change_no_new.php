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
	<title>Change Numbers (new page)</title>

	<link rel="stylesheet" type="text/css" href="style.css">
	
	<script src="script.js"></script>

</head>
<body>
	
	<form action='../leader.php' method='post'>

		<?php 
			require '../../../rel.php';
			echo "<input type='hidden' name='leader' value='" .$leader. "'>";
		?>
			
		<button class='back-buttons'>Back</button>
	</form>

	<div id='main-div'>

		<?php
			$conn = mysqli_connect($servername, $username, $password, $database);

			if($conn === false){
				die("ERROR: Could not connect. " . mysqli_connect_error());
			}

			$sql1 = "SELECT id, `kid_name` FROM `main_table` WHERE `leader_name`='$leader' ORDER BY `main_table`.`kid_name` ASC";
			$result = $conn->query($sql1);

			if($result->num_rows > 0) {
				
				echo "<form class='order-all-form' id='order-all-form' action='action_change_no_new.php' autocomplete='off' method='post'>";

					echo "<table id='order-all-table'><tr><th>Name</th><th>No.</th></tr>";

					// output data of each row
					while($row = mysqli_fetch_array($result)) {
						$id = $row["id"];

						echo "<tr><td>" . $row["kid_name"] . "</td><td><input id='order-all-inputs' type='text' name='no" . $id . "' placeholder=' '></td></tr>";
					}

					require '../../../rel.php';
					echo "<input type='hidden' name='leader' value='" .$leader. "'>";


					echo "</table>";

					echo "<input id='submit-buttons' type='submit' value='Apply' form='order-all-form'>";
					
				echo "</form>";

			} else {
				echo "0 results";
			}

			mysqli_close($conn);
		?>
	
	</div>
</body>
</html>