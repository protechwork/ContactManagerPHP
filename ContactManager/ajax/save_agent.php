<?php
// Validate required fields
$requiredFields = array(
  'person_name',
  'user_id',
  'password',
  //'is_admin',
  'email',
  'whatapp_no',
  'mobile_no',
  'agent_type'
);

foreach ($requiredFields as $field) {
  if (empty($_POST[$field]) || ($_POST[$field] == "")) {
    $response = array(
      'status' => 'error',
      'message' => 'Please fill in all Mandatory fields.'
    );
    echo json_encode($response);
    exit;
  }
}

// Include database connection and initialize variables
include_once 'dbconfig.php';

$personName = $_POST['person_name'];
$contactDifficulty = $_POST['contact_in_difficulty'];
$address = $_POST['address'];
$reportingTo = $_POST['reporting_to'];
$userId = $_POST['user_id'];
$password = $_POST['password'];
$isAdmin = $_POST['is_admin'];
$email = $_POST['email'];
$whatsappNo = $_POST['whatapp_no'];
$mobileNo = $_POST['mobile_no'];
$smtp = $_POST['smtp'];
$emailPassword = $_POST['email_password'];

$city = $_POST['city'];
$aadhar_no = $_POST['aadhar_no'];
$pan_no = $_POST['pan_no'];
$photo = $_FILES['photo']['name'];

$agent_type = $_POST['agent_type'];



$isAdmin = isset($_POST['is_admin']) ? 1 : 0;

/*
if(!empty($photo))
{
  $uploadDirectory = '/home1/icsweho2/public_html/ContactManager/agent_uploads/';
  $imageName = $newContactID.".jpg";
  $filePath = $uploadDirectory.$contact_id.".jpg";
  if(file_exists($filePath)) 
  {
    chmod($filePath,0755); 
    unlink($filePath);
  }

  if (move_uploaded_file($_FILES['photo']['tmp_name'], $filePath))
  {    
    $mysqli->query("UPDATE agent_master SET photo='$imageName' WHERE id=".$contact_id);
  }
}*/


if (empty($_POST['id'])) {
    // Avoid duplicate entry in tables
    $stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM agent_master WHERE name = :name");
    $stmt->bindParam(":name", $personName);//var_dump($stmt->fetch());//var_dump($stmt->execute(),$stmt, $stmt->fetch(),$stmt,$personName, $stmt->fetch(),count($stmt->fetch()) );die();
    $stmt->execute();//var_dump($stmt->fetch()["cnt"]); die();
    if (intval($stmt->fetch()["cnt"]) > 0) {
      $response = array(
        'status' => 'error',
        'message' => 'Agent name already exists.'
      );
      echo json_encode($response);
      exit;
    }
    //$stmt->close();
    
    $stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM agent_notification WHERE mobile_no = :mobile_no");
    $stmt->bindParam(":mobile_no", $mobileNo);
    
    $stmt->execute();//var_dump($stmt,$stmt->fullQuery, $mobileNo);die();
    if (intval($stmt->fetch()["cnt"]) > 0) {
      $response = array(
        'status' => 'error',
        'message' => 'Mobile number already exists.'
      );
      echo json_encode($response);
      exit;
    }
    //$stmt->close();
    
    $stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM agent_login WHERE user_id = :user_id");
    $stmt->bindParam(":user_id", $userId);
    $stmt->execute();
    if (intval($stmt->fetch()["cnt"]) > 0) {
      $response = array(
        'status' => 'error',
        'message' => 'User ID already exists.'
      );
      echo json_encode($response);
      exit;
    }
    //$stmt->close();
    
    $stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM agent_notification WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    if (intval($stmt->fetch()["cnt"]) > 0) {
      $response = array(
        'status' => 'error',
        'message' => 'Email already exists.'
      );
      echo json_encode($response);
      exit;
    }
    //$stmt->close();


}

// Insert or update data in tables based on the presence of an ID
if (!empty($_POST['id'])) {
    
    $agentId = $_POST['id'];

    // Update agent_master table
    $personName = $_POST['person_name'];
    $contactDifficulty = $_POST['contact_in_difficulty'];
    $address = $_POST['address'];

    $updateAgentMasterQuery = "UPDATE agent_master SET name = '$personName', difficulty_contact = '$contactDifficulty', address = '$address' WHERE id = $agentId";
    
    // Execute the update query for agent_master table

    // Update agent_notification table
    $mobileNo = $_POST['mobile_no'];
    $whatsappNo = $_POST['whatapp_no'];
    $smtp = $_POST['smtp'];
    $emailPassword = $_POST['email_password'];

    $updateAgentNotificationQuery = "UPDATE agent_notification SET email='$email', mobile_no = '$mobileNo', whatsapp_no = '$whatsappNo', smtp = '$smtp', email_pasword = '$emailPassword' WHERE agent_id = $agentId";
    
    // Execute the update query for agent_notification table

    // Update agent_login table
    $userId = $_POST['user_id'];
    $password = $_POST['password'];
    //$isAdmin = isset($_POST['is_admin']) ? 0 : 1;// admin 0, agent 1
    $isAdmin = isset($_POST['is_admin']) ? 1 : 0;

    $updateAgentLoginQuery = "UPDATE agent_login SET user_id = '$userId', password = '$password', is_admin = $isAdmin , agent_type = $agent_type WHERE agent_id = $agentId";
    

    if(!empty($photo))
    {
      $uploadDirectory = '/home1/icsweho2/public_html/ContactManager/agent_uploads/';
      $imageName = $agentId.".jpg";
      $filePath = $uploadDirectory.$agentId.".jpg";
      if(file_exists($filePath)) 
      {
        chmod($filePath,0755); 
        unlink($filePath);
      }

      if (move_uploaded_file($_FILES['photo']['tmp_name'], $filePath))
      {    
        $mysqli->query("UPDATE agent_master SET photo='$imageName' WHERE id=".$agentId);
      }
    }

    // Execute the update query for agent_login table
    error_log("your Update Agent Master Query:".$updateAgentMasterQuery);
    error_log("your Update Agent Notification Query:".$updateAgentNotificationQuery);
    error_log("your Update Agent Login Query:".$updateAgentLoginQuery);


       $mysqli->query($updateAgentMasterQuery);
       $mysqli->query($updateAgentNotificationQuery);
       $mysqli->query($updateAgentLoginQuery);
       
       $mysqli->query("DELETE FROM agent_reporting_to WHERE agent_id=".$agentId);
       $commaSeparatedIds = explode(',', $reportingTo);


       error_log("Post Data reporting To:".$commaSeparatedIds);

       

        foreach ($commaSeparatedIds as $reportingId) {
          $stmt = $mysqli->prepare("INSERT INTO agent_reporting_to (agent_id, reporting_to_id) VALUES (?, ?)");
          $stmt->bind_param("ii",$agentId, $reportingId);
          $stmt->execute();
          $stmt->close();
        }
       
    // Handle the execution of update queries and return appropriate response
      
      $response = array(
      'status' => 'success',
      'message' => 'Agent Updated successfully.'
    );
    echo json_encode($response);  exit;
} else {
   // Insert or update data
    $stmt = $mysqli->prepare("INSERT INTO agent_master (name, difficulty_contact, address, city, aadhar_no, pan_no, photo) VALUES (?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("sssssss",$personName, $contactDifficulty, $address, $city, $aadhar_no, $pan_no, $photo);
    $stmt->execute();
    
    $agentId = $stmt->insert_id;$stmt->close();
    
    $commaSeparatedIds = explode(',', $reportingTo);

    foreach ($commaSeparatedIds as $reportingId) {
      $stmt = $mysqli->prepare("INSERT INTO agent_reporting_to (agent_id, reporting_to_id) VALUES (?, ?)");
      $stmt->bind_param("ii",$agentId, $reportingId);
      $stmt->execute();$stmt->close();
    }
    
    $stmt = $mysqli->prepare("INSERT INTO agent_login (agent_id,user_id, password, is_admin, agent_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii",$agentId,$userId, $password, $isAdmin, $agent_type);
    $stmt->execute();$stmt->close();
    
    $stmt = $mysqli->prepare("INSERT INTO agent_notification (agent_id, email, whatsapp_no, mobile_no, smtp, email_pasword) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $agentId, $email, $whatsappNo, $mobileNo, $smtp, $emailPassword);
    $stmt->execute();$stmt->close();


    if(!empty($photo))
    {
      $uploadDirectory = '/home1/icsweho2/public_html/ContactManager/agent_uploads/';
      $imageName = $agentId.".jpg";
      $filePath = $uploadDirectory.$agentId.".jpg";
      if(file_exists($filePath)) 
      {
        chmod($filePath,0755); 
        unlink($filePath);
      }

      if (move_uploaded_file($_FILES['photo']['tmp_name'], $filePath))
      {    
        $mysqli->query("UPDATE agent_master SET photo='$imageName' WHERE id=".$agentId);
      }
    }

    
    $response = array(
      'status' => 'success',
      'message' => 'Agent saved successfully.'
    );
    echo json_encode($response);  exit;

}

$response = array("status" => "error");
echo json_encode($response);



?>
