<?php
// Database Configuration
$hostname = 'localhost'; // Replace with your database host
$username = 'icsweho2_email_auto'; // Replace with your database username
$password = 'email_auto'; // Replace with your database password
$database = 'icsweho2_contact_manager_db'; // Replace with your database name

// Create a new mysqli instance
$mysqli = new mysqli($hostname, $username, $password, $database);

$conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check for connection errors
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

