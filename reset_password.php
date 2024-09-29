<?php
if(!isset($_GET["code"]) || strlen($_GET["code"]) < 1){
    exit();
}
$code=$_GET["code"];
require_once "php_scripts/connect.php";
$connection=mysqli_connect($host,$db_user,$db_password,$db_name);
$error=false;
$error_msg="";
if($connection){
    $sql="SELECT `date` FROM reset_password WHERE authorization_code='$code'";
    $result=mysqli_query($connection,$sql);
    if(mysqli_num_rows($result)==1){
        $row=mysqli_fetch_assoc($result);
        $date=$row['date'];
        $firstDate = new DateTime($date);
        $currentDateTime = new DateTime();
        $interval = $firstDate->diff($currentDateTime);
        if ($interval->h === 0 && $interval->i <= 60 && $interval->days === 0) {} else {
            $error=true;
            $error_msg="Link wygasł";
        }
    }
    else{
        $error=true;
        $error_msg="Błędny kod";
    }
    mysqli_close($connection);
}
else{
    $error=true;
    $error_msg="Błąd serwera";
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zmień hasło</title>
    <link rel="stylesheet" href="style/recovery.css">
    <script defer src="scripts/jquery-3.6.1.min.js"></script>
    <script defer src="scripts/reset_password.js"></script>
    <link rel="icon" type="image/x-icon" href="images/icon.png">
</head>
<body>
    <div class="box">
        <?php
        if(!$error) {
            echo '<input type="password" placeholder="Nowe hasło" name="password" id="password">';
            echo '<input type="password" placeholder="Powtórz hasło" name="check_password" id="check_password">';
            echo '<button id="reset">Zmień hasło</button>';
            echo '<p>Hasło musi zawierać co najmniej 8 znaków, w tym wielką literę i cyfrę.</p>';
        }
        ?>
        <p class="error" <?php if($error){echo 'style="visibility:visible"';}?>>
            <?php echo $error_msg;?>
        </p>
    </div>
</body>
</html>