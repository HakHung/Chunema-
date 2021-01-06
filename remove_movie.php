<?php

require_once "config.php";
$error_msg = "";
$checksum = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!empty($_POST['movie_remove'])) {
        $movies_id = $_POST['movie_remove'];

        foreach ($movies_id as $movie_id) {
             $sql = "DELETE FROM movielist WHERE movieid = $movie_id";
             $stmt = $pdo->prepare($sql);
             
             $sql_1 = "DELETE FROM screening WHERE movie_id = $movie_id";
             $stmt_1 = $pdo->prepare($sql_1);
             $sql_2 = "SELECT screening_id FROM screening WHERE movie_id = $movie_id ";
             $stmt_2 = $pdo->prepare($sql_2);
             $stmt_2->execute();
             $number_row  = $stmt_2->rowCount();
             while ($row = $stmt_2->fetch()) {
                $screeningid =$row['screening_id'];
                $sql_4 = "DELETE FROM seat_reserved WHERE screening_id = '$screeningid'";
                $stmt_4 = $pdo->prepare($sql_4);
                if ($stmt_4->execute()) {
                    $checksum = true;
                }
             }
             if($number_row == 0){
                 $checksum = true;
             }
             
             if ($stmt->execute() && $checksum) {
                 if($number_row > 0){
                     $stmt_1->execute();
                 }
                echo "<script>alert('Data deleted');window.location.href='admin_wrapper.php';</script>";
            } else {
                echo "Something went wrong. Please try again later.";echo $checksum;
            }
        }
    } else {
        $error_msg = "Please choose at least one movie to be deleted.";
    }
    unset($stmt);
    unset($stmt_1);
    unset($stmt_2);
    unset($stmt_4);
    unset($pdo);
   
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
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 20px;
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


        #movie-table {
            width: 100%;
        }

        .table-head {
            border: 1px solid black;
            border-collapse: collapse;
            width: 10%;
            text-align: center;
            padding: 5px;
            color: black;
            background-color: white;
        }

        .table-data {
            border: 1px solid black;
            border-collapse: collapse;
            width: 10%;
            text-align: center;
            padding: 0px;
            color: black;
            background-color: white;
        }


        .description {
            border: 1px solid black;
            border-collapse: collapse;
            width: 50%;
            text-align: start;
            padding: 0px;
            color: black;
            background-color: white;
            padding: 5px;
        }

        #button-area {
            padding: 10px;
            float: right;
        }
    </style>
</head>

<body>
    <div class="head-title">
        <h2>Remove Movie</h2>
        <p>Select the movie to be removed</p>
    </div>
    <div class="wrapper">
        <p style="color: red"><?php echo $error_msg; ?></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <table id="movie-table">

                <tr class="table-row">
                    <th class="table-head">Choose To Delete</th>
                    <th class="table-head">Movie Name</th>
                    <th class="table-head">Description</th>
                    <th class="table-head">Release Date</th>
                    <th class="table-head">Rating</th>

                </tr>
                <?php

                $stmt = $pdo->prepare("SELECT * FROM movielist");
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    echo " <tr class='table-row'>\n";
                    echo "<td class='table-data'><input type='checkbox' name='movie_remove[]' value='{$row['movieid']}'>Select</input></td>\n";
                    echo "<td class='table-data'>" . $row['moviename'] . "</td>\n";
                    echo "<td class='description'>" . $row['description'] . "</td>\n";
                    echo "<td class='table-data'>" . $row['releasedate'] . "</td>\n";
                    echo "<td class='table-data'>" . $row['rating'] . "</td>\n";
                    echo "</tr>\n";
                }

                ?>
            </table>
            <div id="button-area">
                <input type="submit" class="btn btn-primary" value="Delete">
                <input type="button" class="btn btn-default" value="Cancel">
            </div>

        </form>
    </div>
</body>

</html>