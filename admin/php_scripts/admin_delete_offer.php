<?php //usunięcie zdjęcia z serwera
session_start();
if(!isset($_SESSION['admin_permission']) && !isset($_POST['id'])){
    exit();
}
$id=$_POST['id'];
if(!is_numeric($id)){
    exit();
}
$sql="DELETE FROM users_offers WHERE offer_id='$id'";
require_once "../../php_scripts/connect.php";
$connection=mysqli_connect($host,$db_user,$db_password,$db_name);
$msg="Błąd serwera";
if(!mysqli_connect_errno()){
    $sql_img="SELECT photo1, photo2 FROM users_offers WHERE offer_id='$id'";
    $result_img = mysqli_query($connection,$sql_img); 
    $result_img=mysqli_fetch_row($result_img);
    if($result_img){
        $sql="DELETE FROM users_offers WHERE offer_id='$id' AND status='available'";
        $result=mysqli_query($connection,$sql);
        $result=mysqli_affected_rows($connection);
        if($result){
            $msg="Usunięto ofertę ID $id";
            foreach($result_img as $photo){
                if($photo){
                    $path="../../$photo";
                    if(file_exists($path)){
                        unlink($path);
                    }
                }
            }
        }
        else{
            $msg="Oferta ID $id nie istnieje";
        }
    }
    else{
        $msg="Oferta ID $id nie istnieje";
    }
    mysqli_close($connection);
}
echo json_encode($msg);
?>