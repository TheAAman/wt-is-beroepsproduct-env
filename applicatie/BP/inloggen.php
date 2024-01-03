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
                    <input type="text" name="username">
                    <input type="password" name="password">
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