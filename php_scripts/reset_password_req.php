<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_SESSION['logged_in']) || !isset($_POST['email'])){
    exit();
}
$email=filter_var($_POST['email']);
$email=strtolower(htmlentities($email,FILTER_SANITIZE_EMAIL));
$error=false;
$error_msg="";
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $error_msg="Podaj poprawny adres e-mail";
}
if(!$error){
    require_once "connect.php";
    $connection=mysqli_connect($host,$db_user,$db_password,$db_name);
    if(!mysqli_connect_errno()){
        $sql="SELECT id_user, email FROM users WHERE email='$email'";
        $result=mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)==1){
            $row=mysqli_fetch_assoc($result);
            $user_id=$row["id_user"];
            $randomCode=generateRandomCode(10);
            $sql="INSERT INTO `reset_password`(`user_id`, `authorization_code`) VALUES ('$user_id','$randomCode')";
            $result=mysqli_query($connection,$sql);
            if($result){
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
                $mail->Subject="Link do zresetowania hasła";
                $mail->Body='<html>
                <head>
                    <title>Link do zresetowania hasła</title>
                </head>
                <body>
                    <a href="http://localhost/g%C3%B3rka_Allegro/ksiazki-gorka/zresetuj-haslo?code='.$randomCode.'">Kliknij link, aby zresetować hasło.</a>
                    <p>Wiadomość wygenerowana automatycznie. Prosimy nie odpowiadać.</p>
                </body>
                </html>';
                if($mail->send()){
                    $error_msg="Na twój adres email wysłano link do zresetowania hasła, będzie on działał przez godzinę. Jeśli nie otrzymasz wiadomości, sprawdź spam.";
                }
                else{
                    $error=true;
                    $error_msg="Błąd serwera";
                }
            }
            else{
                $error=true;
                $error_msg="Błąd serwera";
            }
        }
        else{
            $error=true;
            $error_msg="Nie znaleziono takiego adresu email";
        }
        mysqli_close($connection);
    }
    else{
        $error=true;
        $error_msg="Błąd serwera";
    }
}
function generateRandomCode($length) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = mt_rand(0, strlen($characters) - 1);
        $code .= $characters[$randomIndex];
    }

    return $code;
}
$arr=[$error,$error_msg];
echo json_encode($arr);
?>