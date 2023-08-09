<?php
// Include the database configuration file
require_once 'dbconfig.php';

// Get the form data
$company_name = $_POST['company_name'];
$gst = $_POST['gst'];
$address = $_POST['address'];

// Check if the data is not blank
if (!empty($company_name) && !empty($gst) && !empty($address) )
{
    $companyID="0";
    if(!empty($_POST['company_id']))
    {
        $companyID=$_POST['company_id'];
    }
    
    $query = "SELECT COUNT(*) as count FROM companies WHERE company_id  = ".$companyID;
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $count = $row['count'];
    //var_dump($count);die();
    if (intval($count) !=  0)
    {
        $updateQuery = "UPDATE companies SET name='".$company_name."', GST='".$gst."', Address='".$address."' WHERE company_id  = ".$companyID;
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
