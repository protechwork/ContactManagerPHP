<?php
// Include the database configuration file
require_once 'dbconfig.php';

// Get the form data
$id = $_POST['id'];

// Check if the data is not blank
if (!empty($id)) {
    $query = "SELECT COUNT(*) as count FROM contacts WHERE company_id  = $id ";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $count = $row['count'];
    if ($count > 0) {
        $response = array('status' => 'exist');
        echo json_encode($response);
        die();
    }
  
   // Insert a new record
   $insertQuery = "DELETE FROM companies WHERE company_id=".$id;
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
