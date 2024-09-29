<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location:../strona-logowania');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj ofertę</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script defer src="../scripts/jquery-3.6.1.min.js"></script>
    <script defer src="../scripts/log_out.js"></script>
    <script defer src="../scripts/user_panel_scripts/add_offer_page_script.js"></script>
    <link rel="stylesheet" href="../style/oferty_add.css">
    <link rel="stylesheet" href="../style/sub_menu.css">
    <link rel="icon" type="image/x-icon" href="../images/icon.png">
</head>

<body>
    <nav>
        <div class="nav-container">

            <div class="left-nav">
                <a href="../strona-glowna">
                    <div class="nav-image"></div>
                </a>
            </div>

            <div class="center-nav">
                <div class="nav-list">
                    <ul>
                        <li><a href="../strona-glowna#offers-section">Kategorie</a></li>
                        <li><a href="../lista-ofert">Kup</a></li>
                        <li><a href="../user_panel/dodaj-oferte">Sprzedaj</a></li>
                    </ul>
                </div>
            </div>

            <div class="right-nav-authorized">
                <a id="user-panel-button" href="dane-uzytkownika"></a>
                <a id="messages-button" href="../user_panel/wiadomosci"></a>
                <a id="log_out"></a>
            </div>
        </div>
    </nav>
    <section id="sub-menu">
        <ul>
            <li><a href="dane-uzytkownika">Dane</a></li>
            <li><a href="twoje-oferty">Twoje oferty</a></li>
            <li class="active"><a href="dodaj-oferte">Wystaw</a></li>
            <li><a href="wiadomosci">Wiadomosci</a></li>
        </ul>
    </section>
    <div class="break"></div>
    <main>
        <div class="main-container">
            <form onsubmit="return false" enctype="multipart/form" id="offer_form">
                <div class="search-container">
                    <h4>Podaj Tytuł:</h4>
                    <input class="search-input" type="text" placeholder="Wybierz podręcznik">
                    <input id="book_id" type="hidden">
                    <div class="suggestions-list" id="suggestions_list"></div>
                    <p class="error_span" id="title_error_span">Error</p>
                </div>
                <div class="price-container">
                    <h4>Cena</h4>
                    <input type="number" name="price" id="price" placeholder="Podaj cenę w zł" class="price_input">
                    <p class="error_span" id="price_error_span">Podałeś złą cene</p>
                </div>
                <div class="images-container">
                    <div class="front_photo_wrapper">
                        <h4>Zdjęcie Przód:</h4>
                        <div class="dragger_wrapper">
                            <div class="dragger">
                                <div class="icon"><i class="fa-solid fa-images"></i></div>
                                <button class="browseFile" id="browseFile">Wybierz Plik</button> <input type="file" hidden id="front_photo" class="fileInputField" />
                            </div>
                            <div class="fileName"> </div>
                            <p class="imgnote format">Zdjęcia powinny mieć format 4:3</p>
                            <p class="imgnote">Obsługiwane formaty: JPG, PNG, JPEG</p>

                        </div>
                        <p class="error_span" id="front_image_error_span">Problem z 1 zdjeciem</p>
                    </div>
                    <div class="back_photo_wrapper">
                        <h4>Zdjęcie Tył:</h4>
                        <div class="dragger_wrapper">
                            <div class="dragger">
                                <div class="icon"><i class="fa-solid fa-images"></i></div> <button class="browseFile" id="browseFile">Wybierz Plik</button> <input type="file" hidden id="back_photo" class="fileInputField" />
                            </div>
                            <div class="fileName"> </div>
                            <p class="imgnote format">Zdjęcia powinny mieć format 4:3</p>
                            <p class="imgnote">Obsługiwane formaty: JPG, PNG, JPEG</p>
                        </div>
                        <p class="error_span" id="back_image_error_span">Problem z tylnim zdjeciem</p>
                    </div>
                </div>
                <p id="chosen" class="chosen">Wybrany podręcznik: </p>
                <p id="chosen_price" class="chosen">Cena: </p>
                <button id="submit">Wystaw ofertę</button>
                <p class="error_span" id="submit_error_span">Error</p>
            </form>
        </div>
    </main>
    <footer>
        <div class="footer-container">
            <div class="logo-footer">
                <a href="../strona-glowna">
                    <div class="footer-image"></div>
                </a>
                <span class="break"></span>
            </div>

            <div class="footer-nav">
                <div class="footer-nav-responsive">
                    <div class="nav-list">
                        <ul>
                            <li><a href="../strona-glowna#offers-section">Kategorie</a></li>
                            <li><a href="../lista-ofert">Kup</a></li>
                            <li><a href="dodaj-oferte">Sprzedaj</a></li>
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
    <div class="popup-order-box">
        <p class="popup-order-box-alert"></p>
    </div>
</body>

</html>