<?php
session_start();
// Include the database configuration file
require_once 'dbconfig.php';
// Get the form data
$password =  $_POST['new_pass'];
$userID = $_SESSION['user_id'];

// Check if the data is not blank
if (!empty($password) )
{	
    // Insert a new record
    $insertQuery = "UPDATE agent_login SET password='".$password."' WHERE id=".$userID;   
    $mysqli->query($insertQuery);

    // Return a success response
    $response = array('status' => 'success');
    echo json_encode($response);
    //echo "password updated successfully";
  
} else {
  // Return an error response
  $response = array('status' => 'error');
  echo json_encode($response);
  //cho "Error";
}
// Close the database connection
$mysqli->close();
?>
