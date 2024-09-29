<?php
session_start();
if(!isset($_SESSION['logged_in']))
{
    exit();
}
if(!isset($_POST['name']) || !isset($_POST['surname']) || !isset($_POST['email']) || !isset($_POST['password'])){
    exit();
}
$name=ucfirst(strtolower(htmlentities($_POST['name'])));
$surname=ucfirst(strtolower(htmlentities($_POST['surname'])));
$email = strtolower(htmlentities(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)));
$password =htmlentities($_POST['password']);
$id=$_SESSION['user_id'];
$error=false;
$error_message=[];
$error_class=[];
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $error_message['email']="Podaj poprawny adres e-mail";
    array_push($error_class,"email");
}
if(preg_match('/[0-9\~\!\@\#\$\%\^\&\*\(\)\-\_\=\+\\{\}\;\'\:\"\,\<\>\.\?]/',$name)){
    $error=true;
    $error_message['name']="Imię musi się składać wyłącznie z liter";
    array_push($error_class,"name");
}else{
    if(strlen($name)<2){
        $error=true;
        $error_message['name']="Imię jest za krótkie";
        array_push($error_class,"name");
    }
}
if(preg_match('/[0-9\~\!\@\#\$\%\^\&\*\(\)\-\_\=\+\\{\}\;\'\:\"\,\<\>\.\?]/',$surname)){
    $error=true;
    $error_message['surname']="Nazwisko musi się składać wyłącznie z liter";
    array_push($error_class,"surname");
}else{
    if(strlen($surname)<2){
        $error=true;
        $error_message['surname']="Nazwisko jest za krótkie";
        array_push($error_class,"surname");
    }
}
if(strlen($password)<1){
    $error = true;
    $error_message['password']="Podałeś błędne hasło";
    array_push($error_class,"password");
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
            if(password_verify($password,$row['password'])){
                $user_mail=$_SESSION['email'];
                $sql="SELECT * FROM users WHERE email='$email' AND email!='$user_mail'";
                $result=mysqli_query($connection,$sql);
                if(mysqli_num_rows($result)==0){
                    $sql="UPDATE `users` SET `email`='$email', `name`='$name', `surname`='$surname' WHERE id_user='$id'";
                    $result=mysqli_query($connection,$sql);
                    if($result){
                        $_SESSION['name']=$name;
                        $_SESSION['surname']=$surname;
                        $_SESSION['email']=$email;
                    }
                    else{
                        $error=true;
                    }
                }
                else{
                    $error = true;
                    $error_message['email']="Email jest już zajęty";
                    array_push($error_class,"email");
                }
            }
            else{
                $error = true;
                $error_message['password']="Podałeś błędne hasło";
                array_push($error_class,"password");
            }
        }
        mysqli_close($connection);
    }
}
$array=[$error,$error_message,$error_class];
echo json_encode($array);
?>