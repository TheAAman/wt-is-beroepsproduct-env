<?php
session_start();

require_once('../../datalaag/db_connectie.php');
require_once('../../sessielaag/checkSessie_functies.php');
require_once('../../datalaag/vluchtinfo_functies.php');
require_once('../../sessielaag/renderen_functies.php');

checkSessieM();

$vluchtnummer = isset($_GET['vluchtnummer']) ? $_GET['vluchtnummer'] : '';

$vlucht = haalVlucht($vluchtnummer);
$land = vluchtNaarLand($vluchtnummer);

function passagierPerVlucht($vluchtnummer){
    $db = maakVerbinding();

    $sql = 'SELECT passagiernummer, naam, geslacht, inchecktijdstip
            FROM Passagier 
            WHERE vluchtnummer = :vluchtnummer;';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':vluchtnummer', $vluchtnummer, PDO::PARAM_INT);
    $stmt->execute();

    $passagiers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $passagiers;
}

function passagierPVNaarHtmlTabel($vluchtnummer) {
    $passagiers = passagierPerVlucht($vluchtnummer);

    $passagierPVHtml = '';

    if (count($passagiers) > 0) {
        foreach ($passagiers as $p) {
            $passagierPVHtml .= '<tr>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">' . htmlspecialchars($p['passagiernummer']) . '</a></td>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">' . htmlspecialchars($p['naam']) . '</a></td>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">' . htmlspecialchars($p['geslacht']) . '</a></td>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">' . htmlspecialchars($p['inchecktijdstip']) . '</a></td>';
            $passagierPVHtml .= '</tr>';
        }
    }
    return $passagierPVHtml;
}

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

    <?php include_once '../includes/navM.php'; ?>

    <main>
        <div class="passagierToevoegen">
            <a href="passagierToevoegen.php">Passagier toevoegen</a>
        </div>

        <div class="belangrijkevluchtInfo">
            <h3>Bestemming:</h3><p><?php echo isset($land['luchthaven']) ? htmlspecialchars($land['luchthaven']) : 'Onbekend'; ?></p>
            <h3>Vluchtnummer:</h3><p><?= htmlspecialchars($vluchtnummer) ?></p>
            <h4>Ingecheckt:</h4><p><?= htmlspecialchars($vlucht['aantal_passagiers']) . ' / ' . htmlspecialchars($vlucht['max_aantal']) ?></p>
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
