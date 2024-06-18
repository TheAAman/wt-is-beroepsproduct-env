<?php 
session_start();

require_once('../../datalaag/db_connectie.php');

require_once ('../includes/functies.php');

require_once ('../../sessielaag/checkSessie_functies.php');

checkSessieP();

$username = $_SESSION['username'];

function getVluchtNummers($username) {
    $db = maakVerbinding();

    $sql = 'SELECT DISTINCT vluchtnummer FROM Passagier WHERE naam = :username';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function getHomeVlucht($vluchtnummer) {
    $db = maakVerbinding();

    $sql = 'SELECT v.vluchtnummer, v.bestemming, v.vertrektijd, COUNT(p.passagiernummer) AS aantal_passagiers, v.max_aantal, SUM(v.max_gewicht_pp) AS totaal_gewicht, v.max_totaalgewicht, m.naam AS maatschappij_naam, ib.balienummer, v.gatecode, v.maatschappijcode
            FROM Vlucht v
            LEFT JOIN Passagier p ON v.vluchtnummer = p.vluchtnummer
            LEFT JOIN Maatschappij m ON v.maatschappijcode = m.maatschappijcode
            LEFT JOIN incheckenBestemming ib ON v.bestemming = ib.luchthavencode
            WHERE v.vluchtnummer = :vluchtnummer
            GROUP BY v.vluchtnummer, v.bestemming, v.vertrektijd, v.max_aantal, v.max_totaalgewicht, m.naam, ib.balienummer, v.gatecode, v.maatschappijcode;';

    $stmt = $db->prepare($sql);
    
    $stmt->bindParam(':vluchtnummer', $vluchtnummer);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$vluchtnummers = getVluchtNummers($username);
$vluchtDetailsArray = [];

foreach ($vluchtnummers as $vluchtnummer) {
    $vluchtDetailsArray[] = getHomeVlucht($vluchtnummer);
}

function homePvluchten($vluchtDetailsArray) {
    $output = '';
    foreach ($vluchtDetailsArray as $vluchtDetails) {
        $output .= '
        <div class="homepvlucht">
            <h3>' . omzettenLandVliegveld($vluchtDetails['bestemming']) . '</h3>
            <div class="vluchtImg">
                <a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vluchtDetails['vluchtnummer']) . '">
                    <img src="../img/plane.jpg" alt="vliegtuig">
                </a>
            </div>
            <p><strong>Vertrekt:</strong> ' . htmlspecialchars($vluchtDetails['vertrektijd']) . '</p>
            <p><strong>Balie:</strong> ' . htmlspecialchars($vluchtDetails['balienummer']) . '</p>
            <p><strong>Vluchtnummer:</strong> ' . htmlspecialchars($vluchtDetails['vluchtnummer']) . '</p>
        </div>';
    }
    return $output;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../img/Icons/vticon.png">
    <title>Homepagina</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>
    <?php include_once'../includes/navP.php'; ?>
    <main>
        <h2>Mijn vluchten:</h2>
        <div class="homepgrid">
            <?= homePvluchten($vluchtDetailsArray) ?>
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
