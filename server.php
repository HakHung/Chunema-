<?php

$username = filter_input(INPUT_POST, 'username');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$repassword = filter_input(INPUT_POST, 'repassword');
$errors = array(); 

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "cinema";
// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
}
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $sql="select * from userdetails where username='$username' or email='$email'";
  $res=mysqli_query($conn,$sql);
  if (mysqli_num_rows($res) > 0) {
  // output data of each row
    $row = mysqli_fetch_assoc($res);
    if ($username==$row['username'])
    {
      echo "Username already exists";
    }
    else if($email==$row['email'])
    {
      echo "Email already exists";
    
  }else{
    $sql = "INSERT INTO userdetails (username, email, password) values ('$username','$email', '$password')";
    if ($conn->query($sql)) {
        echo "New record is inserted sucessfully";
    } else {
        "Error: " . $sql . "<br>" . $conn->error;
    }   
    include 'dashboard.html';
  }
  }