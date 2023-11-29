<?php

$naam = $_GET['voornaam'];

// $vliegtuignummer = $_GET['vliegtuig']
// $vluchtnummer = 
// $landingsbaan = 


$vandaag = date_create('now');
$datum = $vandaag->format('d-m-Y');

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>PHP voorbeeld</title>
</head>
<body>
    Hallo <?= $naam ?>.<br>
    <!-- Vliegtuig: <?= $vliegtuignummer = $_GET['vliegtuig'] ?> met vluchtnummer: <?= $vluchtnummer = $_GET['vluchtnummer'] ?> landt op: <?= $landingsbaan = $_GET['landingsbaan'] ?>.<br> -->
</body>
</html>
