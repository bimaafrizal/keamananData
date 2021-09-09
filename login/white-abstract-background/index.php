<?php

$conn = mysqli_connect('localhost', 'root', '', 'loginskdp');
$atempt = 0;
if (isset($_POST["login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];
    $atempt = $_POST['hidden'];
    $result = mysqli_query($conn, "SELECT * FROM tb_login WHERE email = '$email' and password=''$password");

    if ($attempt < 6) {
        if ($result) {
            if (mysqli_num_rows($result)) {
                while (mysqli_fetch_array($result)) {
                    echo '<script type="text/javascript">alert(anda berhasil login)</script>';
                }
                header('Location: to/index.php');
            } else {
                $attempt++;
                echo '<script type="text/javascript">alert(Login gagal)</script>';
            }
        }
    }
    if ($atempt == 5) {
        echo '<script type="text/javascript">alert("Percobaan login anda sudah mencapai batas")</script>';
    }
}


?>

<html>

<head>
    <title>Login</title>
</head>

<body>
    <form action="#" method="post">
        <table>
            <?php
            echo "<input type='hidden' name='hidden' value='" . $atempt . "'>";
            ?>
            <tr>
            <tr>
                <td>Email</td>
                <td>:<input type="email" name="email" <?php if ($atempt == 5) { ?> disabled="disabled" <?php } ?>></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:<input type="password" name="password" <?php if ($atempt == 5) { ?> disabled="disabled" <?php } ?>></td>
            </tr>
        </table>
        <br>
        <br>
        <input type="submit" value="login" <?php if ($atempt == 5) { ?> disabled="disabled" <?php } ?>>
    </form>
    <?php if ($atempt == 5) header('Location: alert.php'); ?>
</body>

</html>