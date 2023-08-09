<?php
session_start();
// Include the database configuration file
require_once 'dbconfig.php';

$user_name = $_POST['user_name'];
$user_pass = $_POST['user_pass'];

$query = "SELECT * FROM agent_login WHERE user_id='".$user_name. "' AND password='".$user_pass."'";
$result = $mysqli->query($query);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Create an array to hold the data
    $data = array();

    // Fetch each row and add it to the data array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Convert the data array to JSON format
    $json_data = json_encode(array("user_id"=> $data[0]["id"]));
    $_SESSION['user_id'] = $data[0]["user_id"];

    // Set the response header to JSON
    header('Content-Type: application/json');

    // Output the JSON data
    echo $json_data;
} else {
    // No rows found
    header('Content-Type: application/json');
    echo json_encode(array("user_id"=> "0"));
}

// Close the database connection
$mysqli->close();
