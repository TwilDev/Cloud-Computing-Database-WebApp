<?php 

// Connection info
$host = 'localhost';
$user = 'root';
$pass = '';
$dbms = 'ccmp_vm';

// Conn
$conn = new mysqli($host,$user,$pass,$dbms);

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

//echo "Connected Successfully";
?>