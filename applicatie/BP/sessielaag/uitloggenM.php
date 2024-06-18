<?php

session_start();

session_destroy();

header('Location: ../presentatielaag/medewerker/inloggenM.php');