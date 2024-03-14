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

$contact_ids = '';

if($_POST["contact_ids"] == "" || $_POST["contact_ids"] == null) {
    $contact_ids = '';
} else {
    $contact_ids = $_POST["contact_ids"];
}


//$commaSeparatedIds = explode(',', $contact_ids);

$assigned_by = 0;
$assigned_to = 0;
$work_status = 0;

if($_POST["assigned_by"] == "" || $_POST["assigned_by"] == null) {
    $assigned_by = 0;
} else {
    $assigned_by = $_POST["assigned_by"];
}

if($_POST["assigned_to"] == "" || $_POST["assigned_to"] == null) {
    $assigned_to = 0;
} else {
    $assigned_to = $_POST["assigned_to"];
}

if($_POST["work_status"] == "" || $_POST["work_status"] == null) {
    $work_status = 0;
} else {
    $work_status = $_POST["work_status"];
}

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


//assigned_to = ".$assigned_to.", assigned_by = ".$assigned_by.", work_status = ".$work_status."

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
        $updateQuery = "UPDATE ticket SET contact_ids = '".$contact_ids."', assigned_to = ".$assigned_to.", assigned_by = ".$assigned_by.", work_status = ".$work_status."  WHERE ticket_id  = ".$ticketID;
        //var_dump($updateQuery);die();
        $mysqli->query($updateQuery);

        
        if(!empty($_FILES['attachment']['name']))
        {
            upload_ticket_file($ticketID);
        }

        /*
            Update Ticket Activity
        */
        $comment =  "Ticket Assign To: ".getAgentNameById($assigned_to);
        $comment .=  "<br> Ticket Assign By: ".getAgentNameById($assigned_by);
        $comment .=  "<br> Work Status: ".getWorkStatusById($work_status);
        $visibility = 0;
       

        $insertQuery = "INSERT INTO ticket_activity (ticket_id, perfomed_user_id, comment, visibility, datetime) VALUES (".$ticketID.", ".$userID.", '".$comment."', ".$visibility.", now() ) ";   
        //var_dump($insertQuery);die();
        $mysqli->query($insertQuery);

        //Notify Agent
        $agentLoginId = get_login_id_by_agent_id($assigned_to);
        add_notification($agentLoginId, $ticketID, "Ticket Assign By: ".getAgentNameById($assigned_by));




        $response = array('status' => 'success', 'msg' => 'Ticket Updated:'.$ticketID);
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
          /*$query = "SELECT default_work_status as work_status FROM settings WHERE id  = 1 ";
          $result = $mysqli->query($query);
          $row = $result->fetch_assoc();
          $defaultWorkStatus = $row['work_status'];*/
          
        
           // Insert a new record
           $insertQuery = "INSERT INTO ticket (company_id, project_id, contact_ids, title, details, attachement, reported_on, reported_by, work_status, status) VALUES (".$company_id.", ".$project_id.", '".$contact_ids."', '".$title."', '".$details."', '', now(), ".$userID.", ".$defaultWorkStatus.", 0) ";   
           //var_dump($insertQuery);die();
           $mysqli->query($insertQuery);
           
           if(!empty($_FILES['attachment']['name']))
           {
                upload_ticket_file($mysqli->insert_id);
           }

        $newTicketId = $mysqli->insert_id;
        $comment =  "New Ticket Created By: ".getUserNameById($userID);    
        $visibility = 0;
       

        $insertQuery = "INSERT INTO ticket_activity (ticket_id, perfomed_user_id, comment, visibility, datetime) VALUES (".$newTicketId.", ".$userID.", '".$comment."', ".$visibility.", now() ) ";           
        $mysqli->query($insertQuery);
           
           //$mysqli->insert_id
        
          // Return a success response
          $response = array('status' => 'success', 'msg' => 'Ticket Created:'.$newTicketId);
          echo json_encode($response);
    }
	
  
} else {
  // Return an error response
  $response = array('status' => 'error');
  echo json_encode($response);
}

// Close the database connection
$mysqli->close();

function add_notification($LoginID, $TicketID, $Message)
{
    require 'dbconfig.php';

    $insertQuery = "INSERT INTO notification (login_id, ticket_id, msg, view) VALUES (".$LoginID.", ".$TicketID.", '".$Message."', 0) ";   
    //var_dump($insertQuery);die();
    $mysqli->query($insertQuery);
}


function get_login_id_by_agent_id($AgentID)
{
    require 'dbconfig.php';

    $query = "SELECT id  FROM agent_login WHERE agent_id=".$AgentID;
    error_log("your Query:".$query);
    $result = $mysqli->query($query);
    $returnData = "";

    // Check if any rows were returned
    if ($result->num_rows > 0) {        
        // Fetch each row and add it to the data array
        if ($row = $result->fetch_assoc()) {
            $returnData = $row["id"];
        }       
    }
    return $returnData;

}








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
    
    $uploadDirectory = $_SESSION['WD'].'/ticket_uploads/';

    error_log($uploadDirectory);

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
