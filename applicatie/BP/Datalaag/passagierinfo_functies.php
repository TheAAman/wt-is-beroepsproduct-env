<?php
//Passagier details functies
//1. Passagier details ophalen
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

//Passagier per vlucht functies
//1. Passagier pers vlucht ophalen
function passagierPerVlucht($vluchtnummer){
    $db = maakVerbinding();

    $sql = 'SELECT passagiernummer, naam, geslacht, inchecktijdstip
            FROM Passagier 
            WHERE vluchtnummer = :vluchtnummer;';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':vluchtnummer', $vluchtnummer,);
    $stmt->execute();

    $passagiers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $passagiers;
}

//Passagier toevoegen functies
function toevoegenP(){
    $db = maakVerbinding();

    if(isset($_POST['OpslaanNieuweP'])){
        $Pnummer = $_POST['Pnummer'];
        $Pnaam = $_POST['Pnaam'];
        $Pgeslacht = $_POST['Pgeslacht'];
        $Vnummer = $_POST['Vnummer'];
        $Vbalie = $_POST['Vbalie'];
        $Pstoel = $_POST['Pstoel'];
        $Ptijd = $_POST['Ptijd'];

        $vlucht = haalVlucht($Vnummer);

        if ($vlucht['aantal_passagiers'] < $vlucht['max_aantal']) {
            $sql = 'UPDATE Passagier 
                    SET naam = :Pnaam, geslacht = :Pgeslacht, vluchtnummer = :Vnummer, balienummer = :Vbalie, stoel = :Pstoel, inchecktijd = :Ptijd 
                    WHERE passagiernummer = :Pnummer;';

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':Pnummer', $Pnummer, PDO::PARAM_INT);
            $stmt->bindParam(':Pnaam', $Pnaam);
            $stmt->bindParam(':Pgeslacht', $Pgeslacht);
            $stmt->bindParam(':Vnummer', $Vnummer, PDO::PARAM_INT);
            $stmt->bindParam(':Vbalie', $Vbalie, PDO::PARAM_INT);
            $stmt->bindParam(':Pstoel', $Pstoel);
            $stmt->bindParam(':Ptijd', $Ptijd);

            $stmt->execute();
        } else {
            echo "Vliegtuig zit vol";
        }
    }
}

//Passagier wijzigen functies
function wijzigP () {
    $db = maakVerbinding();

    if (isset($_POST['OpslaanWijzigP'])) {
        $Pnummer = $_POST['Pnummer'];
        $Pnaam = $_POST['Pnaam'];
        $Pgeslacht = $_POST['Pgeslacht'];
        $Vnummer = $_POST['Vnummer'];
        $Vbalie = $_POST['Vbalie'];
        $Pstoel = $_POST['Pstoel'];
        $Ptijd = $_POST['Ptijd'];

        $vlucht = haalVlucht($Vnummer);

        if ($vlucht['aantal_passagiers'] < $vlucht['max_aantal']) {
            $sql = 'UPDATE Passagier 
                    SET naam = :Pnaam, geslacht = :Pgeslacht, vluchtnummer = :Vnummer, balienummer = :Vbalie, stoel = :Pstoel, inchecktijd = :Ptijd 
                    WHERE passagiernummer = :Pnummer;';

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':Pnummer', $Pnummer, PDO::PARAM_INT);
            $stmt->bindParam(':Pnaam', $Pnaam);
            $stmt->bindParam(':Pgeslacht', $Pgeslacht);
            $stmt->bindParam(':Vnummer', $Vnummer, PDO::PARAM_INT);
            $stmt->bindParam(':Vbalie', $Vbalie, PDO::PARAM_INT);
            $stmt->bindParam(':Pstoel', $Pstoel);
            $stmt->bindParam(':Ptijd', $Ptijd);

            $stmt->execute();
        } else {
            echo "Vliegtuig zit vol";
        }
    }
}