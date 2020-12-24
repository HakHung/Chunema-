<?php
                //create connection
                $host = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "cinema";
                $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

                //submit form
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                  
                  $seat_id_list = filter_input(INPUT_POST, 'display');
                  if(empty($seat_id_list)){
                    echo "Please choose your seat to proceed!<br>";
                  }else{
                    $items = preg_split("/[\s,]+/" ,$seat_id_list);
                    $price = (float)filter_input(INPUT_POST, 'price');
                    $date = date("Y/m/d");
                  
                  //insert new row data to payment table
                    $stmt = "INSERT INTO payment(user_id, date, price, purchase) values ('1','$date', '$price','0')";
                    if ($conn->query($stmt)) {
                        $message = "New record is inserted sucessfully";
                        } else {
                          "Error: " . $stmt . "<br>" . $conn->error;
                        }
                    }
                    $payment_id = mysqli_insert_id($conn);
                    

                    //insert new data into seat_reserved table
                    foreach($items as $item){
                      echo $item;
                      $sql = "SELECT seat_id FROM seat WHERE seat_no = '$item' and screening_id= '1'";
                      $result = $conn->query($sql);
                      
                      if ($result->num_rows > 0){
                        while($row = $result->fetch_assoc()) {
                      
                          $stmt_1 = "INSERT INTO seat_reserved(seat_id, screening_id, payment_id) values ('{$row['seat_id']}','1', '$payment_id')";
                          if ($conn->query($stmt_1)) {
                            $message = "New record is inserted sucessfully";
                            } else {
                              "Error: " . $stmt . "<br>" . $conn->error;
                            }
                    
                        }
                      } else {
                        echo "0 results";
                      }
                     
                    }
                  
                }

                header('Location: cart.html');
                $conn->close();
                exit();
            ?>