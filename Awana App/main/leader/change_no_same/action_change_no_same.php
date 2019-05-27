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
	
		<button class='ok-buttons'>OK</button>
	</form>

	<?php
		$conn = mysqli_connect($servername, $username, $password, $database);
		if($conn === false) {
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		$sql1 = "SELECT id, `no`, kid_name FROM main_table WHERE leader_name='$leader' ORDER BY `no` ASC, `id` ASC";
		$result = $conn->query($sql1);

		while($row = mysqli_fetch_array($result)) {
			$id = $row["id"];

			if(!empty($_POST["no".$id])) {
				
				$no = $_POST["no".$id];

				$sql2 = "UPDATE main_table SET no=$no WHERE id=$id and leader_name='$leader'";

				if(mysqli_query($conn, $sql2)) {
					echo "<p>" . $row["kid_name"] . " :::: Number changed to :: " . $no . "</p>";
				} elseif(!mysqli_query($conn, $sql2)) {
					echo "<p>ERROR: Could not execute SQL ..." . mysqli_error($conn) . "</p>";
				}	
			}
		}

		mysqli_close($conn);
	?>

</body>
</html>