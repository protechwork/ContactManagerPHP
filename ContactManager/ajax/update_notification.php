<?php
session_start();
// Include the database configuration file
require_once 'dbconfig.php';

// Get the form data
$notificationID = $_POST['notification_id'];
//$ticket_id = $_POST['ticket_id'];
//$user_id = $_SESSION['user_id'];

/*
$query = "SELECT COUNT(*) as count FROM notification WHERE ticket_id=".$ticket_id." AND login_id=".$user_id;
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$count = $row['count'];

if ($count > 0)
{
  // Update the existing record
  $updateQuery = "UPDATE notification SET view=1 WHERE ticket_id=".$ticket_id." AND login_id=".$user_id;
  $mysqli->query($updateQuery);
}
*/

$query = "SELECT COUNT(*) as count FROM notification WHERE id=".$notificationID;
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$count = $row['count'];
error_log($query);
if ($count > 0)
{
  $updateQuery = "UPDATE notification SET view=1 WHERE id=".$notificationID;
  $mysqli->query($updateQuery);
  error_log($updateQuery);
}




$response = array('status' => 'success');
echo json_encode($response);

// Close the database connection
$mysqli->close();
?>
