<?php
    /* include_once('functie.php');
    // include_once('../db_connectie.php');

    // $db = maakVerbinding();

    // if (isset($_GET['van'])){
    //     vanVlucht($_GET['van']);
    }

    <?= krijgVluchten($db, $vanVlucht)?> lijn 60

    <?= vluchtNavigatie($vanVlucht)?> lijn 62
    */
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
    <title>Home passagier</title>
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
        <div class="homepgrid">
            <div class="homepvlucht">
                <h4>New York</h4>
                <p>
                    <a href="vlucht.php"><img src="../img/NY.jpg" alt="stadsfoto"></a>
                </p>
            </div>

            <div class="homepvlucht">
                <h4>Paris</h4>
                <p>
                    <img src="../img/Paris.jpg" alt="stadsfoto">
                </p>
            </div>

            <div class="homepvlucht">
                <h4>Amsterdam</h4>
                <p>
                    <img src="../img/Amsterdam.jpg" alt="stadsfoto">
                </p>
            </div>


        </div>
    </main>

    <footer>
        <a href="https:www.han.nl">
            <img src="https://www.han.nl/lib/v3/images/han_university.svg" alt="Logo van de HAN" title="HAN">
        </a>
        <a href= "../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>

</body>
</html>