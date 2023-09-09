<?php
// Include the database configuration file
require_once 'dbconfig.php';

// Get the form data
$company_name = $_POST['company_name'];
$gst = $_POST['gst'];

$project_id = $_POST['project_id'];
$company_id = $_POST['company_id'];
$title = $_POST['title'];
$details = $_POST['details'];
//$attachment = $_POST['attachment'];

// Check if the data is not blank
if (!empty($project_id) && !empty($company_id) && !empty($title) && !empty($details) && !empty($attachment) )
{
    
	$ticketID="0";
    if(!empty($_POST['ticket_id']))
    {
        $ticketID=$_POST['ticket_id'];
    }
    
    $query = "SELECT COUNT(*) as count FROM companies WHERE ticket_id  = ".$ticketID;
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $count = $row['count'];
    //var_dump($count);die();
    if (intval($count) !=  0)
    {
        $updateQuery = "UPDATE companies SET name='".$company_name."', GST='".$gst."', Address='".$address."' WHERE ticket_id  = ".$ticketID;
        //var_dump($updateQuery);die();
        $mysqli->query($updateQuery);
         $response = array('status' => 'success');
          echo json_encode($response);
    }
    else
    {
         $query = "SELECT COUNT(*) as count FROM companies WHERE name  = '$company_name' ";
          $result = $mysqli->query($query);
          $row = $result->fetch_assoc();
          $count = $row['count'];
          if (intval($count) != 0) {
              $response = array('status' => 'exist');
              echo json_encode($response);
              die();
          }
        
           // Insert a new record
           $insertQuery = "INSERT INTO companies (name, GST, Address) VALUES ('$company_name', '$gst', '$address')";   
           //var_dump($insertQuery);die();
           $mysqli->query($insertQuery);
        
          // Return a success response
          $response = array('status' => 'success');
          echo json_encode($response);
    }
	
  
} else {
  // Return an error response
  $response = array('status' => 'error');
  echo json_encode($response);
}

// Close the database connection
$mysqli->close();
?>
