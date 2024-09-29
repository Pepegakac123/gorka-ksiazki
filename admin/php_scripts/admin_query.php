<?php
session_start();
if(!isset($_SESSION["admin_permission"]) && !isset($_POST["query"])){
    exit();
}
$sql=$_POST["query"];
require_once "../../php_scripts/connect.php";
$connection = mysqli_connect($host,$db_user,$db_password,$db_name);
$arr=[];
$affected_rows=0;
$msg="";
$error=false;
if(!mysqli_connect_errno()){
    $result = mysqli_query($connection,$sql);
    if($result){
        if(!is_bool($result)){
            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                array_push($arr,$row);
            }
        }
        $affected_rows=mysqli_affected_rows($connection);
        $msg="Wykonano zapytanie";
    }
    else{
        $msg="Zapytanie jest błędne";
        $error=true;
    }
    mysqli_close($connection);
}
else{
    $error=true;
    $msg="Nie można uzyskać połącznia z bazą danych";
}
$response=[$error,$msg,$arr,$affected_rows];
echo json_encode($response);
?>