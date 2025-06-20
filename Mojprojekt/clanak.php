<?php
$konekcija = mysqli_connect("localhost", "root", "", "baza") or die('Greška pri spajanju na bazu');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $upit = "SELECT * FROM projekt WHERE id = $id";
    $clanak = mysqli_query($konekcija, $upit);

    if ($clanak && $red = mysqli_fetch_assoc($clanak)) {
        echo "<!DOCTYPE html>
<html>
    <head>
        <link rel=\"stylesheet\" href=\"style.css\">
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <meta name=\"author\" content=\"Zvonimir Rajačić\" />
        <meta name=\"description\" content=\"clanak stranica\" />
        <title>vijesti</title>
    </head>
    <body>
        <header>
            <!-- Navigacija -->
            <nav id=\"navPojedinacno\">
                <ul>
                    <li class=\"navigacija\"><img id=\"bbc\" src=\"slike/bbc.png\"></li>
                    <li class=\"navigacija\"><a href=\"pindex.php\">Početna</a></li>
                    <li class=\"navigacija\"><a href=\"politika.php\">Politika</a></li>
                    <li class=\"navigacija\"><a href=\"sport.php\">Sport</a></li>
                    <li class=\"navigacija\"><a href=\"unos.html\">Unos</a></li>
                    <li class=\"navigacija\"><a href=\"Prijava.html\">Administracija</a></li>
                </ul>
            </nav>
        </header>
            <!--glavni dio stranice-->
            <div id=\"prviPojedinacno\"> 

                <h2 id=\"naslovPojedinacno\">".$red['kategorija']."</h2>          
            </div>
        <article>

        
            <br>
            <section class=\"sadrzajpojedinacno\" >
                <h2 class=\"tekstpojedinacno\">".$red['naslov']."</h2>
                <p class=\"tekstpojedinacno\"><img id=\"slikaPojedinacno\" src=\"prikaziSliku.php?id=".$red['id']."\" alt=\"Slika iz baze\"></p>
                 <p class=\"tekstpojedinacno\"><b>".$red['kratki']."</b></p>
    
            <p class=\"tekstpojedinacno\">".$red['sadrzaj']."</p>
              
            </section>
       
        
            
        </article>
       
  

       

<!--Zaglavlje-->
        <footer id=\"footerPojedinacno\">
            <div id=\"zaglavljePojedinacno\">
                <br>
                <hr id=\"zlinija\">
                <h4>Zvonimir Rajačić, 2025.</h4>
                <br>
            </div>
        </footer>
    </body>
</html>
                
                ";
    } else 
    {
        echo "Članak nije pronađen.";
    }
} else 
{
     echo "Pogreška u id-u.";
}

mysqli_close($konekcija);

?>