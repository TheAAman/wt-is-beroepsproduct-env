<?php
session_start();

require_once('../../datalaag/db_connectie.php');

require_once ('../../sessielaag/checkSessie_functies.php');
require_once ('../../datalaag/vluchtinfo_functies.php');
require_once ('../../datalaag/passagierinfo_functies.php');
require_once ('../../sessielaag/renderen_functies.php');
require_once ('../../Sessielaag/uitloggen_functies.php');

checkSessieM();

$vluchtnummer = isset($_GET['vluchtnummer']) ? $_GET['vluchtnummer'] : '';

if (isset($_GET['action']) && $_GET['action'] == 'uitloggenM') {
    uitloggenM();
}

$vlucht = haalVlucht($vluchtnummer);
$land = vluchtNaarLand($vluchtnummer);

$passagierPVHtml = passagierPVNaarHtmlTabel($vluchtnummer);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../img/Icons/vticon.png">
    <title>Overzicht passagiers</title>
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
        <div class="passagierToevoegen">
            <a href="passagierToevoegen.php?vluchtnummer=<?= $vluchtnummer ?>">Passagier toevoegen</a>
        </div>

        <div class="belangrijkevluchtInfo">
            <h3>Bestemming:</h3><p><?php echo isset($land['luchthaven']) ? htmlspecialchars($land['luchthaven']) : 'Onbekend'; ?></p>
            <h3>Vluchtnummer:</h3><p><?= htmlspecialchars($vluchtnummer) ?></p>
            <h3>Stoelen bezet:</h3><p><?= htmlspecialchars($vlucht['aantal_passagiers']) . ' / ' . htmlspecialchars($vlucht['max_aantal']) ?></p>
        </div>
        <div class="Overzicht">
            <table class="tabelOverzicht">
                <tr>
                    <th>Passagiernummer</th>
                    <th>Naam</th>
                    <th>Geslacht</th>
                    <th>Inchecktijdstip</th>
                </tr>
                <?= $passagierPVHtml ?>
            </table>           
        </div>
        <div class="terugKnop">
            <a href="vluchtenM.php">Terug</a>
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
