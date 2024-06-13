<?php
session_start();

require_once ('../includes/db_connectie.php');
require_once ('../includes/functies.php');

checkSessie();

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

if ($vluchtDetails) {
    $vliegveld = $vluchtDetails['bestemming'];
    $land = omzettenLandVliegveld($vliegveld);
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
            <div class="vluchtBestemming"><h2><?php echo htmlspecialchars($land) ?></h2></div>
            <div class="vluchtImg">
                <img src="../img/plane.jpg" alt="vliegtuig">
            </div>
            <div class="vluchtTekst">
                <?php echo $vluchtenHtml; ?>
            </div>
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>