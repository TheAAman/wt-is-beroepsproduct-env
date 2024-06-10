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
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../img/Icons/vticon.png">
    <title>Overzicht passagiers</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <?php include_once'../includes/navM.php'; ?>

    <main>
        <div class="passagierToevoegen">
            <a href="passagierToevoegen.php">Passagier toevoegen</a>
        </div>

        <div class="belangrijkevluchtInfo">
            <h3>Bestemming:</h3><p>New York City</p>
            <h3>Vluchtnummer:</h3><p>27544</p>
            <h4>Ingecheckt:</h4><p> 25 / 50</p>
        </div>
        <div class="Overzicht">
            <table class="tabelOverzicht">
                <tr>
                    <th>Passagiernummer</th>
                    <th>Naam</th>
                    <th>Geslacht</th>
                    <th>Ingecheckt</th>
                    <th>Inchecktijdstip</th>
                </tr>
                <tr>
                    <td><a href="passagier.php" class="vluchtenLink">23454</a></td>
                    <td><a href="passagier.php" class="vluchtenLink">Etezard</a></td>
                    <td><a href="passagier.php" class="vluchtenLink">M</a></td>
                    <td><a href="passagier.php" class="vluchtenLink">Ja</a></td>
                    <td><a href="passagier.php" class="vluchtenLink">2023-10-11 / 06:15:00</a></td>
                </tr>
                <tr>
                    <td>23452</td>
                    <td>Cornymon</td>
                    <td>V</td>
                    <td>Nee</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>23474</td>
                    <td>Mosachu</td>
                    <td>O</td>
                    <td>Ja</td>
                    <td>2023-10-11 / 06:20:00</td>
                </tr>
                <tr>
                    <td>23491</td>
                    <td>Ballechu</td>
                    <td>M</td>
                    <td>Ja</td>
                    <td>2023-10-11 / 06:17:00</td>
                </tr>
                <tr>
                    <td>23503</td>
                    <td>Puffemon</td>
                    <td>O</td>
                    <td>Ja</td>
                    <td>2023-10-11 / 06:18:00</td>
                </tr>
                <tr>
                    <td>23654</td>
                    <td>John</td>
                    <td>M</td>
                    <td>Ja</td>
                    <td>2023-10-11 / 06:12:00</td>
                </tr>
                <tr>
                    <td>23454</td>
                    <td>Lilianne</td>
                    <td>V</td>
                    <td>Ja</td>
                    <td>2023-10-11 / 06:35:00</td>
                </tr>
                <tr>
                    <td>26454</td>
                    <td>Miriam</td>
                    <td>V</td>
                    <td>Nee</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>23454</td>
                    <td>Luuk</td>
                    <td>M</td>
                    <td>Ja</td>
                    <td>2023-10-11 / 06:40:00</td>
                </tr>
            </table>           
        </div>
        <div class="terugKnop">
            <a href="vluchtenM.php">Terug</a>
        </div>

    </main>

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>