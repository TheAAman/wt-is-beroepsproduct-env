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
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/stylep.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vluchtinfo</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <div class="menupassagier">
        <div class="menupitem"><a href="homep.php">Home</a></div>
        <div class="menupitem"><a href="overzicht.php">Vluchten</a></div>
        <div class="menupitem"><a href="inchecken.php">Bagage</a></div>
        <div class="menupitem">Uitloggen</div>
    </div>

    <main>
        <div class="vlucht">
            <div class="vluchtBestemming"><h2>New York</h4></div>
            <div class="vluchtImg">
                <img src="../img/NY.jpg" alt="stadsfoto">
            </div>
            <div class="vluchtTekst">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
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