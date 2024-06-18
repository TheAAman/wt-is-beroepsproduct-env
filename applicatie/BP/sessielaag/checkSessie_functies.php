<?php
//Algemene functies
function checkSessieP() {
    if (!isset($_SESSION['username'])) {
        header('Location: inloggenP.php');
        exit();
    }
}

function checkSessieM() {
    if (!isset($_SESSION['balienummer'])) {
        header('Location: inloggenM.php');
        exit();
    }
}
