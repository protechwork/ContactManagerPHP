<?php
// Include the database configuration file
require_once 'dbconfig.php';

// Get the form data
$contact_id = $_POST['contact_id'];
$company_id = $_POST['company_id'];
$contact_name = $_POST['contact_name'];
$email_id = $_POST['email_id'];
$mobile_no = $_POST['mobile_no'];
$display_name =$_POST['display_name'];// $_FILES['display_name']['name'];
$display_image = $_FILES['display_image']['name'];//$_POST['display_image'];
$status = $_POST['status'];

$userName = $_POST['user_name'];
$userPass = $_POST['user_pass'];

//var_dump($display_image);die();

//var_dump(!is_null($contact_id) && !is_null($company_id) && !empty($contact_name) && !empty($email_id) && !empty($mobile_no) && !empty($display_name) && !empty($display_image) && !is_null($status));die();
//var_dump($contact_id);
//var_dump((!empty(1)) );
//var_dump((!is_null($contact_id) && !is_null($company_id) && !empty($contact_name) && !empty($email_id) && !empty($mobile_no) && !empty($display_name) && !empty($display_image) && !is_null($status)));
// Check if the data is not blank
if (/*!empty($contact_id) &&*/ !empty($company_id) && !empty($contact_name) && !empty($email_id) && !empty($mobile_no) && !empty($display_name) && !empty($display_image) && !is_null($status)   && !empty($userName) && !empty($userPass))
{
   
  // Check if the data already exists in the contact table
  $query = "SELECT COUNT(*) as count FROM contacts WHERE contact_id  = ".$contact_id;
  $result = $mysqli->query($query);
  $row = $result->fetch_assoc();
  $count = $row['count'];
  if (intval($count) !=  0) {
    //  echo "updateing;";die();
    // Update the existing record
    $updateQuery = "UPDATE contacts SET contact_id=$contact_id, company_id=$company_id, name='$contact_name', email_id='$email_id', mobile_no='$mobile_no', display_name='$display_name', display_image='$display_image', status= $status WHERE contact_id=".$contact_id;
    $mysqli->query($updateQuery);
    
    $uploadDirectory = '/home1/icsweho2/public_html/ContactManager/contact_uploads/';
    $imageName = $newContactID.".jpg";
    $filePath = $uploadDirectory.$contact_id.".jpg";
    if(file_exists($filePath)) 
    {
      chmod($filePath,0755); 
      unlink($filePath);
    }

     if (move_uploaded_file($_FILES['display_image']['tmp_name'], $filePath))
     {
        $updateQuery = "UPDATE contacts SET display_image='$imageName' WHERE contact_id=".$contact_id;
        $mysqli->query($updateQuery);
     }
    
    $updateQuery = "UPDATE agent_login SET user_id='$userName', password='$userPass' WHERE contact_id=".$contact_id;
    $mysqli->query($updateQuery);
  } else {
    // Insert a new record
    //echo "inserting";die();
    
    $query = "SELECT COUNT(*) as count FROM contacts WHERE email_id='$email_id' OR mobile_no='$mobile_no' ";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $count = $row['count'];
    //var_dump($count,$query);die();
    if (intval($count) != 0) {
        $response = array('status' => 'error', 'msg' => 'email or mobile already exist');
        echo json_encode($response);
        die();
    }
  
  
  
    $insertQuery = "INSERT INTO contacts (contact_id, company_id, name, email_id, mobile_no, display_name, display_image, status) VALUES ($contact_id, $company_id, '$contact_name', '$email_id', '$mobile_no', '$display_name', '$display_image', $status)";
    $mysqli->query($insertQuery);
    
    $newContactID = $mysqli -> insert_id;
    
    $uploadDirectory = '/home1/icsweho2/public_html/ContactManager/contact_uploads/';
    $imageName = $newContactID.".jpg";
    $filePath = $uploadDirectory.$newContactID.".jpg";
     if (move_uploaded_file($_FILES['display_image']['tmp_name'], $filePath))
     {
        $updateQuery = "UPDATE contacts SET display_image='$imageName' WHERE contact_id=".$newContactID;
        $mysqli->query($updateQuery);
     }
    
    
    $insertQuery = "INSERT INTO agent_login (contact_id, user_id, password, is_admin) VALUES ($newContactID, '$userName', '$userPass', 2)";
    $mysqli->query($insertQuery);
  }

  // Return a success response
  $response = array('status' => 'success');
  echo json_encode($response);
} else {
  // Return an error response
  $response = array('status' => 'error', 'msg' => 'please fill all fields');
  echo json_encode($response);
}

// Close the database connection
$mysqli->close();

function upload_file($DisplayImage)
{
    
}

?>
