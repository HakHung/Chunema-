<?php
// Initialize the session
session_start();


// Include config file
require_once "config.php";

$userid = $_SESSION['id'];
$seatreserved_id = $_SESSION['seat_list'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    header("location:payment.php");
}

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            background: url('images/uploads/ft-bg.jpg') no-repeat;
            font: 14px sans-serif;
            background-color: black;
        }

        section {
            background-color: black;
            padding: 60px;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
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

        h2 {
            color: gold;
            padding-bottom: 10px;
        }

        label {
            color: yellow;
            padding-bottom: 10px;
        }

        p {
            color: white;
            padding-bottom: 10px;
        }

        @media screen and (max-width: 600px) {
            #navbar {
                width: 30%;
            }

            .container {
                text-align: left;
            }
        }

        @media screen and (max-width: 1000px) {
            .container {
                text-align: left;
            }
        }
    </style>
</head>

<!-- BEGIN | Header -->

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
    <!-- END | Header -->


    <section clas="item">    
            <h2>Purchase Details</h2>
            <form method="post">
            <?php
            $movieid = $_SESSION["movieid"];
            $stmt = $pdo->prepare("SELECT moviename FROM movielist WHERE movieid=$movieid");
            $stmt->execute([$movieid]);
            $user = $stmt->fetch();
            ?>
                <div class="form-group">
                    <label> Moviename </label>
                    <input type="text" name="moviename" class="form-control" value="<?php echo $user['moviename']; ?>" readonly>
                </div>
                </div class="form-group">
                    <label> Showtime </label>
                    <input type="text" name="showtime" class="form-control" value="<?php echo $_SESSION['showtime']; ?>" readonly>
                </div><br>
                <div class="form-group">
                    <label> Theatre </label>
                    <input type="text" name="theatre" class="form-control" value="<?php echo $_SESSION['theatre'];; ?>" readonly>
                </div>
                <div class="form-group">
                <?php
                 $seat_lists = $_SESSION['seat_list'];
                 $total_price =0;
                 foreach($seat_lists as $seat_list){
                    $total_price += 8.5;
                    }
                    $_SESSION['total_price'] = $total_price;
                ?>
                    <label> Seats </label>
                    <input type="text" name="seats" class="form-control" value="<?php echo implode(",",$seat_lists); ?>" readonly>
                </div>
                <div class="form-group">
                    <label> Total Price </label>
                    <input type="text" name="total-price" class="form-control" value="RM <?php echo $total_price;; ?>" readonly>
                </div>
                <div class="form-group">
                    <button>Proceed to payment</button>
                    <button ><a href="dashboard.php">Cancel</a></button>   
                </div>
            </form>     
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
                    <a href="#" class="btn">Subscribe now </a>
                </div>
            </div>
        </div>
        <div>
            <div class="backtotop">
                <a href="#top" id="back-to-top">Back to top </a>
            </div>
        </div>
    </footer>
    <!--<?php
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
            echo "<tr ><td >" . $row['purchase'] . "</td><td>" . $row["price"] . "</td></tr>";
        }
        echo "<tr ><td></td><td></td></tr></table>";
        ?><br> -->

        <script type="text/javascript">
        "use strict"
            document.getElementById("clc").onclick = function () {
                location.href = "dashboard.php";
            };
        </script>
</body>

</html>