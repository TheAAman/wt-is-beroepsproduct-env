<?php

include_once('db_connectie.php');

$muziekschooltabel = '';

// $schoolnummer = $_GET['schoolId'];
// $plaats = $_GET['plaats'];
$genre = $_GET['genre'];

$db = maakVerbinding();
// $sql = 'select * from muziekschool WHERE schoolId= :Id AND plaatsnaam= :plaats';

$sql = 'SELECT
            stuknr,
            titel,
            genrenaam,
            n.omschrijving AS omschrijving,
            c.naam as componistnaam,
            c.geboortedatum as datum
        FROM 
            stuk s 
        LEFT OUTER JOIN 
            niveau n 
        ON
            s.niveaucode = n.niveaucode
        INNER JOIN
            componist c
        ON 
            s.componistId = c.componistId
        WHERE
            genrenaam = :genre';

$data = $db -> prepare($sql);
$data -> execute(['genre' => $genre]);

// var_dump($data);

$muziekschooltabel .= '<table border = "1">';

foreach ($data as $rij){
    $muziekschooltabel .= '<tr>';
        $muziekschooltabel .= '<td>' .$rij['stuknr']. '</td>';
        $muziekschooltabel .= '<td>' .$rij['titel']. '</td>';
        $muziekschooltabel .= '<td>' .$rij['genrenaam']. '</td>';
        $muziekschooltabel .= '<td>' .$rij['omschrijving']. '</td>';
        $muziekschooltabel .= '<td>' .$rij['componistnaam']. '</td>';
        $muziekschooltabel .= '<td>' .date("d/m/Y", strtotime($rij['datum'])). '</td>';
    $muziekschooltabel .= '</tr>';
    
}

$muziekschooltabel .= '</table>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP voorbeeld muziekstukken</title>
</head>
<body>
    <?= $muziekschooltabel ?>
</body>
</html>