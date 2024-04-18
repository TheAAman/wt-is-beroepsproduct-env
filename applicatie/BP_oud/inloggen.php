<?php
session_start(); // Starts or resumes the session

include_once('db_connectie.php'); // Includes the external file 'db_connectie.php'

$logged_in = false; // Initializes a variable $logged_in as false

if (isset($_GET['loguit'])){ // Checks if 'loguit' is set in the URL query parameters
    session_destroy(); // Destroys all data associated with the session
    header('location: login.php'); // Redirects to 'login.php'
    exit();
}

function checkUser ($username){ // Defines a function named checkUser that accepts a parameter $username
  $db = maakVerbinding(); // Calls the function maakVerbinding to create a database connection
  
  $sql = 'SELECT * From Gebruikers WHERE naam = ? AND 1=1;'; // Defines an SQL query to select data from the 'Gebruikers' table
  $stmt = $db->prepare($sql);
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $stored_password = $row['password']; // Assuming 'password' is the column name in the database

    // Verify the submitted password against the stored hashed password
    if (password_verify($password, $stored_password)) {
        return true; // Passwords match, user is authenticated
    }
}
return false; // Username or password doesn't match or user doesn't exist
}

if (isset ($_POST['submit'])){ // Checks if the form with the name 'submit' has been submitted via POST method
    $username = $_POST['username']; // Retrieves the value of 'username' from the submitted form
    $password = $_POST['password']; // Retrieves the value of 'password' from the submitted form

    if (checkUser($username, $password)){
        $_SESSION['username'] = $username;
        $logged_in = true;
        // Redirect to the logged-in page or perform necessary actions
    } else {
        echo "Invalid username or password"; // Display an error message for unsuccessful login attempts
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../../BP/img/vticon.png">
    <title>Inloggen</title>
</head>
<body>
    <!-- <?php
    if ($logged_in) {
        header('Location: passagier/homep.php');
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
                    <input type="text" name="username" placeholder="naam" required>
                    <input type="password" name="password" placeholder="wachtwoord" required>
                    <input type="submit" name="submit" value="login">
            </form>
        </div>
    </main>

    <footer>
        <a href="https:www.han.nl">
            <img src="https://www.han.nl/lib/v3/images/han_university.svg" alt="Logo van de HAN" title="HAN">
        </a>
        <a href="privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>