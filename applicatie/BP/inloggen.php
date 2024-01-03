<?php
session_start(); // Starts or resumes the session
include_once('db_connectie.php'); // Includes the external file 'db_connectie.php'
$logged_in = false; // Initializes a variable $logged_in as false

$hash = password_hash($wachtwoord, PASSWORD_DEFAULT, ['cost' => 12]); // Generates a password hash using the password_hash function

$gebruiker = 'admin'; // Assigns 'admin' to the variable $gebruiker
$wachtwoord = 'admin'; // Assigns 'admin' to the variable $wachtwoord

if (isset($_GET['loguit'])){ // Checks if 'loguit' is set in the URL query parameters
    session_destroy(); // Destroys all data associated with the session
    header('location: login.php'); // Redirects to 'login.php'
}

function checkUser ($username){ // Defines a function named checkUser that accepts a parameter $username
  $db = maakVerbinding(); // Calls the function maakVerbinding to create a database connection
  $sql = 'SELECT * From Gebruikers WHERE naam = ? AND 1=1;'; // Defines an SQL query to select data from the 'Gebruikers' table
}

if (isset ($_POST['submit'])){ // Checks if the form with the name 'submit' has been submitted via POST method
    $username = $_POST['username']; // Retrieves the value of 'username' from the submitted form
    $password = $_POST['password']; // Retrieves the value of 'password' from the submitted form

    if ($username == $gebruiker && password_verify($password, $hash)){ // Checks if the provided username matches $gebruiker and the password matches the hashed password using password_verify function
        $_SESSION['username'] = $gebruiker; // Sets the 'username' session variable to $gebruiker
        $_SESSION['password'] = $hash; // Sets the 'password' session variable to the hashed password
        $logged_in = true; // Sets $logged_in to true indicating successful login
    }
}

if (isset($_SESSION['username'])) { // Checks if the 'username' session variable is set
  $html = "<h1> Welcome {$_SESSION['username']}</h1>"; // Generates a welcome message using the 'username' session variable
  print_r($_SESSION); // Outputs the contents of the session
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen Passagier</title>
</head>
<body>
    <!-- <?php
    if ($logged_in) {
        header('Location: homep.php');
        exit();
    }
    ?> -->
    <header>
        <h1>Gelre airport</h1>
    </header>

    <main>
        <div class="inlogTekst">
            <p>Vul hier uw inloggegevens in: </p>
        </div>
        <div class="inlogBlok">
            
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="text" name="username" placeholder="naam">
                    <input type="password" name="password" placeholder="wachtwoord">
                    <input type="submit" name="submit" value="login">
            </form>
        </div>

    </main>

    <footer>
        <a href="https:www.han.nl">
            <img src="https://www.han.nl/lib/v3/images/han_university.svg" alt="Logo van de HAN" title="HAN">
        </a>
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>