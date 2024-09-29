<?php
session_start();
if(!isset($_SESSION['logged_in'])){
    exit();
}
if(!isset($_POST['id']) || !isset($_POST['price'])){
    exit();
}
$offer=htmlentities($_POST['id']);
$price=htmlentities($_POST['price']);
$user=$_SESSION['user_id'];
$result=false;
require_once '../connect.php';
$connection = mysqli_connect($host,$db_user,$db_password,$db_name);
if($connection){
    $sql="UPDATE users_offers SET `price`='$price' WHERE `seller`='$user' AND `offer_id`='$offer' AND status='available'";
    $result = mysqli_query($connection,$sql);
    $was_updated=mysqli_affected_rows($connection);
    mysqli_close($connection);
}
echo json_encode($was_updated);
?>