<?php
//Inchecken functies
//1. Inchecken passagier functie
function checkInP() {
    if (isset($_POST['inchecken'])) {
        $db = maakVerbinding();

        $Pname = $_POST['Pname'];
        $Vnummer = $_POST['Vnummer'];
        $Bnummer = $_POST['Bnummer'];
        $Pnummer = $_POST['Pnummer'];
        $gender = $_POST['gender'];

        $vlucht = getVlucht($Vnummer);

        if ($vlucht['aantal_passagiers'] < $vlucht['max_aantal']) {
            $sql = 'UPDATE Passagier 
                    SET vluchtnummer = :vluchtnummer, balienummer = :balienummer, passagiernaam = :passagiernaam, geslacht = :geslacht
                    WHERE passagiernummer = :passagiernummer';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':passagiernummer', $Pnummer, PDO::PARAM_INT);
            $stmt->bindParam(':vluchtnummer', $Vnummer, PDO::PARAM_INT);
            $stmt->bindParam(':balienummer', $Bnummer, PDO::PARAM_INT);
            $stmt->bindParam(':passagiernaam', $Pname);
            $stmt->bindParam(':geslacht', $gender);
            $stmt->execute();
        } else {
            echo "Vliegtuig zit vol";
        }
    }
}

//2. Inchecken bagage functie
function checkInB() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['Pnummer'])) {
            $passagiernummer = $_POST['Pnummer'];
            $db = maakVerbinding();

            $vluchtnummer = getVluchtByPassagier($passagiernummer);

            $vlucht = getVlucht($vluchtnummer);

            $totalBaggageWeight = 0;
            for ($i = 1; $i <= 3; $i++) {
                $gewichtVeld = "gewichtB" . $i;
                $gewicht = isset($_POST[$gewichtVeld]) ? $_POST[$gewichtVeld] : null;
                if ($gewicht !== null && $gewicht !== '') {
                    $totalBaggageWeight += (float)$gewicht;
                }
            }

            if ($vlucht['totaal_gewicht'] + $totalBaggageWeight <= $vlucht['max_totaalgewicht']) {
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
            } else {
                echo "Geen plek meer in bagageruimte";
            }
        }
    }
}
