<?php
if(!isset($_POST['code']) || !isset($_POST['password']) || !isset($_POST['checkPassword'])){
    exit();
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$code=$_POST['code'];
$password=htmlentities($_POST['password']);
$check_password=htmlentities($_POST['checkPassword']);
$error=false;
$error_msg='';
if(!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)){
    $error = true;
    $error_msg="Hasło nie spełnia wymagań złożoności";
}
else{
    if($password!=$check_password){
        $error = true;
        $error_msg="Hasła nie są zgodne";
    }
    else{
        require_once "connect.php";
        $connection=mysqli_connect($host,$db_user,$db_password,$db_name);
        if($connection){
            $sql="SELECT reset_password.user_id, users.email FROM reset_password JOIN users ON reset_password.user_id=users.id_user WHERE authorization_code='$code'";
            $result=mysqli_query($connection,$sql);
            $row=mysqli_fetch_assoc($result);
            $user_id=$row['user_id'];
            $email=$row['email'];
            $new_password=password_hash($password,PASSWORD_DEFAULT);
            $sql="UPDATE users SET password='$new_password' WHERE `id_user`='$user_id'";
            $update_result=mysqli_query($connection,$sql);
            if($update_result){
                $error_msg="Zmieniono hasło";
                $sql="DELETE FROM reset_password WHERE `authorization_code`='$code'";
                $result=mysqli_query($connection,$sql);
                require 'phpmailer/src/Exception.php';
                require 'phpmailer/src/PHPMailer.php';
                require 'phpmailer/src/SMTP.php';
                $mail=new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host="smtp.gmail.com";
                $mail->SMTPAuth=true;
                $mail->Username="gorkakiermasz@gmail.com";
                $mail->Password="tu ma być hasło";//rzsdbfjppmckzpvd
                $mail->SMTPSecure="ssl";
                $mail->Port=465;
                $mail->setFrom("gorkakiermasz@gmail.com");
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->CharSet = "UTF-8";
                $mail->Subject="Potwierdzenie zmiany hasła";
                $mail->Body='<html>
                <head>
                    <title>Potwierdzenie zmiany hasła</title>
                </head>
                <body>
                    <p>Tym razem go nie zapomnij.</p>
                    <p>Wiadomość wygenerowana automatycznie. Prosimy nie odpowiadać.</p>
                </body>
                </html>';
                $mail->send();
            }
            else{
                $error=True;
                $error_msg="Błąd serwera";
            }
            mysqli_close($connection);
        }
        else{
            $error=true;
            $error_msg="Błąd serwera";
        }
    }
}
$arr=[$error,$error_msg];
echo json_encode($arr);
?>