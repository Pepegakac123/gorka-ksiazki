<?php
if(isset($_POST['book_id']) && isset($_POST['number_of_offers'])){
    $bookId=htmlentities($_POST['book_id']);
    $number_of_offers=htmlentities($_POST['number_of_offers']);
    $number_of_offers+=12;
    require_once "connect.php"; 
    $everything=[];
    mysqli_report(MYSQLI_REPORT_STRICT);
    try{
        $connection=new mysqli($host,$db_user,$db_password,$db_name);
        if($connection->connect_errno==0){
            $sql="SELECT users_offers.*, users.name,users.surname FROM users_offers JOIN users ON users_offers.seller=users.id_user WHERE book_id='$bookId' AND status='available' ORDER BY price ASC LIMIT $number_of_offers";
            $result=$connection->query($sql);
            $everything= $result->fetch_ALL(MYSQLI_ASSOC);
            $everything=array_slice($everything,$number_of_offers-12,$number_of_offers);
            mysqli_close($connection);
        }
        else{
            throw new Exception(mysqli_connect_errno());
        }
    }
    catch(Exception $e){

    }
    echo json_encode($everything);
}
else{
    exit();
}
?>