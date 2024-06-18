<?php
require_once ('../../sessielaag/uitloggen_functies.php');

if (isset($_GET['action']) && $_GET['action'] == 'uitloggenM') {
        uitloggenM();
}
?>
<div class="menunavigatie">
        <a href="homeP.php" class="menuitem">Home</a>
        <a href="vluchtenP.php" class="menuitem">Vluchten</a>
        <a href="incheckenP.php" class="menuitem">Inchecken</a>
        <a href="?action=uitloggenM" class="menuitem">Uitloggen</a>
</div>