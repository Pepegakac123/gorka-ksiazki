<?php
    session_start();
    if(isset($_SESSION['admin_permission'])){
        header('Location:admin-panel');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie admin</title>
    <link rel="stylesheet" href="style/admin.css">
    <script defer src="../scripts/jquery-3.6.1.min.js"></script>
    <script defer src="scripts/admin_login_page.js"></script>
    <link rel="icon" type="image/x-icon" href="../images/icon.png">
</head>
<body>
    <main class="login_main">
        <h1 class="loginh1">Zaloguj się do panelu administracyjnego</h1>
        <div class="input_box">
            <input type="text" name="login" id="login" placeholder="Login">
            <input type="password" name="password" id="password" placeholder="Hasło">
            <button id="sign_in">Zaloguj się</button>
            <p class="error">Error msg</p>
        </div>
    </main>
</body>
</html>