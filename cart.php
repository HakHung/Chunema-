<?php

session_start();

require_once "config.php";

$userid = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cart</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Mobile specific meta -->
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone-no">
    <style>

        #navbar {
            width: 100%;
            margin-top: 30px;
            margin-left: 30px;
            display: block;
            transition: top 0.3s;
        }

        #navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        footer {
            position: static;
            bottom: 0;
            width: 100%;
            color: lightblue;
            text-align: center;
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

        footer {
            background: url('images/uploads/ft-bg.jpg') no-repeat;
            background-position: center;

        }
        body {
            font: 14px sans-serif;
            background: url('images/uploads/ft-bg.jpg') no-repeat;
            background-color: black;
            height:50%;
        }

        .wrapper {
            width: 100%;
            padding:50px;
            justify-content: center;
        }

        #movie-table {
            width: 80%;

        }

        .table-head {
            border: 2px solid black;
            border-collapse: collapse;
            width: 10%;
            text-align: center;
            font-size: 15px;
            padding: 5px;
            color: black;
            background-color: white;
        }

        .table-title {
            border: 3px solid black;
            width: 10%;
            text-align: start;
            font-size: 50px;
            padding: 5px;
            color: black;
            background-color: grey;
        }


        .table-data {
            border: 1px solid black;
            border-collapse: collapse;
            width: 10%;
            text-align: center;
            padding: 5px;
            color: black;
            background-color: white;
        }



        #button-area {
            padding: 10px;
            float: right;
        }
    </style>
</head>

<body>
    <!-- BEGIN | Header -->
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
                                <li><a href="account.php">Profile</a></li>
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
    <div class="wrapper">

        <table id="">
            <tr class="table-row">
                <th class="table-title" colspan="7">Cart</th>
            </tr>
            <tr class="table-row">
                <th class="table-head">Payment ID</th>
                <th class="table-head">Movie Name</th>
                <th class="table-head">Show Date</th>
                <th class="table-head">Show Time</th>
                <th class="table-head">Threatre</th>
                <th class="table-head">Seat Number</th>

                <th class="table-head">Total Price</th>
            </tr>
            <?php


            $stmt = $pdo->prepare("SELECT * FROM payment WHERE user_id = '$userid'");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td class='table-data'>" . $row['payment_id'] . "</td>\n";
                $paymentid = $row['payment_id'];
                $stmt_1 = $pdo->prepare("SELECT * FROM seat_reserved WHERE payment_id = '$paymentid'");
                $stmt_1->execute();
                while ($row_1 = $stmt_1->fetch()) {

                    // echo $row_1['screening_id'];
                    $screeningid = $row_1['screening_id'];
                    $stmt_2 = $pdo->prepare("SELECT * FROM screening WHERE screening_id = '$screeningid'");
                    $stmt_2->execute();
                    while ($row_2 = $stmt_2->fetch()) {
                        $movieid = $row_2['movie_id'];
                        $stmt_3 = $pdo->prepare("SELECT moviename FROM movielist WHERE movieid = '$movieid'");
                        $stmt_3->execute();
                        while ($row_3 = $stmt_3->fetch()) {
                            echo "<td class='table-data'>" . $row_3['moviename'] . "</td>\n";
                        }
                        echo "<td class='table-data'>" . $row_1['screening_date'] . "</td>\n";
                        echo "<td class='table-data'>" . $row_2['show_time'] . "</td>\n";

                        $threatreid = $row_2['threatre_id'];
                        $stmt_4 = $pdo->prepare("SELECT name FROM threatre WHERE threatre_id = '$threatreid'");
                        $stmt_4->execute();
                        while ($row_4 = $stmt_4->fetch()) {
                            echo "<td class='table-data'>" . $row_4['name'] . "</td>\n";
                        }
                    }

                    $seat_number = [];
                    $seat_ids = (explode(",", $row_1['seat_id']));
                    foreach ($seat_ids as $seat_id) {
                        $stmt_5 = $pdo->prepare("SELECT seat_no FROM seat WHERE seat_id = '$seat_id'");
                        $stmt_5->execute();
                        $row_5 = $stmt_5->fetch();
                        array_push($seat_number,  $row_5['seat_no']);
                    }
                    echo "<td class='table-data'>" . implode(",", $seat_number) . "</td>\n";

                    while ($row_4 = $stmt_4->fetch()) {
                        echo "<td class='table-data'>" . $row_4['name'] . "</td>\n";
                    }
                }

                echo "<td class='table-data'> RM " . $row['price'] . "</td>\n";

                echo "</tr>";


            }

                unset($stmt);
                unset($stmt_1);
                unset($stmt_2);
                unset($stmt_3);
                unset($stmt_4);
                unset($stmt_5);
                unset($pdo);
            ?>
        </table>
    </div>
 <!-- footer section-->
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
    <!-- end of footer section-->

</body>

</html>