<?php
// Include the database configuration file
require_once 'dbconfig.php';

$id = $_POST['ticket_id'];

/*

SELECT ticket.*,agent_login.contact_id as contact_selected, DATE_FORMAT(ticket.reported_on, '%d-%m-%Y') CreatedDate 

FROM ticket INNER JOIN agent_login ON ticket.contact_ids=agent_login.id

WHERE ticket.ticket_id=21

*/

$query = "SELECT ticket.*,log.user_id,agent_login.contact_id as contact_selected, DATE_FORMAT(ticket.reported_on, '%d-%m-%Y') CreatedDate 
FROM ticket LEFT JOIN agent_login ON ticket.contact_ids=agent_login.id
LEFT JOIN agent_login log ON ticket.reported_by=log.id
WHERE ticket.ticket_id=".$id;

$result = $mysqli->query($query);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Create an array to hold the data
    $data = $result->fetch_assoc();
    // extract contacts ids from $data
    // $contact_ids = array(); 
    // create query to get all contacts ids data from contact master
    // $data["contact_ids"] = $contact_ids;

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
