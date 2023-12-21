<?php

function krijgSortering($sortering){
    
    $databaseKolom = 'vluchtnummer';
    switch($sortering){
        case 'luchthaven';
            $databaseKolom = 'luchthaven';
        break
        case 'vertrektijd';
            $databaseKolom = 'vertrektijd';
        break
    }
}

function bestaatVluchtnummer($db, $vluchtnummer){
    $bestaat = 0;
    $sql = 'SELECT count(*) FROM vlucht WHERE vluchtnummer = '.$vluchtnummer'';
    $data = $db->query($sql);
    $rij = $data -> fetch();
    $bestaat = $rij['bestaat'];
    return $bestaat
}

function krijgVluchtDetails(){
    $sql = 'SELECT COUNT(*) FROM Passagier WHERE vluchtnummer = '.$vluchtnummer.'';
    $data = $db->execute($sql);
    $rij = $data -> fetch();
}

function krijgBezetting ($db, $vluchtnummer){
    $sql = 'SELECT COUNT(*) FROM Passagier WHERE vluchtnummer = '.$vluchtnummer.'';
    $data = $db->execute($sql);
    $aantal = $data -> fetch();

    return $aantal('aantalPassagiers');
}


function krijgEnkeleVlucht($vluchtnummer){
    $html .='';

    if ($vluchtnummer >= 0){
        $sql = 'SELECT * FROM vluchten WHERE vluchtnummer = '.$vluchtnummer. ' AND 1=1';
    } else {
        $sql = 'SELECT * FROM vluchten';
        $data = $db->query($sql);

        foreach($data as $rij){
            $html = '
                <a href = ".html">
            '
        }
    }

}


function omzettenLandVliegveld ($vliegveld){
    $land = '';

    switch ($vliegveld){
        case 'AMS';
            $land = 'Amsterdam';
        break
        case 'ENS';
            $land = 'Enschede';
        break

    }
}


function vluchtNavigatie($van=0){

    $html = '';
    if(is_numeric($van)){
    if($van =< 5){
        $vorige = 0;
    } else {
        $vorige = $van - 5;
    } 
    $volgende = $van + 5;

    $html = '
        <a href="home.php?van=0">vorige</a>
        <a href="home.php?van=0">volgende</a>
    ';
    return $html;
}
}


function krijgVluchten ($db, $van = 0){

    if(is_numeric($van)){
        $van = 0;
    }
    $sql = 'SELECT bestemming, vertrektijd FROM vlucht order by vluchtnummer OFFSET 5 ROWS FETCH NEXT 5 ROWS only';
    $data = $db->query($sql);

    foreach($data as $rij){

            $html .= <div class="sorteren-op">
                <a href=vlucht.html>
                    <div class="bestemming">
                        <p class="plaatje-bestemming">
                            <img class="afbeelding-bestemming" src="img/'.$rij['bestemming']." alt="placeholder-voor-afbeelding">
                        </p>
                    </div>
                    <div class="tekst-bestemming">
                        <h3>'.$rij['bestemming']'</h3>
                        <p>
                            Vertrekt om: '.$rij['vertrektijd'].'
                        </p>
                    </div>
                </a>;
            return $html

    }
}





?>