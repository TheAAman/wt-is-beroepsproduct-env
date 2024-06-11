<?php 
session_start();

require_once ('../includes/db_connectie.php');
require_once ('../includes/functies.php');

checkSessie();

$username = $_SESSION['username'];

function getVluchtNummer($username) {
    $db = maakVerbinding();

    $sql = 'SELECT TOP 1 vluchtnummer FROM Passagier WHERE naam = :username';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        return $row['vluchtnummer'];
    } else {
        return null;
    }
}

$vluchtnummer = getVluchtNummer($username);
$vluchtDetails = getVlucht($vluchtnummer);

if ($vluchtDetails) {
    $vliegveld = $vluchtDetails['bestemming'];
    $land = omzettenLandVliegveld($vliegveld);
}

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
            <div class="homepvlucht">
                <h3><?php echo htmlspecialchars($land) ?></h3>
                <p>
                    <a href="vluchtP.php?vluchtnummer=<?php echo htmlspecialchars($vluchtnummer); ?>"><img src="../img/Steden/NY.jpg" alt="stadsfoto"></a>
                </p>
                <p><strong>Vertrekt:</strong> <?php echo htmlspecialchars($vluchtDetails['vertrektijd']); ?></p>
                <p><strong>Balie:</strong> <?php echo htmlspecialchars($vluchtDetails['balienummer']); ?></p>
                <p><strong>Vluchtnummer:</strong> <?php echo htmlspecialchars($vluchtDetails['vluchtnummer']); ?></p>
            </div>            
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>