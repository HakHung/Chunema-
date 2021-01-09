<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";


?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>dashboard</title>

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="profile" href="#">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Mobile specific meta -->
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone-no">
    <style>
        body {
            background: url('images/uploads/ft-bg.jpg') no-repeat;
            background-color: black;
        }

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

        section {
            background-color: black;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        h1 {
            color: gold;
        }

        p {
            color: white;
        }

        #d h4 {
            color: yellow;
        }

        .inner{
            text-align:center;
            padding:20px;
            
        }
        .inner a:hover {
            width: 75px;
            height: 20px;
            background: gold;
            padding: 10px;
            border-radius: 5px;
        }

    </style>
    <script>

    </script>
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
    <section>
        <div class="container">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <?php $id = $_GET["myid"];
                //echo $id;
                $stmt = $pdo->prepare("SELECT * FROM movielist WHERE movieid=$id");
                $stmt->execute();
                $_SESSION['movieid'] = $id;
                while ($row = $stmt->fetch()) {
                ?>
                    <img src=<?php echo $row['path']; ?> alt="" widht="350" height="480">
                    <div class="inner">
                        <a href=<?php echo $row['url']; ?>>Watch Trailer!</a><br><br>   
                        <a href="ticket.php ?  myid= <?php echo $row['movieid']; ?>">Book Now!</a>
                    </div>
            </div>

            <div id="d" class="col-md-8 col-sm-12 col-xs-12">
            <?php
                    echo "<h1>" . $row['moviename'] . "</h1>" . "<br />\n";
                    echo "<p>" . $row['description'] . "</p>" . "<br />\n";
                    echo "<h4> Director: </h4>";
                    echo "<p>" . $row['director'] . "</p>" . "<br />\n";
                    echo "<h4> Producer: </h4>";
                    echo "<p>" . $row['producer'] . "</p>" . "<br />\n";
                    echo "<h4> Stars: </h4>";
                    echo "<p>" . $row['starring'] . "</p>" . "<br />\n";
                    echo "<h4> Genres: </h4>";
                    echo "<p>" . $row['genres'] . "</p>" . "<br />\n";
                    echo "<h4> Release Date: </h4>";
                    echo "<p>" . $row['releasedate'] . "</p>" . "<br />\n";
                    echo "<h4> Run Time: </h4>";
                    echo "<p>" . $row['runningtime'] . "</p>" . "<br />\n";
                    echo "<h4> MMPA Rating: </h4>";
                    echo "<p>" . $row['rating'] . "</p>" . "<br />\n";
                    echo "<h4> Plot Keywords: </h4>";
                    echo "<p>" . $row['keyword'] . "</p>" . "<br />\n";
                }
            ?>
            </div>
        </div>
    </section>

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
                    <p style="color:cornflowerblue">Subscribe to our newsletter system now to get latest news from us.</p>
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