<?php
session_start();
// Include the database configuration file
require_once 'dbconfig.php';

// Get the form data


$comment =  $_POST['comment'];
$visibility =  $_POST['visibility'];

$userID = $_SESSION['user_id'];

// Check if the data is not blank
if (!empty($comment) )
{
    
	$ticketID="0";
    if(!empty($_POST['ticket_id']))
    {
        $ticketID=$_POST['ticket_id'];
    }
    
    // Insert a new record
    $insertQuery = "INSERT INTO ticket_activity (ticket_id, perfomed_user_id, comment, visibility, datetime) VALUES (".$ticketID.", ".$userID.", '".$comment."', ".$visibility.", now() ) ";   
    //var_dump($insertQuery);die();
    $mysqli->query($insertQuery);
    
    

    // Return a success response
    $response = array('status' => 'success');
    echo json_encode($response);
    
	
  
} else {
  // Return an error response
  $response = array('status' => 'error');
  echo json_encode($response);
}

// Close the database connection
$mysqli->close();


?>
