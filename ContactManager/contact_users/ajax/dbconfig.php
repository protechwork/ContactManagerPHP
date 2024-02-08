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

ini_set('log_errors', 1);
// Set Error Log Path Variable (Grabs the Root Directory of the Project, then appends on the path)
$errorPath = dirname(substr(dirname(__FILE__),strlen($_SERVER['DOCUMENT_ROOT']))) . '/Error/error.log';
//ini_set('error_log', $errorPath);
ini_set('error_log', '/home1/icsweho2/public_html/ContactManager/Error/error.log');

