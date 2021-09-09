<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "loginskdp");
$msg = '';
if (isset($_POST['submit'])) {
    $time = time() - 60;
    $ip_address = getIpAddr();
    $check_login_row = mysqli_fetch_assoc(mysqli_query($con, "select count(*) as total_count from log_log where try_time>$time and ip_address='$ip_address'"));
    $total_count = $check_login_row['total_count'];
    if ($total_count == 5) {
        $msg = "To many failed login attempts. Please login after 30 sec";
    } else {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $sql = "select * from tb_login where email='$email' and  password='$password'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res)) {
            $_SESSION['IS_LOGIN'] = 'yes';
            mysqli_query($con, "delete from login_log where ip_address='$ip_address'");
?>
            <script>
                window.location.href = 'https://www.youtube.com/watch?v=_H6gd7vawO0&ab_channel=ProgrammingwithVishal';
            </script>
<?php
        } else {
            $total_count++;
            $rem_attm = 5 - $total_count;
            if ($rem_attm == 0) {
                $msg = "Terlabu Banyak Mencoba, Silahkan tunggu 60 detik";
            } else {
                $msg = "Username/Password salah. tinggal<br/>$rem_attm kali percobaan ";
            }
            $try_time = time();
            mysqli_query($con, "insert into log_log(ip_address,try_time) values('$ip_address','$try_time')");
        }
    }
}

function getIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddr = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ipAddr = $_SERVER['REMOTE_ADDR'];
    }
    return $ipAddr;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <div class="header">
        <div class="container">
            <nav class="navbar navbar-light">
                <div class="container">
                    <a href="https://www.linkedin.com/in/bima-afrizal-malna-12033b145/" class="navbar-brand text-light">Bima Afrizal Malna/V3420018/TI-A</a>
                </div>
            </nav>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="full-card">
                        <div class="card" style="width: 50%;">
                            <div class="card-body">
                                <form action="" method="post">
                                    <h5 class="card-title">Login</h5>
                                    <div class="result"><?php echo $msg ?></div>
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" id="staticEmail">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="password" id="inputPassword">
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>

</body>

</html>