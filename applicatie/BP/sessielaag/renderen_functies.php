<?php
//Bestemming vlucht functies
//Bestemmingstitel functie
function vluchtNaarLand($vluchtnummer) {
    $vluchtDetails = haalVlucht($vluchtnummer);

    if ($vluchtDetails) {
        $vliegveld = $vluchtDetails['bestemming'];
        $land = omzettenLandVliegveld($vliegveld);
        return $land;
    }

    return null;
}

//Bestemmingsafkorting omzetten naar land functie
function omzettenLandVliegveld($vliegveld){ 
    $db = maakVerbinding();

    $sql = 'SELECT naam, land 
            FROM Luchthaven
            WHERE luchthavencode = :vliegveld';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':vliegveld', $vliegveld);
    $stmt->execute();

    $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultaat) {
        $luchthaven = $resultaat['naam'];
        $land = $resultaat['land'];

        return array('luchthaven' => $luchthaven, 'land' => $land);
    }
}

//Vluchtinfo renderen homeP
function HomePvluchten($username) {
    $vluchtnummers = haalVluchtNummers($username);
    $vluchtDetailsArray = [];

    foreach ($vluchtnummers as $vluchtnummer) {
        $vluchtDetailsArray[] = haalVlucht($vluchtnummer);
    }

    $output = '';
    foreach ($vluchtDetailsArray as $vluchtDetails) {
        $land = vluchtNaarLand($vluchtDetails['vluchtnummer']);

        $output .= '
        <div class="homepvlucht">
            <h3>' . htmlspecialchars($land['luchthaven']) . '</h3>
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

//Vluchtinfo details functies
//2. Vluchtinfo detailspagina renderen
function vluchtNaarHtmlTabel($vluchtnummer) {
    $landVlucht = vluchtNaarLand($vluchtnummer);
    $vluchtDetails = haalVlucht($vluchtnummer);
    $vluchtenHtml = '';

    if (!empty($vluchtDetails)) {
        $vluchtenHtml .= '<p><strong>Vertrektijd:</strong> ' . htmlspecialchars($vluchtDetails['vertrektijd']) . '</p>';
        $vluchtenHtml .= '<p><strong>Vluchtnummer:</strong> ' . htmlspecialchars($vluchtDetails['vluchtnummer']) . '</p>';
        $vluchtenHtml .= '<p><strong>Bestemmingscode:</strong> ' . htmlspecialchars($vluchtDetails['bestemming']) . '</p>';
        $vluchtenHtml .= '<p><strong>Land:</strong> ' . htmlspecialchars($landVlucht['land']) . '</p>';
        $vluchtenHtml .= '<p><strong>Balienummer:</strong> ' . htmlspecialchars($vluchtDetails['balienummer']) . '</p>';
        $vluchtenHtml .= '<p><strong>Gatecode:</strong> ' . htmlspecialchars($vluchtDetails['gatecode']) . '</p>';
        $vluchtenHtml .= '<p><strong>Maatschappij:</strong> ' . htmlspecialchars($vluchtDetails['maatschappij_naam']) . '</p>';
        $vluchtenHtml .= '<p><strong>Max aantal passagiers:</strong> ' . htmlspecialchars($vluchtDetails['aantal_passagiers']) . ' / ' . htmlspecialchars($vluchtDetails['max_aantal']) . '</a></td>';
        $vluchtenHtml .= '<p><strong>Gewicht:</strong> ' . floor(htmlspecialchars($vluchtDetails['totaal_gewicht'])) . ' / ' . floor(htmlspecialchars($vluchtDetails['max_totaalgewicht'])) . '</a></td>';
    }
    return $vluchtenHtml;
}

//Vluchtinfo vluchtenlijst functies
//2-1. Vluchtinfo vluchtenlijst renderen voor passagiers
function vluchtenNaarHtmlTabelP($vluchtnummer, $sorteerKolom = 'bestemming', $sorteerVolgorde = 'ASC') {
    $vluchten = haalVluchten($vluchtnummer, $sorteerKolom, $sorteerVolgorde);

    $tabelHtmlP = '';

    if (count($vluchten) > 0) {
        $tabelHtmlP .= '<tr>';

        // Headers met sorteerlinks voor de eerste drie kolommen
        $tabelHeaders = ['Vluchtnummer', 'Bestemming', 'Vertrektijd', 'Passagiers', 'Gewicht'];
        foreach ($tabelHeaders as $header) {
            $sorteerbaar = in_array($header, ['Vluchtnummer', 'Bestemming', 'Vertrektijd']);
            $sorteerLink = "?Vluchtnummer=$vluchtnummer&sorteerKolom=" . strtolower($header) . "&sorteerVolgorde=" . ($sorteerKolom === strtolower($header) ? ($sorteerVolgorde === 'ASC' ? 'DESC' : 'ASC') : 'ASC');
            $tabelHtmlP .= '<th>' . ($sorteerbaar ? '<a href="' . $sorteerLink . '">' : '') . htmlspecialchars($header) . ($sorteerbaar ? '</a>' : '') . '</th>';
        }

        $tabelHtmlP .= '</tr>';

        foreach ($vluchten as $vlucht) {
            $tabelHtmlP .= '<tr>';

            $tabelHtmlP .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vluchtnummer']) . '</a></td>';
            $tabelHtmlP .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['bestemming']) . '</a></td>';
            $tabelHtmlP .= '<td><a href="vluchtP.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vertrektijd']) . '</a></td>';

            $passagierInfo = $vlucht['aantal_passagiers'] . ' / ' . $vlucht['max_aantal'];
            $gewichtInfo = intval($vlucht['totaal_gewicht']) . ' / ' . intval($vlucht['max_totaalgewicht']);

            $tabelHtmlP .= '<td>' . $passagierInfo . '</td>';
            $tabelHtmlP .= '<td>' . $gewichtInfo . '</td>';

            $tabelHtmlP .= '</tr>';
        }
    }

    return $tabelHtmlP;
}

//2-2. Vluchtinfo vluchtenlijst renderen voor medewerkers
function vluchtenNaarHtmlTabelM($vluchtnummer, $sorteerKolom = 'bestemming', $sorteerVolgorde = 'ASC') {
    $vluchten = haalVluchten($vluchtnummer, $sorteerKolom, $sorteerVolgorde);

    $tabelHtmlM = '';

    if (count($vluchten) > 0) {
        $tabelHtmlM .= '<tr>';

        // Headers met sorteerlinks voor de eerste drie kolommen
        $tabelHeaders = ['Vluchtnummer', 'Bestemming', 'Vertrektijd', 'Passagiers', 'Gewicht'];
        foreach ($tabelHeaders as $header) {
            $sorteerbaar = in_array($header, ['Vluchtnummer', 'Bestemming', 'Vertrektijd']);
            $sorteerLink = "?Vluchtnummer=$vluchtnummer&sorteerKolom=" . strtolower($header) . "&sorteerVolgorde=" . ($sorteerKolom === strtolower($header) ? ($sorteerVolgorde === 'ASC' ? 'DESC' : 'ASC') : 'ASC');
            $tabelHtmlM .= '<th>' . ($sorteerbaar ? '<a href="' . $sorteerLink . '">' : '') . htmlspecialchars($header) . ($sorteerbaar ? '</a>' : '') . '</th>';
        }

        $tabelHtmlM .= '</tr>';

        foreach ($vluchten as $vlucht) {
            $tabelHtmlM .= '<tr>';

            $tabelHtmlM .= '<td><a href="vluchtM.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vluchtnummer']) . '</a></td>';
            $tabelHtmlM .= '<td><a href="vluchtM.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['bestemming']) . '</a></td>';
            $tabelHtmlM .= '<td><a href="vluchtM.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($vlucht['vertrektijd']) . '</a></td>';

            $passagierInfo = $vlucht['aantal_passagiers'] . ' / ' . $vlucht['max_aantal'];
            $gewichtInfo = intval($vlucht['totaal_gewicht']) . ' / ' . intval($vlucht['max_totaalgewicht']);

            $tabelHtmlM .= '<td><a href="passagiersPerVlucht.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($passagierInfo) . '</a></td>';
            $tabelHtmlM .= '<td><a href="passagiersPerVlucht.php?vluchtnummer=' . htmlspecialchars($vlucht['vluchtnummer']) . '" class="vluchtenLink">' . htmlspecialchars($gewichtInfo) . '</a></td>';

            $tabelHtmlM .= '</tr>';
        }
    }

    return $tabelHtmlM;
}

//Passagier details functies
//2. Passagier details renderen
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
            $passagierHtml .= '<p><strong>Inchecktijdstip:</strong> ' . htmlspecialchars($p['inchecktijdstip'] ?? '') . '</p>';
        }
    }
    return $passagierHtml;
}

//Passagier per vlucht functies
//2. Passagier per vlucht renderen
function passagierPVNaarHtmlTabel($vluchtnummer) {
    $passagiers = passagierPerVlucht($vluchtnummer);

    $passagierPVHtml = '';

    if (count($passagiers) > 0) {
        foreach ($passagiers as $p) {
            $passagierPVHtml .= '<tr>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">' . htmlspecialchars($p['passagiernummer']) . '</a></td>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">' . htmlspecialchars($p['naam']) . '</a></td>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">' . htmlspecialchars($p['geslacht']) . '</a></td>';
            $passagierPVHtml .= '<td><a href="passagier.php?passagiernummer=' . htmlspecialchars($p['passagiernummer']) . '" class="vluchtenLink">' . htmlspecialchars($p['inchecktijdstip'] ?? '') . '</a></td>';
            $passagierPVHtml .= '</tr>';
        }
    }
    return $passagierPVHtml;
}

