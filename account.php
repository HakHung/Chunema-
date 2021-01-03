<?php
session_start();

require_once ('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            background: url('images/uploads/ft-bg.jpg') no-repeat;
            font: 14px sans-serif;
            height:50%;
        }

        section {
            background-color: black;
            padding: 40px;
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

        }

        label {
            color: yellow;
        }

        p {
            color: white;
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

     <section class="item">
        <div class="wrapper">
        <h2>User Profile</h2>
        <p>View or update profile</p>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM userdetails";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='table table-bordered font'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th><font color=gold>Name</th>";
                                        echo "<th><font color=gold>Email</th>";
                                        echo "<th><font color=gold>Country</th>";
                                        echo "<th><font color=gold>Phone</th>";
                                        echo "<th><font color=gold>Password</th>";
                                        echo "<th><font color=gold>Option</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td><font color=white>" . $row['username'] . "</td>";
                                        echo "<td><font color=white>" . $row['email'] . "</td>";
                                        echo "<td><font color=white>" . $row['country'] . "</td>";
                                        echo "<td><font color=white>" . $row['phone'] . "</td>";
                                        echo "<td><font color=white>" . $row['pasword'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."'class='btn btn-default''>View</a>";
                                            echo "<a href='update.php?id=". $row['id'] ."'class='btn btn-primary''>Update</a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    unset($pdo);
                    ?>
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