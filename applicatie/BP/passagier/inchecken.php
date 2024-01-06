<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/stylep.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inchecken bagage passagier</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <div class="menupassagier">
        <div class="menupitem"><a href="homep.php">Home</a></div>
        <div class="menupitem"><a href="overzicht.php">Vluchten</a></div>
        <div class="menupitem"><a href="inchecken.php">Inchecken</a></div>
        <div class="menupitem">Uitloggen</div>
    </div>

    <main>

            <form action="Post" action="formulier.html" id="Registratieformulier">
                <div class="form-field">
                    <label for="fullname">Full Name</label>
                    <div class="fullname">
                        <input type="text" name="firstname" id="fname" placeholder="First">
                        <input type="text" name="lastname" id="lname" placeholder="Last">
                    </div>
                </div>

                <!-- <div class="form-field">
                    <label for="datebirth">Vluchtnummer</label>
                    <input type="date" name="datebirth" id="datebirth">
                </div> -->

                <div class="form-field">
                    <label for="email">E-mail address</label>
                    <input type="email" name="email" id="mail" placeholder="mailaddress">
                </div>

                <div class="form-field">
                    <label for="phone">Vluchtnummer</label>
                    <input type="tel" name="phone" id="phone" placeholder="###">
                </div>

                <div class="form-field">
                    <label for="phone">Balienummer</label>
                    <input type="tel" name="phone" id="phone" placeholder="###">
                </div>

                <div class="form-field">
                    <label for="phone">Passagiernummer</label>
                    <input type="tel" name="phone" id="phone" placeholder="###">
                </div>

                <!-- <div class="form-field">
                    <label for="studie">Studie</label>
                    <input type="text" name="studie" id="studie">
                </div> -->

                <div class="form-field">
                    <label for="jaar">Geslacht:</label>
                    <select name="jaar" id="jaar">
                        <option value="1">Man</option>
                        <option value="2">Vrouw</option>
                        <option value="3">Onzijdig</option>
                    </select>
                </div>
            </form>

    </main>

    <footer>
        <a href="https:www.han.nl">
            <img src="https://www.han.nl/lib/v3/images/han_university.svg" alt="Logo van de HAN" title="HAN">
        </a>
        <a href="privacy.html">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>