<?php
session_start();
if(!isset($_SESSION['logged_in'])){
    exit();
}
$error=false;
$error_msg=[];
$error_id=[];
$allowed_exs = array("jpg", "jpeg", "png");
$new_img_name="";
$new_bc_img_name="";
$seller=$_SESSION['user_id'];
if(!isset($_POST['book_id']) || strlen($_POST['book_id'])==0){
    $error=true;
    $error_msg['title_error_span']='Nie wybrano podręcznika';
    array_push($error_id,'title_error_span');
}
if(!isset($_POST['price']) || $_POST['price']<=0){
    $error=true;
    $error_msg['price_error_span']='Nie podano ceny';
    array_push($error_id,'price_error_span');
}
if(!isset($_FILES['front_photo'])){
    $error=true;
    $error_msg['front_image_error_span']='Nie wybrano przedniego zdjęcia';
    array_push($error_id,'front_image_error_span');
}
else{
    $img_ex = pathinfo($_FILES['front_photo']['name'], PATHINFO_EXTENSION);
	$img_ex_lc = strtolower($img_ex);
    if (in_array($img_ex_lc, $allowed_exs)) {
        $new_img_name = uniqid("IMG-").'.'.$img_ex_lc;
    }else {
        $error=true;
        $error_msg['front_image_error_span']='Rozszerzenie zdjęcia przodu nie jest obsługiwane';
        array_push($error_id,'front_image_error_span');
    }
}
if(!isset($_FILES['back_photo'])){
    $error=true;
    $error_msg['back_image_error_span']='Nie wybrano tylnego zdjęcia';
    array_push($error_id,'back_image_error_span');
}
else{
    $bc_img_ex = pathinfo($_FILES['back_photo']['name'], PATHINFO_EXTENSION);
	$bc_img_ex_lc = strtolower($bc_img_ex);
    if (in_array($bc_img_ex_lc, $allowed_exs)) {
        $new_bc_img_name = uniqid("IMG-").'.'.$bc_img_ex_lc;
    }else {
        $error=true;
        $error_msg['back_image_error_span']='Rozszerzenie zdjęcia tyłu nie jest obsługiwane';
        array_push($error_id,'back_image_error_span');
    }
}
if(!$error){
    $id=htmlentities($_POST['book_id']);
    $price=htmlentities($_POST['price']);
    $img_upload_path = '../../users_offers/'.$new_img_name;
    $bc_img_upload_path = '../../users_offers/'.$new_bc_img_name;
    $serwer_img_path='users_offers/'.$new_img_name;
    $serwer_bc_img_path='users_offers/'.$new_bc_img_name;
    require_once '../connect.php';
    $connection=mysqli_connect($host, $db_user,$db_password,$db_name);
    if(compressImage($_FILES['front_photo']['tmp_name'],$img_upload_path,50) && compressImage($_FILES['back_photo']['tmp_name'],$bc_img_upload_path,50))
    {
        $sql="INSERT INTO `users_offers`(`seller`,`price`,`photo1`,`photo2`,`status`, `book_id`) VALUES ('$seller','$price','$serwer_img_path','$serwer_bc_img_path','available','$id')";
        $result=mysqli_query($connection,$sql);
        if($result){
            array_push($error_msg,'Pomyślnie dodano ofertę');
        }
        else{
            array_push($error_msg,'Błąd serwera.Spróbuj później');
        }
    }
    else{
        $error=true;
        array_push($error_msg,'Błąd serwera.Spróbuj później');
    }
    mysqli_close($connection);
}
function compressImage($source, $destination, $quality) {

    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg') 
      $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/png') 
      $image = imagecreatefrompng($source);
  
    return imagejpeg($image, $destination, $quality);
  
}
  
$array=[$error,$error_msg,$error_id];
echo json_encode($array);
?>