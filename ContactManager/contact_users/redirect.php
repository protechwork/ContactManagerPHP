<?php 
session_start();
ini_set('log_errors', 1);
//ini_set('error_log', $errorPath);
ini_set('error_log', '/home1/icsweho2/public_html/ContactManager/Error/error.log');

//var_dump($_SESSION);die();
error_log("user_type:".$_SESSION['user_type']);
error_log("baseurl:".$_SESSION['base_url']);
if(!(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))) 
{
     echo '<script type="text/javascript">window.location = "'.$_SESSION['base_url'].'/login.php";</script>';
}
if($_SESSION['user_type'] != "2" && $_SESSION['user_type'] != "3" && $_SESSION['user_type'] != "4")
{
    echo '<script type="text/javascript">window.location = "'.$_SESSION['base_url'].'/index.php";</script>';
}

?>