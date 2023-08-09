<?php
// Validate required fields
$requiredFields = array(
  'person_name',
  'mobile_no',
  'user_id',
  'email'
);

foreach ($requiredFields as $field) {
  if (empty($_POST[$field])) {
    $response = array(
      'status' => 'error',
      'message' => 'Please fill in all required fields.'
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

    $updateAgentNotificationQuery = "UPDATE agent_notification SET mobile_no = '$mobileNo', whatsapp_no = '$whatsappNo', smtp = '$smtp', email_pasword = '$emailPassword' WHERE agent_id = $agentId";
    
    // Execute the update query for agent_notification table

    // Update agent_login table
    $userId = $_POST['user_id'];
    $password = $_POST['password'];
    $isAdmin = isset($_POST['is_admin']) ? 0 : 1;// admin 0, agent 1

    $updateAgentLoginQuery = "UPDATE agent_login SET user_id = '$userId', password = '$password', is_admin = $isAdmin WHERE agent_id = $agentId";
    
    // Execute the update query for agent_login table
    
       $mysqli->query($updateAgentMasterQuery);
       $mysqli->query($updateAgentNotificationQuery);
       $mysqli->query($updateAgentLoginQuery);
       
       $mysqli->query("DELTE FROM agent_reporting_to agent_id=".$agentId);
       
       
        foreach ($reportingTo as $reportingId) {
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
    $stmt = $mysqli->prepare("INSERT INTO agent_master (name, difficulty_contact, address) VALUES (?, ?, ?)");
    $stmt->bind_param("sss",$personName, $contactDifficulty, $address);
    $stmt->execute();
    
    $agentId = $stmt->insert_id;$stmt->close();
    
    
    foreach ($reportingTo as $reportingId) {
      $stmt = $mysqli->prepare("INSERT INTO agent_reporting_to (agent_id, reporting_to_id) VALUES (?, ?)");
      $stmt->bind_param("ii",$agentId, $reportingId);
      $stmt->execute();$stmt->close();
    }
    
    $stmt = $mysqli->prepare("INSERT INTO agent_login (agent_id,user_id, password, is_admin) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi",$agentId,$userId, $password, $isAdmin);
    $stmt->execute();$stmt->close();
    
    $stmt = $mysqli->prepare("INSERT INTO agent_notification (agent_id, email, whatsapp_no, mobile_no, smtp, email_pasword) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $agentId, $email, $whatsappNo, $mobileNo, $smtp, $emailPassword);
    $stmt->execute();$stmt->close();
    
    $response = array(
      'status' => 'success',
      'message' => 'Agent saved successfully.'
    );
    echo json_encode($response);  exit;

}

$response = array("status" => "error");
echo json_encode($response);



?>
