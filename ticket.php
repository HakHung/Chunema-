<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";
if (!isset($_SESSION['username'])) {
   echo "<script>alert('Please Log In');window.location.href='login.php';</script>";
}

$date_err = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $option = isset($_POST['datepicker']) ? $_POST['datepicker'] : false;
   $_SESSION["theatre"] = $_POST['theatre'];
   $_SESSION["show"] = $_POST['show'];
   $_SESSION["date"] = $_POST['datepicker'];
   if ($option) {
      // $date = $_POST['datepicker'];
      // echo $date;
   
      header("location:movie_seat.php");
   } else {
      $date_err = "Please select a date";
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
   </style>
</head>

<body>
   <!-- movie title  -->
   <div class="movie-title">
      <?php $movieid = $_GET["myid"];
      $_SESSION["movieid"] = $movieid;
      $stmt = $pdo->prepare("SELECT moviename FROM movielist WHERE movieid=$movieid");
      $stmt->execute();
      $user = $stmt->fetch();
      ?>
      <h1><?php echo $user['moviename']; ?></h1>
   </div>
   <!-- end of movie title -->
   <div class="tab-pane fade in active" style="text-align:center">
      <form method="post">
         <h3>Theatre</h3>
         <div class="form-group">
            <label for="sel1">Select One:</label>
            <select class="form-control" id="cinema" name='theatre'>
               <?php
               $stmt = $pdo->prepare("SELECT * FROM threatre");
               $stmt->execute();
               while ($row = $stmt->fetch()) {
               ?>
                  <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
               <?php
               }; ?>
            </select>
         </div>

         <div class="form-group  <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
            <h3>Date</h3>
            <input id="datepicker" name="datepicker" type="date" class="form-control datepicker" value="<?php echo $date; ?>">
            <span class="help-block"><?php echo $date_err; ?></span>
         </div>

         <h3>Show Time</h3>
         <div class="form-group">
            <label for="sel1">Select One:</label>
            <select class="form-control" name="show">
            <?php
               $stmt = $pdo->prepare("SELECT * FROM screening WHERE movie_id=$movieid");
               $stmt->execute();
               while ($row = $stmt->fetch()) {
               ?>
                  <option value="<?php echo $row['show_time']; ?>"><?php echo $row['show_time']; ?></option>
               <?php
               }; ?>
            </select>
            <br><br>
         </div>
         <input type="submit" value="Next"></input>
      </form>
   </div>
</body>

</html>