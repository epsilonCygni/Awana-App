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
	<title>Change Numbers (same page)</title>

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

			$sql1 = "SELECT id, `no`, kid_name FROM main_table WHERE leader_name='$leader' ORDER BY `no` ASC, `kid_name` ASC";
			$result = $conn->query($sql1);

			if($result->num_rows > 0) {

				echo "<form class='order-continue-form' id='order-continue-form' action='action_change_no_same.php' autocomplete='off' method='post'>";

				echo "<table id='order-continue-table'><tr><th>Name</th><th>No.</th></tr>";
				// output data of each row
				while($row = mysqli_fetch_array($result)) {

					$id = $row["id"];

					$y = 1;
					if($row["no"] < 777) {
						echo "<tr><td>" . $row["kid_name"] . "</td><td><b>" . $row["no"] . "</b></td></tr>";
						$y = $row["no"] + 1;
					} else if($row["no"] == 777) {
						echo "<tr><td>" . $row["kid_name"] . "</td><td><input id='order-continue-inputs' type='text' name='no" . $id . "' placeholder='" .$y. " ...'></tr>";
					}
				}

				require '../../../rel.php';
				echo "<input type='hidden' name='leader' value='" .$leader. "'>";

				echo "</table>";

				echo "<input id='submit-buttons' type='submit' value='Apply' form='order-continue-form'>";
				
				echo "</form>";

			} else {
				echo "0 results";
			}

			mysqli_close($conn);
		?>

	</div>
</body>
</html>