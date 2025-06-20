<?php
$konekcija = mysqli_connect("localhost", "root", "", "baza") or die('Greška pri spajanju na bazu');

$id = intval($_GET['id']);
$naredba = "SELECT slika FROM projekt WHERE id = ?";
$stmt = mysqli_stmt_init($konekcija);

if (mysqli_stmt_prepare($stmt, $naredba)) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $slika);
        mysqli_stmt_fetch($stmt);

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $tip = $finfo->buffer($slika);

        header("Content-Type: $tip");
        echo $slika;
    } else {
        echo "Slika nije pronađena.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Greška u pripremi upita.";
}

mysqli_close($konekcija);
?>
