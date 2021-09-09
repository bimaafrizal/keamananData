<?php

$conn = mysqli_connect('localhost', 'root', '', 'loginskdp');

function query($query)
{

    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function registrasi($data)
{
    global $conn;

    //mengambil data
    $email = strtolower($data["email"]);
    $password = mysqli_escape_string($conn, $data["password"]);
    $password2 = mysqli_escape_string($conn, $data["password2"]);

    //konfirmasi apakah username sudah dipakai 
    $result = mysqli_query($conn, "SELECT email FROM tb_login where email = '$email");
    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('username sudah terdaftar');  
        </script>
        ";

        return false;
    }

    //konfirmasi password 1 dan 2 sama
    if ($password != $password2) {
        echo "
        <script>
            alert('Password tidak sama');  
        </script>
        ";

        return false;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO tb_user VALUES ('', '$email', '$password')");

        return mysqli_affected_rows($conn);
    }
}
