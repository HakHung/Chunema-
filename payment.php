<?php
// Initialize the session
session_start();


// Include config file
require_once "config.php";
$total_price = $_SESSION['total_price'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $seat_lists = $_SESSION['seat_list'];
   

    
    $date = date("Y/m/d");
    $userid = $_SESSION['id'];
    // insert new row data to payment table
    $sql = "INSERT INTO payment(user_id, date, price, purchase) VALUES (:userid, :date, :price,'0')";


    if ($stmt = $pdo->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":date", $param_date, PDO::PARAM_STR);
      $stmt->bindParam(":price", $param_price, PDO::PARAM_STR);
      $stmt->bindParam(":userid", $param_userid, PDO::PARAM_STR);

      // Set parameters
      $param_date = $date;
      $param_price = $total_price;
      $param_userid = $userid;


      if ($stmt->execute()) {
        echo "Result updated";
        $payment_id = $pdo->lastInsertId();
      } else {
        echo "Something went wrong. Please try again later.";
      }

     
}


    
    //insert new data into seat_reserved table
    $seat_id_list = [];
    foreach ($seat_lists as $item) {
      // echo $item;
      $screeningid = $_SESSION['screeningid'];
      $threatreid = $_SESSION['threatre_id'];
      $sql = "SELECT seat_id FROM seat WHERE seat_no = '$item' and threatre_id= '$threatreid'";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $row = $stmt->fetch();
      array_push($seat_id_list, $row['seat_id']);
        
    }
    $sql_1 = "INSERT INTO seat_reserved(seat_id, screening_id,screening_date, payment_id) 
    VALUES ( :seat_id , :screening_id,:screening_date, :payment_id)";
        if ($stmt_1 = $pdo->prepare($sql_1)) {
          // Bind variables to the prepared statement as parameters
          $stmt_1->bindParam(":seat_id", $param_seatid, PDO::PARAM_STR);
          $stmt_1->bindParam(":screening_id", $param_screeningid, PDO::PARAM_STR);
          $stmt_1->bindParam(":screening_date", $param_screeningdate, PDO::PARAM_STR);
          $stmt_1->bindParam(":payment_id", $param_payment_id, PDO::PARAM_STR);


          // Set parameters
          $param_seatid = implode(",", $seat_id_list);
          $param_screeningid = $screeningid;
          $param_screeningdate = $date;
          $param_payment_id = $payment_id;

          if ($stmt_1->execute()) {
            echo "<script>alert('Transaction Completed');window.location.href='dashboard.php';</script>";
          } else {
            echo "Something went wrong. Please try again later.";
          }
        }
  
}

        unset($stmt);
        unset($stmt_1);
        unset($pdo);
// $conn->close();
// exit();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

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
        h1{
            color:gold;
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

<body>
    <header class="header">
        <nav id="navbar" class="navbar navbar-dark bg-transparent">
            <div class="container-fluid">
                <!-- <div class="navbar-header"> -->
                <a name="top" href="dashboard.php"><img class="logo" src="images/logo1.png" alt="Chunema" width="200" height="90"></a>
                <!-- </div> -->

                <ul class="nav navbar-nav navbar-right" style="margin-right: 30px;">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $_SESSION['username']; ?>
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a href="profile.php">Profile</a></li>
                                <li><a href="cart.php">Cart</a></li>
                            </ul>
                        </li>
                        <li><a href="logout.php">Log Out</a></li>
                    <?php else : ?>
                        <li><a href="login.php">Sign In</a></li>
                        <li><a href="signup.php">Sign Up</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
    </header>

    <section class=item>                    
        <div class="container">
            <div class='row'>           
                <div class='col-md-4'></div>
                <div class='col-md-4'>
                    <h1 style="text-align: center;">Payment</h1>
                    <br>
                <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
                <form accept-charset="UTF-8" action="" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_bQQaTxnaZlzv4FnnuZ28LFHccVSaj" id="payment-form" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓" /><input name="_method" type="hidden" value="PUT" /><input name="authenticity_token" type="hidden" value="qLZ9cScer7ZxqulsUWazw4x3cSEzv899SP/7ThPCOV8=" /></div>
                    <div class='form-row'>
                    <div class='col-xs-12 form-group required'>
                        <label class='control-label'>Name on Card</label>
                        <input class='form-control' size='4' type='text' required>
                    </div>
                    </div>
                    <div class='form-row'>
                    <div class='col-xs-12 form-group card required'>
                        <label class='control-label'>Card Number</label>
                        <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                    </div>
                    </div>
                    <div class='form-row'>
                    <div class='col-xs-4 form-group cvc required'>
                        <label class='control-label'>CVC</label>
                        <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                    </div>
                    <div class='col-xs-4 form-group expiration required'>
                        <label class='control-label'>Expiration</label>
                        <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                    </div>
                    <div class='col-xs-4 form-group expiration required'>
                        <label class='control-label'>Year</label>
                        <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                    </div>
                    </div>
                    <div class='form-row'>
                    <div class='col-md-12'>
                        <div class='form-control total btn btn-info'>
                        Total:
                        <span class='amount'>RM <?php echo $total_price;?></span>
                        </div>
                    <br>
                    </div>
                    </div>
                    <br>
                    <div class='form-row'>
                    <div class='col-md-12 form-group'>
                        <button class='form-control btn btn-primary submit-button' type='submit'>Pay</button>
                    </div>
                    </div>
                    <div class='form-row'>
                    <div class='col-md-12 error form-group hide'>
                        <div class='alert-danger alert'>
                        Please correct the errors and try again.
                        </div>
                    </div>
                    </div>
                </form>
                </div>
                <div class='col-md-4'></div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <div class="container fluid text-center text-md-left ">
            <div class="row">
                <div class="col-md-2 mb-md-0 mb-2">
                    <a href="dashboard.php"><img class="logo" src="images/logo1.png" alt="" width="200" height="90" style="margin-top:10px"></a>
                    <p>5th Star Avenue, Selangor <br>
                        56500 Unimy</p>
                    <p>Call us: <a href="#">012-345 6789</a></p>
                </div>
                <div class="col-md-3 mb-md-0 mb-3">
                    <h4>Resources</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">About</a></li>
                        <li><a href="#">Chunema</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Forums</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Help Center</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-md-0 mb- 2">
                    <h4>Legal</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Security</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-md-0 mb-3">
                    <h4>Account</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Watchlist</a></li>
                        <li><a href="#">Collections</a></li>
                        <li><a href="#">User Guide</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-md-0 mb-2">
                    <h4>Newsletter</h4>
                    <p style="color:cornflowerblue">Subscribe to our newsletter system now <br> to get latest news from
                        us.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter your email...">
                    </form>
                    <a href="#" class="btn">Subscribe now <i class="ion-ios-arrow-forward"></i></a>
                </div>
            </div>
        </div>
        <div>
            <div class="backtotop">
                <p><a href="#top" id="back-to-top">Back to top <i class="ion-ios-arrow-thin-up"></i></a></p>
            </div>
        </div>
    </footer>
</body>