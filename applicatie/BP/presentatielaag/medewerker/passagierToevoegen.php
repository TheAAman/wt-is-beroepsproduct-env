<?php
session_start();

require_once ('../includes/db_connectie.php');
require_once ('../includes/functies.php');

checkSessieM();

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

        $vlucht = getVlucht($Vnummer);

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../img/Icons/vticon.png">
    <title>Passagier Toevoegen</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <?php include_once'../includes/navM.php'; ?>

    <main>
        <div class="form-field">
            <a href="passagiers.php">Terug</a>
        </div>

        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <div class="form-field">
                <label for="Passagiernummer">Passagiernummer</label>
                <input type="number" name="Pnummer" id="Passagiernummer" placeholder="###" required>
            </div>
            <div class="form-field">
                <label for="Naam">Naam</label>
                <input type="text" name="Pnaam" id="Naam" required>
            </div>
            <div class="form-field">
                <label for="Geslacht">Geslacht</label>
                <select name="Pgeslacht" id="Geslacht">
                    <option value="M">M</option>
                    <option value="V">V</option>
                    <option value="O">O</option>
                </select>
            </div>
            <div class="form-field">
                <label for="Vluchtnummer">Vluchtnummer</label>
                <input type="number" name="Vnummer" id="Vluchtnummer" placeholder="###" required>
            </div>
            <div class="form-field">
                <label for="Balienummer">Balienummer</label>
                <select name="Vbalie" id="Balienummer" size="1" required>
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                    <option value="">4</option>
                    <option value="">5</option>
                    <option value="">6</option>
                    <option value="">7</option>
                    <option value="">8</option>
                    <option value="">9</option>
                    <option value="">10</option>
                </select>
            </div>
            <div class="form-field">
                <label for="Stoel">Stoel</label>
                <input type="text" name="Pstoel" id="Stoel" required>
            </div>
            <div class="form-field">
                <label for="Inchecktijd">Inchecktijdstip</label>
                <input type="datetime-local" name="Ptijd" id="Inchecktijd" required>
            </div>
            <input type="submit" name="OpslaanNieuweP" value="Opslaan">
        </form>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>