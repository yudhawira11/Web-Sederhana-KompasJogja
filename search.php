<?php
header('Content-Type: application/json'); // Mengatur header untuk mengembalikan format JSON
$conn = new mysqli('localhost', 'root', '', 'proyekpwd'); // Membuat koneksi ke database

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Menangani kesalahan koneksi
}

$query = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : ''; // Mengambil parameter 'q' dari URL dan membersihkan input
$sql = "SELECT * FROM berita WHERE id_berita LIKE '$query'"; // Membuat query untuk mencari berita
$sql1 = "SELECT * FROM berita WHERE judul LIKE '%$query%'"; // Membuat query untuk mencari berita
$sql2 = "SELECT * FROM berita WHERE deskripsi LIKE '%$query%'"; // Membuat query untuk mencari berita
$sql3 = "SELECT * FROM berita WHERE lokasi LIKE '$query'"; // Membuat query untuk mencari berita
$result = $conn->query($sql); // Menjalankan query
$result1 = $conn->query($sql1); // Menjalankan query
$result2 = $conn->query($sql2); // Menjalankan query
$result3 = $conn->query($sql3); // Menjalankan query
$data = []; // Array untuk menyimpan hasil pencarian

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { // Mengambil setiap baris hasil query
        $data[] = $row; // Menambahkan baris ke array data
    }
}
elseif ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) { // Mengambil setiap baris hasil query
        $data[] = $row; // Menambahkan baris ke array data
    }
}
elseif ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) { // Mengambil setiap baris hasil query
        $data[] = $row; // Menambahkan baris ke array data
    }
}
elseif ($result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) { // Mengambil setiap baris hasil query
        $data[] = $row; // Menambahkan baris ke array data
    }
}

echo json_encode($data); // Mengembalikan hasil pencarian dalam format JSON
$conn->close(); // Menutup koneksi database
?>