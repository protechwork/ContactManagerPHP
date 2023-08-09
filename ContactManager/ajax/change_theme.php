<?php
// Include the database configuration file
require_once 'dbconfig.php';
    
$id = $_POST['sidebar_style'];
$id = $_POST['header_style'];
$id = $_POST['card_style'];

$query = "SELECT COUNT(*) as count FROM settings WHERE id = 1";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$count = $row['count'];
/*
if ($count > 0) {
    // Update the existing record
    $updateQuery = "UPDATE settings SET logo_path = '$fileName' WHERE id = 1";
    $mysqli->query($updateQuery);
    $response = array('status' => 'success');
    echo json_encode($response);
}
else
{
    $response = array('status' => 'failed');
    echo json_encode($response);
}
  */            
              

// Close the database connection
$mysqli->close();
?>
