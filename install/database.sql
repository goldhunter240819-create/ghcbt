-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ghcbt
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cbt_jawaban`
--

DROP TABLE IF EXISTS `cbt_jawaban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_jawaban` (
  `jawaban_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jawaban_soal_id` bigint(20) unsigned NOT NULL,
  `jawaban_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `jawaban_benar` tinyint(1) NOT NULL DEFAULT '0',
  `jawaban_aktif` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`jawaban_id`),
  KEY `p_answer_question_id` (`jawaban_soal_id`),
  CONSTRAINT `cbt_jawaban_ibfk_1` FOREIGN KEY (`jawaban_soal_id`) REFERENCES `cbt_soal` (`soal_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_jawaban`
--

LOCK TABLES `cbt_jawaban` WRITE;
/*!40000 ALTER TABLE `cbt_jawaban` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_jawaban` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_konfigurasi`
--

DROP TABLE IF EXISTS `cbt_konfigurasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_konfigurasi` (
  `konfigurasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `konfigurasi_kode` varchar(50) NOT NULL,
  `konfigurasi_isi` varchar(500) NOT NULL,
  `konfigurasi_keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`konfigurasi_id`),
  UNIQUE KEY `konfigurasi_kode` (`konfigurasi_kode`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_konfigurasi`
--

LOCK TABLES `cbt_konfigurasi` WRITE;
/*!40000 ALTER TABLE `cbt_konfigurasi` DISABLE KEYS */;
INSERT INTO `cbt_konfigurasi` VALUES (1,'link_login_operator','tidak','Menampilkan Link Login Operator'),(2,'cbt_nama','Ujian Berbasis Komputer','Nama Penyelenggara ZYACBT'),(3,'cbt_keterangan','GHCBT System','Keterangan Penyelenggara ZYACBT'),(4,'cbt_mobile_lock_xambro','tidak','Melakukan Lock pada browser mobile agar menggunakan Xambro Saja'),(5,'cbt_informasi','<p>Selamat datang di Aplikasi Ujian Berbasis Komputer. Hubungi proktor apabila anda mengalami kesulitan login.</p>','Informasi yang diberika di Dashboard peserta tes\''),(6,'proteksi_multilogin','ya','Proteksi MultiLogin Peserta Tes'),(7,'cbt_tutuptes_logout','tidak','Menutup Tes Peserta saat Peserta Logout'),(8,'cbt_nama_madrasah','Nama Sekolah / Institusi','Nama Madrasah Penyelenggara'),(9,'cbt_tahun_ajaran','2026/2027','Tahun Ajaran Pelaksanaan'),(10,'cbt_kepala_madrasah','Nama Kepala Sekolah, S.Pd.','Nama Kepala Madrasah untuk TTD Kartu'),(11,'cbt_tempat_cetak','Kota / Kabupaten','Tempat pencetakan kartu'),(12,'cbt_show_history','ya','Menampilkan Histori Ujian Siswa');
/*!40000 ALTER TABLE `cbt_konfigurasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_modul`
--

DROP TABLE IF EXISTS `cbt_modul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_modul` (
  `modul_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `modul_nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modul_aktif` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`modul_id`),
  UNIQUE KEY `ak_module_name` (`modul_nama`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_modul`
--

LOCK TABLES `cbt_modul` WRITE;
/*!40000 ALTER TABLE `cbt_modul` DISABLE KEYS */;
INSERT INTO `cbt_modul` VALUES (9,'Default',1),(10,'Modul Simulasi',1),(11,'SUMATIF AKHIR SEMESTER GANJIL',1);
/*!40000 ALTER TABLE `cbt_modul` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_sessions`
--

DROP TABLE IF EXISTS `cbt_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_sessions`
--

LOCK TABLES `cbt_sessions` WRITE;
/*!40000 ALTER TABLE `cbt_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_soal`
--

DROP TABLE IF EXISTS `cbt_soal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_soal` (
  `soal_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `soal_topik_id` bigint(20) unsigned NOT NULL,
  `soal_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `soal_tipe` smallint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1=Pilihan ganda, 2=essay, 3=jawaban singkat',
  `soal_kunci` text COLLATE utf8_unicode_ci COMMENT 'Kunci untuk soal jawaban singkat',
  `soal_difficulty` smallint(6) NOT NULL DEFAULT '1',
  `soal_aktif` tinyint(1) NOT NULL DEFAULT '0',
  `soal_audio` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `soal_audio_play` int(11) NOT NULL DEFAULT '0',
  `soal_timer` smallint(10) DEFAULT NULL,
  `soal_inline_answers` tinyint(1) NOT NULL DEFAULT '0',
  `soal_auto_next` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`soal_id`),
  KEY `p_question_subject_id` (`soal_topik_id`),
  CONSTRAINT `cbt_soal_ibfk_1` FOREIGN KEY (`soal_topik_id`) REFERENCES `cbt_topik` (`topik_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_soal`
--

LOCK TABLES `cbt_soal` WRITE;
/*!40000 ALTER TABLE `cbt_soal` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_soal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_soal_matching`
--

DROP TABLE IF EXISTS `cbt_soal_matching`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_soal_matching` (
  `matching_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `matching_soal_id` bigint(20) unsigned NOT NULL,
  `matching_kiri` text NOT NULL,
  `matching_kanan` text NOT NULL,
  PRIMARY KEY (`matching_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_soal_matching`
--

LOCK TABLES `cbt_soal_matching` WRITE;
/*!40000 ALTER TABLE `cbt_soal_matching` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_soal_matching` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_tes`
--

DROP TABLE IF EXISTS `cbt_tes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_tes` (
  `tes_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tes_nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tes_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `tes_intro` int(11) NOT NULL DEFAULT '0' COMMENT '0=Tidak Aktif, 1=Aktif',
  `tes_intro_isi` longtext COLLATE utf8_unicode_ci,
  `tes_begin_time` datetime DEFAULT NULL,
  `tes_end_time` datetime DEFAULT NULL,
  `tes_duration_time` smallint(10) unsigned NOT NULL DEFAULT '0',
  `tes_ip_range` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '*.*.*.*',
  `tes_results_to_users` tinyint(1) NOT NULL DEFAULT '0',
  `tes_detail_to_users` tinyint(1) NOT NULL DEFAULT '0',
  `tes_score_right` decimal(10,2) DEFAULT '1.00',
  `tes_score_wrong` decimal(10,2) DEFAULT '0.00',
  `tes_score_unanswered` decimal(10,2) DEFAULT '0.00',
  `tes_max_score` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tes_token` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`tes_id`),
  UNIQUE KEY `ak_test_name` (`tes_nama`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_tes`
--

LOCK TABLES `cbt_tes` WRITE;
/*!40000 ALTER TABLE `cbt_tes` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_tes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_tes_soal`
--

DROP TABLE IF EXISTS `cbt_tes_soal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_tes_soal` (
  `tessoal_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tessoal_tesuser_id` bigint(20) unsigned NOT NULL,
  `tessoal_user_ip` varchar(39) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tessoal_soal_id` bigint(20) unsigned NOT NULL,
  `tessoal_jawaban_text` text COLLATE utf8_unicode_ci,
  `tessoal_nilai` decimal(10,2) DEFAULT NULL,
  `tessoal_creation_time` datetime DEFAULT NULL,
  `tessoal_display_time` datetime DEFAULT NULL,
  `tessoal_change_time` datetime DEFAULT NULL,
  `tessoal_reaction_time` bigint(20) unsigned NOT NULL DEFAULT '0',
  `tessoal_ragu` int(1) NOT NULL DEFAULT '0' COMMENT '1=ragu, 0=tidak ragu',
  `tessoal_order` smallint(6) NOT NULL DEFAULT '1',
  `tessoal_num_answers` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tessoal_comment` text COLLATE utf8_unicode_ci,
  `tessoal_audio_play` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tessoal_id`),
  UNIQUE KEY `ak_testuser_question` (`tessoal_tesuser_id`,`tessoal_soal_id`),
  KEY `p_testlog_question_id` (`tessoal_soal_id`),
  KEY `p_testlog_testuser_id` (`tessoal_tesuser_id`),
  CONSTRAINT `cbt_tes_soal_ibfk_1` FOREIGN KEY (`tessoal_tesuser_id`) REFERENCES `cbt_tes_user` (`tesuser_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `cbt_tes_soal_ibfk_2` FOREIGN KEY (`tessoal_soal_id`) REFERENCES `cbt_soal` (`soal_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_tes_soal`
--

LOCK TABLES `cbt_tes_soal` WRITE;
/*!40000 ALTER TABLE `cbt_tes_soal` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_tes_soal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_tes_soal_jawaban`
--

DROP TABLE IF EXISTS `cbt_tes_soal_jawaban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_tes_soal_jawaban` (
  `soaljawaban_tessoal_id` bigint(20) unsigned NOT NULL,
  `soaljawaban_jawaban_id` bigint(20) unsigned NOT NULL,
  `soaljawaban_selected` smallint(6) NOT NULL DEFAULT '-1',
  `soaljawaban_order` smallint(6) NOT NULL DEFAULT '1',
  `soaljawaban_position` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`soaljawaban_tessoal_id`,`soaljawaban_jawaban_id`),
  KEY `p_logansw_answer_id` (`soaljawaban_jawaban_id`),
  KEY `p_logansw_testlog_id` (`soaljawaban_tessoal_id`),
  CONSTRAINT `cbt_tes_soal_jawaban_ibfk_1` FOREIGN KEY (`soaljawaban_tessoal_id`) REFERENCES `cbt_tes_soal` (`tessoal_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `cbt_tes_soal_jawaban_ibfk_2` FOREIGN KEY (`soaljawaban_jawaban_id`) REFERENCES `cbt_jawaban` (`jawaban_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_tes_soal_jawaban`
--

LOCK TABLES `cbt_tes_soal_jawaban` WRITE;
/*!40000 ALTER TABLE `cbt_tes_soal_jawaban` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_tes_soal_jawaban` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_tes_token`
--

DROP TABLE IF EXISTS `cbt_tes_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_tes_token` (
  `token_id` int(11) NOT NULL AUTO_INCREMENT,
  `token_isi` varchar(20) NOT NULL,
  `token_user_id` int(11) NOT NULL,
  `token_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token_aktif` int(11) NOT NULL DEFAULT '1' COMMENT 'Umur Token dalam menit, 1 = 1 hari penuh',
  `token_tes_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`token_id`),
  KEY `token_user_id` (`token_user_id`),
  CONSTRAINT `cbt_tes_token_ibfk_1` FOREIGN KEY (`token_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_tes_token`
--

LOCK TABLES `cbt_tes_token` WRITE;
/*!40000 ALTER TABLE `cbt_tes_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_tes_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_tes_topik_set`
--

DROP TABLE IF EXISTS `cbt_tes_topik_set`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_tes_topik_set` (
  `tset_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tset_tes_id` bigint(20) unsigned NOT NULL,
  `tset_topik_id` bigint(20) unsigned NOT NULL,
  `tset_tipe` smallint(6) NOT NULL DEFAULT '1',
  `tset_difficulty` smallint(6) NOT NULL DEFAULT '1',
  `tset_jumlah` smallint(6) NOT NULL DEFAULT '1',
  `tset_jawaban` smallint(6) NOT NULL DEFAULT '0',
  `tset_acak_jawaban` int(11) NOT NULL DEFAULT '1',
  `tset_acak_soal` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tset_id`),
  KEY `p_tsubset_test_id` (`tset_tes_id`),
  KEY `tsubset_subject_id` (`tset_topik_id`),
  CONSTRAINT `cbt_tes_topik_set_ibfk_1` FOREIGN KEY (`tset_tes_id`) REFERENCES `cbt_tes` (`tes_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `cbt_tes_topik_set_ibfk_2` FOREIGN KEY (`tset_topik_id`) REFERENCES `cbt_topik` (`topik_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_tes_topik_set`
--

LOCK TABLES `cbt_tes_topik_set` WRITE;
/*!40000 ALTER TABLE `cbt_tes_topik_set` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_tes_topik_set` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_tes_user`
--

DROP TABLE IF EXISTS `cbt_tes_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_tes_user` (
  `tesuser_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tesuser_tes_id` bigint(20) unsigned NOT NULL,
  `tesuser_user_id` bigint(20) unsigned NOT NULL,
  `tesuser_status` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tesuser_creation_time` datetime NOT NULL,
  `tesuser_comment` text COLLATE utf8_unicode_ci,
  `tesuser_token` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tesuser_lock_time` datetime DEFAULT NULL,
  `tesuser_unlock_request` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`tesuser_id`),
  UNIQUE KEY `ak_testuser` (`tesuser_tes_id`,`tesuser_user_id`,`tesuser_status`),
  KEY `p_testuser_user_id` (`tesuser_user_id`),
  KEY `p_testuser_test_id` (`tesuser_tes_id`),
  CONSTRAINT `cbt_tes_user_ibfk_1` FOREIGN KEY (`tesuser_tes_id`) REFERENCES `cbt_tes` (`tes_id`) ON DELETE CASCADE,
  CONSTRAINT `cbt_tes_user_ibfk_2` FOREIGN KEY (`tesuser_user_id`) REFERENCES `cbt_user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_tes_user`
--

LOCK TABLES `cbt_tes_user` WRITE;
/*!40000 ALTER TABLE `cbt_tes_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_tes_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_tesgrup`
--

DROP TABLE IF EXISTS `cbt_tesgrup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_tesgrup` (
  `tstgrp_tes_id` bigint(20) unsigned NOT NULL,
  `tstgrp_grup_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`tstgrp_tes_id`,`tstgrp_grup_id`),
  KEY `p_tstgrp_test_id` (`tstgrp_tes_id`),
  KEY `p_tstgrp_group_id` (`tstgrp_grup_id`),
  CONSTRAINT `cbt_tesgrup_ibfk_1` FOREIGN KEY (`tstgrp_tes_id`) REFERENCES `cbt_tes` (`tes_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `cbt_tesgrup_ibfk_2` FOREIGN KEY (`tstgrp_grup_id`) REFERENCES `cbt_user_grup` (`grup_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_tesgrup`
--

LOCK TABLES `cbt_tesgrup` WRITE;
/*!40000 ALTER TABLE `cbt_tesgrup` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_tesgrup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_topik`
--

DROP TABLE IF EXISTS `cbt_topik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_topik` (
  `topik_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `topik_modul_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `topik_grup_id` bigint(20) unsigned DEFAULT '0',
  `topik_nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `topik_detail` text COLLATE utf8_unicode_ci,
  `topik_aktif` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topik_id`),
  UNIQUE KEY `ak_subject_name` (`topik_modul_id`,`topik_nama`),
  KEY `topik_grup_id` (`topik_grup_id`),
  CONSTRAINT `cbt_topik_ibfk_1` FOREIGN KEY (`topik_modul_id`) REFERENCES `cbt_modul` (`modul_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_topik`
--

LOCK TABLES `cbt_topik` WRITE;
/*!40000 ALTER TABLE `cbt_topik` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_topik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_user`
--

DROP TABLE IF EXISTS `cbt_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_user` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` int(11) NOT NULL DEFAULT '0' COMMENT '0=Tidak Login, 1=Login',
  `user_login_date` date DEFAULT NULL,
  `user_grup_id` bigint(20) unsigned NOT NULL,
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
  `user_level` smallint(3) unsigned NOT NULL DEFAULT '1',
  `user_detail` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_reset_request` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `ak_user_name` (`user_name`),
  KEY `user_groups_id` (`user_grup_id`),
  KEY `user_detail` (`user_detail`),
  CONSTRAINT `cbt_user_ibfk_1` FOREIGN KEY (`user_grup_id`) REFERENCES `cbt_user_grup` (`grup_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_user`
--

LOCK TABLES `cbt_user` WRITE;
/*!40000 ALTER TABLE `cbt_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cbt_user_grup`
--

DROP TABLE IF EXISTS `cbt_user_grup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cbt_user_grup` (
  `grup_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grup_nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`grup_id`),
  UNIQUE KEY `group_name` (`grup_nama`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cbt_user_grup`
--

LOCK TABLES `cbt_user_grup` WRITE;
/*!40000 ALTER TABLE `cbt_user_grup` DISABLE KEYS */;
/*!40000 ALTER TABLE `cbt_user_grup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `opsi1` varchar(75) NOT NULL,
  `opsi2` varchar(75) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `level` varchar(50) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `level` (`level`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`level`) REFERENCES `user_level` (`level`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','Administrator','','','','admin','2026-04-13 03:25:42');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_akses`
--

DROP TABLE IF EXISTS `user_akses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_akses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(75) NOT NULL,
  `kode_menu` varchar(50) NOT NULL,
  `add` int(2) NOT NULL DEFAULT '1' COMMENT '0=false, 1=true',
  `edit` int(2) NOT NULL DEFAULT '1' COMMENT '0=false, 1=true',
  PRIMARY KEY (`id`),
  KEY `akses_kode_menu` (`kode_menu`),
  KEY `akses_level` (`level`),
  CONSTRAINT `user_akses_ibfk_2` FOREIGN KEY (`kode_menu`) REFERENCES `user_menu` (`kode_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_akses_ibfk_3` FOREIGN KEY (`level`) REFERENCES `user_level` (`level`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=539 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_akses`
--

LOCK TABLES `user_akses` WRITE;
/*!40000 ALTER TABLE `user_akses` DISABLE KEYS */;
INSERT INTO `user_akses` VALUES (254,'operator-soal','modul-daftar',1,1),(258,'operator-soal','modul-topik',1,1),(259,'operator-tes','tes-hasil-operator',1,1),(260,'operator-tes','tes-token',1,1),(481,'admin','laporan-analisis-butir-soal',1,1),(482,'admin','peserta-kartu',1,1),(483,'admin','peserta-group',1,1),(484,'admin','peserta-daftar',1,1),(485,'admin','modul-daftar',1,1),(486,'admin','tes-daftar',1,1),(487,'admin','tool-backup',1,1),(488,'admin','tes-evaluasi',1,1),(489,'admin','tool-exportimport-soal',1,1),(491,'admin','tes-hasil',1,1),(492,'admin','peserta-import',1,1),(496,'admin','user_level',1,1),(497,'admin','user_menu',1,1),(498,'admin','user_atur',1,1),(499,'admin','user-zyacbt',1,1),(500,'admin','laporan-rekap',1,1),(502,'admin','tes-tambah',1,1),(503,'admin','tes-token',1,1),(504,'admin','modul-topik',1,1),(505,'admin','peserta-reset',1,1),(506,'admin','tes-pelanggaran',1,1),(507,'operator-tes','tes-pelanggaran',1,1),(530,'admin','modul-menjodohkan',1,1),(531,'operator-soal','modul-menjodohkan',1,1),(533,'admin','soal-pg',1,1),(534,'admin','soal-checklist',1,1),(535,'admin','soal-tf',1,1),(536,'admin','soal-essay',1,1),(537,'admin','soal-isiansingkat',1,1),(538,'admin','master-modul',1,1);
/*!40000 ALTER TABLE `user_akses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_level`
--

DROP TABLE IF EXISTS `user_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(50) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `level` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_level`
--

LOCK TABLES `user_level` WRITE;
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` VALUES (1,'admin','Administrator'),(7,'operator-soal','Operator Soal'),(8,'operator-tes','Operator Tes');
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_log`
--

DROP TABLE IF EXISTS `user_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `log` varchar(250) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_log`
--

LOCK TABLES `user_log` WRITE;
/*!40000 ALTER TABLE `user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_menu`
--

DROP TABLE IF EXISTS `user_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` int(11) NOT NULL DEFAULT '1' COMMENT '0=parent, 1=child',
  `parent` varchar(50) DEFAULT NULL,
  `kode_menu` varchar(50) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `url` varchar(150) NOT NULL DEFAULT '#',
  `icon` varchar(75) NOT NULL DEFAULT 'fa fa-circle-o',
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_menu` (`kode_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_menu`
--

LOCK TABLES `user_menu` WRITE;
/*!40000 ALTER TABLE `user_menu` DISABLE KEYS */;
INSERT INTO `user_menu` VALUES (1,0,'','user','Pengaturan','#','fa fa-sliders',20),(3,1,'user','user_atur','Pengaturan User','manager/useratur','fa fa-user',5),(4,1,'user','user_level','Pengaturan Level','manager/userlevel','fa fa-shield',6),(5,1,'user','user_menu','Pengaturan Menu','manager/usermenu','fa fa-th-list',7),(6,0,'','modul','Bank Soal','#','fa fa-bank',2),(7,1,'modul','modul-daftar','Daftar Soal','manager/modul_daftar','fa fa-file-text-o',1),(8,1,'datamaster','modul-topik','Mata Pelajaran','manager/modul_topik','fa fa-book',2),(10,0,'','peserta','Data Siswa','#','fa fa-graduation-cap',3),(11,1,'peserta','peserta-daftar','Daftar Siswa','manager/peserta_daftar','fa fa-user-plus',2),(12,1,'datamaster','peserta-group','Daftar Kelas','manager/peserta_group','fa fa-bank',3),(13,1,'peserta','peserta-import','Import Data Siswa','manager/peserta_import','fa fa-upload',3),(14,0,'','tes','Data Ujian','#','fa fa-pencil-square-o',4),(15,1,'tes','tes-tambah','Tambah Ujian','manager/tes_tambah','fa fa-plus-circle',1),(16,1,'tes','tes-daftar','Daftar Ujian','manager/tes_daftar','fa fa-calendar',2),(17,1,'tes','tes-hasil','Hasil Ujian','manager/tes_hasil','fa fa-file-text',6),(19,1,'tes','tes-token','Token','manager/tes_token','fa fa-ticket',8),(25,1,'tes','tes-evaluasi','Evaluasi Ujian','manager/tes_evaluasi','fa fa-edit',5),(28,1,'tes','tes-hasil-operator','Hasil Ujian Operator','manager/tes_hasil_operator','fa fa-user-secret',10),(30,0,'','tool','Tool','#','fa fa-wrench',6),(31,1,'tool','tool-backup','Database','manager/tool_backup','fa fa-hdd-o',1),(32,1,'tes-laporan','laporan-rekap','Rekap Hasil Ujian','manager/laporan_rekap_hasil','fa fa-clipboard',7),(33,1,'tool','tool-exportimport-soal','Export / Import Soal','manager/tool_exportimport_soal','fa fa-cloud-download',2),(34,1,'user','user-zyacbt','Pengaturan Aplikasi','manager/pengaturan_mhcbt','fa fa-cogs',1),(37,1,'peserta','peserta-kartu','Cetak Kartu Siswa','manager/peserta_kartu','fa fa-credit-card',5),(38,0,'','tes-laporan','Laporan','#','fa fa-bar-chart',5),(41,1,'tes-laporan','laporan-analisis-butir-soal','Analisis Butir Soal','manager/laporan_analisis_butir_soal','fa fa-pie-chart',1),(42,1,'tes-laporan','laporan-analisis-soal','Analisis Soal','manager/laporan_analisis_soal','fa fa-line-chart',2),(44,1,'tes','peserta-reset','Reset','manager/peserta_reset','fa fa-refresh',100),(45,1,'tes','tes-pelanggaran','Pelanggaran','manager/tes_pelanggaran','fa fa-warning',99),(62,1,'modul','modul-menjodohkan','Soal Menjodohkan','manager/modul_menjodohkan','fa fa-exchange',6),(63,0,'','datamaster','Data Master','#','fa fa-database',1),(64,1,'modul','soal-pg','Soal Pilihan Ganda','manager/modul_pilihanganda','fa fa-check-square-o',2),(65,1,'modul','soal-checklist','Soal Checklist','manager/modul_checklist','fa fa-list-ul',3),(66,1,'modul','soal-tf','Soal Benar / Salah','manager/modul_truefalse','fa fa-toggle-on',4),(67,1,'modul','soal-essay','Soal Essay','manager/modul_essay','fa fa-pencil-square-o',5),(68,1,'modul','soal-isiansingkat','Soal Isian Singkat','manager/modul_isiansingkat','fa fa-pencil-square',99),(71,1,'datamaster','master-modul','Modul','manager/modul_master','fa fa-folder-open',1);
/*!40000 ALTER TABLE `user_menu` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-13 10:30:35
