 <?php
// Include the database configuration file
require_once 'dbconfig.php';

// Get the form data

$id = $_POST['id'];
$name = $_POST['name'];
$company_id = $_POST['company_id'];
$amount = $_POST['amount'];
$receipt_amount = $_POST['receipt_amount'];
$pending_amount = $_POST['pending_amount'];
$type = $_POST['type'];
$f_status = $_POST['f_status'];
$status = $_POST['status'];



// Check if the data is not blank
//if (!empty($name) && !empty($company_id) && !empty($amount) && !empty($type) && !empty($f_status) && !empty($status) && !empty($receipt_amount) && !empty($pending_amount) )
if (!empty($name) && !empty($company_id) )
{
    $workStatusID="0";
    if(!empty($_POST['id']))
    {
        $workStatusID=$_POST['id'];
    }
    
    //echo $workStatusID;die();
    
    $query = "SELECT COUNT(*) as count FROM project WHERE id  = ".$workStatusID;
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $count = $row['count'];
    //var_dump($count);die();
    if (intval($count) !=  0)
    {
        $updateQuery = "UPDATE project SET name='".$name."' , company_id=".$company_id." , amount='".$amount."' , receipt_amount='".$receipt_amount."', pending_amount='".$pending_amount."' , type='".$type."' , finacial_status='".$f_status."' , status='".$status."' WHERE id  = ".$workStatusID;
        //var_dump($updateQuery);die();
        $mysqli->query($updateQuery);
         $response = array('status' => 'success');
          echo json_encode($response);
    }
    else
    {
        //echo "inserting";die();
         $query = "SELECT COUNT(*) as count FROM project WHERE name  = '$name' ";
          $result = $mysqli->query($query);
          $row = $result->fetch_assoc();
          $count = $row['count'];
          if (intval($count) != 0) {
              $response = array('status' => 'exist');
              echo json_encode($response);
              die();
          }
        
           // Insert a new record
           $insertQuery = "INSERT INTO project (name, company_id, amount, receipt_amount, pending_amount, type, finacial_status, status) VALUES ('$name' , $company_id , '$amount', '$receipt_amount', '$pending_amount' , '$type' , '$f_status' , '$status')";   
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
