<?php
// Initialize the session
session_start();


// Include config file
require_once "config.php";

$seating_err = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $seat_id_list = filter_input(INPUT_POST, 'display');
  if (empty($seat_id_list)) {
    // echo "Please choose your seat to proceed!<br>";
    // if(empty(trim($_POST["display"]))){
    $seating_err = "Please choose your seat to proceed!";
  } else {
    $items = preg_split("/[\s,]+/", $seat_id_list);
    $price = (float)filter_input(INPUT_POST, 'price');
    $date = date("Y/m/d");

    // insert new row data to payment table
    $sql = "INSERT INTO payment(user_id, date, price, purchase) VALUES ('1', :date, :price,'0')";


    if ($stmt = $pdo->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":date", $param_date, PDO::PARAM_STR);
      $stmt->bindParam(":price", $param_price, PDO::PARAM_STR);


      // Set parameters
      $param_date = $date;
      $param_price = $price;


      if ($stmt->execute()) {
        // Redirect to login page
        echo "Result updated";
        $payment_id = $pdo->lastInsertId();
      } else {
        echo "Something went wrong. Please try again later.";
      }
    }


    // echo $payment_id;

    //insert new data into seat_reserved table
    foreach ($items as $item) {
      // echo $item;
      $sql = "SELECT seat_id FROM seat WHERE seat_no = '$item' and screening_id= '1'";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();


      while ($row = $stmt->fetch()) {

        $sql_1 = "INSERT INTO seat_reserved(seat_id, screening_id, payment_id) VALUES ( :seat_id ,'1', :payment_id)";
        if ($stmt_1 = $pdo->prepare($sql_1)) {
          // Bind variables to the prepared statement as parameters
          $stmt_1->bindParam(":seat_id", $param_item, PDO::PARAM_STR);
          $stmt_1->bindParam(":payment_id", $param_payment_id, PDO::PARAM_STR);


          // Set parameters
          $param_item = $row['seat_id'];
          $param_payment_id = $payment_id;

          if ($stmt_1->execute()) {

            echo "Result updated";
          } else {
            echo "Something went wrong. Please try again later.";
          }
        }
      }
    }
  }
}

// header('Location: cart.html');
// $conn->close();
// exit();

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
    .seat {
      background-color: white;
      color: black;
      font-size: 12px;
      height: 15px;
      width: 17px;
      margin: 4px;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
      border-spacing: 15px;
      display: inline-block;
      text-align: center;
    }

    .seat.selected {
      background-color: blue;
    }

    .seat.occupied {
      background-color: red;

    }

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

    .legend {
      background: rgba(0, 0, 0, 0.1);
      padding: 5px 10px;
      border-radius: 5px;
      color: whitesmoke;
      list-style-type: none;
      display: flex;
      justify-content: space-between;
    }

    .legend li {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 10px;
    }

    .legend li small {
      margin-left: 2px;
    }

    .row {
      display: flex;
      justify-content: center;
    }

    .screen {
      background-color: black;
      height: 100px;
      width: 100%;
      margin: 15px 0;
      transform: rotateX(-45deg);
      box-shadow: 0 3px 10px rgba(255, 255, 255, 0.7);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: large;
    }

    .submission {
      margin-left: 15px;
      margin-right: 15px;
      background-color: grey;
      align-self: center;
    }

    .info-row {
      display: inline;
      text-align: center;
      padding: 10px;
    }

    .text-row {
      padding: 10px;
    }


    .input-field {
      text-align: left;
      width: 30%;
      padding: 0px 0x;
      margin: 8px;
      box-sizing: border-box;
      color: black;
      display: inline-block;
    }

    h1 {
      color: gold;
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

  <div style="text-align:center">
    <form method="post">
      <h3>Seating</h3>
      <div>
        <ul class="legend">
          <li>
            <div class="seat"></div>
            <small>Available</small>
          </li>
          <li>
            <div class="seat selected"></div>
            <small>Selected</small>
          </li>
          <li>
            <div class="seat occupied"></div>
            <small>Occupied</small>
          </li>
        </ul>
      </div>

      <div class="threatre">
        <div class="screen">Screen</div>

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
            }; ?>
          </select>
          <br><br>
        </div>
        <!-- <form method="post" action="seat_selection.php"> -->
        <?php

        $stmt_1 = $pdo->prepare("SELECT * FROM seat WHERE screening_id =1");
        $stmt_1->execute();


        $number_row  = $stmt_1->rowCount();
        $counter = 1;
        while ($row_1 = $stmt_1->fetch()) {
          $stmt_2 = $pdo->prepare("SELECT seat_id FROM seat_reserved WHERE screening_id = 1");
          $stmt_2->execute();

          $occupied_bool = false;

          if ($counter % 6 == 0 || $counter == 1) {
            echo "<div class='row'>\n";
          }

          while ($row_2 = $stmt_2->fetch()) {
            if ($row_2["seat_id"] == $row_1["seat_id"]) {
              $occupied_bool = true;
              break;
            }
          }


          if ($occupied_bool) {
            echo "<div class='seat occupied' id='{$row_1['seat_no']}'>" . $row_1["seat_no"] . "</div>\n";
          } else {
            echo "<div value='{$row_1['seat_no']}' class='seat' id='{$row_1['seat_no']}'  onclick='javascript:choose_seat(id)'>"
              . $row_1["seat_no"] . "</div>\n";
          }

          if ($counter % 5 == 0 || $counter == $number_row) {
            echo "</div>\n";
          }

          $counter += 1;
        }
        unset($stmt_1);
        unset($stmt_2);
        unset($pdo);
        ?>

        <div class="info-row">
          <div class="text-row">
            <div class="form-group <?php echo (!empty($seating_err)) ? 'has-error' : ''; ?>">
              <label for="display">Seat Number Selected:</label>
              <input type="text" class="input-field" name="display" id="display" value="" readonly></input>
              <span class="help-block"><?php echo $seating_err; ?></span>
            </div>
          </div>
          <div class="text-row">
            <label for="display">Total Seat Selected:</label>
            <input type="text" class="input-field" name="count" id="count" value="0" readonly></input>
            <div>
              <!-- <div class="text-row">
                <label for="display">Total Price: $</label>
                <input type="text" class="input-field" name="price" id="price" value="0" readonly></input>
              </div> -->
              <div>
                <button class="submission" type="submit">Check Out</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <script>
    "use strict"
    let seat_sel = new Array();

    function choose_seat(id) {

      let seat_select = document.getElementById(id);
      let display_scr = document.getElementById("display");
      let seat_count = document.getElementById("count");
      let total_price = document.getElementById("price");
      if (seat_select.classList.contains("selected")) {
        seat_select.classList.remove("selected");
        seat_count.value = parseInt(seat_count.value) - 1;
        total_price.value = parseFloat(total_price.value) - 8.5
        var index = seat_sel.indexOf(id);

        if (index > -1) {
          seat_sel.splice(index, 1);
        }
        display_scr.value = seat_sel;

      } else {
        seat_select.classList.add("selected");
        seat_count.value = parseInt(seat_count.value) + 1;
        total_price.value = parseFloat(total_price.value) + 8.5;
        seat_sel[seat_sel.length] = id;
        console.log(seat_sel);
        display_scr.value = seat_sel;
      }
    }
  </script>
</body>

</html>