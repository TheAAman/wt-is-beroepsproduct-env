<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../img/Icons/vticon.png">
    <title>Vluchtoverzicht</title>
</head>
<body>
    <header>
        <h1>Gelre airport</h1>
    </header>

    <div class="menunavigatie">
        <a href="homeP.html" class="menuitem">Home</a>
        <a href="vluchtenP.html" class="menuitem">Vluchten</a>
        <a href="incheckenP.html" class="menuitem">Inchecken</a>
        <a href="inloggenP.html" class="menuitem">Uitloggen</a>
    </div>

    <main>
        <div class="zoekBalk">
            <form action="vluchtenP.html" method="get">
                <h3>Vluchtnummer:</h3>
                <div class="balkBalk">
                    <input class="zoekbalkBalk" type="number" name="Vluchtnummer" placeholder="Zoeken">
                </div>
                <div class="zoekKnopContainer">
                    <input class="zoekKnop" type="submit" value="Zoeken">
                </div>
            </form>
        </div>

        <div class="Overzicht">
            <table class="tabelOverzicht">
                <tr>
                    <th>Vluchtnummer</th>
                    <th>Bestemming</th>
                    <th>Vertrektijd</th>
                    <th>Passagiers</th>
                    <th>Gewicht</th>
                </tr>
                <tr>
                    <td><a href="vluchtP.html" class="vluchtenLink">28764</a></td>
                    <td><a href="vluchtP.html" class="vluchtenLink">NYC</a></td>
                    <td><a href="vluchtP.html" class="vluchtenLink">2023-10-19 / 07:12:00</a></td>
                    <td>25 / 50</td>
                    <td>800 /1080 kg (max 20 pp) </td>
                </tr>
                <tr>
                    <td>28793</td>
                    <td>AMS</td>
                    <td>2023-10-16 / 14:23:00</td>
                    <td>75 / 150</td>
                    <td>800 /1080 kg (max 20 pp) </td>
                </tr>
                <tr>
                    <td>28761</td>
                    <td>ENS</td>
                    <td>2023-10-11 / 06:46:00</td>
                    <td>75 / 150</td>
                    <td>900 /1080 kg (max 20 pp) </td>
                </tr>
                <tr>
                    <td>28765</td>
                    <td>LUX</td>
                    <td>2023-10-11 / 08:41:00</td>
                    <td>75 / 150</td>
                    <td>60 /1000 kg (max 10 pp) </td>
                </tr>
                <tr>
                    <td>28769</td>
                    <td>AIP</td>
                    <td>2023-10-12 / 14:11:00</td>
                    <td>75 / 150</td>
                    <td>854 /1235 kg (max 32 pp) </td>
                </tr>
                <tr>
                    <td>28770</td>
                    <td>GRQ</td>
                    <td>2023-10-11 / 20:20:00</td>
                    <td>75 / 150</td>
                    <td>132 /765 kg (max 43 pp) </td>
                </tr>
                <tr>
                    <td>28774</td>
                    <td>LEY</td>
                    <td>2023-10-13 / 05:10:00</td>
                    <td>75 / 150</td>
                    <td>312 /876 kg (max 9 pp) </td>
                </tr>
                <tr>
                    <td>28789</td>
                    <td>TEU</td>
                    <td>2023-10-15 / 17:47:00</td>
                    <td>75 / 150</td>
                    <td>132 /1890 kg (max 40 pp) </td>
                </tr>
                <tr>
                    <td>28793</td>
                    <td>AMS</td>
                    <td>2023-10-16 / 14:23:00</td>
                    <td>75 / 150</td>
                    <td>800 /1080 kg (max 20 pp) </td>
                </tr>
                <tr>
                    <td>28779</td>
                    <td>EIN</td>
                    <td>2023-10-14 / 12:33:00</td>
                    <td>75 / 150</td>
                    <td>1200 /1500 kg (max 60 pp) </td>
                </tr>
            </table>           
        </div>
    </main>

    <footer>
        <img src="../img/Icons/han_university.png" alt="Logo van de HAN" title="HAN">
        <a href="../privacy.php">Privacy Policy</a> 
        &copy;2023 GAAF productions
    </footer>
</body>
</html>