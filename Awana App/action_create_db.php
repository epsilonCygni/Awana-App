<?php
    require 'auth.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo "$database"; ?></title>
    <link rel="stylesheet" type="text/css" href="">
    <script src=""></script>
</head>
<body>
    <form action='index.php'>
        <button class='ok-buttons'>OK</button>
    </form>

    <?php
        $conn = mysqli_connect($servername, $username, $password);
        if (!$conn) {
            die("Connection Failed: " . mysqli_connect_error());
        }

        $sql1 = "CREATE DATABASE `" .$database. "`";
        if (mysqli_query($conn, $sql1)) {
            echo "<p>Session Created..</p>";
        } else {
            echo "<p>Error Creating Session ... " . mysqli_error($conn) . "</p>";
        }

        // create tables..
        // first, select database just created
        $selectDB = mysqli_select_db($conn, $database);
        if (!$selectDB) {
            die("Error Selecting Session: " . mysqli_error($conn));
        }

        // create tables
        $sql2 = "CREATE TABLE `" .$database. "`.`main_table` ( `id` INT NOT NULL AUTO_INCREMENT , `kid_name` TEXT NOT NULL , `leader_name` TEXT NOT NULL , `no` INT NOT NULL DEFAULT '777' , `points` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ";
        if (mysqli_query($conn, $sql2)) {
            echo "<p>Table 1 Created..</p>";
        } else {
            echo "<p>Error Creating Table 1 ... " . mysqli_error($conn) . "</p>";
        }

        $sql3 = "CREATE TABLE `" .$database. "`.`leaders` ( `id` INT NOT NULL AUTO_INCREMENT , `leader_name` TEXT NOT NULL , PRIMARY KEY (`id`)) ";
        if (mysqli_query($conn, $sql3)) {
            echo "<p>Table 2 Created..</p>";
        } else {
            echo "<p>Error Creating Table 2 ... " . mysqli_error($conn) . "</p>";
        }

        $sql4 = "CREATE TABLE `" .$database. "`.`colors` ( `week` INT NOT NULL , `red` INT NOT NULL , `blue` INT NOT NULL , `green` INT NOT NULL , `yellow` INT NOT NULL , UNIQUE (`week`))";
        if (mysqli_query($conn, $sql4)) {
            echo "<p>Table 3 Created..</p>";
        } else {
            echo "<p>Error Creating Table 3 ... " . mysqli_error($conn) . "</p>";
        }

        mysqli_close($conn);
    ?> 
</body>
</html>