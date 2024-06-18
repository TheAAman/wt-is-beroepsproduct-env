<?php
require_once ('../../sessielaag/uitloggen_functies.php');

if (isset($_GET['action']) && $_GET['action'] == 'uitloggenM') {
        uitloggenM();
}
?>
<div class="menunavigatie">
        <a href="incheckenM.php" class="menuitem">Inchecken</a>
        <a href="vluchtenM.php" class="menuitem">Vluchten</a>
        <a href="passagierZoeken.php" class="menuitem">Passagiers</a>
        <a href="?action=uitloggenM" class="menuitem">Uitloggen</a>
</div>