<?php
session_start();
if(isset($_SESSION["admin_permission"]) && !isset($_POST["login"]) && !isset($_POST["password"])){
    exit();
}
$login=htmlentities($_POST["login"]);
$password=htmlentities($_POST["password"]);
$sql="SELECT * FROM admins WHERE login='$login'";
require_once "../../php_scripts/connect.php";
$connection=mysqli_connect($host,$db_user,$db_password,$db_name);
$sign_in_result=false;
$error_text='';
if(!mysqli_connect_errno()){
    $result=mysqli_query($connection,$sql);
    if($result && $result->num_rows==1){
        $data=mysqli_fetch_assoc($result);
        $admin_password=$data['password'];
        if(password_verify($password,$admin_password)){
            $sign_in_result=true;
            $_SESSION["admin_permission"]=true;
        }
        else{
            $error_text="Podano złe dane";
        }
    }
    else{
        $error_text="Podano złe dane";
    }
    mysqli_close($connection);
}
else{
    $error_text="Błąd serwera";
}
$arr=[$sign_in_result,$error_text];
echo json_encode($arr);
?>