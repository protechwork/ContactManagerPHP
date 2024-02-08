<?php
// Include the database configuration file
require_once 'dbconfig.php';

$fromDate = $_POST['from_date'];
$toDate = $_POST['to_date'];
$status = $_POST['status'];

$query = "SELECT 
tkt.ticket_id,
cmp.name CompanyName, 
pro.name ProjectName, 
tkt.title Title, 
tkt.details, 
assgnby.name assign_by,
assgnto.name assign_to,
wstatus.name WorkStatus, 
CASE
  WHEN wstatus.link_status = 1 THEN 'Close'
  WHEN wstatus.link_status = 2 THEN 'Hold'      
  WHEN wstatus.link_status = 3 THEN 'In Progress'      
  WHEN wstatus.link_status = 4 THEN 'Not Started'      
END link_status, 
CASE
  WHEN tkt.status = 0 THEN 'In-Active'
  ELSE 'Active'
END Status,
  DATE_FORMAT(tkt.reported_on, '%d-%m-%Y %h:%i ') ReportedOn, 
  tkt.reported_by ReportedBy, 
  tkt.attachement 
FROM 
  ticket tkt 
  LEFT JOIN companies cmp ON tkt.company_id = cmp.company_id 
  LEFT JOIN project pro ON tkt.project_id = pro.id 
  LEFT JOIN agent_master assgnby ON tkt.assigned_by = assgnby.id
  LEFT JOIN agent_master assgnto ON tkt.assigned_to = assgnto.id
  LEFT JOIN work_status_master wstatus ON tkt.work_status = wstatus.id";


if($_POST['from_date'] != '' && $_POST['to_date'] != '' && isset($status))
{
    $query =  $query. " WHERE cast(tkt.reported_on as Date) BETWEEN '$fromDate' AND '$toDate' AND wstatus.link_status=$status";
}
else if($_POST['from_date'] != '' && $_POST['to_date'] )
{
    $query =  $query. " WHERE cast(tkt.reported_on as Date) BETWEEN '$fromDate' AND '$toDate' ";
}
else if (isset($status))
{
    $query =  $query. " WHERE wstatus.link_status=$status";   
}

$query =  $query. " ORDER BY tkt.reported_on DESC";





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
