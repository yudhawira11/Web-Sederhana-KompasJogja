<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admin") {
    // Jika pengguna tidak login atau bukan admin, arahkan ke halaman login
    header("Location: ../index.php?error=unauthorized_access");
    exit;
}

// mengambil file koneksi.php
include_once("../koneksi.php");

// mengambil id dari url
$id = $_GET['id'];

// Syntax untuk menghapus data berdasarkan id
$result = mysqli_query($con, "DELETE FROM berita WHERE id_berita='$id'");

// Setelah berhasil dihapus redirect ke beranda admin
header("Location:beranda_admin.php");
?>