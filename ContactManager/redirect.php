<?php 
session_start();
//var_dump($_SESSION);die();
if(!(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))) 
{
     echo '<script type="text/javascript">window.location = "https://icsweb.in/ContactManager/login.php";</script>';
}
if($_SESSION['user_type'] == "2")
{
    echo '<script type="text/javascript">window.location = "https://icsweb.in/ContactManager/contact_users/";</script>';
}
?>