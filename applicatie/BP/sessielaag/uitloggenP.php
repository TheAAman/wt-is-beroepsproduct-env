<?php

session_start();

session_destroy();

header('Location: ../presentatielaag/passagier/inloggenP.php');