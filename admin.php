<?php

require_once "config.php";
//define variable with empty message
$movie_name = $description = $director = $producer = $starring =  $genres = $release_date = $running_time = $rating = $keywords = $trailer = $img_path = "";
$name_err = $desc_err = $dir_err = $prod_err = $star_err = $genres_err = $release_err = $time_err = $rating_err = $keywords_err = $trailer_err = $img_path_err = "";
$check_sum = true;


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //check for not empty movie name
    if (!empty($_POST['movie_name'])) {
        $movie_name = $_POST['movie_name'];
    } else {
        $name_err = "Please enter a movie name.";
        $check_sum = false;
    }


    //check for not empty description
    if (!empty($_POST['description'])) {
        $description = $_POST['description'];
    } else {
        $desc_err = "Please give some description of the movie.";
        $check_sum = false;
    }

    //check for not empty director
    if (!empty($_POST['director'])) {
        $director = $_POST['director'];
    } else {
        $dir_err = "Please name the directors of the movie.";
        $check_sum = false;
    }

    //check for not empty producer
    if (!empty($_POST['producer'])) {
        $producer = $_POST['producer'];
    } else {
        $prod_err = "Please name the producer of the movie.";
        $check_sum = false;
    }


    //check for not empty starring
    if (!empty($_POST['starring'])) {
        $starring = $_POST['starring'];
    } else {
        $star_err = "Please name the starring of the movie.";
        $check_sum = false;
    }

    //check for not empty genres
    if (!empty($_POST['genres'])) {
        $genres = implode(",", $_POST['genres']);;
    } else {
        $genres_err = 'Please select the genres of the movie.';
        $check_sum = false;
    }

    //check for not empty release date
    if (!empty($_POST['release_date'])) {
        $release_date = $_POST['release_date'];
    } else {
        $release_err = "Please specific the release date of the movie.";
        $check_sum = false;
    }

    //check for not empty running time
    if (!empty($_POST['running_time'])) {
        $running_time = $_POST['running_time'];
    } else {
        $time_err = "Please specific the running time of the movie.";
        $check_sum = false;
    }

    //check for not empty rating
    if (!empty($_POST['rating'])) {
        $rating = $_POST['rating'];
    } else {
        $rating_err = "Please select the rating of the movie";
        $check_sum = false;
    }


    //check for not empty keywords
    if (!empty($_POST['keywords'])) {
        $keywords = $_POST['keywords'];
    } else {
        $keywords_err = "Please specific the keywords of the movie";
        $check_sum = false;
    }

    //check for not empty trailer url
    if (!empty($_POST['trailer'])) {
        $trailer = $_POST['trailer'];
    } else {
        $trailer_err = "Please specific the trailer url of the movie";
        $check_sum = false;
    }

    //check for not empty image
    if (!empty($_POST['img_path'])) {
        $img_path = $_POST['img_path'];
    } else {
        $img_path_err = "Please specific the image path of the movie";
        $check_sum = false;
    }

    //if everything is fill in
    if ($check_sum) {
        // Prepare an insert statement
        $sql = "INSERT INTO movielist 
        (moviename, description, director, producer, starring, genres, releasedate, runningtime, rating, keyword, url, path) 
        VALUES 
        (:moviename, :description, :director, :producer, :starring, :genres, :releasedate, :runningtime, :rating, :keyword, :url, :img_path)";


        //bind parameter
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":moviename", $param_moviename, PDO::PARAM_STR);
            $stmt->bindParam(":description", $param_description, PDO::PARAM_STR);
            $stmt->bindParam(":director", $param_director, PDO::PARAM_STR);
            $stmt->bindParam(":producer", $param_producer, PDO::PARAM_STR);
            $stmt->bindParam(":starring", $param_starring, PDO::PARAM_STR);
            $stmt->bindParam(":genres", $param_genres, PDO::PARAM_STR);
            $stmt->bindParam(":releasedate", $param_releasedate, PDO::PARAM_STR);
            $stmt->bindParam(":runningtime", $param_runningtime, PDO::PARAM_STR);
            $stmt->bindParam(":rating", $param_rating, PDO::PARAM_STR);
            $stmt->bindParam(":keyword", $param_keyword, PDO::PARAM_STR);
            $stmt->bindParam(":url", $param_url, PDO::PARAM_STR);
            $stmt->bindParam(":img_path", $param_img_path, PDO::PARAM_STR);


            // Set parameters
            $param_moviename = $movie_name;
            $param_description = $description;
            $param_director = $director;
            $param_producer = $producer;
            $param_starring = $starring;
            $param_genres = $genres;
            $param_releasedate = $release_date;
            $param_runningtime = $running_time;
            $param_rating = $rating;
            $param_keyword = $keywords;
            $param_url = $trailer;
            $param_img_path = $img_path;

            //execute the statement to insert date to database
            if ($stmt->execute()) {
                echo "<script>alert('Recorded');window.location.href='admin_wrapper.php';</script>";
            } else {
                echo "Something went wrong. Please try again later.";
            }

            //close statement
            unset($stmt);
        }

        //close connection
        unset($pdo);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 100%;
        }

        .head-title {
            text-align: center;
        }

        .head-title h2 {
            color: white;
            padding-top: 10px;
        }

        .head-title p {
            color: white;
            padding-bottom: 10px;
        }

        #running-time {
            width: 70px;
        }

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
    </style>
</head>

<body>
    <div>
        <div class="head-title">
            <h2>New Movie</h2>
            <p>Please fill in the detail of the movie</p>
        </div>
        <div class="wrapper">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label class="label">Movie Name:</label>
                    <input type="text" name="movie_name" value="">
                    <span class="help-block"><?php echo $name_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" cols="50"></textarea>
                    <span class="help-block"><?php echo $desc_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Director:</label>
                    <input type="text" name="director" value="">
                    <span class="help-block"><?php echo $dir_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Producer:</label>
                    <input type="text" name="producer" value="">
                    <span class="help-block"><?php echo $prod_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Starring:</label>
                    <input type="text" name="starring" value="">
                    <span class="help-block"><?php echo $star_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Genres:</label>
                    <select id="genres" name="genres[]">
                        <option value="" disabled selected>Choose genres</option>
                        <option>Action</option>
                        <option>Adventure</option>
                        <option>Animation</option>
                        <option>Biography</option>
                        <option>Comedy</option>
                        <option>Crime</option>
                        <option>Documentary</option>
                        <option>Drama</option>
                        <option>Family</option>
                        <option>Fantasy</option>
                        <option>History</option>
                        <option>Horror</option>
                        <option>Musical</option>
                        <option>Mystery</option>
                        <option>Romance</option>
                        <option>SCI-FI</option>
                        <option>Sport</option>
                        <option>Thriller</option>
                        <option>War</option>
                        <option>Western</option>
                    </select>
                    <input type="button" onclick="javascript:multipleFunc('genres')" value="Enable multiple options">
                    <p>Press CTRL and click above button to select multiple options at once.</p>
                    <span class="help-block"><?php echo $genres_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Release Date:</label>
                    <input type="date" name="release_date" value="">
                    <span class="help-block"><?php echo $release_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Running Time:</label>
                    <input type="number" id="running-time" name="running_time" value="">
                    <span>minutes</span>
                    <span class="help-block"><?php echo $time_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Rating:</label>
                    <select id="rating" name="rating">
                        <option value="" disabled selected>Choose rating</option>
                        <option>G</option>
                        <option>PG</option>
                        <option>PG-13</option>
                        <option>R</option>
                        <option>NC-17</option>
                    </select>
                    <span class="help-block"><?php echo $rating_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Keywords:</label>
                    <input type="text" name="keywords" value="">
                    <span class="help-block"><?php echo $keywords_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Trailer URL:</label>
                    <input type="url" name="trailer" value="">
                    <span class="help-block"><?php echo $trailer_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Image Path:</label>
                    <input type="text" name="img_path" value="">
                    <span class="help-block"><?php echo $img_path_err; ?></span>
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

        function multipleFunc(id) {
            let genres = document.getElementById(id);
            if (document.getElementById(id).multiple) {

                genres.multiple = false;
                genres.name = "genres";
            } else {
                genres.multiple = true;
                genres.name = "genres[]";
            }

        }
    </script>
</body>

</html>