<?php
session_start();
include "koneksi.php";
$id_user = $_POST['id_user'];
$pass = md5($_POST['password']);
$sql = "SELECT * FROM user WHERE id_user='$id_user' AND password='$pass'";

if ($_POST["captcha_code"] == $_SESSION["captcha_code"]) {
    $login = mysqli_query($con, $sql);
    $ketemu = mysqli_num_rows($login);
    $r = mysqli_fetch_array($login);

    if ($ketemu > 0) {
        $_SESSION["login"] = true;
        $_SESSION['iduser'] = $r['id_user'];
        $_SESSION['passuser'] = $r['password'];
        $_SESSION['role'] = $r['role'];

        // Redirect berdasarkan role
        if ($r['role'] === 'admin') {
            header("Location: admin/beranda_admin.php");
        } elseif ($r['role'] === 'user') {
            header("Location: user/beranda_user.php");
        } else {
            echo "<center>Login gagal! Role tidak dikenali.<br>";
            echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
        }
        exit();
    } else {
        echo "<center>Login gagal! Username & password tidak benar.<br>";
        echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
    }
    mysqli_close($con);
}else {
    echo "<center>Login gagal! Captcha tidak sesuai.<br>";
    echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
}
?>
