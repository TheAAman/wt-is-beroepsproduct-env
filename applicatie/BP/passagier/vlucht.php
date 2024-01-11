<?php
    // include_once('functie.php');
    // include_once('../db_connectie.php');

    // $db = maakVerbinding();

    // if(isset($_GET['vluchtnummer'])){
    //     header('location: overzicht.php');
    // } else {
    //     $vluchtnummer = $_GET['vluchtnummer']; 
    //     $vluchtnummer = htmlspecialchars($vluchtnummer);
    //     $vlucht = krijgVluchtDetails($db, $vluchtnummer);

    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../../BP/css/normalize.css">
    <link rel="stylesheet" href="../../BP/css/style.css">
    <link rel="stylesheet" href="../../BP/css/stylep.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../../BP/img/vticon.png">
    <title>Vlucht</title>
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
        <div class="vlucht">
            <div class="vluchtBestemming"><h2>New York</h4></div>
            <div class="vluchtImg">
                <img src="../img/NY.jpg" alt="stadsfoto">
            </div>
            <div class="vluchtTekst">
                <p>Vluchtnummer:</p>
                <p>Bestemming:</p>
                <p>Balienummer:</p>
                <p>Gatecode:</p>
                <p>Vertrektijd:</p>
                <p>Maatschappijcode:</p>
                <p>Passagiers: ../ 350</p>
        </div>
        </div>
    </main>

    <footer>
        <a href="https:www.han.nl">
            <img src="https://www.han.nl/lib/v3/images/han_university.svg" alt="Logo van de HAN" title="HAN">
        </a>
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>