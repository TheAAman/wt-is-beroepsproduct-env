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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vluchtoverzicht</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <div class="menupassagier">
        <div class="menupitem"><a href="homep.php">Home</a></div>
        <div class="menupitem"><a href="overzicht.php">Vluchten</a></div>
        <div class="menupitem"><a href="inchecken.php">Inchecken</a></div>
        <div class="menupitem">Uitloggen</div>
    </div>
    <main>
        <div class="zoekBalk">
            <div class="titelBalk"><h3>Vluchtnummer:</h3></div>
            <div class="balkBalk">
                <input class="zoekbalkBalk" type="text" placeholder="Zoeken">
            </div>
            <div class="zoekKnop"><button>Search</button></div>
        </div>

        <div class="vluchtOverzicht">
            <div class="eenvluchtOverzicht">
                <p>Vluchtnummer:</p>
                <p>Bestemming: </p>
                <p>Vertrektijd: </p>
            </div>

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