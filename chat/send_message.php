<?php
session_start();
if(!isset($_SESSION['logged_in']))
{
    exit();
}
if(!isset($_POST['flag'])){
    exit();
}
$message_sender = $_SESSION['user_id'];
$message_reciver = htmlentities($_POST['chatter']);
$message = htmlentities($_POST['message']);
require_once '../php_scripts/connect.php';
$connection=mysqli_connect($host,$db_user,$db_password,$db_name);

if($connection){
    $sql="INSERT INTO `messages` (`message`, `sender_id`, `reciver_id`) VALUES ('$message', '$message_sender', '$message_reciver');";
    $result=$connection->query($sql);
    mysqli_close($connection);
}
echo json_encode($result);
?>
