<?php
session_start();

require_once ('../includes/db_connectie.php');
require_once ('../includes/functies.php');

checkSessieM();

$passagiernummer = isset($_GET['passagiernummer']) ? $_GET['passagiernummer'] : '';

function passagierInfo($passagiernummer) {
    $db = maakVerbinding();

    $sql = 'SELECT passagiernummer, naam, geslacht, vluchtnummer, balienummer, stoel, inchecktijdstip 
            FROM Passagier 
            WHERE passagiernummer = :Pnummer;';

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':Pnummer', $passagiernummer, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function passagierNaarHtmlTabel ($passagiernummer) {
    $passagier = passagierInfo($passagiernummer);

    $passagierHtml = '';

    if (count($passagier) > 0) {
        foreach ($passagier as $p) {
            $passagierHtml .= '<p><strong>Passagiernummer:</strong> ' . htmlspecialchars($p['passagiernummer']) . '</p>';
            $passagierHtml .= '<p><strong>Naam:</strong> ' . htmlspecialchars($p['naam']) . '</p>';
            $passagierHtml .= '<p><strong>Geslacht:</strong> ' . htmlspecialchars($p['geslacht']) . '</p>';
            $passagierHtml .= '<p><strong>Vluchtnummer:</strong> ' . htmlspecialchars($p['vluchtnummer']) . '</p>';
            $passagierHtml .= '<p><strong>Balie:</strong> ' . htmlspecialchars($p['balienummer']) . '</p>';
            $passagierHtml .= '<p><strong>Stoel:</strong> ' . htmlspecialchars($p['stoel']) . '</p>';
            $passagierHtml .= '<p><strong>Inchecktijdstip:</strong> ' . htmlspecialchars($p['inchecktijdstip']) . '</p>';
        }
    }
    return $passagierHtml;
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

    <?php include_once'../includes/navM.php'; ?>

    <main>
        <div class="passagierWijzigen">
            <a href="passagierWijzigen.html">Passagier wijzigen</a>
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