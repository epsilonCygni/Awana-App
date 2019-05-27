<?php
$servername = 'localhost';
$username = 'root';
$password = '';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Awana App</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script type="text/javascript" src="script.js"></script>
</head>
<body>

	<h1>Awana App</h1>

	<div id='main-div'>
		<div id='select-session-div'>
			<form action="main/main.php" method="post">
				<h2>Select Session:</h2>
				<input id="select-session-input" list="sessions" name="database" placeholder="Session Name">
					<datalist id="sessions">
					
					<?php
						$sql1="SHOW DATABASES";

						$conn = mysqli_connect($servername, $username, $password) or die ('Error connecting to mysql: ' .mysqli_error($conn). '\r\n');

						if (!($result=mysqli_query($conn, $sql1))) {
							printf("Error: %s\n", mysqli_error($conn));
						}

						while($row = mysqli_fetch_row($result)) {
							if (($row[0] != "information_schema") && ($row[0] != "mysql") && ($row[0] != "performance_schema") && ($row[0] != "phpmyadmin") && ($row[0] != "sys")) {
								echo '<option value="' .$row[0]. '">';
							}
						}
						mysqli_close($conn);
					?>

					</datalist>

				<?php
					echo '<input type="hidden" name="servername" value="' .$servername. '">';
					echo '<input type="hidden" name="username" value="' .$username. '">';
					echo '<input type="hidden" name="password" value="' .$password. '">';
				?>
					
				<input id="select-session-submit" type="submit" value="Select">
			</form>
		</div>

		<div id="create-session-div">
			<form action="action_create_db.php" autocomplete="off" method="post">
				<h2>Create Session:</h2>

				<input id="create-session-input" type="text" name="database" placeholder="Numele Sesiunii">

				<?php
					echo '<input type="hidden" name="servername" value="' .$servername. '">';
					echo '<input type="hidden" name="username" value="' .$username. '">';
					echo '<input type="hidden" name="password" value="' .$password. '">';
				?>
				
				<input id="create-session-submit" type="submit" value="Create">
			</form>
		</div>
	</div>
</body>
</html> 
