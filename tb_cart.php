
<?php
// Initialize the session
session_start();


// Include config file
require_once "config.php";

   


?>

<!doctype html>
<html>

<head>
<meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ 
            background: url('images/uploads/ft-bg.jpg') no-repeat;
            font: 14px sans-serif;
            background-color: black;
        }
        section {
            background-color: black;
            padding: 60px;
        }
        .wrapper{ 
            width: 350px; padding: 20px; 
        }
        footer {
            position: static;
            bottom: 0;
            width: 100%;
            color: lightblue;
            text-align: center;
        }
        footer {
            background: url('images/uploads/ft-bg.jpg') no-repeat;
            background-position: center;
        }
        h2{
            color: gold;
            padding-bottom: 10px;
        }
        label{
            color: yellow;
            padding-bottom: 10px;
        }
        p{
            color: white;
            padding-bottom: 10px;
        }
    </style>
</head>

<style>
    .container{
        margin-left: auto;
  margin-right: auto;
    }

</style>

    <!-- BEGIN | Header -->
<body>
    <header class="header">
        <nav id="navbar" class="navbar navbar-dark bg-transparent">
            <div class="container-fluid">
                <!-- <div class="navbar-header"> -->
                <a name="top" href="dashboard.php"><img class="logo" src="images/logo1.png" alt="Chunema" width="200" height="90"></a>
                <!-- </div> -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- END | Header -->


    <section clas="item">    
        <div class="wrapper">
            <h2>Purchase Details</h2>
            <?php

$stmt = $pdo->prepare("SELECT * FROM payment");
$stmt->execute();
 $number_row  = $stmt->rowCount();
 $counter = 1;
 $color = '';
 $color = "style='background-color :  #acc5f3';";
 $size = "width=100%;";
  echo "<table $color $size> ";
  echo "<tr><th>Ticket</th><th>Total</th></tr>";

  // set the resulting array to associative
 while ($row = $stmt->fetch()) {
     //  echo "price: " . $row["price"];

 // echo "<table $color>";
 echo "<tr ><td >" . $row['purchase']. "</td><td>" . $row["price"]. "</td></tr>";
}
 echo "<tr ><td></td><td></td></tr></table>";
?>
  <br>
    <button>Proceed to payment</button>
    <button>Cancel</button>

            
        </div>
    </section>

<footer id="footer">

<a href="dashboard.php"><img class="logo" src="images/logo1.png" alt="" width="200" height="90" style="margin-top:10px"></a>
</footer>


    




</body>

</html>
