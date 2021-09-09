<html>

<head>
    <title>FORM ENKRIPSI</title>
</head>

<body>
    <form action="enkcaesar.php" method="get">
        <table>
            <tr>
                <td>Plainteks</td>
                <td>:<input type="text" name="kata"></td>
            </tr>
            <tr>
                <td>Key</td>
                <td>:<input type="text" name="key" maxlength="2"></td>
            </tr>
        </table>
        <br>
        <br>
        <input type="submit" value="kirim">
        <input type="reset" value="reset">
    </form>
</body>

</html>