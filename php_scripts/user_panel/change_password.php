<?php
session_start();
if(!isset($_SESSION['logged_in']))
{
    exit();
}
if(!isset($_POST['current_password']) || !isset($_POST['new_password']) || !isset($_POST['check_password'])){
    exit();
}
$current_password = htmlentities($_POST['current_password']);
$new_password = htmlentities($_POST['new_password']);
$check_password = htmlentities($_POST['check_password']);
$id=$_SESSION['user_id'];
$error=false;
$error_message=[];
$error_class=[];
if(!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $new_password)){
    $error=true;
    $error_message['new_password']="Hasło nie spełnia wymagań";
    array_push($error_class,"new_password");
}
if($new_password!=$check_password){
    $error=true;
    $error_message['check_password']="Hasła nie są zgodne";
    array_push($error_class,"new_password");
    array_push($error_class,"check_password");
}
if(!$error){
    require_once '../connect.php';
    $connection=mysqli_connect($host,$db_user,$db_password,$db_name);
    if($connection)
    {
        $sql="SELECT * FROM users WHERE id_user='$id'";
        $result=mysqli_query($connection,$sql);
        if($result){
            $row=mysqli_fetch_array($result);
            if(password_verify($current_password,$row['password'])){
                $password=password_hash($new_password,PASSWORD_DEFAULT);
                $sql="UPDATE `users` SET `password`='$password' WHERE id_user='$id'";
                $result=mysqli_query($connection,$sql);
                if(!$result){
                    $error=true;
                }
            }
            else{
                $error=true;
                $error_message['current_password']="Podałeś błędne hasło";
                array_push($error_class,"current_password");
            }
        }
        mysqli_close($connection);
    }
}
$array=[$error,$error_message,$error_class];
echo json_encode($array);
?>