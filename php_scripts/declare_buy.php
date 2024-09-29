<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
$error=false;
$message="";
if(isset($_SESSION['logged_in']))
{
    if(isset($_POST['offer_id'])){
        $offer_id = htmlentities($_POST['offer_id']);
        require_once "connect.php";
        mysqli_report((MYSQLI_REPORT_STRICT));
        try{
            $connection=new mysqli($host,$db_user,$db_password,$db_name);
            if($connection->connect_errno==0){
                // $sql = "SELECT sample_books.book_name,users_offers.seller FROM users_offers JOIN sample_books ON sample_books.book_ID=users_offers.book_id  WHERE offer_id = '$offer_id' AND status='available'";
                $sql="SELECT users.email,users_offers.seller,sample_books.book_name FROM users JOIN (users_offers JOIN sample_books ON sample_books.book_ID=users_offers.book_id) ON users_offers.seller=users.id_user WHERE offer_id = '$offer_id' AND status='available'";
                $result=$connection->query($sql);
                if($result->num_rows){
                    $row=mysqli_fetch_array($result);
                    $user_id=$_SESSION['user_id'];
                    if($row["seller"]!=$user_id){
                        $sql="UPDATE users_offers SET customer='$user_id', status='reserved' WHERE offer_id = '$offer_id'";
                        $result=$connection->query($sql);
                        $message="<h3>Zarezerwowano.</h3> Przejdź do wiadomości, aby omówić szczegóły ze sprzedawacą";
                        $seller=$row["seller"];
                        $seller_email=$row["email"];
                        $book=$row["book_name"];
                        $buy_msg="<b>Zgłoszono chęć kupna: ".$book."</b>";
                        $sql_msg="INSERT INTO messages (message,sender_id,reciver_id) VALUES ('$buy_msg','$user_id','$seller')";
                        $result=mysqli_query($connection,$sql_msg);

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
                            $mail->addAddress($seller_email);
                            $mail->isHTML(true);
                            $mail->CharSet = "UTF-8";
                            $mail->Subject="Ktoś zgłosił chęć kupna twojej oferty: $book";
                            $mail->Body='<html>
                            <head>
                                <title></title>
                            </head>
                            <body>
                                <a href="http://localhost/g%C3%B3rka_Allegro/ksiazki-gorka/user_panel/wiadomosci">Przejdź do wiadmości, aby omówić szczegóły z nabywcą</a>
                                <p>Wiadomość wygenerowana automatycznie. Prosimy nie odpowiadać.</p>
                            </body>
                            </html>';
                            $mail->send();
                    }
                    else{
                        $error=true;
                        $message="Nie możesz zarezerwować swojej oferty";
                    }
                    mysqli_close($connection);
                    if(!$result) throw new Exception(mysqli_connect_errno());
                }
                else{
                    throw new Exception(mysqli_connect_errno());
                }
            }
            else{
                throw new Exception(mysqli_connect_errno());
            }
        }
        catch(Exception $e){
            $error=true;
            $message="Oferta nie jest już dostępna";
        }
    }
    else{
        $error=true;
        $message="Krytyczny błąd. Spróbuj odświeżyć stronę";
    }
}
else{
    $error=true;
    $message="Musisz być zalogowany";
}
$array=[];
$array['error']=$error;
$array['message']=$message;
echo json_encode($array);
?>