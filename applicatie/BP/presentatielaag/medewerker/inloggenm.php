<?php
session_start();

include_once('../includes/db_connectie.php');

$logged_in = false;

function checkBalie ($balienummer, $password){ 
    $db = maakVerbinding(); 
    
    $sql = 'SELECT * From Balie WHERE balienummer = :balienummer;'; 
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":balienummer", $balienummer);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
  
    if ($row) { 
      $stored_password = $row['wachtwoord'];
     
    // if (password_verify($password, $stored_password)) {
    if ($password === $stored_password){
          return true; 
        }
    }
    return false; 
}

if (isset($_POST['loginM'])){ 
    $balienummer = $_POST['balienummer']; 
    $password = $_POST['password']; 

    if (checkBalie($balienummer, $password)){
        $_SESSION['balienummer'] = $balienummer;
        $logged_in = true;
        
        header('Location: incheckenM.php'); 
        exit();
    } else {
        echo "Invalid balienummer or password"; 
    }
}

if ($logged_in) {
    header('Location: incheckenM.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="img/Icons/vticon.png">
    <title>Inloggen Medewerker</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <main>
        <div class="inlogTekst">
            <p>Vul hier uw inloggegevens in:</p>
        </div>
        <div class="inlogBlok">
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="number" name="balienummer" placeholder="balienummer" required>
                    <input type="password" name="password" placeholder="wachtwoord" required>
                    <input type="submit" name="loginM" value="login">
            </form>
        </div>
        <div class="terugKnop">
            <a href="../index.php">Terug</a>
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>