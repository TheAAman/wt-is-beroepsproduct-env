<?php
session_start();

require_once('../../datalaag/db_connectie.php');

require_once ('../../sessielaag/checkSessie_functies.php');
require_once ('../../datalaag/vluchtinfo_functies.php');
require_once ('../../datalaag/inchecken_functies.php');

checkSessieM();

checkInP();
checkInB();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../img/Icons/vticon.png">
    <title>Inchecken medewerker</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <?php include_once'../includes/navM.php'; ?>
    
    <main>
        <div class="incheckVelden">
            <div class="incheckveldP">
                <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                    <div class="titelincheckFormulier">
                        <h2>Inchecken</h2>
                    </div>
                    
                    <div class="form-field">
                        <label for="Naam">Naam</label>
                        <div class="passagiernaam">
                            <input type="text" name="Pname" id="Naam" placeholder="Naam" required>
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="vluchtnummer">Vluchtnummer</label>
                        <input type="number" name="Vnummer" id="vluchtnummer" placeholder="###" required>
                    </div>

                    <div class="form-field">
                        <label for="balienummer">Balienummer</label>
                        <input type="tel" name="Bnummer" id="balienummer" placeholder="1-10" required>
                    </div>

                    <div class="form-field">
                        <label for="passagiernummer">Passagiernummer</label>
                        <input type="number" name="Pnummer" id="passagiernummer" placeholder="###" required>
                    </div>

                    <div class="form-field">
                        <label for="geslacht">Geslacht:</label>
                        <select name="gender" id="geslacht">
                            <option value="M">Man</option>
                            <option value="V">Vrouw</option>
                            <option value="O">Onzijdig</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="Inchecktijd">Inchecktijdstip</label>
                        <input type="datetime-local" name="Ptijd" id="Inchecktijd">
                    </div>

                    <div class="incheckKnop">
                        <input type="submit" name="incheckenP" value="Inchecken">
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
                        <input type="submit" name="incheckenB" value="Inchecken">
                        <div class="tooltipIB">Inchecken bagage</div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>