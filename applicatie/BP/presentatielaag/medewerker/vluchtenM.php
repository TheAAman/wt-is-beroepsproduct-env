<?php
session_start();

require_once('../../datalaag/db_connectie.php');

require_once ('../../sessielaag/checkSessie_functies.php');
require_once ('../../datalaag/vluchtinfo_functies.php');
require_once ('../../sessielaag/renderen_functies.php');

checkSessieM();

$vluchtnummer = isset($_GET['Vluchtnummer']) ? $_GET['Vluchtnummer'] : '';
$sorteerColom = isset($_GET['sorteerColom']) ? $_GET['sorteerColom'] : 'bestemming';
$sorteerVolgorde = isset($_GET['sorteerVolgorde']) ? $_GET['sorteerVolgorde'] : 'ASC';

$tableRows = vluchtenNaarHtmlTabelM($vluchtnummer, $sorteerColom, $sorteerVolgorde);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../img/Icons/vticon.png">
    <title>Overzicht vluchten</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <?php include_once'../includes/navM.php'; ?>

    <main>
        <div class="toevoegenVlucht">
            <a href="vluchtToevoegen.php">Toevoegen</a>
        </div>

        <div class="zoekBalk">
            <form action="vluchtenM.php" method="get">
                <h3>Vluchtnummer:</h3>
                <div class="balkBalk">
                    <input class="zoekbalkBalk" type="number" name="Vluchtnummer" placeholder="Zoeken">
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