<?php
$konekcija = mysqli_connect("localhost", "root","", "baza") or die('Greška pri spajanju na bazu');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $korisnicko= $_POST['korisnicko'];
    $lozinka= $_POST['lozinka'];
    $admin = isset($_POST['admin']) ? 1 : 0;
$naredba="INSERT INTO korisnik (korisnicko,lozinka,administrator)
values (?,?,?)";

$stmt=mysqli_stmt_init($konekcija);
if(mysqli_stmt_prepare($stmt,$naredba)){
    mysqli_stmt_bind_param($stmt,"ssi",$korisnicko, $lozinka,$admin);
    mysqli_stmt_execute($stmt);
     mysqli_stmt_store_result($stmt);
}
if($admin){
    header("Location: administracija.php");
    exit;
}else {
    header("Location: pindex.php");
    exit;
}

}



?>