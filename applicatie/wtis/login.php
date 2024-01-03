<?php
session_start();
include_once('db_connectie.php');
$logged_in = false;

$hash = password_hash($wachtwoord, PASSWORD_DEFAULT, ['cost' => 12]);

$gebruiker = 'admin';
$wachtwoord = 'admin';

if (isset($_GET['loguit'])){
    session_destroy();
    header('location: login.php');
}

function checkUser ($username){
  $db = maakVerbinding();
  $sql = 'SELECT * From Gebruikers WHERE naam = ? AND 1=1;';
}

if (isset ($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == $gebruiker && password_verify($password, $hash)){
        $_SESSION['username'] = $gebruiker;
        $_SESSION['password'] = $hash;
        $logged_in = true;
    }
}

if (isset($_SESSION['username'])) {
  $html = "<h1> Welcome {$_SESSION['username']}</h1>";
  print_r($_SESSION);
}
?>

<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testsessie</title>
  </head>
  <body>
    <?php
    if ($logged_in) {
        echo $html;
        echo 'Ik ben ingelogd';
    }
    ?>
    <!-- TODO: ongeldige waarde voor `action`. -->
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
      <input type="text" name="username">
      <input type="password" name="password">
      <input type="submit" name="submit" value="login">
    </form>
    <a href="login.php?loguit=1">Log uit</a>
  </body>
</html>
