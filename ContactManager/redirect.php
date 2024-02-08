<?php 
session_start();
//var_dump($_SESSION);die();
$protocol = "";
if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}

error_log("Protocol:".$protocol);
error_log("URL:".$_SERVER['SERVER_NAME']);
error_log("CWD:".getcwd());
$projectDir = explode("/",getcwd())[count(explode("/",getcwd()))-1];
error_log("ProjectDir:".explode("/",getcwd())[count(explode("/",getcwd()))-1]);


$_SESSION['base_url'] = $protocol.$_SERVER['SERVER_NAME'].'/'.$projectDir;
$_SESSION['WD'] = getcwd();// /home1/icsweho2/public_html/icsticket

if(!(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))) 
{
     echo '<script type="text/javascript">window.location = "'.$_SESSION['base_url'].'/login.php";</script>';
}
if($_SESSION['user_type'] == "2")
{
    echo '<script type="text/javascript">window.location = "'.$_SESSION['base_url'].'/contact_users/";</script>';
}
if($_SESSION['user_type'] == "3")
{
    echo '<script type="text/javascript">window.location = "'.$_SESSION['base_url'].'/contact_users/";</script>';
}
if($_SESSION['user_type'] == "4")
{
    echo '<script type="text/javascript">window.location = "'.$_SESSION['base_url'].'/contact_users/";</script>';
}
?>