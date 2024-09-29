<?php
session_start();
$is_logged_in = false;
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $is_logged_in = true;
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oferta</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/oferty_single.css">
    <script defer src="scripts/jquery-3.6.1.min.js"></script>
    <script defer src="scripts/offer_page_script.js"></script>
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
                        <li><a href="strona-logowania#offers-section">Kategorie</a></li>
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
    <div class="offer-wrapper">
        <div class="filters-wrapper">
            <div class="filters">
                <div class="subject-wrapper">
                    <h3>Przedmiot</h3>
                    <div>
                        <div>
                            <label for="matematyka">Matematyka<input type="checkbox" class="subject_filter" id="matematyka"></label>
                        </div>
                        <div>
                            <label for="historia">Historia<input type="checkbox" class="subject_filter" id="historia"></label>
                        </div>
                        <div>
                            <label for="fizyka">Fizyka<input type="checkbox" class="subject_filter" id="fizyka"></label>
                        </div>
                        <div>
                            <label for="chemia">Chemia<input type="checkbox" class="subject_filter" id="chemia"></label>
                        </div>
                        <div>
                            <label for="wos">WOS<input type="checkbox" class="subject_filter" id="wos"></label>
                        </div>
                        <div>
                            <label for="biologia">Biologia<input type="checkbox" class="subject_filter" id="biologia"></label>
                        </div>
                        <div>
                            <label for="geografia">Geografia<input type="checkbox" class="subject_filter" id="geografia"></label>
                        </div>
                        <div>
                            <label for="angielski">J.angielski<input type="checkbox" class="subject_filter" id="angielski"></label>
                        </div>
                        <div>
                            <label for="niemiecki">J.niemiecki<input type="checkbox" class="subject_filter" id="niemiecki"></label>
                        </div>
                        <div>
                            <label for="polski">J.polski<input type="checkbox" class="subject_filter" id="polski"></label>
                        </div>
                        <div>
                            <label for="pp">PP<input type="checkbox" class="subject_filter" id="pp"></label>
                        </div>
                        <div>
                            <label for="zawodowe">Zawodowe<input type="checkbox" class="subject_filter" id="zawodowe"></label>
                        </div>
                        <div>
                            <label for="hit">HIT<input type="checkbox" class="subject_filter" id="hit"></label>
                        </div>
                        <div>
                            <label for="informatyka">Informatyka<input type="checkbox" class="subject_filter" id="informatyka"></label>
                        </div>
                        <div>
                            <label for="edb">EDB<input type="checkbox" class="subject_filter" id="edb"></label>
                        </div>
                    </div>
                </div>
                <div class="part-wrapper">
                    <h3>Część</h3>
                    <div>
                        <div>
                            <label for="part1">1 <input type="checkbox" class="part_filter" id="part1"></label>
                        </div>
                        <div>
                            <label for="part2">2 <input type="checkbox" class="part_filter" name="" id="part2"></label>
                        </div>
                        <div>
                            <label for="part3">3 <input type="checkbox" class="part_filter" name="" id="part3"></label>
                        </div>
                        <div>
                            <label for="part4">4 <input type="checkbox" class="part_filter" name="" id="part4"></label>
                        </div>
                    </div>
                </div>

                <div class="book-type-wrapper">
                    <h3>Zakres</h3>
                    <label for="podstawowy">Podstawowy<input type="checkbox" class="scope_filter" id="podstawowy"></label>
                    <label for="rozszerzony">Rozszerzony<input type="checkbox" class="scope_filter" id="rozszerzony"></label>
                </div>
                <div class="filter-button-wrapper">
                    <button id="sumbit_filters">Zastosuj</button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="books">
                <div class="books-wrapper">
                </div>
            </div>
        </div>
    </div>
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