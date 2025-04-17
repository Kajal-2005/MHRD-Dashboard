<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password (empty)
$dbname = "login_db"; 

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);
// $conn = new mysqli('localhost', 'root', '', 'login_db');


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
