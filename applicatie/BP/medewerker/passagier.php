<?php
session_start();

require_once ('../includes/db_connectie.php');

if (!isset($_SESSION['balienummer'])) {
    header('Location: inloggenM.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../img/Icons/vticon.png">
    <title>Passagier detail</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <?php include_once'../includes/navM.php'; ?>

    <main>
        <div class="passagierWijzigen">
            <a href="passagierWijzigen.html">Passagier wijzigen</a>
        </div>

        <div class="passagier">
            <div class="passagierDetails">
                <p><strong>Passagiernummer:</strong> 23454</p>
                <p><strong>Naam:</strong> Etezard</p>
                <p><strong>Geslacht:</strong> M</p>
                <p><strong>Vluchtnummer:</strong> 28761</p>
                <p><strong>Balie:</strong> 2</p>
                <p><strong>Stoel:</strong> C02</p>
                <p><strong>Inchecktijdstip:</strong> 2023-09-29 22:46:00.000</p>
            </div>
        </div>
    </main>

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.html">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>