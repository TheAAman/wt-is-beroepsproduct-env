<?php
//Vluchtinfo detailspagina functies
//1. Vluchtinfo detailspagina ophalen

//2. Vluchtinfo detailspagina renderen

//Vluchtinfo vluchtenlijst functies
// 1. Vluchtinfo vluchtenlijst ophalen

//2. Vluchtinfo vluchtenlijst renderen
//2-1. Vluchtinfo vluchtenlijst renderen voor passagiers

//2-2. Vluchtinfo vluchtenlijst renderen voor medewerkers

//Vluchtinfo vluchtenlijst functies (verouderd)
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
//Bestemmingstitel functie
