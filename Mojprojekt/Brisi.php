<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['argument'];
    $konekcija = mysqli_connect("localhost", "root","", "baza") or die('Greška pri spajanju na bazu');
    $naredba = "DELETE FROM projekt WHERE id = $id";
    mysqli_query($konekcija, $naredba);
    
header("Location: administracija.php");
exit;

}
?>