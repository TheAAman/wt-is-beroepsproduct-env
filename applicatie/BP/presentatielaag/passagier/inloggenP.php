<?php
session_start();

require_once('../includes/db_connectie.php'); 

$logged_in = false;

function checkUser ($username, $password){ 
    $db = maakVerbinding(); 
    
    $sql = 'SELECT * From Passagier WHERE naam = :username;'; 
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":username", $username);
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

if (isset($_POST['loginP'])){ 
    $username = $_POST['username']; 
    $password = $_POST['password']; 

    if (checkUser($username, $password)){
        $_SESSION['username'] = $username;
        $logged_in = true;
        
        header('Location: homep.php'); 
        exit();
    } else {
        echo "Invalid username or password"; 
    }
}

if ($logged_in) {
    header('Location: homep.php');
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
    <title>Inloggen Passagier</title>
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
                    <input type="text" name="username" placeholder="naam" required>
                    <input type="password" name="password" placeholder="wachtwoord" required>
                    <input type="submit" name="loginP" value="login">
            </form>
        </div>
        <div class="terugKnop">
            <a href="../index.php" class="terugKnopButton">Terug</a>
        </div>
    </main>

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>