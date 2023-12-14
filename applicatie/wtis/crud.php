<?php

function getScholen(){
    $db = maakVerbinding();
    $sql = 'SELECT 
                naam,
                schoolId
            From
                muziekschool';
    $data = $db->query($sql);

    $scholen = '<select name="schoolId" id="schoolId">';
    foreach($data as $rij){
        $scholen .= '<option value="'.$rij['schoolId'].'">'.$rij['naam'].'</option>';
    }
    $scholen .= '</select>';
    return $scholen;
}

function formatDate($datum){
    $datum = date_create($datum);
    $datum = date_format($datum, "Y/m/d H:i:s");
    return $datum;
}


function getComponist(){
    $db = maakVerbinding();
    $sql = 'SELECT 
                *
            FROM
                componist
            WHERE
                1=1';
    $data = $db->query($sql);

    $componisten = '<table border=1>';
    foreach($data as $rij){
        $componisten .= '<tr>';
        $componisten .= '<td>'.$rij['componistId'].'</td>';
        $componisten .= '<td>'.$rij['naam'].'</td>';
        $componisten .= '<td>'.$rij['geboortedatum'].'</td>';
        $componisten .= '<td><a href='.$_SERVER['PHP_SELF'].'?actie=verwijder&componist=' . $rij['componistId'].'>X</td>';
        $componisten .= '</tr>';
    }
    $componisten .= '</table>';

    return $componisten;
}

include_once('db_connectie.php');   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP voorbeeld - CRUD</title>
</head>
<body>
    <!-- <form method="POST" action="crud.php">
        <input type="text" name="componistId" placeholder="componistId">    
        <input type="text" name="naam" placeholder="naam">
        <input type="text" name="geboortedatum" placeholder="geboortedatum">
        <input type="text" name="schoolId" placeholder="schoolId">
        <?=getScholen();?>
        <?=getComponist();?>
    </form> -->

    <form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
        <input type="text" name="componistId" placeholder="componistId">    
        <input type="text" name="naam" placeholder="naam">
        <input type="text" name="geboortedatum" placeholder="geboortedatum">
        <?php echo getScholen(); ?>
        <input type="submit" placeholder="opslaan">
    </form>

</body>
</html>