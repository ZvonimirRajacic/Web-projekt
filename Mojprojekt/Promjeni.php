<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['argument'];
    $konekcija = mysqli_connect("localhost", "root","", "baza") or die('Greška pri spajanju na bazu');
    $naredba = "SELECT * FROM projekt WHERE id = $id";
    $podaci=mysqli_query($konekcija, $naredba);
    while ($red = mysqli_fetch_array($podaci)){
        $naslov = $red['naslov'];
        $kratki = $red['kratki'];
        $sadrzaj = $red['sadrzaj'];
        $kategorija = $red['kategorija'];
       if(isset($_POST['arhiva'])) $arhiva=$_POST['arhiva'];

    }

echo"<!DOCTYPE html>
<html>
    <head>
        <link rel=\"stylesheet\" href=\"style.css\">
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <meta name=\"author\" content=\"Zvonimir Rajačić\" />
        <meta name=\"description\" content=\"promjena stranica\" />
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
         
        <article>

        
            <br>
            <section class=\"sadrzajpojedinacno\" >
                <h2 id=\"naslovunos\">Promjenite vijest</h2><br><br>

                <form action=\"Promjeni2.php\" method=\"POST\"  enctype=\"multipart/form-data\">
                    <label for=\"naslov\">Naslov vijesti</label><br>
                    <input type=\"text\" name=\"naslov\" value=".$naslov."><br>

                    <input type=\"hidden\" name=\"id\" value=".$id.">
                    <label for=\"kratki\">Kratki sadržaj</label><br>
                    <textarea name=\"kratki\" cols=\"30\" rows=\"10\">".$kratki."</textarea><br>

                    <label for=\"sadrzaj\">Sadržaj vijesti</label><br>
                    <textarea name=\"sadrzaj\" cols=\"30\" rows=\"10\">".$sadrzaj."</textarea><br>

                    <label for=\"slika\">Slika:</label><br>
                    <input type=\"file\" name=\"slika\" accept=\"image/jpg,image/png,image/avif\"><br>
                    <label for=\"kategorija\"></label><br>
                    <select name=\"kategorija\"> 
                        <option value=\"sport\">Sport</option> 
                        <option value=\"politika\">Politika</option> 
                    </select> <br>

                    <label for=\"arhiva\"> Spremiti u arhivu:</label><br>
                    <input type=\"checkbox\" name=\"arhiva\"><br>

                    <button type=\"reset\">Poništi</button>
                    <button type=\"submit\">Pošalji</button>

                </form>
              
            </section>
       
        
            
        </article>

    

       

<!--Zaglavlje-->
        <footer id=\"footerglavni\">
            <div id=\"zaglavlje\">
                <br>
                <hr id=\"zlinija\">
                <h4>Zvonimir Rajačić, 2025.</h4>
                <br>
            </div>
        </footer>
    </body>
</html>";
}

?>