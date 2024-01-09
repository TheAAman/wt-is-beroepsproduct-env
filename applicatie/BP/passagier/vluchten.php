<?php
    // include_once('functie.php');
    // include_once('../db_connectie.php');

    // $db = maakVerbinding();

    // $vluchtnummer = '-1';

    // if(isset($_GET['soorteer'])){
    //     $sorteer= krijgSortering($_GET['sorteer']);
    // }

    // if (isset($_POST) && isset($_POST['vluchtnummer'])){
    //     $vluchtnummer = htmlspecialchars($_POST['vluchtnummer']);
    //     $vluchtenData = krijgEnkeleVlucht($vluchtnummer);
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/stylep.css">
    <link rel="icon" type="image/jpg" href="../../BP/img/vticon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vluchtoverzicht</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <div class="menupassagier">
        <a href="homep.php" class="menupitem">Home</a>
        <a href="vluchten.php" class="menupitem">Vluchten</a>
        <a href="inchecken.php" class="menupitem">Inchecken</a>
        <a href="../inloggen.php" class="menupitem">Uitloggen</a>
    </div>
    
    <main>
        <div class="zoekBalk">
            <h3>Vluchtnummer:</h3>
            <div class="balkBalk">
                <input class="zoekbalkBalk" type="text" placeholder="Zoeken">
            </div>
            <button class="zoekKnop">
                <img class="zoekIcoon" src="../img/search-icon.webp">
                <div class="tooltip">Zoeken</div>
            </button>
        </div>

        <div class="vluchtOverzicht">
            <table class="tabelvluchtOverzicht">
                <tr>
                    <th>Vluchtnummer</th>
                    <th>Bestemming</th>
                    <th>Vertrektijd</th>
                </tr>
                <div class="eenvluchtOverzicht">
                    <tr>
                        <td>28764</td>
                        <td>AMS</td>
                        <td>2023-10-11 06:46:00.000</td>
                    </tr>
                </div>
            </table>           
        </div>

    </main>

    <footer>
        <a href="https:www.han.nl">
            <img src="https://www.han.nl/lib/v3/images/han_university.svg" alt="Logo van de HAN" title="HAN">
        </a>
        <a href="privacy.html">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>