<?php
session_start(); 
if(!isset($_POST['seller'])){
    exit();
}
$seller = htmlentities($_POST['seller']);
require_once 'connect.php';
$connection=mysqli_connect($host,$db_user,$db_password,$db_name);
if($connection){
    $sql="SELECT users_offers.*, sample_books.book_name,sample_books.men FROM users_offers JOIN sample_books ON sample_books.book_ID=users_offers.book_id WHERE `seller`='$seller' AND `status`='available'";
    $result=mysqli_query($connection,$sql);
    $everything= mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_close($connection);
}
echo json_encode($everything);
?>