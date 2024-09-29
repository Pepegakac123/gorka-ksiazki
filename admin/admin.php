<?php
session_start();
if(!isset($_SESSION['admin_permission'])){
    header('Location:admin-logowanie');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel adminsitratora</title>
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script defer src="../scripts/jquery-3.6.1.min.js"></script>
    <script defer src="scripts/admin_page.js"></script>
    <link rel="icon" type="image/x-icon" href="../images/icon.png">
</head>
<body>
    <nav>
        <h1>Panel administratora</h1>
        <button id="sign_out">Wyloguj się</button>
    </nav>
    <main class="admin_main">
        <div class="box">
            <h2>Dodaj podręcznik</h2>
            <div class="book_data">
            <div class="line">
                <div class="data_box">
                    <h4>Tytuł</h4>
                    <input type="text" name="title" id="title">
                </div>
                <div class="data_box">
                    <h4>MEN</h4>
                    <input type="text" name="men" id="men">
                </div>
            </div>
            <div class="line">
                <div class="data_box">
                    <h4>Wydawnictwo</h4>
                    <input type="text" name="publishing" id="publishing">
                </div>
                <div class="data_box">
                    <h4>Autorzy</h4>
                    <input type="text" name="authors" id="authors">
                </div>                
            </div>
            <div class="line special-line">
                <div class="data_box">
                    <h4>Rok wydania</h4>
                    <input type="number" name="year" id="year">
                </div>
                <div class="data_box">
                    <h4>Kategoria</h4>
                    <select name="category" id="category">
                        <option value="matematyka">Matematyka</option>
                        <option value="historia">Historia</option>
                        <option value="fizyka">Fizyka</option>
                        <option value="chemia">Chemia</option>
                        <option value="wos">WOS</option>
                        <option value="biologia">Biologia</option>
                        <option value="geografia">Geografia</option>
                        <option value="j.angielski">J.Angielski</option>
                        <option value="j.niemiecki">J.Niemiecki</option>
                        <option value="j.polski">J.Polski</option>
                        <option value="pp">PP</option>
                        <option value="zawodowe">Zawodowe</option>
                        <option value="hit">HIT</option>
                        <option value="informatyka">Informatyka</option>
                        <option value="edb">EDB</option>
                    </select>
                </div>
                <div class="data_box">
                    <h4>Część</h4>
                    <select name="part" id="part">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="data_box">
                    <h4>Zakres</h4>
                    <label for="podstawowy"><input type="radio" name="scope" id="podstawowy" checked>podstawowy</label>
                    <label for="rozszerzony"><input type="radio" name="scope" id="rozszerzony">rozszerzony</label>
                </div>
            </div>
            <div class="images-container">
                <div class="front_photo_wrapper">
                <h4>Zdjęcie</h4>
                    <div class="dragger_wrapper">
                        <div class="dragger">
                            <div class="icon"><i class="fa-solid fa-images"></i></div>
                            <button class="browseFile" id="browseFile">Wybierz Plik</button> <input type="file" hidden id="front_photo" class="fileInputField" />
                        </div>
                        <div class="fileName"> </div>
                        <p class="imgnote">Obsługiwane formaty: JPG, PNG, JPEG</p>
                    </div>   
                </div>
            </div>
            </div>
            <button id="submit">Dodaj</button>
        </div>
        <div class="box">
            <h2>Usuń ofertę użytkownika</h2>
            <p>Podaj ID oferty</p>
            <input type="number" id="offer_id">
            <button id="delete_offer">Usuń</button>
        </div>
        <div class="box">
            <h2>Wykonaj kwerendę SQL</h2>
            <textarea name="sql" id="sql" rows="3"></textarea>
            <button id="prepare_query">Wykonaj</button>
        </div>
    </main>
</body>
</html>