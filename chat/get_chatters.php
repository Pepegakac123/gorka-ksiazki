<?php
session_start();
if(!isset($_SESSION['logged_in']))
{
    exit();
}
if(!isset($_POST['type'])){
    exit();
}
$type=$_POST['type'];
$user = $_SESSION['user_id'];
require_once '../php_scripts/connect.php';
$connection=mysqli_connect($host,$db_user,$db_password,$db_name);
if($connection){
    $sql="";
    if($type=="all")
    {
        $sql="SELECT if(reciver_id='$user',sender_id,reciver_id) AS chatter,MAX(send_time) as last_msg,(SELECT CONCAT(name,' ', surname) FROM users WHERE users.id_user=chatter) AS chatter_name FROM messages WHERE (reciver_id='$user' OR sender_id='$user') AND reciver_id!=0 AND sender_id!=0 GROUP BY chatter ORDER BY last_msg DESC";
    }
    else{
        if($type=="buy"){
            $sql="SELECT s.book_name,uo.offer_id,uo.price,uo.seller AS chatter,uo.customer, CONCAT(u.name,' ',u.surname) AS chatter_name ,(SELECT MAX(send_time) FROM messages WHERE (sender_id=uo.seller AND reciver_id=uo.customer) OR (sender_id=uo.customer AND reciver_id=uo.seller)) AS last_msg FROM sample_books AS s JOIN (users_offers AS uo JOIN users AS u ON uo.seller=u.id_user) ON s.book_ID=uo.book_id WHERE customer='$user' AND uo.status='reserved' ORDER BY last_msg DESC";
        }
        elseif($type=="sell")
        {
            $sql="SELECT s.book_name,uo.offer_id,uo.price,uo.seller,uo.customer AS chatter, CONCAT(u.name,' ',u.surname) AS chatter_name ,(SELECT MAX(send_time) FROM messages WHERE (sender_id=uo.seller AND reciver_id=uo.customer) OR (sender_id=uo.customer AND reciver_id=uo.seller)) AS last_msg FROM sample_books AS s JOIN (users_offers AS uo JOIN users AS u ON uo.customer=u.id_user) ON s.book_ID=uo.book_id WHERE seller='$user' AND uo.status='reserved' ORDER BY last_msg DESC";
        }
    }
    $result=mysqli_query($connection,$sql);
    $everything= mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_close($connection);
}
echo json_encode($everything);
?>