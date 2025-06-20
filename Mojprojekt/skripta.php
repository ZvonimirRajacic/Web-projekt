<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naslov = $_POST['naslov'];
    $kratki=$_POST['kratki'];
    $sadrzaj=$_POST['sadrzaj'];    
    $kategorija=$_POST['kategorija'];
    if (isset($_POST['arhiva'])) {
    $arhiva = 1;
} else {
    $arhiva = 0;
}


    

    echo "<!DOCTYPE html>
<html>
    <head>
        <link rel=\"stylesheet\" href=\"style.css\">
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <meta name=\"author\" content=\"Zvonimir Rajačić\" />
        <meta name=\"description\" content=\"vijesti stranica\" />
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

                <h2 id=\"naslovPojedinacno\">$kategorija</h2>          
            </div>
        <article>

        
            <br>
            <section class=\"sadrzajpojedinacno\" >
                <h2 class=\"tekstpojedinacno\">$naslov</h2>";
     if(isset($_FILES['slika']) && $_FILES['slika']['error']=== UPLOAD_ERR_OK)
    {       
    $putanja = $_FILES['slika']['tmp_name'];
    $ekstenzija=$_FILES['slika']['type'];
    $sadrzajSlike = file_get_contents($putanja);
    $slikaZaBazu = addslashes(file_get_contents($_FILES['slika']['tmp_name']));
    $base64 = base64_encode($sadrzajSlike);
    echo "<p class=\"tekstpojedinacno\"><img id=\"slikapojedinacno\" src='data:$ekstenzija;base64,$base64' alt='Prenesena slika'></p>";
    }
            
    echo"   <p class=\"tekstpojedinacno\"><b>$kratki</b></p>
    
            <p class=\"tekstpojedinacno\">$sadrzaj</p>
              
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
</html>";


$konekcija = mysqli_connect("localhost", "root","", "baza") or die('Greška pri spajanju na bazu');
/*$naredba="INSERT INTO projekt (naslov,kratki,sadrzaj,kategorija,arhiva,slika) VALUES ('$naslov','$kratki','$sadrzaj','$kategorija','$arhiva','$slikaZaBazu')";
mysqli_query($konekcija, $naredba);*/

$naredba = "INSERT INTO projekt (naslov,kratki,sadrzaj,kategorija,arhiva) VALUES (?,?,?, ?, ?)";
$stmt = mysqli_stmt_init($konekcija);
if (mysqli_stmt_prepare($stmt, $naredba)) {
    mysqli_stmt_bind_param($stmt, "sssss", $naslov, $kratki, $sadrzaj, $kategorija, $arhiva);
    mysqli_stmt_execute($stmt);
}
$naredba="UPDATE projekt SET slika = '$slikaZaBazu' WHERE naslov='$naslov' AND kratki='$kratki' AND sadrzaj='$sadrzaj' AND kategorija='$kategorija'";
mysqli_query($konekcija, $naredba);


    }

?>


             