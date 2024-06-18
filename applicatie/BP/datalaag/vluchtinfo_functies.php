<?php
//Vluchtnummers gekoppeld aan passagiernaam functie
function haalVluchtNummers($username) {
    $db = maakVerbinding();

    $sql = 'SELECT DISTINCT vluchtnummer 
            FROM Passagier 
            WHERE naam = :username';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

//Vluchtinfo details functies
//1. Vluchtinfo detailspagina ophalen
function haalVlucht($vluchtnummer) {
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

//Vluchtinfo vluchtenlijst functies
// 1. Vluchtinfo vluchtenlijst ophalen
function haalVluchten($vluchtnummer, $sorteerKolom, $sorteerVolgorde) {
    $validColumns = ['vluchtnummer', 'bestemming', 'vertrektijd'];
    $sorteerKolom = in_array($sorteerKolom, $validColumns) ? $sorteerKolom : 'bestemming';
    $sorteerVolgorde = ($sorteerVolgorde === 'DESC') ? 'DESC' : 'ASC';

    $sql = 'SELECT v.vluchtnummer, v.bestemming, v.vertrektijd, COUNT(p.passagiernummer) AS aantal_passagiers, v.max_aantal, SUM(v.max_gewicht_pp) AS totaal_gewicht, v.max_totaalgewicht
            FROM Vlucht v
            LEFT JOIN Passagier p ON v.vluchtnummer = p.vluchtnummer
            WHERE v.vluchtnummer LIKE :vluchtnummer
            GROUP BY v.vluchtnummer, v.bestemming, v.vertrektijd, v.max_aantal, v.max_totaalgewicht
            ORDER BY ' . $sorteerKolom . ' ' . $sorteerVolgorde;

    $db = maakVerbinding();
    $stmt = $db->prepare($sql);
    $vluchtnummer = "%$vluchtnummer%";
    $stmt->bindParam(':vluchtnummer', $vluchtnummer);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}