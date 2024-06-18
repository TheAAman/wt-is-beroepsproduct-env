<?php 
session_start();

require_once('../../datalaag/db_connectie.php');

require_once ('../../sessielaag/checkSessie_functies.php');
require_once ('../../datalaag/vluchtinfo_functies.php');
require_once ('../../sessielaag/renderen_functies.php');

checkSessieP();

$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../img/Icons/vticon.png">
    <title>Homepagina</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>
    <?php include_once'../includes/navP.php'; ?>
    <main>
        <h2>Mijn vluchten:</h2>
        <div class="homepgrid">
            <?= homePvluchten($username) ?>
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
