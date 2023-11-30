<?php
    $aantaldagen = '';

    if(ISSET($_GET['dagEén'])){
        $dagEén = $_GET['dagEén'];
        $dagTwee = $_GET['dagTwee'];

        $start = date_create($dagEén);
        $doel = date_create($dagTwee);

        $dagen = date_diff($start,$doel)->format('%a');
        $aantaldagen = 'Het verschil is ' .$dagen . ' dagen.';
    } else {
        $aantaldagen = 'Vul twee dagen in.';
    }
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Opdracht 1 Hoelang nog</title>
</head>
<body>
    <form method="GET" action="hoelangnog.php">
        <input type="text" name="dagEén">
        <input type="text" name="dagTwee">
        <input type="submit" name="submit" value="Bereken">
    </form>

    <?= $aantaldagen ?> 

</body>
</html>