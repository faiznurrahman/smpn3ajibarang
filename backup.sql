-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: smp3_ajibarang
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1777605079),('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1777605079;',1777605079),('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6','i:1;',1777605054),('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer','i:1777605054;',1777605054);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_infos`
--

DROP TABLE IF EXISTS `contact_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `nomor_telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `embed_maps` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_infos`
--

LOCK TABLES `contact_infos` WRITE;
/*!40000 ALTER TABLE `contact_infos` DISABLE KEYS */;
INSERT INTO `contact_infos` VALUES (1,'ajsgdabsdabsd','098778900987','fajsha@gmail.com','https://gemini.google.com/?hl=id','<div class=\"embed-map-responsive\"><div class=\"embed-map-container\"><iframe class=\"embed-map-frame\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"https://maps.google.com/maps?width=600&height=400&hl=en&q=smp%20negeri%203%20ajibarang&t=&z=14&ie=UTF8&iwloc=B&output=embed\"></iframe><a href=\"https://sprunkiretake.net\" style=\"font-size:2px!important;color:gray!important;position:absolute;bottom:0;left:0;z-index:1;max-height:1px;overflow:hidden\">Sprunki</a></div><style>.embed-map-responsive{position:relative;text-align:right;width:100%;height:0;padding-bottom:66.66666666666666%;}.embed-map-container{overflow:hidden;background:none!important;width:100%;height:100%;position:absolute;top:0;left:0;}.embed-map-frame{width:100%!important;height:100%!important;position:absolute;top:0;left:0;}</style></div>','2026-04-26 21:43:19','2026-04-26 21:45:32');
/*!40000 ALTER TABLE `contact_infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extracurriculars`
--

DROP TABLE IF EXISTS `extracurriculars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extracurriculars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extracurriculars`
--

LOCK TABLES `extracurriculars` WRITE;
/*!40000 ALTER TABLE `extracurriculars` DISABLE KEYS */;
INSERT INTO `extracurriculars` VALUES (1,'Futsal','Ekstrakurikuler futsal hadir untuk menyalurkan bakat dan minat peserta didik di bidang olahraga. Latihan rutin dilaksanakan setiap Selasa sore di lapangan sekolah dengan didampingi pelatih berpengalaman. Tim futsal SMPN 3 Ajibarang telah meraih berbagai prestasi di tingkat kecamatan dan kabupaten.','extracurriculars/01KQ907DAW3ZK8X4CNSMVA9R5N.avif',1,0,'2026-04-26 22:13:51','2026-04-27 19:55:51'),(2,'Pramuka','Pramuka merupakan kegiatan ekstrakurikuler wajib di SMPN 3 Ajibarang yang bertujuan membentuk karakter peserta didik yang disiplin, mandiri, dan berjiwa kepemimpinan. Kegiatan ini dilaksanakan setiap hari Jumat dan mencakup berbagai aktivitas seperti baris-berbaris, tali-temali, peta kompas, dan kegiatan sosial kemasyarakatan.','extracurriculars/01KQ90592M2GHVWTVDQHNH99QQ.jpeg',1,0,'2026-04-27 19:54:41','2026-04-27 19:54:41'),(3,'Palang Merah Remaja (PMR)','PMR merupakan wadah bagi peserta didik untuk belajar tentang kepalangmerahan, pertolongan pertama, dan kepedulian sosial. Anggota PMR SMPN 3 Ajibarang aktif dalam kegiatan donor darah, bakti sosial, dan pelatihan kesehatan di lingkungan sekolah maupun masyarakat sekitar.','extracurriculars/01KQ90JWXEK3QKYM00N5VTKKXN.jpg',1,0,'2026-04-27 20:02:08','2026-04-27 20:02:08'),(4,' Bola Voli','Ekstrakurikuler bola voli menjadi salah satu kegiatan olahraga favorit di SMPN 3 Ajibarang. Latihan dilaksanakan setiap Senin dan Kamis sore di lapangan sekolah. Tim bola voli putra dan putri sekolah ini secara rutin mengikuti kompetisi antar sekolah di tingkat kecamatan dan kabupaten Banyumas.','extracurriculars/01KQ90MRW8ZC5ATZXCQ1GDYPM0.webp',1,0,'2026-04-27 20:03:09','2026-04-27 20:03:09');
/*!40000 ALTER TABLE `extracurriculars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,'Kegiatan Sekolah','Dokumentasi berbagai kegiatan sekolah SMPN 3 Ajibarang',1,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(2,'Ekstrakurikuler','Dokumentasi kegiatan ekstrakurikuler siswa',2,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(3,'Prestasi & Penghargaan','Dokumentasi prestasi dan penghargaan siswa SMPN 3 Ajibarang',3,'2026-04-30 19:56:53','2026-04-30 19:56:53');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_images`
--

DROP TABLE IF EXISTS `gallery_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gallery_id` bigint unsigned NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_images_gallery_id_foreign` (`gallery_id`),
  CONSTRAINT `gallery_images_gallery_id_foreign` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_images`
--

LOCK TABLES `gallery_images` WRITE;
/*!40000 ALTER TABLE `gallery_images` DISABLE KEYS */;
INSERT INTO `gallery_images` VALUES (1,1,'galleries/foto-01.jpg','Kegiatan upacara bendera','Kegiatan upacara bendera',1,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(2,1,'galleries/foto-02.jpg','Kegiatan pembelajaran di kelas','Kegiatan pembelajaran di kelas',2,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(3,1,'galleries/foto-03.jpg','Diskusi kelompok siswa','Diskusi kelompok siswa',3,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(4,1,'galleries/foto-04.jpg','Kegiatan praktikum IPA','Kegiatan praktikum IPA',4,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(5,1,'galleries/foto-05.jpg','Kunjungan edukatif siswa','Kunjungan edukatif siswa',5,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(6,1,'galleries/foto-06.jpg','Kegiatan olahraga bersama','Kegiatan olahraga bersama',6,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(7,1,'galleries/foto-07.jpg','Pembinaan siswa berprestasi','Pembinaan siswa berprestasi',7,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(8,1,'galleries/foto-08.jpg','Workshop kurikulum merdeka','Workshop kurikulum merdeka',8,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(9,1,'galleries/foto-09.jpg','Rapat orang tua dan guru','Rapat orang tua dan guru',9,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(10,1,'galleries/foto-10.jpg','Kegiatan literasi pagi','Kegiatan literasi pagi',10,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(11,2,'galleries/foto-11.jpg','Latihan pramuka','Latihan pramuka',1,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(12,2,'galleries/foto-12.jpg','Kegiatan futsal siswa','Kegiatan futsal siswa',2,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(13,2,'galleries/foto-13.jpg','Latihan tari kreasi','Latihan tari kreasi',3,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(14,2,'galleries/foto-14.jpg','Kegiatan PMR','Kegiatan PMR',4,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(15,2,'galleries/foto-15.jpg','Latihan paduan suara','Latihan paduan suara',5,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(16,2,'galleries/foto-16.jpg','Kegiatan pencak silat','Kegiatan pencak silat',6,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(17,2,'galleries/foto-17.jpg','Latihan basket','Latihan basket',7,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(18,2,'galleries/foto-18.jpg','Kegiatan karawitan','Kegiatan karawitan',8,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(19,3,'galleries/foto-19.jpg','Penerimaan piala lomba futsal','Penerimaan piala lomba futsal',1,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(20,3,'galleries/foto-20.jpg','Juara olimpiade IPA kabupaten','Juara olimpiade IPA kabupaten',2,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(21,3,'galleries/foto-21.jpg','Penghargaan sekolah adiwiyata','Penghargaan sekolah adiwiyata',3,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(22,3,'galleries/foto-22.jpg','Lomba baca puisi tingkat provinsi','Lomba baca puisi tingkat provinsi',4,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(23,3,'galleries/foto-23.jpg','Kejuaraan tari kreasi daerah','Kejuaraan tari kreasi daerah',5,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(24,3,'galleries/foto-24.jpg','Penghargaan kebersihan lingkungan','Penghargaan kebersihan lingkungan',6,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(25,3,'galleries/foto-25.jpg','Lomba FL2SN tingkat kabupaten','Lomba FL2SN tingkat kabupaten',7,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(26,3,'galleries/foto-26.jpg','Penerimaan sertifikat adiwiyata mandiri','Penerimaan sertifikat adiwiyata mandiri',8,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(27,3,'galleries/foto-27.jpg','Lomba cerdas cermat antar sekolah','Lomba cerdas cermat antar sekolah',9,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(28,3,'galleries/foto-28.jpg','Wisuda dan pelepasan siswa kelas 9','Wisuda dan pelepasan siswa kelas 9',10,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(29,1,'galleries/01KQCMD2JK6GMFKT84X78TGZW3.avif','Dokumentasi kegiatan sekolah','Dokumentasi kegiatan sekolah',11,'2026-04-30 19:56:53','2026-04-30 19:56:53'),(30,1,'galleries/01KQCMEC771KP4DCBHT7N1VVZF.jpeg','Dokumentasi kegiatan sekolah','Dokumentasi kegiatan sekolah',12,'2026-04-30 19:56:53','2026-04-30 19:56:53');
/*!40000 ALTER TABLE `gallery_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subjek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi_pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'Budi Santoso','08123456789','budi@gmail.com','Informasi Sekolah','Selamat siang, saya ingin menanyakan informasi mengenai kegiatan ekstrakurikuler yang tersedia di sekolah ini. Terima kasih.',1,'2026-04-26 22:41:34','2026-04-26 22:40:50','2026-04-26 22:41:34'),(2,'Siti Rahayu','08234567890','siti@gmail.com','Prestasi Siswa','Halo, saya orang tua siswa kelas 8. Ingin menanyakan jadwal penerimaan rapor semester ini. Mohon informasinya.',1,'2026-04-26 22:41:28','2026-04-26 22:40:50','2026-04-26 22:41:28'),(3,'Ahmad Fauzi','08345678901','ahmad@gmail.com','Kerjasama','Selamat pagi, kami dari lembaga bimbingan belajar ingin menjalin kerjasama dengan pihak sekolah. Boleh kami hubungi siapa?',1,'2026-04-26 22:40:50','2026-04-26 22:40:50','2026-04-26 22:40:50'),(4,'Hello','923423842323','faiznurrahman842@gmail.com','Informasi Sekolah','hjabsdhabsd',1,'2026-04-27 19:14:08','2026-04-27 02:38:25','2026-04-27 19:14:08');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_04_26_122207_create_settings_table',1),(5,'2026_04_26_161852_create_principal_greetings_table',1),(6,'2026_04_26_163657_add_hero_fields_to_settings_table',1),(7,'2026_04_26_163859_add_hero_fields_to_settings_table',1),(8,'2026_04_26_165309_create_profiles_table',2),(9,'2026_04_27_021610_create_teachers_table',3),(10,'2026_04_27_024055_add_is_active_to_teachers_table',4),(11,'2026_04_27_024959_create_posts_table',5),(12,'2026_04_27_030835_add_columns_to_posts_table',6),(13,'2026_04_27_043157_create_contact_infos_table',7),(14,'2026_04_27_044725_create_social_media_table',8),(15,'2026_04_27_050640_create_video_profiles_table',9),(16,'2026_04_27_051050_create_extracurriculars_table',10),(17,'2026_04_27_051849_create_organizational_structures_table',11),(18,'2026_04_27_052329_create_galleries_table',12),(19,'2026_04_27_052339_create_gallery_images_table',12),(20,'2026_04_27_053423_create_messages_table',13),(21,'2026_04_27_060955_add_order_to_teachers_table',14);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizational_structures`
--

DROP TABLE IF EXISTS `organizational_structures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizational_structures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizational_structures`
--

LOCK TABLES `organizational_structures` WRITE;
/*!40000 ALTER TABLE `organizational_structures` DISABLE KEYS */;
INSERT INTO `organizational_structures` VALUES (1,'Struktur Organisasi 2024/2025','organizational-structures/01KQ900VKVZBDH1GDSDWDEZGK7.jpg',1,'2026-04-26 22:22:30','2026-04-27 19:52:16');
/*!40000 ALTER TABLE `organizational_structures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_konten` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('berita','pengumuman','prestasi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `tanggal_publish` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_pinned` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_user_id_foreign` (`user_id`),
  KEY `posts_updated_by_foreign` (`updated_by`),
  CONSTRAINT `posts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,'SMPN 3 Ajibarang Raih Penghargaan Sekolah Adiwiyata Mandiri','smpn-3-ajibarang-raih-penghargaan-sekolah-adiwiyata-mandiri','<p>SMPN 3 Ajibarang kembali menorehkan prestasi membanggakan dengan berhasil meraih penghargaan Sekolah Adiwiyata Mandiri dari Kementerian Lingkungan Hidup dan Kehutanan. Penghargaan ini merupakan bukti nyata komitmen seluruh warga sekolah dalam menjaga kelestarian lingkungan.</p><p>Kepala sekolah menyampaikan rasa syukur dan terima kasih kepada seluruh siswa, guru, dan orang tua yang telah bersama-sama mewujudkan sekolah berwawasan lingkungan.</p>','posts/post-01.jpg','berita','published','2026-04-01',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(2,1,'Workshop Kurikulum Merdeka Bersama Seluruh Guru dan Tendik','workshop-kurikulum-merdeka-bersama-seluruh-guru-dan-tendik','<p>Dalam rangka peningkatan kualitas pembelajaran, SMPN 3 Ajibarang mengadakan workshop Kurikulum Merdeka yang diikuti oleh seluruh guru dan tenaga kependidikan. Kegiatan ini bertujuan untuk memperdalam pemahaman tentang implementasi Kurikulum Merdeka di kelas.</p><p>Narasumber dari Dinas Pendidikan Kabupaten Banyumas hadir langsung memberikan materi dan pendampingan kepada para peserta.</p>','posts/post-02.jpg','berita','published','2026-03-25',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(3,1,'Kegiatan P5 Bertema Kearifan Lokal Sukses Digelar','kegiatan-p5-bertema-kearifan-lokal-sukses-digelar','<p>Proyek Penguatan Profil Pelajar Pancasila (P5) dengan tema Kearifan Lokal sukses digelar oleh seluruh siswa kelas 7 dan 8 SMPN 3 Ajibarang. Berbagai karya autentik ditampilkan mulai dari kerajinan batik, kuliner tradisional, hingga pertunjukan seni budaya lokal.</p>','posts/post-03.jpg','berita','published','2026-03-15',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(4,1,'SMPN 3 Ajibarang Gelar Upacara Peringatan Hari Pendidikan Nasional','smpn-3-ajibarang-gelar-upacara-peringatan-hari-pendidikan-nasional','<p>Seluruh warga SMPN 3 Ajibarang mengikuti upacara bendera dalam rangka memperingati Hari Pendidikan Nasional. Upacara berlangsung khidmat dengan pembacaan pidato dan penyerahan penghargaan kepada siswa berprestasi.</p>','posts/post-04.jpg','berita','published','2026-03-10',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(5,1,'Kunjungan Edukatif Siswa Kelas 8 ke Museum Wayang Banyumas','kunjungan-edukatif-siswa-kelas-8-ke-museum-wayang-banyumas','<p>Sebanyak 120 siswa kelas 8 SMPN 3 Ajibarang melakukan kunjungan edukatif ke Museum Wayang Banyumas. Kegiatan ini merupakan bagian dari pembelajaran luar kelas untuk mengenal lebih dekat budaya dan seni tradisional Banyumas.</p>','posts/post-05.jpg','berita','published','2026-03-05',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(6,1,'Pelatihan Literasi Digital untuk Siswa Kelas 9','pelatihan-literasi-digital-untuk-siswa-kelas-9','<p>SMPN 3 Ajibarang bekerja sama dengan Kominfo Kabupaten Banyumas mengadakan pelatihan literasi digital bagi siswa kelas 9. Pelatihan mencakup materi keamanan berinternet, bijak bermedia sosial, dan pengenalan dasar coding.</p>','posts/post-06.jpg','berita','published','2026-02-20',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(7,1,'Lomba Futsal Antar Kelas SMP N 3 Ajibarang Berlangsung Meriah','lomba-futsal-antar-kelas-smp-n-3-ajibarang-berlangsung-meriah','<p>Lomba futsal antar kelas yang diselenggarakan dalam rangka memperingati HUT sekolah berlangsung sangat meriah. Seluruh kelas dari kelas 7 hingga 9 turut berpartisipasi dengan penuh semangat dan sportivitas tinggi.</p>','posts/post-07.jpg','berita','published','2026-02-15',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(8,1,'Pelantikan Pengurus OSIS Periode 2026/2027','pelantikan-pengurus-osis-periode-20262027','<p>Pengurus OSIS SMPN 3 Ajibarang periode 2026/2027 resmi dilantik oleh Kepala Sekolah dalam upacara pelantikan yang berlangsung khidmat. Sebanyak 20 siswa terpilih siap menjalankan program kerja yang telah disusun.</p>','posts/post-08.jpg','berita','published','2026-02-10',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(9,1,'Pentas Seni Akhir Tahun SMPN 3 Ajibarang 2026','pentas-seni-akhir-tahun-smpn-3-ajibarang-2026','<p>Pentas seni akhir tahun SMPN 3 Ajibarang berlangsung spektakuler dengan menampilkan berbagai pertunjukan seni dari seluruh kelas. Mulai dari tari tradisional, band musik, drama, hingga fashion show busana daerah.</p>','posts/post-09.jpg','berita','published','2026-01-28',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(10,1,'Kegiatan Bakti Sosial di Desa Sekitar Ajibarang','kegiatan-bakti-sosial-di-desa-sekitar-ajibarang','<p>Siswa-siswi SMPN 3 Ajibarang bersama guru dan staf mengadakan kegiatan bakti sosial di desa sekitar. Kegiatan meliputi pembersihan lingkungan, pembagian sembako kepada warga kurang mampu, dan penanaman pohon.</p>','posts/post-10.jpg','berita','published','2026-01-20',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(11,1,'Penerimaan Kunjungan Studi Banding dari SMPN 1 Cilacap','penerimaan-kunjungan-studi-banding-dari-smpn-1-cilacap','<p>SMPN 3 Ajibarang menerima kunjungan studi banding dari SMPN 1 Cilacap. Kunjungan ini difokuskan pada program Adiwiyata dan pengelolaan lingkungan sekolah yang telah berhasil diterapkan di SMPN 3 Ajibarang.</p>','posts/post-11.jpg','berita','published','2026-01-15',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(12,1,'Senam Pagi Bersama dalam Rangka Hari Kesehatan Nasional','senam-pagi-bersama-dalam-rangka-hari-kesehatan-nasional','<p>Dalam rangka memperingati Hari Kesehatan Nasional, SMPN 3 Ajibarang mengadakan senam pagi bersama yang diikuti oleh seluruh warga sekolah. Kegiatan ini juga disertai dengan pemeriksaan kesehatan gratis dari Puskesmas Ajibarang.</p>','posts/post-12.jpg','berita','published','2026-01-10',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(13,1,'Libur Akhir Semester Genap Tahun Ajaran 2025/2026','libur-akhir-semester-genap-tahun-ajaran-20252026','<p>Diberitahukan kepada seluruh siswa, orang tua/wali murid bahwa libur akhir semester genap Tahun Ajaran 2025/2026 akan dilaksanakan mulai tanggal 20 Juni s.d. 13 Juli 2026. Siswa masuk kembali pada tanggal 14 Juli 2026.</p>',NULL,'pengumuman','published','2026-05-01','2026-05-01','2026-06-20',1,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(14,1,'Jadwal Penilaian Akhir Tahun (PAT) 2025/2026','jadwal-penilaian-akhir-tahun-pat-20252026','<p>Penilaian Akhir Tahun (PAT) Semester Genap Tahun Ajaran 2025/2026 akan dilaksanakan mulai tanggal 2 s.d. 10 Juni 2026. Siswa diwajibkan hadir tepat waktu dan membawa perlengkapan ujian yang telah ditentukan.</p>',NULL,'pengumuman','published','2026-04-15','2026-04-15','2026-06-10',1,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(15,1,'Pengumuman Pendaftaran Peserta Didik Baru (PPDB) 2026/2027','pengumuman-pendaftaran-peserta-didik-baru-ppdb-20262027','<p>SMPN 3 Ajibarang membuka pendaftaran Peserta Didik Baru (PPDB) Tahun Ajaran 2026/2027. Pendaftaran dilakukan secara online melalui website resmi Dinas Pendidikan Kabupaten Banyumas. Kuota yang tersedia sebanyak 8 rombongan belajar.</p>',NULL,'pengumuman','published','2026-04-01','2026-04-01','2026-06-30',0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(16,1,'Imunisasi Siswa Kelas 7 oleh Puskesmas Ajibarang','imunisasi-siswa-kelas-7-oleh-puskesmas-ajibarang','<p>Diberitahukan kepada orang tua/wali murid kelas 7 bahwa akan dilaksanakan kegiatan imunisasi dari Puskesmas Ajibarang pada hari Rabu, 20 Mei 2026. Siswa diwajibkan hadir dan membawa surat izin orang tua.</p>',NULL,'pengumuman','published','2026-03-20','2026-03-20','2026-05-20',0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(17,1,'Rapat Orang Tua Siswa Kelas 9 Persiapan Kelulusan','rapat-orang-tua-siswa-kelas-9-persiapan-kelulusan','<p>Diundang kepada seluruh orang tua/wali murid kelas 9 untuk hadir dalam rapat persiapan kelulusan yang akan dilaksanakan pada Sabtu, 10 Mei 2026 pukul 08.00 WIB di Aula SMPN 3 Ajibarang.</p>',NULL,'pengumuman','published','2026-03-01','2026-03-01','2026-05-10',0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(18,1,'Perubahan Jadwal Kegiatan Ekstrakurikuler Semester Genap','perubahan-jadwal-kegiatan-ekstrakurikuler-semester-genap','<p>Diberitahukan bahwa jadwal kegiatan ekstrakurikuler semester genap mengalami perubahan. Jadwal baru dapat dilihat di papan pengumuman sekolah atau menghubungi wali kelas masing-masing.</p>',NULL,'pengumuman','published','2026-02-15','2026-02-15','2026-06-30',0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(19,1,'Pengumuman Hasil Seleksi Paskibra Sekolah 2026','pengumuman-hasil-seleksi-paskibra-sekolah-2026','<p>Hasil seleksi Paskibra SMPN 3 Ajibarang tahun 2026 telah ditetapkan. Siswa yang lolos seleksi dimohon untuk hadir pada pertemuan perdana pada hari Senin, 1 Maret 2026 pukul 14.00 WIB di lapangan sekolah.</p>',NULL,'pengumuman','published','2026-02-10','2026-02-10','2026-03-01',0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(20,1,'Jadwal Ujian Praktik Kelas 9 Semester Genap 2026','jadwal-ujian-praktik-kelas-9-semester-genap-2026','<p>Jadwal ujian praktik untuk siswa kelas 9 semester genap tahun ajaran 2025/2026 telah ditetapkan. Ujian praktik akan berlangsung mulai tanggal 10 s.d. 20 Mei 2026 sesuai mata pelajaran masing-masing.</p>',NULL,'pengumuman','published','2026-01-25','2026-01-25','2026-05-20',0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(21,1,'Juara 1 Lomba Futsal Tingkat Kabupaten Banyumas 2026','juara-1-lomba-futsal-tingkat-kabupaten-banyumas-2026','<p>Tim futsal SMPN 3 Ajibarang berhasil meraih Juara 1 dalam Lomba Futsal Antar SMP Tingkat Kabupaten Banyumas 2026. Tim berhasil mengalahkan 16 sekolah peserta dengan skor akhir 3-1 di babak final.</p>','posts/post-13.jpg','prestasi','published','2026-04-10',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(22,1,'Juara 2 Olimpiade IPA Tingkat Kabupaten 2026','juara-2-olimpiade-ipa-tingkat-kabupaten-2026','<p>Siswa SMPN 3 Ajibarang berhasil meraih Juara 2 dalam Olimpiade IPA Tingkat Kabupaten Banyumas 2026. Prestasi ini merupakan hasil kerja keras siswa dan bimbingan intensif dari guru pembina selama tiga bulan terakhir.</p>','posts/post-14.jpg','prestasi','published','2026-03-28',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(23,1,'Juara 1 Lomba Baca Puisi Tingkat Provinsi Jawa Tengah','juara-1-lomba-baca-puisi-tingkat-provinsi-jawa-tengah','<p>Kebanggaan kembali diraih oleh SMPN 3 Ajibarang melalui prestasi siswa di bidang seni sastra. Salah satu siswa kelas 8 berhasil meraih Juara 1 Lomba Baca Puisi Tingkat Provinsi Jawa Tengah yang diselenggarakan di Semarang.</p>','posts/post-15.jpg','prestasi','published','2026-03-15',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(24,1,'Juara 3 Lomba Tari Kreasi Tingkat Kabupaten 2026','juara-3-lomba-tari-kreasi-tingkat-kabupaten-2026','<p>Kelompok tari SMPN 3 Ajibarang berhasil meraih Juara 3 dalam Lomba Tari Kreasi Tingkat Kabupaten Banyumas 2026. Penampilan yang memukau dengan koreografi yang memadukan unsur budaya lokal Banyumas mendapat pujian dari dewan juri.</p>','posts/post-16.jpg','prestasi','published','2026-02-25',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(25,1,'Siswa SMPN 3 Ajibarang Lolos Seleksi OSN Tingkat Provinsi','siswa-smpn-3-ajibarang-lolos-seleksi-osn-tingkat-provinsi','<p>Dua siswa SMPN 3 Ajibarang berhasil lolos seleksi Olimpiade Sains Nasional (OSN) Tingkat Provinsi Jawa Tengah bidang Matematika dan IPA. Keduanya akan mewakili Kabupaten Banyumas dalam ajang bergengsi tersebut.</p>','posts/post-17.jpg','prestasi','published','2026-02-10',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(26,1,'Juara 1 Lomba Debat Bahasa Indonesia Tingkat Kabupaten','juara-1-lomba-debat-bahasa-indonesia-tingkat-kabupaten','<p>Tim debat SMPN 3 Ajibarang berhasil meraih Juara 1 dalam Lomba Debat Bahasa Indonesia Tingkat Kabupaten Banyumas 2026. Tim yang terdiri dari 3 siswa kelas 9 ini tampil percaya diri dan memenangkan semua babak perdebatan.</p>','posts/post-18.jpg','prestasi','published','2026-01-30',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(27,1,'Medali Perak Karate Tingkat Provinsi Jawa Tengah 2026','medali-perak-karate-tingkat-provinsi-jawa-tengah-2026','<p>Atlet karate SMPN 3 Ajibarang berhasil meraih medali perak dalam Kejuaraan Karate Tingkat Provinsi Jawa Tengah 2026 kategori kumite kelas 45 kg putra. Prestasi ini semakin mengharumkan nama sekolah di tingkat provinsi.</p>','posts/post-19.jpg','prestasi','published','2026-01-20',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL),(28,1,'Juara Harapan 1 FLS2N Bidang Seni Lukis Tingkat Kabupaten','juara-harapan-1-fls2n-bidang-seni-lukis-tingkat-kabupaten','<p>Siswa SMPN 3 Ajibarang berhasil meraih Juara Harapan 1 dalam Festival dan Lomba Seni Siswa Nasional (FLS2N) bidang Seni Lukis Tingkat Kabupaten Banyumas 2026. Karya yang ditampilkan menggambarkan keindahan alam dan budaya Banyumas.</p>','posts/post-20.jpg','prestasi','published','2026-01-10',NULL,NULL,0,'2026-04-30 20:16:03','2026-04-30 20:16:03',NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `principal_greetings`
--

DROP TABLE IF EXISTS `principal_greetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `principal_greetings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kepala_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `principal_greetings`
--

LOCK TABLES `principal_greetings` WRITE;
/*!40000 ALTER TABLE `principal_greetings` DISABLE KEYS */;
INSERT INTO `principal_greetings` VALUES (1,'Drs. Budi Santoso, M.Pd sda','principal/01KQ7063HAVEPHWQN11BMT9SCF.jpg','<p>Selamat datang di website resmi SMPN 3 Ajibarang. Kami berkomitmen untuk terus meningkatkan kualitas pendidikan yang berlandaskan nilai-nilai karakter, keunggulan akademik, dan kepedulian terhadap lingkungan.</p>','2026-04-26 09:46:40','2026-04-27 01:33:08');
/*!40000 ALTER TABLE `principal_greetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sejarah` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `visi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `misi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'<p><img src=\"http://127.0.0.1:8000/storage/sejarah/qAxvnG5iaLVjQMGxZR9UxR2aE7SsGVe6Sk6dQsBZ.jpg\" alt=\"foto lama\" data-id=\"sejarah/qAxvnG5iaLVjQMGxZR9UxR2aE7SsGVe6Sk6dQsBZ.jpg\"></p><p></p><p>SMPN 3 Ajibarang berdiri pada tahun 1984 berdasarkan Surat Keputusan Menteri Pendidikan dan Kebudayaan Republik Indonesia. Sekolah ini didirikan untuk memenuhi kebutuhan pendidikan masyarakat di wilayah Ajibarang dan sekitarnya yang terus berkembang pesat.</p><p>Sejak awal berdirinya, SMPN 3 Ajibarang berkomitmen untuk memberikan layanan pendidikan yang berkualitas bagi generasi muda. Dari tahun ke tahun, sekolah ini terus berkembang baik dari segi sarana prasarana maupun kualitas sumber daya manusianya.</p><p>Pada tahun 2010, SMPN 3 Ajibarang mendapatkan penghargaan sebagai Sekolah Adiwiyata tingkat Kabupaten Banyumas, dan terus mempertahankan predikat tersebut hingga meraih Adiwiyata Nasional. Penghargaan ini mencerminkan komitmen sekolah dalam mengintegrasikan nilai-nilai peduli lingkungan ke dalam budaya sekolah.</p><p>Hingga saat ini, SMPN 3 Ajibarang telah meluluskan ribuan alumni yang tersebar di berbagai bidang profesi dan berkontribusi bagi masyarakat, bangsa, dan negara.</p>','<p>Terwujudnya peserta didik yang beriman, berakhlak mulia, berprestasi, berbudaya, dan peduli terhadap lingkungan hidup.</p>','<ol start=\"1\"><li><p>Menumbuhkan penghayatan dan pengamalan ajaran agama serta nilai-nilai luhur budaya bangsa sebagai sumber kearifan dalam bertindak.</p></li><li><p>Melaksanakan pembelajaran yang aktif, kreatif, efektif, dan menyenangkan sehingga setiap peserta didik dapat berkembang secara optimal.</p></li><li><p>Meningkatkan prestasi akademik dan non-akademik melalui pembinaan yang berkelanjutan dan kompetitif.</p></li><li><p>Mengembangkan budaya disiplin, jujur, dan bertanggung jawab dalam kehidupan sehari-hari.</p></li><li><p> Menumbuhkan sikap peduli dan cinta lingkungan hidup sebagai bagian dari karakter peserta didik.</p></li><li><p>Meningkatkan kompetensi pendidik dan tenaga kependidikan secara profesional dan berkesinambungan.</p></li><li><p>Menjalin kerjasama yang harmonis antara sekolah, orang tua, dan masyarakat dalam mendukung terwujudnya tujuan pendidikan.</p></li></ol>','2026-04-27 19:23:48','2026-04-27 19:46:13');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('HhNLE6zBwwVE2h3jLXkD6XQz4OcWe1aGkkZ0UZlV',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJVYzh4Uk5mbHVBRHhvbk9LQjFnMFhyYzhCb2Y4TGpscVNKa3RaSzdnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwidXJsIjpbXSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiNzMzNDZlNjNmOGVjOWZiYWI2NzM4NzkzMmJhY2ViMTMzMzQzZTc0ZmNmNDVkYTc2NzBkNzBlMGYwNGZlOTk5OSIsInRhYmxlcyI6eyJlMjhhNjAyNjRhMjhhMGZjNTljN2RjODZiZmZkODI0OF9jb2x1bW5zIjpbXSwiYTYwN2NkYTczY2JkZTQ0NmY4YmI2NGNjZDc1NjA2ZWVfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ0aHVtYm5haWwiLCJsYWJlbCI6IlRodW1ibmFpbCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJqdWR1bCIsImxhYmVsIjoiSnVkdWwiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidHlwZSIsImxhYmVsIjoiVGlwZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzdGF0dXMiLCJsYWJlbCI6IlN0YXR1cyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpc19waW5uZWQiLCJsYWJlbCI6IlBpbiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ1c2VyLm5hbWEiLCJsYWJlbCI6IkRpYnVhdCBPbGVoIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRhbmdnYWxfcHVibGlzaCIsImxhYmVsIjoiVGFuZ2dhbCBQdWJsaXNoIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dfSwiZmlsYW1lbnQiOltdfQ==',1777613935),('svItLzo4qAPT1G8WBvlbsz3U3mpGuem42t0z9azc',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJ1SGs2c1Z0bERHd2w2bFkzWDFac1FQdzRaVkEwZGtuNjlPcFZXdDUxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1777635238);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_hero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_hero` text COLLATE utf8mb4_unicode_ci,
  `background_hero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_siswa` int DEFAULT NULL,
  `jumlah_guru_karyawan` int DEFAULT NULL,
  `jumlah_prestasi` int DEFAULT NULL,
  `tahun_berdiri` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'SMPN 3 Ajibarang','Sekolah Adiwiyata','settings/01KQ6XJ0TKH6HS8PHKAJ17QZVS.png','SMPN 3 Ajibarang','Berkomitmen mencetak generasi yang berkarakter, berprestasi, dan peduli lingkungan.','settings/01KQ6XTKP3N6SJQRBV2WVKSQ9C.jpg',802,503,1205,1800,'2026-04-26 09:46:31','2026-04-27 03:36:27');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_media`
--

DROP TABLE IF EXISTS `social_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `social_media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_media`
--

LOCK TABLES `social_media` WRITE;
/*!40000 ALTER TABLE `social_media` DISABLE KEYS */;
INSERT INTO `social_media` VALUES (1,'Facebook','https://fontawesome.com/icons/facebook?f=brands&s=solid','facebook',1,2,'2026-04-26 22:01:32','2026-04-26 23:20:39'),(2,'Instagram','https://fontawesome.com/icons/facebook?f=brands&s=solid','instagram',1,1,'2026-04-26 23:19:52','2026-04-26 23:20:28');
/*!40000 ALTER TABLE `social_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teachers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` enum('guru','staff') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'guru',
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mata_pelajaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (2,'Drs. Ahmad Fauzi, M.Pd.',NULL,'guru','Guru Senior','Matematika','2026-04-27 02:00:35','2026-04-27 02:00:35',1,1),(3,'Siti Nurhaliza, S.Pd.',NULL,'guru','Wali Kelas 7A','Bahasa Indonesia','2026-04-27 02:00:35','2026-04-27 02:00:35',1,2),(4,'Budi Santoso, S.Pd.',NULL,'guru','Wali Kelas 7B','IPA','2026-04-27 02:00:35','2026-04-27 02:00:35',1,3),(5,'Dewi Rahayu, S.Pd.',NULL,'guru','Wali Kelas 8A','IPS','2026-04-27 02:00:35','2026-04-27 02:00:35',1,4),(6,'Hendra Wijaya, S.Pd.',NULL,'guru','Wali Kelas 8B','Bahasa Inggris','2026-04-27 02:00:35','2026-04-27 02:00:35',1,5),(7,'Rini Kusumawati, S.Pd.',NULL,'guru','Wali Kelas 9A','PKn','2026-04-27 02:00:35','2026-04-27 02:00:35',1,6),(8,'Agus Priyanto, S.Pd.',NULL,'guru','Wali Kelas 9B','Pendidikan Agama','2026-04-27 02:00:35','2026-04-27 02:00:35',1,7),(9,'Lia Ambarwati, S.Pd.',NULL,'guru','Guru Mapel','Seni Budaya','2026-04-27 02:00:35','2026-04-27 02:00:35',1,8),(10,'Teguh Prasetyo, S.Pd.',NULL,'guru','Guru Mapel','PJOK','2026-04-27 02:00:35','2026-04-27 02:00:35',1,9),(11,'Nurul Hidayah, S.Kom.',NULL,'guru','Guru Mapel','Informatika','2026-04-27 02:00:35','2026-04-27 02:00:35',1,10),(12,'Wahyu Setiawan, S.Pd.',NULL,'guru','Guru Mapel','Prakarya','2026-04-27 02:00:35','2026-04-27 02:00:35',1,11),(13,'Suparman',NULL,'staff','Kepala Tata Usaha',NULL,'2026-04-27 02:00:35','2026-04-27 02:00:35',1,12),(14,'Endang Sulistyowati',NULL,'staff','Staff TU',NULL,'2026-04-27 02:00:35','2026-04-27 02:00:35',1,13),(15,'Bambang Riyanto',NULL,'staff','Operator Sekolah',NULL,'2026-04-27 02:00:35','2026-04-27 02:00:35',1,14),(16,'Sri Wahyuni',NULL,'staff','Pustakawan',NULL,'2026-04-27 02:00:35','2026-04-27 02:00:35',1,15);
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@sch.id',NULL,'$2y$12$JeUsf4tV8G02YHAubTQ3POoyon96HBEVM9VBtTXuXrOBlrr1nQogS',NULL,'2026-04-26 09:44:44','2026-04-26 09:44:44');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_profiles`
--

DROP TABLE IF EXISTS `video_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `video_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_profiles`
--

LOCK TABLES `video_profiles` WRITE;
/*!40000 ALTER TABLE `video_profiles` DISABLE KEYS */;
INSERT INTO `video_profiles` VALUES (1,'Video Profil SMP Negeri 3 Ajibarang','https://youtu.be/yHO6y0Xps1Y?si=69iSZCfOVA4notOd','SMP Negeri 3 Ajibarang merupakan sekolah yang berkomitmen dalam mencetak generasi yang unggul, berprestasi, dan berkarakter. Melalui berbagai program pendidikan dan kegiatan, sekolah ini terus berupaya memberikan pengalaman belajar yang berkualitas bagi seluruh siswa.',1,0,'2026-04-26 22:10:11','2026-04-27 01:44:39');
/*!40000 ALTER TABLE `video_profiles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-01 19:14:29
