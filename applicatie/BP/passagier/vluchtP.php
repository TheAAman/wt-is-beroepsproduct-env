<?php
session_start();

require_once ('../includes/db_connectie.php');
require_once ('../includes/functies.php');

checkSessie();

$vluchtnummer = isset($_GET['vluchtnummer']) ? $_GET['vluchtnummer'] : '';

$land = vluchtNaarLand($vluchtnummer);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../img/Icons/vticon.png">
    <title>Vluchtinfo</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <?php include_once'../includes/navP.php'; ?>

    <main>
        <div class="vlucht">
            <div class="vluchtBestemming"><h2><?php echo $land ?></h2></div>
            <div class="vluchtImg">
                <img src="../img/plane.jpg" alt="vliegtuig">
            </div>
            <div class="vluchtTekst">
            <?php echo vluchtNaarHtmlTabel($vluchtnummer); ?>
            </div>
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>