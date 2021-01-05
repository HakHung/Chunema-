<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";


$date_err = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $option = isset($_POST['show']) ? $_POST['show'] : false;
   
   $_SESSION["showtime"] = $_POST['show'];
   if ($option) {
      header("location:movie_seat.php");
   } else {
      $date_err = "Please select a showtime";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


   <title>Movie Seat Selection</title>
   <style>
      body {
         background-color: #242333;
         color: #fff;
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         height: 100vh;
         font-family: 'Lato', sans-serif;
         margin: 0;
      }

      h1 {
         color: gold;
      }

      input{
         background-color: blue;
      }

   </style>

</head>

<body>
   <!-- movie title  -->
   <div class="movie-title" style="text-align:center">
    <?php
    $movieid = $_SESSION["movieid"];
    $stmt = $pdo->prepare("SELECT moviename FROM movielist WHERE movieid=$movieid");
    $stmt->execute([$movieid]);
    $user = $stmt->fetch();
    $threatre = $_SESSION['theatre'];
    ?>
    <h1><?php echo $user['moviename']; ?></h1>
    <h4><?php echo $threatre .  "&nbsp" . $_SESSION["date"]; ?></h4>
  </div>
  <!-- end of movie title -->
  <?php
  $stmt = $pdo->prepare("SELECT threatre_id FROM threatre WHERE threatre.name = '$threatre'");
  $stmt->execute();
  $user = $stmt->fetch();
  $threatreid = $user['threatre_id'];
  ?>
   <!-- end of movie title -->
   <div class="tab-pane fade in active" style="text-align:center">
      <form method="post">
      <h3>Show Time</h3>
        <div class="form-group">
          <label for="sel1">Select One:</label>
          <select class="form-control" name="show">
            <?php

            $stmt1 = $pdo->prepare("SELECT * FROM screening WHERE movie_id=$movieid AND threatre_id='$threatreid'");
            $stmt1->execute();
            while ($row = $stmt1->fetch()) {
            ?>
              <option value="<?php echo $row['show_time']; ?>"><?php echo $row['show_time']; ?></option>
            <?php
            }; 
            
            unset($stmt);
            unset($stmt1);
            unset($pdo);
            ?>
          </select>
        </div>
         <input type="submit" value="Next"></input>
      </form>
   </div>
</body>

</html>