<?php
// Include the database configuration file
require_once 'dbconfig.php';

$id = $_POST['ticket_id'];

$query = "SELECT DATE_FORMAT(datetime, '%d/%m/%Y %H:%i') as datetime,ticket_id,agent_login.user_id as user_name,IF(visibility = 0, 'No', 'Yes') as notify_contact,comment, ticket_activity.type FROM ticket_activity INNER JOIN agent_login ON agent_login.id=ticket_activity.perfomed_user_id WHERE ticket_id=".$id. " ORDER BY datetime DESC";
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
