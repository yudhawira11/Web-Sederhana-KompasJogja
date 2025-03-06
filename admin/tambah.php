<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admin") {
    // Jika pengguna tidak login atau bukan admin, arahkan ke halaman login
    header("Location: ../index.php?error=unauthorized_access");
    exit;
}

// Memanggil file koneksi.php
include_once("../koneksi.php");

// Perkondisian untuk mengecek apakah tombol submit sudah ditekan.
if (isset($_POST['Submit'])) {
    // Variable untuk menampung data $_POST yang dikirimkan melalui form.
    $id_berita = $_POST['id_berita'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $lokasi = $_POST['lokasi'];
    $penulis = $_POST['penulis'];
    $waktu = $_POST['waktu'];

    // Syntax untuk menambahkan data ke table berita
    $result = mysqli_query($con, "INSERT INTO berita (id_berita, judul, deskripsi, lokasi, penulis, waktu) VALUES ('$id_berita', '$judul', '$deskripsi', '$lokasi', '$penulis', '$waktu')");

    // Menampilkan pesan jika data berhasil disimpan.
    echo "Data berhasil disimpan. <a href='beranda_admin.php'>Lihat Berita</a>";
    exit();
}
?>

<html>
<head>
    <title>Tambah Berita</title>
</head>
<body>
    <br>
    <a href="beranda_admin.php">Kembali</a>
    <br /><br />

    <form action="tambah.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr>
                <td>Id Berita</td>
                <td><input type="number" name="id_berita"></td>
            </tr>

            <tr>
                <td>Judul</td>
                <td><input type="text" name="judul"></td>
            </tr>

            <tr>
            <td><label for="deskripsi">Deskripsi</label></td>
            <td><textarea name="deskripsi" value=""></textarea></td>
            </tr>

            <tr>
                <td>Lokasi</td>
                <td><input type="text" name="lokasi"></td>
            </tr>

            <tr>
                <td>Penulis</td>
                <td><input type="text" name="penulis"></td>
            </tr>

            <tr>
                <td>Waktu</td>
                <td><input type="date" name="waktu"></td>
            </tr>

            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Tambah"></td>
            </tr>
        </table>
    </form>
</body>
</html>