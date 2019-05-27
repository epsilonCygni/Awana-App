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
	<title>Add Kids</title>

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
			// connection
			$conn = mysqli_connect($servername, $username, $password, $database);
			// verify connection
			if($conn === false) {
				die("ERROR: Could not connect. " . mysqli_connect_error());
			}
		
			echo "<h3>Leader(s): " . $leader . "</h3>";
			echo "<h3>Kids:</h3>";
			echo "<form id='add-kids-form' action='action_add_kids.php' method='post' autocomplete='off'>";
			
				for($i=1; $i<=$number; $i++) {
					echo "<input class='add-kids-inputs' type='text' name='kid" .$i. "' placeholder='Kids`s Name'>";
				}

				require '../../../rel.php';
				
				echo "<input type='hidden' name='leader' value='" .$leader. "'>";
				echo "<input type='hidden' name='number' value='" .$number. "'>";

				echo "<input id='submit-buttons' type='submit' form='add-kids-form' value='Add'>";
			echo "</form>";


			mysqli_close($conn);
		?>	

	</div>
</body>
</html>