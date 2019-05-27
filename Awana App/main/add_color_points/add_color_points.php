<?php
  require '../../auth.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Color Points</title>
    <link rel="stylesheet" type="text/css" href="">
	  <script src="../script.js"></script>
</head>
<body>

  <form action='../main.php' method='post'>

    <?php
      require '../../rel.php';
    ?>	

		<button class='back-buttons'>Back</button>
	</form>

  <div id='main-div'>

    <?php
      // Connect
      $conn = mysqli_connect($servername, $username, $password, $database);
      if($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
      }

      $sql1 = "SELECT * FROM `colors`";
      $result = $conn->query($sql1);

      // $x improvisation to find the last week
      $x = 0;
      if($result->num_rows > 0) {
        echo "<table id='colors-table'><tr><th id='week-head'>week</th><th id='red-head'>Red</th><th id='blue-head'>Blue</th><th id='green-head'>Green</th><th id='yellow-head'>Yellow</th></tr>";
        
        // output data of each row
        while($row = mysqli_fetch_array($result)) {
          echo "<tr><td class='week-cells'>" . $row["week"] . "</td><td class='red-cells'>" . $row["red"] . "</td><td class='blue-cells'>" . $row["blue"] . "</td><td class='green-cells'>" . $row["green"] . "</td><td class='yellow-cells'>" . $row["yellow"] . "</td></tr>";
          $x = $row['week'];
        }
        
        $x += 1;

        echo "<form action='action_add_color_points.php' autocomplete='off' method='post'>";
          echo "<tr><td class='colors-inputs'><input id='week-input' type='text' name='week' placeholder='week' value='" .$x. "'></td><td class='colors-inputs'><input id='red-input' type='text' name='red' placeholder='red'></td><td class='colors-inputs'><input id='blue-input' type='text' name='blue' placeholder='blue'></td><td class='colors-inputs'><input id='green-input' type='text' name='green' placeholder='green'></td><td class='colors-inputs'><input id='yellow-input' type='text' name='yellow' placeholder='yellow'></td></tr>";
          
          require '../../rel.php';

        echo "</table>";

          echo "<input id='submit-buttons' type='submit' value='Apply'>";
        echo "</form>";
      } else {
        echo "<table><tr><th id='week-head'>week</th><th id='red-head'>Red</th><th id='blue-head'>Blue</th><th id='green-head'>Green</th><th id='yellow-head'>Yellow</th></tr>";

        echo "<form action='action_add_color_points.php' autocomplete='off' method='post'>";

          echo "<tr><td class='colors-inputs'><input id='week-input' type='text' name='week' placeholder='week' value='1'></td><td class='colors-inputs'><input id='red-input' type='text' name='red' placeholder='red'></td><td class='colors-inputs'><input id='blue-input' type='text' name='blue' placeholder='blue'></td><td class='colors-inputs'><input id='green-input' type='text' name='green' placeholder='green'></td><td class='colors-inputs'><input id='yellow-input' type='text' name='yellow' placeholder='yellow'></td></tr>";

          require '../../rel.php';

        echo "</table>";

          echo "<input id='submit-buttons' type='submit' value='Apply'>";
        echo "</form>";
      }
        
      mysqli_close($conn);
    ?>

  </div>
</body>
</html>