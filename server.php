<?php

$username = filter_input(INPUT_POST, 'username');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

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

    $sql = "INSERT INTO userdetails (username, email, password) values ('$username','$email', '$password')";
    if ($conn->query($sql)) {
        echo "New record is inserted sucessfully";
    } else {
        "Error: " . $sql . "<br>" . $conn->error;
    }   
    include 'dashboard.html';
