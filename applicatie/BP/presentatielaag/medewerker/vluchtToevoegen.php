<?php
session_start();

require_once('../../datalaag/db_connectie.php');

require_once ('../../sessielaag/checkSessie_functies.php');
require_once ('../../datalaag/vluchtinfo_functies.php');
require_once ('../../sessielaag/renderen_functies.php');

checkSessieM();

function toevoegenVlucht($Vnummer, $Vbestemming, $Vdatum, $Vbalie, $Vgate, $Vluchthaven, $Vmaatschappij, $passagierMax, $aantalPassagiers, $gewichtMax, $gewichtppMax) {
    global $db;

    $sql = "INSERT INTO vluchten (Vluchtnummer, Bestemming, Vertrekdatum, Balienummer, Gatecode, Luchthaven, Maatschappijcode, PassagierMax, AantalPassagiers, GewichtMax, GewichtPPMax) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$Vnummer, $Vbestemming, $Vdatum, $Vbalie, $Vgate, $Vluchthaven, $Vmaatschappij, $passagierMax, $aantalPassagiers, $gewichtMax, $gewichtppMax]);
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
    <title>Vlucht toevoegen</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <?php include_once'../includes/navM.php'; ?>

    <main>
        <div class="form-field">
            <a href="vluchtenM.php">Terug</a>
        </div>

        <div class="toevoegenVluchtForm">
            <form action="vluchtenM.php" method="post">
                <div class="form-field">
                    <label for="Vluchtnummer">Vluchtnummer</label>
                    <input type="number" name="Vnummer" id="Vluchtnummer" placeholder="###" required>
                </div>
                <div class="form-field">
                    <label for="Bestemming">Bestemming</label>
                    <input type="text" name="Vbestemming" id="Bestemming" placeholder="Bestemming" required>
                </div>
                <div class="form-field">
                    <label for="Vertrekdatum">Datum en tijd vertrek</label>
                    <input type="datetime-local" name="Vdatum" id="Vertrekdatum" required>
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
                    <label for="Gatecode">Gatecode</label>
                    <select name="Vgate" id="Gatecode" size="1">
                        <option value="">A</option>
                        <option value="">B</option>
                        <option value="">C</option>
                        <option value="">D</option>
                        <option value="">E</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="Luchthaven">Luchthaven</label>
                    <input type="text" name="Vluchthaven" id="Luchthaven" placeholder="Luchthaven" required>
                </div>
                <div class="form-field">
                    <label for="Maatschappijcode">Maatschappijcode</label>
                    <input type="text" name="Vmaatschappij" id="Maatschappijcode" placeholder="Maatschappijcode" required>
                </div>
                <div class="form-field">
                    <label for="PassagierMax">Max. passagiers</label>
                    <input type="number" name="passagierMax" id="PassagierMax" placeholder="###" required>
                </div>
                <div class="form-field">
                    <label for="AantalPassagiers">Geboekte zetels</label>
                    <input type="number" name="aantalPassagiers" id="AantalPassagiers" placeholder="###">
                </div>
                <div class="form-field">
                    <label for="GewichtMax">Max. gewicht</label>
                    <input type="number" name="gewichtMax" id="GewichtMax" placeholder="###" required>
                </div>
                <div class="form-field">
                    <label for="GewichtPPMax">Max. gewicht per passagier</label>
                    <input type="number" name="gewichtppMax" id="GewichtPPMax" placeholder="###" required>
                </div>
                <div class="opslagKnop">
                    <input type="submit" name="Opslaan" value="Opslaan">
                </div>
            </form>
        </div>
    </main>

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>