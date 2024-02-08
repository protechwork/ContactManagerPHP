<?php
session_start();
// Include the database configuration file
require_once 'dbconfig.php';

// Get the form data


$comment =  $_POST['comment'];
$visibility =  $_POST['visibility'];
$type =  $_POST['type'];

$userID = $_SESSION['user_id'];
$agentID = getAgentIDById($userID);
$agentName = getAgentNameById($agentID);
$emailCredentails = getEmailDetailsByAgentID($agentID);

// Check if the data is not blank
if (!empty($comment) )
{
    
	$ticketID="0";
    if(!empty($_POST['ticket_id']))
    {
        $ticketID=$_POST['ticket_id'];
    }
    
    // Insert a new record
    $insertQuery = "INSERT INTO ticket_activity (ticket_id, perfomed_user_id, comment, visibility, datetime, type) VALUES (".$ticketID.", ".$userID.", '".$comment."', ".$visibility.", now(), ".$type." ) ";   
    //var_dump($insertQuery);die();
    $mysqli->query($insertQuery);

    if($visibility == 1)
    {
        $ticketInfo = getContactEmailByTicketId($ticketID);
        $ticketNo = $ticketInfo["ticket_id"];
        $contactEmail = $ticketInfo["email_id"];
        $createdDate =  $ticketInfo["createddate"];
        $companyName =  $ticketInfo["companyname"];
        $projectName =  $ticketInfo["projectname"];
        $subject =  $ticketInfo["subject"];
        $details =  $ticketInfo["details"];
        $workStatus =  $ticketInfo["workstatus"]; 
        $activityNote =  $comment;    
        
        $bodyData = "Ticket No: $ticketNo <br>
                     Company Name: $companyName <br>
                     Project Name: $projectName <br>
                     Subject: $subject <br>
                     Details: $details <br>
                     Work Status: $workStatus <br>
                     Note Comment: $activityNote <br>                     
                     ";



        send_email($emailCredentails["email"], $emailCredentails["email_pasword"], $contactEmail, "Ticket Status", $bodyData, $emailCredentails["smtp"], $emailCredentails["port"]);    
    }
        
    

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


function getContactEmailByTicketId($ticketID)
{
    require 'dbconfig.php';

    $query = "SELECT 
                cont.email_id, 
                tkt.ticket_id, 
                tkt.reported_on AS createddate, 
                cmp.name AS companyname, 
                proj.name AS projectname, 
                tkt.title AS subject, 
                tkt.details AS details, 
                wsm.name AS workstatus 
                FROM 
                contacts cont                 
                INNER JOIN ticket tkt ON tkt.contact_ids = cont.contact_id 
                INNER JOIN companies cmp ON tkt.company_id = cmp.company_id 
                INNER JOIN project proj ON tkt.project_id = proj.id 
                INNER JOIN work_status_master wsm ON tkt.work_status = wsm.id 
                where 
                tkt.ticket_id =".$ticketID;

    $result = $mysqli->query($query);
    $returnData = array();

    // Check if any rows were returned
    if ($result->num_rows > 0) {        
        // Fetch each row and add it to the data array
        if ($row = $result->fetch_assoc()) {
            $returnData = $row;//["email_id"];
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

function getAgentIDById($ID)
{
    require 'dbconfig.php';

    $query = "SELECT agent_id FROM agent_login WHERE id=".$ID;
    $result = $mysqli->query($query);
    $returnData = "";

    // Check if any rows were returned
    if ($result->num_rows > 0) {        
        // Fetch each row and add it to the data array
        if ($row = $result->fetch_assoc()) {
            
            $returnData = $row["agent_id"];
        }       
    }
    return $returnData;

}

function getEmailDetailsByAgentID($AgentID)
{
    require 'dbconfig.php';

    $query = "SELECT email, email_pasword, smtp, port FROM agent_notification WHERE agent_id=".$AgentID;
    $result = $mysqli->query($query);
    $returnData = array();

    // Check if any rows were returned
    if ($result->num_rows > 0) {        
        // Fetch each row and add it to the data array
        if ($row = $result->fetch_assoc()) {
            $returnData = $row;
        }       
    }
    return $returnData;

}

function send_email($EmailID, $Password, $To, $Subject, $BodyContent, $smtp, $port)
{
  /*use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;*/

  error_log("__DIR__:".__DIR__);
  
  require_once __DIR__ . '/../vendor/phpmailer/src/Exception.php';
  require_once __DIR__ . '/../vendor/phpmailer/src/PHPMailer.php';
  require_once __DIR__ . '/../vendor/phpmailer/src/SMTP.php';

  /*
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;*/


  // passing true in constructor enables exceptions in PHPMailer
  //$mail = new PHPMailer(true);
  $mail = new PHPMailer\PHPMailer\PHPMailer(true);
  
  try {
      // Server settings
      //$mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER; // for detailed debug output
      $mail->SMTPDebug = false; // for detailed debug output
      $mail->isSMTP();
      $mail->Host = $smtp;//'smtp.gmail.com';
      $mail->SMTPAuth = true;
      //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->SMTPSecure = 'ssl';
      //$mail->Port = 587;
      $mail->Port = $port;//465;
  
      $mail->Username = $EmailID; // YOUR gmail email
      $mail->Password = $Password; // YOUR gmail password
  
      // Sender and recipient settings
      $mail->setFrom($EmailID, 'Support Team ICS');
      $mail->addAddress($To, '');
      //$mail->addAddress('aamer@icsweb.in', 'Ammer Sir');
      //$mail->addReplyTo('icsweb.rakesh@gmail.com', 'Rakesh'); // to set the reply to
  
      // Setting the email content
      $mail->IsHTML(true);
      $mail->Subject = $Subject;
      $mail->Body = $BodyContent;
      //$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
  
      $mail->send();
      //echo "Email message sent.";
      error_log("Email message sent.");
  } catch (Exception $e) {
    error_log("Error in sending email. Mailer Error: {$mail->ErrorInfo}");
  }

}


?>
