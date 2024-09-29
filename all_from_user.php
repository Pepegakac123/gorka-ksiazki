<?php
session_start();
$is_logged_in = false;
if (isset($_SESSION['logged_in'])) {
    $is_logged_in = true;
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oferty użytkownika</title>
    <link rel="stylesheet" href="style/oferty.css">
    <link rel="stylesheet" href="style/all_from_user.css">
    <script defer src="scripts/jquery-3.6.1.min.js"></script>
    <script defer src="scripts/all_from_user_script.js"></script>
    <script defer src="scripts/log_out.js"></script>
    <link rel="icon" type="image/x-icon" href="images/icon.png">
</head>

<body>
    <nav>
        <div class="nav-container">

            <div class="left-nav">
                <a href="strona-glowna">
                    <div class="nav-image"></div>
                </a>
            </div>

            <div class="center-nav">
                <div class="nav-list">
                    <ul>
                        <li><a href="strona-glowna#offers-section">Kategorie</a></li>
                        <li><a href="lista-ofert">Kup</a></li>
                        <li><a href="user_panel/dodaj-oferte">Sprzedaj</a></li>
                    </ul>
                </div>
            </div>

            <?php
            if ($is_logged_in) {
                echo <<<END
                <div class="right-nav-authorized">
                    <a id="user-panel-button" href="user_panel/dane-uzytkownika"></a>
                    <a id="messages-button" href="user_panel/wiadomosci"></a>
                    <a id="log_out"></a>
                </div>
                END;
            } else {
                echo <<<END
                <div class="right-nav">
                    <a href="strona-logowania">Zaloguj się</a>
                </div>
                END;
            }
            ?>

        </div>
    </nav>

    <main>
        <section id="seller-offers"></section>
        <div class="modal-box">
            <span class="close-modal-box">X</span>
            <img src="" class="offer-image">
        </div> <!--- popup -->
        <div class="popup-order-box">
            <p class="popup-order-box-alert"></p>
        </div>
        </div>
        <div class="buy-popup">
            <div class="buy-confirm">
                <div class="buy-button-wrapper">
                    <h1 class="title-buy buy-text"></h1>
                    <h2 class="price-buy buy-text"></h2>
                    <div class="button-wrapper">
                        <button class="confirm-buy">Biorę</button>
                        <button class="cancel-buy">Anuluj</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-container">
            <div class="logo-footer">
                <a href="strona-glowna">
                    <div class="footer-image"></div>
                </a>
                <span class="break"></span>
            </div>

            <div class="footer-nav">
                <div class="footer-nav-responsive">
                    <div class="nav-list">
                        <ul>
                            <li><a href="strona-glowna#offers-section">Kategorie</a></li>
                            <li><a href="lista-ofert">Kup</a></li>
                            <li><a href="user_panel/dodaj-oferte">Sprzedaj</a></li>
                        </ul>
                    </div>
                    <div class="social-box-responsive">
                        <div class="socials">
                            <a href="#"><span class="mail">gorkakiermasz@gmail.com</span></a>
                            <a href="#"><span class="location">Rabka-zdrój</span></a>
                        </div>

                    </div>
                    <div class="copyright">
                        <p>© 2022 Nazwa. Wszelkie prawa zastrzeżone </p>
                    </div>
                </div>

            </div>

            <div class="social-box">
                <div class="socials">
                    <span class="mail">gorkakiermasz@gmail.com</span>
                    <span class="location">Rabka-zdrój</span>
                </div>

            </div>
        </div>
    </footer>
</body>

</html>