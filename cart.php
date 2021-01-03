<?php

session_start();

require_once "config.php";


$userid = $_SESSION['id'];
echo $userid;

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
         body {
            font: 14px sans-serif;
            background: url('images/uploads/ft-bg.jpg') no-repeat;
            background-color: black;
        }

        .wrapper {
            width: 100%;
            padding-right: 20px;
            padding-left: 20px;
            padding-bottom  : 20px;
            justify-content: center;
        }

      
    

        #movie-table{
            width: 80%;  
            
        }

        .table-head {
            border: 2px solid black;
            border-collapse : collapse;
            width: 10%;
            text-align:center;
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
        

       
        #button-area{
            padding:10px;   
            float: right;
        }

    </style>
</head>

<body>
   
    <div class="wrapper">
      
        
        <table id="">
            <tr class="table-row">
                <th class="table-title" colspan="7">Cart</th>
            </tr>
            <tr class="table-row">
                <th class="table-head" >Payment ID</th>
                <th class="table-head" >Movie Name</th>
                <th class="table-head" >Show Date</th>
                <th class="table-head" >Show Time</th>
                <th class="table-head" >Threatre</th>
                <th class="table-head" >Seat Number</th>
                
                <th class="table-head" >Total Price</th>
            </tr>
                <?php 

                 
                    $stmt = $pdo->prepare("SELECT * FROM payment WHERE user_id = '$userid'");
                    $stmt ->execute();
                    while ($row = $stmt->fetch()) {
                        echo "<tr>";
                        echo "<td class='table-data'>".$row['payment_id']. "</td>\n";
                        $paymentid = $row['payment_id'];
                        $stmt_1= $pdo->prepare("SELECT * FROM seat_reserved WHERE payment_id = '$paymentid'");
                        $stmt_1 ->execute();
                        while ($row_1 = $stmt_1->fetch()) {
                            
                            echo $row_1['screening_id'];
                            $screeningid = $row_1['screening_id'];
                            $stmt_2= $pdo->prepare("SELECT * FROM screening WHERE screening_id = '$screeningid'");
                            $stmt_2 ->execute();
                            while ($row_2 = $stmt_2->fetch()){ 
                                $movieid = $row_2['movie_id'];
                                $stmt_3= $pdo->prepare("SELECT moviename FROM movielist WHERE movieid = '$movieid'");
                                $stmt_3 ->execute();
                                while ($row_3= $stmt_3->fetch()){
                                    echo "<td class='table-data'>".$row_3['moviename']. "</td>\n";
                                }
                                echo "<td class='table-data'>".$row_1['screening_date']. "</td>\n";
                                echo "<td class='table-data'>".$row_2['show_time']. "</td>\n";

                                $threatreid = $row_2['threatre_id'];
                                $stmt_4= $pdo->prepare("SELECT name FROM threatre WHERE threatre_id = '$threatreid'");
                                $stmt_4 ->execute();
                                while ($row_4= $stmt_4->fetch()){
                                    echo "<td class='table-data'>".$row_4['name']. "</td>\n";
                                }
                            }
                            
                                $seat_number = [];
                                $seat_ids = (explode(",",$row_1['seat_id']));
                                foreach($seat_ids as $seat_id){
                                    $stmt_5= $pdo->prepare("SELECT seat_no FROM seat WHERE seat_id = '$seat_id'");
                                    $stmt_5 ->execute();
                                    $row_5= $stmt_5->fetch();
                                    array_push($seat_number,  $row_5['seat_no']);
                                }
                                echo "<td class='table-data'>".implode(",", $seat_number). "</td>\n";
                                
                                while ($row_4= $stmt_4->fetch()){
                                    echo "<td class='table-data'>".$row_4['name']. "</td>\n";
                                }
                        }

                        echo "<td class='table-data'> RM ".$row['price']. "</td>\n";

                        echo "</tr>";
                    }
                
                ?>
        </table>
                
       
    
    </div>
    


    
</body>

</html>


