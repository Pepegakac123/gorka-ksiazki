<?php
session_start();
if (isset($_SESSION['logged_in'])) {
    header('Location:strona-glowna');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja/Logowanie</title>
    <link rel="stylesheet" href="style/logowanie.css">
    <script defer src="scripts/jquery-3.6.1.min.js"></script>
    <script defer src="scripts/login_script.js"></script>
    <link rel="icon" type="image/x-icon" href="images/icon.png">
</head>

<body>
    <div class="container">
        <div class="box-1">
            <div class="box-1-content">
                <h1>„Jest tylko jeden sposób nauki. Poprzez działanie.”
                    – Paulo Coelho</h1>
            </div>
        </div>
        <div class="box-1 box-1-hidden">
            <div class="box-1-content box-1-content-hidenn">
                <h1>Lorem Ipsum Tralalaa,
                    Tralala Kafvaraam</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a mattis augue, id elementum orci.
                    Nulla condimentum et tellus sodales volutpat. Suspendisse rutrum ante rhoncus
                    .</p>
            </div>

        </div>

        <div class="wrapper">
            <div class="home-btn">
                <a href="strona-glowna" class="round-button"><img src="images/house.svg" alt=""></a>
            </div>
            <span class="sign-up-text form--hidden">
                <h2>Zarejestruj się</h2>
            </span>
            <span class="sign-in-text">
                <h2>Zaloguj się</h2>
            </span>
            <form action="javascript:void(0);" class="register-in-form form--hidden ">

                <div class="label-wrapper sign-up-form">
                    <label for="name">Imię:</label>
                    <div class="input-field">
                        <input type="text" placeholder="Podaj imię" name="name" id="name">
                    </div>
                    <span id="name-error" class="error_log_info">Lorem Ipsum</span>
                </div>
                <div class="label-wrapper sign-up-form label-wrapper-l">
                    <label for="surname">Nazwisko:</label>
                    <div class="input-field">
                        <input type="text" placeholder="Podaj nazwisko" name="surname" id="surname" />
                    </div>
                    <span id="surname-error" class="error_log_info">Lorem Ipsum</span>
                </div>

                <div class="label-wrapper register-in-form">
                    <label for="register_password">Hasło:</label>
                    <div class="input-field">
                        <input type="password" placeholder="Podaj hasło" name="register_password" id="register_password" />
                    </div>
                    <span id="register-password-error" class="error_log_info">Lorem Ipsum</span>

                </div>
                <div class="label-wrapper register-in-form label-wrapper-l">
                    <label for="check_password">Hasło:</label>
                    <div class="input-field">
                        <input type="password" placeholder="Powtórz hasło" name="check_password" id="check_password" />
                    </div>
                    <span id="password-check-error" class="error_log_info">Lorem Ipsum</span>
                </div>
                <div class="email-and-btn-container">
                    <div class="label-wrapper register-in-form label-wrapper-l">
                        <label for="register_email">Email:</label>
                        <div class="input-field">
                            <input type="email" placeholder="Podaj email" name="register_email" id="register_email"/>
                        </div>
                        <span id="register-email-error" class="error_log_info">Lorem Ipsum</span>
                    </div>
                    <button class="register-in-btn" id="register">Stwórz konto</button>
                </div>
            </form>

            <form action="javascript:void(0);" class="sign-in-form">
                <div class="label-wrapper sign-in-form">
                    <label for="name">Adres Email:</label>
                    <div class="input-field">
                        <input type="email" placeholder="Podaj email" name="email" id="email" />
                    </div>
                    <span class="error_log_info_login">Lorem Ipsum</span>
                </div>
                <div class="label-wrapper sign-in-form">
                    <label for="password">Hasło:</label>
                    <div class="input-field">
                        <input type="password" placeholder="Podaj hasło" id="password" name="password" />
                    </div>
                    <span class="error_log_info_login" id="login_result">h</span>
                </div>
                <button class="sign-in-btn" id="log_in">Zaloguj się</button>
            </form>
            <span class="error_log_info_password form--hidden">Hasło musi zawierać co najmniej 8 znaków, w tym cyfrę i wielką literę.</span>
            <span class="sign-up-goto-span">
                <p id="sign-up-goto">Nie masz jeszcze konta? &nbsp;<a id="linkCreateAccount"> Zarejestruj się</a></p>
                <p id="forgotten-password"> Zapomniałeś hasła? &nbsp;<a href="odzyskaj-haslo"> Odzyskaj je</a></p>
            </span>
            <span class="sign-in-goto-span form--hidden">
                <p id="sign-in-goto"> Masz już konto? &nbsp;<a id="linkLogin"> Zaloguj się</a></p>
            </span>
        </div>
    </div>
</body>

</html>