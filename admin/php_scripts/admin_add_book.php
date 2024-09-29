<?php
session_start();
if(!isset($_SESSION['admin_permission'])){
    exit();
}
$title=htmlentities($_POST['title']);
$men=htmlentities($_POST['men']);
$publishing=htmlentities($_POST['publishing']);
$authors=htmlentities($_POST['authors']);
$year=htmlentities($_POST['year']);
$category=htmlentities($_POST['category']);
$part=htmlentities($_POST['part']);
$scope=htmlentities($_POST['scope']);
$error=false;
$msg="";
if (strlen($title) > 0 &&
    strlen($men) > 0 &&
    strlen($publishing) > 0 &&
    strlen($authors) > 0 &&
    strlen($year) > 0 &&
    strlen($category) > 0 &&
    strlen($part) > 0 &&
    strlen($scope) > 0) {
        $allowed_exs = array("jpg", "jpeg", "png");
        $new_img_name="";
        if(!isset($_FILES['front_photo'])){
            $error=true;
            $msg="Nie wybrano zdjęcia";
        }
        else{
            $img_ex = pathinfo($_FILES['front_photo']['name'], PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-").'.'.$img_ex_lc;
            }
            else {
                $error=true;
                $msg="Złe rozszerzenie pliku";
            }
        }
        if($error==false) {
            $img_upload_path = '../../users_offers/'.$new_img_name;
            $serwer_img_path='users_offers/'.$new_img_name;
            require_once '../../php_scripts/connect.php';
            $connection=mysqli_connect($host, $db_user,$db_password,$db_name);
            if(!mysqli_connect_errno()){
                if(compressImage($_FILES['front_photo']['tmp_name'],$img_upload_path,100))
                    {
                        $sql="INSERT INTO `sample_books`(`book_name`,`men`,`picture`,`publishing_house`,`authors`, `category`,`part`,`scope`,`release_date`) VALUES ('$title','$men','$serwer_img_path','$publishing','$authors','$category','$part','$scope','$year')";
                        $result=mysqli_query($connection,$sql);
                        if($result){
                            $msg="Pomyślnie dodano do bazy danych";
                        }
                        else{
                            $msg="Błąd serwera";
                        }
                    }
                    else{
                        $error=true;
                        $msg="Błąd serwera";
                    }
                    mysqli_close($connection);
            }
            else{
                $error=true;
                $msg="Błąd serwera";
            }
        }
    }
else{
    $error=true;
    $msg="Sprawdź poprawność danych";
}

function compressImage($source, $destination, $quality) {

    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg') 
      $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/png') 
      $image = imagecreatefrompng($source);
  
    return imagejpeg($image, $destination, $quality);
  
}
$arr=[$error,$msg];
echo json_encode($arr);
?>