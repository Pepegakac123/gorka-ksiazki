<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
if(!isset($_SESSION['logged_in'])){
    if(isset($_POST['register_email']) && isset($_POST['register_password']) && isset($_POST['check_password']) && isset($_POST['name']) && isset($_POST['surname'])){ //    
        $error = false;
        $error_message=[];
        $register_result=false;
        $error_class=[];
        $email=filter_var($_POST['register_email']);
        $register_email=strtolower(htmlentities($email, FILTER_SANITIZE_EMAIL));
        $password=htmlentities($_POST['register_password']);
        $check_password=htmlentities($_POST['check_password']);
        $name=ucfirst(strtolower(htmlentities($_POST['name'])));
        $surname=ucfirst(strtolower(htmlentities($_POST['surname'])));
        if(!filter_var($register_email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $error_message['register-email']="Podaj poprawny adres e-mail";
            array_push($error_class,"register_email");
        }
        if(!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)){
            $error = true;
            $error_message['register-password']="Hasło nie spełnia wymagań złożoności";
            array_push($error_class,"register_password");
        }
        if($password!=$check_password){
            $error = true;
            $error_message['password-check']="Hasła nie są zgodne";
            array_push($error_class,"register_password");
            array_push($error_class,"check_password");
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
        if(!$error){
            require_once "connect.php";
            try{
                $connection=new mysqli($host,$db_user,$db_password,$db_name);
                if($connection->connect_errno!=0){
                    throw new Exception(mysqli_connect_errno());
                }
                else{
                $sql="SELECT * FROM users WHERE email='$register_email'";
                $result=$connection->query($sql);
                if(!$result) throw new Exception($connection->error);
                if($result->num_rows!=0){
                    $error=true;
                    $error_message['register-email']="Podany adres email jest przypisany do innego konta";
                    array_push($error_class,'register_email');
                }
                if(!$error){
                    $password=password_hash($password,PASSWORD_DEFAULT);
                    $sql="INSERT INTO users VALUES (NULL,'$register_email','$password','$name','$surname')";
                    $result=$connection->query($sql);
                    if(!$result){
                        throw new Exception($connection->error);
                    }
                    $sql="SELECT id_user FROM users WHERE email='$register_email' AND password='$password'";
                    $result=mysqli_query($connection,$sql);
                    $row=mysqli_fetch_array($result);
                    array_push($error_message,$row[0]);
                    $register_result=true;
                    $_SESSION['logged_in']=true;
                    $_SESSION['user_id']=$row[0];
                    $_SESSION['email']=$register_email;
                    $_SESSION['name']=$name;
                    $_SESSION['surname']=$surname;
                    array_push($error_message,"Utworzono konto");
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
                        $mail->addAddress($register_email);
                        $mail->isHTML(true);
                        $mail->CharSet = "UTF-8";
                        $mail->Subject="Potwierdzenie rejestracji";
                        $mail->Body='<html>
                        <head>
                            <title>Potwierdzenie rejestracji</title>
                        </head>
                        <body>
                            <h1>Dziękujemy za rejestracje</h1>
                            <p>Wiadomość wygenerowana automatycznie. Prosimy nie odpowiadać.</p>
                        </body>
                        </html>';
                        $mail->send();
                }
                $connection->close();
                }
            }
            catch(Exception $e){
                array_push($error_message,"Krytyczny błąd systemu");
                $error=true;
            }
        }
        $array=[$error,$error_message,$register_result,$error_class];
        echo json_encode ($array);
    }
}
?>