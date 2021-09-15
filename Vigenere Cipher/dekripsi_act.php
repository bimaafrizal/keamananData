<!DOCTYPE html>
<html>

<head>
    <title>enkripsi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <?php
    include "lib/lib.php";
    $hasil_ciper = str_replace(" ", "", $_POST['ciper']);
    $kunci = str_replace(" ", "", $_POST['kunci']);
    $panjang_kunci = strlen($kunci);
    $panjang_ciper = strlen($hasil_ciper);
    $index_x = 0;
    $index_y = 0;
    $hasil_konversi = array();
    $hasil_akhir = "";
    while ($index_x < $panjang_ciper) {
        $x = substr($hasil_ciper, $index_x, 1);
        $y = substr($kunci, $index_y, 1);
        $konversi_x = huruf_ke_angka($x);
        $konversi_y = huruf_ke_angka($y);
        if ($konversi_x >= $konversi_y) {
            $hasil = $konversi_x - $konversi_y;
        } else {
            $hasil = $konversi_x + (26 - $konversi_y);
        }
        $hasil_konversi[$index_x] = angka_ke_huruf($hasil);
        $index_x++;
        $index_y++;
        if ($index_y == $panjang_kunci) {
            $index_y = 0;
        }
    }
    $i = 0;
    $hasil_akhir = "";
    while ($i < $index_x) {
        $hasil_akhir .= $hasil_konversi[$i];
        $i++;
    }
    ?>
    <div class="container">
        <h1>Hasil - Dekripsi</h1>
        <hr>
        <form action="enkripsi_act.php" method="post" data-ajax="false" class="ui-body ui-body-a ui-corner-all">
            <label for="basic">Plainteks :</label>
            <textarea class="form-control" name="plain" id="textarea-a"><?php echo $hasil_akhir; ?></textarea>
            <label for="basic">Masukkan Kunci :</label>
            <textarea class="form-control" name="kunci" id="textarea-a"><?php echo $kunci; ?></textarea><br>
            <input type="submit" class="btn btn-success" value="
Encrypt" data-theme="a">
        </form>
    </div>
</body>

</html>