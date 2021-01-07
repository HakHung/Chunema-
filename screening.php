<?php
require_once "config.php";
$movie_name = $cinema_name = $name_err = $cname_err = $show_time = $stime_err = "";
$check_sum = true;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['moviename'])) {
        $movie_name = $_POST['moviename'];
    } else {
        $name_err = "Please enter a movie name.";
        $check_sum = false;
    }
    if (!empty($_POST['theatre'])) {
        $cinema_name = $_POST['theatre'];
    } else {
        $cname_err = "Please enter a threatre name.";
        $check_sum = false;
    }
    if (!empty($_POST['showtime'])) {
        $show_time = $_POST['showtime'];
    } else {
        $stime_err = "Please enter a showing time.";
        $check_sum = false;
    }
    if ($check_sum) {
        // Prepare an insert statement
        $sql = "INSERT INTO screening 
        (movie_id, threatre_id, show_time) 
        VALUES 
        (:moviename, :name, :showtime)";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":moviename", $param_moviename, PDO::PARAM_STR);
            $stmt->bindParam(":name", $param_cinemaname, PDO::PARAM_STR);
            $stmt->bindParam(":showtime", $param_showtime, PDO::PARAM_STR);

            // Set parameters
            $param_moviename = $movie_name;
            $param_cinemaname = $cinema_name;
            $param_showtime = $show_time;

            if ($stmt->execute()) {
                echo "<script>alert('Recorded');window.location.href='admin_wrapper.php';</script>";

            } else {
                echo "Something went wrong. Please try again later.";
            }


            //close statement
            unset($stmt);
        }
        unset($pdo);
    } //else {
    //     echo "Something Wrong";
    // }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
     
        .form-group label,
        span {
            color: white;
        }

        .form-group p {
            color: grey;
        }

        .help-block {
            color: red;
            font: 10px;
        }

        h1 {
            color: white;
        }
    </style>
</head>

<body>
    <div>
        <div class="head-title">
            <h2>New Screening</h2>
            <p>Please fill in the detail of the movie</p>
        </div>
        <div class="wrapper">

            <form action="screening.php" method="post">
                <div>
                    <h1>Movie</h1>
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label for="sel1">Select One:</label>
                        <select class="form-control" id="movie" name='moviename'>
                            <?php
                            $stmt = $pdo->prepare("SELECT * FROM movielist");
                            $stmt->execute();
                            while ($row = $stmt->fetch()) {
                            ?>
                                <option value="<?php echo $row['movieid']; ?>"><?php echo $row['moviename']; ?></option>
                            <?php
                            }; ?>
                        </select>
                        <span class="help-block"><?php echo $name_err; ?></span>
                    </div>
                </div>

                <h1>Theatre</h1>
                <div class="form-group <?php echo (!empty($cname_err)) ? 'has-error' : ''; ?>">
                    <label for="sel1">Select One:</label>
                    <select class="form-control" id="cinema" name='theatre'>
                        <?php
                        $stmt = $pdo->prepare("SELECT * FROM threatre");
                        $stmt->execute();
                        while ($row = $stmt->fetch()) {
                        ?>
                            <option value="<?php echo $row['threatre_id']; ?>"><?php echo $row['name']; ?></option>
                        <?php
                        }; ?>
                    </select>
                    <span class="help-block"><?php echo $cname_err; ?></span>
                </div>

                <h1>Showtime</h1>
                <div class="form-group <?php echo (!empty($stime_err)) ? 'has-error' : ''; ?>">
                    <label for="sel1">Select Time:</label>
                    <input type="time" id="showtime" name="showtime">
                    <span class="help-block"><?php echo $stime_err; ?></span>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>

            </form>

        </div>
    </div>



    <script>
        "use strict"
    </script>
</body>

</html>