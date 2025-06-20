<?php
$konekcija = mysqli_connect("localhost", "root","", "baza") or die('Greška pri spajanju na bazu');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $korisnicko= $_POST['korisnicko'];
    $lozinka= $_POST['lozinka'];
$naredba="SELECT * from korisnik where korisnicko=? and lozinka=?";

$stmt=mysqli_stmt_init($konekcija);
if(mysqli_stmt_prepare($stmt,$naredba)){
    mysqli_stmt_bind_param($stmt,"ss",$korisnicko, $lozinka);
    mysqli_stmt_execute($stmt);
     mysqli_stmt_store_result($stmt);
}
mysqli_stmt_bind_result($stmt, $id, $k, $l, $a);
mysqli_stmt_fetch($stmt); 

if($a){
    header("Location: administracija.php");
    exit;
}else if( $korisnicko==$k && $lozinka==$l){
    echo "Nemate odgovarajuću dozvolu za ovu stranicu! <a href=\"prijava.html\">NATRAG</a>";
}else {
    echo"Unijeli ste krive podatke! Možete stvoriti korisnički račun ovdje: <a href=\"registracija.html\">REGISTRIRAJ</a>";
}

}



?>