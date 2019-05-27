<?php
	require '../../../auth.php';

	if(isset($_POST["leader"])) {
		$leader = $_POST["leader"];
	}
	if(isset($_POST["number"])) {
		$number = $_POST["number"];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Add kids</title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<script src="script.js"></script>

</head>
<body>

	<form action='../leader.php' method='post'>

		<?php 
			require '../../../rel.php';

			echo "<input type='hidden' name='leader' value='" .$leader. "'>";
		?>

		<button class='ok-buttons'>OK</button>
	</form>

	<?php
		// connection
		$conn = mysqli_connect($servername, $username, $password, $database);
		// verify connection
		if($conn === false) {
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}


		for($i=1; $i<=$number; $i++) {

			if(!empty($_POST["kid".$i])) {
				$kid = $_POST["kid".$i];

				$sql1 = "INSERT INTO `main_table` (`kid_name`, `leader_name`) VALUES ('$kid', '$leader')";

				if(mysqli_query($conn, $sql1) && !empty($_POST["kid".$i])) {
					echo "<p>Kid Added :::: " . $kid . "</p>";
				} elseif(!mysqli_query($conn, $sql1)) {
					echo "<p>ERROR: Could not execute SQL ..." . mysqli_error($conn) . "</p>";
				}
			}
		}

		mysqli_close($conn);
	?>

</body>
</html>