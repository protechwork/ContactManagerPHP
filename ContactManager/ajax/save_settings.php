<?php
// Include the database configuration file
require_once 'dbconfig.php';

// Get the form data
$work_status = $_POST['work_status'];
$startTicketNo = $_POST['start_ticket_no'];

$query = "SELECT COUNT(*) as count FROM settings WHERE id = 1";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$count = $row['count'];

if ($count > 0)
{
  // Update the existing record
  $updateQuery = "UPDATE settings SET default_work_status = '".$work_status."', default_start_ticket_no = '".$startTicketNo."' WHERE id = 1";
  $mysqli->query($updateQuery);
}

$response = array('status' => 'success');
echo json_encode($response);

// Close the database connection
$mysqli->close();
?>
