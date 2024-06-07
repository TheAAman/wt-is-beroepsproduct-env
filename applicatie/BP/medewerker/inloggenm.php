<?php
    session_start();

    include_once('../includes/db_connectie.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="img/Icons/vticon.png">
    <title>Inloggen Medewerker</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <main>
        <div class="inlogTekst">
            <p>Vul hier uw inloggegevens in:</p>
        </div>
        <div class="inlogBlok">
            <form action="incheckenM.php" method="post">
                    <input type="int" name="balienummer" placeholder="balienummer" required>
                    <input type="password" name="password" placeholder="wachtwoord" required>
                    <input type="submit" name="submit" value="login">
            </form>
        </div>
        <div class="terugKnop">
            <a href="../index.php">Terug</a>
        </div>
    </main>

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.html">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>