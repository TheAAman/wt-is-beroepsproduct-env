<?php

include_once('db_connectie.php');

$muziekschooltabel = '';

$db = maakVerbinding();

$sql = 'SELECT
            c.naam as componistnaam,
            c.geboortedatum as datum,
            m.naam as muziekschool,
            plaatsnaam
        FROM 
            Componist AS C
        LEFT JOIN 
            Muziekschool AS M 
        ON 
            C.schoolId = M.schoolId';

$data = $db -> prepare($sql);
$data -> execute();

$muziekschooltabel .= '<table border = "1">';

foreach ($data as $rij){
    $muziekschooltabel .= '<tr>';
        $muziekschooltabel .= '<td>' .$rij['componistnaam']. '</td>'; 
        $muziekschooltabel .= '<td>' .date("d F Y", strtotime($rij['datum'])). '</td>'; 
        $muziekschooltabel .= '<td>' .$rij['muziekschool']. '</td>';  
        $muziekschooltabel .= '<td>' .$rij['plaatsnaam']. '</td>';
    $muziekschooltabel .= '</tr>';
}

$muziekschooltabel .= '</table>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WTIS Les 3 Huiswerk</title>
</head>
<body>
    <?= $muziekschooltabel ?>
</body>
</html>