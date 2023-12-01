<?php

function uitrekenen ($getalA, $getalB){
    $uitkomst = $getalA + $getalB;
    return $uitkomst;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP voorbeeld functies</title>
</head>
<body>
    <?php
        echo uitrekenen(5,7);
    ?>
</body>
</html>