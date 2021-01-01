<?php
              require_once "config.php";


                //submit form
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                  
                  $option = isset($_POST['theatre']) ? $_POST['theatre'] : false;

                  if ($option) {
                     echo htmlentities($_POST['theatre'], ENT_QUOTES, "UTF-8");
               
                  } else {
                    echo "task option is required";
                    exit; 
                  }
               
                  $date = $_POST['datepicker'];
                  echo $date;
               
                  $option3 = isset($_POST['show']) ? $_POST['show'] : false;
               
                  if ($option) {
                     echo htmlentities($_POST['show'], ENT_QUOTES, "UTF-8");
               
                  } else {
                    echo "task option is required";
                    exit; 
                  }

                  $seat_id_list = filter_input(INPUT_POST, 'display');
                  if(empty($seat_id_list)){
                    echo "Please choose your seat to proceed!<br>";
                  }else{
                    $items = preg_split("/[\s,]+/" ,$seat_id_list);
                    $price = (float)filter_input(INPUT_POST, 'price');
                    $date = date("Y/m/d");
                  }
                  //insert new row data to payment table
                    $sql = "INSERT INTO payment(user_id, date, price, purchase) VALUES ('1', :date, :price,'0')";


                  if ($stmt = $pdo->prepare($sql)) {
                  // Bind variables to the prepared statement as parameters
                  $stmt->bindParam(":date", $param_date, PDO::PARAM_STR);
                  $stmt->bindParam(":price", $param_price, PDO::PARAM_STR);
           
                  
                  // Set parameters
                  $param_date = $date;
                  $param_price = $price;
                  

                  if ($stmt->execute()) {
                    // Redirect to login page
                    echo "Result updated";
                    $payment_id = $pdo->lastInsertId();
                  } else {
                    echo "Something went wrong. Please try again later.";
                  }
                  }

                  
                  echo $payment_id;

                    //insert new data into seat_reserved table
                    foreach($items as $item){
                      echo $item;
                      $sql = "SELECT seat_id FROM seat WHERE seat_no = '$item' and screening_id= '1'";
                      $stmt = $pdo->prepare($sql);
                      $stmt ->execute();
                      
                      
                        while ($row = $stmt->fetch())  {
                      
                          $sql_1 = "INSERT INTO seat_reserved(seat_id, screening_id, payment_id) VALUES ( :seat_id ,'1', :payment_id)";
                          if($stmt_1 = $pdo->prepare($sql_1)){
                            // Bind variables to the prepared statement as parameters
                            $stmt_1->bindParam(":seat_id", $param_item, PDO::PARAM_STR);
                            $stmt_1->bindParam(":payment_id", $param_payment_id, PDO::PARAM_STR);
                    
                            
                            // Set parameters
                            $param_item = $row['seat_id'];
                            $param_payment_id = $payment_id;

                            if ($stmt_1->execute()) {
                              
                              echo "Result updated";
                              
                            } else {
                              echo "Something went wrong. Please try again later.";
                            }
                          }
                    
                        }
                      
                     
                    }
                  
                }

                // header('Location: cart.html');
                // $conn->close();
                // exit();
