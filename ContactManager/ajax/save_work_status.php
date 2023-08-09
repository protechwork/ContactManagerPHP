<?php
// Include the database configuration file
require_once 'dbconfig.php';

// Get the form data
$work_status_name = $_POST['name'];
$link_status = $_POST['link_status'];


// Check if the data is not blank
if (!empty($work_status_name) && !empty($link_status) )
{
    $workStatusID="0";
    if(!empty($_POST['work_status_id']))
    {
        $workStatusID=$_POST['work_status_id'];
    }
    
    $query = "SELECT COUNT(*) as count FROM work_status_master WHERE id  = ".$workStatusID;
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $count = $row['count'];
    //var_dump($count);die();
    if (intval($count) !=  0)
    {
        $updateQuery = "UPDATE work_status_master SET name='".$work_status_name."', link_status=".$link_status." WHERE id  = ".$workStatusID;
        //var_dump($updateQuery);die();
        $mysqli->query($updateQuery);
         $response = array('status' => 'success');
          echo json_encode($response);
    }
    else
    {
         $query = "SELECT COUNT(*) as count FROM work_status_master WHERE name  = '$work_status_name' ";
          $result = $mysqli->query($query);
          $row = $result->fetch_assoc();
          $count = $row['count'];
          if (intval($count) != 0) {
              $response = array('status' => 'exist');
              echo json_encode($response);
              die();
          }
        
           // Insert a new record
           $insertQuery = "INSERT INTO work_status_master (name, link_status) VALUES ('$work_status_name', $link_status)";   
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
