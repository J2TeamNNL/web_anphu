-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: web_anphu
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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `category_id` bigint unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (3,'Món quà đặc biệt Thủ tướng tặng Mẹ Việt Nam anh hùng ở Quảng Trị','mon-qua-dac-biet-thu-tuong-tang-me-viet-nam-anh-hung-o-quang-tri','article/4uJAp9lmqbzISLsdsYMW4mvfnNVYh3UCCD4f92L6.jpg','https://dantri.com.vn/xa-hoi/mon-qua-dac-biet-thu-tuong-tang-me-viet-nam-anh-hung-o-quang-tri-20250726143727789.htm','(Dân trí) - Thăm Mẹ Việt Nam anh hùng Đào Thị Vui, người có chồng và con trai cùng là liệt sỹ, Thủ tướng Phạm Minh Chính đã tặng Mẹ bức ảnh tái hiện hình ảnh Mẹ bên người con trai duy nhất.','<p><img src=\"http://web_anphu.test/storage/uploads/articles/PZZU4XDJyPHY7dtVH31QT8oqcDurKsk797dq9dkC.jpg\"><img><img><img>Ngày 26/7, nhân kỷ niệm 78 năm Ngày Thương binh - Liệt sỹ (27/7/1947-27/7/2025), Thủ tướng Phạm Minh Chính đã thăm, tặng quà Mẹ Việt Nam anh hùng; dâng hương, dâng hoa tại di tích quốc gia đặc biệt Thành cổ Quảng Trị và Nghĩa trang Liệt sĩ Quốc gia Đường 9 nhằm tưởng niệm các anh hùng liệt sỹ đã chiến đấu, hy sinh vì Tổ quốc.</p><p>&nbsp;</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/RACxuFm4crwi99x52XYNDAHvzJN3sfheNI3P54pZ.jpg\"></figure><p>&nbsp;</p><p>dsadsa</p><p>&nbsp;</p><p>&nbsp;</p><p>dsadsa</p><p>&nbsp;</p><p>&nbsp;</p>',15,'article','2025-07-26 02:37:09','2025-07-27 04:31:23'),(5,'Cuộc tháo chạy kinh hoàng lên đỉnh núi của hơn 100 dân bản Có Hạ','cuoc-thao-chay-kinh-hoang-len-dinh-nui-cua-hon-100-dan-ban-co-ha','article/PvYSE3CicqG4BpxAIaPre0LE1DojBkJ8qNo5tEN1.jpg',NULL,'(Dân trí) - Khi cơn lũ ập đến, cả bản với hơn 100 người cùng hô hoán nhau chạy thẳng lên núi tránh trú. Suốt cả đêm họ đứng giữa mưa lạnh, sáng trở về nhiều nhà đã bị cuốn trôi, tài sản mất trắng.','<figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/wMXztXPSEKUpArfrIDAfZRn7rUdorICsvAERZQmz.jpg\"></figure><h4><strong>Chạy trong tiếng lở núi, dầm mình giữa đêm mưa</strong></h4><p>Ngày thứ tư sau trận sạt lở núi, lũ quét kinh hoàng, người dân bản Có Hạ, xã Nhôn Mai (huyện Tương Dương cũ), tỉnh Nghệ An, vẫn chưa hết bàng hoàng, gương mặt ai cũng thất thần, sợ hãi.</p><p>Trở về nhà sau cuộc tháo chạy khỏi trận lũ quét, chị Seo Thị Tuyết (SN 1985) với gương mặt xanh xao, ánh mắt đượm buồn, nhìn toàn bộ tài sản của gia đình chỉ còn lại đống đổ nát. Chị bới lớp đất đá nhặt nhạnh một vài bộ quần áo cho con nhưng chẳng còn thứ gì có giá trị, toàn bộ tài sản đã bị cuốn trôi theo dòng nước lũ.<br><br>Ở bản đặc biệt khó khăn, xa xôi, quanh năm sống dựa vào ruộng lúa, nương ngô nên cách đây ít tháng, chồng chị là anh Moong Văn Quý (SN 1977) cùng nhóm thanh niên trong bản lên xã Quế Phong, tỉnh Nghệ An làm thuê.</p><p>Lúc 17h ngày 22/7, khi chị và con trai đang ở nhà nghe tiếng ầm ầm phát ra từ ngọn núi sau nhà. Cùng thời điểm, dưới khe suối Nậm Hi, dòng nước lũ đổ về cuồn cuộn. Nghe tiếng người dân hô \"lở núi\", chị vội vã cùng con trai tháo chạy.</p><p>“Vừa chạy ra khỏi nhà thì lượng lớn đất, đá từ trên núi dội xuống vùi lấp toàn bộ, tài sản bị cuốn trôi xuống dòng suối. Mọi thứ diễn ra quá nhanh, tôi không kịp mang theo tài sản, duy nhất chỉ có bộ quần áo trên người. Lúc đó, cả làng sợ hãi, mọi người hô hoán nhau chạy ngược lên một quả núi gần bản để tránh trú”, chị Tuyết kể lại giây phút trận lũ quét, sạt lở núi tàn phá bản làng.<br><img src=\"http://web_anphu.test/storage/uploads/articles/AtMn3Cp5cDmplhizfArtnbfiILrFUb9tKsHH2RIb.jpg\"></p><p>Cũng như chị Tuyết và hàng chục hộ khác ở bản Có Hạ, gia đình ông Lương Văn Liên (SN 1972), có 5 thành viên. Ngày 22/7, khi bữa cơm chiều mới được nấu xong, cả gia đình ông chưa kịp ăn thì cơn lũ ập đến, đất đá từ trên núi tràn xuống.</p><p>Ông Liên và nhiều người dân bản Có Hạ hô hoán nhau bỏ chạy. Trên ngọn núi cao với thời tiết mưa xối xả, cả gia đình ông chỉ biết ôm chặt lấy nhau, cùng cầu nguyện cho căn nhà không bị tàn phá.</p><p>Thế nhưng sau đêm trắng chạy lũ, ông Liên quay trở về bản thì tài sản không còn gì, căn nhà bị dòng nước lũ và đất, đá vùi lấp, cuốn trôi; hầu hết tài sản đã mất hoặc hư hỏng.</p><p>&nbsp;</p><h4><strong>“Mưa, đói, rét, tôi sợ hai con sẽ chết”</strong></h4><p>Nhà ở sát bờ suối Nậm Hi, 3 mẹ con chị Moong Thị Vân (SN 1993) đang chuẩn bị bữa cơm chiều thì trận lũ quét ập đến. Trong cơn hoảng loạn, chị địu con nhỏ trước ngực, dắt theo đứa lớn 8 tuổi tức tốc men theo đường mòn trên đỉnh núi.</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/zUHyzeiTQ2c1GLc2qIXkIRkCaqjqKt3WCiK9jg8Y.jpg\"></figure><p>“Thấy nước lũ đổ về, tôi ôm con định chạy ngược lên nhà hàng xóm để trốn. Nhưng khi gần đến nơi, tôi thấy mọi người nháo nhác bỏ nhà tháo chạy lên núi nên tôi ôm con đi theo”, chị Vân nói.</p><p>Chị Vân kể, do đường trơn, đá trượt, mẹ con chị cùng nhóm người men theo đường mòn để lên đỉnh núi. Đến 23h ngày 22/7, hàng chục hộ dân với hơn 100 nhân khẩu gồm người già, trẻ nhỏ, đàn ông, phụ nữ ở bản Có Hạ mới tìm được nơi tránh trú - đó là một lán nhỏ trên đỉnh núi.</p><p>Theo chị Vân, suốt khoảng thời gian từ 23h ngày 22/7 đến rạng sáng 23/7, giữa thời tiết mưa lớn, lại không có chăn, hai con của chị chân tay run lên lập cập, mặt tái mét vì lạnh và đói. Một số người già mệt mỏi, kiệt sức.</p>',14,'article','2025-07-27 03:25:15','2025-07-28 07:02:22'),(6,'nhà anh Cường 2','nha-anh-cuong-2','article/q3c8z254WHtQLN6KkxtRz8HDFkVC7EA1lFm4pEsn.jpg',NULL,'dsadsa','<p>dsadsa</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/A8YJQfNcHT41AyZGgwmJsqLDbP1HoBcGMdISGsPL.jpg\"></figure><p>dsadsadas</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/kCtESBM21l87QXuZxX8eMJBefYoIV9uh228lhvsc.jpg\"></figure>',16,'article','2025-07-28 01:22:19','2025-07-28 07:01:44');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
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
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('portfolio','article','price') COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Nội thất','noi-that','portfolio',NULL,NULL,NULL),(2,'Biệt thự','biet-thu','portfolio',NULL,NULL,NULL),(3,'Nhà phố','nha-pho','portfolio',NULL,NULL,NULL),(4,'Nhà thương mại','nha-thuong-mai','portfolio',NULL,NULL,NULL),(5,'Hiện đại','hien-dai','portfolio',1,'2025-07-24 03:29:47','2025-07-24 03:29:47'),(6,'Tân cổ điển','tan-co-dien','portfolio',1,'2025-07-24 03:29:47','2025-07-24 03:29:47'),(7,'Scadivanian','scadivanian','portfolio',1,'2025-07-24 03:29:47','2025-07-24 03:29:47'),(8,'2 tầng','2-tang','portfolio',3,'2025-07-24 03:29:47','2025-07-24 03:29:47'),(9,'3 tầng','3-tang','portfolio',3,'2025-07-24 03:29:47','2025-07-24 03:29:47'),(10,'4 đến 8 tầng','4-den-8-tang','portfolio',3,'2025-07-24 03:29:47','2025-07-24 03:29:47'),(11,'Nhà cấp 4','nha-cap-4','portfolio',3,'2025-07-24 03:29:47','2025-07-24 03:29:47'),(12,'Homestay','homestay','portfolio',4,'2025-07-24 03:29:47','2025-07-24 03:29:47'),(13,'Văn phòng','van-phong','portfolio',4,'2025-07-24 03:29:47','2025-07-24 03:29:47'),(14,'Đời sống An Phú','doi-song-an-phu','article',NULL,NULL,NULL),(15,'Sự kiện','su-kien','article',NULL,NULL,NULL),(16,'Công trình','cong-trinh','article',NULL,NULL,NULL),(17,'Tối giản','toi-gian','portfolio',1,NULL,NULL),(20,'Biệt thự hiện đại','biet-thu-hien-dai','portfolio',2,NULL,NULL),(21,'Biệt thự tân cổ điển','biet-thu-tan-co-dien','portfolio',2,NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_settings`
--

DROP TABLE IF EXISTS `company_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address_1` text COLLATE utf8mb4_unicode_ci,
  `company_address_2` text COLLATE utf8mb4_unicode_ci,
  `policy` text COLLATE utf8mb4_unicode_ci,
  `social_links` json DEFAULT NULL,
  `working_hours` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_settings`
--

LOCK TABLES `company_settings` WRITE;
/*!40000 ALTER TABLE `company_settings` DISABLE KEYS */;
INSERT INTO `company_settings` VALUES (1,'Công ty TNHH Tư vấn Thiết kế Kiến trúc và Nội thất An Phú','logos/logo.png','kientrucnoithat.anphu@gmail.com','0949 453 283',' 0969 317 331','Số 01, liền kề 18, KĐT Văn Khê','Thị trấn Hoàn Long, Hưng Yên','Xây tổ ấm vững bền cho bạn','{\"tiktok\": \"https://www.tiktok.com/@anphudesign\"}','Thời gian: 8h - 17h30 T2 - T7','2025-07-24 03:29:48','2025-07-24 03:29:48');
/*!40000 ALTER TABLE `company_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consulting_requests`
--

DROP TABLE IF EXISTS `consulting_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consulting_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consulting_requests`
--

LOCK TABLES `consulting_requests` WRITE;
/*!40000 ALTER TABLE `consulting_requests` DISABLE KEYS */;
INSERT INTO `consulting_requests` VALUES (1,'Duc Vu','0966708586','ducvu.nuce60@gmail.com','Hà Nội',0,'2025-07-28 09:25:44','2025-07-28 09:25:44');
/*!40000 ALTER TABLE `consulting_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
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
  `attempts` tinyint unsigned NOT NULL,
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
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('image','video') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `mediable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mediable_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_mediable_type_mediable_id_index` (`mediable_type`,`mediable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (75,'uploads/articles/YTAc2y4F42reoTkoCel0eKgiPHcCco8UftEOODYH.jpg','image',NULL,0,'App\\Models\\Portfolio',8,'2025-07-28 04:34:37','2025-07-28 04:34:45',NULL),(76,'uploads/articles/vZaxpn7LGJNRk2f3uqR200Tq1vk4x5E7jrink9bW.jpg','image',NULL,0,'App\\Models\\Portfolio',8,'2025-07-28 04:34:41','2025-07-28 04:34:45',NULL),(77,'uploads/articles/L1kJ5eA7kACts99PUfFe0mKboiL98ZnGph2P5Uhh.jpg','image',NULL,0,'App\\Models\\Portfolio',8,'2025-07-28 04:34:44','2025-07-28 04:34:45',NULL),(80,'uploads/articles/YzAIwhV755hznXXWn8tYW95hq8HlcPG6gtOvVPj7.jpg','image',NULL,0,'App\\Models\\Portfolio',12,'2025-07-28 06:43:48','2025-07-28 06:43:57',NULL),(81,'uploads/articles/soHsBUR2i5U6GRQZBQ9Nqj6cNWkcdAZ0KRPU9pRi.jpg','image',NULL,0,'App\\Models\\Portfolio',12,'2025-07-28 06:43:55','2025-07-28 06:43:57',NULL),(82,'uploads/articles/dL01QMDOkhMmUresiuHzjDOkKguyTAXoQYiRyjEi.jpg','image',NULL,0,'App\\Models\\Portfolio',13,'2025-07-28 06:44:44','2025-07-28 06:45:16',NULL),(83,'uploads/articles/pbkvAVqpi6LhIFCkXcxnOQmMr2zIo69Awvb6njsL.jpg','image',NULL,0,'App\\Models\\Portfolio',13,'2025-07-28 06:44:51','2025-07-28 06:45:16',NULL),(84,'uploads/articles/SKva1Ki5qGCB5EWWg5pwcMza4qg8esYW1fkx525V.jpg','image',NULL,0,'App\\Models\\Portfolio',13,'2025-07-28 06:45:06','2025-07-28 06:45:16',NULL),(85,'uploads/articles/kNIv4HS7HggWEgFjDy43hP2EYPKW4cl6fxdUKhWz.jpg','image',NULL,0,'App\\Models\\Portfolio',13,'2025-07-28 06:45:15','2025-07-28 06:45:16',NULL),(86,'uploads/articles/GrUBVtSwZXFloIsCWbLP5hJ60u9z7iosf5g47bp4.jpg','image',NULL,0,'App\\Models\\Portfolio',14,'2025-07-28 06:47:21','2025-07-28 06:48:23',NULL),(87,'uploads/articles/TUTqKJUZUZVCmZsfIuPnaBxBjeGk9ZH4lB9ckHTu.jpg','image',NULL,0,'App\\Models\\Portfolio',14,'2025-07-28 06:47:30','2025-07-28 06:48:23',NULL),(88,'uploads/articles/q5MsCMNsX8fvEXKvynbknLZCDQG7YtSk0xwTHTnN.jpg','image',NULL,0,'App\\Models\\Portfolio',14,'2025-07-28 06:47:43','2025-07-28 06:48:23',NULL),(89,'uploads/articles/x8JWhC7AK1o9qFpdwDpB2dc2uZ52lohHLrP2uFet.jpg','image',NULL,0,'App\\Models\\Portfolio',14,'2025-07-28 06:47:52','2025-07-28 06:48:23',NULL),(90,'uploads/articles/cpQ0v5CxLH7UxCtaaZaMHGBiARumWJB4fC38WHeV.jpg','image',NULL,0,'App\\Models\\Portfolio',9,'2025-07-28 06:49:00','2025-07-28 06:49:38',NULL),(91,'uploads/articles/2ZZwbgryqGtoC1IIvnZRK3o3JnPpHEHEy74GXXqa.jpg','image',NULL,0,'App\\Models\\Portfolio',9,'2025-07-28 06:49:13','2025-07-28 06:49:38',NULL),(92,'uploads/articles/NAEYZrLk5lMAwyoZX1A6CqTOA4ZoWGY6Pr3HgmqR.jpg','image',NULL,0,'App\\Models\\Portfolio',9,'2025-07-28 06:49:22','2025-07-28 06:49:38',NULL),(93,'uploads/articles/yy8CIwzoJnb1LC2GQGPaRXcowfsqtC6NLqrl29cE.jpg','image',NULL,0,'App\\Models\\Portfolio',9,'2025-07-28 06:49:35','2025-07-28 06:49:38',NULL),(94,'uploads/articles/bqV9QygKK4A0MzMpD8WnS3jLXduXnDYjp2Vqr6cs.jpg','image',NULL,0,'App\\Models\\Portfolio',7,'2025-07-28 06:50:31','2025-07-28 06:50:49',NULL),(95,'uploads/articles/8lqdYG4OuSjzSCJ3w7f4pdVS4MFwhHRubcUKUOBH.jpg','image',NULL,0,'App\\Models\\Portfolio',7,'2025-07-28 06:50:38','2025-07-28 06:50:49',NULL),(96,'uploads/articles/9gVCgXfUljfDqvqrs1YIafaEWwrVrGmLONfZFp1y.jpg','image',NULL,0,'App\\Models\\Portfolio',7,'2025-07-28 06:50:44','2025-07-28 06:50:49',NULL),(97,'uploads/articles/VZz0EMxW3tIoeMFMZbaQN6MEmoolcGmOdXXIf4Kj.jpg','image',NULL,0,'App\\Models\\Portfolio',6,'2025-07-28 06:51:32','2025-07-28 06:52:47',NULL),(98,'uploads/articles/F9jzQliKkE0TkpcRVZ92ir02gfe1Yp3j9hZqQznk.jpg','image',NULL,0,'App\\Models\\Portfolio',6,'2025-07-28 06:51:54','2025-07-28 06:52:47',NULL),(99,'uploads/articles/xwFwepoeknJ8T6PIcSkLzSlDCpCV2fIlNGb1IHFQ.jpg','image',NULL,0,'App\\Models\\Portfolio',6,'2025-07-28 06:52:01','2025-07-28 06:52:47',NULL),(100,'uploads/articles/z4bLBSAZ8sMoIszhwmcZIjgvCAu1tMtFARkgLwfQ.jpg','image',NULL,0,'App\\Models\\Portfolio',6,'2025-07-28 06:52:07','2025-07-28 06:52:47',NULL),(101,'uploads/articles/qKrusuldgT1YxK0hVw8c7wU0oYmpCh9Lw2SwttIB.jpg','image',NULL,0,'App\\Models\\Portfolio',6,'2025-07-28 06:52:24','2025-07-28 06:52:47',NULL),(102,'uploads/articles/ElXSXrU9ietN1NWVaCUw2zIE995ZOGFmi36iUS0B.jpg','image',NULL,0,'App\\Models\\Portfolio',6,'2025-07-28 06:52:31','2025-07-28 06:52:47',NULL),(103,'uploads/articles/hY1xxLze4yifnoeX3prEFyMICobOZvVRjhI3ljcL.jpg','image',NULL,0,'App\\Models\\Portfolio',6,'2025-07-28 06:52:46','2025-07-28 06:52:47',NULL),(104,'uploads/articles/LgOfu16VVusza6wvZNqsnVqEW6qIxihMa6woYrcY.jpg','image',NULL,0,'App\\Models\\Portfolio',5,'2025-07-28 06:53:25','2025-07-28 06:54:46',NULL),(105,'uploads/articles/5mYbQ2ZHOab3IaWOzwUvxFWnNVP1rCDIdYidesiW.jpg','image',NULL,0,'App\\Models\\Portfolio',5,'2025-07-28 06:53:39','2025-07-28 06:54:46',NULL),(106,'uploads/articles/oDvY1XKVeiCUlAKkXciiOr8bL6SMlXfTlm2GjC1S.jpg','image',NULL,0,'App\\Models\\Portfolio',5,'2025-07-28 06:53:48','2025-07-28 06:54:46',NULL),(107,'uploads/articles/LCNbIjDumnoSFqSIDBXmglmaWzLEc3X8RRxc30mG.jpg','image',NULL,0,'App\\Models\\Portfolio',5,'2025-07-28 06:54:22','2025-07-28 06:54:46',NULL),(108,'uploads/articles/mEOr60oKMm7jFGk1BHicJNY5kvKeo2l0n3FeA7Q8.jpg','image',NULL,0,'App\\Models\\Portfolio',5,'2025-07-28 06:54:30','2025-07-28 06:54:46',NULL),(109,'uploads/articles/dsGfUFYjV8xhpygruFsDjpalbqGU7rmXsqq3pijj.jpg','image',NULL,0,'App\\Models\\Portfolio',5,'2025-07-28 06:54:44','2025-07-28 06:54:46',NULL),(110,'uploads/articles/tgArXG7ueOUUJGK0loNQtxraAxnb91Tahh5PLO24.jpg','image',NULL,0,'App\\Models\\Portfolio',4,'2025-07-28 06:55:27','2025-07-28 06:56:43',NULL),(111,'uploads/articles/9FtCKOIHV0DO5xwJevntbamh72dimRD6nqtIpiJd.jpg','image',NULL,0,'App\\Models\\Portfolio',4,'2025-07-28 06:55:35','2025-07-28 06:56:43',NULL),(112,'uploads/articles/LQd3Vxpww6pvF8WHlrHXrnNokODmNGLShWwyDxxI.jpg','image',NULL,0,'App\\Models\\Portfolio',4,'2025-07-28 06:55:50','2025-07-28 06:56:43',NULL),(113,'uploads/articles/4g4cDdraBMY2tfItURBN9Y0lLXNWYYtGNUybxUMx.jpg','image',NULL,0,'App\\Models\\Portfolio',4,'2025-07-28 06:56:10','2025-07-28 06:56:43',NULL),(114,'uploads/articles/dVTasotMYeefexWkj9RQwRV8NGO9Z6RAYintkoM7.jpg','image',NULL,0,'App\\Models\\Portfolio',4,'2025-07-28 06:56:15','2025-07-28 06:56:43',NULL),(115,'uploads/articles/jKluVdwTJvc3fShhCvXtNw4DyVV4owZMLIiwd753.jpg','image',NULL,0,'App\\Models\\Portfolio',4,'2025-07-28 06:56:41','2025-07-28 06:56:43',NULL),(116,'uploads/articles/eaVFSMSAFG8sG4IBRtuEgL40PRQY9Li24qvKx0XM.jpg','image',NULL,0,'App\\Models\\Portfolio',15,'2025-07-28 06:57:42','2025-07-28 06:59:03',NULL),(118,'uploads/articles/eQzwO5CadE4MZHVOz8HSIMk7wAEz03SsPuIEqr91.jpg','image',NULL,0,'App\\Models\\Portfolio',15,'2025-07-28 06:57:51','2025-07-28 06:59:03',NULL),(119,'uploads/articles/e9VI64IOVqq5pgb2zpRaTFBd8vIRHpkMRpEa6XMZ.jpg','image',NULL,0,'App\\Models\\Portfolio',15,'2025-07-28 06:58:01','2025-07-28 06:59:03',NULL),(120,'uploads/articles/Y5HqmKdgkyW2kNZ5v2L14PXwEHPHOkRvpapvQOjU.jpg','image',NULL,0,'App\\Models\\Portfolio',15,'2025-07-28 06:58:13','2025-07-28 06:59:03',NULL),(121,'uploads/articles/JxtTQMHExD8YZtreQFCT8jEPt54Hf2tnwkJ7lMRn.jpg','image',NULL,0,'App\\Models\\Portfolio',15,'2025-07-28 06:58:46','2025-07-28 06:59:03',NULL),(122,'uploads/articles/murW2TgOUmct99l3EjoEj9OgHpOEwYk3NE8GtTq1.jpg','image',NULL,0,'App\\Models\\Portfolio',15,'2025-07-28 06:58:55','2025-07-28 06:59:03',NULL),(123,'uploads/articles/A8YJQfNcHT41AyZGgwmJsqLDbP1HoBcGMdISGsPL.jpg','image',NULL,0,'App\\Models\\Article',6,'2025-07-28 07:01:32','2025-07-28 07:01:44',NULL),(124,'uploads/articles/kCtESBM21l87QXuZxX8eMJBefYoIV9uh228lhvsc.jpg','image',NULL,0,'App\\Models\\Article',6,'2025-07-28 07:01:42','2025-07-28 07:01:44',NULL),(125,'uploads/articles/AtMn3Cp5cDmplhizfArtnbfiILrFUb9tKsHH2RIb.jpg','image',NULL,0,'App\\Models\\Article',5,'2025-07-28 07:02:15','2025-07-28 07:02:22',NULL),(126,'uploads/articles/zUHyzeiTQ2c1GLc2qIXkIRkCaqjqKt3WCiK9jg8Y.jpg','image',NULL,0,'App\\Models\\Article',5,'2025-07-28 07:02:21','2025-07-28 07:02:22',NULL),(127,'uploads/articles/j6PPSTHFz3mgY8GWUNbTuAeGwn7ZX4SyMK0QyCbm.jpg','image',NULL,0,'App\\Models\\Portfolio',16,'2025-07-28 07:08:38','2025-07-28 07:08:56',NULL),(128,'uploads/articles/T8HC0D2WKiUDfNgx5WNaSWcyiUTCNu8XjaW8g3CJ.jpg','image',NULL,0,'App\\Models\\Portfolio',16,'2025-07-28 07:08:42','2025-07-28 07:08:56',NULL),(129,'uploads/articles/XbkxCRgopxcndpdKcRU1N9B0Y6UajUatR8SMTyrY.jpg','image',NULL,0,'App\\Models\\Portfolio',16,'2025-07-28 07:08:46','2025-07-28 07:08:56',NULL),(134,'uploads/articles/b1mtF0Puxe6XEWIRB43V5Q92FlB3HhiTHCe6M6Es.jpg','image',NULL,0,'App\\Models\\Portfolio',19,'2025-07-28 07:13:48','2025-07-28 07:14:02',NULL),(135,'uploads/articles/vvTU8x5jiUmAASDjBuNtGhhotR5EYkhQNk5dMcr2.jpg','image',NULL,0,'App\\Models\\Portfolio',19,'2025-07-28 07:13:51','2025-07-28 07:14:02',NULL),(136,'uploads/articles/PwVRo2mLD44qrwk9pPkrH0PxXeIyWThZ7yMkglaD.jpg','image',NULL,0,'App\\Models\\Portfolio',19,'2025-07-28 07:13:54','2025-07-28 07:14:02',NULL),(137,'uploads/articles/Lr8sGr4V6PaquCLMAUEpedCiKDg3reSscozsuDsT.jpg','image',NULL,0,'App\\Models\\Portfolio',18,'2025-07-28 07:14:41','2025-07-28 07:15:02',NULL),(138,'uploads/articles/3na7YCUGfDgdttXeogcI60qOBiQoCbVGTfA3hYWc.jpg','image',NULL,0,'App\\Models\\Portfolio',18,'2025-07-28 07:14:54','2025-07-28 07:15:02',NULL),(139,'uploads/articles/6i7TKeXcDPqdU0dEk3UTDoUzZhr3qkPDIY4YQJAp.jpg','image',NULL,0,'App\\Models\\Portfolio',18,'2025-07-28 07:14:58','2025-07-28 07:15:02',NULL),(140,'uploads/articles/GJW88o0PZ70YwZCIMlSHvkG3weXvoKMrKTo7ScXf.jpg','image',NULL,0,'App\\Models\\Portfolio',18,'2025-07-28 07:15:01','2025-07-28 07:15:02',NULL),(141,'uploads/articles/4DiFFqK3Bstw31cTcT29hhhdDjpiuW7PoxxdQYpe.jpg','image',NULL,0,'App\\Models\\Portfolio',20,'2025-07-28 07:16:16','2025-07-28 07:16:32',NULL),(142,'uploads/articles/bt5HHheHGnyS3hlJVV3nw9bNe7CYpfX6Qh3Q1AMJ.jpg','image',NULL,0,'App\\Models\\Portfolio',20,'2025-07-28 07:16:20','2025-07-28 07:16:32',NULL),(143,'uploads/articles/191Uu7XzIVayJNkw01oNYc3SlL5XZIsIqBvEEY5l.jpg','image',NULL,0,'App\\Models\\Portfolio',20,'2025-07-28 07:16:24','2025-07-28 07:16:32',NULL),(144,'uploads/articles/inxOSXHHU65gMkOoux60exLv2n0YNnoYdIQmlW6p.jpg','image',NULL,0,'App\\Models\\Portfolio',20,'2025-07-28 07:16:27','2025-07-28 07:16:32',NULL),(145,'uploads/articles/yqhvEsQtodSa2dAGiFlyZbRnIId62jIR0x3oWax0.jpg','image',NULL,0,'App\\Models\\Portfolio',21,'2025-07-28 07:17:19','2025-07-28 07:17:42',NULL),(146,'uploads/articles/wVbTnTQZnSRsHwHtBAqHpdN8729EIltsjJ7OqM66.jpg','image',NULL,0,'App\\Models\\Portfolio',21,'2025-07-28 07:17:29','2025-07-28 07:17:42',NULL),(147,'uploads/articles/NUYBtE42c8wlLrXrikYewWdGRbcv1p8zOTrviUOH.jpg','image',NULL,0,'App\\Models\\Portfolio',22,'2025-07-28 07:18:23','2025-07-28 07:18:40',NULL),(148,'uploads/articles/cmu2eFYYvlR6IRQWP29KtCxJOBxDaYAKrqJkSa5u.jpg','image',NULL,0,'App\\Models\\Portfolio',22,'2025-07-28 07:18:26','2025-07-28 07:18:40',NULL),(149,'uploads/articles/kwAvqqdCpgMs3LtFQQ3KQvvy5ASZg58vG0khHI26.jpg','image',NULL,0,'App\\Models\\Portfolio',22,'2025-07-28 07:18:29','2025-07-28 07:18:40',NULL);
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (12,'2025_07_23_103625_create_categorizables_table',1),(57,'0001_01_01_000000_create_users_table',2),(58,'0001_01_01_000001_create_cache_table',2),(59,'0001_01_01_000002_create_jobs_table',2),(60,'2025_07_02_072040_create_table_customers',2),(61,'2025_07_02_072053_create_customers_table',2),(62,'2025_07_10_080722_create_portfolios_table',2),(63,'2025_07_11_090710_create_articles_table',2),(64,'2025_07_16_093125_create_consulting_requests_table',2),(65,'2025_07_17_125851_create_categories_table',2),(66,'2025_07_22_130952_create_company_settings_table',2),(67,'2025_07_23_053349_create_prices_table',2),(68,'2025_07_25_040104_add_content_to_articles_table',3),(70,'2025_07_26_091951_create_media_table',4),(71,'2025_07_28_072821_add_content_to_portfolios_table',5),(72,'2025_07_28_082715_add_table_name_to_media_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_id` bigint unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` year DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portfolios_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

LOCK TABLES `portfolios` WRITE;
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` VALUES (4,'Nhà anh Hồng Anh','duc-vu','Hải Phòng','Anh Hồng Anh','Phong cách hiện đại',5,'porfolio',2019,'article/G8BG2KgSdjtpVrv80tuQn78kvNSGEoa5bj7kvYit.jpg','<p>Tiêu đề</p><p>Mô tả</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/tgArXG7ueOUUJGK0loNQtxraAxnb91Tahh5PLO24.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/9FtCKOIHV0DO5xwJevntbamh72dimRD6nqtIpiJd.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/LQd3Vxpww6pvF8WHlrHXrnNokODmNGLShWwyDxxI.jpg\"></figure><p>Ảnh 4</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/4g4cDdraBMY2tfItURBN9Y0lLXNWYYtGNUybxUMx.jpg\"></figure><p>Ảnh 5</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/dVTasotMYeefexWkj9RQwRV8NGO9Z6RAYintkoM7.jpg\"></figure><p>Ảnh 6</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/jKluVdwTJvc3fShhCvXtNw4DyVV4owZMLIiwd753.jpg\"></figure>','2025-07-28 00:32:24','2025-07-28 06:56:43'),(5,'Anh Cường (2)','tony-stark','Hà Nội','Anh Cường','Phong cách hiện đại',6,'porfolio',2017,'portfolio/i45jWJBTYHBLj5ozaGf60jIl0AUxciuX3zHWoV9i.jpg','<p>Tiêu đề</p><p>Mô tả</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/oDvY1XKVeiCUlAKkXciiOr8bL6SMlXfTlm2GjC1S.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/LgOfu16VVusza6wvZNqsnVqEW6qIxihMa6woYrcY.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/5mYbQ2ZHOab3IaWOzwUvxFWnNVP1rCDIdYidesiW.jpg\"></figure><p>Ảnh 4</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/LCNbIjDumnoSFqSIDBXmglmaWzLEc3X8RRxc30mG.jpg\"></figure><p>Ảnh 5</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/mEOr60oKMm7jFGk1BHicJNY5kvKeo2l0n3FeA7Q8.jpg\"></figure><p>Ảnh 6</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/dsGfUFYjV8xhpygruFsDjpalbqGU7rmXsqq3pijj.jpg\"></figure>','2025-07-28 00:43:24','2025-07-28 06:54:46'),(6,'Nhà anh Cường (1)','dsadsa','Hà Nội','Anh Cường','Phong cách tân cổ điển',6,'porfolio',2018,'portfolio/pMvyANVYWaCBB7wyFaO0Rd9txzNUUacJQdHZqkd8.jpg','<p>Tiêu đề</p><p>Mô tả</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/VZz0EMxW3tIoeMFMZbaQN6MEmoolcGmOdXXIf4Kj.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/F9jzQliKkE0TkpcRVZ92ir02gfe1Yp3j9hZqQznk.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/xwFwepoeknJ8T6PIcSkLzSlDCpCV2fIlNGb1IHFQ.jpg\"></figure><p>Ảnh 4</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/z4bLBSAZ8sMoIszhwmcZIjgvCAu1tMtFARkgLwfQ.jpg\"></figure><p>Ảnh 5</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/qKrusuldgT1YxK0hVw8c7wU0oYmpCh9Lw2SwttIB.jpg\"></figure><p>Ảnh 6</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/ElXSXrU9ietN1NWVaCUw2zIE995ZOGFmi36iUS0B.jpg\"></figure><p>Ảnh 7</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/hY1xxLze4yifnoeX3prEFyMICobOZvVRjhI3ljcL.jpg\"></figure>','2025-07-28 00:46:20','2025-07-28 06:52:47'),(7,'Nhà chị Nhung','nha-chi-nhung','Lào Cai','Chị Nhung','Phong cách Tân cổ điển',6,'porfolio',2020,'portfolio/fwQlBVeObCyjigSsJMNb8YHyP37G0tvJPk08dUeg.jpg','<p>Tiêu đề</p><p>Mô tả</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/bqV9QygKK4A0MzMpD8WnS3jLXduXnDYjp2Vqr6cs.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/8lqdYG4OuSjzSCJ3w7f4pdVS4MFwhHRubcUKUOBH.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/9gVCgXfUljfDqvqrs1YIafaEWwrVrGmLONfZFp1y.jpg\"></figure>','2025-07-28 04:07:05','2025-07-28 06:50:49'),(8,'Nhà chị Xuyến','nha-chi-xuyen','Hà Nội','Chị Xuyến','Phong cách trẻ trung',7,'porfolio',2017,'portfolio/HkkuE5fXC8sCbDzhBF5Q9I0mZLbGrlFImU638HVu.jpg','<p>Tiêu đề</p><p>Mô tả</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/YTAc2y4F42reoTkoCel0eKgiPHcCco8UftEOODYH.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/vZaxpn7LGJNRk2f3uqR200Tq1vk4x5E7jrink9bW.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/L1kJ5eA7kACts99PUfFe0mKboiL98ZnGph2P5Uhh.jpg\"></figure>','2025-07-28 04:18:49','2025-07-28 04:34:45'),(9,'Nhà chị Xuyến Masteri','nha-chi-xuyen-masteri','Hà Nội','Chị Xuyến','Phong cách mới mẻ',7,'porfolio',2021,'portfolio/Ctp4S5XIw8K8rk7wbEcaUUVGUMfxk4b18kImYCBw.jpg','<p>Tiêu đề</p><p>Mô tả</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/cpQ0v5CxLH7UxCtaaZaMHGBiARumWJB4fC38WHeV.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/yy8CIwzoJnb1LC2GQGPaRXcowfsqtC6NLqrl29cE.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/2ZZwbgryqGtoC1IIvnZRK3o3JnPpHEHEy74GXXqa.jpg\"></figure><p>Ảnh 4</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/NAEYZrLk5lMAwyoZX1A6CqTOA4ZoWGY6Pr3HgmqR.jpg\"></figure><p>&nbsp;</p>','2025-07-28 04:22:32','2025-07-28 06:49:38'),(12,'Nhà chị Trang','nha-chi-trang','Hà Nội','Chị Trang','Phong cách trẻ trung',5,'porfolio',2017,'portfolio/q4zXCA5uX1LZyIcn2YwJL6GSfI5051bP0q0MmF3y.jpg','<p>Tiêu đề</p><p>Mô tả</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/YzAIwhV755hznXXWn8tYW95hq8HlcPG6gtOvVPj7.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/soHsBUR2i5U6GRQZBQ9Nqj6cNWkcdAZ0KRPU9pRi.jpg\"></figure><p>Ảnh 3</p>','2025-07-28 06:38:18','2025-07-28 06:43:57'),(13,'Nhà chị Hạnh','nha-chi-hanh','Hòa Bình','Chị Hạnh','Phong cách tối giản',5,'porfolio',2019,'portfolio/7Q73LIj3nV123fdoZFFs3wRMlXUZPGbNmeM0KXMR.jpg','<p>Tiêu đề</p><p>Mô tả</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/dL01QMDOkhMmUresiuHzjDOkKguyTAXoQYiRyjEi.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/pbkvAVqpi6LhIFCkXcxnOQmMr2zIo69Awvb6njsL.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/SKva1Ki5qGCB5EWWg5pwcMza4qg8esYW1fkx525V.jpg\"></figure><p>Ảnh 4</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/kNIv4HS7HggWEgFjDy43hP2EYPKW4cl6fxdUKhWz.jpg\"></figure>','2025-07-28 06:39:31','2025-07-28 06:45:16'),(14,'Nhà anh Mạnh','nha-anh-manh','Lào Cai','Anh Mạnh','Phong cách tối giản',17,'portfolio',2021,'portfolio/dmKjtIua0yMd1T2Ujx3V7A6uNzVMSpeF8KqXu9m1.jpg','<p>Tiêu đề</p><p>Mô tả</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/x8JWhC7AK1o9qFpdwDpB2dc2uZ52lohHLrP2uFet.jpg\"></figure><p>&nbsp;</p><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/TUTqKJUZUZVCmZsfIuPnaBxBjeGk9ZH4lB9ckHTu.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/GrUBVtSwZXFloIsCWbLP5hJ60u9z7iosf5g47bp4.jpg\"></figure><p>Ảnh 4</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/q5MsCMNsX8fvEXKvynbknLZCDQG7YtSk0xwTHTnN.jpg\"></figure><p>&nbsp;</p>','2025-07-28 06:48:23','2025-07-28 06:48:23'),(15,'Nhà anh Vinh','nha-anh-vinh','Hà Nội','Anh Vinh','Phong cách tối giản',17,'portfolio',2018,'portfolio/b0JJq4SMS4sYzabLTIBVlG3IpzcByZd7FfkAx0aK.jpg','<p>Tiêu đề</p><p>Mô tả</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/eaVFSMSAFG8sG4IBRtuEgL40PRQY9Li24qvKx0XM.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/eQzwO5CadE4MZHVOz8HSIMk7wAEz03SsPuIEqr91.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/Y5HqmKdgkyW2kNZ5v2L14PXwEHPHOkRvpapvQOjU.jpg\"></figure><p>Ảnh 4</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/e9VI64IOVqq5pgb2zpRaTFBd8vIRHpkMRpEa6XMZ.jpg\"></figure><p>Ảnh 5</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/JxtTQMHExD8YZtreQFCT8jEPt54Hf2tnwkJ7lMRn.jpg\"></figure><p>Ảnh 6</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/murW2TgOUmct99l3EjoEj9OgHpOEwYk3NE8GtTq1.jpg\"></figure>','2025-07-28 06:59:03','2025-07-28 06:59:03'),(16,'Biệt thự 2 tầng tân cổ điển','biet-thu-2-tang','Bắc Ninh',NULL,'Biệt thự phong cách tân cổ điển',21,'porfolio',2019,'portfolio/KvsLFlejwSGm1xNSbpQ6e89f0EtBa9KYwTLianGS.jpg','<p>Tiêu đề</p><p>Mô tả</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/j6PPSTHFz3mgY8GWUNbTuAeGwn7ZX4SyMK0QyCbm.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/T8HC0D2WKiUDfNgx5WNaSWcyiUTCNu8XjaW8g3CJ.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/XbkxCRgopxcndpdKcRU1N9B0Y6UajUatR8SMTyrY.jpg\"></figure>','2025-07-28 07:08:56','2025-07-28 07:12:46'),(18,'Nhà anh Ân','biet-thu-2-tang-khong-gian-ngoai-canh','Hải Phòng','Anh Ân','Biệt thự 2 tầng mang phong cách hiện đại được tối đa hóa thiên nhiên ngoại cảnh',20,'porfolio',2020,'portfolio/oZXGsomkZ11xaNLIgKbWuYJ3u8DwWqdPQqKD9Ygk.jpg','<p>Tiêu đề</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/Lr8sGr4V6PaquCLMAUEpedCiKDg3reSscozsuDsT.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/3na7YCUGfDgdttXeogcI60qOBiQoCbVGTfA3hYWc.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/6i7TKeXcDPqdU0dEk3UTDoUzZhr3qkPDIY4YQJAp.jpg\"></figure><p>Ảnh 4</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/GJW88o0PZ70YwZCIMlSHvkG3weXvoKMrKTo7ScXf.jpg\"></figure>','2025-07-28 07:12:32','2025-07-28 07:47:33'),(19,'Nhà bác Ánh','nha-bac-anh','Bắc Ninh','Bác Ánh','Nhà cấp 4 phong cách tân cổ điển',11,'portfolio',2018,'portfolio/HM9aB5YzVen8t6jE5A0UQhNacRAnF0MYBFYYz6pp.jpg','<p>Tiêu đề</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/b1mtF0Puxe6XEWIRB43V5Q92FlB3HhiTHCe6M6Es.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/vvTU8x5jiUmAASDjBuNtGhhotR5EYkhQNk5dMcr2.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/PwVRo2mLD44qrwk9pPkrH0PxXeIyWThZ7yMkglaD.jpg\"></figure>','2025-07-28 07:14:02','2025-07-28 07:14:02'),(20,'Homestay Sóc Sơn','homestay-soc-son','Sóc Sơn',NULL,'Homestay tối giản kết hợp yếu tố thiên nhiên',12,'portfolio',2019,'portfolio/Lm8G3JUvfSngma6ddO8WiNZLatf3dYahmB6JeVtC.jpg','<p>Tiêu đề</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/4DiFFqK3Bstw31cTcT29hhhdDjpiuW7PoxxdQYpe.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/bt5HHheHGnyS3hlJVV3nw9bNe7CYpfX6Qh3Q1AMJ.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/191Uu7XzIVayJNkw01oNYc3SlL5XZIsIqBvEEY5l.jpg\"></figure><p>Ảnh 4</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/inxOSXHHU65gMkOoux60exLv2n0YNnoYdIQmlW6p.jpg\"></figure>','2025-07-28 07:16:32','2025-07-28 07:16:32'),(21,'Nhà anh Hồng Anh','nha-anh-hong-anh','Hà Nội','Anh Hồng Anh','Nhà phố phong cách hiện đại',9,'portfolio',2019,'portfolio/7F1FFCf8fxnB1EYCAjeTj9EKgwjh1930UwKtcFAC.jpg','<p>Tiêu đề</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/yqhvEsQtodSa2dAGiFlyZbRnIId62jIR0x3oWax0.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/wVbTnTQZnSRsHwHtBAqHpdN8729EIltsjJ7OqM66.jpg\"></figure>','2025-07-28 07:17:42','2025-07-28 07:17:42'),(22,'Nhà chị Thảo','nha-chi-thao','Hưng Yên','Chị Thảo','Biệt thự phong cách tân cổ điển',21,'portfolio',2019,'portfolio/CUNdoUdq5FWjzHVndqlhfDL2MMUVkdUDnwIEbnf4.jpg','<p>Tiêu đề</p><p>Ảnh 1</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/NUYBtE42c8wlLrXrikYewWdGRbcv1p8zOTrviUOH.jpg\"></figure><p>Ảnh 2</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/cmu2eFYYvlR6IRQWP29KtCxJOBxDaYAKrqJkSa5u.jpg\"></figure><p>Ảnh 3</p><figure class=\"image\"><img src=\"http://web_anphu.test/storage/uploads/articles/kwAvqqdCpgMs3LtFQQ3KQvvy5ASZg58vG0khHI26.jpg\"></figure>','2025-07-28 07:18:40','2025-07-28 07:18:40');
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_id` bigint unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('lUgtek1yLNzagIOse21fUiotF4NejjcLXkUOdTkb',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo4OntzOjY6Il90b2tlbiI7czo0MDoiTlN5Qko1VjZWSDlzeWJaTTJkaXRIOTNRMnl6bFBnczRhb3VFV0hiTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly93ZWJfYW5waHUudGVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6NjoiQW4gUGh1IjtzOjY6ImF2YXRhciI7TjtzOjU6ImxldmVsIjtpOjE7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9fQ==',1753721672);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_customers`
--

DROP TABLE IF EXISTS `table_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_customers`
--

LOCK TABLES `table_customers` WRITE;
/*!40000 ALTER TABLE `table_customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `table_customers` ENABLE KEYS */;
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
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` tinyint NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'An Phu','ducvu.nuce60@gmail.com','2025-07-24 03:29:48','$2y$12$yJr/Yc0hL1j4M/4MZ7N/7.L8oiT/L5hVJOZf62L5G3am45ZbHhb7G',NULL,1,'NCKGSRNli8',NULL,NULL),(2,'Ervin Hilpert III','koss.alexie@example.org','2025-07-24 03:29:48','$2y$12$LhQRQlex0bU1gaEtp5xkM.CX4YIfGNBASUudWJS3Abu16yQBpyHLq',NULL,1,'aZmyqbCUNy',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-29  0:08:12
