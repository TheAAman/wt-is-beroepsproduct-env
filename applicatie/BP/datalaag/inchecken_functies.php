<?php
//Inchecken functies
//1. Inchecken passagier functie
function checkInP() {
    if (isset($_POST['incheckenP'])) {
        $db = maakVerbinding();

        $Pname = $_POST['Pname'];
        $Vnummer = $_POST['Vnummer'];
        $Bnummer = $_POST['Bnummer'];
        $Pnummer = $_POST['Pnummer'];
        $gender = $_POST['gender'];
        $Ptijd = $_POST['Ptijd'];

        $Ptijdformat = date('Y-m-d H:i:s', strtotime($Ptijd)) . '.000';

        $vlucht = haalVlucht($Vnummer);

        if ($vlucht['aantal_passagiers'] < $vlucht['max_aantal']) {
            $sql = 'UPDATE Passagier 
                    SET vluchtnummer = :vluchtnummer, balienummer = :balienummer, naam = :passagiernaam, geslacht = :geslacht, inchecktijdstip = :Ptijd
                    WHERE passagiernummer = :passagiernummer';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':passagiernummer', $Pnummer, PDO::PARAM_INT);
            $stmt->bindParam(':vluchtnummer', $Vnummer, PDO::PARAM_INT);
            $stmt->bindParam(':balienummer', $Bnummer, PDO::PARAM_INT);
            $stmt->bindParam(':passagiernaam', $Pname);
            $stmt->bindParam(':geslacht', $gender);
            $stmt->bindParam(':Ptijd', $Ptijdformat);
            $stmt->execute();
        } else {
            echo "Vliegtuig zit vol";
        }
    }
}

//2. Inchecken bagage functie
//2.1 Passagiernummer aan vluchtnummer koppelen
function haalVluchtNperPassagierN($passagiernummer) {
    $db = maakVerbinding();

    $sql = 'SELECT v.vluchtnummer 
            FROM Passagier p
            JOIN Vlucht v ON p.vluchtnummer = v.vluchtnummer
            WHERE p.passagiernummer = :passagiernummer';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':passagiernummer', $passagiernummer, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row ? $row['vluchtnummer'] : null;
}

//2.2 Inchecken bagage functie
function checkInB() {
    if (isset($_POST['incheckenB'])) {
        if (isset($_POST['Pnummer'])) {
            $passagiernummer = $_POST['Pnummer'];
            $db = maakVerbinding();

            $vluchtnummer = haalVluchtNperPassagierN($passagiernummer);

            $vlucht = haalVlucht($vluchtnummer);

            $totalBaggageWeight = 0;
            for ($i = 1; $i <= 3; $i++) {
                $gewichtVeld = "gewichtB" . $i;
                $gewicht = isset($_POST[$gewichtVeld]) ? $_POST[$gewichtVeld] : null;
                if ($gewicht !== null && $gewicht !== '') {
                    $totalBaggageWeight += (float)$gewicht;
                }
            }

            if ($vlucht && ($vlucht['totaal_gewicht'] + $totalBaggageWeight <= $vlucht['max_totaalgewicht'])) {
                $sql = 'INSERT INTO Bagageobject (passagiernummer, objectvolgnummer, gewicht)
                        VALUES (:passagiernummer, :objectvolgnummer, :gewicht)';
                $stmt = $db->prepare($sql);

                for ($i = 1; $i <= 3; $i++) {
                    $gewichtVeld = "gewichtB" . $i;
                    $gewicht = isset($_POST[$gewichtVeld]) ? $_POST[$gewichtVeld] : null;
                    if ($gewicht !== null && $gewicht !== '') {
                        $stmt->bindParam(':passagiernummer', $passagiernummer);
                        $stmt->bindParam(':objectvolgnummer', $i);
                        $stmt->bindParam(':gewicht', $gewicht);
                        $stmt->execute();
                    }
                }

                echo "Baggage successfully checked in!";
            } else {
                echo "Geen plek meer in bagageruimte";
            }
        }
    }
}
