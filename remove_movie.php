<?php

require_once "config.php";
$error_msg ="";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if(!empty( $_POST['movie_remove'])){
        $movies_id = $_POST['movie_remove'];
        
        foreach ($movies_id as $movie_id) {
             $sql = "DELETE FROM movielist WHERE movieid = $movie_id";
             $stmt = $pdo->prepare($sql);
             if ($stmt->execute()) {
                echo "<script>alert('Data deleted');window.location.href='admin_wrapper.php';</script>";
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

    }else{
        $error_msg = "Please choose at least one movie to be deleted.";
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
        body {
            font: 14px sans-serif;
            background: url('images/uploads/ft-bg.jpg') ;
            background-color: white;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .wrapper {
            width: 100%;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom  : 20px;
        }

        .head-title{
            background-color: grey; 
            text-align: center;
        }

        .head-title h2{
            color: white;
            padding-top: 10px;  
        }
        .head-title p{
            color: white;
            padding-bottom: 10px;  
        }


        #movie-table{
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
        

        .description{
            border: 1px solid black;
            border-collapse: collapse;
            width: 50%;
            text-align: start;
            padding: 0px;
            color: black;
            background-color: white;
            padding: 5px;
        }

        #button-area{
            padding:10px;   
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
        <p style="color: red"><?php echo $error_msg;?></p>  
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
                    $stmt ->execute();
                    while ($row = $stmt->fetch()) {
                        echo " <tr class='table-row'>\n";
                        echo "<td class='table-data'><input type='checkbox' name='movie_remove[]' value='{$row['movieid']}'>Select</input></td>\n";
                        echo "<td class='table-data'>".$row['moviename']. "</td>\n";
                        echo "<td class='description'>".$row['description']. "</td>\n";
                        echo "<td class='table-data'>".$row['releasedate']. "</td>\n";
                        echo "<td class='table-data'>".$row['rating']. "</td>\n";
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


