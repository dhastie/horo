<?php
$servername = "localhost";
$username = "ressour1_admin";
$password = "dankak5656";
$dbname = "ressour1_ressourcesrh";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>