<?php
session_start();

require_once('../includes/db_connectie.php');
require_once('../includes/functies.php');

checkSessieP();

$vluchtnummer = isset($_GET['Vluchtnummer']) ? $_GET['Vluchtnummer'] : '';
$sorteerColom = isset($_GET['sorteerColom']) ? $_GET['sorteerColom'] : 'bestemming';
$sorteerVolgorde = isset($_GET['sorteerVolgorde']) ? $_GET['sorteerVolgorde'] : 'ASC';

$tableRows = vluchtenNaarHtmlTabelP($vluchtnummer, $sorteerColom, $sorteerVolgorde);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../img/Icons/vticon.png">
    <title>Vluchtoverzicht</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <?php include_once '../includes/navP.php'; ?>

    <main>
        <div class="zoekBalk">
            <form action="vluchtenP.php" method="get">
                <h3>Vluchtnummer:</h3>
                <div class="balkBalk">
                    <input class="zoekbalkBalk" type="number" name="Vluchtnummer" placeholder="Zoeken" value="<?= htmlspecialchars($vluchtnummer) ?>">
                </div>
                <div class="zoekKnopContainer">
                    <input class="zoekKnop" type="submit" value="Zoeken">
                </div>
            </form>
        </div>

        <div class="Overzicht">
            <table class="tabelOverzicht">
                <?= $tableRows ?>
            </table>           
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
