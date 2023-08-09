<?php
// Include the database configuration file
require_once 'dbconfig.php';

// Get the form data
$id = $_POST['id'];

// Check if the data is not blank
if (!empty($id)) {
   
   // Insert a new record
   $insertQuery = "DELETE FROM work_status_master WHERE id=".$id;
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
