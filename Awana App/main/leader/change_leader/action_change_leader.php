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
	<title></title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<script src="script.js"></script>

</head>
<body>

	<?php

		$conn = mysqli_connect($servername, $username, $password, $database);
		if($conn === false) {
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		echo "<form action='change_leader.php' method='post'>";

			require '../../../rel.php';
			echo "<input type='hidden' name='leader' value='" .$leader. "'>";
			
			echo "<button class='ok-buttons'>OK</button>";
		echo "</form>";

		if(isset($_POST["posted_kid"])) {
			$posted_kid = $_POST["posted_kid"];
		}

		if(isset($_POST["posted_leader"])) {
			$posted_leader = $_POST["posted_leader"];
		}

		$sql1 = "UPDATE main_table SET leader_name='$posted_leader', `no`=777 WHERE id=$posted_kid";

		if($conn->query($sql1)) {
			echo "<p>Kid moved to :: " . $posted_leader . "</p>";
		} else {
			echo "<p>Error: Could not execute SQL ..." . mysqli_error($conn) . "</p>";
		}

		mysqli_close($conn);
	?>

</body>
</html>