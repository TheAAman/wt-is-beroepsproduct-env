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

    <div class="menunavigatie">
        <a href="incheckenM.html" class="menuitem">Inchecken</a>
        <a href="vluchtenM.html" class="menuitem">Vluchten</a>
        <a href="passagierZoeken.html" class="menuitem">Passagiers</a>
        <a href="inloggenM.html" class="menuitem">Uitloggen</a>
    </div>
    
    <main>
        <div class="incheckVelden">
            <div class="incheckveldP">
                <form action="incheckenP.html" method="POST">
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
                <form action="inchecken.html" method="POST">
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
                            <input type="number" name="gewichtB" id="Gewicht1" placeholder="###">
                            <span>Gram</span>
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="Gewicht2">Koffer 2</label>
                        <div class="gewichtKoffer">
                            <input type="number" name="gewichtB" id="Gewicht2" placeholder="Vul in als nodig">
                            <span>Gram</span>
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="Gewicht3">Koffer 3</label>
                        <div class="gewichtKoffer">
                            <input type="number" name="gewichtB" id="Gewicht3" placeholder="Vul in als nodig">
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

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.html">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>