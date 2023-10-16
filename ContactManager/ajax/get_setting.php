<?php
// Include the database configuration file
require_once 'dbconfig.php';

$query = "SELECT * FROM settings WHERE id = 1";
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
    $json_data = json_encode($data);

    // Set the response header to JSON
    header('Content-Type: application/json');

    // Output the JSON data
    echo $json_data;
} else {
    // No rows found
    echo 'No data found.';
}

// Close the database connection
$mysqli->close();