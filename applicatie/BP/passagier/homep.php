<?php 
session_start();

require_once ('../includes/db_connectie.php');

$logged_in = false;

if (isset($_GET['loguit'])){ 
    session_destroy(); 
    header('Location: login.php'); 
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

function checkUser ($username, $password){ // Defines a function named checkUser that accepts a parameter $username
    $db = maakVerbinding(); // Calls the function maakVerbinding to create a database connection
    
    $sql = 'SELECT * From Passagier WHERE naam = :username AND 1=1;'; // Defines an SQL query to select data from the 'Gebruikers' table
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // Fetches the result as an associative array
  
    if ($row) { // Checks if a row is found
      $stored_password = $row['wachtwoord']; // Assuming 'password' is the column name in the database
  
      // Verify the submitted password against the stored hashed password
     $password = $_POST['password']; // Retrieves the value of 'password' from the submitted form
     
    if (password_verify($password, $stored_password)) {
          return true; // Passwords match, user is authenticated
      }
  }
  return false; // Username or password doesn't match or user doesn't exist
  }

if (isset ($_POST['loginP'])){ // Checks if the form with the name 'submit' has been submitted via POST method
    $username = $_POST['username']; // Retrieves the value of 'username' from the submitted form
    $password = $_POST['password']; // Retrieves the value of 'password' from the submitted form

    if (checkUser($username, $password)){
        $_SESSION['username'] = $username;
        $logged_in = true;
        // Redirect to the logged-in page or perform necessary actions
        header('Location: homep.php'); // Redirects to a welcome page or the appropriate logged-in page
        exit();
    } else {
        echo "Invalid username or password"; // Display an error message for unsuccessful login attempts
    }
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

    <div class="menunavigatie">
        <a href="homeP.php" class="menuitem">Home</a>
        <a href="vluchtenP.php" class="menuitem">Vluchten</a>
        <a href="incheckenP.php" class="menuitem">Inchecken</a>
        <a href="inloggenP.php" class="menuitem">Uitloggen</a>
    </div>

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