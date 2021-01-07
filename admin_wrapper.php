<?php
session_start();
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        #tab-bar {
            padding-top: 30px;
            display: flex;
            justify-content: center;
        }

        body {
            font: 14px sans-serif;
            background: url('images/uploads/ft-bg.jpg');
        }
        .head-title{
            background-color: grey;
            text-align: center;
        }

    </style>
</head>



<body>
    <div id="tab-bar">
        <ul class="nav nav-pills justify-content-center">
            <li class="active"><a data-toggle="pill" href="#add-movie">Add Movie</a></li>
            <li id="2"><a data-toggle="pill" href="#remove-movie">Remove Movie</a></li>
            <li id="3"><a data-toggle="pill" href="#screening-time">Screening Time</a></li>
        </ul>
    </div>

    <div class="tab-content">
        <div id="add-movie" class="tab-pane fade in active">
            <?php
            require "admin.php";
            ?>
        </div>

        <div id="remove-movie" class="tab-pane fade">
            <?php
            require "remove_movie.php";
            ?>
        </div>

        <div id="screening-time" class="tab-pane fade">
            <?php
            require "screening.php";
            ?>
        </div>
    </div>


</body>

</html>