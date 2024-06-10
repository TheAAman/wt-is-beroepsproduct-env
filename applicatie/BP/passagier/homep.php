<?php 
session_start();

require_once ('../includes/db_connectie.php');

if (!isset($_SESSION['username'])) {
    header('Location: inloggenP.php');
    exit();
}
// if (isset($_POST['username']) && isset($_POST['password'])) {
        
//     function checkLogin($data) {
//         $data = trim($data);
//         $data = stripslashes($data);
//         $data = htmlspecialchars ($data);
//         return $data;
//     }

//     $username = checkLogin($_POST['username']);
//     $password = checkLogin($_POST['password']);

//     if (empty($username) || empty($password)) {
//         header('Location: inloggenP.php?error=1');
//         exit();
//     } else {
//         $sql = "SELECT * FROM Passagier WHERE naam = '$username' AND wachtwoord = '$password'";	
    
//         $result = $verbinding->query($sql);
//     }

// } else {
//     header('Location: inloggenP.php?error=1');
//     exit();
// }

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
        <h2>Vluchten vandaag:</h2>
        <div class="homepgrid">
            <div class="homepvlucht">
                <h3>New York</h3>
                <p>
                    <a href="vluchtP.php"><img src="../img/Steden/NY.jpg" alt="stadsfoto"></a>
                </p>
                <p><strong>Vertrekt:</strong> 06:46:00</p>
                <p><strong>Balie:</strong> 7</p>
                <p><strong>Vluchtnummer:</strong> 27544</p>
            </div>

            <div class="homepvlucht">
                <h4>Paris</h4>
                <p>
                    <img src="../img/Steden/Paris.jpg" alt="stadsfoto">
                </p>
                <p><strong>Vertrekt:</strong> 10:50:00</p>
                <p><strong>Balie:</strong> 3</p>
                <p><strong>Vluchtnummer:</strong> 27556</p>
            </div>

            <div class="homepvlucht">
                <h4>Amsterdam</h4>
                <p>
                    <img src="../img/Steden/Amsterdam.jpg" alt="stadsfoto">
                </p>
                <p><strong>Vertrekt:</strong> 14:00:00</p>
                <p><strong>Balie:</strong> 1</p>
                <p><strong>Vluchtnummer:</strong> 27582</p>
            </div>

            <div class="homepvlucht">
                <h4>Brussels</h4>
                <p>
                    <img src="../img/Steden/Brussels.jpg" alt="stadsfoto">
                </p>
                <p><strong>Vertrekt:</strong> 15:00:00</p>
                <p><strong>Balie:</strong> 2</p>
                <p><strong>Vluchtnummer:</strong> 28582</p>
            </div>
            
        </div>
    </main>

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>