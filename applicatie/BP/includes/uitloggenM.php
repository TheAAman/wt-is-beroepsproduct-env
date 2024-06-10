<?php

session_start();

session_destroy();

header('Location: ../medewerker/inloggenM.php');