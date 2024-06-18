<?php

function uitloggenP(){	
    session_start();
    session_destroy();
    header('Location: ../passagier/inloggenP.php');
    exit();
}

function uitloggenM(){	
    session_start();   
    session_destroy();
    header('Location: ../medewerker/inloggenM.php');
    exit();
}