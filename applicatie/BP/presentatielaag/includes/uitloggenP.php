<?php

session_start();

session_destroy();

header('Location: ../passagier/inloggenP.php');