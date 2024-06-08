<?php
session_start();

include_once('../includes/db_connectie.php');

function getVlucht() {
    $db = maakVerbinding();

    $sql = 'SELECT * FROM Vlucht WHERE bestemming = "New York";';
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        return $row;
    }
    return false;

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
    <title>Vluchtinfo</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <div class="menunavigatie">
        <a href="homeP.html" class="menuitem">Home</a>
        <a href="vluchtenP.html" class="menuitem">Vluchten</a>
        <a href="incheckenP.html" class="menuitem">Inchecken</a>
        <a href="inloggenP.html" class="menuitem">Uitloggen</a>
    </div>

    <main>
        <div class="vlucht">
            <div class="vluchtBestemming"><h2>New York</h2></div>
            <div class="vluchtImg">
                <img src="../img/Steden/NY.jpg" alt="stadsfoto">
            </div>
            <div class="vluchtTekst">
                <p><strong>Vertrektijd:</strong> 06:46:00</p>
                <p><strong>Vluchtnummer:</strong> 27544</p>
                <p><strong>Bestemming:</strong> New York City</p>
                <p><strong>Balienummer:</strong> 7</p>
                <p><strong>Gate:</strong> A</p>
                <p><strong>Luchthaven:</strong> Luchthaven Schiphol</p>
                <p><strong>Maatschappij:</strong> Amsterdam Airlines</p>
                <p><strong>Passagiers:</strong> 243/ 350</p>
            </div>
        </div>
    </main>

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>