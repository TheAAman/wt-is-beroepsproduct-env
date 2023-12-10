<?php

include_once('db_connectie.php');   

$componistId        = '';
$naam               = '';
$geboortedatum      = '';
$schoolId           = '';

$informatieTabel    = '';

$fouten             = [];


if (isset($_POST['componistId'])){
    $componistId    = $_POST['componistId'];
    $naam           = $_POST['naam'];
    $geboortedatum  = $_POST['geboortedatum'];
    $schoolId       = $_POST['schoolId'];

    if(empty($componistId)){
        $fouten[] = 'Een componistId is verplicht';
    } 
    if(empty($naam)){
        $fouten[] = 'Een naam is verplicht';
    }
    if(empty($geboortedatum)){
        $fouten[] = 'Een geboortedatum is verplicht';
    }
    if(empty($schoolId)){
        $fouten[] = 'Een schoolId is verplicht';
    }

    if(count($fouten) > 0){
        //code voor wanneer er fouten zijn
        $informatieTabel = '<ul>';
        foreach ($fouten as $fout) {  
            $informatieTabel .= '<li>'.$fout.'</li>'; 
         }
        $informatieTabel .= '</ul>';
        
} else {
        //code voor wanneer er geen fouten zijn
        // $informatieTabel = '
        // <table>
        //     <tr>
        //         <td>componistId</td>
        //         <td>' .$componistId. '</td>
        //     </tr>
        //     <tr>
        //         <td>naam</td>
        //         <td>' .$naam. '</td>
        //     </tr>
        //     <tr>
        //         <td>geboortedatum</td>
        //         <td>' .$geboortedatum. '</td>
        //     </tr>
        //     <tr>
        //         <td>schoolId</td>
        //         <td>' .$schoolId. '</td>
        //     </tr>
        // </table>';

        $db = maakVerbinding();

        $sql = 'INSERT INTO Componist (componistId, naam, geboortedatum, schoolId)
                VALUES (:componistId, :naam, :geboortedatum, :schoolId)';

        $query = $db->prepare($sql);


        $sql2= 'SELECT 
                    naam
                From
                    muziekschool';

        $query2 = $db->prepare($sql2);
        $query2 = $db->execute();

        foreach()

        $data_array = [
            'componistId' => $componistId,
            'naam' => $naam,
            'geboortedatum' => $geboortedatum,
            'schoolId' => $schoolId
        ];

        $succes = $query->execute($data_array);
        if ($succes){
            $informatieTabel = 'Het is gelukt';
            $componistId        = '';
            $naam               = '';
            $geboortedatum      = '';
            $schoolId           = '';
        } else {
            $informatieTabel = 'Er heeft zich een probleem opgetreden tijdens het inserten';
        }
    }
}    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP voorbeeld - CRUD</title>
</head>
<body>
    <!-- <form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
    <input type="text" name="componistId" placeholder="componistId">    
        <input type="text" name="naam" placeholder="naam">
        <input type="text" name="geboortedatum" placeholder="geboortedatum">
        <?php echo getScholen(); ?>
        <input type="submit" placeholder="opslaan">
    </form> -->

    <form method="POST" action="crud.php">
        <input type="text" name="componistId" placeholder="componistId">    
        <input type="text" name="naam" placeholder="naam">
        <input type="text" name="geboortedatum" placeholder="geboortedatum">
        <input type="text" name="schoolId" placeholder="schoolId">
        <?=getScholen();?>
        <?=getComponist();?>
    </form>
</body>
</html>