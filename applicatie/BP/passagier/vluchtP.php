<?php
session_start();

include_once('../includes/db_connectie.php');

function getVlucht() {
    $db = maakVerbinding();

    $sql = 'SELECT v.vluchtnummer, v.bestemming, v.gatecode, v.vertrektijd, v.maatschappijcode, v.max_aantal, m.naam AS maatschappij_naam, ib.balienummer
            FROM Vlucht v
            INNER JOIN Maatschappij m ON v.maatschappijcode = m.maatschappijcode
            LEFT JOIN incheckenBestemming ib ON v.bestemming = ib.luchthavencode
            WHERE v.vluchtnummer = :vluchtnummer';
    $stmt = $db->prepare($sql);
    $vluchtnummer = "28761";
    $stmt->bindParam(':vluchtnummer', $vluchtnummer);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

$vluchtDetails = getVlucht();
$vluchtenHtml = '';

if (!empty($vluchtDetails)) {
    $vluchtenHtml .= '<p><strong>Vertrektijd:</strong> ' . htmlspecialchars($vluchtDetails['vertrektijd']) . '</p>';
    $vluchtenHtml .= '<p><strong>Vluchtnummer:</strong> ' . htmlspecialchars($vluchtDetails['vluchtnummer']) . '</p>';
    $vluchtenHtml .= '<p><strong>Bestemming:</strong> ' . htmlspecialchars($vluchtDetails['bestemming']) . '</p>';
    $vluchtenHtml .= '<p><strong>Balienummer:</strong> ' . htmlspecialchars($vluchtDetails['balienummer']) . '</p>';
    $vluchtenHtml .= '<p><strong>Gatecode:</strong> ' . htmlspecialchars($vluchtDetails['gatecode']) . '</p>';
    $vluchtenHtml .= '<p><strong>Maatschappij:</strong> ' . htmlspecialchars($vluchtDetails['maatschappij_naam']) . '</p>';
    $vluchtenHtml .= '<p><strong>Max aantal passagiers:</strong> ' . htmlspecialchars($vluchtDetails['max_aantal']) . '</p>';
    //Gevuldheid = (max_gewicht_pp*aantal ingecheckte passagiers)/max_totaalgewicht??
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