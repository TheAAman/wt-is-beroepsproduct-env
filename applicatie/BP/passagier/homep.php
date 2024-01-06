<?php
    // include_once('functie.php');
    // include_once('../db_connectie.php');

    // $db = maakVerbinding();

    // if (isset($_GET['van'])){
    //     vanVlucht($_GET['van']);
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/stylep.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home passagier</title>
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
        <p>Uw geboekte vluchten</p>

        <div class="grid">
            <div class="vlucht">
                <h4>New York</h4>
                <p>
                    <a href="vlucht.php"><img src="../img/NY.jpg" alt="stadsfoto"></a>
                </p>
            </div>

            <div class="vlucht">
                <h4>Paris</h4>
                <p>
                    <img src="../img/Paris.jpg" alt="stadsfoto">
                </p>
            </div>

            <div class="vlucht">
                <h4>Amsterdam</h4>
                <p>
                    <img src="../img/Amsterdam.jpg" alt="stadsfoto">
                </p>
            </div>

            <!-- <?= krijgVluchten($db, $vanVlucht)?>

            <?= vluchtNavigatie($vanVlucht)?> -->
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