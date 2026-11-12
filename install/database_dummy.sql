-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Apr 2026 pada 00.48
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ghcbt`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_jadwal`
--

CREATE TABLE `cbt_jadwal` (
  `jadwal_id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_nama` varchar(255) NOT NULL,
  `jadwal_detail` text,
  `jadwal_begin_time` datetime NOT NULL,
  `jadwal_end_time` datetime NOT NULL,
  `jadwal_duration_time` smallint(10) UNSIGNED NOT NULL,
  `jadwal_score_right` decimal(10,2) NOT NULL DEFAULT '1.00',
  `jadwal_score_wrong` decimal(10,2) NOT NULL DEFAULT '0.00',
  `jadwal_score_unanswered` decimal(10,2) NOT NULL DEFAULT '0.00',
  `jadwal_token` tinyint(1) NOT NULL DEFAULT '0',
  `jadwal_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Draft, 1: Generated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_jadwal_grup`
--

CREATE TABLE `cbt_jadwal_grup` (
  `jg_id` bigint(20) UNSIGNED NOT NULL,
  `jg_jadwal_id` bigint(20) UNSIGNED NOT NULL,
  `jg_grup_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_jadwal_topik`
--

CREATE TABLE `cbt_jadwal_topik` (
  `jt_id` bigint(20) UNSIGNED NOT NULL,
  `jt_jadwal_id` bigint(20) UNSIGNED NOT NULL,
  `jt_topik_id` bigint(20) UNSIGNED NOT NULL,
  `jt_pg` int(11) NOT NULL DEFAULT '0',
  `jt_essay` int(11) NOT NULL DEFAULT '0',
  `jt_isian` int(11) NOT NULL DEFAULT '0',
  `jt_matching` int(11) NOT NULL DEFAULT '0',
  `jt_checklist` int(11) NOT NULL DEFAULT '0',
  `jt_tf` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_jawaban`
--

CREATE TABLE `cbt_jawaban` (
  `jawaban_id` bigint(20) UNSIGNED NOT NULL,
  `jawaban_soal_id` bigint(20) UNSIGNED NOT NULL,
  `jawaban_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `jawaban_benar` tinyint(1) NOT NULL DEFAULT '0',
  `jawaban_aktif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cbt_jawaban`
--

INSERT INTO `cbt_jawaban` (`jawaban_id`, `jawaban_soal_id`, `jawaban_detail`, `jawaban_benar`, `jawaban_aktif`) VALUES
(63, 14, 'Kucing', 1, 1),
(64, 14, 'Ayam', 0, 1),
(65, 14, 'Sapi', 1, 1),
(66, 14, 'Ikan', 0, 1),
(67, 14, 'Kambing', 1, 1),
(68, 15, 'Merah', 1, 1),
(69, 15, 'Biru', 1, 1),
(70, 15, 'Kuning', 1, 1),
(71, 15, 'Hijau', 0, 1),
(72, 15, 'Hitam', 0, 1),
(73, 16, 'Mobil', 1, 1),
(74, 16, 'Kapal', 0, 1),
(75, 16, 'Sepeda', 1, 1),
(76, 16, 'Pesawat', 0, 1),
(77, 16, 'Motor', 1, 1),
(78, 17, '2', 1, 1),
(79, 17, '3', 0, 1),
(80, 17, '4', 1, 1),
(81, 17, '5', 0, 1),
(82, 17, '6', 1, 1),
(83, 18, 'Apel', 1, 1),
(84, 18, 'Wortel', 0, 1),
(85, 18, 'Mangga', 1, 1),
(86, 18, 'Pisang', 1, 1),
(87, 18, 'Jeruk', 1, 1),
(88, 19, 'Kucing', 1, 1),
(89, 19, 'Batu', 0, 1),
(90, 19, 'Pohon', 1, 1),
(91, 19, 'Air', 0, 1),
(92, 19, 'Manusia', 1, 1),
(93, 20, 'Pensil', 1, 1),
(94, 20, 'Pulpen', 1, 1),
(95, 20, 'Meja', 0, 1),
(96, 20, 'Penghapus', 1, 1),
(97, 20, 'Spidol', 1, 1),
(98, 21, 'Lari', 1, 1),
(99, 21, 'Tidur', 0, 1),
(100, 21, 'Berenang', 1, 1),
(101, 21, 'Makan', 0, 1),
(102, 21, 'Sepak bola', 1, 1),
(103, 22, 'Tangan', 1, 1),
(104, 22, 'Kaki', 1, 1),
(105, 22, 'Meja', 0, 1),
(106, 22, 'Mata', 1, 1),
(107, 22, 'Kepala', 1, 1),
(108, 23, 'Senin', 1, 1),
(109, 23, 'Selasa', 1, 1),
(110, 23, 'Januari', 0, 1),
(111, 23, 'Minggu', 1, 1),
(112, 23, 'Rabu', 1, 1),
(113, 24, 'Benar', 1, 1),
(114, 24, 'Salah', 0, 1),
(115, 25, 'Benar', 0, 1),
(116, 25, 'Salah', 1, 1),
(117, 26, 'Benar', 1, 1),
(118, 26, 'Salah', 0, 1),
(119, 27, 'Benar', 0, 1),
(120, 27, 'Salah', 1, 1),
(121, 28, 'Benar', 1, 1),
(122, 28, 'Salah', 0, 1),
(123, 29, 'Benar', 1, 1),
(124, 29, 'Salah', 0, 1),
(125, 30, 'Benar', 0, 1),
(126, 30, 'Salah', 1, 1),
(127, 31, 'Benar', 1, 1),
(128, 31, 'Salah', 0, 1),
(129, 32, 'Benar', 0, 1),
(130, 32, 'Salah', 1, 1),
(131, 33, 'Benar', 1, 1),
(132, 33, 'Salah', 0, 1),
(133, 64, 'Bandung', 0, 1),
(134, 64, 'Jakarta', 1, 1),
(135, 64, 'Surabaya', 0, 1),
(136, 64, 'Medan', 0, 1),
(137, 64, 'Bali', 0, 1),
(138, 65, '6', 0, 1),
(139, 65, '7', 1, 1),
(140, 65, '8', 0, 1),
(141, 65, '9', 0, 1),
(142, 65, '10', 0, 1),
(143, 66, 'Kucing', 0, 1),
(144, 66, 'Burung', 1, 1),
(145, 66, 'Sapi', 0, 1),
(146, 66, 'Kambing', 0, 1),
(147, 66, 'Ikan', 0, 1),
(148, 67, 'Merah', 0, 1),
(149, 67, 'Biru', 0, 1),
(150, 67, 'Hijau', 1, 1),
(151, 67, 'Hitam', 0, 1),
(152, 67, 'Putih', 0, 1),
(153, 68, 'Meja', 0, 1),
(154, 68, 'Kursi', 0, 1),
(155, 68, 'Pensil', 1, 1),
(156, 68, 'Lemari', 0, 1),
(157, 68, 'Tas', 0, 1),
(158, 69, 'Mars', 0, 1),
(159, 69, 'Venus', 0, 1),
(160, 69, 'Bumi', 1, 1),
(161, 69, 'Jupiter', 0, 1),
(162, 69, 'Saturnus', 0, 1),
(163, 70, 'Minum', 1, 1),
(164, 70, 'Tidur', 0, 1),
(165, 70, 'Bermain', 0, 1),
(166, 70, 'Menonton', 0, 1),
(167, 70, 'Berlari', 0, 1),
(168, 71, 'Minggu', 0, 1),
(169, 71, 'Selasa', 1, 1),
(170, 71, 'Rabu', 0, 1),
(171, 71, 'Kamis', 0, 1),
(172, 71, 'Jumat', 0, 1),
(173, 72, 'Hangat', 0, 1),
(174, 72, 'Dingin', 1, 1),
(175, 72, 'Panas', 0, 1),
(176, 72, 'Terik', 0, 1),
(177, 72, 'Cerah', 0, 1),
(178, 73, 'Kucing', 0, 1),
(179, 73, 'Sapi', 0, 1),
(180, 73, 'Ikan', 1, 1),
(181, 73, 'Ayam', 0, 1),
(182, 73, 'Kuda', 0, 1),
(183, 74, 'Buku', 1, 1),
(184, 74, 'Meja', 0, 1),
(185, 74, 'Kursi', 0, 1),
(186, 74, 'Pintu', 0, 1),
(187, 74, 'Rumah', 0, 1),
(188, 75, 'Sekolah', 1, 1),
(189, 75, 'Jalan', 0, 1),
(190, 75, 'Rumah', 0, 1),
(191, 75, 'Pasar', 0, 1),
(192, 75, 'Buku', 0, 1),
(193, 76, '4', 0, 1),
(194, 76, '5', 1, 1),
(195, 76, '6', 0, 1),
(196, 76, '7', 0, 1),
(197, 76, '8', 0, 1),
(198, 77, '5', 0, 1),
(199, 77, '6', 1, 1),
(200, 77, '7', 0, 1),
(201, 77, '8', 0, 1),
(202, 77, '9', 0, 1),
(203, 78, '1', 1, 1),
(204, 78, '2', 0, 1),
(205, 78, '0', 0, 1),
(206, 78, '3', 0, 1),
(207, 78, '4', 0, 1),
(208, 79, 'Pena', 1, 1),
(209, 79, 'Buku', 0, 1),
(210, 79, 'Meja', 0, 1),
(211, 79, 'Rumah', 0, 1),
(212, 79, 'Jalan', 0, 1),
(213, 80, 'a biasa', 0, 1),
(214, 80, 'a dengan tekanan', 1, 1),
(215, 80, 'b', 0, 1),
(216, 80, 'c', 0, 1),
(217, 80, 'd', 0, 1),
(218, 81, '6', 0, 1),
(219, 81, '7', 1, 1),
(220, 81, '8', 0, 1),
(221, 81, '9', 0, 1),
(222, 81, '10', 0, 1),
(223, 82, 'Rumah', 1, 1),
(224, 82, 'Sekolah', 0, 1),
(225, 82, 'Jalan', 0, 1),
(226, 82, 'Buku', 0, 1),
(227, 82, 'Meja', 0, 1),
(228, 83, '6', 0, 1),
(229, 83, '9', 1, 1),
(230, 83, '12', 0, 1),
(231, 83, '3', 0, 1),
(232, 83, '8', 0, 1),
(233, 84, 'Air', 1, 1),
(234, 84, 'Api', 0, 1),
(235, 84, 'Tanah', 0, 1),
(236, 84, 'Udara', 0, 1),
(237, 84, 'Batu', 0, 1),
(238, 85, '2', 0, 1),
(239, 85, '4', 1, 1),
(240, 85, '6', 0, 1),
(241, 85, '8', 0, 1),
(242, 85, '10', 0, 1),
(243, 86, 'n biasa', 0, 1),
(244, 86, 'nya', 1, 1),
(245, 86, 'ng', 0, 1),
(246, 86, 'm', 0, 1),
(247, 86, 'p', 0, 1),
(248, 87, '3', 0, 1),
(249, 87, '5', 1, 1),
(250, 87, '6', 0, 1),
(251, 87, '7', 0, 1),
(252, 87, '8', 0, 1),
(253, 88, 'Matahari', 1, 1),
(254, 88, 'Bulan', 0, 1),
(255, 88, 'Bintang', 0, 1),
(256, 88, 'Langit', 0, 1),
(257, 88, 'Awan', 0, 1),
(258, 89, '6', 0, 1),
(259, 89, '7', 0, 1),
(260, 89, '8', 1, 1),
(261, 89, '9', 0, 1),
(262, 89, '10', 0, 1),
(263, 90, '10', 0, 1),
(264, 90, '20', 0, 1),
(265, 90, '25', 1, 1),
(266, 90, '15', 0, 1),
(267, 90, '30', 0, 1),
(268, 91, 'e biasa', 0, 1),
(269, 91, 'e dengan tekanan', 1, 1),
(270, 91, 'i', 0, 1),
(271, 91, 'o', 0, 1),
(272, 91, 'u', 0, 1),
(273, 92, 'Bulan', 1, 1),
(274, 92, 'Matahari', 0, 1),
(275, 92, 'Bintang', 0, 1),
(276, 92, 'Langit', 0, 1),
(277, 92, 'Air', 0, 1),
(278, 93, '5', 0, 1),
(279, 93, '10', 1, 1),
(280, 93, '15', 0, 1),
(281, 93, '20', 0, 1),
(282, 93, '25', 0, 1),
(283, 94, '<p style=\"text-align:justify\">membatasi diri dari pergaulan dan berbagai media sosial sehingga tidak perlu menerima banyak informasi</p>', 0, 1),
(284, 94, '<p style=\"text-align:justify\">melaporkan penyebar informasi kepada pihak yang berwenang secara langsung</p>', 0, 1),
(285, 94, '<p style=\"text-align:justify\">membandingkan informasi yang diperoleh dengan sumber terpercaya lain sebelum disebarkan</p>', 1, 1),
(286, 94, '<p style=\"text-align:justify\">menghormati cara pandang dan sikap seseorang dalam menyikapi suatu informasi</p>', 0, 1),
(287, 95, '<p style=\"text-align:justify\">Dalam rangka memperingati ulang tahun SMP Wijaya Kusuma, OSIS diharapkan dapat melakukan kegiatan bakti sosial melalui Pramuka, PMR, dan PKS.</p>', 1, 1),
(288, 95, '<p style=\"text-align:justify\">Untuk mengawali kegiatan ulang tahun sekolah, OSIS dapat memulai kegiatan dengan melaksanakan bakti sosial melalui Palang Merah Remaja.</p>', 0, 1),
(289, 95, '<p style=\"text-align:justify\">Kegiatan bakti sosial bukan hanya milik rakyat awam, melainkan juga untuk pelajar.</p>', 0, 1),
(290, 95, '<p style=\"text-align:justify\">Dalam pidato ini, topik yang akan kita bahas yaitu masalah gerakan bakti sosial yang dilaksanakan oleh OSIS melalui Pramuka, PKS, dan PMR.</p>', 0, 1),
(291, 96, '<p style=\"text-align:justify\">isu</p>', 0, 1),
(292, 96, '<p style=\"text-align:justify\">argumen pro</p>', 0, 1),
(293, 96, '<p style=\"text-align:justify\">argumen kontra</p>', 0, 1),
(294, 96, '<p style=\"text-align:justify\">simpulan</p>', 1, 1),
(295, 97, '<p style=\"text-align:justify\">argumen pro</p>', 1, 1),
(296, 97, '<p style=\"text-align:justify\">argumen kontra</p>', 0, 1),
(297, 97, '<p style=\"text-align:justify\">topik</p>', 0, 1),
(298, 97, '<p style=\"text-align:justify\">isu</p>', 0, 1),
(299, 98, '<p style=\"text-align:justify\">teks yang berisi cerita singkat yang menarik karena lucu dan mengesankan</p>', 0, 1),
(300, 98, '<p style=\"text-align:justify\">jenis pengembangan paragraf yang isinya bertujuan menjelaskan, memberi tahu, memaparkan, atau menerangkan sesuatu kepada pembaca dengan gaya penulisan yang singkat, padat, dan akurat</p>', 0, 1),
(301, 98, '<p style=\"text-align:justify\">teks yang berisi penjelasan mengenai pendapat atau opini tentang suatu masalah untuk meyakinkan orang lain berdasarkan data atau fakta disertai bukti pendukungnya</p>', 1, 1),
(302, 98, '<p style=\"text-align:justify\">teks yang berisi penjelasan mengenai fenomena atau peristiwa</p>', 0, 1),
(303, 99, '<p style=\"text-align:justify\">tulisan dan gambar</p>', 0, 1),
(304, 99, '<p style=\"text-align:justify\">pendapat</p>', 0, 1),
(305, 99, '<p style=\"text-align:justify\">analisis</p>', 0, 1),
(306, 99, '<p style=\"text-align:justify\">data dan fakta</p>', 1, 1),
(307, 100, '<p style=\"text-align:justify\">termasuk topik baru</p>', 0, 1),
(308, 100, '<p style=\"text-align:justify\">termasuk topik yang aktual</p>', 0, 1),
(309, 100, '<p style=\"text-align:justify\">topik yang dibicarakan menarik bagi peserta</p>', 0, 1),
(310, 100, '<p style=\"text-align:justify\">topik yang dibicarakan tidak relevan dengan situasi sekarang</p>', 1, 1),
(311, 101, '<p style=\"text-align:justify\">isi</p>', 0, 1),
(312, 101, '<p style=\"text-align:justify\">argumen pro</p>', 1, 1),
(313, 101, '<p style=\"text-align:justify\">argumen kontra</p>', 0, 1),
(314, 101, '<p style=\"text-align:justify\">simpulan</p>', 0, 1),
(315, 102, '<p style=\"text-align:justify\">isu</p>', 1, 1),
(316, 102, '<p style=\"text-align:justify\">argumen pro</p>', 0, 1),
(317, 102, '<p style=\"text-align:justify\">argumen kontra</p>', 0, 1),
(318, 102, '<p style=\"text-align:justify\">simpulan</p>', 0, 1),
(319, 103, '<p style=\"text-align:justify\">pro kontra dampak kemajuan teknologi</p>', 0, 1),
(320, 103, '<p style=\"text-align:justify\">pro kontra dampak kemajuan zaman</p>', 0, 1),
(321, 103, '<p style=\"text-align:justify\">pro kontra dampak gim atau permainan virtual</p>', 1, 1),
(322, 103, '<p style=\"text-align:justify\">gim termasuk salah satu dampak buruk kemajuan teknologi</p>', 0, 1),
(323, 104, '<p style=\"text-align:justify\">penghapusan sistem ujian nasional</p>', 1, 1),
(324, 104, '<p style=\"text-align:justify\">perolehan medali olimpiade</p>', 0, 1),
(325, 104, '<p style=\"text-align:justify\">meningkatnya prestasi murid</p>', 0, 1),
(326, 104, '<p style=\"text-align:justify\">aktivitas murid di sekolah</p>', 0, 1),
(327, 105, '<p style=\"text-align:justify\">Jatuh di atas rumahku</p>', 0, 1),
(328, 105, '<p style=\"text-align:justify\">Berderai di atas rumahku</p>', 0, 1),
(329, 105, '<p style=\"text-align:justify\">Mengetuk atap rumahku</p>', 1, 1),
(330, 105, '<p style=\"text-align:justify\">Membasahi atap rumahku</p>', 0, 1),
(331, 106, '<p style=\"text-align:justify\">personifikasi</p>', 0, 1),
(332, 106, '<p style=\"text-align:justify\">Simile</p>', 0, 1),
(333, 106, '<p style=\"text-align:justify\">Metafora</p>', 1, 1),
(334, 106, '<p style=\"text-align:justify\">Sinekdoke</p>', 0, 1),
(335, 107, '<p style=\"text-align:justify\">perkampungan yang dipayungi awan biru yang indah</p>', 0, 1),
(336, 107, '<p style=\"text-align:justify\">keindahan gunung yang puncaknya selalu berawan</p>', 0, 1),
(337, 107, '<p style=\"text-align:justify\">seakan kampung halaman memanggilnya</p>', 0, 1),
(338, 107, '<p style=\"text-align:justify\">kerinduan yang mendalam kepada kampung halaman</p>', 1, 1),
(339, 108, '<p style=\"text-align:justify\">simile</p>', 1, 1),
(340, 108, '<p style=\"text-align:justify\">personifikasi</p>', 0, 1),
(341, 108, '<p style=\"text-align:justify\">metafora</p>', 0, 1),
(342, 108, '<p style=\"text-align:justify\">perumpamaan epos</p>', 0, 1),
(343, 109, '<p style=\"text-align:justify\">terkenal seperti dalam legenda</p>', 1, 1),
(344, 109, '<p style=\"text-align:justify\">memiliki harga mahal</p>', 0, 1),
(345, 109, '<p style=\"text-align:justify\">hanya khayalan</p>', 0, 1),
(346, 109, '<p style=\"text-align:justify\">tidak ada di dalam kehidupan nyata</p>', 0, 1),
(347, 110, '<p style=\"text-align:justify\">daratan</p>', 0, 1),
(348, 110, '<p style=\"text-align:justify\">lautan</p>', 0, 1),
(349, 110, '<p style=\"text-align:justify\">kepulauan</p>', 1, 1),
(350, 110, '<p style=\"text-align:justify\">maju</p>', 0, 1),
(351, 111, '<p style=\"text-align:justify\">sebagian besar wilayah Indonesia berupa perairan</p>', 1, 1),
(352, 111, '<p style=\"text-align:justify\">sebagian besar wilayah Indonesia berupa daratan</p>', 0, 1),
(353, 111, '<p style=\"text-align:justify\">jumlah pulau di Indonesia tidak lebih dari 13.000 pulau</p>', 0, 1),
(354, 111, '<p style=\"text-align:justify\">panjang garis pantai Indonesia adalah 80.000 km</p>', 0, 1),
(355, 112, '<p style=\"text-align:justify\">adat kebiasaan turun-temurun</p>', 1, 1),
(356, 112, '<p style=\"text-align:justify\">kepercayaan hidup</p>', 0, 1),
(357, 112, '<p style=\"text-align:justify\">pandangan hidup</p>', 0, 1),
(358, 112, '<p style=\"text-align:justify\">upacara adat</p>', 0, 1),
(359, 113, '<p style=\"text-align:justify\">teks laporan adalah membahas tradisi bapongka</p>', 1, 1),
(360, 113, '<p style=\"text-align:justify\">tradisi sasi dilakukan oleh masyarakat Maluku dan Papua</p>', 0, 1),
(361, 113, '<p style=\"text-align:justify\">tradisi ini mengatur waktu untuk memanfaatkan hasil laut</p>', 0, 1),
(362, 113, '<p style=\"text-align:justify\">tradisi dilakukan dengan buka tutup laut</p>', 0, 1),
(363, 114, '<p style=\"text-align:justify\">simulasi</p>', 0, 1),
(364, 114, '<p style=\"text-align:justify\">lamun</p>', 1, 1),
(365, 114, '<p style=\"text-align:justify\">pesisir</p>', 0, 1),
(366, 114, '<p style=\"text-align:justify\">jernih</p>', 0, 1),
(367, 115, '<p style=\"text-align:justify\">metafora</p>', 1, 1),
(368, 115, '<p style=\"text-align:justify\">personifikasi</p>', 0, 1),
(369, 115, '<p style=\"text-align:justify\">sinekdoke</p>', 0, 1),
(370, 115, '<p style=\"text-align:justify\">simile</p>', 0, 1),
(371, 116, '<p style=\"text-align:justify\">keharuan</p>', 0, 1),
(372, 116, '<p style=\"text-align:justify\">kegembiraan</p>', 0, 1),
(373, 116, '<p style=\"text-align:justify\">ketenteraman</p>', 0, 1),
(374, 116, '<p style=\"text-align:justify\">kesenduan</p>', 1, 1),
(375, 117, '<p style=\"text-align:justify\">pengakuan dosa</p>', 0, 1),
(376, 117, '<p style=\"text-align:justify\">cermin itu berkaca</p>', 0, 1),
(377, 117, '<p style=\"text-align:justify\">ketidakberdayaan seseorang</p>', 1, 1),
(378, 117, '<p style=\"text-align:justify\">kenyataan di dunia</p>', 0, 1),
(379, 118, '<p style=\"text-align:justify\">pertama</p>', 0, 1),
(380, 118, '<p style=\"text-align:justify\">kedua</p>', 0, 1),
(381, 118, '<p style=\"text-align:justify\">ketiga</p>', 1, 1),
(382, 118, '<p style=\"text-align:justify\">keempat</p>', 0, 1),
(383, 119, '<p>kehidupan sehari-hari</p>', 0, 1),
(384, 119, '<p>masalah dalam kehidupan sehari-hari</p>', 1, 1),
(385, 119, '<p>bekerja dengan semangat meskipun ada masalah</p>', 0, 1),
(386, 119, '<p>nasihat</p>', 0, 1),
(387, 120, '<p>selamat</p>', 0, 1),
(388, 120, '<p>aman</p>', 0, 1),
(389, 120, '<p>berkah</p>', 0, 1),
(390, 120, '<p>nasihat</p>', 1, 1),
(391, 121, '<p>sampiran</p>', 0, 1),
(392, 121, '<p>isi</p>', 1, 1),
(393, 121, '<p>amanat</p>', 0, 1),
(394, 121, '<p>pekerjaan</p>', 0, 1),
(395, 122, '<p>saran</p>', 0, 1),
(396, 122, '<p>ajakan</p>', 0, 1),
(397, 122, '<p>Larangan</p>', 1, 1),
(398, 122, '<p>Imbauan</p>', 0, 1),
(399, 123, '<p>(1) mawar, (2) sapu, (3) suara, (4) pujaan</p>', 1, 1),
(400, 123, '<p>(1) mawar, (2) waru, (3) suara, (4) daun</p>', 0, 1),
(401, 123, '<p>(1) melati, (2) waru, (3) cerita, (4) hari</p>', 0, 1),
(402, 123, '<p>(1) melati, (2) duri, (3) cerita, (4) hati</p>', 0, 1),
(403, 124, '<p>pengenalan tokoh, latar, watak tokoh, dan konflik</p>', 1, 1),
(404, 124, '<p>berisi alur cerita</p>', 0, 1),
(405, 124, '<p>pengenalan sebab akibat sehingga muncul masalah hingga masalah itu memuncak</p>', 0, 1),
(406, 124, '<p>berisi penyelesaian masalah dari konflik yang terjadi</p>', 0, 1),
(407, 125, '<p>lintas waktu</p>', 0, 1),
(408, 125, '<p>latar sezaman</p>', 1, 1),
(409, 125, '<p>latar masa kini</p>', 0, 1),
(410, 125, '<p>latar masa lalu</p>', 0, 1),
(411, 126, '<p>cerita narasi liris</p>', 0, 1),
(412, 126, '<p>cerita narasi total</p>', 1, 1),
(413, 126, '<p>cerita fantasi irisan</p>', 0, 1),
(414, 126, '<p>cerita fantasi lokal</p>', 0, 1),
(415, 127, '<p style=\"text-align:justify\">baris pertama dan kedua</p>', 0, 1),
(416, 127, '<p style=\"text-align:justify\">baris kedua dan ketiga</p>', 0, 1),
(417, 127, '<p style=\"text-align:justify\">baris ketiga dan keempat</p>', 1, 1),
(418, 127, '<p style=\"text-align:justify\">baris pertama dan keempat</p>', 0, 1),
(419, 128, '<p style=\"text-align:justify\">a-a-b-b</p>', 0, 1),
(420, 128, '<p style=\"text-align:justify\">a-b-a-b</p>', 0, 1),
(421, 128, '<p style=\"text-align:justify\">a-a-a-a</p>', 1, 1),
(422, 128, '<p style=\"text-align:justify\">a-b-b-a</p>', 0, 1),
(423, 129, '<p>(I)</p>', 0, 1),
(424, 129, '<p>(II) dan (III)</p>', 0, 1),
(425, 129, '<p>(III)</p>', 0, 1),
(426, 129, '<p>(I) dan (III)</p>', 1, 1),
(427, 130, '<p>membuat judul</p>', 1, 1),
(428, 130, '<p>menyusun kalimat pembuka</p>', 0, 1),
(429, 130, '<p>menyusun isi</p>', 0, 1),
(430, 130, '<p>menulis kalimat penutup</p>', 0, 1),
(431, 131, '<p>imajinasi</p>', 0, 1),
(432, 131, '<p>opini atau pendapat tokoh</p>', 0, 1),
(433, 131, '<p>pengamatan</p>', 1, 1),
(434, 131, '<p>perkiraan</p>', 0, 1),
(435, 132, '<p>mencermati seluruh naskah, menemukan kesalahan pada tabel, membenahi kesalahan pada tabel, menulis kembali</p>', 0, 1),
(436, 132, '<p>membaca keseluruhan naskah, menemukan kesalahan penggunaan kosakata, konjungsi, kalimat, mekanika, menulis kembali naskah dengan membenahi yang salah</p>', 1, 1),
(437, 132, '<p>menemukan kesalahan pada seluruh kalimat, mencoret kesalahan, membenahi kesalahan pada kalimat</p>', 0, 1),
(438, 132, '<p>membaca naskah secara keseluruhan, menemukan kesalahan, membenahi kesalahan</p>', 0, 1),
(439, 133, '<p>definisi</p>', 0, 1),
(440, 133, '<p>eksposisi</p>', 0, 1),
(441, 133, '<p>klasifikasi</p>', 0, 1),
(442, 133, '<p>deskripsi</p>', 1, 1),
(443, 134, '<p>fungsi museum</p>', 0, 1),
(444, 134, '<p>tempat museum</p>', 0, 1),
(445, 134, '<p>wisata museum</p>', 0, 1),
(446, 134, '<p>Museum</p>', 1, 1),
(447, 135, '<p>adanya kata umum dan kata khusus</p>', 0, 1),
(448, 135, '<p>adanya kata yang seolah-olah melihat</p>', 0, 1),
(449, 135, '<p>adanya kalimat saran</p>', 0, 1),
(450, 135, '<p>adanya kalimat definisi</p>', 1, 1),
(451, 136, '<p>(1)</p>', 0, 1),
(452, 136, '<p>(2)</p>', 0, 1),
(453, 136, '<p>(3)</p>', 0, 1),
(454, 136, '<p>(4)</p>', 1, 1),
(455, 137, '<p>(1) dan (2)</p>', 0, 1),
(456, 137, '<p>(1) dan (3)</p>', 1, 1),
(457, 137, '<p>(2) dan (3)</p>', 0, 1),
(458, 137, '<p>(2) dan (4</p>', 0, 1),
(459, 138, '<p>(4)</p>', 0, 1),
(460, 138, '<p>(3)</p>', 0, 1),
(461, 138, '<p>(2)</p>', 0, 1),
(462, 138, '<p>(1)</p>', 1, 1),
(463, 139, '<p>sebagai sumber informasi</p>', 1, 1),
(464, 139, '<p>sebagai media hiburan</p>', 0, 1),
(465, 139, '<p>sebagai media provokasi</p>', 0, 1),
(466, 139, '<p>menimbulkan pertanyaan</p>', 0, 1),
(467, 140, '<p>deskripsi</p>', 0, 1),
(468, 140, '<p>observasi</p>', 1, 1),
(469, 140, '<p>anekdot</p>', 0, 1),
(470, 140, '<p>narasi</p>', 0, 1),
(471, 141, '<p>orientasi</p>', 0, 1),
(472, 141, '<p>pernyataan umum atau klasifikasi</p>', 0, 1),
(473, 141, '<p>anggota atau aspek yang dilaporkan</p>', 0, 1),
(474, 141, '<p>b dan c benar</p>', 1, 1),
(475, 142, '<p>pernyataan umum atau klasifikasi</p>', 1, 1),
(476, 142, '<p>anggota atau aspek yang dilaporkan</p>', 0, 1),
(477, 142, '<p>orientasi</p>', 0, 1),
(478, 142, '<p>reaksi</p>', 0, 1),
(479, 143, '<p>Harus mengandung fakta</p>', 0, 1),
(480, 143, '<p>Harus objektif</p>', 0, 1),
(481, 143, '<p>Harus lengkap</p>', 0, 1),
(482, 143, '<p>Memasukkan hal-hal yang memihak</p>', 1, 1),
(483, 144, '3/4', 1, 1),
(484, 144, '2/6', 0, 1),
(485, 144, '1/6', 0, 1),
(486, 144, '2/4', 0, 1),
(487, 145, '2/5', 1, 1),
(488, 145, '1/5', 0, 1),
(489, 145, '3/10', 0, 1),
(490, 145, '4/5', 0, 1),
(491, 146, '6/12', 0, 1),
(492, 146, '1/2', 1, 1),
(493, 146, '2/12', 0, 1),
(494, 146, '3/7', 0, 1),
(495, 147, '1', 1, 1),
(496, 147, '2/3', 0, 1),
(497, 147, '4/9', 0, 1),
(498, 147, '6/8', 0, 1),
(499, 148, '4/6', 1, 1),
(500, 148, '3/5', 0, 1),
(501, 148, '6/10', 0, 1),
(502, 148, '2/5', 0, 1),
(503, 149, '6/8', 1, 1),
(504, 149, '5/16', 0, 1),
(505, 149, '1/8', 0, 1),
(506, 149, '7/8', 0, 1),
(507, 150, '5/9', 1, 1),
(508, 150, '9/5', 0, 1),
(509, 150, '2/7', 0, 1),
(510, 150, '6/9', 0, 1),
(511, 151, '6/20', 1, 1),
(512, 151, '5/6', 0, 1),
(513, 151, '3/10', 0, 1),
(514, 151, '2/9', 0, 1),
(515, 152, '2', 1, 1),
(516, 152, '3/6', 0, 1),
(517, 152, '6/21', 0, 1),
(518, 152, '7/6', 0, 1),
(519, 153, '2/3', 1, 1),
(520, 153, '4/6', 0, 1),
(521, 153, '1/3', 0, 1),
(522, 153, '3/4', 0, 1),
(523, 154, '&#1610;&#1615;&#1581;&#1614;&#1575;&#1601;&#1616;&#1592;&#1615;', 0, 1),
(524, 154, '&#1610;&#1615;&#1606;&#1614;&#1605;&#1617;&#1616;&#1610;', 1, 1),
(525, 154, '&#1610;&#1614;&#1578;&#1618;&#1585;&#1615;&#1603;&#1615;', 0, 1),
(526, 154, '&#1610;&#1615;&#1590;&#1614;&#1610;&#1617;&#1616;&#1593;&#1615;', 0, 1),
(527, 154, '&#1610;&#1614;&#1606;&#1618;&#1587;&#1614;&#1609;', 0, 1),
(528, 155, '&#1605;&#1615;&#1580;&#1618;&#1578;&#1614;&#1607;&#1616;&#1583;&#1612;', 0, 1),
(529, 155, '&#1601;&#1614;&#1575;&#1588;&#1616;&#1604;&#1612;', 1, 1),
(530, 155, '&#1584;&#1614;&#1603;&#1616;&#1610;&#1617;&#1612;', 0, 1),
(531, 155, '&#1602;&#1614;&#1608;&#1616;&#1610;&#1617;&#1612;', 0, 1),
(532, 155, '&#1589;&#1614;&#1575;&#1583;&#1616;&#1602;&#1612;', 0, 1),
(533, 156, '&#1575;&#1604;&#1591;&#1617;&#1615;&#1604;&#1617;&#1575;&#1576;&#1615; &#1610;&#1614;&#1583;&#1618;&#1585;&#1615;&#1587;&#1615; &#1601;&#1610; &#1575;&#1604;&#1601;&#1614;&#1589;&#1618;&#1604;&#1616;', 0, 1),
(534, 156, '&#1575;&#1604;&#1591;&#1617;&#1615;&#1604;&#1617;&#1575;&#1576;&#1615; &#1610;&#1614;&#1583;&#1618;&#1585;&#1615;&#1587;&#1615;&#1608;&#1606;&#1614; &#1601;&#1610; &#1575;&#1604;&#1601;&#1614;&#1589;&#1618;&#1604;&#1616;', 1, 1),
(535, 156, '&#1575;&#1604;&#1591;&#1617;&#1615;&#1604;&#1617;&#1575;&#1576;&#1615; &#1578;&#1614;&#1583;&#1618;&#1585;&#1615;&#1587;&#1615;&#1608;&#1606;&#1614; &#1601;&#1610; &#1575;&#1604;&#1601;&#1614;&#1589;&#1618;&#1604;&#1616;', 0, 1),
(536, 156, '&#1575;&#1604;&#1591;&#1617;&#1615;&#1604;&#1617;&#1575;&#1576;&#1615; &#1610;&#1614;&#1583;&#1618;&#1585;&#1615;&#1587;&#1618; &#1601;&#1610; &#1575;&#1604;&#1601;&#1614;&#1589;&#1618;&#1604;&#1616;', 0, 1),
(537, 156, '&#1575;&#1604;&#1591;&#1617;&#1615;&#1604;&#1617;&#1575;&#1576;&#1615; &#1610;&#1614;&#1583;&#1618;&#1585;&#1615;&#1587;&#1615;&#1608;&#1575; &#1601;&#1610; &#1575;&#1604;&#1601;&#1614;&#1589;&#1618;&#1604;&#1616;', 0, 1),
(538, 157, '&#1605;&#1614;&#1601;&#1618;&#1593;&#1615;&#1608;&#1604;&#1612; &#1576;&#1616;&#1607;&#1616;', 0, 1),
(539, 157, '&#1601;&#1614;&#1575;&#1593;&#1616;&#1604;&#1612;', 1, 1),
(540, 157, '&#1582;&#1614;&#1576;&#1614;&#1585;&#1612;', 0, 1),
(541, 157, '&#1605;&#1615;&#1576;&#1618;&#1578;&#1614;&#1583;&#1614;&#1571;&#1612;', 0, 1),
(542, 157, '&#1606;&#1614;&#1593;&#1618;&#1578;&#1612;', 0, 1),
(543, 158, 'Ilmu adalah cahaya dan kebodohan adalah kegelapan', 1, 1),
(544, 158, 'Ilmu itu sulit dan bodoh itu mudah', 0, 1),
(545, 158, 'Ilmu adalah gelap dan bodoh adalah terang', 0, 1),
(546, 158, 'Ilmu tidak penting', 0, 1),
(547, 158, 'Kebodohan itu baik', 0, 1),
(548, 159, '&#1603;&#1615;&#1578;&#1615;&#1576;&#1612;', 1, 1),
(549, 159, '&#1603;&#1614;&#1575;&#1578;&#1616;&#1576;&#1612;', 0, 1),
(550, 159, '&#1605;&#1614;&#1603;&#1618;&#1578;&#1614;&#1576;&#1612;', 0, 1),
(551, 159, '&#1603;&#1616;&#1578;&#1614;&#1575;&#1576;&#1614;&#1577;&#1612;', 0, 1),
(552, 159, '&#1603;&#1614;&#1578;&#1614;&#1576;&#1614;', 0, 1),
(553, 160, '&#1601;&#1616;&#1593;&#1618;&#1604;&#1612; &#1605;&#1615;&#1590;&#1614;&#1575;&#1585;&#1616;&#1593;&#1612;', 0, 1),
(554, 160, '&#1601;&#1616;&#1593;&#1618;&#1604;&#1612; &#1605;&#1614;&#1575;&#1590;&#1613;', 1, 1),
(555, 160, '&#1601;&#1616;&#1593;&#1618;&#1604;&#1615; &#1571;&#1614;&#1605;&#1618;&#1585;&#1613;', 0, 1),
(556, 160, '&#1575;&#1616;&#1587;&#1618;&#1605;&#1612;', 0, 1),
(557, 160, '&#1581;&#1614;&#1585;&#1618;&#1601;&#1612;', 0, 1),
(558, 161, 'Siswa pergi ke pasar', 0, 1),
(559, 161, 'Siswa pergi ke rumah', 0, 1),
(560, 161, 'Siswa pergi ke kampus', 1, 1),
(561, 161, 'Siswa tidur di kelas', 0, 1),
(562, 161, 'Siswa makan di kantin', 0, 1),
(563, 162, '&#1605;&#1614;&#1583;&#1618;&#1585;&#1615;&#1608;&#1587;&#1612;', 0, 1),
(564, 162, '&#1583;&#1614;&#1575;&#1585;&#1616;&#1587;&#1612;', 1, 1),
(565, 162, '&#1583;&#1616;&#1585;&#1614;&#1575;&#1587;&#1614;&#1577;&#1612;', 0, 1),
(566, 162, '&#1605;&#1614;&#1583;&#1618;&#1585;&#1614;&#1587;&#1614;&#1577;&#1612;', 0, 1),
(567, 162, '&#1583;&#1614;&#1585;&#1618;&#1587;&#1612;', 0, 1),
(568, 163, 'Lambat', 0, 1),
(569, 163, 'Cepat', 1, 1),
(570, 163, 'Besar', 0, 1),
(571, 163, 'Kecil', 0, 1),
(572, 163, 'Tinggi', 0, 1),
(573, 164, 'You should ignore the deadline', 0, 1),
(574, 164, 'Why don&rsquo;t you ask for an extension', 0, 1),
(575, 164, 'I think you should prepare it carefully tonight', 0, 1),
(576, 164, 'Shall we work on it together this evening', 1, 1),
(577, 164, 'You can submit it next week', 0, 1),
(578, 165, 'I didn&rsquo;t study well last night', 1, 1),
(579, 165, 'I always study hard every day', 0, 1),
(580, 165, 'I don&rsquo;t like this subject at all', 0, 1),
(581, 165, 'The test is too easy for me', 0, 1),
(582, 165, 'I have already mastered everything', 0, 1),
(583, 166, 'You should stop studying it', 0, 1),
(584, 166, 'Maybe you can try reading it again', 0, 1),
(585, 166, 'I can explain it if you want', 1, 1),
(586, 166, 'It&rsquo;s too difficult for everyone', 0, 1),
(587, 166, 'You don&rsquo;t need to learn it', 0, 1),
(588, 167, 'may', 0, 1),
(589, 167, 'might', 0, 1),
(590, 167, 'should', 1, 1),
(591, 167, 'would', 0, 1),
(592, 167, 'could', 0, 1),
(593, 168, 'more difficult', 1, 1),
(594, 168, 'most difficult', 0, 1),
(595, 168, 'difficult', 0, 1),
(596, 168, 'difficultest', 0, 1),
(597, 168, 'more difficulty', 0, 1),
(598, 169, 'I don&rsquo;t think so', 0, 1),
(599, 169, 'That sounds interesting, I&rsquo;d love to join', 1, 1),
(600, 169, 'I prefer to stay silent', 0, 1),
(601, 169, 'Maybe another time', 0, 1),
(602, 169, 'I have no opinion', 0, 1),
(603, 170, 'I think I can handle it myself', 0, 1),
(604, 170, 'That would be helpful, thank you', 1, 1),
(605, 170, 'I don&rsquo;t need any help at all', 0, 1),
(606, 170, 'I prefer doing it later', 0, 1),
(607, 170, 'It&rsquo;s not necessary now', 0, 1),
(608, 171, 'miss', 0, 1),
(609, 171, 'missing', 1, 1),
(610, 171, 'to miss', 0, 1),
(611, 171, 'missed', 0, 1),
(612, 171, 'misses', 0, 1),
(613, 172, 'in', 0, 1),
(614, 172, 'with', 0, 1),
(615, 172, 'on', 0, 1),
(616, 172, 'at', 0, 1),
(617, 172, 'of', 1, 1),
(618, 173, 'Yours sincerely', 0, 1),
(619, 173, 'Best regards', 0, 1),
(620, 173, 'Respectfully yours', 0, 1),
(621, 173, 'Warmest greetings', 0, 1),
(622, 173, 'Love and kisses', 1, 1),
(623, 174, 'It seems beneficial, but needs adjustment', 1, 1),
(624, 174, 'I don&rsquo;t know anything about it', 0, 1),
(625, 174, 'It doesn&rsquo;t matter at all', 0, 1),
(626, 174, 'I have no interest in it', 0, 1),
(627, 174, 'It is completely useless', 0, 1),
(628, 175, 'do', 0, 1),
(629, 175, 'make', 0, 1),
(630, 175, 'keep', 1, 1),
(631, 175, 'take', 0, 1),
(632, 175, 'have', 0, 1),
(633, 176, 'fluent', 0, 1),
(634, 176, 'more fluent', 0, 1),
(635, 176, 'most fluent', 0, 1),
(636, 176, 'more fluently', 1, 1),
(637, 176, 'fluently', 0, 1),
(638, 177, 'You should take a rest', 1, 1),
(639, 177, 'Keep working harder', 0, 1),
(640, 177, 'Ignore your condition', 0, 1),
(641, 177, 'Do more activities', 0, 1),
(642, 177, 'Don&rsquo;t stop at all', 0, 1),
(643, 178, 'might', 0, 1),
(644, 178, 'may', 0, 1),
(645, 178, 'must', 1, 1),
(646, 178, 'could', 0, 1),
(647, 178, 'would', 0, 1),
(648, 179, 'I&rsquo;m not interested in helping', 0, 1),
(649, 179, 'Sure, I can help you with that', 1, 1),
(650, 179, 'Maybe you should ask someone else', 0, 1),
(651, 179, 'I don&rsquo;t understand your request', 0, 1),
(652, 179, 'It seems too complicated', 0, 1),
(653, 180, 'She don&rsquo;t understand the lesson', 0, 1),
(654, 180, 'She doesn&rsquo;t understands the lesson', 0, 1),
(655, 180, 'She doesn&rsquo;t understand the lesson', 1, 1),
(656, 180, 'She not understand the lesson', 0, 1),
(657, 180, 'She don&rsquo;t understanding the lesson', 0, 1),
(658, 181, 'careless', 0, 1),
(659, 181, 'capable', 1, 1),
(660, 181, 'weak', 0, 1),
(661, 181, 'lazy', 0, 1),
(662, 181, 'doubtful', 0, 1),
(663, 182, 'I forget the schedule', 0, 1),
(664, 182, 'I had another important commitment', 1, 1),
(665, 182, 'I don&rsquo;t want to come', 0, 1),
(666, 182, 'It was not interesting', 0, 1),
(667, 182, 'I don&rsquo;t like meetings', 0, 1),
(668, 183, 'He go to campus yesterday', 0, 1),
(669, 183, 'He goes to campus yesterday', 0, 1),
(670, 183, 'He went to campus yesterday', 1, 1),
(671, 183, 'He going to campus yesterday', 0, 1),
(672, 183, 'He gone to campus yesterday', 0, 1),
(673, 184, 'That&rsquo;s understandable, but try to improve', 1, 1),
(674, 184, 'It&rsquo;s completely fine every time', 0, 1),
(675, 184, 'You don&rsquo;t need to do it', 0, 1),
(676, 184, 'Just forget about it', 0, 1),
(677, 184, 'It&rsquo;s not important at all', 0, 1),
(678, 185, 'smart', 0, 1),
(679, 185, 'smarter', 0, 1),
(680, 185, 'smartest', 1, 1),
(681, 185, 'more smart', 0, 1),
(682, 185, 'most smart', 0, 1),
(683, 186, 'Yes, I would', 0, 1),
(684, 186, 'No problem, I&rsquo;ll close it', 1, 1),
(685, 186, 'I don&rsquo;t want to do it', 0, 1),
(686, 186, 'It&rsquo;s not necessary', 0, 1),
(687, 186, 'Maybe later', 0, 1),
(688, 187, 'avoids', 0, 1),
(689, 187, 'needs', 1, 1),
(690, 187, 'ignores', 0, 1),
(691, 187, 'refuses', 0, 1),
(692, 187, 'hides', 0, 1),
(693, 188, 'That&rsquo;s fine, I&rsquo;ll inform the committee', 1, 1),
(694, 188, 'You must attend it', 0, 1),
(695, 188, 'It&rsquo;s not acceptable', 0, 1),
(696, 188, 'I don&rsquo;t agree with you', 0, 1),
(697, 188, 'You should cancel everything', 0, 1),
(698, 189, 'accept', 0, 1),
(699, 189, 'accepting', 0, 1),
(700, 189, 'to accept', 1, 1),
(701, 189, 'accepted', 0, 1),
(702, 189, 'accepts', 0, 1),
(703, 190, 'That&rsquo;s a good idea', 1, 1),
(704, 190, 'I don&rsquo;t want to', 0, 1),
(705, 190, 'It&rsquo;s unnecessary', 0, 1),
(706, 190, 'I prefer working alone', 0, 1),
(707, 190, 'Maybe never', 0, 1),
(708, 191, 'am', 0, 1),
(709, 191, 'was', 0, 1),
(710, 191, 'were', 1, 1),
(711, 191, 'be', 0, 1),
(712, 191, 'being', 0, 1),
(713, 192, 'She enjoy reading novels', 0, 1),
(714, 192, 'She enjoys reading novels', 1, 1),
(715, 192, 'She enjoying reading novels', 0, 1),
(716, 192, 'She enjoyed reading now', 0, 1),
(717, 192, 'She enjoy read novels', 0, 1),
(718, 193, 'Yes, I&rsquo;d appreciate your help', 1, 1),
(719, 193, 'I don&rsquo;t need anything', 0, 1),
(720, 193, 'Maybe not now', 0, 1),
(721, 193, 'I prefer doing it myself', 0, 1),
(722, 193, 'It&rsquo;s not important', 0, 1),
(723, 194, 'is', 0, 1),
(724, 194, 'was', 1, 1),
(725, 194, 'are', 0, 1),
(726, 194, 'were', 0, 1),
(727, 194, 'be', 0, 1),
(728, 195, 'It offers flexibility, but requires discipline', 1, 1),
(729, 195, 'I don&rsquo;t know anything', 0, 1),
(730, 195, 'It doesn&rsquo;t matter', 0, 1),
(731, 195, 'I have no comment', 0, 1),
(732, 195, 'It is completely useless', 0, 1),
(733, 196, 'on', 0, 1),
(734, 196, 'in', 1, 1),
(735, 196, 'at', 0, 1),
(736, 196, 'with', 0, 1),
(737, 196, 'for', 0, 1),
(738, 197, 'That&rsquo;s unfortunate, you should report it', 1, 1),
(739, 197, 'That&rsquo;s your problem', 0, 1),
(740, 197, 'I don&rsquo;t care about it', 0, 1),
(741, 197, 'It&rsquo;s not important', 0, 1),
(742, 197, 'You should ignore it', 0, 1),
(743, 198, 'The book read by him', 0, 1),
(744, 198, 'The book is read by him', 1, 1),
(745, 198, 'The book reading by him', 0, 1),
(746, 198, 'The book reads by him', 0, 1),
(747, 198, 'The book is reading', 0, 1),
(748, 199, 'Of course, I can explain it again', 1, 1),
(749, 199, 'I don&rsquo;t want to', 0, 1),
(750, 199, 'It&rsquo;s too difficult', 0, 1),
(751, 199, 'Maybe later', 0, 1),
(752, 199, 'I don&rsquo;t understand it', 0, 1),
(753, 200, 'leave', 0, 1),
(754, 200, 'leaving', 1, 1),
(755, 200, 'to leave', 0, 1),
(756, 200, 'left', 0, 1),
(757, 200, 'leaves', 0, 1),
(758, 201, 'That sounds like a good plan', 1, 1),
(759, 201, 'I don&rsquo;t want to go anywhere', 0, 1),
(760, 201, 'It&rsquo;s not necessary', 0, 1),
(761, 201, 'I prefer staying at home', 0, 1),
(762, 201, 'Maybe never', 0, 1),
(763, 202, 'work slowly', 0, 1),
(764, 202, 'work in stressful conditions', 1, 1),
(765, 202, 'work alone', 0, 1),
(766, 202, 'work casually', 0, 1),
(767, 202, 'work freely', 0, 1),
(768, 203, 'You&rsquo;re welcome', 0, 1),
(769, 203, 'No problem at all', 0, 1),
(770, 203, 'Don&rsquo;t mention it', 0, 1),
(771, 203, 'Glad I could help', 0, 1),
(772, 203, 'It&rsquo;s my pleasure', 1, 1),
(773, 204, 'Shot service', 0, 1),
(774, 204, 'Long service', 1, 1),
(775, 204, 'Lob service', 0, 1),
(776, 204, 'Short dan lob service', 0, 1),
(777, 204, 'Backhand service', 0, 1),
(778, 205, 'Memukul serangan lawan', 0, 1),
(779, 205, 'Mengembalikan serangan lawan', 0, 1),
(780, 205, 'Menyajikan bola', 1, 1),
(781, 205, 'Siap untuk mengembalikan bola', 0, 1),
(782, 205, 'Melakukan pukulan smash', 0, 1),
(783, 206, 'Lurus', 0, 1),
(784, 206, 'Melambung', 0, 1),
(785, 206, 'Menyilang', 1, 1),
(786, 206, 'Menukik', 0, 1),
(787, 206, 'Bebas', 0, 1),
(788, 207, 'PBI', 0, 1),
(789, 207, 'IPSI', 0, 1),
(790, 207, 'PBVSI', 0, 1),
(791, 207, 'PERBASI', 0, 1),
(792, 207, 'PBSI', 1, 1),
(793, 208, '11', 0, 1),
(794, 208, '25', 0, 1),
(795, 208, '21', 1, 1),
(796, 208, '15', 0, 1),
(797, 208, '20', 0, 1),
(798, 209, 'Kaos tangan', 0, 1),
(799, 209, 'Dove', 0, 1),
(800, 209, 'Batter', 0, 1),
(801, 209, 'Glove', 1, 1),
(802, 209, 'Pitcher', 0, 1),
(803, 210, 'Catcher', 0, 1),
(804, 210, 'Glove', 0, 1),
(805, 210, 'Pitcher', 0, 1),
(806, 210, 'Batter', 1, 1),
(807, 210, 'Home', 0, 1),
(808, 211, 'Butting', 0, 1),
(809, 211, 'Swing', 0, 1),
(810, 211, 'Flyball', 0, 1),
(811, 211, 'Flying', 1, 1),
(812, 211, 'Long', 0, 1),
(813, 212, '10', 0, 1),
(814, 212, '8', 0, 1),
(815, 212, '12', 0, 1),
(816, 212, '9', 1, 1),
(817, 212, '6', 0, 1),
(818, 213, 'Time', 0, 1),
(819, 213, 'Score', 0, 1),
(820, 213, 'Ining', 1, 1),
(821, 213, 'Waktu', 0, 1),
(822, 213, 'Menit', 0, 1),
(823, 214, '2', 0, 1),
(824, 214, '3', 0, 1),
(825, 214, '1', 1, 1),
(826, 214, '4', 0, 1),
(827, 214, '5', 0, 1),
(828, 215, '1 x 25 menit', 0, 1),
(829, 215, '2 x 46 menit', 0, 1),
(830, 215, '2 x 45 menit', 1, 1),
(831, 215, '4 x 10 menit', 0, 1),
(832, 215, '1 x 45 menit', 0, 1),
(833, 216, 'Inggris', 0, 1),
(834, 216, 'Jerman', 0, 1),
(835, 216, 'China', 1, 1),
(836, 216, 'Turki', 0, 1),
(837, 216, 'Prancis', 0, 1),
(838, 217, 'Marah', 0, 1),
(839, 217, 'Melanjutkan permainan', 0, 1),
(840, 217, 'Keluar dari pertandingan', 1, 1),
(841, 217, 'Minta maaf', 0, 1),
(842, 217, 'Diganti pemain lain', 0, 1),
(843, 218, 'Tendangan bebas', 0, 1),
(844, 218, 'Lemparan ke dalam', 0, 1),
(845, 218, 'Tendangan sudut', 0, 1),
(846, 218, 'Tendangan penalty', 1, 1),
(847, 218, 'Tendangan gawang', 0, 1),
(848, 219, 'Taktik pencak silat', 0, 1),
(849, 219, 'Strategi pencak silat', 1, 1),
(850, 219, 'Teknik pencak silat', 0, 1),
(851, 219, 'Pertahanan pencak silat', 0, 1),
(852, 219, 'Pukulan pencak silat', 0, 1),
(853, 220, 'Kupu-kupu', 0, 1),
(854, 220, 'Dolphin', 0, 1),
(855, 220, 'Breast stroke', 0, 1),
(856, 220, 'Crawl', 1, 1),
(857, 220, 'Katak', 0, 1),
(858, 221, 'Ditundukkan ke bawah', 0, 1),
(859, 221, 'Ditengadahkan ke atas', 0, 1),
(860, 221, 'Diluruskan ke samping', 0, 1),
(861, 221, 'Diputar ke kiri dan kanan', 1, 1),
(862, 221, 'Diluruskan ke depan', 0, 1),
(863, 222, 'Diluruskan dan dirapatkan', 1, 1),
(864, 222, 'Ditekuk dan dirapatkan', 0, 1),
(865, 222, 'Diluruskan dan dibuka', 0, 1),
(866, 222, 'Ditekuk dan dibuka', 0, 1),
(867, 222, 'Diluruskan dan dilingkarkan', 0, 1),
(868, 223, 'Mendorong air', 0, 1),
(869, 223, 'Memutar air', 0, 1),
(870, 223, 'Menekan air', 0, 1),
(871, 223, 'Naik turun memukul air', 1, 1),
(872, 223, 'Mendorong bawah air', 0, 1),
(873, 224, 'PSRI', 0, 1),
(874, 224, 'PBSI', 0, 1),
(875, 224, 'PRRI', 0, 1),
(876, 224, 'Persani', 0, 1),
(877, 224, 'PRSI', 1, 1),
(878, 225, 'Jari manis', 0, 1),
(879, 225, 'Telunjuk', 0, 1),
(880, 225, 'Jari tengah', 1, 1),
(881, 225, 'Ibu jari', 0, 1),
(882, 225, 'Kelingking', 0, 1),
(883, 226, 'Mengetahui kedalaman air', 0, 1),
(884, 226, 'Membasahi tubuh', 0, 1),
(885, 226, 'Belajar gaya kupu-kupu', 0, 1),
(886, 226, 'Adaptasi dengan air', 1, 1),
(887, 226, 'Membersihkan badan', 0, 1),
(888, 227, 'Menginjak air', 0, 1),
(889, 227, 'Memutar kaki', 0, 1),
(890, 227, 'Menyelam', 0, 1),
(891, 227, 'Membuka menutup kaki', 0, 1),
(892, 227, 'Memukul air', 1, 1),
(893, 228, '100 m', 0, 1),
(894, 228, '200 m', 0, 1),
(895, 228, '300 m', 1, 1),
(896, 228, '400 m', 0, 1),
(897, 228, '500 m', 0, 1),
(898, 229, 'Mengapung', 1, 1),
(899, 229, 'Bermain air', 0, 1),
(900, 229, 'Melompat', 0, 1),
(901, 229, 'Meluncur', 0, 1),
(902, 229, 'Mengambil napas', 0, 1),
(903, 230, 'Mencederai', 0, 1),
(904, 230, 'Menyerang', 0, 1),
(905, 230, 'Mengukur prestasi', 1, 1),
(906, 230, 'Menunjukkan teknik', 0, 1),
(907, 230, 'Sasaran serangan', 0, 1),
(908, 231, 'Tangkapan', 0, 1),
(909, 231, 'Jatuhan', 0, 1),
(910, 231, 'Kuda-kuda', 0, 1),
(911, 231, 'Kuncian', 1, 1),
(912, 231, 'Lepasan', 0, 1),
(913, 232, 'Pergerakan kaki', 0, 1),
(914, 232, 'Pertahanan', 0, 1),
(915, 232, 'Sikap awal', 1, 1),
(916, 232, 'Tumpuan', 0, 1),
(917, 232, 'Pergeseran', 0, 1),
(918, 233, 'Kepala', 1, 1),
(919, 233, 'Leher', 0, 1),
(920, 233, 'Dada', 0, 1),
(921, 233, 'Paha', 0, 1),
(922, 233, 'Kaki', 0, 1),
(923, 234, 'Taktik', 0, 1),
(924, 234, 'Strategi', 1, 1),
(925, 234, 'Teknik', 0, 1),
(926, 234, 'Pertahanan', 0, 1),
(927, 234, 'Pukulan', 0, 1),
(928, 235, 'Kupu-kupu', 0, 1),
(929, 235, 'Dolphin', 0, 1),
(930, 235, 'Breast stroke', 0, 1),
(931, 235, 'Crawl', 1, 1),
(932, 235, 'Katak', 0, 1),
(933, 236, 'Ditundukkan', 0, 1),
(934, 236, 'Ditengadahkan', 0, 1),
(935, 236, 'Diluruskan', 0, 1),
(936, 236, 'Diputar kiri kanan', 1, 1),
(937, 236, 'Ke depan', 0, 1),
(938, 237, 'Lurus dan rapat', 1, 1),
(939, 237, 'Tekuk rapat', 0, 1),
(940, 237, 'Lurus terbuka', 0, 1),
(941, 237, 'Tekuk terbuka', 0, 1),
(942, 237, 'Diputar keluar', 0, 1),
(943, 238, 'Mendorong', 0, 1),
(944, 238, 'Memutar', 0, 1),
(945, 238, 'Menekan', 0, 1),
(946, 238, 'Naik turun', 1, 1),
(947, 238, 'Dorong bawah', 0, 1),
(948, 239, 'PSRI', 0, 1),
(949, 239, 'PBSI', 0, 1),
(950, 239, 'PRRI', 0, 1),
(951, 239, 'Persani', 0, 1),
(952, 239, 'PRSI', 1, 1),
(953, 240, 'Manis', 0, 1),
(954, 240, 'Telunjuk', 0, 1),
(955, 240, 'Tengah', 1, 1),
(956, 240, 'Ibu jari', 0, 1),
(957, 240, 'Kelingking', 0, 1),
(958, 241, 'Mengetahui dalam air', 0, 1),
(959, 241, 'Membasahi tubuh', 0, 1),
(960, 241, 'Belajar gaya kupu', 0, 1),
(961, 241, 'Adaptasi air', 1, 1),
(962, 241, 'Membersihkan tubuh', 0, 1),
(963, 242, 'Menginjak', 0, 1),
(964, 242, 'Memutar', 0, 1),
(965, 242, 'Menyelam', 0, 1),
(966, 242, 'Membuka menutup', 0, 1),
(967, 242, 'Memukul air', 1, 1),
(968, 243, '100 m', 0, 1),
(969, 243, '200 m', 0, 1),
(970, 243, '300 m', 1, 1),
(971, 243, '400 m', 0, 1),
(972, 243, '500 m', 0, 1),
(973, 244, 'Gempa bumi', 0, 1),
(974, 244, 'Kebakaran hutan', 1, 1),
(975, 244, 'Tsunami', 0, 1),
(976, 244, 'Angin topan', 0, 1),
(977, 244, 'Tanah longsor', 0, 1),
(978, 245, 'Angin kencang', 0, 1),
(979, 245, 'Gempa laut besar', 1, 1),
(980, 245, 'Hujan deras', 0, 1),
(981, 245, 'Letusan kecil', 0, 1),
(982, 245, 'Erosi', 0, 1),
(983, 246, 'Hidrologi', 0, 1),
(984, 246, 'Meteorologi', 1, 1),
(985, 246, 'Biologi', 0, 1),
(986, 246, 'Geologi', 0, 1),
(987, 246, 'Sosial', 0, 1),
(988, 247, 'Hutan alami', 0, 1),
(989, 247, 'Perkebunan', 1, 1),
(990, 247, 'Sungai', 0, 1),
(991, 247, 'Gunung', 0, 1),
(992, 247, 'Laut', 0, 1),
(993, 248, 'Sungai', 0, 1),
(994, 248, 'Jalan', 1, 1),
(995, 248, 'Danau', 0, 1),
(996, 248, 'Hutan', 0, 1),
(997, 248, 'Gunung', 0, 1),
(998, 249, 'Meteorologi', 1, 1),
(999, 249, 'Sastra', 0, 1),
(1000, 249, 'Musik', 0, 1),
(1001, 249, 'Seni', 0, 1),
(1002, 249, 'Bahasa', 0, 1),
(1003, 250, 'Data cepat diperoleh', 1, 1),
(1004, 250, 'Biaya murah', 0, 1),
(1005, 250, 'Tidak butuh alat', 0, 1),
(1006, 250, 'Tidak butuh tenaga ahli', 0, 1),
(1007, 250, 'Tidak berubah', 0, 1),
(1008, 251, 'Judul', 0, 1),
(1009, 251, 'Skala', 0, 1),
(1010, 251, 'Legenda', 1, 1),
(1011, 251, 'Warna', 0, 1),
(1012, 251, 'Tahun', 0, 1),
(1013, 252, 'Semua informasi', 0, 1),
(1014, 252, 'Informasi khusus', 1, 1),
(1015, 252, 'Bentuk bumi', 0, 1),
(1016, 252, 'Gunung saja', 0, 1),
(1017, 252, 'Sungai saja', 0, 1),
(1018, 253, 'Peta politik', 0, 1),
(1019, 253, 'Peta tanah', 1, 1),
(1020, 253, 'Peta jalan', 0, 1),
(1021, 253, 'Peta laut', 0, 1),
(1022, 253, 'Peta kota', 0, 1),
(1023, 254, 'Transportasi', 1, 1),
(1024, 254, 'Cuaca', 0, 1),
(1025, 254, 'Flora', 0, 1),
(1026, 254, 'Fauna', 0, 1),
(1027, 254, 'Budaya', 0, 1),
(1028, 255, 'Litosfer', 1, 1),
(1029, 255, 'Biosfer', 0, 1),
(1030, 255, 'Hidrosfer', 0, 1),
(1031, 255, 'Atmosfer', 0, 1),
(1032, 255, 'Antroposfer', 0, 1),
(1033, 256, 'Silinder', 1, 1),
(1034, 256, 'Kerucut', 0, 1),
(1035, 256, 'Azimuthal', 0, 1),
(1036, 256, 'Lokal', 0, 1),
(1037, 256, 'Sketsa', 0, 1),
(1038, 257, 'Datar', 0, 1),
(1039, 257, 'Curam', 1, 1),
(1040, 257, 'Rendah', 0, 1),
(1041, 257, 'Landai', 0, 1),
(1042, 257, 'Rata', 0, 1),
(1043, 258, 'Arah', 0, 1),
(1044, 258, 'Jarak', 1, 1),
(1045, 258, 'Warna', 0, 1),
(1046, 258, 'Simbol', 0, 1),
(1047, 258, 'Judul', 0, 1),
(1048, 259, 'CPU', 1, 1),
(1049, 259, 'ArcGIS', 0, 1),
(1050, 259, 'Software', 0, 1),
(1051, 259, 'Data', 0, 1),
(1052, 259, 'Program', 0, 1),
(1053, 260, 'Software', 1, 1),
(1054, 260, 'Hardware', 0, 1),
(1055, 260, 'Brainware', 0, 1),
(1056, 260, 'Data', 0, 1),
(1057, 260, 'Input', 0, 1),
(1058, 261, 'ArcGIS', 1, 1),
(1059, 261, 'CPU', 0, 1),
(1060, 261, 'RAM', 0, 1),
(1061, 261, 'Scanner', 0, 1),
(1062, 261, 'Printer', 0, 1),
(1063, 262, 'Scanner', 1, 1),
(1064, 262, 'ArcGIS', 0, 1),
(1065, 262, 'Data', 0, 1),
(1066, 262, 'Software', 0, 1),
(1067, 262, 'Map', 0, 1),
(1068, 263, 'Input', 1, 1),
(1069, 263, 'Output', 0, 1),
(1070, 263, 'Analisis', 0, 1),
(1071, 263, 'Proses', 0, 1),
(1072, 263, 'Hasil', 0, 1),
(1073, 264, 'Lokasi', 1, 1),
(1074, 264, 'Jumlah', 0, 1),
(1075, 264, 'Angka', 0, 1),
(1076, 264, 'Statistik', 0, 1),
(1077, 264, 'Teks', 0, 1),
(1078, 265, 'Pixel', 1, 1),
(1079, 265, 'Garis', 0, 1),
(1080, 265, 'Titik', 0, 1),
(1081, 265, 'Poligon', 0, 1),
(1082, 265, 'Kurva', 0, 1),
(1083, 266, 'Titik garis poligon', 1, 1),
(1084, 266, 'Pixel', 0, 1),
(1085, 266, 'Warna', 0, 1),
(1086, 266, 'Skala', 0, 1),
(1087, 266, 'Simbol', 0, 1),
(1088, 267, 'Non angka', 1, 1),
(1089, 267, 'Angka', 0, 1),
(1090, 267, 'Grafik', 0, 1),
(1091, 267, 'Statistik', 0, 1),
(1092, 267, 'Rasio', 0, 1),
(1093, 268, 'Angka', 1, 1),
(1094, 268, 'Simbol', 0, 1),
(1095, 268, 'Warna', 0, 1),
(1096, 268, 'Peta', 0, 1),
(1097, 268, 'Lokasi', 0, 1),
(1098, 269, 'Menggabungkan data', 1, 1),
(1099, 269, 'Menghapus data', 0, 1),
(1100, 269, 'Menyimpan data', 0, 1),
(1101, 269, 'Menampilkan data', 0, 1),
(1102, 269, 'Mengedit data', 0, 1),
(1103, 270, 'Mahal', 1, 1),
(1104, 270, 'Cepat', 0, 1),
(1105, 270, 'Mudah', 0, 1),
(1106, 270, 'Akurat', 0, 1),
(1107, 270, 'Praktis', 0, 1),
(1108, 271, 'Analisis cepat', 1, 1),
(1109, 271, 'Mahal', 0, 1),
(1110, 271, 'Sulit', 0, 1),
(1111, 271, 'Lama', 0, 1),
(1112, 271, 'Rumit', 0, 1),
(1113, 272, 'Lingkungan', 1, 1),
(1114, 272, 'Musik', 0, 1),
(1115, 272, 'Seni', 0, 1),
(1116, 272, 'Bahasa', 0, 1),
(1117, 272, 'Sastra', 0, 1),
(1118, 273, 'Lokasi usaha', 1, 1),
(1119, 273, 'Cuaca', 0, 1),
(1120, 273, 'Gempa', 0, 1),
(1121, 273, 'Gunung', 0, 1),
(1122, 273, 'Laut', 0, 1),
(1123, 274, 'Sosial sederhana', 1, 1),
(1124, 274, 'Kompleks', 0, 1),
(1125, 274, 'Modern', 0, 1),
(1126, 274, 'Industri', 0, 1),
(1127, 274, 'Padat', 0, 1),
(1128, 275, 'Homogen', 1, 1),
(1129, 275, 'Heterogen', 0, 1),
(1130, 275, 'Modern', 0, 1),
(1131, 275, 'Individual', 0, 1),
(1132, 275, 'Kompleks', 0, 1),
(1133, 276, 'Swasembada', 1, 1),
(1134, 276, 'Tradisional', 0, 1),
(1135, 276, 'Terbelakang', 0, 1),
(1136, 276, 'Kuno', 0, 1),
(1137, 276, 'Tertinggal', 0, 1),
(1138, 277, 'Wilayah', 1, 1),
(1139, 277, 'Warna', 0, 1),
(1140, 277, 'Gambar', 0, 1),
(1141, 277, 'Lukisan', 0, 1),
(1142, 277, 'Tulisan', 0, 1),
(1143, 278, 'Memanjang', 0, 1),
(1144, 278, 'Mengelompok', 1, 1),
(1145, 278, 'Menyebar', 0, 1),
(1146, 278, 'Acak', 0, 1),
(1147, 278, 'Lurus', 0, 1),
(1148, 279, 'Perbukitan', 1, 1),
(1149, 279, 'Laut', 0, 1),
(1150, 279, 'Kota', 0, 1),
(1151, 279, 'Dataran', 0, 1),
(1152, 279, 'Sungai', 0, 1),
(1153, 280, 'Heterogen', 1, 1),
(1154, 280, 'Homogen', 0, 1),
(1155, 280, 'Tradisional', 0, 1),
(1156, 280, 'Sederhana', 0, 1),
(1157, 280, 'Agraris', 0, 1),
(1158, 281, 'Wilayah', 1, 1),
(1159, 281, 'Gedung', 0, 1),
(1160, 281, 'Jalan', 0, 1),
(1161, 281, 'Pabrik', 0, 1),
(1162, 281, 'Mall', 0, 1),
(1163, 282, 'Bangunan padat', 1, 1),
(1164, 282, 'Sawah luas', 0, 1),
(1165, 282, 'Hutan', 0, 1),
(1166, 282, 'Sungai besar', 0, 1),
(1167, 282, 'Ladang', 0, 1),
(1168, 283, 'Banjir bandang', 1, 1),
(1169, 283, 'Air jernih', 0, 1),
(1170, 283, 'Tidak berubah', 0, 1),
(1171, 283, 'Air sedikit', 0, 1),
(1172, 283, 'Tanah subur', 0, 1),
(1173, 284, 'A letter to a close friend', 1, 1),
(1174, 284, 'A report for school', 0, 1),
(1175, 284, 'A business proposal', 0, 1),
(1176, 284, 'A meeting note', 0, 1),
(1177, 284, 'A news article', 0, 1),
(1178, 285, 'I think it is interesting', 1, 1),
(1179, 285, 'I went there yesterday', 0, 1),
(1180, 285, 'It belongs to me', 0, 1),
(1181, 285, 'I am going soon', 0, 1),
(1182, 285, 'That is correct', 0, 1),
(1183, 286, 'Personal letter', 1, 1),
(1184, 286, 'Advertisement', 0, 1),
(1185, 286, 'Announcement', 0, 1),
(1186, 286, 'Procedure text', 0, 1),
(1187, 286, 'Report text', 0, 1),
(1188, 287, 'To share personal news', 1, 1),
(1189, 287, 'To promote products', 0, 1),
(1190, 287, 'To inform public', 0, 1),
(1191, 287, 'To explain steps', 0, 1),
(1192, 287, 'To describe object', 0, 1),
(1193, 288, 'Yes, please help me', 1, 1),
(1194, 288, 'I don&rsquo;t think so', 0, 1),
(1195, 288, 'Maybe later', 0, 1),
(1196, 288, 'I am fine here', 0, 1),
(1197, 288, 'That is wrong', 0, 1),
(1198, 289, 'Giving advice', 1, 1),
(1199, 289, 'Asking question', 0, 1),
(1200, 289, 'Giving opinion', 0, 1),
(1201, 289, 'Refusing help', 0, 1),
(1202, 289, 'Offering help', 0, 1),
(1203, 290, 'I will open the window', 1, 1),
(1204, 290, 'I closed it yesterday', 0, 1),
(1205, 290, 'It is always hot', 0, 1),
(1206, 290, 'I don&rsquo;t like heat', 0, 1),
(1207, 290, 'It looks strange', 0, 1),
(1208, 291, 'I think train is faster', 1, 1),
(1209, 291, 'I took bus yesterday', 0, 1),
(1210, 291, 'I like travelling', 0, 1),
(1211, 291, 'Both are good', 0, 1),
(1212, 291, 'I go by car', 0, 1),
(1213, 292, 'I plan to visit my family', 1, 1),
(1214, 292, 'I went there last week', 0, 1),
(1215, 292, 'I don&rsquo;t like weekend', 0, 1),
(1216, 292, 'It is not mine', 0, 1),
(1217, 292, 'That is fine', 0, 1),
(1218, 293, 'Yes, I enjoy it', 1, 1),
(1219, 293, 'I go there', 0, 1),
(1220, 293, 'That is yours', 0, 1),
(1221, 293, 'I was there', 0, 1),
(1222, 293, 'It is good', 0, 1),
(1223, 294, 'Passive voice', 1, 1),
(1224, 294, 'Active voice', 0, 1),
(1225, 294, 'Simple past', 0, 1),
(1226, 294, 'Future tense', 0, 1),
(1227, 294, 'Present tense', 0, 1),
(1228, 295, 'I was helped by her', 1, 1),
(1229, 295, 'I help her', 0, 1),
(1230, 295, 'She was helped', 0, 1),
(1231, 295, 'I helping her', 0, 1),
(1232, 295, 'She helps me', 0, 1),
(1233, 296, 'Rice is being eaten', 1, 1),
(1234, 296, 'Rice is eaten', 0, 1),
(1235, 296, 'Rice was eaten', 0, 1),
(1236, 296, 'Rice eats him', 0, 1),
(1237, 296, 'He eats rice', 0, 1),
(1238, 297, 'You should rest', 1, 1),
(1239, 297, 'You must run', 0, 1),
(1240, 297, 'You eat more', 0, 1),
(1241, 297, 'You work more', 0, 1),
(1242, 297, 'You sleep late', 0, 1),
(1243, 298, 'That sounds good', 1, 1),
(1244, 298, 'I was there', 0, 1),
(1245, 298, 'I go now', 0, 1),
(1246, 298, 'That is mine', 0, 1),
(1247, 298, 'I don&rsquo;t know', 0, 1),
(1248, 299, 'Job opportunity', 1, 1),
(1249, 299, 'Personal story', 0, 1),
(1250, 299, 'News report', 0, 1),
(1251, 299, 'Invitation', 0, 1),
(1252, 299, 'Letter', 0, 1),
(1253, 300, 'Persuade readers', 1, 1),
(1254, 300, 'Entertain readers', 0, 1),
(1255, 300, 'Tell stories', 0, 1),
(1256, 300, 'Describe place', 0, 1),
(1257, 300, 'Explain steps', 0, 1),
(1258, 301, 'Advice', 1, 1),
(1259, 301, 'Opinion', 0, 1),
(1260, 301, 'Question', 0, 1),
(1261, 301, 'Offer', 0, 1),
(1262, 301, 'Refusal', 0, 1),
(1263, 302, 'study hard', 1, 1),
(1264, 302, 'studying', 0, 1),
(1265, 302, 'studied', 0, 1),
(1266, 302, 'study', 0, 1),
(1267, 302, 'studies', 0, 1),
(1268, 303, 'Suggestion', 1, 1),
(1269, 303, 'Question', 0, 1),
(1270, 303, 'Statement', 0, 1),
(1271, 303, 'Answer', 0, 1),
(1272, 303, 'Command', 0, 1),
(1273, 304, 'You should practice more', 1, 1),
(1274, 304, 'I don&rsquo;t like English', 0, 1),
(1275, 304, 'It is very hard', 0, 1),
(1276, 304, 'I was there', 0, 1),
(1277, 304, 'That is mine', 0, 1),
(1278, 305, 'I might visit my uncle', 1, 1),
(1279, 305, 'I went there', 0, 1),
(1280, 305, 'It is my place', 0, 1),
(1281, 305, 'I like holiday', 0, 1),
(1282, 305, 'That is fine', 0, 1),
(1283, 306, 'I think it is interesting', 1, 1),
(1284, 306, 'I watched it', 0, 1),
(1285, 306, 'It is mine', 0, 1),
(1286, 306, 'I go there', 0, 1),
(1287, 306, 'That is yours', 0, 1),
(1288, 307, 'I agree with you', 1, 1),
(1289, 307, 'I went yesterday', 0, 1),
(1290, 307, 'It is mine', 0, 1),
(1291, 307, 'I go there', 0, 1),
(1292, 307, 'That is fine', 0, 1),
(1293, 308, 'You should take a rest', 1, 1),
(1294, 308, 'I like it', 0, 1),
(1295, 308, 'I went there', 0, 1),
(1296, 308, 'It is mine', 0, 1),
(1297, 308, 'That is good', 0, 1),
(1298, 309, 'make', 1, 1),
(1299, 309, 'break', 0, 1),
(1300, 309, 'lose', 0, 1),
(1301, 309, 'stop', 0, 1),
(1302, 309, 'leave', 0, 1),
(1303, 310, 'clean', 1, 1),
(1304, 310, 'dark', 0, 1),
(1305, 310, 'small', 0, 1),
(1306, 310, 'bad', 0, 1),
(1307, 310, 'weak', 0, 1),
(1308, 311, 'Procedure text', 1, 1),
(1309, 311, 'Narrative text', 0, 1),
(1310, 311, 'Report text', 0, 1),
(1311, 311, 'Recount text', 0, 1),
(1312, 311, 'News item', 0, 1),
(1313, 312, 'reputation', 1, 1),
(1314, 312, 'problem', 0, 1),
(1315, 312, 'place', 0, 1),
(1316, 312, 'thing', 0, 1),
(1317, 312, 'action', 0, 1),
(1318, 313, 'That sounds good', 1, 1),
(1319, 313, 'I was there', 0, 1),
(1320, 313, 'It is mine', 0, 1),
(1321, 313, 'I go now', 0, 1),
(1322, 313, 'That is yours', 0, 1),
(1323, 314, 'Let&rsquo;s go to library', 1, 1),
(1324, 314, 'I went there', 0, 1),
(1325, 314, 'It is mine', 0, 1),
(1326, 314, 'I go there', 0, 1),
(1327, 314, 'That is fine', 0, 1),
(1328, 315, 'Would', 1, 1),
(1329, 315, 'Do', 0, 1),
(1330, 315, 'Did', 0, 1),
(1331, 315, 'Does', 0, 1),
(1332, 315, 'Done', 0, 1),
(1333, 316, 'I will help you', 1, 1),
(1334, 316, 'I go there', 0, 1),
(1335, 316, 'It is mine', 0, 1),
(1336, 316, 'I was busy', 0, 1),
(1337, 316, 'That is fine', 0, 1),
(1338, 317, 'I will turn on the fan', 1, 1),
(1339, 317, 'I went there', 0, 1),
(1340, 317, 'It is mine', 0, 1),
(1341, 317, 'I go there', 0, 1),
(1342, 317, 'That is fine', 0, 1),
(1343, 318, 'Sounds great', 1, 1),
(1344, 318, 'I was there', 0, 1),
(1345, 318, 'It is mine', 0, 1),
(1346, 318, 'I go there', 0, 1),
(1347, 318, 'That is yours', 0, 1),
(1348, 319, 'That is too bad', 1, 1),
(1349, 319, 'I go there', 0, 1),
(1350, 319, 'It is mine', 0, 1),
(1351, 319, 'I was happy', 0, 1),
(1352, 319, 'That is fine', 0, 1),
(1353, 320, 'Offering help', 1, 1),
(1354, 320, 'Giving advice', 0, 1),
(1355, 320, 'Asking question', 0, 1),
(1356, 320, 'Refusing', 0, 1),
(1357, 320, 'Ordering', 0, 1),
(1358, 321, 'That&rsquo;s a good idea', 1, 1),
(1359, 321, 'I was there', 0, 1),
(1360, 321, 'It is mine', 0, 1),
(1361, 321, 'I go now', 0, 1),
(1362, 321, 'That is yours', 0, 1),
(1363, 322, 'because of', 1, 1),
(1364, 322, 'but', 0, 1),
(1365, 322, 'so', 0, 1),
(1366, 322, 'then', 0, 1),
(1367, 322, 'or', 0, 1),
(1368, 323, 'because', 1, 1),
(1369, 323, 'before', 0, 1),
(1370, 323, 'beside', 0, 1),
(1371, 323, 'between', 0, 1),
(1372, 323, 'beyond', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_konfigurasi`
--

CREATE TABLE `cbt_konfigurasi` (
  `konfigurasi_id` int(11) NOT NULL,
  `konfigurasi_kode` varchar(50) NOT NULL,
  `konfigurasi_isi` varchar(500) NOT NULL,
  `konfigurasi_keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cbt_konfigurasi`
--

INSERT INTO `cbt_konfigurasi` (`konfigurasi_id`, `konfigurasi_kode`, `konfigurasi_isi`, `konfigurasi_keterangan`) VALUES
(1, 'link_login_operator', 'tidak', 'Menampilkan Link Login Operator'),
(2, 'cbt_nama', 'Ujian Berbasis Komputer', 'Nama Penyelenggara ZYACBT'),
(3, 'cbt_keterangan', 'GHCBT System', 'Keterangan Penyelenggara ZYACBT'),
(4, 'cbt_mobile_lock_xambro', 'tidak', 'Melakukan Lock pada browser mobile agar menggunakan Xambro Saja'),
(5, 'cbt_informasi', '<p>Selamat datang di Aplikasi Ujian Berbasis Komputer. Hubungi proktor apabila anda mengalami kesulitan login.</p>', 'Informasi yang diberika di Dashboard peserta tes\''),
(6, 'proteksi_multilogin', 'ya', 'Proteksi MultiLogin Peserta Tes'),
(7, 'cbt_tutuptes_logout', 'tidak', 'Menutup Tes Peserta saat Peserta Logout'),
(8, 'cbt_nama_madrasah', 'Nama Sekolah / Institusi', 'Nama Madrasah Penyelenggara'),
(9, 'cbt_tahun_ajaran', '2026/2027', 'Tahun Ajaran Pelaksanaan'),
(10, 'cbt_kepala_madrasah', 'Nama Kepala Sekolah, S.Pd.', 'Nama Kepala Madrasah untuk TTD Kartu'),
(11, 'cbt_tempat_cetak', 'Kota / Kabupaten', 'Tempat pencetakan kartu'),
(12, 'cbt_show_history', 'ya', 'Menampilkan Histori Ujian Siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_license_history`
--

CREATE TABLE `cbt_license_history` (
  `id` int(11) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `device_id` varchar(100) NOT NULL,
  `activation_key` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `cbt_license_history`
--

INSERT INTO `cbt_license_history` (`id`, `client_name`, `device_id`, `activation_key`, `created_at`) VALUES
(1, 'MI MIFTAHUL HUDA', 'B99834BC19BBAD24', '52084B4F4798AAD00AA297A57BBD4616', '2026-04-19 13:16:14'),
(2, 'MTs Al Ikhlas', 'E4861D885666FAA8', 'A899A69CE05F878B19E0C45C5FF9D07E', '2026-04-21 12:00:21'),
(3, 'MAMHCBT', '9F759574D44AD349', 'AE543165FB1D7798507019A50BB3C7CC', '2026-04-22 10:32:58'),
(5, 'CBTMAMH', '9F759574D44AD349', 'AE543165FB1D7798507019A50BB3C7CC', '2026-04-22 14:49:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_modul`
--

CREATE TABLE `cbt_modul` (
  `modul_id` bigint(20) UNSIGNED NOT NULL,
  `modul_nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modul_aktif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cbt_modul`
--

INSERT INTO `cbt_modul` (`modul_id`, `modul_nama`, `modul_aktif`) VALUES
(9, 'SAS GENAP 2025/2026', 1),
(10, 'AM 2025/2026', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_sessions`
--

CREATE TABLE `cbt_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `cbt_sessions`
--

INSERT INTO `cbt_sessions` (`id`, `ip_address`, `timestamp`, `data`, `ts`) VALUES
('8imnt7o9iphmu4kicop9ausus8i3lfdm', '::1', 1776896079, '', '2026-04-22 22:10:55'),
('ukb5cpkn9vlmlenar2a0igfncc13rupc', '::1', 1776897248, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737363838303433393b6362745f757365725f69647c733a353a2261646d696e223b6362745f6e616d617c733a31333a2241646d696e6973747261746f72223b6362745f6c6576656c7c733a353a2261646d696e223b6362745f666f746f7c733a303a22223b6362745f6f707369317c733a303a22223b6362745f6f707369327c733a303a22223b, '2026-04-22 17:53:59'),
('vbvclnte2kfon24ch5u016ksgear26a9', '::1', 1776897254, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737363837393434363b6362745f757365725f69647c733a353a2261646d696e223b6362745f6e616d617c733a31333a2241646d696e6973747261746f72223b6362745f6c6576656c7c733a353a2261646d696e223b6362745f666f746f7c733a303a22223b6362745f6f707369317c733a303a22223b6362745f6f707369327c733a303a22223b, '2026-04-22 17:37:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_soal`
--

CREATE TABLE `cbt_soal` (
  `soal_id` bigint(20) UNSIGNED NOT NULL,
  `soal_topik_id` bigint(20) UNSIGNED NOT NULL,
  `soal_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `soal_tipe` smallint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Pilihan ganda, 2=essay, 3=jawaban singkat',
  `soal_kunci` text COLLATE utf8_unicode_ci COMMENT 'Kunci untuk soal jawaban singkat',
  `soal_difficulty` smallint(6) NOT NULL DEFAULT '1',
  `soal_aktif` tinyint(1) NOT NULL DEFAULT '0',
  `soal_audio` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `soal_audio_play` int(11) NOT NULL DEFAULT '0',
  `soal_timer` smallint(10) DEFAULT NULL,
  `soal_inline_answers` tinyint(1) NOT NULL DEFAULT '0',
  `soal_auto_next` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cbt_soal`
--

INSERT INTO `cbt_soal` (`soal_id`, `soal_topik_id`, `soal_detail`, `soal_tipe`, `soal_kunci`, `soal_difficulty`, `soal_aktif`, `soal_audio`, `soal_audio_play`, `soal_timer`, `soal_inline_answers`, `soal_auto_next`) VALUES
(14, 1, 'Manakah yang termasuk hewan mamalia?', 5, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(15, 1, 'Pilih yang termasuk warna primer', 5, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(16, 1, 'Manakah yang termasuk transportasi darat', 5, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(17, 1, 'Pilih yang termasuk bilangan genap', 5, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(18, 1, 'Manakah yang termasuk buah-buahan', 5, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(19, 1, 'Pilih yang termasuk benda hidup', 5, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(20, 1, 'Manakah yang termasuk alat tulis', 5, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(21, 1, 'Pilih yang termasuk olahraga', 5, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(22, 1, 'Manakah yang termasuk anggota tubuh', 5, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(23, 1, 'Pilih yang termasuk hari', 5, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(24, 1, 'Matahari terbit dari timur', 6, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(25, 1, 'Air berwarna merah secara alami', 6, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(26, 1, 'Manusia membutuhkan oksigen untuk bernapas', 6, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(27, 1, 'Ikan hidup di darat', 6, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(28, 1, '2 + 2 = 4', 6, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(29, 1, 'Burung bisa terbang', 6, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(30, 1, 'Api terasa dingin', 6, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(31, 1, 'Bumi berbentuk bulat', 6, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(32, 1, 'Tumbuhan tidak membutuhkan air', 6, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(33, 1, 'Sepeda memiliki dua roda', 6, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(34, 1, 'Pasangkan negara dengan ibu kotanya!', 4, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(35, 1, 'Pasangkan hewan dengan makanannya!', 4, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(36, 1, 'Pasangkan anggota tubuh dengan fungsinya!', 4, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(37, 1, 'Pasangkan warna dengan bendanya!', 4, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(38, 1, 'Pasangkan alat dengan fungsinya!', 4, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(39, 1, 'Pasangkan hari dengan urutannya!', 4, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(40, 1, 'Pasangkan benda dengan bentuknya!', 4, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(41, 1, 'Pasangkan profesi dengan tempat kerjanya!', 4, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(42, 1, 'Pasangkan benda dengan kegunaannya!', 4, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(43, 1, 'Pasangkan angka dengan namanya!', 4, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(44, 1, 'Ibu kota Indonesia adalah ____', 3, 'Jakarta', 1, 1, NULL, 0, NULL, 0, 0),
(45, 1, '2 + 3 = ____', 3, '5', 1, 1, NULL, 0, NULL, 0, 0),
(46, 1, 'Hewan yang bisa terbang adalah ____', 3, 'Burung', 1, 1, NULL, 0, NULL, 0, 0),
(47, 1, 'Warna daun adalah ____', 3, 'Hijau', 1, 1, NULL, 0, NULL, 0, 0),
(48, 1, 'Alat untuk menulis adalah ____', 3, 'Pensil', 1, 1, NULL, 0, NULL, 0, 0),
(49, 1, 'Air digunakan untuk ____', 3, 'Minum', 1, 1, NULL, 0, NULL, 0, 0),
(50, 1, 'Kita bernafas menggunakan ____', 3, 'Hidung', 1, 1, NULL, 0, NULL, 0, 0),
(51, 1, 'Hari setelah Senin adalah ____', 3, 'Selasa', 1, 1, NULL, 0, NULL, 0, 0),
(52, 1, 'Nama planet tempat kita tinggal adalah ____', 3, 'Bumi', 1, 1, NULL, 0, NULL, 0, 0),
(53, 1, 'Lawan kata panas adalah ____', 3, 'Dingin', 1, 1, NULL, 0, NULL, 0, 0),
(54, 1, 'Jelaskan apa yang dimaksud dengan hewan mamalia!', 2, 'Hewan yang menyusui anaknya', 1, 1, NULL, 0, NULL, 0, 0),
(55, 1, 'Sebutkan 3 contoh alat transportasi darat!', 2, 'Mobil, motor, sepeda', 1, 1, NULL, 0, NULL, 0, 0),
(56, 1, 'Jelaskan fungsi air bagi kehidupan manusia!', 2, 'Untuk minum, mandi, mencuci', 1, 1, NULL, 0, NULL, 0, 0),
(57, 1, 'Apa yang dimaksud dengan tumbuhan?', 2, 'Makhluk hidup yang dapat membuat makanan sendiri', 1, 1, NULL, 0, NULL, 0, 0),
(58, 1, 'Sebutkan 3 warna primer!', 2, 'Merah, kuning, biru', 1, 1, NULL, 0, NULL, 0, 0),
(59, 1, 'Jelaskan apa fungsi mata!', 2, 'Untuk melihat', 1, 1, NULL, 0, NULL, 0, 0),
(60, 1, 'Apa yang dimaksud dengan olahraga?', 2, 'Kegiatan fisik untuk menjaga kesehatan', 1, 1, NULL, 0, NULL, 0, 0),
(61, 1, 'Sebutkan 3 contoh hewan yang hidup di air!', 2, 'Ikan, udang, paus', 1, 1, NULL, 0, NULL, 0, 0),
(62, 1, 'Jelaskan pentingnya belajar bagi siswa!', 2, 'Agar mendapatkan ilmu dan pengetahuan', 1, 1, NULL, 0, NULL, 0, 0),
(63, 1, 'Apa yang dimaksud dengan lingkungan bersih?', 2, 'Lingkungan yang bebas dari sampah dan kotoran', 1, 1, NULL, 0, NULL, 0, 0),
(64, 1, 'Ibu kota Indonesia adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(65, 1, '2 + 5 = ...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(66, 1, 'Hewan yang bisa terbang adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(67, 1, 'Warna daun adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(68, 1, 'Alat untuk menulis adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(69, 1, 'Planet tempat kita tinggal adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(70, 1, 'Air digunakan untuk...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(71, 1, 'Hari setelah Senin adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(72, 1, 'Lawan kata panas adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(73, 1, 'Hewan yang hidup di air adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(74, 1, 'Arti dari kata \"&#1603;&#1578;&#1575;&#1576;\" adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(75, 1, 'Arti dari \"&#1605;&#1583;&#1585;&#1587;&#1577;\" adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(76, 1, '&radic;25 = ...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(77, 1, '&radic;36 = ...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(78, 1, '1/2 + 1/2 = ...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(79, 1, 'Arti dari \"&#1602;&#1604;&#1605;\" adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(80, 1, 'Huruf dengan tanda seperti ini \"&aacute;\" dibaca...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(81, 1, '&radic;49 = ...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(82, 1, 'Arti dari \"&#1576;&#1610;&#1578;\" adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(83, 1, '3&sup2; = ...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(84, 1, 'Arti dari \"&#1605;&#1575;&#1569;\" adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(85, 1, '&radic;16 = ...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(86, 1, 'Huruf \"&ntilde;\" dibaca...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(87, 1, '10 &divide; 2 = ...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(88, 1, 'Arti dari \"&#1588;&#1605;&#1587;\" adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(89, 1, '&radic;64 = ...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(90, 1, '5&sup2; = ...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(91, 1, 'Huruf \"&eacute;\" dibaca...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(92, 1, 'Arti dari \"&#1602;&#1605;&#1585;\" adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(93, 1, '100 &divide; 10 = ...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(94, 1, '<p style=\"text-align:justify\">Berita hoaks dapat menjadi salah satu faktor utama keretakan hubungan sosial dalam masyarakat. Berita hoaks sulit diketahui kebenarannya karena sangat meyakinkan pembaca. Sikap yang harus dimiliki untuk mencegah keretakan sosial akibat berita hoaks adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(95, 1, '<p style=\"text-align:justify\">Perhatikan ilustrasi berikut! </p><p style=\"text-align:justify\">Dalam rangka memperingati hari ulang tahun SMP Wijaya Kusuma, OSIS menggerakkan kegiatan bakti sosial. Kegiatan ini dapat dilaksanakan melalui Pramuka, PMR, dan PKS. Sekolah mengadakan kegiatan tersebut dengan pidato. </p><p style=\"text-align:justify\">Kalimat pembuka pidato yang sesuai ilustrasi adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(96, 1, '<p style=\"text-align:justify\">&ldquo;Melarang anak memiliki akun Facebook bukanlah cara yang bijak karena bisa saja anak lari ke rumah temannya atau warnet yang bertebaran dan membuat akun sendiri. Apa pun keputusan orang tua tentang Facebook, cobalah untuk membuat keputusan dan kesepakatan bersama anak sebelum membuat akun.&rdquo; </p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Kutipan teks diskusi tersebut termasuk struktur ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(97, 1, '<p style=\"text-align:justify\">Teks diskusi terdiri atas struktur pendahuluan, isi, dan simpulan. Tulisan yang pembahasannya searah, setuju, dan bersifat mendukung topik yang menjadi pembahasan dalam teks diskusi disebut ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(98, 1, '<p style=\"text-align:justify\">Di bawah ini yang termasuk pengertian teks argumentasi adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(99, 1, '<p style=\"text-align:justify\">Opini penulis dalam teks argumentasi harus dilengkapi ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(100, 1, '<p style=\"text-align:justify\">Berikut yang tidak termasuk kriteria suatu masalah agar menarik untuk didiskusikan adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(101, 1, '<p style=\"text-align:justify\">Bacalah paragraf berikut! </p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Keberadaan internet memberikan manfaat positif bagi dunia informasi, tetapi juga banyak pengaruh negatifnya. Banyak murid yang mendapatkan ilmu dengan bantuan internet. Bahkan, tugas sekolah pun kini terasa lebih mudah dengan mencarinya di internet. </p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Paragraf di atas adalah struktur teks diskusi bagian ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(102, 1, '<p style=\"text-align:justify\">Bacalah teks berikut!</p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Pada zaman sekarang kekuatan teknologi tidak bisa dibendung. Banyak hal baru yang bisa dijumpai pada zaman yang maju ini, salah satunya gim atau permainan virtual. Pertanyaannya, apakah dampak buruk yang timbul akibat permainan ini? Sebagian besar masyarakat menganggap bermain gim termasuk hal yang wajar, namun tidak sedikit yang menganggapnya berdampak buruk.</p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Paragraf di atas merupakan bagian .... teks diskusi.</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(103, 1, '<p style=\"text-align:justify\">Masalah yang dibahas dalam teks diskusi tersebut adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(104, 1, '<p style=\"text-align:justify\">Isu bertema pendidikan yang dapat ditulis menjadi teks diskusi adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(105, 1, '<p style=\"text-align:justify\">Bacalah puisi berikut!</p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Titik-titik rahmat-Mu</p><p style=\"text-align:justify\">Turun memberkahi bumiku</p><p style=\"text-align:justify\">Singgah pada kuntum mawarku</p><p style=\"text-align:justify\">Menimpa atap rumahku</p><p style=\"text-align:justify\">Menerpa payung dan jas hujanku</p><p style=\"text-align:justify\">Akhirnya</p><p style=\"text-align:justify\">Berserilah hari-hariku</p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Kalimat bermajas pengganti baris keempat puisi tersebut adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(106, 1, '<p style=\"text-align:justify\">Majas yang memakai kata atau kelompok kata yang mengacu pada suatu objek, tetapi bukan dengan arti yang sebenarnya adalah majas ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(107, 1, '<p style=\"text-align:justify\">Gunung tinggi dipeluk awan</p><p style=\"text-align:justify\">Berteduh langit malam dan siang</p><p style=\"text-align:justify\">Terdengar kampung memanggil tautan</p><p style=\"text-align:justify\">Rasakan hancur tulang belulang</p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Isi puisi tersebut adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(108, 1, '<p style=\"text-align:justify\">Bacalah puisi berikut!</p><p style=\"text-align:justify\">Ibu, Senyummu bagai mentari yang sinari hariku</p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Majas yang terdapat dalam puisi tersebut adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(109, 1, '<p style=\"text-align:justify\">Banyak spesies hewan laut unik seperti wobbegong (sejenis ikan sotong/cumi-cumi), kuda laut mini, bahkan ikan-ikan besar, seperti hiu, ikan pari manta, dan ikan duyung yang legendaris.</p><p style=\"text-align:justify\">&nbsp;Makna kata legendaris adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(110, 1, '<p style=\"text-align:justify\">Bacalah teks berikut! </p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Status Indonesia sebagai negara kepulauan telah ditetapkan sejak Deklarasi Djuanda pada tahun 1957 dan diperkuat dengan Konvensi Hukum Laut (UNCLOS). Indonesia memiliki sekitar 17.500 pulau, bergaris pantai sepanjang 81.000 km. Sekitar 62% luas wilayah Indonesia adalah laut dan perairan. Hal ini dikonfirmasi dari data KKP, luas wilayah daratan sebesar 1,91 juta km&sup2;, sedangkan luas wilayah perairan mencapai 6,32 juta km&sup2;. </p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Indonesia merupakan negara ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(111, 1, '<p style=\"text-align:justify\">Informasi yang sesuai teks di atas adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(112, 1, '<p style=\"text-align:justify\">Bacalah teks laporan berikut! </p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Tradisi sasi biasa dilakukan oleh masyarakat Maluku dan Papua di daerahnya masing-masing. Tradisi sasi menerapkan periodisasi yang menentukan waktu masyarakat boleh dan tidak boleh menangkap serta memanfaatkan hasil laut. Durasi &ldquo;buka-tutup&rdquo; laut ini pun bervariasi tergantung kebutuhan di setiap wilayah. Ada yang melakukan penutupan selama 3 bulan, 6 bulan, 2 tahun, bahkan 4 tahun. Jika selama larangan ini ada yang melanggar, ia akan dikenakan denda. Dengan begitu, kekayaan laut di wilayah tersebut pun bisa dipastikan akan tetap lestari dan tidak rusak di tangan nakal manusia.</p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Makna kata tradisi pada teks laporan tersebut adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(113, 1, '<p style=\"text-align:justify\">Pernyataan yang tidak tepat sesuai teks laporan adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(114, 1, '<p style=\"text-align:justify\">Bacalah paragraf berikut! </p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Lamun hidup di perairan yang dangkal dan jernih. Lamun dapat tumbuh dengan baik di lingkungan laut di daerah pesisir dan lingkungan laut pantai. Lamun akan rusak karena banyak perairan keruh karena banyak tertutup es.</p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Makna kata sedang pada penggalan teks di atas adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(115, 1, '<p style=\"text-align:justify\">Bacalah puisi berikut!</p><p style=\"text-align:justify\">Cermin</p><p style=\"text-align:justify\">Karya Sapardi Djoko Damono</p><p style=\"text-align:justify\">Cermin, tak pernah berteriak, ia pun tak pernah meraung,</p><p style=\"text-align:justify\">tersedak, atau terisak</p><p style=\"text-align:justify\">Meski apa pun yang terbalik di dalamnya</p><p style=\"text-align:justify\">Barangkali ia hanya bisa bertanya:</p><p style=\"text-align:justify\">Mengapa kau seperti kehabisan suara?</p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Majas pada baris keempat adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(116, 1, '<p style=\"text-align:justify\">Suasana dalam puisi tersebut adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(117, 1, '<p style=\"text-align:justify\">Makna kata cermin pada baris pertama puisi tersebut adalah ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(118, 1, '<p style=\"text-align:justify\">Bacalah puisi berikut!</p><p style=\"text-align:justify\">Kutulis surat ini</p><p style=\"text-align:justify\">Kala hujan gerimis</p><p style=\"text-align:justify\">Bagai bunyi tabur mainan</p><p style=\"text-align:justify\">Anak peri dunia yang gaib</p><p style=\"text-align:justify\">Dan angin yang mendesah</p><p style=\"text-align:justify\">Mengeluh dan mendesah</p><p style=\"text-align:justify\"><br></p><p style=\"text-align:justify\">Majas simile terdapat pada larik ....</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(119, 1, '<p>Bait puisi rakyat biasanya berisi tentang &hellip;</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(120, 1, '<p>Berbaktilah kamu kepada ibumu</p><p>Niscaya Tuhan akan memberimu</p><p>Gurindam di atas berisi tentang &hellip; </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(121, 1, '<p>Maksud dan tujuan dalam struktur pantun disebut &hellip; </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(122, 1, '<p>Jangan menunda pekerjaan</p><p>Hindari menyia-nyiakan waktu</p><p>Larik tersebut menggunakan kalimat &hellip; </p><p><br></p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(123, 1, '<p>Perhatikan pantun berikut!</p><p>Aduh-aduh si bunga &hellip; (1)</p><p>Daunnya lebat &hellip; (2)</p><p>Aku sering mendengar &hellip; (3)</p><p>Adik punya sahabat &hellip; (4)</p><p><br></p><p>Kata yang tepat untuk melengkapi pantun tersebut adalah &hellip; a. (1) anggrek, (2) hujan, (3) lagu, (4) dayang</p><p><br></p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(124, 1, '<p>Ciri orientasi pada cerita fantasi adalah &hellip; </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(125, 1, '<p>Cerita fantasi yang mengisahkan kisah pada satu masa saja disebut &hellip; </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(126, 1, '<p>Jenis cerita imajinasi, semua yang terdapat pada cerita tidak terjadi dalam dunia nyata disebut &hellip; </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(127, 1, '<p>Perhatikan pantun empat baris di bawah ini!</p><p>Menanam padi tumbuh ilalang</p><p>Hendaklah menanam jarang-jarang</p><p>Sedih hati melihat abang</p><p>Susah shalat bukan kepalang</p><p>Kalimat dari pantun tersebut yang merupakan isi adalah &hellip; </p><p><br></p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(128, 1, '<p>Perhatikan pantun berikut ini!</p><p>Katak lompat di pinggir kali</p><p>Sambil bernyanyi merdu sekali</p><p>Hati riang tidak terperi</p><p>Ibunda datang membawa kari</p><p>Pantun tersebut berpola &hellip; </p><p><br></p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(129, 1, '<p>Perhatikan hal-hal berikut!</p><p>(I) pengamatan</p><p>(II) pemikiran sendiri</p><p>(III) bersifat objektif</p><p>Manakah yang termasuk isi teks laporan hasil observasi &hellip;</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(130, 1, '<p>Langkah pertama dalam membuat teks laporan hasil observasi adalah &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(131, 1, '<p>Teks laporan hasil observasi ditulis berdasarkan &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(132, 1, '<p>Langkah-langkah menyunting laporan hasil observasi berikut ini yang benar adalah &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(133, 1, '<p style=\"text-align:justify\">Harimau dapat mencapai tinggi 1,5 meter, panjang 3,3 meter, dan berat 300 kilogram. Bulunya berwarna putih dan coklat keemasan dengan belang atau loreng berwarna hitam. Gigi taringnya kuat dan tajam untuk mengoyak daging. Kakinya berjumlah empat dengan cakar yang kuat untuk mencengkeram mangsanya.</p><p>Teks laporan di atas berbentuk &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(134, 1, '<p>Perhatikan kutipan teks laporan hasil berikut ini untuk soal 41-42!</p><p><br></p><p style=\"text-align:center\">MUSEUM</p><p style=\"text-align:justify\">Museum merupakan salah satu tempat penting&nbsp; dalam upaya pelestarian sejarah (1). Museum adalah lembaga yang berfungfi mengumpulkan, merawat, menyajikan serta melestarikan&nbsp; warisan budaya masyarakat untuk tujuan studi, penelitian, kesenangan atau hiburan (2). Fungsi museum utama adalah menyimpan , merawat mengamankan, dan memanfaatkan koleksi museum&nbsp; beruba benda cagar budaya (3) dengan demikian, museum memiliki fungsi besar yaitu sebagai tempat pelestarian(4).</p><p><br></p><p>Objek yang sedang dibahas dalam teks di atas adalah &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(135, 1, '<p>Ciri bahasa teks laporan hasil observasi yang terdapat kutipan teks museum di atas adalah &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(136, 1, '<p>Kalimat definisi yang terdapat pada kutipan teks museum di atas ditandai dengan nomor, kecuali &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(137, 1, '<p>Kalimat utama dalam teks museum di atas ditandai dengan nomor &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(138, 1, '<p>Kalimat penjelas kutipan teks museum di atas ditunjukan pada kalimat nomor &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(139, 1, '<p>Tujuan penulisan teks laporan hasil observasi adalah &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(140, 1, '<p>Teks laporan disebut juga &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(141, 1, '<p>Berikut yang merupakan struktur teks laporan hasil observasi, yaitu &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(142, 1, '<p>Benda di dunia dapat dikelompokkan atas persamaan dan perbedaannya. Dengan pengelompokan, benda-benda itu lebih mudah dipelajari.</p><p><br></p><p>Kutipan paragraf di atas merupakan salah satu bagian struktur teks laporan hasil observasi, yaitu &hellip;. </p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(143, 1, '<p>Berikut yang tidak termasuk dalam ciri-ciri teks laporan hasil observasi, yaitu &hellip;.</p>', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(144, 2, 'Hasil dari 1/2 + 1/4 adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(145, 2, 'Hasil dari 3/5 - 1/5 adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(146, 2, 'Hasil dari 2/3 &times; 3/4 adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(147, 2, 'Hasil dari 4/6 &divide; 2/3 adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(148, 2, 'Pecahan senilai dari 2/3 adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(149, 2, 'Hasil dari 5/8 + 1/8 adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(150, 2, 'Hasil dari 7/9 - 2/9 adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(151, 2, 'Hasil dari 3/4 &times; 2/5 adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(152, 2, 'Hasil dari 6/7 &divide; 3/7 adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(153, 2, 'Bentuk sederhana dari 8/12 adalah...', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(154, 3, '&#1605;&#1575; &#1605;&#1593;&#1606;&#1609; &#1603;&#1604;&#1605;&#1577; \"&#1610;&#1615;&#1591;&#1614;&#1608;&#1617;&#1616;&#1585;&#1615;\" &#1601;&#1610; &#1575;&#1604;&#1580;&#1605;&#1604;&#1577;: \"&#1610;&#1615;&#1591;&#1614;&#1608;&#1617;&#1616;&#1585;&#1615; &#1575;&#1604;&#1591;&#1617;&#1575;&#1604;&#1616;&#1576;&#1615; &#1605;&#1614;&#1607;&#1614;&#1575;&#1585;&#1614;&#1575;&#1578;&#1616;&#1607;&#1616;\"&#1567;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(155, 3, '&#1605;&#1575; &#1605;&#1590;&#1575;&#1583; &#1603;&#1604;&#1605;&#1577; \"&#1606;&#1614;&#1575;&#1580;&#1616;&#1581;&#1612;\"&#1567;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(156, 3, '&#1575;&#1582;&#1578;&#1585; &#1575;&#1604;&#1580;&#1605;&#1604;&#1577; &#1575;&#1604;&#1589;&#1581;&#1610;&#1581;&#1577; &#1606;&#1581;&#1608;&#1610;&#1575;&#1611;:', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(157, 3, '&#1605;&#1575; &#1573;&#1593;&#1585;&#1575;&#1576; &#1603;&#1604;&#1605;&#1577; \"&#1575;&#1604;&#1591;&#1617;&#1575;&#1604;&#1616;&#1576;&#1615;\" &#1601;&#1610; &#1575;&#1604;&#1580;&#1605;&#1604;&#1577;: \"&#1581;&#1614;&#1590;&#1614;&#1585;&#1614; &#1575;&#1604;&#1591;&#1617;&#1575;&#1604;&#1616;&#1576;&#1615; &#1605;&#1615;&#1576;&#1614;&#1603;&#1617;&#1616;&#1585;&#1611;&#1575;\"&#1567;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(158, 3, '&#1605;&#1575; &#1605;&#1593;&#1606;&#1609; &#1575;&#1604;&#1580;&#1605;&#1604;&#1577;: \"&#1575;&#1604;&#1593;&#1616;&#1604;&#1618;&#1605;&#1615; &#1606;&#1615;&#1608;&#1585;&#1612; &#1608;&#1614;&#1575;&#1604;&#1580;&#1614;&#1607;&#1618;&#1604;&#1615; &#1592;&#1614;&#1604;&#1575;&#1605;&#1612;\"&#1567;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(159, 3, '&#1605;&#1575; &#1580;&#1605;&#1593; &#1603;&#1604;&#1605;&#1577; \"&#1603;&#1616;&#1578;&#1614;&#1575;&#1576;&#1612;\"&#1567;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(160, 3, '&#1605;&#1575; &#1606;&#1608;&#1593; &#1575;&#1604;&#1601;&#1593;&#1604; \"&#1603;&#1614;&#1578;&#1614;&#1576;&#1614;\"&#1567;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(161, 3, '&#1575;&#1582;&#1578;&#1585; &#1575;&#1604;&#1578;&#1585;&#1580;&#1605;&#1577; &#1575;&#1604;&#1589;&#1581;&#1610;&#1581;&#1577;: \"&#1610;&#1614;&#1584;&#1618;&#1607;&#1614;&#1576;&#1615; &#1575;&#1604;&#1591;&#1617;&#1575;&#1604;&#1616;&#1576;&#1615; &#1573;&#1616;&#1604;&#1614;&#1609; &#1575;&#1604;&#1580;&#1614;&#1575;&#1605;&#1616;&#1593;&#1614;&#1577;&#1616;\"', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(162, 3, '&#1605;&#1575; &#1575;&#1587;&#1605; &#1575;&#1604;&#1601;&#1575;&#1593;&#1604; &#1605;&#1606; &#1575;&#1604;&#1601;&#1593;&#1604; \"&#1583;&#1614;&#1585;&#1614;&#1587;&#1614;\"&#1567;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(163, 3, '&#1605;&#1575; &#1605;&#1593;&#1606;&#1609; &#1603;&#1604;&#1605;&#1577; \"&#1587;&#1614;&#1585;&#1616;&#1610;&#1593;&#1612;\"&#1567;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(164, 4, 'Rina : The presentation is due tomorrow, but I&rsquo;m not ready yet. Dani : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(165, 4, 'Teacher : You seem unprepared for the test today. Student : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(166, 4, 'A : I can&rsquo;t understand this material. B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(167, 4, 'Students ________ follow the school regulations properly.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(168, 4, 'This problem is ________ than the previous one.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(169, 4, 'A : Would you like to join our discussion? B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(170, 4, 'A : Let me help you organize your notes. B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(171, 4, 'She regrets ________ the opportunity to study abroad.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(172, 4, 'He is capable ________ handling multiple tasks efficiently.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(173, 4, 'Which expression is inappropriate for a formal letter closing?', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(174, 4, 'A : What do you think about the new curriculum? B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(175, 4, 'We must ________ the classroom environment clean.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(176, 4, 'She speaks English ________ than most of her classmates.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(177, 4, 'A : I feel exhausted after working all day. B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(178, 4, 'All students ________ submit their assignments before Friday.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(179, 4, 'A : Could you assist me with this report? B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(180, 4, 'Which sentence is grammatically correct?', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(181, 4, 'The word &ldquo;competent&rdquo; is closest in meaning to&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(182, 4, 'A : Why didn&rsquo;t you attend the meeting? B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(183, 4, 'Choose the correct sentence:', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(184, 4, 'A : I didn&rsquo;t finish my assignment. B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(185, 4, 'She is the ________ student in her class.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(186, 4, 'A : Would you mind closing the door? B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(187, 4, 'The job requires strong analytical skills. The word &ldquo;requires&rdquo; means&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(188, 4, 'A : I can&rsquo;t come to the event tomorrow. B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(189, 4, 'He decided ________ the job offer.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(190, 4, 'A : Let&rsquo;s discuss this problem together. B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(191, 4, 'If I ________ you, I would take that chance.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(192, 4, 'Which sentence is correct?', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(193, 4, 'A : Do you need any assistance? B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(194, 4, 'The meeting ________ postponed due to technical issues.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(195, 4, 'A : What&rsquo;s your opinion about online learning? B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(196, 4, 'He is interested ________ learning new languages.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(197, 4, 'A : I lost my wallet yesterday. B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(198, 4, 'Choose the correct passive voice:', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(199, 4, 'A : Could you explain this topic again? B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(200, 4, 'She suggested ________ earlier to avoid traffic.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(201, 4, 'A : Why don&rsquo;t we study in the library? B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(202, 4, '&ldquo;Work under pressure&rdquo; means&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(203, 4, 'A : Thank you for your assistance. B : ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(204, 5, 'Pukulan servis yang sering digunakan oleh pemain tunggal adalah&hellip;.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(205, 5, 'Saat permulaan permainan bulu tangkis adalah&hellip;.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(206, 5, 'Arah gerak bola yang benar dalam melakukan service bulu tangkis adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(207, 5, 'Apa induk organisasi bulutangkis Indonesia&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(208, 5, 'Berapa skor akhir permainan bulu tangkis&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(209, 5, 'Sarung tangan yang digunakan dalam permainan soft ball disebut&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(210, 5, 'Pemukul dalam soft ball disebut&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(211, 5, 'Teknik menangkap bola melambung dalam soft ball disebut&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(212, 5, 'Berapa jumlah pemain soft ball dalam satu tim&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(213, 5, 'Apa nama waktu dalam permainan soft ball&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(214, 5, 'Berapa jumlah wasit sepak bola yang berada di dalam lapangan&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(215, 5, 'Berapa waktu normal pertandingan sepak bola&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(216, 5, 'Sepak bola pertama kali ditemukan di negara&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(217, 5, 'Jika pemain mendapat dua kartu kuning maka harus&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(218, 5, 'Pelanggaran di area penalty sendiri menyebabkan&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(219, 5, 'Strategi sebelum pertandingan pencak silat disebut&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(220, 5, 'Renang gaya bebas disebut juga gaya&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(221, 5, 'Gerakan leher saat mengambil napas gaya bebas adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(222, 5, 'Sikap kaki saat meluncur di air adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(223, 5, 'Gerakan kaki gaya bebas adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(224, 5, 'Induk organisasi renang Indonesia adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(225, 5, 'Jari pertama yang masuk air saat renang gaya bebas adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(226, 5, 'Tujuan pengenalan air dalam renang adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(227, 5, 'Latihan dasar gerakan kaki dalam renang adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(228, 5, 'Nomor gaya bebas yang tidak dilombakan adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(229, 5, 'Sebelum belajar renang harus bisa&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(230, 5, 'Fungsi lawan dalam pencak silat adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(231, 5, 'Yang bukan teknik pertahanan lanjutan adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(232, 5, 'Sikap dasar dalam pencak silat berfungsi sebagai&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(233, 5, 'Sasaran yang diperbolehkan dalam pencak silat adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(234, 5, 'Strategi sebelum pertandingan pencak silat disebut&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(235, 5, 'Renang gaya bebas disebut juga&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(236, 5, 'Gerakan leher saat bernapas renang gaya bebas adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(237, 5, 'Sikap kaki saat meluncur adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(238, 5, 'Gerakan kaki renang gaya bebas adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(239, 5, 'Induk organisasi renang Indonesia adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(240, 5, 'Jari pertama masuk air saat renang adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(241, 5, 'Tujuan pengenalan air adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(242, 5, 'Latihan dasar kaki renang adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(243, 5, 'Nomor gaya bebas yang tidak dilombakan adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(244, 6, 'Kekeringan panjang di suatu wilayah dapat meningkatkan risiko bencana&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(245, 6, 'Tsunami umumnya disebabkan oleh&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(246, 6, 'Angin puting beliung termasuk fenomena&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(247, 6, 'Pola teratur pada citra biasanya menunjukkan&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(248, 6, 'Objek memanjang dan lurus pada citra biasanya adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(249, 6, 'Penginderaan jauh sangat berguna dalam bidang&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(250, 6, 'Salah satu keunggulan penginderaan jauh adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(251, 6, 'Unsur penting dalam peta untuk menjelaskan simbol adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(252, 6, 'Peta tematik digunakan untuk menunjukkan&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(253, 6, 'Peta yang digunakan untuk pertanian adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(254, 6, 'Untuk pembangunan jalan tol diperlukan peta&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(255, 6, 'Gempa bumi termasuk lapisan&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(256, 6, 'Proyeksi peta untuk wilayah luas adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(257, 6, 'Garis kontur yang rapat menunjukkan&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(258, 6, 'Skala peta menunjukkan&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(259, 6, 'Perangkat keras dalam SIG adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(260, 6, 'Program dalam SIG disebut&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(261, 6, 'Contoh software SIG adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(262, 6, 'Contoh hardware SIG adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(263, 6, 'Tahap awal SIG adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(264, 6, 'Data spasial adalah data&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(265, 6, 'Data raster berbentuk&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(266, 6, 'Data vektor terdiri dari&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(267, 6, 'Data kualitatif adalah data&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(268, 6, 'Data kuantitatif adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(269, 6, 'Overlay dalam SIG berarti&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(270, 6, 'Kelemahan SIG adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(271, 6, 'Kelebihan SIG adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(272, 6, 'SIG digunakan dalam bidang&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(273, 6, 'SIG bidang ekonomi digunakan untuk&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(274, 6, 'Desa memiliki ciri&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(275, 6, 'Masyarakat desa cenderung&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(276, 6, 'Desa berkembang disebut&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(277, 6, 'Peta digunakan untuk mengetahui&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(278, 6, 'Desa di lereng gunung memiliki pola&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(279, 6, 'Longsor sering terjadi di&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(280, 6, 'Kota dicirikan oleh&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(281, 6, 'Unsur utama desa adalah&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(282, 6, 'Kota memiliki ciri fisik&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(283, 6, 'Penebangan hutan di hulu menyebabkan&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(284, 7, 'Which one is a personal letter?', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(285, 7, 'A: What do you think about Bali? B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(286, 7, 'A text telling personal experience is&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(287, 7, 'The purpose of personal letter is&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(288, 7, 'A: Can I help you? B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(289, 7, '&ldquo;You should study harder.&rdquo; means&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(290, 7, 'A: It is hot here. B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(291, 7, 'A: Which is better, train or bus? B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(292, 7, 'A: What will you do this weekend? B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(293, 7, 'A: Do you like music? B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(294, 7, '&ldquo;The book is read by him&rdquo; is&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(295, 7, '&ldquo;She helped me&rdquo; passive is&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(296, 7, '&ldquo;He is eating rice&rdquo; passive is&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(297, 7, 'Suggestion for tired person is&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(298, 7, 'A: Let&rsquo;s watch movie B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(299, 7, 'Job vacancy shows&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(300, 7, 'Analytical exposition aims to&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(301, 7, '&ldquo;You should see doctor&rdquo; expresses&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(302, 7, 'You should ______ to pass exam', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(303, 7, '&ldquo;You&rsquo;d better&hellip;&rdquo; means&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(304, 7, 'A: I am not good at English. B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(305, 7, 'A: What will you do on holiday? B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(306, 7, 'A: What do you think about the movie? B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(307, 7, 'A: I think this place is crowded. B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(308, 7, 'A: I feel dizzy. B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(309, 7, 'Synonym of &ldquo;create&rdquo; is&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(310, 7, 'Antonym of &ldquo;dirty&rdquo; is&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(311, 7, 'A text explaining how to do something is&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(312, 7, 'Word &ldquo;fame&rdquo; has similar meaning with&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(313, 7, 'A: Let&rsquo;s watch TV. B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(314, 7, 'A: What shall we do? B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(315, 7, '______ you like some coffee?', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(316, 7, 'A: I have many tasks. B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(317, 7, 'A: It&rsquo;s very hot here. B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(318, 7, 'A: Do you want to join? B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(319, 7, 'A: He didn&rsquo;t pass exam. B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(320, 7, '&ldquo;You can use my pen.&rdquo; means&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(321, 7, 'A: Let&rsquo;s go outside. B: ________', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(322, 7, 'I like living here ______ the weather.', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0),
(323, 7, '&ldquo;Cos&rdquo; is short form of&hellip;', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_soal_matching`
--

CREATE TABLE `cbt_soal_matching` (
  `matching_id` bigint(20) UNSIGNED NOT NULL,
  `matching_soal_id` bigint(20) UNSIGNED NOT NULL,
  `matching_kiri` text NOT NULL,
  `matching_kanan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cbt_soal_matching`
--

INSERT INTO `cbt_soal_matching` (`matching_id`, `matching_soal_id`, `matching_kiri`, `matching_kanan`) VALUES
(1, 34, 'Indonesia', 'Jakarta'),
(2, 34, 'Jepang', 'Tokyo'),
(3, 34, 'Malaysia', 'Kuala Lumpur'),
(4, 34, '<br>', 'Bangkok'),
(5, 34, '<br>', 'London'),
(6, 35, 'Kucing', 'Ikan'),
(7, 35, 'Sapi', 'Rumput'),
(8, 35, 'Ayam', 'Jagung'),
(9, 35, '<br>', 'Daun'),
(10, 35, '<br>', 'Biji'),
(11, 36, 'Mata', 'Melihat'),
(12, 36, 'Telinga', 'Mendengar'),
(13, 36, 'Hidung', 'Mencium'),
(14, 36, '<br>', 'Memegang'),
(15, 36, '<br>', 'Berjalan'),
(16, 37, 'Merah', 'Apel'),
(17, 37, 'Kuning', 'Pisang'),
(18, 37, 'Hijau', 'Daun'),
(19, 37, '<br>', 'Langit'),
(20, 37, '<br>', 'Awan'),
(21, 38, 'Pensil', 'Menulis'),
(22, 38, 'Penghapus', 'Menghapus'),
(23, 38, 'Penggaris', 'Mengukur'),
(24, 38, '<br>', 'Memotong'),
(25, 38, '<br>', 'Membaca'),
(26, 39, 'Senin', 'Hari ke-1'),
(27, 39, 'Selasa', 'Hari ke-2'),
(28, 39, 'Rabu', 'Hari ke-3'),
(29, 39, '<br>', 'Hari ke-4'),
(30, 39, '<br>', 'Hari ke-5'),
(31, 40, 'Bola', 'Bulat'),
(32, 40, 'Buku', 'Persegi'),
(33, 40, 'Telur', 'Oval'),
(34, 40, '<br>', 'Persegi panjang'),
(35, 40, '<br>', 'Lingkaran'),
(36, 41, 'Guru', 'Sekolah'),
(37, 41, 'Dokter', 'Rumah sakit'),
(38, 41, 'Polisi', 'Jalan'),
(39, 41, '<br>', 'Sawah'),
(40, 41, '<br>', 'Laut'),
(41, 42, 'Payung', 'Hujan'),
(42, 42, 'Topi', 'Panas'),
(43, 42, 'Jaket', 'Dingin'),
(44, 42, '<br>', 'Kaki'),
(45, 42, '<br>', 'Membawa barang'),
(46, 43, '1', 'Satu'),
(47, 43, '2', 'Dua'),
(48, 43, '3', 'Tiga'),
(49, 43, '<br>', 'Empat'),
(50, 43, '<br>', 'Lima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_tes`
--

CREATE TABLE `cbt_tes` (
  `tes_id` bigint(20) UNSIGNED NOT NULL,
  `tes_nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tes_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `tes_intro` int(11) NOT NULL DEFAULT '0' COMMENT '0=Tidak Aktif, 1=Aktif',
  `tes_intro_isi` longtext COLLATE utf8_unicode_ci,
  `tes_begin_time` datetime DEFAULT NULL,
  `tes_end_time` datetime DEFAULT NULL,
  `tes_duration_time` smallint(10) UNSIGNED NOT NULL DEFAULT '0',
  `tes_ip_range` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '*.*.*.*',
  `tes_results_to_users` tinyint(1) NOT NULL DEFAULT '0',
  `tes_detail_to_users` tinyint(1) NOT NULL DEFAULT '0',
  `tes_score_right` decimal(10,2) DEFAULT '1.00',
  `tes_score_wrong` decimal(10,2) DEFAULT '0.00',
  `tes_score_unanswered` decimal(10,2) DEFAULT '0.00',
  `tes_max_score` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tes_token` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cbt_tes`
--

INSERT INTO `cbt_tes` (`tes_id`, `tes_nama`, `tes_detail`, `tes_intro`, `tes_intro_isi`, `tes_begin_time`, `tes_end_time`, `tes_duration_time`, `tes_ip_range`, `tes_results_to_users`, `tes_detail_to_users`, `tes_score_right`, `tes_score_wrong`, `tes_score_unanswered`, `tes_max_score`, `tes_token`) VALUES
(3, 'BAHASA INGGRIS_Kelas XII F', '-', 0, NULL, '2026-04-22 15:20:00', '2026-04-30 15:20:00', 60, '*.*.*.*', 1, 0, '1.00', '0.00', '0.00', '40.00', 0),
(4, 'PJOK_Kelas XII F', '-', 0, NULL, '2026-04-22 15:20:00', '2026-04-30 15:20:00', 60, '*.*.*.*', 1, 0, '1.00', '0.00', '0.00', '40.00', 0),
(5, 'GEOGRAFI_Kelas XII F', '-', 0, NULL, '2026-04-22 16:25:00', '2026-04-23 16:25:00', 60, '*.*.*.*', 1, 0, '1.00', '0.00', '0.00', '40.00', 0),
(6, 'BAHASA INGGRIS LANJUTAN_Kelas XII F', '-', 0, NULL, '2026-04-22 16:29:00', '2026-04-23 16:29:00', 60, '*.*.*.*', 1, 0, '1.00', '0.00', '0.00', '40.00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_tesgrup`
--

CREATE TABLE `cbt_tesgrup` (
  `tstgrp_tes_id` bigint(20) UNSIGNED NOT NULL,
  `tstgrp_grup_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cbt_tesgrup`
--

INSERT INTO `cbt_tesgrup` (`tstgrp_tes_id`, `tstgrp_grup_id`) VALUES
(3, 1),
(4, 1),
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_tes_soal`
--

CREATE TABLE `cbt_tes_soal` (
  `tessoal_id` bigint(20) UNSIGNED NOT NULL,
  `tessoal_tesuser_id` bigint(20) UNSIGNED NOT NULL,
  `tessoal_user_ip` varchar(39) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tessoal_soal_id` bigint(20) UNSIGNED NOT NULL,
  `tessoal_jawaban_text` text COLLATE utf8_unicode_ci,
  `tessoal_nilai` decimal(10,2) DEFAULT NULL,
  `tessoal_creation_time` datetime DEFAULT NULL,
  `tessoal_display_time` datetime DEFAULT NULL,
  `tessoal_change_time` datetime DEFAULT NULL,
  `tessoal_reaction_time` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `tessoal_ragu` int(1) NOT NULL DEFAULT '0' COMMENT '1=ragu, 0=tidak ragu',
  `tessoal_order` smallint(6) NOT NULL DEFAULT '1',
  `tessoal_num_answers` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `tessoal_comment` text COLLATE utf8_unicode_ci,
  `tessoal_audio_play` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cbt_tes_soal`
--

INSERT INTO `cbt_tes_soal` (`tessoal_id`, `tessoal_tesuser_id`, `tessoal_user_ip`, `tessoal_soal_id`, `tessoal_jawaban_text`, `tessoal_nilai`, `tessoal_creation_time`, `tessoal_display_time`, `tessoal_change_time`, `tessoal_reaction_time`, `tessoal_ragu`, `tessoal_order`, `tessoal_num_answers`, `tessoal_comment`, `tessoal_audio_play`) VALUES
(50, 2, NULL, 191, '710', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:25:25', '2026-04-22 16:24:53', 0, 0, 1, 0, NULL, 0),
(51, 2, NULL, 190, '703', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:24:56', '2026-04-22 16:25:24', 0, 0, 2, 0, NULL, 0),
(52, 2, NULL, 166, '585', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:25:30', '2026-04-22 16:26:02', 0, 0, 3, 0, NULL, 0),
(53, 2, NULL, 194, '724', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:26:05', '2026-04-22 16:27:03', 0, 0, 4, 0, NULL, 0),
(54, 2, NULL, 196, '734', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:27:04', '2026-04-22 16:27:27', 0, 0, 5, 0, NULL, 0),
(55, 2, NULL, 174, '623', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:27:28', '2026-04-22 16:27:46', 0, 0, 6, 0, NULL, 0),
(56, 2, NULL, 169, '599', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:27:49', '2026-04-22 16:28:08', 0, 0, 7, 0, NULL, 0),
(57, 2, NULL, 179, '649', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:28:09', '2026-04-22 16:28:25', 0, 0, 8, 0, NULL, 0),
(58, 2, NULL, 186, '684', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:28:27', '2026-04-22 16:28:42', 0, 0, 9, 0, NULL, 0),
(59, 2, NULL, 198, '744', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:28:44', '2026-04-22 16:28:58', 0, 0, 10, 0, NULL, 0),
(60, 2, NULL, 195, '728', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:29:00', '2026-04-22 16:29:54', 0, 0, 11, 0, NULL, 0),
(61, 2, NULL, 201, '758', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:29:55', '2026-04-22 16:30:34', 0, 0, 12, 0, NULL, 0),
(62, 2, NULL, 170, '604', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:30:36', '2026-04-22 16:31:08', 0, 0, 13, 0, NULL, 0),
(63, 2, NULL, 183, '670', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:31:09', '2026-04-22 16:31:26', 0, 0, 14, 0, NULL, 0),
(64, 2, NULL, 200, '754', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:31:27', '2026-04-22 16:31:39', 0, 0, 15, 0, NULL, 0),
(65, 2, NULL, 175, '630', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:31:40', '2026-04-22 16:31:54', 0, 0, 16, 0, NULL, 0),
(66, 2, NULL, 181, '659', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:31:55', '2026-04-22 16:32:09', 0, 0, 17, 0, NULL, 0),
(67, 2, NULL, 203, '768', '0.00', '2026-04-22 16:22:33', '2026-04-22 16:32:10', '2026-04-22 16:32:26', 0, 0, 18, 0, NULL, 0),
(68, 2, NULL, 188, '693', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:32:27', '2026-04-22 16:32:46', 0, 0, 19, 0, NULL, 0),
(69, 2, NULL, 167, '590', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:32:47', '2026-04-22 16:33:09', 0, 0, 20, 0, NULL, 0),
(70, 2, NULL, 164, '576', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:33:19', '2026-04-22 16:33:36', 0, 0, 21, 0, NULL, 0),
(71, 2, NULL, 168, '593', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:33:37', '2026-04-22 16:33:50', 0, 0, 22, 0, NULL, 0),
(72, 2, NULL, 177, '638', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:33:50', '2026-04-22 16:34:11', 0, 0, 23, 0, NULL, 0),
(73, 2, NULL, 182, '664', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:34:12', '2026-04-22 16:34:28', 0, 0, 24, 0, NULL, 0),
(74, 2, NULL, 184, '673', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:34:29', '2026-04-22 16:34:44', 0, 0, 25, 0, NULL, 0),
(75, 2, NULL, 171, '609', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:34:45', '2026-04-22 16:35:01', 0, 0, 26, 0, NULL, 0),
(76, 2, NULL, 178, '645', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:35:00', '2026-04-22 16:35:14', 0, 0, 27, 0, NULL, 0),
(77, 2, NULL, 185, '680', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:35:16', '2026-04-22 16:35:27', 0, 0, 28, 0, NULL, 0),
(78, 2, NULL, 199, '748', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:35:28', '2026-04-22 16:35:47', 0, 0, 29, 0, NULL, 0),
(79, 2, NULL, 180, '655', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:35:48', '2026-04-22 16:36:00', 0, 0, 30, 0, NULL, 0),
(80, 2, NULL, 187, '689', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:36:01', '2026-04-22 16:36:15', 0, 0, 31, 0, NULL, 0),
(81, 2, NULL, 189, '700', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:36:16', '2026-04-22 16:36:30', 0, 0, 32, 0, NULL, 0),
(82, 2, NULL, 172, '617', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:36:33', '2026-04-22 16:36:51', 0, 0, 33, 0, NULL, 0),
(83, 2, NULL, 202, '764', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:36:51', '2026-04-22 16:37:12', 0, 0, 34, 0, NULL, 0),
(84, 2, NULL, 193, '718', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:37:10', '2026-04-22 16:37:25', 0, 0, 35, 0, NULL, 0),
(85, 2, NULL, 176, '636', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:37:26', '2026-04-22 16:37:41', 0, 0, 36, 0, NULL, 0),
(86, 2, NULL, 173, '622', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:37:42', '2026-04-22 16:38:00', 0, 0, 37, 0, NULL, 0),
(87, 2, NULL, 165, '578', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:38:00', '2026-04-22 16:38:16', 0, 0, 38, 0, NULL, 0),
(88, 2, NULL, 197, '738', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:38:17', '2026-04-22 16:38:31', 0, 0, 39, 0, NULL, 0),
(89, 2, NULL, 192, '714', '1.00', '2026-04-22 16:22:33', '2026-04-22 16:38:32', '2026-04-22 16:38:49', 0, 0, 40, 0, NULL, 0),
(90, 3, NULL, 311, '1308', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:51:23', '2026-04-22 16:40:09', 0, 0, 1, 0, NULL, 0),
(91, 3, NULL, 291, '1208', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:40:10', '2026-04-22 16:40:22', 0, 0, 2, 0, NULL, 0),
(92, 3, NULL, 290, '1203', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:40:23', '2026-04-22 16:40:36', 0, 0, 3, 0, NULL, 0),
(93, 3, NULL, 295, '1228', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:40:36', '2026-04-22 16:40:55', 0, 0, 4, 0, NULL, 0),
(94, 3, NULL, 289, '1198', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:40:55', '2026-04-22 16:41:12', 0, 0, 5, 0, NULL, 0),
(95, 3, NULL, 288, '1193', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:41:11', '2026-04-22 16:41:44', 0, 0, 6, 0, NULL, 0),
(96, 3, NULL, 299, '1248', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:41:44', '2026-04-22 16:41:56', 0, 0, 7, 0, NULL, 0),
(97, 3, NULL, 309, '1298', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:41:56', '2026-04-22 16:42:16', 0, 0, 8, 0, NULL, 0),
(98, 3, NULL, 285, '1178', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:42:20', '2026-04-22 16:42:34', 0, 0, 9, 0, NULL, 0),
(99, 3, NULL, 287, '1188', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:42:34', '2026-04-22 16:42:49', 0, 0, 10, 0, NULL, 0),
(100, 3, NULL, 323, '1368', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:51:29', '2026-04-22 16:53:00', 0, 0, 11, 0, NULL, 0),
(101, 3, NULL, 321, '1358', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:53:00', '2026-04-22 16:53:14', 0, 0, 12, 0, NULL, 0),
(102, 3, NULL, 284, '1173', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:53:15', '2026-04-22 16:53:29', 0, 0, 13, 0, NULL, 0),
(103, 3, NULL, 320, '1353', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:53:29', '2026-04-22 16:54:10', 0, 0, 14, 0, NULL, 0),
(104, 3, NULL, 308, '1293', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:54:10', '2026-04-22 16:54:24', 0, 0, 15, 0, NULL, 0),
(105, 3, NULL, 322, '1363', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:54:25', '2026-04-22 16:54:39', 0, 0, 16, 0, NULL, 0),
(106, 3, NULL, 297, '1238', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:54:39', '2026-04-22 16:54:57', 0, 0, 17, 0, NULL, 0),
(107, 3, NULL, 319, '1348', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:54:58', '2026-04-22 16:55:11', 0, 0, 18, 0, NULL, 0),
(108, 3, NULL, 316, '1333', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:55:12', '2026-04-22 16:55:23', 0, 0, 19, 0, NULL, 0),
(109, 3, NULL, 314, '1323', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:55:24', '2026-04-22 16:55:50', 0, 0, 20, 0, NULL, 0),
(110, 3, NULL, 301, '1258', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:55:51', '2026-04-22 16:56:08', 0, 0, 21, 0, NULL, 0),
(111, 3, NULL, 296, '1233', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:56:09', '2026-04-22 16:56:21', 0, 0, 22, 0, NULL, 0),
(112, 3, NULL, 293, '1218', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:56:22', '2026-04-22 16:56:40', 0, 0, 23, 0, NULL, 0),
(113, 3, NULL, 305, '1278', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:56:41', '2026-04-22 16:56:55', 0, 0, 24, 0, NULL, 0),
(114, 3, NULL, 307, '1288', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:56:55', '2026-04-22 16:57:08', 0, 0, 25, 0, NULL, 0),
(115, 3, NULL, 300, '1253', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:57:09', '2026-04-22 16:57:24', 0, 0, 26, 0, NULL, 0),
(116, 3, NULL, 315, '1328', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:57:26', '2026-04-22 16:57:39', 0, 0, 27, 0, NULL, 0),
(117, 3, NULL, 304, '1273', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:57:39', '2026-04-22 16:57:50', 0, 0, 28, 0, NULL, 0),
(118, 3, NULL, 317, '1338', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:57:50', '2026-04-22 16:58:02', 0, 0, 29, 0, NULL, 0),
(119, 3, NULL, 313, '1318', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:58:03', '2026-04-22 16:58:15', 0, 0, 30, 0, NULL, 0),
(120, 3, NULL, 318, '1343', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:58:15', '2026-04-22 16:58:27', 0, 0, 31, 0, NULL, 0),
(121, 3, NULL, 310, '1303', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:58:28', '2026-04-22 16:58:40', 0, 0, 32, 0, NULL, 0),
(122, 3, NULL, 298, '1243', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:58:41', '2026-04-22 16:58:53', 0, 0, 33, 0, NULL, 0),
(123, 3, NULL, 306, '1283', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:58:54', '2026-04-22 16:59:06', 0, 0, 34, 0, NULL, 0),
(124, 3, NULL, 303, '1268', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:59:08', '2026-04-22 16:59:24', 0, 0, 35, 0, NULL, 0),
(125, 3, NULL, 302, '1263', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:59:25', '2026-04-22 16:59:38', 0, 0, 36, 0, NULL, 0),
(126, 3, NULL, 292, '1213', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:59:39', '2026-04-22 16:59:55', 0, 0, 37, 0, NULL, 0),
(127, 3, NULL, 294, '1223', '1.00', '2026-04-22 16:39:34', '2026-04-22 16:59:55', '2026-04-22 17:00:09', 0, 0, 38, 0, NULL, 0),
(128, 3, NULL, 312, '1313', '1.00', '2026-04-22 16:39:34', '2026-04-22 17:00:11', '2026-04-22 17:00:25', 0, 0, 39, 0, NULL, 0),
(129, 3, NULL, 286, '1187', '0.00', '2026-04-22 16:39:34', '2026-04-22 17:00:25', '2026-04-22 17:00:30', 0, 0, 40, 0, NULL, 0),
(130, 4, NULL, 244, '974', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:00:54', '2026-04-22 17:01:15', 0, 0, 1, 0, NULL, 0),
(131, 4, NULL, 249, '998', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:01:15', '2026-04-22 17:01:29', 0, 0, 2, 0, NULL, 0),
(132, 4, NULL, 265, '1078', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:01:30', '2026-04-22 17:01:50', 0, 0, 3, 0, NULL, 0),
(133, 4, NULL, 283, '1168', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:01:50', '2026-04-22 17:02:05', 0, 0, 4, 0, NULL, 0),
(134, 4, NULL, 277, '1138', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:02:06', '2026-04-22 17:02:14', 0, 0, 5, 0, NULL, 0),
(135, 4, NULL, 276, '1133', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:02:15', '2026-04-22 17:02:29', 0, 0, 6, 0, NULL, 0),
(136, 4, NULL, 252, '1013', '0.00', '2026-04-22 17:00:51', '2026-04-22 17:02:29', '2026-04-22 17:02:38', 0, 0, 7, 0, NULL, 0),
(137, 4, NULL, 278, '1144', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:02:39', '2026-04-22 17:02:52', 0, 0, 8, 0, NULL, 0),
(138, 4, NULL, 272, '1113', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:02:53', '2026-04-22 17:03:06', 0, 0, 9, 0, NULL, 0),
(139, 4, NULL, 270, '1103', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:03:07', '2026-04-22 17:03:19', 0, 0, 10, 0, NULL, 0),
(140, 4, NULL, 264, '1073', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:03:20', '2026-04-22 17:03:31', 0, 0, 11, 0, NULL, 0),
(141, 4, NULL, 282, '1163', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:03:32', '2026-04-22 17:03:41', 0, 0, 12, 0, NULL, 0),
(142, 4, NULL, 267, '1088', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:03:42', '2026-04-22 17:03:55', 0, 0, 13, 0, NULL, 0),
(143, 4, NULL, 268, '1093', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:03:56', '2026-04-22 17:04:05', 0, 0, 14, 0, NULL, 0),
(144, 4, NULL, 261, '1058', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:04:06', '2026-04-22 17:04:20', 0, 0, 15, 0, NULL, 0),
(145, 4, NULL, 248, '994', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:04:21', '2026-04-22 17:04:37', 0, 0, 16, 0, NULL, 0),
(146, 4, NULL, 246, '984', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:04:38', '2026-04-22 17:04:49', 0, 0, 17, 0, NULL, 0),
(147, 4, NULL, 260, '1053', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:04:50', '2026-04-22 17:05:05', 0, 0, 18, 0, NULL, 0),
(148, 4, NULL, 266, '1083', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:05:06', '2026-04-22 17:05:26', 0, 0, 19, 0, NULL, 0),
(149, 4, NULL, 262, '1063', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:05:29', '2026-04-22 17:05:45', 0, 0, 20, 0, NULL, 0),
(150, 4, NULL, 251, '1010', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:05:46', '2026-04-22 17:06:25', 0, 0, 21, 0, NULL, 0),
(151, 4, NULL, 279, '1148', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:06:27', '2026-04-22 17:06:46', 0, 0, 22, 0, NULL, 0),
(152, 4, NULL, 273, '1118', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:06:48', '2026-04-22 17:07:05', 0, 0, 23, 0, NULL, 0),
(153, 4, NULL, 256, '1035', '0.00', '2026-04-22 17:00:51', '2026-04-22 17:07:07', '2026-04-22 17:07:22', 0, 0, 24, 0, NULL, 0),
(154, 4, NULL, 258, '1044', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:07:24', '2026-04-22 17:07:46', 0, 0, 25, 0, NULL, 0),
(155, 4, NULL, 259, '1048', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:07:48', '2026-04-22 17:08:11', 0, 0, 26, 0, NULL, 0),
(156, 4, NULL, 250, '1003', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:08:13', '2026-04-22 17:08:32', 0, 0, 27, 0, NULL, 0),
(157, 4, NULL, 274, '1123', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:08:33', '2026-04-22 17:08:56', 0, 0, 28, 0, NULL, 0),
(158, 4, NULL, 247, '989', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:09:01', '2026-04-22 17:09:21', 0, 0, 29, 0, NULL, 0),
(159, 4, NULL, 280, '1153', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:09:21', '2026-04-22 17:09:36', 0, 0, 30, 0, NULL, 0),
(160, 4, NULL, 271, '1108', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:09:37', '2026-04-22 17:09:54', 0, 0, 31, 0, NULL, 0),
(161, 4, NULL, 263, '1068', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:09:55', '2026-04-22 17:10:10', 0, 0, 32, 0, NULL, 0),
(162, 4, NULL, 255, '1028', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:10:12', '2026-04-22 17:10:25', 0, 0, 33, 0, NULL, 0),
(163, 4, NULL, 253, '1019', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:10:26', '2026-04-22 17:10:40', 0, 0, 34, 0, NULL, 0),
(164, 4, NULL, 275, '1128', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:10:40', '2026-04-22 17:10:53', 0, 0, 35, 0, NULL, 0),
(165, 4, NULL, 254, '1023', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:10:54', '2026-04-22 17:11:11', 0, 0, 36, 0, NULL, 0),
(166, 4, NULL, 269, '1098', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:11:12', '2026-04-22 17:11:25', 0, 0, 37, 0, NULL, 0),
(167, 4, NULL, 245, '979', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:11:25', '2026-04-22 17:11:40', 0, 0, 38, 0, NULL, 0),
(168, 4, NULL, 281, '1158', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:11:41', '2026-04-22 17:11:55', 0, 0, 39, 0, NULL, 0),
(169, 4, NULL, 257, '1039', '1.00', '2026-04-22 17:00:51', '2026-04-22 17:11:56', '2026-04-22 17:12:09', 0, 0, 40, 0, NULL, 0),
(170, 5, NULL, 220, '856', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:12:45', '2026-04-22 17:13:00', 0, 0, 1, 0, NULL, 0),
(171, 5, NULL, 208, '795', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:13:01', '2026-04-22 17:13:10', 0, 0, 2, 0, NULL, 0),
(172, 5, NULL, 212, '816', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:13:11', '2026-04-22 17:13:25', 0, 0, 3, 0, NULL, 0),
(173, 5, NULL, 219, '849', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:13:26', '2026-04-22 17:13:47', 0, 0, 4, 0, NULL, 0),
(174, 5, NULL, 205, '780', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:13:47', '2026-04-22 17:14:03', 0, 0, 5, 0, NULL, 0),
(175, 5, NULL, 223, '871', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:14:04', '2026-04-22 17:14:18', 0, 0, 6, 0, NULL, 0),
(176, 5, NULL, 234, '924', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:14:19', '2026-04-22 17:14:27', 0, 0, 7, 0, NULL, 0),
(177, 5, NULL, 228, '896', '0.00', '2026-04-22 17:12:43', '2026-04-22 17:14:28', '2026-04-22 17:14:49', 0, 0, 8, 0, NULL, 0),
(178, 5, NULL, 242, '967', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:14:50', '2026-04-22 17:15:16', 0, 0, 9, 0, NULL, 0),
(179, 5, NULL, 239, '952', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:15:17', '2026-04-22 17:15:34', 0, 0, 10, 0, NULL, 0),
(180, 5, NULL, 210, '806', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:15:35', '2026-04-22 17:15:51', 0, 0, 11, 0, NULL, 0),
(181, 5, NULL, 216, '833', '0.00', '2026-04-22 17:12:43', '2026-04-22 17:15:52', '2026-04-22 17:16:01', 0, 0, 12, 0, NULL, 0),
(182, 5, NULL, 243, '970', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:16:02', '2026-04-22 17:16:08', 0, 0, 13, 0, NULL, 0),
(183, 5, NULL, 222, '863', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:16:09', '2026-04-22 17:16:19', 0, 0, 14, 0, NULL, 0),
(184, 5, NULL, 227, '892', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:16:20', '2026-04-22 17:16:26', 0, 0, 15, 0, NULL, 0),
(185, 5, NULL, 224, '877', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:16:26', '2026-04-22 17:16:32', 0, 0, 16, 0, NULL, 0),
(186, 5, NULL, 237, '938', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:16:33', '2026-04-22 17:16:39', 0, 0, 17, 0, NULL, 0),
(187, 5, NULL, 230, '905', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:16:40', '2026-04-22 17:16:47', 0, 0, 18, 0, NULL, 0),
(188, 5, NULL, 215, '830', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:16:49', '2026-04-22 17:16:59', 0, 0, 19, 0, NULL, 0),
(189, 5, NULL, 209, '801', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:17:00', '2026-04-22 17:17:14', 0, 0, 20, 0, NULL, 0),
(190, 5, NULL, 236, '936', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:17:15', '2026-04-22 17:17:27', 0, 0, 21, 0, NULL, 0),
(191, 5, NULL, 226, '886', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:17:27', '2026-04-22 17:17:37', 0, 0, 22, 0, NULL, 0),
(192, 5, NULL, 241, '961', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:17:38', '2026-04-22 17:17:46', 0, 0, 23, 0, NULL, 0),
(193, 5, NULL, 207, '792', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:17:47', '2026-04-22 17:17:58', 0, 0, 24, 0, NULL, 0),
(194, 5, NULL, 206, '785', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:18:01', '2026-04-22 17:18:13', 0, 0, 25, 0, NULL, 0),
(195, 5, NULL, 233, '920', '0.00', '2026-04-22 17:12:43', '2026-04-22 17:18:14', '2026-04-22 17:18:27', 0, 0, 26, 0, NULL, 0),
(196, 5, NULL, 232, '915', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:18:27', '2026-04-22 17:18:35', 0, 0, 27, 0, NULL, 0),
(197, 5, NULL, 214, '825', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:18:35', '2026-04-22 17:18:49', 0, 0, 28, 0, NULL, 0),
(198, 5, NULL, 238, '946', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:18:49', '2026-04-22 17:18:58', 0, 0, 29, 0, NULL, 0),
(199, 5, NULL, 211, '810', '0.00', '2026-04-22 17:12:43', '2026-04-22 17:19:00', '2026-04-22 17:19:14', 0, 0, 30, 0, NULL, 0),
(200, 5, NULL, 225, '881', '0.00', '2026-04-22 17:12:43', '2026-04-22 17:19:14', '2026-04-22 17:19:26', 0, 0, 31, 0, NULL, 0),
(201, 5, NULL, 218, '846', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:19:27', '2026-04-22 17:19:41', 0, 0, 32, 0, NULL, 0),
(202, 5, NULL, 231, '910', '0.00', '2026-04-22 17:12:43', '2026-04-22 17:19:42', '2026-04-22 17:19:55', 0, 0, 33, 0, NULL, 0),
(203, 5, NULL, 229, '899', '0.00', '2026-04-22 17:12:43', '2026-04-22 17:19:55', '2026-04-22 17:20:09', 0, 0, 34, 0, NULL, 0),
(204, 5, NULL, 240, '956', '0.00', '2026-04-22 17:12:43', '2026-04-22 17:20:10', '2026-04-22 17:20:16', 0, 0, 35, 0, NULL, 0),
(205, 5, NULL, 221, '860', '0.00', '2026-04-22 17:12:43', '2026-04-22 17:20:17', '2026-04-22 17:20:29', 0, 0, 36, 0, NULL, 0),
(206, 5, NULL, 217, '840', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:20:30', '2026-04-22 17:20:38', 0, 0, 37, 0, NULL, 0),
(207, 5, NULL, 204, '774', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:20:39', '2026-04-22 17:20:51', 0, 0, 38, 0, NULL, 0),
(208, 5, NULL, 213, '820', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:21:27', '2026-04-22 17:21:36', 0, 0, 39, 0, NULL, 0),
(209, 5, NULL, 235, '931', '1.00', '2026-04-22 17:12:43', '2026-04-22 17:21:36', '2026-04-22 17:21:41', 0, 0, 40, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_tes_soal_jawaban`
--

CREATE TABLE `cbt_tes_soal_jawaban` (
  `soaljawaban_tessoal_id` bigint(20) UNSIGNED NOT NULL,
  `soaljawaban_jawaban_id` bigint(20) UNSIGNED NOT NULL,
  `soaljawaban_selected` smallint(6) NOT NULL DEFAULT '-1',
  `soaljawaban_order` smallint(6) NOT NULL DEFAULT '1',
  `soaljawaban_position` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cbt_tes_soal_jawaban`
--

INSERT INTO `cbt_tes_soal_jawaban` (`soaljawaban_tessoal_id`, `soaljawaban_jawaban_id`, `soaljawaban_selected`, `soaljawaban_order`, `soaljawaban_position`) VALUES
(50, 708, 0, 1, NULL),
(50, 709, 0, 3, NULL),
(50, 710, 1, 2, NULL),
(50, 711, 0, 5, NULL),
(50, 712, 0, 4, NULL),
(51, 703, 1, 4, NULL),
(51, 704, 0, 5, NULL),
(51, 705, 0, 3, NULL),
(51, 706, 0, 1, NULL),
(51, 707, 0, 2, NULL),
(52, 583, 0, 3, NULL),
(52, 584, 0, 1, NULL),
(52, 585, 1, 2, NULL),
(52, 586, 0, 4, NULL),
(52, 587, 0, 5, NULL),
(53, 723, 0, 1, NULL),
(53, 724, 1, 3, NULL),
(53, 725, 0, 5, NULL),
(53, 726, 0, 2, NULL),
(53, 727, 0, 4, NULL),
(54, 733, 0, 5, NULL),
(54, 734, 1, 3, NULL),
(54, 735, 0, 1, NULL),
(54, 736, 0, 4, NULL),
(54, 737, 0, 2, NULL),
(55, 623, 1, 3, NULL),
(55, 624, 0, 4, NULL),
(55, 625, 0, 1, NULL),
(55, 626, 0, 5, NULL),
(55, 627, 0, 2, NULL),
(56, 598, 0, 2, NULL),
(56, 599, 1, 4, NULL),
(56, 600, 0, 1, NULL),
(56, 601, 0, 3, NULL),
(56, 602, 0, 5, NULL),
(57, 648, 0, 1, NULL),
(57, 649, 1, 2, NULL),
(57, 650, 0, 3, NULL),
(57, 651, 0, 5, NULL),
(57, 652, 0, 4, NULL),
(58, 683, 0, 2, NULL),
(58, 684, 1, 1, NULL),
(58, 685, 0, 4, NULL),
(58, 686, 0, 5, NULL),
(58, 687, 0, 3, NULL),
(59, 743, 0, 5, NULL),
(59, 744, 1, 2, NULL),
(59, 745, 0, 3, NULL),
(59, 746, 0, 1, NULL),
(59, 747, 0, 4, NULL),
(60, 728, 1, 5, NULL),
(60, 729, 0, 3, NULL),
(60, 730, 0, 2, NULL),
(60, 731, 0, 1, NULL),
(60, 732, 0, 4, NULL),
(61, 758, 1, 3, NULL),
(61, 759, 0, 1, NULL),
(61, 760, 0, 5, NULL),
(61, 761, 0, 2, NULL),
(61, 762, 0, 4, NULL),
(62, 603, 0, 1, NULL),
(62, 604, 1, 5, NULL),
(62, 605, 0, 2, NULL),
(62, 606, 0, 3, NULL),
(62, 607, 0, 4, NULL),
(63, 668, 0, 3, NULL),
(63, 669, 0, 1, NULL),
(63, 670, 1, 5, NULL),
(63, 671, 0, 2, NULL),
(63, 672, 0, 4, NULL),
(64, 753, 0, 1, NULL),
(64, 754, 1, 2, NULL),
(64, 755, 0, 4, NULL),
(64, 756, 0, 3, NULL),
(64, 757, 0, 5, NULL),
(65, 628, 0, 1, NULL),
(65, 629, 0, 3, NULL),
(65, 630, 1, 2, NULL),
(65, 631, 0, 5, NULL),
(65, 632, 0, 4, NULL),
(66, 658, 0, 2, NULL),
(66, 659, 1, 3, NULL),
(66, 660, 0, 4, NULL),
(66, 661, 0, 1, NULL),
(66, 662, 0, 5, NULL),
(67, 768, 1, 2, NULL),
(67, 769, 0, 4, NULL),
(67, 770, 0, 1, NULL),
(67, 771, 0, 3, NULL),
(67, 772, 0, 5, NULL),
(68, 693, 1, 2, NULL),
(68, 694, 0, 4, NULL),
(68, 695, 0, 1, NULL),
(68, 696, 0, 5, NULL),
(68, 697, 0, 3, NULL),
(69, 588, 0, 2, NULL),
(69, 589, 0, 1, NULL),
(69, 590, 1, 5, NULL),
(69, 591, 0, 4, NULL),
(69, 592, 0, 3, NULL),
(70, 573, 0, 5, NULL),
(70, 574, 0, 1, NULL),
(70, 575, 0, 4, NULL),
(70, 576, 1, 3, NULL),
(70, 577, 0, 2, NULL),
(71, 593, 1, 5, NULL),
(71, 594, 0, 1, NULL),
(71, 595, 0, 4, NULL),
(71, 596, 0, 3, NULL),
(71, 597, 0, 2, NULL),
(72, 638, 1, 2, NULL),
(72, 639, 0, 5, NULL),
(72, 640, 0, 4, NULL),
(72, 641, 0, 3, NULL),
(72, 642, 0, 1, NULL),
(73, 663, 0, 1, NULL),
(73, 664, 1, 2, NULL),
(73, 665, 0, 3, NULL),
(73, 666, 0, 5, NULL),
(73, 667, 0, 4, NULL),
(74, 673, 1, 2, NULL),
(74, 674, 0, 4, NULL),
(74, 675, 0, 5, NULL),
(74, 676, 0, 3, NULL),
(74, 677, 0, 1, NULL),
(75, 608, 0, 1, NULL),
(75, 609, 1, 4, NULL),
(75, 610, 0, 2, NULL),
(75, 611, 0, 3, NULL),
(75, 612, 0, 5, NULL),
(76, 643, 0, 2, NULL),
(76, 644, 0, 4, NULL),
(76, 645, 1, 3, NULL),
(76, 646, 0, 5, NULL),
(76, 647, 0, 1, NULL),
(77, 678, 0, 3, NULL),
(77, 679, 0, 4, NULL),
(77, 680, 1, 5, NULL),
(77, 681, 0, 2, NULL),
(77, 682, 0, 1, NULL),
(78, 748, 1, 3, NULL),
(78, 749, 0, 2, NULL),
(78, 750, 0, 5, NULL),
(78, 751, 0, 4, NULL),
(78, 752, 0, 1, NULL),
(79, 653, 0, 4, NULL),
(79, 654, 0, 1, NULL),
(79, 655, 1, 3, NULL),
(79, 656, 0, 5, NULL),
(79, 657, 0, 2, NULL),
(80, 688, 0, 1, NULL),
(80, 689, 1, 5, NULL),
(80, 690, 0, 3, NULL),
(80, 691, 0, 4, NULL),
(80, 692, 0, 2, NULL),
(81, 698, 0, 2, NULL),
(81, 699, 0, 4, NULL),
(81, 700, 1, 1, NULL),
(81, 701, 0, 5, NULL),
(81, 702, 0, 3, NULL),
(82, 613, 0, 5, NULL),
(82, 614, 0, 4, NULL),
(82, 615, 0, 2, NULL),
(82, 616, 0, 1, NULL),
(82, 617, 1, 3, NULL),
(83, 763, 0, 1, NULL),
(83, 764, 1, 4, NULL),
(83, 765, 0, 3, NULL),
(83, 766, 0, 5, NULL),
(83, 767, 0, 2, NULL),
(84, 718, 1, 3, NULL),
(84, 719, 0, 4, NULL),
(84, 720, 0, 1, NULL),
(84, 721, 0, 5, NULL),
(84, 722, 0, 2, NULL),
(85, 633, 0, 5, NULL),
(85, 634, 0, 3, NULL),
(85, 635, 0, 1, NULL),
(85, 636, 1, 4, NULL),
(85, 637, 0, 2, NULL),
(86, 618, 0, 5, NULL),
(86, 619, 0, 1, NULL),
(86, 620, 0, 3, NULL),
(86, 621, 0, 2, NULL),
(86, 622, 1, 4, NULL),
(87, 578, 1, 2, NULL),
(87, 579, 0, 4, NULL),
(87, 580, 0, 3, NULL),
(87, 581, 0, 5, NULL),
(87, 582, 0, 1, NULL),
(88, 738, 1, 2, NULL),
(88, 739, 0, 4, NULL),
(88, 740, 0, 5, NULL),
(88, 741, 0, 1, NULL),
(88, 742, 0, 3, NULL),
(89, 713, 0, 2, NULL),
(89, 714, 1, 5, NULL),
(89, 715, 0, 4, NULL),
(89, 716, 0, 1, NULL),
(89, 717, 0, 3, NULL),
(90, 1308, 1, 2, NULL),
(90, 1309, 0, 4, NULL),
(90, 1310, 0, 1, NULL),
(90, 1311, 0, 3, NULL),
(90, 1312, 0, 5, NULL),
(91, 1208, 1, 5, NULL),
(91, 1209, 0, 1, NULL),
(91, 1210, 0, 3, NULL),
(91, 1211, 0, 4, NULL),
(91, 1212, 0, 2, NULL),
(92, 1203, 1, 3, NULL),
(92, 1204, 0, 1, NULL),
(92, 1205, 0, 2, NULL),
(92, 1206, 0, 5, NULL),
(92, 1207, 0, 4, NULL),
(93, 1228, 1, 2, NULL),
(93, 1229, 0, 5, NULL),
(93, 1230, 0, 3, NULL),
(93, 1231, 0, 4, NULL),
(93, 1232, 0, 1, NULL),
(94, 1198, 1, 5, NULL),
(94, 1199, 0, 1, NULL),
(94, 1200, 0, 3, NULL),
(94, 1201, 0, 2, NULL),
(94, 1202, 0, 4, NULL),
(95, 1193, 1, 4, NULL),
(95, 1194, 0, 2, NULL),
(95, 1195, 0, 5, NULL),
(95, 1196, 0, 1, NULL),
(95, 1197, 0, 3, NULL),
(96, 1248, 1, 1, NULL),
(96, 1249, 0, 5, NULL),
(96, 1250, 0, 4, NULL),
(96, 1251, 0, 3, NULL),
(96, 1252, 0, 2, NULL),
(97, 1298, 1, 1, NULL),
(97, 1299, 0, 4, NULL),
(97, 1300, 0, 2, NULL),
(97, 1301, 0, 5, NULL),
(97, 1302, 0, 3, NULL),
(98, 1178, 1, 1, NULL),
(98, 1179, 0, 2, NULL),
(98, 1180, 0, 4, NULL),
(98, 1181, 0, 3, NULL),
(98, 1182, 0, 5, NULL),
(99, 1188, 1, 4, NULL),
(99, 1189, 0, 5, NULL),
(99, 1190, 0, 2, NULL),
(99, 1191, 0, 3, NULL),
(99, 1192, 0, 1, NULL),
(100, 1368, 1, 1, NULL),
(100, 1369, 0, 5, NULL),
(100, 1370, 0, 2, NULL),
(100, 1371, 0, 4, NULL),
(100, 1372, 0, 3, NULL),
(101, 1358, 1, 5, NULL),
(101, 1359, 0, 4, NULL),
(101, 1360, 0, 2, NULL),
(101, 1361, 0, 1, NULL),
(101, 1362, 0, 3, NULL),
(102, 1173, 1, 5, NULL),
(102, 1174, 0, 1, NULL),
(102, 1175, 0, 4, NULL),
(102, 1176, 0, 3, NULL),
(102, 1177, 0, 2, NULL),
(103, 1353, 1, 2, NULL),
(103, 1354, 0, 3, NULL),
(103, 1355, 0, 1, NULL),
(103, 1356, 0, 4, NULL),
(103, 1357, 0, 5, NULL),
(104, 1293, 1, 4, NULL),
(104, 1294, 0, 5, NULL),
(104, 1295, 0, 2, NULL),
(104, 1296, 0, 1, NULL),
(104, 1297, 0, 3, NULL),
(105, 1363, 1, 1, NULL),
(105, 1364, 0, 3, NULL),
(105, 1365, 0, 2, NULL),
(105, 1366, 0, 4, NULL),
(105, 1367, 0, 5, NULL),
(106, 1238, 1, 4, NULL),
(106, 1239, 0, 5, NULL),
(106, 1240, 0, 3, NULL),
(106, 1241, 0, 1, NULL),
(106, 1242, 0, 2, NULL),
(107, 1348, 1, 3, NULL),
(107, 1349, 0, 4, NULL),
(107, 1350, 0, 1, NULL),
(107, 1351, 0, 2, NULL),
(107, 1352, 0, 5, NULL),
(108, 1333, 1, 1, NULL),
(108, 1334, 0, 2, NULL),
(108, 1335, 0, 3, NULL),
(108, 1336, 0, 5, NULL),
(108, 1337, 0, 4, NULL),
(109, 1323, 1, 1, NULL),
(109, 1324, 0, 2, NULL),
(109, 1325, 0, 5, NULL),
(109, 1326, 0, 4, NULL),
(109, 1327, 0, 3, NULL),
(110, 1258, 1, 5, NULL),
(110, 1259, 0, 3, NULL),
(110, 1260, 0, 1, NULL),
(110, 1261, 0, 4, NULL),
(110, 1262, 0, 2, NULL),
(111, 1233, 1, 2, NULL),
(111, 1234, 0, 3, NULL),
(111, 1235, 0, 1, NULL),
(111, 1236, 0, 4, NULL),
(111, 1237, 0, 5, NULL),
(112, 1218, 1, 4, NULL),
(112, 1219, 0, 2, NULL),
(112, 1220, 0, 3, NULL),
(112, 1221, 0, 1, NULL),
(112, 1222, 0, 5, NULL),
(113, 1278, 1, 4, NULL),
(113, 1279, 0, 3, NULL),
(113, 1280, 0, 2, NULL),
(113, 1281, 0, 1, NULL),
(113, 1282, 0, 5, NULL),
(114, 1288, 1, 1, NULL),
(114, 1289, 0, 5, NULL),
(114, 1290, 0, 2, NULL),
(114, 1291, 0, 3, NULL),
(114, 1292, 0, 4, NULL),
(115, 1253, 1, 4, NULL),
(115, 1254, 0, 2, NULL),
(115, 1255, 0, 1, NULL),
(115, 1256, 0, 3, NULL),
(115, 1257, 0, 5, NULL),
(116, 1328, 1, 1, NULL),
(116, 1329, 0, 4, NULL),
(116, 1330, 0, 5, NULL),
(116, 1331, 0, 3, NULL),
(116, 1332, 0, 2, NULL),
(117, 1273, 1, 5, NULL),
(117, 1274, 0, 4, NULL),
(117, 1275, 0, 3, NULL),
(117, 1276, 0, 1, NULL),
(117, 1277, 0, 2, NULL),
(118, 1338, 1, 1, NULL),
(118, 1339, 0, 3, NULL),
(118, 1340, 0, 4, NULL),
(118, 1341, 0, 5, NULL),
(118, 1342, 0, 2, NULL),
(119, 1318, 1, 2, NULL),
(119, 1319, 0, 4, NULL),
(119, 1320, 0, 3, NULL),
(119, 1321, 0, 5, NULL),
(119, 1322, 0, 1, NULL),
(120, 1343, 1, 5, NULL),
(120, 1344, 0, 4, NULL),
(120, 1345, 0, 2, NULL),
(120, 1346, 0, 1, NULL),
(120, 1347, 0, 3, NULL),
(121, 1303, 1, 3, NULL),
(121, 1304, 0, 5, NULL),
(121, 1305, 0, 1, NULL),
(121, 1306, 0, 2, NULL),
(121, 1307, 0, 4, NULL),
(122, 1243, 1, 4, NULL),
(122, 1244, 0, 2, NULL),
(122, 1245, 0, 5, NULL),
(122, 1246, 0, 3, NULL),
(122, 1247, 0, 1, NULL),
(123, 1283, 1, 4, NULL),
(123, 1284, 0, 1, NULL),
(123, 1285, 0, 3, NULL),
(123, 1286, 0, 5, NULL),
(123, 1287, 0, 2, NULL),
(124, 1268, 1, 2, NULL),
(124, 1269, 0, 1, NULL),
(124, 1270, 0, 5, NULL),
(124, 1271, 0, 4, NULL),
(124, 1272, 0, 3, NULL),
(125, 1263, 1, 2, NULL),
(125, 1264, 0, 1, NULL),
(125, 1265, 0, 5, NULL),
(125, 1266, 0, 3, NULL),
(125, 1267, 0, 4, NULL),
(126, 1213, 1, 4, NULL),
(126, 1214, 0, 1, NULL),
(126, 1215, 0, 5, NULL),
(126, 1216, 0, 2, NULL),
(126, 1217, 0, 3, NULL),
(127, 1223, 1, 4, NULL),
(127, 1224, 0, 1, NULL),
(127, 1225, 0, 2, NULL),
(127, 1226, 0, 3, NULL),
(127, 1227, 0, 5, NULL),
(128, 1313, 1, 4, NULL),
(128, 1314, 0, 3, NULL),
(128, 1315, 0, 5, NULL),
(128, 1316, 0, 1, NULL),
(128, 1317, 0, 2, NULL),
(129, 1183, 0, 2, NULL),
(129, 1184, 0, 4, NULL),
(129, 1185, 0, 3, NULL),
(129, 1186, 0, 5, NULL),
(129, 1187, 1, 1, NULL),
(130, 973, 0, 2, NULL),
(130, 974, 1, 1, NULL),
(130, 975, 0, 3, NULL),
(130, 976, 0, 4, NULL),
(130, 977, 0, 5, NULL),
(131, 998, 1, 1, NULL),
(131, 999, 0, 5, NULL),
(131, 1000, 0, 3, NULL),
(131, 1001, 0, 2, NULL),
(131, 1002, 0, 4, NULL),
(132, 1078, 1, 5, NULL),
(132, 1079, 0, 4, NULL),
(132, 1080, 0, 1, NULL),
(132, 1081, 0, 3, NULL),
(132, 1082, 0, 2, NULL),
(133, 1168, 1, 1, NULL),
(133, 1169, 0, 4, NULL),
(133, 1170, 0, 2, NULL),
(133, 1171, 0, 3, NULL),
(133, 1172, 0, 5, NULL),
(134, 1138, 1, 2, NULL),
(134, 1139, 0, 4, NULL),
(134, 1140, 0, 3, NULL),
(134, 1141, 0, 1, NULL),
(134, 1142, 0, 5, NULL),
(135, 1133, 1, 4, NULL),
(135, 1134, 0, 1, NULL),
(135, 1135, 0, 3, NULL),
(135, 1136, 0, 5, NULL),
(135, 1137, 0, 2, NULL),
(136, 1013, 1, 2, NULL),
(136, 1014, 0, 3, NULL),
(136, 1015, 0, 1, NULL),
(136, 1016, 0, 4, NULL),
(136, 1017, 0, 5, NULL),
(137, 1143, 0, 2, NULL),
(137, 1144, 1, 4, NULL),
(137, 1145, 0, 3, NULL),
(137, 1146, 0, 5, NULL),
(137, 1147, 0, 1, NULL),
(138, 1113, 1, 1, NULL),
(138, 1114, 0, 4, NULL),
(138, 1115, 0, 3, NULL),
(138, 1116, 0, 5, NULL),
(138, 1117, 0, 2, NULL),
(139, 1103, 1, 3, NULL),
(139, 1104, 0, 4, NULL),
(139, 1105, 0, 1, NULL),
(139, 1106, 0, 2, NULL),
(139, 1107, 0, 5, NULL),
(140, 1073, 1, 1, NULL),
(140, 1074, 0, 5, NULL),
(140, 1075, 0, 3, NULL),
(140, 1076, 0, 4, NULL),
(140, 1077, 0, 2, NULL),
(141, 1163, 1, 3, NULL),
(141, 1164, 0, 4, NULL),
(141, 1165, 0, 1, NULL),
(141, 1166, 0, 5, NULL),
(141, 1167, 0, 2, NULL),
(142, 1088, 1, 4, NULL),
(142, 1089, 0, 1, NULL),
(142, 1090, 0, 3, NULL),
(142, 1091, 0, 5, NULL),
(142, 1092, 0, 2, NULL),
(143, 1093, 1, 1, NULL),
(143, 1094, 0, 3, NULL),
(143, 1095, 0, 5, NULL),
(143, 1096, 0, 2, NULL),
(143, 1097, 0, 4, NULL),
(144, 1058, 1, 5, NULL),
(144, 1059, 0, 1, NULL),
(144, 1060, 0, 4, NULL),
(144, 1061, 0, 2, NULL),
(144, 1062, 0, 3, NULL),
(145, 993, 0, 5, NULL),
(145, 994, 1, 1, NULL),
(145, 995, 0, 3, NULL),
(145, 996, 0, 2, NULL),
(145, 997, 0, 4, NULL),
(146, 983, 0, 3, NULL),
(146, 984, 1, 5, NULL),
(146, 985, 0, 4, NULL),
(146, 986, 0, 1, NULL),
(146, 987, 0, 2, NULL),
(147, 1053, 1, 2, NULL),
(147, 1054, 0, 4, NULL),
(147, 1055, 0, 3, NULL),
(147, 1056, 0, 1, NULL),
(147, 1057, 0, 5, NULL),
(148, 1083, 1, 3, NULL),
(148, 1084, 0, 4, NULL),
(148, 1085, 0, 1, NULL),
(148, 1086, 0, 2, NULL),
(148, 1087, 0, 5, NULL),
(149, 1063, 1, 2, NULL),
(149, 1064, 0, 1, NULL),
(149, 1065, 0, 5, NULL),
(149, 1066, 0, 3, NULL),
(149, 1067, 0, 4, NULL),
(150, 1008, 0, 1, NULL),
(150, 1009, 0, 5, NULL),
(150, 1010, 1, 4, NULL),
(150, 1011, 0, 2, NULL),
(150, 1012, 0, 3, NULL),
(151, 1148, 1, 2, NULL),
(151, 1149, 0, 3, NULL),
(151, 1150, 0, 5, NULL),
(151, 1151, 0, 1, NULL),
(151, 1152, 0, 4, NULL),
(152, 1118, 1, 3, NULL),
(152, 1119, 0, 1, NULL),
(152, 1120, 0, 4, NULL),
(152, 1121, 0, 5, NULL),
(152, 1122, 0, 2, NULL),
(153, 1033, 0, 3, NULL),
(153, 1034, 0, 5, NULL),
(153, 1035, 1, 2, NULL),
(153, 1036, 0, 4, NULL),
(153, 1037, 0, 1, NULL),
(154, 1043, 0, 3, NULL),
(154, 1044, 1, 5, NULL),
(154, 1045, 0, 2, NULL),
(154, 1046, 0, 1, NULL),
(154, 1047, 0, 4, NULL),
(155, 1048, 1, 3, NULL),
(155, 1049, 0, 5, NULL),
(155, 1050, 0, 1, NULL),
(155, 1051, 0, 2, NULL),
(155, 1052, 0, 4, NULL),
(156, 1003, 1, 1, NULL),
(156, 1004, 0, 3, NULL),
(156, 1005, 0, 5, NULL),
(156, 1006, 0, 2, NULL),
(156, 1007, 0, 4, NULL),
(157, 1123, 1, 1, NULL),
(157, 1124, 0, 5, NULL),
(157, 1125, 0, 2, NULL),
(157, 1126, 0, 3, NULL),
(157, 1127, 0, 4, NULL),
(158, 988, 0, 2, NULL),
(158, 989, 1, 3, NULL),
(158, 990, 0, 4, NULL),
(158, 991, 0, 1, NULL),
(158, 992, 0, 5, NULL),
(159, 1153, 1, 1, NULL),
(159, 1154, 0, 5, NULL),
(159, 1155, 0, 3, NULL),
(159, 1156, 0, 2, NULL),
(159, 1157, 0, 4, NULL),
(160, 1108, 1, 1, NULL),
(160, 1109, 0, 2, NULL),
(160, 1110, 0, 5, NULL),
(160, 1111, 0, 4, NULL),
(160, 1112, 0, 3, NULL),
(161, 1068, 1, 2, NULL),
(161, 1069, 0, 5, NULL),
(161, 1070, 0, 4, NULL),
(161, 1071, 0, 1, NULL),
(161, 1072, 0, 3, NULL),
(162, 1028, 1, 2, NULL),
(162, 1029, 0, 4, NULL),
(162, 1030, 0, 3, NULL),
(162, 1031, 0, 5, NULL),
(162, 1032, 0, 1, NULL),
(163, 1018, 0, 3, NULL),
(163, 1019, 1, 5, NULL),
(163, 1020, 0, 4, NULL),
(163, 1021, 0, 2, NULL),
(163, 1022, 0, 1, NULL),
(164, 1128, 1, 3, NULL),
(164, 1129, 0, 1, NULL),
(164, 1130, 0, 4, NULL),
(164, 1131, 0, 2, NULL),
(164, 1132, 0, 5, NULL),
(165, 1023, 1, 2, NULL),
(165, 1024, 0, 5, NULL),
(165, 1025, 0, 3, NULL),
(165, 1026, 0, 4, NULL),
(165, 1027, 0, 1, NULL),
(166, 1098, 1, 4, NULL),
(166, 1099, 0, 3, NULL),
(166, 1100, 0, 5, NULL),
(166, 1101, 0, 1, NULL),
(166, 1102, 0, 2, NULL),
(167, 978, 0, 4, NULL),
(167, 979, 1, 3, NULL),
(167, 980, 0, 5, NULL),
(167, 981, 0, 2, NULL),
(167, 982, 0, 1, NULL),
(168, 1158, 1, 4, NULL),
(168, 1159, 0, 2, NULL),
(168, 1160, 0, 1, NULL),
(168, 1161, 0, 5, NULL),
(168, 1162, 0, 3, NULL),
(169, 1038, 0, 3, NULL),
(169, 1039, 1, 1, NULL),
(169, 1040, 0, 5, NULL),
(169, 1041, 0, 4, NULL),
(169, 1042, 0, 2, NULL),
(170, 853, 0, 4, NULL),
(170, 854, 0, 2, NULL),
(170, 855, 0, 1, NULL),
(170, 856, 1, 3, NULL),
(170, 857, 0, 5, NULL),
(171, 793, 0, 5, NULL),
(171, 794, 0, 2, NULL),
(171, 795, 1, 3, NULL),
(171, 796, 0, 4, NULL),
(171, 797, 0, 1, NULL),
(172, 813, 0, 4, NULL),
(172, 814, 0, 2, NULL),
(172, 815, 0, 1, NULL),
(172, 816, 1, 3, NULL),
(172, 817, 0, 5, NULL),
(173, 848, 0, 2, NULL),
(173, 849, 1, 5, NULL),
(173, 850, 0, 1, NULL),
(173, 851, 0, 4, NULL),
(173, 852, 0, 3, NULL),
(174, 778, 0, 1, NULL),
(174, 779, 0, 2, NULL),
(174, 780, 1, 5, NULL),
(174, 781, 0, 4, NULL),
(174, 782, 0, 3, NULL),
(175, 868, 0, 1, NULL),
(175, 869, 0, 4, NULL),
(175, 870, 0, 3, NULL),
(175, 871, 1, 5, NULL),
(175, 872, 0, 2, NULL),
(176, 923, 0, 4, NULL),
(176, 924, 1, 1, NULL),
(176, 925, 0, 3, NULL),
(176, 926, 0, 2, NULL),
(176, 927, 0, 5, NULL),
(177, 893, 0, 2, NULL),
(177, 894, 0, 5, NULL),
(177, 895, 0, 1, NULL),
(177, 896, 1, 4, NULL),
(177, 897, 0, 3, NULL),
(178, 963, 0, 3, NULL),
(178, 964, 0, 4, NULL),
(178, 965, 0, 2, NULL),
(178, 966, 0, 5, NULL),
(178, 967, 1, 1, NULL),
(179, 948, 0, 5, NULL),
(179, 949, 0, 2, NULL),
(179, 950, 0, 4, NULL),
(179, 951, 0, 3, NULL),
(179, 952, 1, 1, NULL),
(180, 803, 0, 4, NULL),
(180, 804, 0, 1, NULL),
(180, 805, 0, 3, NULL),
(180, 806, 1, 2, NULL),
(180, 807, 0, 5, NULL),
(181, 833, 1, 1, NULL),
(181, 834, 0, 3, NULL),
(181, 835, 0, 5, NULL),
(181, 836, 0, 4, NULL),
(181, 837, 0, 2, NULL),
(182, 968, 0, 2, NULL),
(182, 969, 0, 4, NULL),
(182, 970, 1, 5, NULL),
(182, 971, 0, 3, NULL),
(182, 972, 0, 1, NULL),
(183, 863, 1, 4, NULL),
(183, 864, 0, 2, NULL),
(183, 865, 0, 5, NULL),
(183, 866, 0, 3, NULL),
(183, 867, 0, 1, NULL),
(184, 888, 0, 2, NULL),
(184, 889, 0, 4, NULL),
(184, 890, 0, 1, NULL),
(184, 891, 0, 3, NULL),
(184, 892, 1, 5, NULL),
(185, 873, 0, 1, NULL),
(185, 874, 0, 5, NULL),
(185, 875, 0, 3, NULL),
(185, 876, 0, 4, NULL),
(185, 877, 1, 2, NULL),
(186, 938, 1, 3, NULL),
(186, 939, 0, 4, NULL),
(186, 940, 0, 5, NULL),
(186, 941, 0, 2, NULL),
(186, 942, 0, 1, NULL),
(187, 903, 0, 2, NULL),
(187, 904, 0, 3, NULL),
(187, 905, 1, 5, NULL),
(187, 906, 0, 4, NULL),
(187, 907, 0, 1, NULL),
(188, 828, 0, 4, NULL),
(188, 829, 0, 2, NULL),
(188, 830, 1, 3, NULL),
(188, 831, 0, 5, NULL),
(188, 832, 0, 1, NULL),
(189, 798, 0, 1, NULL),
(189, 799, 0, 3, NULL),
(189, 800, 0, 5, NULL),
(189, 801, 1, 4, NULL),
(189, 802, 0, 2, NULL),
(190, 933, 0, 3, NULL),
(190, 934, 0, 2, NULL),
(190, 935, 0, 4, NULL),
(190, 936, 1, 5, NULL),
(190, 937, 0, 1, NULL),
(191, 883, 0, 3, NULL),
(191, 884, 0, 5, NULL),
(191, 885, 0, 2, NULL),
(191, 886, 1, 1, NULL),
(191, 887, 0, 4, NULL),
(192, 958, 0, 4, NULL),
(192, 959, 0, 1, NULL),
(192, 960, 0, 2, NULL),
(192, 961, 1, 5, NULL),
(192, 962, 0, 3, NULL),
(193, 788, 0, 5, NULL),
(193, 789, 0, 4, NULL),
(193, 790, 0, 1, NULL),
(193, 791, 0, 3, NULL),
(193, 792, 1, 2, NULL),
(194, 783, 0, 4, NULL),
(194, 784, 0, 1, NULL),
(194, 785, 1, 3, NULL),
(194, 786, 0, 2, NULL),
(194, 787, 0, 5, NULL),
(195, 918, 0, 3, NULL),
(195, 919, 0, 4, NULL),
(195, 920, 1, 5, NULL),
(195, 921, 0, 2, NULL),
(195, 922, 0, 1, NULL),
(196, 913, 0, 3, NULL),
(196, 914, 0, 5, NULL),
(196, 915, 1, 4, NULL),
(196, 916, 0, 2, NULL),
(196, 917, 0, 1, NULL),
(197, 823, 0, 3, NULL),
(197, 824, 0, 2, NULL),
(197, 825, 1, 5, NULL),
(197, 826, 0, 1, NULL),
(197, 827, 0, 4, NULL),
(198, 943, 0, 1, NULL),
(198, 944, 0, 5, NULL),
(198, 945, 0, 4, NULL),
(198, 946, 1, 2, NULL),
(198, 947, 0, 3, NULL),
(199, 808, 0, 2, NULL),
(199, 809, 0, 3, NULL),
(199, 810, 1, 5, NULL),
(199, 811, 0, 4, NULL),
(199, 812, 0, 1, NULL),
(200, 878, 0, 5, NULL),
(200, 879, 0, 1, NULL),
(200, 880, 0, 2, NULL),
(200, 881, 1, 4, NULL),
(200, 882, 0, 3, NULL),
(201, 843, 0, 3, NULL),
(201, 844, 0, 1, NULL),
(201, 845, 0, 5, NULL),
(201, 846, 1, 2, NULL),
(201, 847, 0, 4, NULL),
(202, 908, 0, 3, NULL),
(202, 909, 0, 2, NULL),
(202, 910, 1, 1, NULL),
(202, 911, 0, 4, NULL),
(202, 912, 0, 5, NULL),
(203, 898, 0, 1, NULL),
(203, 899, 1, 5, NULL),
(203, 900, 0, 2, NULL),
(203, 901, 0, 4, NULL),
(203, 902, 0, 3, NULL),
(204, 953, 0, 1, NULL),
(204, 954, 0, 5, NULL),
(204, 955, 0, 2, NULL),
(204, 956, 1, 3, NULL),
(204, 957, 0, 4, NULL),
(205, 858, 0, 4, NULL),
(205, 859, 0, 5, NULL),
(205, 860, 1, 1, NULL),
(205, 861, 0, 3, NULL),
(205, 862, 0, 2, NULL),
(206, 838, 0, 3, NULL),
(206, 839, 0, 5, NULL),
(206, 840, 1, 1, NULL),
(206, 841, 0, 4, NULL),
(206, 842, 0, 2, NULL),
(207, 773, 0, 4, NULL),
(207, 774, 1, 5, NULL),
(207, 775, 0, 1, NULL),
(207, 776, 0, 3, NULL),
(207, 777, 0, 2, NULL),
(208, 818, 0, 1, NULL),
(208, 819, 0, 3, NULL),
(208, 820, 1, 2, NULL),
(208, 821, 0, 5, NULL),
(208, 822, 0, 4, NULL),
(209, 928, 0, 5, NULL),
(209, 929, 0, 2, NULL),
(209, 930, 0, 3, NULL),
(209, 931, 1, 1, NULL),
(209, 932, 0, 4, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_tes_token`
--

CREATE TABLE `cbt_tes_token` (
  `token_id` int(11) NOT NULL,
  `token_isi` varchar(20) NOT NULL,
  `token_user_id` int(11) NOT NULL,
  `token_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token_aktif` int(11) NOT NULL DEFAULT '1' COMMENT 'Umur Token dalam menit, 1 = 1 hari penuh',
  `token_tes_id` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_tes_topik_set`
--

CREATE TABLE `cbt_tes_topik_set` (
  `tset_id` bigint(20) UNSIGNED NOT NULL,
  `tset_tes_id` bigint(20) UNSIGNED NOT NULL,
  `tset_topik_id` bigint(20) UNSIGNED NOT NULL,
  `tset_tipe` smallint(6) NOT NULL DEFAULT '1',
  `tset_difficulty` smallint(6) NOT NULL DEFAULT '1',
  `tset_jumlah` smallint(6) NOT NULL DEFAULT '1',
  `tset_jawaban` smallint(6) NOT NULL DEFAULT '0',
  `tset_acak_jawaban` int(11) NOT NULL DEFAULT '1',
  `tset_acak_soal` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cbt_tes_topik_set`
--

INSERT INTO `cbt_tes_topik_set` (`tset_id`, `tset_tes_id`, `tset_topik_id`, `tset_tipe`, `tset_difficulty`, `tset_jumlah`, `tset_jawaban`, `tset_acak_jawaban`, `tset_acak_soal`) VALUES
(2, 3, 4, 1, 1, 40, 5, 1, 1),
(3, 4, 5, 1, 1, 40, 5, 1, 1),
(4, 5, 6, 1, 1, 40, 5, 1, 1),
(5, 6, 7, 1, 1, 40, 5, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_tes_user`
--

CREATE TABLE `cbt_tes_user` (
  `tesuser_id` bigint(20) UNSIGNED NOT NULL,
  `tesuser_tes_id` bigint(20) UNSIGNED NOT NULL,
  `tesuser_user_id` bigint(20) UNSIGNED NOT NULL,
  `tesuser_status` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `tesuser_creation_time` datetime NOT NULL,
  `tesuser_comment` text COLLATE utf8_unicode_ci,
  `tesuser_token` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tesuser_lock_time` datetime DEFAULT NULL,
  `tesuser_unlock_request` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cbt_tes_user`
--

INSERT INTO `cbt_tes_user` (`tesuser_id`, `tesuser_tes_id`, `tesuser_user_id`, `tesuser_status`, `tesuser_creation_time`, `tesuser_comment`, `tesuser_token`, `tesuser_lock_time`, `tesuser_unlock_request`) VALUES
(2, 3, 9, 4, '2026-04-22 16:22:33', NULL, NULL, NULL, 0),
(3, 6, 9, 4, '2026-04-22 16:39:34', NULL, NULL, NULL, 0),
(4, 5, 9, 4, '2026-04-22 17:00:51', NULL, NULL, NULL, 0),
(5, 4, 9, 4, '2026-04-22 17:12:43', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_topik`
--

CREATE TABLE `cbt_topik` (
  `topik_id` bigint(20) UNSIGNED NOT NULL,
  `topik_modul_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `topik_grup_id` bigint(20) UNSIGNED DEFAULT '0',
  `topik_nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `topik_detail` text COLLATE utf8_unicode_ci,
  `topik_aktif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cbt_topik`
--

INSERT INTO `cbt_topik` (`topik_id`, `topik_modul_id`, `topik_grup_id`, `topik_nama`, `topik_detail`, `topik_aktif`) VALUES
(1, 9, 0, 'BAHASA INDONESIA VI', 'Mata Pelajaran Bahasa Indonesia Wajib', 1),
(2, 9, 0, 'MATEMATIKA', NULL, 1),
(3, 9, 0, 'BAHASA INDONESIA V', NULL, 1),
(4, 10, 0, 'BAHASA INGGRIS', NULL, 1),
(5, 10, 0, 'PJOK', NULL, 1),
(6, 10, 0, 'GEOGRAFI', NULL, 1),
(7, 10, 0, 'BAHASA INGGRIS LANJUTAN', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_user`
--

CREATE TABLE `cbt_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_login` int(11) NOT NULL DEFAULT '0' COMMENT '0=Tidak Login, 1=Login',
  `user_login_date` date DEFAULT NULL,
  `user_grup_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_ip` varchar(39) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_birth_place` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_birth_date` date DEFAULT NULL,
  `user_address` text COLLATE utf8_unicode_ci,
  `user_foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_birthdate` date DEFAULT NULL,
  `user_birthplace` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_level` smallint(3) UNSIGNED NOT NULL DEFAULT '1',
  `user_detail` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_reset_request` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cbt_user`
--

INSERT INTO `cbt_user` (`user_id`, `user_login`, `user_login_date`, `user_grup_id`, `user_name`, `user_password`, `user_email`, `user_regdate`, `user_ip`, `user_firstname`, `user_birth_place`, `user_birth_date`, `user_address`, `user_foto`, `user_birthdate`, `user_birthplace`, `user_level`, `user_detail`, `user_reset_request`) VALUES
(4, 0, '2026-04-17', 1, 'L4UIXT', 'L5RD8Y', '', '2026-04-13 17:42:40', NULL, 'Siswa1', 'Lampung Barat', '2000-04-28', NULL, 'L4UIXT.jpg', NULL, NULL, 1, '', 0),
(5, 0, '2026-04-15', 1, 'AF6XI2', 'H40AXL', '', '2026-04-13 18:25:30', NULL, 'Siswa2', 'Lampung Barat', '2001-01-01', NULL, NULL, NULL, NULL, 1, '', 0),
(6, 0, '2026-04-19', 1, 'Q49KJ3', 'GHNUT3', '', '2026-04-14 07:48:20', NULL, 'Siswa3', 'Lampung Barat', '2009-05-31', NULL, 'Q49KJ3.jpg', NULL, NULL, 1, '', 0),
(7, 0, NULL, 1, 'FIV2A5', 'CH1JF4', '', '2026-04-16 01:37:44', NULL, 'Siswa4', 'Lampung Barat', '2002-02-02', NULL, 'FIV2A5.jpg', NULL, NULL, 1, '', 0),
(8, 0, '2026-04-20', 1, 'CWF8E0', 'VYFMKL', '', '2026-04-17 03:40:22', NULL, 'RAISYA MUTIARA AYU', 'SJAKS', '2002-02-02', NULL, 'CWF8E0.jpeg', NULL, NULL, 1, '', 0),
(9, 1, '2026-04-22', 1, 'B3O8X2', '8F2HL7', '', '2026-04-22 08:07:10', NULL, 'EXSEL ALEXSANDER', 'Lampung Barat', '2009-09-09', NULL, NULL, NULL, NULL, 1, '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbt_user_grup`
--

CREATE TABLE `cbt_user_grup` (
  `grup_id` bigint(20) UNSIGNED NOT NULL,
  `grup_nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cbt_user_grup`
--

INSERT INTO `cbt_user_grup` (`grup_id`, `grup_nama`) VALUES
(1, 'XII F');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `opsi1` varchar(75) NOT NULL,
  `opsi2` varchar(75) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `level` varchar(50) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `opsi1`, `opsi2`, `keterangan`, `level`, `ts`, `foto`) VALUES
(2, 'Maul', '911d90a2e47f51935b5df0a53c9a9b36a61b6405', 'M. Aziz Sulaiman', '', '', '', 'admin', '2026-04-16 06:33:35', NULL),
(3, 'MaulDev', '911d90a2e47f51935b5df0a53c9a9b36a61b6405', 'M. Aziz Sulaiman', '', '', '', 'developer', '2026-04-22 02:59:57', NULL),
(4, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', '', '', 'admin', 'admin', '2026-04-22 07:45:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_akses`
--

CREATE TABLE `user_akses` (
  `id` int(11) NOT NULL,
  `level` varchar(75) NOT NULL,
  `kode_menu` varchar(50) NOT NULL,
  `add` int(2) NOT NULL DEFAULT '1' COMMENT '0=false, 1=true',
  `edit` int(2) NOT NULL DEFAULT '1' COMMENT '0=false, 1=true'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_akses`
--

INSERT INTO `user_akses` (`id`, `level`, `kode_menu`, `add`, `edit`) VALUES
(254, 'operator-soal', 'modul-daftar', 1, 1),
(258, 'operator-soal', 'modul-topik', 1, 1),
(259, 'operator-tes', 'tes-hasil-operator', 1, 1),
(260, 'operator-tes', 'tes-token', 1, 1),
(481, 'admin', 'laporan-analisis-butir-soal', 1, 1),
(482, 'admin', 'peserta-kartu', 1, 1),
(483, 'admin', 'peserta-group', 1, 1),
(484, 'admin', 'peserta-daftar', 1, 1),
(485, 'admin', 'modul-daftar', 1, 1),
(486, 'admin', 'tes-daftar', 1, 1),
(488, 'admin', 'tes-evaluasi', 1, 1),
(491, 'admin', 'tes-hasil', 1, 1),
(492, 'admin', 'peserta-import', 1, 1),
(496, 'admin', 'user_level', 1, 1),
(497, 'admin', 'user_menu', 1, 1),
(498, 'admin', 'user_atur', 1, 1),
(499, 'admin', 'user-zyacbt', 1, 1),
(500, 'admin', 'laporan-rekap', 1, 1),
(502, 'admin', 'tes-tambah', 1, 1),
(503, 'admin', 'tes-token', 1, 1),
(504, 'admin', 'modul-topik', 1, 1),
(505, 'admin', 'peserta-reset', 1, 1),
(506, 'admin', 'tes-pelanggaran', 1, 1),
(507, 'operator-tes', 'tes-pelanggaran', 1, 1),
(530, 'admin', 'modul-menjodohkan', 1, 1),
(531, 'operator-soal', 'modul-menjodohkan', 1, 1),
(533, 'admin', 'soal-pg', 1, 1),
(534, 'admin', 'soal-checklist', 1, 1),
(535, 'admin', 'soal-tf', 1, 1),
(536, 'admin', 'soal-essay', 1, 1),
(537, 'admin', 'soal-isiansingkat', 1, 1),
(538, 'admin', 'master-modul', 1, 1),
(545, 'developer', 'dev-dashboard', 1, 1),
(546, 'developer', 'dev-identity', 1, 1),
(547, 'developer', 'tool-update', 1, 1),
(548, 'developer', 'dev-logs', 1, 1),
(549, 'developer', 'dev-db', 1, 1),
(550, 'developer', 'dev-maintenance', 1, 1),
(551, 'developer', 'dev-css', 1, 1),
(552, 'developer', 'dev-storage', 1, 1),
(553, 'developer', 'dev-sessions', 1, 1),
(554, 'developer', 'dev-integrity', 1, 1),
(555, 'developer', 'dev-monitor', 1, 1),
(556, 'admin', 'tes-jadwal', 1, 1),
(557, 'admin', 'peserta-daftarhadir', 1, 1),
(558, 'admin', 'tes-berita-acara', 1, 1),
(559, 'admin', 'tes-laporan-pelaksanaan', 1, 1),
(560, 'admin', 'master-jadwal', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_level`
--

CREATE TABLE `user_level` (
  `id` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_level`
--

INSERT INTO `user_level` (`id`, `level`, `keterangan`) VALUES
(1, 'admin', 'Administrator'),
(7, 'operator-soal', 'Operator Soal'),
(8, 'operator-tes', 'Operator Tes'),
(9, 'developer', 'System Developer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `log` varchar(250) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_log`
--

INSERT INTO `user_log` (`id`, `username`, `log`, `ts`) VALUES
(1, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 02:56:15'),
(2, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-14 02:56:28'),
(3, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-3)', '2026-04-14 02:56:29'),
(4, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 03:00:56'),
(5, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-14 03:00:56'),
(6, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-14 03:04:10'),
(7, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-4)', '2026-04-14 03:04:10'),
(8, 'AF6XI2', 'Siswa Siswa2 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 03:06:15'),
(9, 'AF6XI2', 'Siswa Siswa2 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-14 03:06:15'),
(10, 'AF6XI2', 'Siswa Siswa2 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 03:06:37'),
(11, 'AF6XI2', 'Siswa Siswa2 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 03:07:21'),
(12, 'AF6XI2', 'Siswa Siswa2 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-14 03:07:27'),
(13, 'AF6XI2', 'Siswa Siswa2 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 03:07:59'),
(14, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-1)', '2026-04-14 03:09:10'),
(15, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-1)', '2026-04-14 03:10:17'),
(16, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-1)', '2026-04-14 03:11:36'),
(17, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 03:36:09'),
(18, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-14 03:36:10'),
(19, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-3)', '2026-04-14 03:40:38'),
(20, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 08:00:36'),
(21, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-14 08:00:36'),
(22, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-1)', '2026-04-14 08:02:25'),
(23, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-1)', '2026-04-14 08:02:41'),
(24, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-1)', '2026-04-14 08:03:57'),
(25, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 08:05:33'),
(26, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-14 08:05:33'),
(27, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-3)', '2026-04-14 08:05:40'),
(28, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-1)', '2026-04-14 08:06:10'),
(29, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-1)', '2026-04-14 08:06:14'),
(30, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 08:06:44'),
(31, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-14 08:06:45'),
(32, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-3)', '2026-04-14 08:08:28'),
(33, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 08:09:44'),
(34, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-14 08:09:44'),
(35, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-14 08:28:13'),
(36, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-4)', '2026-04-14 08:28:13'),
(37, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 14:36:59'),
(38, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-14 14:36:59'),
(39, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-14 14:37:17'),
(40, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-4)', '2026-04-14 14:37:17'),
(41, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 14:42:38'),
(42, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-14 14:43:04'),
(43, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-3)', '2026-04-14 14:43:19'),
(44, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 15:04:58'),
(45, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-14 15:05:40'),
(46, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-3)', '2026-04-14 15:05:40'),
(47, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 15:16:05'),
(48, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-14 15:16:05'),
(49, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-14 15:17:15'),
(50, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-14 15:17:15'),
(51, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 13:40:24'),
(52, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-15 13:40:24'),
(53, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-15 13:40:25'),
(54, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-4)', '2026-04-15 13:40:25'),
(55, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-5)', '2026-04-15 13:40:26'),
(56, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 13:44:59'),
(57, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-15 13:44:59'),
(58, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-4)', '2026-04-15 13:45:01'),
(59, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-15 13:45:01'),
(60, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-15 13:49:11'),
(61, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 13:49:11'),
(62, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 13:53:26'),
(63, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-15 13:53:26'),
(64, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-15 13:53:34'),
(65, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 13:54:30'),
(66, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-15 13:54:30'),
(67, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-4)', '2026-04-15 13:54:37'),
(68, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-15 13:54:37'),
(69, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-2)', '2026-04-15 13:58:09'),
(70, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 13:58:09'),
(71, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-15 13:58:19'),
(72, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-4)', '2026-04-15 13:58:19'),
(73, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-5)', '2026-04-15 13:58:24'),
(74, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-6)', '2026-04-15 13:58:29'),
(75, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 14:02:35'),
(76, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-15 14:02:43'),
(77, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 14:03:02'),
(78, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-15 14:03:06'),
(79, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-15 14:03:10'),
(80, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-4)', '2026-04-15 14:03:16'),
(81, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 14:10:07'),
(82, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-15 14:10:12'),
(83, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-15 14:10:17'),
(84, 'AF6XI2', 'Siswa Siswa2 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 14:39:21'),
(85, 'AF6XI2', 'Siswa Siswa2 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-15 14:39:47'),
(86, 'AF6XI2', 'Siswa Siswa2 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 14:40:06'),
(87, 'AF6XI2', 'Siswa Siswa2 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-15 14:40:10'),
(88, 'AF6XI2', 'Siswa Siswa2 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-15 14:40:13'),
(89, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 14:56:15'),
(90, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-15 14:56:19'),
(91, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-15 14:56:23'),
(92, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-4)', '2026-04-15 14:56:27'),
(93, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 15:00:59'),
(94, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-15 15:01:04'),
(95, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-15 15:01:11'),
(96, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-4)', '2026-04-15 15:01:16'),
(97, 'AF6XI2', 'Siswa Siswa2 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 15:36:04'),
(98, 'Q49KJ3', 'Siswa Siswa3 melakukan pelanggaran: Pindah Layar/Tab (Ke-1)', '2026-04-15 15:40:28'),
(99, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-15 17:44:29'),
(100, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-15 17:44:33'),
(101, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-15 17:44:37'),
(102, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-4)', '2026-04-15 17:44:42'),
(103, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-16 03:55:07'),
(104, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-16 03:55:17'),
(105, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Pindah Layar/Tab (Ke-3)', '2026-04-16 03:55:22'),
(106, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-4)', '2026-04-16 03:55:24'),
(107, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-16 04:12:49'),
(108, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-16 04:12:51'),
(109, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-16 04:12:58'),
(110, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-4)', '2026-04-16 04:13:02'),
(111, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-16 04:23:49'),
(112, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-16 04:23:55'),
(113, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-16 04:23:59'),
(114, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-17 03:16:22'),
(115, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-17 03:16:27'),
(116, 'L4UIXT', 'Siswa Siswa1 melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-17 03:16:32'),
(117, 'CWF8E0', 'Siswa NAELA AFIFATUN NISA melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-20 01:47:55'),
(118, 'CWF8E0', 'Siswa NAELA AFIFATUN NISA melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-20 01:48:01'),
(119, 'CWF8E0', 'Siswa NAELA AFIFATUN NISA melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-20 01:48:09'),
(120, 'CWF8E0', 'Siswa NAELA AFIFATUN NISA melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-4)', '2026-04-20 01:48:12'),
(121, 'CWF8E0', 'Siswa RAISYA MUTIARA AYU melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-20 01:55:26'),
(122, 'CWF8E0', 'Siswa RAISYA MUTIARA AYU melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-20 01:55:42'),
(123, 'CWF8E0', 'Siswa RAISYA MUTIARA AYU melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-3)', '2026-04-20 01:55:53'),
(124, 'CWF8E0', 'Siswa RAISYA MUTIARA AYU melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-1)', '2026-04-20 01:59:54'),
(125, 'CWF8E0', 'Siswa RAISYA MUTIARA AYU melakukan pelanggaran: Aplikasi Lain/Notifikasi (Ke-2)', '2026-04-20 02:00:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `tipe` int(11) NOT NULL DEFAULT '1' COMMENT '0=parent, 1=child',
  `parent` varchar(50) DEFAULT NULL,
  `kode_menu` varchar(50) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `url` varchar(150) NOT NULL DEFAULT '#',
  `icon` varchar(75) NOT NULL DEFAULT 'fa fa-circle-o',
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `tipe`, `parent`, `kode_menu`, `nama_menu`, `url`, `icon`, `urutan`) VALUES
(1, 0, '', 'user', 'Pengaturan', '#', 'fa fa-sliders', 20),
(3, 1, 'user', 'user_atur', 'Pengaturan User', 'manager/useratur', 'fa fa-user', 5),
(4, 1, 'user', 'user_level', 'Pengaturan Level', 'manager/userlevel', 'fa fa-shield', 6),
(5, 1, 'user', 'user_menu', 'Pengaturan Menu', 'manager/usermenu', 'fa fa-th-list', 7),
(6, 0, '', 'modul', 'Bank Soal', '#', 'fa fa-bank', 2),
(7, 1, 'modul', 'modul-daftar', 'Daftar Soal', 'manager/modul_daftar', 'fa fa-file-text-o', 1),
(8, 1, 'datamaster', 'modul-topik', 'Mata Pelajaran', 'manager/modul_topik', 'fa fa-book', 2),
(10, 0, '', 'peserta', 'Data Siswa', '#', 'fa fa-graduation-cap', 3),
(11, 1, 'peserta', 'peserta-daftar', 'Daftar Siswa', 'manager/peserta_daftar', 'fa fa-user-plus', 2),
(12, 1, 'datamaster', 'peserta-group', 'Daftar Kelas', 'manager/peserta_group', 'fa fa-bank', 3),
(13, 1, 'peserta', 'peserta-import', 'Import Data Siswa', 'manager/peserta_import', 'fa fa-upload', 3),
(14, 0, '', 'tes', 'Data Ujian', '#', 'fa fa-pencil-square-o', 4),
(15, 1, 'tes', 'tes-tambah', 'Tambah Ujian', 'manager/tes_tambah', 'fa fa-plus-circle', 1),
(16, 1, 'tes', 'tes-daftar', 'Daftar Ujian', 'manager/tes_daftar', 'fa fa-calendar', 2),
(17, 1, 'tes', 'tes-hasil', 'Hasil Ujian', 'manager/tes_hasil', 'fa fa-file-text', 6),
(19, 1, 'tes', 'tes-token', 'Token', 'manager/tes_token', 'fa fa-ticket', 8),
(25, 1, 'tes', 'tes-evaluasi', 'Evaluasi Ujian', 'manager/tes_evaluasi', 'fa fa-edit', 5),
(28, 1, 'tes', 'tes-hasil-operator', 'Hasil Ujian Operator', 'manager/tes_hasil_operator', 'fa fa-user-secret', 10),
(32, 1, 'tes-laporan', 'laporan-rekap', 'Rekap Hasil Ujian', 'manager/laporan_rekap_hasil', 'fa fa-clipboard', 7),
(34, 1, 'user', 'user-zyacbt', 'Pengaturan Aplikasi', 'manager/pengaturan_mhcbt', 'fa fa-cogs', 1),
(37, 1, 'peserta', 'peserta-kartu', 'Cetak Kartu Siswa', 'manager/peserta_kartu', 'fa fa-credit-card', 5),
(38, 0, '', 'tes-laporan', 'Laporan', '#', 'fa fa-bar-chart', 5),
(41, 1, 'tes-laporan', 'laporan-analisis-butir-soal', 'Analisis Butir Soal', 'manager/laporan_analisis_butir_soal', 'fa fa-pie-chart', 1),
(42, 1, 'tes-laporan', 'laporan-analisis-soal', 'Analisis Soal', 'manager/laporan_analisis_soal', 'fa fa-line-chart', 2),
(44, 1, 'tes', 'peserta-reset', 'Reset', 'manager/peserta_reset', 'fa fa-refresh', 100),
(45, 1, 'tes', 'tes-pelanggaran', 'Pelanggaran', 'manager/tes_pelanggaran', 'fa fa-warning', 99),
(62, 1, 'modul', 'modul-menjodohkan', 'Soal Menjodohkan', 'manager/modul_menjodohkan', 'fa fa-exchange', 5),
(63, 0, '', 'datamaster', 'Data Master', '#', 'fa fa-database', 1),
(64, 1, 'modul', 'soal-pg', 'Soal Pilihan Ganda', 'manager/modul_pilihanganda', 'fa fa-check-square-o', 2),
(65, 1, 'modul', 'soal-checklist', 'Soal Checklist', 'manager/modul_checklist', 'fa fa-list-ul', 6),
(66, 1, 'modul', 'soal-tf', 'Soal Benar / Salah', 'manager/modul_truefalse', 'fa fa-toggle-on', 7),
(67, 1, 'modul', 'soal-essay', 'Soal Essay', 'manager/modul_essay', 'fa fa-pencil-square-o', 3),
(68, 1, 'modul', 'soal-isiansingkat', 'Soal Isian Singkat', 'manager/modul_isiansingkat', 'fa fa-pencil-square', 4),
(71, 1, 'datamaster', 'master-modul', 'Modul', 'manager/modul_master', 'fa fa-folder-open', 1),
(74, 1, 'dev-studio', 'tool-update', 'Update System', 'manager/system_update', 'fa fa-circle-o', 100),
(75, 0, '', 'dev-studio', 'Developer Studio', '#', 'fa fa-terminal', 0),
(76, 1, 'dev-studio', 'dev-dashboard', 'Dev Dashboard', 'manager/developer_studio', 'fa fa-dashboard', 1),
(77, 1, 'dev-studio', 'dev-identity', 'Identity Hub', 'manager/developer_studio/identity', 'fa fa-shield', 2),
(79, 1, 'dev-studio', 'dev-logs', 'Log Explorer', 'manager/developer_studio/logs', 'fa fa-file-text-o', 3),
(80, 1, 'dev-studio', 'dev-db', 'Database Forge', 'manager/developer_studio/database', 'fa fa-database', 4),
(81, 1, 'dev-studio', 'dev-maintenance', 'Maintenance Mode', 'manager/developer_studio/maintenance', 'fa fa-toggle-on', 5),
(82, 1, 'dev-studio', 'dev-css', 'Custom CSS Studio', 'manager/developer_studio/css_studio', 'fa fa-paint-brush', 6),
(83, 1, 'dev-studio', 'dev-storage', 'Storage Analytics', 'manager/developer_studio/storage', 'fa fa-hdd-o', 7),
(84, 1, 'dev-studio', 'dev-sessions', 'Session Overlord', 'manager/developer_studio/sessions', 'fa fa-users', 8),
(85, 1, 'dev-studio', 'dev-integrity', 'Code Integrity', 'manager/developer_studio/integrity', 'fa fa-search-plus', 10),
(86, 1, 'dev-studio', 'dev-monitor', 'Live Monitor', 'manager/developer_studio/monitor', 'fa fa-desktop', 11),
(87, 1, 'tes', 'tes-jadwal', 'Jadwal Ujian', 'manager/tes_jadwal', 'fa fa-calendar-check-o', 3),
(88, 1, 'peserta', 'peserta-daftarhadir', 'Cetak Daftar Hadir', 'manager/peserta_daftarhadir', 'fa fa-print', 10),
(89, 1, 'tes-laporan', 'tes-berita-acara', 'Cetak Berita Acara', 'manager/tes_berita_acara', 'fa fa-file-text-o', 10),
(90, 1, 'tes-laporan', 'tes-laporan-pelaksanaan', 'Laporan Pelaksanaan', 'manager/tes_laporan_pelaksanaan', 'fa fa-bar-chart', 11),
(91, 1, 'datamaster', 'master-jadwal', 'Jadwal Ujian', 'manager/master_jadwal', 'fa fa-calendar-check-o', 10);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cbt_jadwal`
--
ALTER TABLE `cbt_jadwal`
  ADD PRIMARY KEY (`jadwal_id`);

--
-- Indeks untuk tabel `cbt_jadwal_grup`
--
ALTER TABLE `cbt_jadwal_grup`
  ADD PRIMARY KEY (`jg_id`),
  ADD KEY `jg_jadwal_id` (`jg_jadwal_id`);

--
-- Indeks untuk tabel `cbt_jadwal_topik`
--
ALTER TABLE `cbt_jadwal_topik`
  ADD PRIMARY KEY (`jt_id`),
  ADD KEY `jt_jadwal_id` (`jt_jadwal_id`);

--
-- Indeks untuk tabel `cbt_jawaban`
--
ALTER TABLE `cbt_jawaban`
  ADD PRIMARY KEY (`jawaban_id`),
  ADD KEY `p_answer_question_id` (`jawaban_soal_id`);

--
-- Indeks untuk tabel `cbt_konfigurasi`
--
ALTER TABLE `cbt_konfigurasi`
  ADD PRIMARY KEY (`konfigurasi_id`),
  ADD UNIQUE KEY `konfigurasi_kode` (`konfigurasi_kode`);

--
-- Indeks untuk tabel `cbt_license_history`
--
ALTER TABLE `cbt_license_history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cbt_modul`
--
ALTER TABLE `cbt_modul`
  ADD PRIMARY KEY (`modul_id`),
  ADD UNIQUE KEY `ak_module_name` (`modul_nama`);

--
-- Indeks untuk tabel `cbt_sessions`
--
ALTER TABLE `cbt_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indeks untuk tabel `cbt_soal`
--
ALTER TABLE `cbt_soal`
  ADD PRIMARY KEY (`soal_id`),
  ADD KEY `p_question_subject_id` (`soal_topik_id`);

--
-- Indeks untuk tabel `cbt_soal_matching`
--
ALTER TABLE `cbt_soal_matching`
  ADD PRIMARY KEY (`matching_id`);

--
-- Indeks untuk tabel `cbt_tes`
--
ALTER TABLE `cbt_tes`
  ADD PRIMARY KEY (`tes_id`),
  ADD UNIQUE KEY `ak_test_name` (`tes_nama`);

--
-- Indeks untuk tabel `cbt_tesgrup`
--
ALTER TABLE `cbt_tesgrup`
  ADD PRIMARY KEY (`tstgrp_tes_id`,`tstgrp_grup_id`),
  ADD KEY `p_tstgrp_test_id` (`tstgrp_tes_id`),
  ADD KEY `p_tstgrp_group_id` (`tstgrp_grup_id`);

--
-- Indeks untuk tabel `cbt_tes_soal`
--
ALTER TABLE `cbt_tes_soal`
  ADD PRIMARY KEY (`tessoal_id`),
  ADD UNIQUE KEY `ak_testuser_question` (`tessoal_tesuser_id`,`tessoal_soal_id`),
  ADD KEY `p_testlog_question_id` (`tessoal_soal_id`),
  ADD KEY `p_testlog_testuser_id` (`tessoal_tesuser_id`);

--
-- Indeks untuk tabel `cbt_tes_soal_jawaban`
--
ALTER TABLE `cbt_tes_soal_jawaban`
  ADD PRIMARY KEY (`soaljawaban_tessoal_id`,`soaljawaban_jawaban_id`),
  ADD KEY `p_logansw_answer_id` (`soaljawaban_jawaban_id`),
  ADD KEY `p_logansw_testlog_id` (`soaljawaban_tessoal_id`);

--
-- Indeks untuk tabel `cbt_tes_token`
--
ALTER TABLE `cbt_tes_token`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `token_user_id` (`token_user_id`);

--
-- Indeks untuk tabel `cbt_tes_topik_set`
--
ALTER TABLE `cbt_tes_topik_set`
  ADD PRIMARY KEY (`tset_id`),
  ADD KEY `p_tsubset_test_id` (`tset_tes_id`),
  ADD KEY `tsubset_subject_id` (`tset_topik_id`);

--
-- Indeks untuk tabel `cbt_tes_user`
--
ALTER TABLE `cbt_tes_user`
  ADD PRIMARY KEY (`tesuser_id`),
  ADD UNIQUE KEY `ak_testuser` (`tesuser_tes_id`,`tesuser_user_id`,`tesuser_status`),
  ADD KEY `p_testuser_user_id` (`tesuser_user_id`),
  ADD KEY `p_testuser_test_id` (`tesuser_tes_id`);

--
-- Indeks untuk tabel `cbt_topik`
--
ALTER TABLE `cbt_topik`
  ADD PRIMARY KEY (`topik_id`),
  ADD UNIQUE KEY `ak_subject_name` (`topik_modul_id`,`topik_nama`),
  ADD KEY `topik_grup_id` (`topik_grup_id`);

--
-- Indeks untuk tabel `cbt_user`
--
ALTER TABLE `cbt_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `ak_user_name` (`user_name`),
  ADD KEY `user_groups_id` (`user_grup_id`),
  ADD KEY `user_detail` (`user_detail`);

--
-- Indeks untuk tabel `cbt_user_grup`
--
ALTER TABLE `cbt_user_grup`
  ADD PRIMARY KEY (`grup_id`),
  ADD UNIQUE KEY `group_name` (`grup_nama`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `level` (`level`);

--
-- Indeks untuk tabel `user_akses`
--
ALTER TABLE `user_akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `akses_kode_menu` (`kode_menu`),
  ADD KEY `akses_level` (`level`);

--
-- Indeks untuk tabel `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `level` (`level`);

--
-- Indeks untuk tabel `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_menu` (`kode_menu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cbt_jadwal`
--
ALTER TABLE `cbt_jadwal`
  MODIFY `jadwal_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cbt_jadwal_grup`
--
ALTER TABLE `cbt_jadwal_grup`
  MODIFY `jg_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cbt_jadwal_topik`
--
ALTER TABLE `cbt_jadwal_topik`
  MODIFY `jt_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cbt_jawaban`
--
ALTER TABLE `cbt_jawaban`
  MODIFY `jawaban_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1373;

--
-- AUTO_INCREMENT untuk tabel `cbt_konfigurasi`
--
ALTER TABLE `cbt_konfigurasi`
  MODIFY `konfigurasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `cbt_license_history`
--
ALTER TABLE `cbt_license_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `cbt_modul`
--
ALTER TABLE `cbt_modul`
  MODIFY `modul_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `cbt_soal`
--
ALTER TABLE `cbt_soal`
  MODIFY `soal_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

--
-- AUTO_INCREMENT untuk tabel `cbt_soal_matching`
--
ALTER TABLE `cbt_soal_matching`
  MODIFY `matching_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `cbt_tes`
--
ALTER TABLE `cbt_tes`
  MODIFY `tes_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `cbt_tes_soal`
--
ALTER TABLE `cbt_tes_soal`
  MODIFY `tessoal_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT untuk tabel `cbt_tes_token`
--
ALTER TABLE `cbt_tes_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cbt_tes_topik_set`
--
ALTER TABLE `cbt_tes_topik_set`
  MODIFY `tset_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `cbt_tes_user`
--
ALTER TABLE `cbt_tes_user`
  MODIFY `tesuser_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `cbt_topik`
--
ALTER TABLE `cbt_topik`
  MODIFY `topik_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `cbt_user`
--
ALTER TABLE `cbt_user`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `cbt_user_grup`
--
ALTER TABLE `cbt_user_grup`
  MODIFY `grup_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_akses`
--
ALTER TABLE `user_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=561;

--
-- AUTO_INCREMENT untuk tabel `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cbt_jadwal_grup`
--
ALTER TABLE `cbt_jadwal_grup`
  ADD CONSTRAINT `cbt_jadwal_grup_ibfk_1` FOREIGN KEY (`jg_jadwal_id`) REFERENCES `cbt_jadwal` (`jadwal_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `cbt_jadwal_topik`
--
ALTER TABLE `cbt_jadwal_topik`
  ADD CONSTRAINT `cbt_jadwal_topik_ibfk_1` FOREIGN KEY (`jt_jadwal_id`) REFERENCES `cbt_jadwal` (`jadwal_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `cbt_jawaban`
--
ALTER TABLE `cbt_jawaban`
  ADD CONSTRAINT `cbt_jawaban_ibfk_1` FOREIGN KEY (`jawaban_soal_id`) REFERENCES `cbt_soal` (`soal_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `cbt_soal`
--
ALTER TABLE `cbt_soal`
  ADD CONSTRAINT `cbt_soal_ibfk_1` FOREIGN KEY (`soal_topik_id`) REFERENCES `cbt_topik` (`topik_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `cbt_tesgrup`
--
ALTER TABLE `cbt_tesgrup`
  ADD CONSTRAINT `cbt_tesgrup_ibfk_1` FOREIGN KEY (`tstgrp_tes_id`) REFERENCES `cbt_tes` (`tes_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cbt_tesgrup_ibfk_2` FOREIGN KEY (`tstgrp_grup_id`) REFERENCES `cbt_user_grup` (`grup_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `cbt_tes_soal`
--
ALTER TABLE `cbt_tes_soal`
  ADD CONSTRAINT `cbt_tes_soal_ibfk_1` FOREIGN KEY (`tessoal_tesuser_id`) REFERENCES `cbt_tes_user` (`tesuser_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cbt_tes_soal_ibfk_2` FOREIGN KEY (`tessoal_soal_id`) REFERENCES `cbt_soal` (`soal_id`) ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `cbt_tes_soal_jawaban`
--
ALTER TABLE `cbt_tes_soal_jawaban`
  ADD CONSTRAINT `cbt_tes_soal_jawaban_ibfk_1` FOREIGN KEY (`soaljawaban_tessoal_id`) REFERENCES `cbt_tes_soal` (`tessoal_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cbt_tes_soal_jawaban_ibfk_2` FOREIGN KEY (`soaljawaban_jawaban_id`) REFERENCES `cbt_jawaban` (`jawaban_id`) ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `cbt_tes_token`
--
ALTER TABLE `cbt_tes_token`
  ADD CONSTRAINT `cbt_tes_token_ibfk_1` FOREIGN KEY (`token_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `cbt_tes_topik_set`
--
ALTER TABLE `cbt_tes_topik_set`
  ADD CONSTRAINT `cbt_tes_topik_set_ibfk_1` FOREIGN KEY (`tset_tes_id`) REFERENCES `cbt_tes` (`tes_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cbt_tes_topik_set_ibfk_2` FOREIGN KEY (`tset_topik_id`) REFERENCES `cbt_topik` (`topik_id`) ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `cbt_tes_user`
--
ALTER TABLE `cbt_tes_user`
  ADD CONSTRAINT `cbt_tes_user_ibfk_1` FOREIGN KEY (`tesuser_tes_id`) REFERENCES `cbt_tes` (`tes_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cbt_tes_user_ibfk_2` FOREIGN KEY (`tesuser_user_id`) REFERENCES `cbt_user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `cbt_topik`
--
ALTER TABLE `cbt_topik`
  ADD CONSTRAINT `cbt_topik_ibfk_1` FOREIGN KEY (`topik_modul_id`) REFERENCES `cbt_modul` (`modul_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `cbt_user`
--
ALTER TABLE `cbt_user`
  ADD CONSTRAINT `cbt_user_ibfk_1` FOREIGN KEY (`user_grup_id`) REFERENCES `cbt_user_grup` (`grup_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`level`) REFERENCES `user_level` (`level`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_akses`
--
ALTER TABLE `user_akses`
  ADD CONSTRAINT `user_akses_ibfk_2` FOREIGN KEY (`kode_menu`) REFERENCES `user_menu` (`kode_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_akses_ibfk_3` FOREIGN KEY (`level`) REFERENCES `user_level` (`level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
