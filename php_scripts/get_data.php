<?php
if(!isset($_POST['flag']))
{
    exit();
}
else
{
    $error=false;
    $error_message="";
    $everything=[];
    require_once 'connect.php';
    mysqli_report((MYSQLI_REPORT_STRICT));
    try{
        $connection=new mysqli($host,$db_user,$db_password,$db_name);
        if($connection->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        }
        else{
            $sql="SELECT sample_books.*,(SELECT min(price) FROM users_offers WHERE status='available' AND users_offers.book_id=sample_books.book_ID) AS min FROM sample_books";
            $result=$connection->query($sql);
            mysqli_close($connection);
            if($result){
            $everything= $result->fetch_ALL(MYSQLI_ASSOC); //nieskończone
            }
            else{
                throw new Exception();
            }
        }
    }
    catch(Exception $e){
        $error=true;
        $error_message="Katastrofalny błąd serwera";
    }
    $array=[$error,$error_message,$everything];
    echo json_encode($array);
}
?>