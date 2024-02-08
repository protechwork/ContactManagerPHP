<?php

$hostName = $_POST['host_name'];
$userName = $_POST['user_name'];
$password = $_POST['password'];
$databaseName = $_POST['database_name'];

/*
$hostName = 'localhost'; // Replace with your database host
$userName = 'icsweho2_test_user'; // Replace with your database userName
$password = 'icsweho2_test_user'; // Replace with your database password
$databaseName = 'icsweho2_test_ticket'; // Replace with your database name
*/

//Creating New Database

/*
$conn = new mysqli($hostName, $userName, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE ".$databaseName;
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully with the name newDB";
} else {
    echo "Error creating database: " . $conn->error;
}
*/


$new_conn=mysqli_connect($hostName, $userName, $password, $databaseName);
$quries=file_get_contents("contact_manager_db.sql");
$res=mysqli_multi_query($new_conn,$quries);

$file_contain = file_get_contents('dbconfig.php');
$file_contain = str_replace('%%HOST_NAME%%', $hostName, $file_contain);
$file_contain = str_replace('%%USER_NAME%%', $userName, $file_contain);
$file_contain = str_replace('%%PASSWORD%%', $password, $file_contain);
$file_contain = str_replace('%%DATABASE%%', $databaseName, $file_contain);

// Save the modified content back to the file
file_put_contents('dbconfig.php', $file_contain);
//file_put_contents('../ajax/test_dbconfig.php', $file_contain);
//file_put_contents('../contact_users/ajax/test_dbconfig.php', $file_contain);

file_put_contents('../ajax/dbconfig.php', $file_contain);
file_put_contents('../contact_users/ajax/dbconfig.php', $file_contain);

echo "successfully created database";




?>