<?php 
session_start();

require_once('../includes/db_connectie.php');

if (!isset($_SESSION['username'])) {
    header('Location: inloggenP.php');
    exit();
}

function getVluchten($vluchtnummer) {
    $db = maakVerbinding();

    $sql = 'SELECT v.vluchtnummer, v.bestemming, v.vertrektijd, COUNT(p.passagiernummer) AS aantal_passagiers, v.max_aantal, SUM(v.max_gewicht_pp) AS totaal_gewicht, v.max_totaalgewicht
            FROM Vlucht v
            LEFT JOIN Passagier p ON v.vluchtnummer = p.vluchtnummer
            WHERE v.vluchtnummer LIKE :vluchtnummer
            GROUP BY v.vluchtnummer, v.bestemming, v.vertrektijd, v.max_aantal, v.max_totaalgewicht';
    $stmt = $db->prepare($sql);
    $vluchtnummer = "%$vluchtnummer%";
    $stmt->bindParam(':vluchtnummer', $vluchtnummer);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$vluchtnummer = isset($_GET['Vluchtnummer']) ? $_GET['Vluchtnummer'] : '';
$vluchten = getVluchten($vluchtnummer);

$tableRows = '';

if (count($vluchten) > 0) {
    foreach ($vluchten as $vlucht) {
        $tableRows .= '<tr>';
        $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vluchtnummer']) . '</a></td>';
        $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['bestemming']) . '</a></td>';
        $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vertrektijd']) . '</a></td>';
        $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['aantal_passagiers']) . ' / ' . htmlspecialchars($vlucht['max_aantal']) . '</a></td>';
        $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . floor(htmlspecialchars($vlucht['totaal_gewicht'])) . ' / ' . floor(htmlspecialchars($vlucht['max_totaalgewicht'])) . '</a></td>';
        $tableRows .= '</tr>';
    }
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
                <tr>
                    <th>Vluchtnummer</th>
                    <th>Bestemming</th>
                    <th>Vertrektijd</th>
                    <th>Passagiers</th>
                    <th>Gewicht</th>
                </tr>
                <?= $tableRows ?>
            </table>           
        </div>
    </main>

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>
