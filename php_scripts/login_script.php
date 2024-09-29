<?php
session_start();
if(!isset($_SESSION['logged_in'])){
    if(isset($_POST['email']) && isset($_POST['password'])){
        $error = false;
        $error_message="";
        $login_result=false;
        $email=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password=$_POST['password'];
        $email=htmlentities($email);
        $password=htmlentities($password);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $error_message="Podano zły email lub hasło";
        }
        if(strlen($password)<1){
            $error = true;
            $error_message="Podano zły email lub hasło";
        }
        if(!$error){
            require_once "connect.php";
            mysqli_report((MYSQLI_REPORT_STRICT));
            try{
                $connection=new mysqli($host,$db_user,$db_password,$db_name);
                if($connection->connect_errno!=0){
                    throw new Exception(mysqli_connect_errno());
                }
                else{
                $sql="SELECT * FROM users WHERE email='$email'";
                $result=$connection->query($sql);
                if(!$result)throw new Exception($connection->error);
                $number_of_users=$result->num_rows;
                if($number_of_users==1){
                    $user_data=mysqli_fetch_assoc($result);
                    if(password_verify($password,$user_data['password'])){
                        $login_result=true;
                        $_SESSION['logged_in']=true;
                        $_SESSION['user_id']=$user_data['id_user'];
                        $_SESSION['email']=$user_data['email'];
                        $_SESSION['name']=$user_data['name'];
                        $_SESSION['surname']=$user_data['surname'];
                    }
                    else{
                        $error_message="Podano zły email lub hasło";
                    }
                }
                else
                {
                    $error_message="Podano zły email lub hasło";
                }
                $connection->close();
                }
            }
            catch(Exception $e){
                $error_message="Katastrofalny bład systemu";
                $error=true;
            }
        }
        $array=[$error,$error_message,$login_result];
        echo json_encode ($array);
    }
    else{
        header("Location:../strona-logowania");
        exit();
    }
}else{
    exit();
}
?>
