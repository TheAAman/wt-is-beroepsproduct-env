<?php
session_start();

require_once ('../includes/db_connectie.php');

if (!isset($_SESSION['balienummer'])) {
    header('Location: inloggenM.php');
    exit();
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

        <form action="passagiers.php" method="post">
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
            <input type="submit" name="Opslaan" value="Opslaan">
        </form>
    </main>

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>