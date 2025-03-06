<?php
// Koneksi ke database
$con = mysqli_connect("localhost", "root", "", "proyekpwd");
if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Memanggil library FPDF
require('fpdf/fpdf.php');

// Instance object dan pengaturan halaman PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

// Header PDF
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 7, 'KOMPAS JOGJA', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 7, 'DAFTAR BERITA', 0, 1, 'C');
$pdf->Ln(10);

// Header Kolom Tabel
$pdf->SetFont('Arial', 'B', 10);
$header = ['Judul' => 50, 'Deskripsi' => 130, 'Lokasi' => 50, 'Penulis' => 50];
foreach ($header as $col => $width) {
    $pdf->Cell($width, 7, $col, 1, 0, 'C');
}
$pdf->Ln();

// Fungsi untuk menghitung tinggi sel
function getCellHeight($text, $width, $pdf) {
    $nbLines = $pdf->GetStringWidth($text) / $width;
    $nbLines = ceil($nbLines); // Pembulatan ke atas
    return $nbLines * 6; // Tinggi setiap baris (6 mm)
}

// Isi Data Tabel
$pdf->SetFont('Arial', '', 10);
$berita = mysqli_query($con, "SELECT * FROM berita");
if ($berita && mysqli_num_rows($berita) > 0) {
    while ($row = mysqli_fetch_array($berita)) {
        // Hitung tinggi maksimum sel
        $heights = [];
        $heights[] = getCellHeight($row['judul'], $header['Judul'] - 2, $pdf);
        $heights[] = getCellHeight($row['deskripsi'], $header['Deskripsi'] - 3, $pdf);
        $heights[] = getCellHeight($row['lokasi'], $header['Lokasi'] - 2, $pdf);
        $heights[] = getCellHeight($row['penulis'], $header['Penulis'] - 2, $pdf);
        $maxHeight = max($heights);

        // Cetak kolom tabel
        $pdf->Cell($header['Judul'], $maxHeight, $row['judul'], 1, 0, 'L');
        $x = $pdf->GetX(); // Simpan posisi X
        $y = $pdf->GetY(); // Simpan posisi Y

        $pdf->MultiCell($header['Deskripsi'], 6, $row['deskripsi'], 1, 'L');
        $pdf->SetXY($x + $header['Deskripsi'], $y); // Kembali ke posisi berikutnya

        $pdf->Cell($header['Lokasi'], $maxHeight, $row['lokasi'], 1, 0, 'L');
        $pdf->Cell($header['Penulis'], $maxHeight, $row['penulis'], 1, 1, 'L');
    }
} else {
    $pdf->Cell(0, 7, 'Tidak ada data tersedia.', 1, 1, 'C');
}

// Footer PDF
$pdf->SetY(-15);
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 10, 'Page ' . $pdf->PageNo(), 0, 0, 'C');

// Output file PDF
$pdf->Output();

// Tutup koneksi database
mysqli_close($con);
?>