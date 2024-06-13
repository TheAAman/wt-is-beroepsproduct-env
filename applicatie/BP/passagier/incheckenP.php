<?php
session_start();

require_once ('../includes/db_connectie.php');
require_once ('../includes/functies.php');

checkSessie();

function checkInB($passagiernummerB, $objectvolgnummer, $gewichtB){
    $db = maakVerbinding();

    $sql = 'INSERT INTO Bagageobject (passagiernummer, objectvolgnummer, gewicht)
            VALUES (:passagiernummer, :objectvolgnummer, :gewichtB)';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':passagiernummer', $passagiernummerB);
    $stmt->bindParam(':objectvolgnummer', $objectvolgnummer);
    $stmt->bindParam(':gewichtB', $gewichtB);
    $stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Pnummer'])) {
        $passagiernummer = $_POST['Pnummer'];

        for ($i = 1; $i <= 3; $i++) {
            $gewichtField = "gewichtB" . $i;
            $gewicht = isset($_POST[$gewichtField]) ? $_POST[$gewichtField] : null;
            if ($gewicht !== null && $gewicht !== '') {
                checkInB($passagiernummer, $i, $gewicht);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../img/Icons/vticon.png">
    <title>Inchecken</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <?php include_once '../includes/navP.php'; ?>

    <main>
        <div class="incheckVelden">
            <div class="incheckveldP">
                <form action="incheckenP.php" method="POST">
                    <div class="titelincheckFormulier">
                    <h2>Inchecken</h2>
                    </div>
                    
                    <div class="form-field">
                        <label for="Naam">Naam</label>
                        <div class="passagiernaam">
                            <input type="text" name="Pname" id="Naam" placeholder="Naam">
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="vluchtnummer">Vluchtnummer</label>
                        <input type="number" name="Vnummer" id="vluchtnummer" placeholder="###" required>
                    </div>

                    <div class="form-field">
                        <label for="balienummer">Balienummer</label>
                        <input type="tel" name="Bnummer" id="balienummer" placeholder="###">
                    </div>

                    <div class="form-field">
                        <label for="passagiernummer">Passagiernummer</label>
                        <input type="number" name="Pnummer" id="passagiernummer" placeholder="###" required>
                    </div>

                    <div class="form-field">
                        <label for="geslacht">Geslacht:</label>
                        <select name="gender" id="geslacht">
                            <option value="Man">Man</option>
                            <option value="Vrouw">Vrouw</option>
                            <option value="Onzijdig">Onzijdig</option>
                        </select>
                    </div>

                    <div class="incheckKnop">
                        <input type="submit" name="inchecken" value="Inchecken">
                        <div class="tooltipIP">Inchecken passagier</div>
                    </div>
                </form>
            </div>

            <div class="incheckveldB">
                <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                    <div class="titelincheckFormulier">
                        <h2>Bagage</h2>
                    </div>

                    <div class="form-field">
                        <label for="passagiernummerB">Passagiernummer</label>
                        <input type="number" name="Pnummer" id="passagiernummerB" placeholder="###" required>
                    </div>

                    <div class="titelincheckFormulier">
                        <h4>Gewicht</h4>
                    </div>

                    <div class="form-field">
                        <label for="Gewicht1">Koffer 1</label>
                        <div class="gewichtKoffer">
                            <input type="number" name="gewichtB1" id="Gewicht1" placeholder="###" step="0.01">
                            <span>Gram</span>
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="Gewicht2">Koffer 2</label>
                        <div class="gewichtKoffer">
                            <input type="number" name="gewichtB2" id="Gewicht2" placeholder="Vul in als nodig" step="0.01">
                            <span>Gram</span>
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="Gewicht3">Koffer 3</label>
                        <div class="gewichtKoffer">
                            <input type="number" name="gewichtB3" id="Gewicht3" placeholder="Vul in als nodig" step="0.01">
                            <span>Gram</span>
                        </div> 
                    </div>

                    <div class="incheckKnop">
                        <input type="submit" name="inchecken" value="Inchecken">
                        <div class="tooltipIB">Inchecken bagage</div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
