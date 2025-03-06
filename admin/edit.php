<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admin") {
    // Jika pengguna tidak login atau bukan admin, arahkan ke halaman login
    header("Location: ../index.php?error=unauthorized_access");
    exit;
}

include_once("../koneksi.php");

if (isset($_POST['update'])) {
    $id_berita = $_POST['id_berita'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $lokasi = $_POST['lokasi'];
    $penulis = $_POST['penulis'];
    $waktu = $_POST['waktu'];

    $stmt = $con->prepare("UPDATE berita SET judul=?, deskripsi=?, lokasi=?, penulis=?, waktu=? WHERE id_berita=?");
    $stmt->bind_param("sssssi", $judul, $deskripsi, $lokasi, $penulis, $waktu, $id_berita);
    $stmt->execute();
    $stmt->close();
    header("Location: beranda_admin.php");
}

if (!isset($_GET['id'])) {
    header("Location: beranda_admin.php");
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM berita WHERE id_berita='$id'");
while ($user_data = mysqli_fetch_array($result)) {
    $id_berita = $user_data['id_berita'];
    $judul = $user_data['judul'];
    $deskripsi = $user_data['deskripsi'];
    $lokasi = $user_data['lokasi'];
    $penulis = $user_data['penulis'];
    $waktu = $user_data['waktu'];
}
?>

<html>
<head>
    <title>Edit Data Berita</title>
</head>
<body>
    <br>
    <a href="beranda_admin.php">Kembali</a>
    <br /><br />

    <form name="update_berita" method="post" action="edit.php">
        <table border="0">
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judul" value="<?php echo $judul; ?>"></td>
            </tr>

            <tr>
                <td><label for="deskripsi">Deskripsi</label></td>
                <td><textarea name="deskripsi"><?php echo $deskripsi; ?></textarea></td>
            </tr>

            <tr>
                <td>Lokasi</td>
                <td><input type="text" name="lokasi" value="<?php echo $lokasi; ?>"></td>
            </tr>

            <tr>
                <td>Penulis</td>
                <td><input type="text" name="penulis" value="<?php echo $penulis; ?>"></td>
            </tr>

            <tr>
                <td>Waktu</td>
                <td><input type="date" name="waktu" value="<?php echo $waktu; ?>"></td>
            </tr>

            <tr>
                <td><input type="hidden" name="id_berita" value="<?php echo $id_berita; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>