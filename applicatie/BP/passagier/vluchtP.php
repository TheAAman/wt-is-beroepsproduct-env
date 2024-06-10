<?php
session_start();

require_once ('../includes/db_connectie.php');

if (!isset($_SESSION['username'])) {
    header('Location: inloggenP.php');
    exit();
}

function getVlucht($vluchtnummer) {
    $db = maakVerbinding();

    $sql = 'SELECT v.vluchtnummer, v.bestemming, v.vertrektijd, COUNT(p.passagiernummer) AS aantal_passagiers, v.max_aantal, SUM(v.max_gewicht_pp) AS totaal_gewicht, v.max_totaalgewicht, m.naam AS maatschappij_naam, ib.balienummer, v.gatecode, v.maatschappijcode
            FROM Vlucht v
            LEFT JOIN Passagier p ON v.vluchtnummer = p.vluchtnummer
            LEFT JOIN Maatschappij m ON v.maatschappijcode = m.maatschappijcode
            LEFT JOIN incheckenBestemming ib ON v.bestemming = ib.luchthavencode
            WHERE v.vluchtnummer LIKE :vluchtnummer
            GROUP BY v.vluchtnummer, v.bestemming, v.vertrektijd, v.max_aantal, v.max_totaalgewicht, m.naam, ib.balienummer, v.gatecode, v.maatschappijcode;';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':vluchtnummer', $vluchtnummer);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

$vluchtnummer = isset($_GET['vluchtnummer']) ? $_GET['vluchtnummer'] : '';
$vluchtDetails = getVlucht($vluchtnummer);
$vluchtenHtml = '';

if (!empty($vluchtDetails)) {
    $vluchtenHtml .= '<p><strong>Vertrektijd:</strong> ' . htmlspecialchars($vluchtDetails['vertrektijd']) . '</p>';
    $vluchtenHtml .= '<p><strong>Vluchtnummer:</strong> ' . htmlspecialchars($vluchtDetails['vluchtnummer']) . '</p>';
    $vluchtenHtml .= '<p><strong>Bestemming:</strong> ' . htmlspecialchars($vluchtDetails['bestemming']) . '</p>';
    $vluchtenHtml .= '<p><strong>Balienummer:</strong> ' . htmlspecialchars($vluchtDetails['balienummer']) . '</p>';
    $vluchtenHtml .= '<p><strong>Gatecode:</strong> ' . htmlspecialchars($vluchtDetails['gatecode']) . '</p>';
    $vluchtenHtml .= '<p><strong>Maatschappij:</strong> ' . htmlspecialchars($vluchtDetails['maatschappij_naam']) . '</p>';
    $vluchtenHtml .= '<p><strong>Max aantal passagiers:</strong> ' . htmlspecialchars($vluchtDetails['aantal_passagiers']) . ' / ' . htmlspecialchars($vluchtDetails['max_aantal']) . '</a></td>';
    $vluchtenHtml .= '<p><strong>Gewicht:</strong> ' . floor(htmlspecialchars($vluchtDetails['totaal_gewicht'])) . ' / ' . floor(htmlspecialchars($vluchtDetails['max_totaalgewicht'])) . '</a></td>';
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

    <?php include_once'../includes/navP.php'; ?>

    <main>
        <div class="vlucht">
            <div class="vluchtBestemming"><h2>New York</h2></div>
            <div class="vluchtImg">
                <img src="../img/Steden/NY.jpg" alt="stadsfoto">
            </div>
            <div class="vluchtTekst">
                <?php echo $vluchtenHtml; ?>
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