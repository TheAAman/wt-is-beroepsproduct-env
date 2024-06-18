<?php
session_start();

require_once('../../datalaag/db_connectie.php');
require_once('../../datalaag/inloggen_functies.php');

$logged_in = false;

inloggenM();
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
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="number" name="balienummer" placeholder="balienummer" required>
                    <input type="password" name="password" placeholder="wachtwoord" required>
                    <input type="submit" name="loginM" value="login">
            </form>
        </div>
        <div class="terugKnop">
            <a href="../index.php">Terug</a>
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>