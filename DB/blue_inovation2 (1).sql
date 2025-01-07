-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2025 at 10:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blue_inovation2`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `id` int(11) NOT NULL,
  `url_linkedin` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `cv` varchar(200) NOT NULL,
  `jk` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_lowongan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id`, `url_linkedin`, `alamat`, `cv`, `jk`, `id_user`, `id_lowongan`) VALUES
(29, 'test', 'et', 'Cuplikan layar 2024-05-14 112903.png', 'L', 117, 34),
(30, 'a', 'a', 'Cuplikan layar 2024-05-14 112903.png', 'L', 118, 34),
(31, 'a', 'a', 'Cuplikan layar 2024-05-14 093640.png', 'P', 119, 33),
(32, 'zza', 'aa', 'Cuplikan layar 2024-10-11 132210.png', 'L', 120, 34),
(33, 'sss', 'aa', 'WhatsApp Image 2024-12-17 at 06.47.52.jpeg', 'L', 38, 34),
(34, 's', '1', 'WhatsApp Image 2024-12-17 at 06.47.52.jpeg', 'L', 121, 34),
(38, 'ss', 'aa', 'LPMI Poster.jpg', 'L', 124, NULL),
(39, 'link', 'bandung', 'LPMI Poster.jpg', 'L', 125, 34),
(40, 'link', 'test', 'manpro.drawio.png', 'L', 126, 33),
(41, 'asasa', 'asa', 'Cuplikan layar 2024-10-11 082414.png', 'L', 127, 34);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL,
  `kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_user`, `id_ujian`, `jawaban`, `kategori`) VALUES
(360, 117, 1, 'B', 34),
(361, 117, 2, 'C', 34),
(362, 117, 3, 'A', 34),
(363, 117, 4, 'D', 34),
(364, 117, 5, 'B', 34),
(365, 117, 6, 'B', 34),
(366, 117, 7, 'B', 34),
(367, 117, 8, 'B', 34),
(368, 117, 9, 'C', 34),
(369, 117, 10, 'B', 34),
(370, 121, 1, 'A', 34),
(371, 121, 2, 'B', 34),
(372, 121, 3, 'B', 34),
(373, 121, 4, 'A', 34),
(374, 121, 5, 'A', 34),
(375, 121, 6, 'C', 34),
(376, 121, 7, 'B', 34),
(377, 121, 8, 'C', 34),
(378, 121, 9, 'B', 34),
(379, 121, 10, 'A', 34),
(380, 125, 1, 'A', 34),
(381, 125, 2, 'C', 34),
(382, 125, 3, 'C', 34),
(383, 125, 4, 'D', 34),
(384, 125, 5, 'C', 34),
(385, 125, 6, 'A', 34),
(386, 125, 7, 'C', 34),
(387, 125, 8, 'C', 34),
(388, 125, 9, 'D', 34),
(389, 125, 10, 'A', 34),
(390, 126, 1, 'B', 33),
(391, 126, 2, 'C', 33),
(392, 126, 3, 'B', 33),
(393, 126, 4, 'A', 33),
(394, 126, 5, 'A', 33),
(395, 126, 6, 'A', 33),
(396, 126, 7, 'A', 33),
(397, 126, 8, 'C', 33),
(398, 126, 9, 'B', 33),
(399, 126, 10, 'B', 33);

--
-- Triggers `jawaban`
--
DELIMITER $$
CREATE TRIGGER `after_insert_jawaban` AFTER INSERT ON `jawaban` FOR EACH ROW BEGIN
    DECLARE total_jawaban INT;
    DECLARE existing_entry INT;
    
    -- Hitung total jawaban yang sudah di-submit oleh user untuk ujian tertentu
    SELECT COUNT(*) INTO total_jawaban
    FROM jawaban
    WHERE id_user = NEW.id_user AND id_ujian = NEW.id_ujian;
    
    -- Periksa apakah entri sudah ada di tabel ujian_selesai
    SELECT COUNT(*) INTO existing_entry
    FROM ujian_selesai
    WHERE id_user = NEW.id_user AND kategori = NEW.kategori;
    
    -- Jika total jawaban sudah mencapai jumlah soal dan entri belum ada, maka insert ke tabel ujian_selesai
    IF total_jawaban = (SELECT COUNT(*) FROM ujian WHERE id_ujian = NEW.id_ujian) AND existing_entry = 0 THEN
        INSERT INTO ujian_selesai (id_user, kategori)
        VALUES (NEW.id_user, NEW.kategori);
        
		-- Update status_role di tabel user
        UPDATE user
        SET status_role = 'tunggu_test'
        WHERE id_user = NEW.id_user;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `bukti_kegiatan` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama_kegiatan`, `tanggal`, `deskripsi`, `bukti_kegiatan`, `id_user`) VALUES
(1, 'aaa', '2024-06-28', 'aaa', 'Cuplikan layar 2024-05-14 093640.png', 117),
(2, 'a', '2024-06-11', 'a', 'Cuplikan layar 2024-05-14 112903.png', 117);

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE `lowongan` (
  `id_lowongan` int(11) NOT NULL,
  `nama_lowongan` varchar(50) NOT NULL,
  `kategori_lowongan` varchar(50) NOT NULL,
  `waktu_lowongan` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `quota` int(11) NOT NULL,
  `deskripsi` varchar(150) NOT NULL,
  `img` varchar(400) NOT NULL,
  `gaji` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`id_lowongan`, `nama_lowongan`, `kategori_lowongan`, `waktu_lowongan`, `alamat`, `quota`, `deskripsi`, `img`, `gaji`) VALUES
(33, 'Front-end developer', 'Start up', '1 juni 2024', 'Bandung', 5, 'menguasi react, vue dll', 'Full Stack vs Front End vs Back End Developer.jpg', '3000000'),
(34, 'Back-end developer', 'Start up', '1 juni 2024', 'Bandung', 5, 'Menguasi PHP native dan laravel', 'Everything to Know about the Front End Web Development in 2021.jpg', '5000000'),
(35, 'Dev Ops', 'Start up', '3 Juni 2024', 'Bandung', 3, 'Menguasi jaringan', 'DEVSECOPS.jpg', '5000000');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id_pengajuan`, `id_lowongan`, `id_user`) VALUES
(190, 34, 117),
(193, 34, 120),
(196, 34, 121),
(199, 34, 125),
(200, 33, 126),
(201, 34, 127);

--
-- Triggers `pengajuan`
--
DELIMITER $$
CREATE TRIGGER `update_biodata_after_insert_pengajuan` AFTER INSERT ON `pengajuan` FOR EACH ROW BEGIN
    UPDATE biodata
    SET id_lowongan = NEW.id_lowongan
    WHERE id_user = NEW.id_user;
    
     UPDATE user
    SET status_role = 'seleksi_berkas'
    WHERE id_user = NEW.id_user;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `performa`
--

CREATE TABLE `performa` (
  `id` int(11) NOT NULL,
  `kualitas_kerja` int(11) NOT NULL,
  `kuantitas_kerja` int(11) NOT NULL,
  `kompetensi_teknis` int(11) NOT NULL,
  `sikap_perilaku` int(11) NOT NULL,
  `komunikasi` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `pesan` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `pesan_user` text DEFAULT NULL,
  `pesan_admin` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_user`, `pesan_user`, `pesan_admin`) VALUES
(23, 117, 'aa', 'aa'),
(24, 124, 'Halo, kapan yak infomasi selanjutnya', 'Besok');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_answer` char(1) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `category`) VALUES
(1, 'Apa ibu kota dari negara Jepang?', 'Bandung', 'Jakarta', 'Makassar', 'Bali', 'B', 'Pengetahuan Umum Negara'),
(2, 'Siapa penulis dari novel \"Harry Potter\"?', 'J.R.R. Tolkien', 'J.K. Rowling', 'George R.R. Martin', 'C.S. Lewis', 'B', 'Pengetahuan Umum'),
(3, 'Anda menerima email dari klien yang marah karena keterlambatan pengiriman produk. Bagaimana Anda akan merespon email tersebut?', 'Abaikan emailnya karena klien akan tenang dengan sendirinya', 'Balas email dengan alasan mengapa produk terlambat', 'Balas email dengan meminta maaf dan menawarkan solusi untuk masalah tersebut', 'Hapus email tersebut', 'C', 'Keterampilan Komunikasi'),
(4, 'Jika Anda memiliki 5 apel dan Anda memberikan 2 apel kepada teman Anda, berapa banyak apel yang Anda miliki sekarang?', '2', '3', '4', '5', 'B', 'Pemecahan Masalah'),
(5, 'Dalam sebuah proyek, Anda menemukan bahwa salah satu anggota tim tidak bekerja sesuai dengan harapan. Apa yang akan Anda lakukan?', 'Biarkan saja dan berharap mereka akan memperbaiki diri', 'Laporkan langsung kepada atasan tanpa memberitahu anggota tim tersebut', 'Bicarakan secara pribadi dengan anggota tim tersebut untuk mencari solusi bersama', 'Keluarkan anggota tim tersebut dari proyek', 'C', 'Pemecahan Masalah'),
(6, 'Berapa hasil dari 10 + 8 x 2?', '23', '26', '22', '31', 'B', 'Matematika Dasar'),
(7, 'Jika semua A adalah B dan semua B adalah C, maka:', 'Semua C adalah A', 'Semua A adalah C', 'Semua C adalah B', 'Tidak ada yang benar', 'B', 'Logika dan Penalaran'),
(8, 'Anda memiliki dua ember: satu berkapasitas 3 liter dan satu lagi berkapasitas 5 liter. Bagaimana cara Anda mengukur tepat 4 liter air menggunakan kedua ember tersebut?', 'Isi ember 5 liter penuh, lalu tuangkan ke ember 3 liter hingga penuh, kemudian buang air dari ember 3 liter, lalu tuangkan sisa air dari ember 5 liter ke ember 3 liter.', 'Isi ember 3 liter penuh, lalu tuangkan ke ember 5 liter hingga penuh, kemudian buang air dari ember 5 liter, lalu tuangkan sisa air dari ember 3 liter ke ember 5 liter.', 'Isi ember 5 liter penuh, lalu tuangkan ke ember 3 liter hingga penuh, kemudian buang air dari ember 3 liter, lalu tuangkan sisa air dari ember 3 liter ke ember 5 liter.', 'Isi ember 3 liter penuh, lalu tuangkan ke ember 5 liter hingga penuh, kemudian buang air dari ember 5 liter, lalu tuangkan sisa air dari ember 5 liter ke ember 3 liter.', 'A', 'Logika dan Penalaran'),
(9, 'Apa yang memotivasi Anda dalam bekerja?', 'Gaji dan tunjangan', 'Pengakuan dan apresiasi', 'Kesempatan untuk belajar dan berkembang', 'Lingkungan kerja yang menyenangkan', 'C', 'Kepribadian dan Situasional'),
(10, 'Dalam situasi di mana Anda harus bekerja di bawah tekanan dan tenggat waktu yang ketat, bagaimana Anda akan mengelola waktu Anda?', 'Menunda pekerjaan hingga tenggat waktu mendekat', 'Membuat daftar prioritas dan menyelesaikan tugas yang paling penting terlebih dahulu', 'Meminta bantuan rekan kerja untuk menyelesaikan tugas', 'Mengeluh kepada atasan tentang beban kerja', 'B', 'Kepribadian dan Situasional');

-- --------------------------------------------------------

--
-- Table structure for table `ujian_selesai`
--

CREATE TABLE `ujian_selesai` (
  `id_ujian_selesai` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `waktu_selesai` timestamp NOT NULL DEFAULT current_timestamp(),
  `statuss` varchar(50) DEFAULT 'Belum Diperiksa',
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `ujian_selesai`
--
DELIMITER $$
CREATE TRIGGER `after_ujian_selesai_delete` AFTER DELETE ON `ujian_selesai` FOR EACH ROW BEGIN
    -- Cek apakah status_role saat ini adalah 'gagal_seleksi'
    -- Jika tidak, maka update status_role menjadi 'wawancara'
    IF (SELECT status_role FROM user WHERE id_user = OLD.id_user) != 'gagal_seleksi' THEN
        UPDATE user
        SET status_role = 'wawancara'
        WHERE id_user = OLD.id_user;
    END IF;

    -- Update quota pada lowongan
    UPDATE lowongan
    SET quota = quota - 1
    WHERE id_lowongan = OLD.kategori;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `level` enum('Admin','Member') NOT NULL,
  `status_role` varchar(50) NOT NULL,
  `domisili` varchar(100) NOT NULL DEFAULT '',
  `usia` char(3) NOT NULL DEFAULT '',
  `negara` varchar(100) NOT NULL DEFAULT '',
  `kontak` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `tanggal_wawancara` varchar(100) NOT NULL DEFAULT 'Belum Ditentukan',
  `link_wawancara` varchar(100) NOT NULL DEFAULT 'Belum Ditentukan',
  `dari_tanggal` varchar(40) NOT NULL,
  `sampai_tanggal` varchar(40) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `password`, `nama_lengkap`, `level`, `status_role`, `domisili`, `usia`, `negara`, `kontak`, `email`, `tanggal_wawancara`, `link_wawancara`, `dari_tanggal`, `sampai_tanggal`, `link`) VALUES
(38, 'admin', 'admin123', 'admin', 'Admin', 'gagal_seleksi', '', '', '', '', '', 'Belum Ditentukan', 'Belum Ditentukan', 'Admin', 'Admin', 'Admin'),
(86, 'valent', '123', 'valentino', 'Admin', 'Admin', '', '', '', '', '', 'Belum Ditentukan', 'Belum Ditentukan', 'Admin', 'Admin', 'Admin\r\n'),
(116, 'nicholas', 'Nich123', 'aldrdigenm', 'Admin', 'Admin', '', '', '', '', '', 'Belum Ditentukan', 'Belum Ditentukan', 'Admin', 'Admin', 'Admin'),
(117, 'jovanka', 'jovanka123', 'jovanka al', 'Member', 'wawancara', '', '', '', '', '', '10 januari 2024', '10 januari 2025', 'belum di tentukan', 'belum di tentukan', 'kosong'),
(118, 'aa', 'jopan123', 'aa', 'Member', 'ikut_tes', '', '', '', '', '', 'Belum Ditentukan', 'Belum Ditentukan', 'belum di tentukan', 'belum di tentukan', 'kosong'),
(119, 'nadil', 'nadil123', 'nadilla', 'Member', 'ikut_tes', '', '', '', '', '', 'Belum Ditentukan', 'Belum Ditentukan', 'belum di tentukan', 'belum di tentukan', 'kosong'),
(120, 'firli', 'firli1123', 'firli rucita', 'Member', 'seleksi_berkas', '', '', '', '', '', 'Belum Ditentukan', 'Belum Ditentukan', 'belum di tentukan', 'belum di tentukan', 'kosong'),
(121, 'alex', 'alex123', 'alexandro', 'Member', 'sukses', '', '', '', '', '', '2 desmber', 'ini link', '2 desember 2025', '2 desember 2025', 'kosong'),
(122, 'aaa', 'aa1231', 'aaa', 'Member', 'belum_mengajukan', '', '', '', '', '', 'Belum Ditentukan', 'Belum Ditentukan', 'belum di tentukan', 'belum di tentukan', 'kosong'),
(124, 'lea', 'cendelea123', 'cendela', 'Member', 'seleksi_berkas', '', '', '', '', '', 'Belum Ditentukan', 'Belum Ditentukan', 'belum di tentukan', 'belum di tentukan', 'kosong'),
(125, 'lexia', 'lexia123', 'lexia all', 'Member', 'sukses', '', '', '', '', '', 'Belum Ditentukan', 'Belum Ditentukan', '1 january 2025', '1 january 2026', 'kosong'),
(126, 'rpl', 'rplupi123', 'Rpl Upi 2025', 'Member', 'sukses', '', '', '', '', '', 'Belum Ditentukan', 'Belum Ditentukan', 'belum di tentukan', 'belum di tentukan', 'kosong'),
(127, 'upi', 'upi123', 'upi bandung', 'Member', 'seleksi_berkas', '', '', '', '', '', 'Belum Ditentukan', 'Belum Ditentukan', 'belum di tentukan', 'belum di tentukan', 'kosong');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `after_status_role_update_performa` AFTER UPDATE ON `user` FOR EACH ROW BEGIN
    -- Cek apakah status_role berubah dari 'proses' ke status lain
    IF OLD.status_role = 'proses' AND NEW.status_role != 'proses' THEN
        -- Hapus data dari tabel performa berdasarkan id_user
        DELETE FROM performa WHERE id_user = NEW.id_user;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_performa_after_status_change` AFTER UPDATE ON `user` FOR EACH ROW BEGIN
    IF NEW.status_role = 'proses' AND OLD.status_role != 'proses' THEN
        INSERT INTO performa (id_user, kualitas_kerja, kuantitas_kerja, kompetensi_teknis, sikap_perilaku, komunikasi, tahun, pesan)
        VALUES (NEW.id_user, '', '', '', '', '', YEAR(CURDATE()), '');
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `fk_id_lowongan` (`id_lowongan`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `fk_kategori` (`kategori`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id_lowongan`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_perusahaan` (`id_lowongan`);

--
-- Indexes for table `performa`
--
ALTER TABLE `performa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_performa` (`id_user`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indexes for table `ujian_selesai`
--
ALTER TABLE `ujian_selesai`
  ADD PRIMARY KEY (`id_ujian_selesai`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kategori` (`kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata`
--
ALTER TABLE `biodata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id_lowongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `performa`
--
ALTER TABLE `performa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ujian_selesai`
--
ALTER TABLE `ujian_selesai`
  MODIFY `id_ujian_selesai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `biodata`
--
ALTER TABLE `biodata`
  ADD CONSTRAINT `biodata_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_lowongan` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan` (`id_lowongan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`kategori`) REFERENCES `lowongan` (`id_lowongan`),
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`);

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pengajuan_ibfk_2` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan` (`id_lowongan`);

--
-- Constraints for table `performa`
--
ALTER TABLE `performa`
  ADD CONSTRAINT `fk_user_performa` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `pesan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `ujian_selesai`
--
ALTER TABLE `ujian_selesai`
  ADD CONSTRAINT `ujian_selesai_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `ujian_selesai_ibfk_2` FOREIGN KEY (`kategori`) REFERENCES `lowongan` (`id_lowongan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
