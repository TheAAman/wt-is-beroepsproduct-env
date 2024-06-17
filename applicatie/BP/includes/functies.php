<?php
//Algemene functies
function checkSessieP() {
    if (!isset($_SESSION['username'])) {
        header('Location: inloggenP.php');
        exit();
    }
}

function checkSessieM() {
    if (!isset($_SESSION['balienummer'])) {
        header('Location: inloggenM.php');
        exit();
    }
}

//Vluchtinfo functies
//1. Vluchtinfo ophalen
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

//2. Vluchtinfo renderen
function vluchtNaarHtmlTabel($vluchtnummer) {
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
    return $vluchtenHtml;
}

//Zoeken vlucht info
function getVluchten($vluchtnummer, $sorteerColom, $sorteerVolgorde) {
    $db = maakVerbinding();

    $sql = 'SELECT v.vluchtnummer, v.bestemming, v.vertrektijd, COUNT(p.passagiernummer) AS aantal_passagiers, v.max_aantal, SUM(v.max_gewicht_pp) AS totaal_gewicht, v.max_totaalgewicht
            FROM Vlucht v
            LEFT JOIN Passagier p ON v.vluchtnummer = p.vluchtnummer
            WHERE v.vluchtnummer LIKE :vluchtnummer
            GROUP BY v.vluchtnummer, v.bestemming, v.vertrektijd, v.max_aantal, v.max_totaalgewicht
            ORDER BY ' . $sorteerColom . ' ' . $sorteerVolgorde;

    $stmt = $db->prepare($sql);
    $vluchtnummer = "%$vluchtnummer%";
    $stmt->bindParam(':vluchtnummer', $vluchtnummer);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function vluchtenNaarHtmlTabelP($vluchtnummer, $sorteerColom = 'bestemming', $sorteerVolgorde = 'ASC') {
    $vluchten = getVluchten($vluchtnummer, $sorteerColom, $sorteerVolgorde);

    $tableRows = '';

    if (count($vluchten) > 0) {
        $tableRows .= '<tr>';

        // Add table headers (include sortable links for first three columns)
        $tableHeaders = ['Vluchtnummer', 'Bestemming', 'Vertrektijd', 'Passagiers', 'Gewicht'];
        foreach ($tableHeaders as $header) {
            $isSortable = in_array($header, ['Vluchtnummer', 'Bestemming', 'Vertrektijd']);
            $sortLink = "?Vluchtnummer=$vluchtnummer&sorteerColom=" . strtolower($header) . "&sorteerVolgorde=" . ($sorteerColom === strtolower($header) ? ($sorteerVolgorde === 'ASC' ? 'DESC' : 'ASC') : 'ASC');
            $tableRows .= '<th>' . ($isSortable ? '<a href="' . $sortLink . '">' : '') . htmlspecialchars($header) . ($isSortable ? '</a>' : '') . '</th>';
        }

        $tableRows .= '</tr>';

        foreach ($vluchten as $vlucht) {
            $tableRows .= '<tr>';

            // Display all data in corresponding columns
            $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vluchtnummer']) . '</a></td>';
            $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['bestemming']) . '</a></td>';
            $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vertrektijd']) . '</a></td>';

            // Combine data for 'Passagiers' and 'Gewicht' as done previously
            $passagierInfo = $vlucht['aantal_passagiers'] . ' / ' . $vlucht['max_aantal'];
            $gewichtInfo = intval($vlucht['totaal_gewicht']) . ' / ' . intval($vlucht['max_totaalgewicht']);

            $tableRows .= '<td>' . $passagierInfo . '</td>';
            $tableRows .= '<td>' . $gewichtInfo . '</td>';

            $tableRows .= '</tr>';
        }
    }

    return $tableRows;
}

function vluchtenNaarHtmlTabelM($vluchtnummer, $sorteerColom = 'bestemming', $sorteerVolgorde = 'ASC') {
    $vluchten = getVluchten($vluchtnummer, $sorteerColom, $sorteerVolgorde);

    $tableRows = '';

    if (count($vluchten) > 0) {
        $tableRows .= '<tr>';

        // Add table headers (include sortable links for first three columns)
        $tableHeaders = ['Vluchtnummer', 'Bestemming', 'Vertrektijd', 'Passagiers', 'Gewicht'];
        foreach ($tableHeaders as $header) {
            $isSortable = in_array($header, ['Vluchtnummer', 'Bestemming', 'Vertrektijd']);
            $sortLink = "?Vluchtnummer=$vluchtnummer&sorteerColom=" . strtolower($header) . "&sorteerVolgorde=" . ($sorteerColom === strtolower($header) ? ($sorteerVolgorde === 'ASC' ? 'DESC' : 'ASC') : 'ASC');
            $tableRows .= '<th>' . ($isSortable ? '<a href="' . $sortLink . '">' : '') . htmlspecialchars($header) . ($isSortable ? '</a>' : '') . '</th>';
        }

        $tableRows .= '</tr>';

        foreach ($vluchten as $vlucht) {
            $tableRows .= '<tr>';

            // Display all data in corresponding columns
            $tableRows .= '<td><a href="vluchtM.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vluchtnummer']) . '</a></td>';
            $tableRows .= '<td><a href="vluchtM.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['bestemming']) . '</a></td>';
            $tableRows .= '<td><a href="vluchtM.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vertrektijd']) . '</a></td>';

            // Combine data for 'Passagiers' and 'Gewicht' as done previously
            $passagierInfo = $vlucht['aantal_passagiers'] . ' / ' . $vlucht['max_aantal'];
            $gewichtInfo = intval($vlucht['totaal_gewicht']) . ' / ' . intval($vlucht['max_totaalgewicht']);

            $tableRows .= '<td>' . $passagierInfo . '</td>';
            $tableRows .= '<td>' . $gewichtInfo . '</td>';

            $tableRows .= '</tr>';
        }
    }

    return $tableRows;
}

// function getVluchten($vluchtnummer) {
//     $db = maakVerbinding();

//     $sql = 'SELECT v.vluchtnummer, v.bestemming, v.vertrektijd, COUNT(p.passagiernummer) AS aantal_passagiers, v.max_aantal, SUM(v.max_gewicht_pp) AS totaal_gewicht, v.max_totaalgewicht
//             FROM Vlucht v
//             LEFT JOIN Passagier p ON v.vluchtnummer = p.vluchtnummer
//             WHERE v.vluchtnummer LIKE :vluchtnummer
//             GROUP BY v.vluchtnummer, v.bestemming, v.vertrektijd, v.max_aantal, v.max_totaalgewicht';
//     $stmt = $db->prepare($sql);
//     $vluchtnummer = "%$vluchtnummer%";
//     $stmt->bindParam(':vluchtnummer', $vluchtnummer);
//     $stmt->execute();

//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

// function vluchtenNaarHtmlTabelP ($vluchtnummer) {
//     $vluchten = getVluchten($vluchtnummer);

//     $tableRows = '';

//     if (count($vluchten) > 0) {
//         foreach ($vluchten as $vlucht) {
//             $tableRows .= '<tr>';
//             $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vluchtnummer']) . '</a></td>';
//             $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['bestemming']) . '</a></td>';
//             $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vertrektijd']) . '</a></td>';
//             $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['aantal_passagiers']) . ' / ' . htmlspecialchars($vlucht['max_aantal']) . '</a></td>';
//             $tableRows .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . floor(htmlspecialchars($vlucht['totaal_gewicht'])) . ' / ' . floor(htmlspecialchars($vlucht['max_totaalgewicht'])) . '</a></td>';
//             $tableRows .= '</tr>';
//         }
//     }
//     return $tableRows;
// }

// function vluchtenNaarHtmlTabelM ($vluchtnummer) {
//     $vluchten = getVluchten($vluchtnummer);

//     $tableRows = '';

//     if (count($vluchten) > 0) {
//         foreach ($vluchten as $vlucht) {
//             $tableRows .= '<tr>';
//             $tableRows .= '<td><a href="vluchtM.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vluchtnummer']) . '</a></td>';
//             $tableRows .= '<td><a href="vluchtM.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['bestemming']) . '</a></td>';
//             $tableRows .= '<td><a href="vluchtM.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vertrektijd']) . '</a></td>';
//             $tableRows .= '<td><a href="vluchtM.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['aantal_passagiers']) . ' / ' . htmlspecialchars($vlucht['max_aantal']) . '</a></td>';
//             $tableRows .= '<td><a href="vluchtM.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . floor(htmlspecialchars($vlucht['totaal_gewicht'])) . ' / ' . floor(htmlspecialchars($vlucht['max_totaalgewicht'])) . '</a></td>';
//             $tableRows .= '</tr>';
//         }
//     }
//     return $tableRows;
// }

//Bestemming vlucht functie
function vluchtNaarLand($vluchtnummer) {
    $vluchtDetails = getVlucht($vluchtnummer);

    if ($vluchtDetails) {
        $vliegveld = $vluchtDetails['bestemming'];
        $land = omzettenLandVliegveld($vliegveld);
        return $land;
    }

    return null;
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

//Inchecken functies
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

function checkInP() {
    if (isset($_POST['inchecken'])) {
        $db = maakVerbinding();

        $Pname = $_POST['Pname'];
        $Vnummer = $_POST['Vnummer'];
        $Bnummer = $_POST['Bnummer'];
        $Pnummer = $_POST['Pnummer'];
        $gender = $_POST['gender'];

        $sql = 'UPDATE Passagier (vluchtnummer, balienummer, passagiernaam, geslacht)
                VALUES (:vluchtnummer, :balienummer, :passagiernaam, :geslacht);
                WHERE passagiernummer = :passagiernummer';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':passagiernummer', $Pnummer);
        $stmt->bindParam(':vluchtnummer', $Vnummer);
        $stmt->bindParam(':balienummer', $Bnummer);
        $stmt->bindParam(':passagiernaam', $Pname);
        $stmt->bindParam(':geslacht', $gender);
        $stmt->execute();

    }
}