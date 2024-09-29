<?php
session_start();
if(!isset($_SESSION['logged_in']) || !isset($_POST['offer']) || !isset($_POST['status'])){
    exit();
}
$offer = htmlentities($_POST['offer']);
$user=$_SESSION['user_id'];
$status=htmlentities($_POST['status']);
$update="status='$status'";
if($status==="available"){
    $update.=", customer=0";
}
$result=false;
require_once "../connect.php";
$connection=mysqli_connect($host,$db_user,$db_password,$db_name);
if(!mysqli_connect_errno()){
    $sql_data="SELECT uo.seller,uo.customer,uo.photo1,uo.photo2, s.book_name FROM users_offers AS uo JOIN sample_books AS s ON s.book_ID=uo.book_id WHERE offer_id='$offer'";
    $result_data=mysqli_query($connection,$sql_data);
    $data=mysqli_fetch_array($result_data);
    $sql="UPDATE users_offers SET $update WHERE offer_id='$offer' AND (seller='$user' OR customer='$user')";
    $result=mysqli_query($connection,$sql);
    $was_updated=mysqli_affected_rows($connection);
    if($was_updated){
        if($status=="sold"){
            $array=[$data["photo1"],$data["photo2"]];
            foreach($array as $photo){
                if($photo){
                    $path="../../$photo";
                    if(file_exists($path)){
                        unlink($path);
                    }
                }
            }
            $msg="<b>Sprzedano: ".$data["book_name"]."</b>";
        }
        elseif($status=="available") {
            $msg="<b>Wycofano: ".$data["book_name"]." - oferta jest ponownie w sprzedaży</b>";
        }
        $sender;
        $reciver;
        if($data["seller"]==$user){
            $sender=$data["seller"];
            $reciver=$data["customer"];
        }
        else{
            $reciver=$data["seller"];
            $sender=$data["customer"];
        }
        $sql_send="INSERT INTO messages (message,sender_id,reciver_id) VALUES ('$msg','$sender','$reciver')";
        $result=mysqli_query($connection,$sql_send);
    }
    mysqli_close($connection);
}
echo json_encode($was_updated);

?>