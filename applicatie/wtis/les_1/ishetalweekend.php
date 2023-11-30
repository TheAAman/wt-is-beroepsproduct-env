<?php
    $datum = date_create('now')->format('w');
    $bericht = '';

// Optie: if 
    // if ($datum == 1 || $datum == 2){
    //     $bericht = 'Nog lang niet';
    // } else if ($datum == 3 || $datum == 4){
    //     $bericht = 'Nog even wachten';
    // } else if ($datum == 5){
    //     $bericht = 'Bijna';
    // } else {
    //     $bericht = 'Jaaaaa, het is weekend!';
    // }    q

// Optie: Switch
    switch($datum){
        case 1:
            $bericht = 'Nog lang niet';
            break;
        case 4:
            $bericht = 'Nog even wachten';
            break;
        case 5:
            $bericht = 'Bijna';
            break;
        default:
            $bericht = 'Jaaaaa, het is weekend!';
            break;
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opdracht 2 ishetalweekend</title>
</head>
<body>
    <?= $bericht ?>
</body>
</html>