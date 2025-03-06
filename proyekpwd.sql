-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 04:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyekpwd`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `waktu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `deskripsi`, `lokasi`, `penulis`, `waktu`) VALUES
(1, 'Kasus Penyiraman Air Keras', 'Jajaran kepolisian setempat berhasil mengamankan dua pelaku penyiraman air keras terhadap seorang mahasiswi asal Kalimantan Barat bernama Natasya. Kedua pelaku yang ditangkap adalah B alias Billy, yang berasal dari Kalimantan Barat, dan S alias Satim, warga Kuningan, Jawa Barat. Kasatreskrim Polresta Yogyakarta, Kompol Probo Satrio, menjelaskan bahwa Billy dan korban sebelumnya menjalin hubungan pacaran sejak 2021, namun hubungan tersebut berakhir pada Agustus 2024.', 'Yogyakarta', 'yudha', '2024-12-28'),
(2, 'Siswi SMP Dicabuli Ayah Tiri', 'Pelaku sudah ditahan di Polres Gunungkidul Saat ditanya, korban menceritakan aksi pencabulan dari orang yang seharusnya melindunginya itu kepada ibunya. Korban dicabuli saat berbaring dan ketika menggunakan sepeda motor. \"Pelaku mengakui aksi bejatnya itu dikarenakan hawa nafsu yang tidak tertahankan ketika melihat anak tirinya itu,\" ucap Kapolsek.', 'Gunungkidul', 'Yudha', '2024-12-28'),
(3, 'Pelajar Tewas Terseret Arus', 'Seorang pelajar berusia 17 tahun, DPP, tewas setelah terjatuh ke dalam parit yang sedang berair deras akibat menabrak gerobak bakso di Jalan KH Ahmad Dahlan, Kapanewon Wates, Kabupaten Kulon Progo, Daerah Istimewa Yogyakarta (DIY), Selasa (24/12/2024). “Korban (DPP) meninggal dunia sesampainya di IGD RSUD Wates,” ungkap Kanit Gakkum Satlantas Polres Kulon Progo, Ipda Tanto Kurniawan, melalui pesan WhatsApp. Warga Kelurahan Triharjo ini mengalami kecelakaan saat mengendarai sepeda motor Honda Vario hitam dengan nomor polisi AB 2594 VL.', 'Kulon Progo', 'Dani', '2024-12-29'),
(4, 'Kecelakaan Karambol KP', 'Sebuah kecelakaan lalu lintas karambol melibatkan satu truk boks, dua mobil penumpang, dan satu sepeda motor terjadi di jalan Wates-Yogyakarta, tepatnya di Padukuhan Karangan, Kalurahan Sukoreno, Kapanewon Sentolo, Kabupaten Kulon Progo, Daerah Istimewa Yogyakarta, pada Rabu (18/12/2024) pagi.', 'Kulon Progo', 'Bima', '2024-12-26'),
(5, 'Kecelakaan di Wonosari', 'Menurut keterangan Kanit Gakkum Satlantas Polres Gunungkidul, Ipda Winarko, peristiwa tersebut bermula saat SR yang merupakan warga Kalurahan Krambilsawit, Kapanewon Saptosari, mengendarai sepeda motor Yamaha Mio AB 6128 HM. Ia berboncengan dengan JLP (15), warga Kanigoro, Saptosari, melaju dari arah Yogyakarta menuju Wonosari. \"Sesampainya di TKP pada jalan lurus, dari arah belakang melaju sepeda motor yang tidak diketahui identitasnya yang mendahului sepeda motor kami. Pada saat mendahului tersebut diduga terjadi senggolan,\" jelas Winarko saat dihubungi wartawan melalui telepon.', 'Wonosari', 'Hasan', '2024-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `password`, `nama`, `email`, `role`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin web', 'admin@gmail.com', 'admin'),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user aja', 'user@gmail.com', 'user'),
('yudha', '2b9633304de305ed5c03fe19b7a06afe', 'yudha wira dharma', 'yudhajtz@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
