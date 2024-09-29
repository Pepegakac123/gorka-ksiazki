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
$message_reciver = $_POST['chatter'];
$last_message = $_POST['last_message'];

require_once '../php_scripts/connect.php';
$connection=mysqli_connect($host,$db_user,$db_password,$db_name);

if($connection){
    $sql="SELECT * FROM messages WHERE ((sender_id=$message_sender AND reciver_id=$message_reciver) OR (sender_id=$message_reciver AND reciver_id=$message_sender)) AND send_time >'$last_message'";
    $result=mysqli_query($connection,$sql);
    $everything= mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_close($connection);
}
echo json_encode($everything);
?>
