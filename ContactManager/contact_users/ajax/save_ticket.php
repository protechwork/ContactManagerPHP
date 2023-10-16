<?php
session_start();
// Include the database configuration file
require_once 'dbconfig.php';

// Get the form data

$project_id = $_POST['project_id'];
$company_id = $_POST['company_id'];
$title = $_POST['title'];
$details = $_POST['details'];
//$attachment = $_POST['attachment'];
$userID = $_SESSION['user_id'];

/*
if(!empty($_FILES['attachment']['name']))
{
    if((filesize($_FILES['attachment']['tmp_name'])/ 1048576) > 5 || pathinfo($filename, PATHINFO_EXTENSION) != "pdf" )
    {
        $response = array('status' => 'size limit extends');
        echo json_encode($response);
        die();
    }
}
*/

// Check if the data is not blank
//if (!empty($project_id) && !empty($company_id) && !empty($title) && !empty($details) && !empty($attachment) )
if (!empty($project_id) && !empty($company_id) && !empty($title) && !empty($details) )
{
    
	$ticketID="0";
    if(!empty($_POST['ticket_id']))
    {
        $ticketID=$_POST['ticket_id'];
    }
    
    $query = "SELECT COUNT(*) as count FROM ticket WHERE ticket_id  = ".$ticketID;
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
         $query = "SELECT COUNT(*) as count FROM ticket WHERE ticket_id  = '$ticketID' ";
          $result = $mysqli->query($query);
          $row = $result->fetch_assoc();
          $count = $row['count'];
          if (intval($count) != 0) {
              $response = array('status' => 'exist');
              echo json_encode($response);
              die();
          }


          $defaultWorkStatus = 0 ;
          $query = "SELECT default_work_status as work_status FROM settings WHERE id  = 1 ";
          $result = $mysqli->query($query);
          $row = $result->fetch_assoc();
          $defaultWorkStatus = $row['work_status'];
          
        
           // Insert a new record
           $insertQuery = "INSERT INTO ticket (company_id, project_id, title, details, attachement, reported_on, reported_by, work_status, status) VALUES (".$company_id.", ".$project_id.", '".$title."', '".$details."', '', now(), ".$userID.", ".$defaultWorkStatus.", 0) ";   
           //var_dump($insertQuery);die();
           $mysqli->query($insertQuery);
           
           if(!empty($_FILES['attachment']['name']))
           {
                upload_ticket_file($mysqli->insert_id);
           }
           
           //$mysqli->insert_id

           $newTicketId = $mysqli->insert_id;
           $comment =  "New Ticket Created By: ".getUserNameById($userID);    
           $visibility = 0;
          
   
           $insertQuery = "INSERT INTO ticket_activity (ticket_id, perfomed_user_id, comment, visibility, datetime) VALUES (".$newTicketId.", ".$userID.", '".$comment."', ".$visibility.", now() ) ";           
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

function getAgentNameById($AgentID)
{
    require 'dbconfig.php';

    $query = "SELECT name FROM agent_master WHERE id=".$AgentID;
    $result = $mysqli->query($query);
    $returnData = "";

    // Check if any rows were returned
    if ($result->num_rows > 0) {        
        // Fetch each row and add it to the data array
        if ($row = $result->fetch_assoc()) {
            $returnData = $row["name"];
        }       
    }
    return $returnData;

}

function getUserNameById($ID)
{
    require 'dbconfig.php';

    $query = "SELECT user_id FROM agent_login WHERE id=".$ID;
    $result = $mysqli->query($query);
    $returnData = "";

    // Check if any rows were returned
    if ($result->num_rows > 0) {        
        // Fetch each row and add it to the data array
        if ($row = $result->fetch_assoc()) {
            $returnData = $row["user_id"];
        }       
    }
    return $returnData;

}

function getWorkStatusById($StatusID)
{
    require 'dbconfig.php';

    $query = "SELECT name FROM work_status_master WHERE id=".$StatusID;
    $result = $mysqli->query($query);
    $returnData = "";

    // Check if any rows were returned
    if ($result->num_rows > 0) {        
        // Fetch each row and add it to the data array
        if ($row = $result->fetch_assoc()) {
            $returnData = $row["name"];
        }       
    }
    return $returnData;
}


function upload_ticket_file($TicketID)
{
    require 'dbconfig.php';

    $uploadDirectory = '/home1/icsweho2/public_html/ContactManager/ticket_uploads/';

    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $tempFilePath = $_FILES['attachment']['tmp_name'];
        
        $path_parts = pathinfo($_FILES["attachment"]["name"]);
        $extension = $path_parts['extension'];


        $fileName = $TicketID.".". $extension;
        $filePath = $uploadDirectory . $fileName;

        if (move_uploaded_file($tempFilePath, $filePath)) {
            // Save attachment path to settings table
            
              $query = "SELECT COUNT(*) as count FROM ticket WHERE ticket_id  = ".$TicketID;
              error_log("your message:".$query);

              $result = $mysqli->query($query);
              $row = $result->fetch_assoc();
              $count = $row['count'];
            
              if ($count > 0) {
                // Update the existing record
                $updateQuery = "UPDATE ticket SET attachement = '$fileName' WHERE ticket_id  = '$TicketID'";
                $mysqli->query($updateQuery);
              }
        } 
    }

}
?>
