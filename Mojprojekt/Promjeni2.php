<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$id = $_POST['id'];
$naslov = $_POST['naslov'];
    $kratki=$_POST['kratki'];
    $sadrzaj=$_POST['sadrzaj'];    
    $kategorija=$_POST['kategorija'];
    $arhiva = isset($_POST['arhiva']) ? 1 : 0;


    if(isset($_FILES['slika']) && $_FILES['slika']['error']=== UPLOAD_ERR_OK)
    {       
    $slikaZaBazu = addslashes(file_get_contents($_FILES['slika']['tmp_name']));
    }


$konekcija = mysqli_connect("localhost", "root","", "baza") or die('Greška pri spajanju na bazu');

$naredba = "UPDATE projekt SET naslov = ?, kratki = ?, sadrzaj = ?, kategorija = ?, arhiva = ?  WHERE id = ?";

$stmt = mysqli_stmt_init($konekcija);
if (mysqli_stmt_prepare($stmt, $naredba)) {
    $null = NULL;
    mysqli_stmt_bind_param($stmt, "sssssi", $naslov, $kratki, $sadrzaj, $kategorija, $arhiva,  $id);
    mysqli_stmt_execute($stmt);
}
$naredba="UPDATE projekt SET slika = '$slikaZaBazu' WHERE id = $id";
mysqli_query($konekcija, $naredba);
header("Location: administracija.php");
exit;
}
?>