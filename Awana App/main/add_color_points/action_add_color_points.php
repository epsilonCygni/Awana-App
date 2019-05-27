<?php
	require '../../auth.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Add Color Points</title>
	<link rel="stylesheet" type="text/css" href="">
	<script src=""></script>
</head>
<body>

	<form action='add_color_points.php' method='post'>

		<?php
			require '../../rel.php';
		?>

		<button class='ok-buttons'>OK</button>
	</form>

	<?php
		// Connect
		$conn = mysqli_connect($servername, $username, $password, $database);

		if($conn === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		$sql1 = "INSERT INTO `colors`(`week`, `red`, `blue`, `green`, `yellow`) VALUES (" .$_POST['week']. ", " .$_POST['red']. ", " .$_POST['blue']. ", " .$_POST['green']. ", " .$_POST['yellow']. ")";

		if(mysqli_query($conn, $sql1)) {
			echo "<p>Points inserted..</p>";
		} else {
			echo "<p>ERROR: Could not execute SQL ... " . mysqli_error($conn) . "</p>";
		}

		mysqli_close($conn);
	?>

</body>
</html>