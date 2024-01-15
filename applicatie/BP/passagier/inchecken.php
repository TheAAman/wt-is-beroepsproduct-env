<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/stylep.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../../BP/img/vticon.png">
    <title>Inchecken passagier</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <div class="menupassagier">
        <a href="homep.php" class="menupitem">Home</a>
        <a href="vluchten.php" class="menupitem">Vluchten</a>
        <a href="inchecken.php" class="menupitem">Inchecken</a>
        <a href="../inloggen.php" class="menupitem">Uitloggen</a>
    </div>

    <main>
        <div class="incheckVelden">
            <div class="incheckveldP">
                <form action="inchecken.php" method="POST">
                    <div class="titelincheckFormulier">
                    <p><h2>Passagier inchecken</h2></p>
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
                <form action="functie.php" method="POST">
                    <div class="titelincheckFormulier">
                        <p><h2>Bagage inchecken</h2></p>
                    </div>
                    <div class="form-field">
                        <label for="oVolgnummer">Baggagecode</label>
                        <input type="number" name="objectNummer" id="oVolgnummer" placeholder="###" required>
                    </div>

                    <div class="form-field">
                        <label for="Naam">Naam</label>
                        <div class="passagiernaam">
                            <input type="text" name="Pname" id="Naam" placeholder="Naam" >
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="passagiernummerB">Passagiernummer</label>
                        <input type="number" name="Pnummer" id="passagiernummerB" placeholder="###" required>
                    </div>

                    <div class="form-field">
                        <label for="balienummerB">Balienummer</label>
                        <input type="tel" name="Bnummer" id="balienummerB" placeholder="###">
                    </div>

                    <div class="incheckKnop">
                        <input type="submit" name="inchecken" value="Inchecken">
                        <div class="tooltipIB">Inchecken bagage</div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <a href="https:www.han.nl">
            <img src="https://www.han.nl/lib/v3/images/han_university.svg" alt="Logo van de HAN" title="HAN">
        </a>
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>