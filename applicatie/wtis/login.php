<?php
session_start();

$logged_in = false;

$gebruiker = 'admin';
$wachtwoord = 'admin';

$hash = password_hash($wachtwoord, PASSWORD_DEFAULT, ['cost' => 12]);

if (isset($_GET['loguit'])){
    session_destroy();
    header('location: login.php');
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
