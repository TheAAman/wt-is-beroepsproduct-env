<?php
session_start();

require_once('../../datalaag/db_connectie.php');

require_once ('../../sessielaag/checkSessie_functies.php');
require_once ('../../datalaag/vluchtinfo_functies.php');
require_once ('../../datalaag/passagierinfo_functies.php');
require_once ('../../sessielaag/renderen_functies.php');
require_once ('../../Sessielaag/uitloggen_functies.php');

checkSessieM();

$passagiernummer = isset($_GET['passagiernummer']) ? $_GET['passagiernummer'] : '';

if (isset($_GET['action']) && $_GET['action'] == 'uitloggenM') {
    uitloggenM();
}

$passagierHtml = passagierNaarHtmlTabel($passagiernummer);
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
    <div class="menunavigatie">
        <a href="incheckenM.php" class="menuitem">Inchecken</a>
        <a href="vluchtenM.php" class="menuitem">Vluchten</a>
        <a href="passagierZoeken.php" class="menuitem">Passagiers</a>
        <a href="?action=uitloggenM" class="menuitem">Uitloggen</a>
    </div>
    <main>
        <div class="passagierWijzigen">
            <a href="passagierWijzigen.php?passagiernummer=<?= $passagiernummer ?>">Passagier wijzigen</a>
        </div>

        <div class="passagier">
            <div class="passagierDetails">
                <?= $passagierHtml ?>
            </div>
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>