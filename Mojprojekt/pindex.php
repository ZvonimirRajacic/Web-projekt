<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Zvonimir Rajačić" />
        <meta name="description" content="index stranica" />
        <title>index</title>
    </head>
    <body>
        <header>
            <!-- Navigacija -->
            <nav>
                <ul>
                    <li class="navigacija"><img id="bbc" src="slike/bbc.png"></li>
                    <li class="navigacija"><a href="pindex.php">Početna</a></li>
                    <li class="navigacija"><a href="politika.php">Politika</a></li>
                    <li class="navigacija"><a href="sport.php">Sport</a></li>
                    <li class="navigacija"><a href="unos.html">Unos</a></li>
                    <li class="navigacija"><a href="Prijava.html">Administracija</a></li>
                </ul>
            </nav>
        </header>
            <!--glavni dio stranice-->
   
        <div id="prvi"> 

            <h2 class="pNaslovi">Početna stranica</h2>          
            <h3 class="pNaslovi"> 
                <?php
                
                    $dani = ['nedjelja', 'ponedjeljak', 'utorak', 'srijeda', 'četvrtak', 'petak', 'subota'];
                    $mjeseci = [
                                1 => 'siječnja', 'veljače', 'ožujka', 'travnja', 'svibnja', 'lipnja',
                                'srpnja', 'kolovoza', 'rujna', 'listopada', 'studenoga', 'prosinca'
                            ];

                    $timestamp = time(); // trenutni timestamp
                    $dan = $dani[date('w', $timestamp)];
                    $datum = date('j', $timestamp);
                    $mjesec = $mjeseci[date('n', $timestamp)];

                    echo "$dan, $datum. $mjesec";


                ?>
            </h3>    
        </div>
        <article>

            <h2 class="pNaslovi"><span class="linija"></span>Politika</h2>
            <br>
            <?php
            $pomagalo=0;
            $zatvoreno=false;
            $konekcija = mysqli_connect("localhost", "root","", "baza") or die('Greška pri spajanju na bazu');
            $naredba= "SELECT * FROM projekt WHERE kategorija='politika' and arhiva=0";
            $podaci=mysqli_query($konekcija, $naredba);
            while ($red = mysqli_fetch_array($podaci))
            {
                if($pomagalo==3) $pomagalo=0;
                else 
                {
                  if($pomagalo==0)
                  {
                    echo "<section class=\"sadrzaj\">";
                    echo " <a class=\"clanci\" href=\"clanak.php?id=" . $red['id'] . "\"><p class=\"lijevo\"><img class=\"slika\" src=\"prikaziSliku.php?id=".$red['id']."\" alt=\"Slika iz baze\"><br> <b>".$red['naslov']."</b><br>".$red['kratki']."</p></a>";
                    $zatvoreno=false;
                } 
                  if($pomagalo==1) echo "<a class=\"clanci\" href=\"clanak.php?id=" . $red['id'] . "\"> <p class=\"sredina\"><img class=\"slika\" src=\"prikaziSliku.php?id=".$red['id']."\" alt=\"Slika iz baze\"><br> <b>".$red['naslov']."</b><br>".$red['kratki']."</p></a>"; $zatvoreno=false;
                  if($pomagalo==2)
                  {
                    echo "<a class=\"clanci\" href=\"clanak.php?id=" . $red['id'] . "\"> <p class=\"desno\"><img class=\"slika\" src=\"prikaziSliku.php?id=".$red['id']."\" alt=\"Slika iz baze\"><br> <b>".$red['naslov']."</b><br>".$red['kratki']."</p></a>";
                    echo "</section><br>";
                     $zatvoreno=true;
                  }
                  $pomagalo++;
                }
            }if($pomagalo<3) echo "</section><br>";
                   
            if($zatvoreno==false) echo "</section><br>";
            ?>


            <br><br>
            <h2 class="pNaslovi"><span class="linija"></span>Sport</h2>
            <br>
            <?php
            $pomagalo=0;
            $konekcija = mysqli_connect("localhost", "root","", "baza") or die('Greška pri spajanju na bazu');
            $naredba= "SELECT * FROM projekt WHERE kategorija='sport' and arhiva=0";
            $podaci=mysqli_query($konekcija, $naredba);
            while ($red = mysqli_fetch_array($podaci))
            {
                if($pomagalo==3) $pomagalo=0;
                else 
                {
                  if($pomagalo==0)
                  {
                    echo "<section class=\"sadrzaj\">";
                    echo "<a class=\"clanci\" href=\"clanak.php?id=" . $red['id'] . "\"> <p class=\"lijevo\"><img class=\"slika\" src=\"prikaziSliku.php?id=".$red['id']."\" alt=\"Slika iz baze\"><br> <b>".$red['naslov']."</b><br>".$red['kratki']."</p></a>";
                    $zatvoreno=false;  
                } 
                  if($pomagalo==1) echo " <a class=\"clanci\" href=\"clanak.php?id=" . $red['id'] . "\"><p class=\"sredina\"><img class=\"slika\" src=\"prikaziSliku.php?id=".$red['id']."\" alt=\"Slika iz baze\"><br> <b>".$red['naslov']."</b><br>".$red['kratki']."</p></a>"; $zatvoreno=false;
                  if($pomagalo==2)
                  {
                    echo "<a class=\"clanci\" href=\"clanak.php?id=" . $red['id'] . "\"> <p class=\"desno\"><img class=\"slika\" src=\"prikaziSliku.php?id=".$red['id']."\" alt=\"Slika iz baze\"><br> <b>".$red['naslov']."</b><br>".$red['kratki']."</p></a>";
                    echo "</section><br>";
                     $zatvoreno=true;
                  }
                  $pomagalo++;
                }
            }if($pomagalo<3) echo "</section><br>";
            if($zatvoreno==false) echo "</section><br>";
            ?>

        </article>

    

       

<!--Zaglavlje-->
        <footer id="footerglavni">
            <div id="zaglavlje">
                <br>
                <hr id="zlinija">
                <h4>Zvonimir Rajačić, 2025.</h4>
                <br>
            </div>
        </footer>
    </body>
</html>