<?php
// Database Configuration
$hostname = '%%HOST_NAME%%'; // Replace with your database host
$username = '%%USER_NAME%%'; // Replace with your database username
$password = '%%PASSWORD%%'; // Replace with your database password
$database = '%%DATABASE%%'; // Replace with your database name

// Create a new mysqli instance
$mysqli = new mysqli($hostname, $username, $password, $database);

$conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check for connection errors
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

