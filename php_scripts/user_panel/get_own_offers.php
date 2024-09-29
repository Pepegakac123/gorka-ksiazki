<?php
session_start();
if(isset($_SESSION['logged_in'])){
    $error=false;
    $error_msg='';
    $user = $_SESSION['user_id'];
    $user_offers=[];
    require_once '../connect.php';
    mysqli_report(MYSQLI_REPORT_STRICT);
    try{
        $connection = mysqli_connect($host,$db_user,$db_password,$db_name);
        if($connection->connect_errno==0){
            $sql="SELECT users_offers.*, sample_books.book_name FROM users_offers JOIN sample_books ON sample_books.book_ID=users_offers.book_id WHERE seller='$user' AND status='available'";
            $result = mysqli_query($connection,$sql);
            if($result){
                $user_offers= $result->fetch_ALL(MYSQLI_ASSOC);
            }
            else{
                throw new Exception();
            }
            mysqli_close($connection);
        }
        else{
            throw new Exception();
        }
    }
    catch(Exception $e){
        $error=true;
        $error_msg='Katastrofalny błąd serwera. Odśwież stronę';
    }
    $array=[$error,$error_msg,$user_offers];
    echo json_encode($array);
}
else{
    exit();
}
?>