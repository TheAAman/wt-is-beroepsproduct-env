<?php
    $menu = [
        'eten' => ['Shoarma' => '6,95', 'Appels' => '10.95', 'Tabouleh' => '8.95', 'Hamburger' => '5,50'], 
        'drinken' => ['Cola' => '2.00', 'Ayran' => '2.30', 'Fernandeds' => '2.50', 'Bier' => '5.50'],
        'toetjes' => ['Monchou' => '5.00', 'Appeltaart' => '3.40', 'Chocoladetaart' => '6.00']
    ];

$menukaart = '';

$soort = $_GET['soort'];

if ($soort=='drinken' || $soort=='toetjes' != 'drinken' && $soort != 'toetjes'){
  foreach($menu as $categorie => $item){
    if ($categorie == $soort) {
      $menukaart .= '<h2>' .$categorie. '</h2>';
      $menukaart .= '<table border = "1">';
        foreach($item as $product=>$prijs){
            $menukaart .= '<tr>';
                $menukaart .= '<td>' .$product. '</td>';
                $menukaart .= '<td>' .$prijs. '</td>';
            $menukaart .= '</tr>';
        }
    $menukaart .= '</table>';
//     }
//   }   
// } else {
//   foreach($menu as $categorie => $item){
//     $menukaart .= '<h2>' .$categorie. '</h2>';
//     $menukaart .= '<table border = "1">';
//         foreach($item as $product=>$prijs){
//             $menukaart .= '<tr>';
//                 $menukaart .= '<td>' .$product. '</td>';
//                 $menukaart .= '<td>' .$prijs. '</td>';
//             $menukaart .= '</tr>';
//         }
//     $menukaart .= '</table>';
  }
}


// foreach ($menu as $categorie=>$item){
//     echo $categorie . '<br />'
//         foreach ($item as $product=>$prijs){
//             echo $product . ' kost ' . $prijs . "<br />";
//         }
//     }
// }

?>

<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <title>Restaurantmenu</title>
  </head>

  <header>
    <h1>Menukaart</h1>
  </header>

  <body>
    <form action="soort" method="get"></form>
    <?= $menukaart ?>
  </body>
</html>

