<?php
session_start();
// Include the database configuration file
require_once 'dbconfig.php';


$uploadDirectory = getcwd().'/../uploads/';

// Handle image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tempFilePath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $filePath = $uploadDirectory . $fileName;

        if (move_uploaded_file($tempFilePath, $filePath)) {
            // Save image path to settings table
            
              $query = "SELECT COUNT(*) as count FROM settings WHERE id = 1";
              $result = $mysqli->query($query);
              $row = $result->fetch_assoc();
              $count = $row['count'];
            
              if ($count > 0) {
                // Update the existing record
                $updateQuery = "UPDATE settings SET logo_path = '$fileName' WHERE id = 1";
                $mysqli->query($updateQuery);
              } else {
                // Insert a new record
                $insertQuery = "INSERT INTO settings (id, logo_path) VALUES (1, '$fileName')";
                $mysqli->query($insertQuery);
              }
            
            header("Location: ".$_SESSION['base_url']."/settings.php?msg=Success");
            die();
        } else {
            header("Location: ".$_SESSION['base_url']."/settings.php?msg=Failed");
            die();
        }
    } else {
        header("Location: ".$_SESSION['base_url']."/settings.php?msg=Failed");
        die();
    }
}

// Close the database connection
$mysqli->close();
?>
