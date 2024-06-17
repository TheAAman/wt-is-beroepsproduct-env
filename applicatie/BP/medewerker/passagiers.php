<?php
session_start();

require_once ('../includes/db_connectie.php');
require_once ('../includes/functies.php');

checkSessieM();

$vluchtnummer = isset($_GET['Vluchtnummer']) ? $_GET['Vluchtnummer'] : '';

function passagierPerVlucht($vluchtnummer){
    $db = maakVerbinding();

    $sql = 'SELECT passagiernummer, naam, geslacht, incheckstijdstip
            FROM Passagier 
            WHERE vluchtnummer = :vluchtnummer;';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':vluchtnummer', $vluchtnummer);
    $stmt->execute();

    $passagiers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $passagiers;
}

function passagierPVNaarHtmlTabel ($vluchtnummer) {
    global $vluchtnummer;
    $passagiers = passagierPerVlucht($vluchtnummer);

    $passagierPVHtml = '';

    if (count($passagiers) > 0) {
        foreach ($passagiers as $p) {
            $passagierPVHtml .= '<tr>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">' . htmlspecialchars($p['passagiernummer']) . '</a></td>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">' . htmlspecialchars($p['naam']) . '</a></td>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">' . htmlspecialchars($p['geslacht']) . '</a></td>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">Ja</a></td>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">' . htmlspecialchars($p['incheckstijdstip']) . '</a></td>';
            $passagierPVHtml .= '</tr>';
        }
    }
    return $passagierPVHtml;

}

$passagierPVHtml = passagierPVNaarHtmlTabel($passagiernummer);

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

    <?php include_once'../includes/navM.php'; ?>

    <main>
        <div class="passagierToevoegen">
            <a href="passagierToevoegen.php">Passagier toevoegen</a>
        </div>

        <div class="belangrijkevluchtInfo">
            <h3>Bestemming:</h3><p>New York City</p>
            <h3>Vluchtnummer:</h3><p>27544</p>
            <h4>Ingecheckt:</h4><p> 25 / 50</p>
        </div>
        <div class="Overzicht">
            <table class="tabelOverzicht">
                <tr>
                    <th>Passagiernummer</th>
                    <th>Naam</th>
                    <th>Geslacht</th>
                    <th>Ingecheckt</th>
                    <th>Inchecktijdstip</th>
                </tr>
                <?= $passagierPVHtml ?>
            </table>           
        </div>
        <div class="terugKnop">
            <a href="vluchtenM.php">Terug</a>
        </div>

    </main>

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>