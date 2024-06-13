<?php
function checkSessie() {
    if (!isset($_SESSION['username'])) {
        header('Location: inloggenP.php');
        exit();
    }
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

function omzettenLandVliegveld($vliegveld){ //omzetten van vluchthaven naar stad/land
    $land = '';

    switch($vliegveld){
        case 'AMS':
            $land = 'Amsterdam';
        break;
        case 'ENS':
            $land = 'Enschede';
        break;
        case 'CRL':
            $land = 'Charleroi';
        break;
        case 'DHR':
            $land = 'Den Helder';
        break;
        case 'LGG':
            $land = 'LaGrange';
        break;
        case 'ANR':
            $land = 'Antwerpen';
        break;
        case 'LEY':
            $land = 'Lelystad';
        break;
        case 'OST':
            $land = 'Oostende';
        break;
        case 'TEU':
            $land = 'Teuge';
        break;
    }

    return $land;
}

function checkInB() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['Pnummer'])) {
            $passagiernummer = $_POST['Pnummer'];
            $db = maakVerbinding();

            $sql = 'INSERT INTO Bagageobject (passagiernummer, objectvolgnummer, gewicht)
                    VALUES (:passagiernummer, :objectvolgnummer, :gewichtB)';
            $stmt = $db->prepare($sql);

            for ($i = 1; $i <= 3; $i++) {
                $gewichtVeld = "gewichtB" . $i;
                $gewicht = isset($_POST[$gewichtVeld]) ? $_POST[$gewichtVeld] : null;
                if ($gewicht !== null && $gewicht !== '') {
                    $stmt->bindParam(':passagiernummer', $passagiernummer);
                    $stmt->bindParam(':objectvolgnummer', $i);
                    $stmt->bindParam(':gewichtB', $gewicht);
                    $stmt->execute();
                }
            }
        }
    }
}