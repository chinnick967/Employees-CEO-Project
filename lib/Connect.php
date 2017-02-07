<?php
// Database and server settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "employees_ceo_project";

// connect to database
$conn = mysqli_connect($servername, $username, $password, $database);

// check connection
if (!$conn) {
    die("Failed to connect: " . mysqli_connect_error());
}

?>