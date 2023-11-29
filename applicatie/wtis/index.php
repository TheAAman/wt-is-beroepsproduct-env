<html>
    <head>
    </head>

    <body>
        Dit is geschreven in HTML! <br>
        <?php
            $tekst = '<h1>PHP - Hoofdstuk 1</h1>';

            echo $tekst . '<br>';

            echo strlen($tekst) . '<br>';

            echo strtoupper($tekst) . '<br>';

            echo strip_tags($tekst) . '<br>';

            $mijnTekst = <<<EOT
            Hier komt nu een enorm lange tekst over
            allemaal dingen die stopt als de bovenstaande karakters
            worden aangeroepen zoals hieronder:
            EOT;

            echo $mijnTekst . '<br>';

            echo strlen( string $mijnTekst) : int . '<br>';

            echo substr($mijnTekst) . '<br>';



        ?>
    </body>
</html>