<?php
    require '../auth.php';

    if(isset($_POST["leader"])) {
	    $leader = $_POST["leader"];
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Create Group</title>
	<link rel="stylesheet" type="text/css" href="">
	<script src=""></script>
</head>
<body>

    <form action='main.php' method='post'>

        <?php
            require '../rel.php';
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

	    $sql1 = "INSERT INTO `leaders` (`leader_name`) VALUES ('$leader')";

	    if(mysqli_query($conn, $sql1)) {
		    echo "<p>Group Created...</p>";
	    } elseif(!mysqli_query($conn, $sql2)) {
		    echo "<p>ERROR: Could not execute SQL ... " . mysqli_error($conn) . "</p>";
	    }

        mysqli_close($conn);
    ?>

</body>
</html>