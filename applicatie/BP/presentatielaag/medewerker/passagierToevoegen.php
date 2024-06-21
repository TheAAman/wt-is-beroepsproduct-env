<?php
session_start();

require_once('../../datalaag/db_connectie.php');

require_once ('../../sessielaag/checkSessie_functies.php');
require_once ('../../datalaag/vluchtinfo_functies.php');
require_once ('../../datalaag/passagierinfo_functies.php');
require_once ('../../sessielaag/renderen_functies.php');

checkSessieM();

$vluchtnummer = isset($_GET['vluchtnummer']) ? $_GET['vluchtnummer'] : '';

toevoegenP();
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
            <a href="passagiersPerVlucht.php?vluchtnummer=<?=$vluchtnummer ?>">Terug</a>
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
                <input type="number" name="Vnummer" id="Vluchtnummer" placeholder="###" value="<?= $vluchtnummer ?>" required>
            </div>
            <div class="form-field">
                <label for="Balienummer">Balienummer</label>
                <select name="Vbalie" id="Balienummer" size="1">
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
                <input type="text" name="Pstoel" id="Stoel">
            </div>
            <div class="form-field">
                <label for="Inchecktijd">Inchecktijdstip</label>
                <input type="datetime-local" name="Ptijd" id="Inchecktijd">
            </div>
            <div class="form-field">
                <label for="Wachtwoord">Wachtwoord</label>
                <input type="password" name="Pwachtwoord" id="Wachtwoord">
            </div>
            <input type="submit" name="OpslaanNieuweP" value="Opslaan">
        </form>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>