<?php
$conn = new mysqli("localhost", "root", "yourpassword", "pps");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>