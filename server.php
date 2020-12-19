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
  $user_check_query = "SELECT * FROM userdetails WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if ($password != $repassword) {
	array_push($errors, "The two passwords do not match");
  }
  echo $user;
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
    $sql = "INSERT INTO userdetails (username, email, password) values ('$username','$email', '$password')";
    if ($conn->query($sql)) {
        echo "New record is inserted sucessfully";
    } else {
        "Error: " . $sql . "<br>" . $conn->error;
    }   
    // include 'dashboard.html';
