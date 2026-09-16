/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.14-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: softwareplas_merve
-- ------------------------------------------------------
-- Server version	10.11.14-MariaDB-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `about`
--

DROP TABLE IF EXISTS `about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `about` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subtitle` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about`
--

LOCK TABLES `about` WRITE;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;
INSERT INTO `about` VALUES
(1,'MERHABA','Ben Merve Kalaycı','<p>Psikoloji alanındaki eğitimim ve mesleki deneyimimle, Manisa\'da ve online olarak bireysel ve çift danışmanlığı hizmeti veriyorum. Danışanlarımla çalışırken güncel bilimsel yaklaşımlardan yararlanır, her sürecin o kişiye özgü olduğuna inanırım.</p><p><em>(Bu metin örnektir — eğitim geçmişiniz, unvanınız ve deneyiminizle güncellemenizi öneririz.)</em></p>','about-1.svg','1','2026-09-13 19:55:29','2026-09-13 19:55:29'),
(2,'YAKLAŞIMIM','Güvenli, Yargısız Bir Alan','<p>Terapiye gelen her kişinin kendine has bir hikâyesi olduğuna inanıyorum. Seanslarda sizi dinlemeyi, birlikte anlamlandırmayı ve kendi çözümlerinizi bulmanıza eşlik etmeyi önceliğim olarak görüyorum. Paylaştığınız her şey gizlilik ilkesi çerçevesinde korunur.</p>','about-1.svg','2','2026-09-13 19:55:29','2026-09-13 19:55:29');
/*!40000 ALTER TABLE `about` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES
(1,'Psikoeğitim','psikoegitim','2026-09-13 19:55:29','2026-09-13 19:55:29');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `content` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES
(1,1,'Kaygıyla Baş Etmenin Yolları','Günlük hayatta karşılaştığımız kaygı hissiyle sağlıklı bir şekilde baş etmenin genel yollarına dair bilgilendirici bir yazı.','<p>Kaygı, hayatın normal ve zaman zaman koruyucu bir parçasıdır; ancak sıklaştığında ya da günlük yaşamı zorlaştırdığında üzerinde durmaya değer bir konu haline gelir.</p><p><strong>Nefes çalışmaları:</strong> Yavaş ve derin nefes almak, bedenin stres tepkisini yatıştırmaya yardımcı olabilir.</p><p><strong>Düşünceleri fark etmek:</strong> Kaygılı anlarda zihinden geçenleri yargılamadan not etmek, onlarla aramıza bir mesafe koymamızı sağlayabilir.</p><p><strong>Rutin ve uyku:</strong> Düzenli uyku ve günlük rutin, kaygı yönetiminde önemli bir zemin oluşturur.</p><p>Kaygı uzun süredir hayatınızı zorlaştırıyorsa, bir uzmandan destek almak atabileceğiniz değerli bir adımdır. Bu yazı genel bilgilendirme amaçlıdır; kişisel durumunuz için bir görüşme planlamaktan çekinmeyin.</p>','kaygı, stres yönetimi, psikoeğitim','kaygiyla-bas-etmenin-yollari','blog-kaygi.svg','2026-09-13 19:55:29','2026-09-13 19:55:29'),
(2,1,'Online Terapi Nedir, Nasıl İşler?','Görüntülü görüşme yoluyla yürütülen online terapinin ne olduğu ve süreçte nelere dikkat edilmesi gerektiği hakkında merak edilenler.','<p>Online terapi, danışan ve terapistin güvenli bir görüntülü görüşme platformu üzerinden bir araya geldiği bir çalışma biçimidir.</p><p><strong>Nasıl başlar?</strong> Randevu sonrası size özel bir bağlantı paylaşılır; seans, tıpkı yüz yüze görüşmede olduğu gibi belirlenen saatte gerçekleşir.</p><p><strong>Gizlilik nasıl korunur?</strong> Görüşmenin sizin için sessiz ve kesintisiz bir ortamda yapılması, gizliliğin korunması açısından önemlidir.</p><p><strong>Kimler için uygundur?</strong> Seyahat, yoğun iş temposu ya da farklı bir şehirde/ülkede yaşama gibi nedenlerle yüz yüze görüşemeyen pek çok kişi online terapiden fayda görebilir.</p>','online terapi, sıkça sorulanlar','online-terapi-nedir-nasil-isler','blog-online-terapi.svg','2026-09-13 19:55:29','2026-09-13 19:55:29'),
(3,1,'İlk Terapi Seansında Neler Olur?','Terapiye ilk kez başlayacak olanlar için ilk seansta genel olarak neler konuşulduğuna dair bilgilendirici bir rehber.','<p>Terapiye başlamak, pek çok kişi için heyecan verici olduğu kadar biraz da endişe uyandırıcı olabilir. İlk seans, genellikle birbirimizi tanımaya ve sizi buraya getiren konuyu anlamaya ayrılır.</p><p>Bu görüşmede geçmişiniz, şu anki yaşam koşullarınız ve terapiden beklentileriniz hakkında sorular sorarım; ancak anlatmak istemediğiniz hiçbir şeyi paylaşmak zorunda değilsiniz.</p><p>Amaç, ilk seansın sonunda birlikte çalışmanın sizin için doğru hissedip hissetmediğine karar verebilmenizdir.</p>','ilk seans, terapiye başlarken','ilk-terapi-seansinda-neler-olur','blog-ilk-seans.svg','2026-09-13 19:55:29','2026-09-13 19:55:29');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2023_08_28_195528_create_settings_table',1),
(6,'2023_08_28_200307_create_social_table',1),
(7,'2023_08_28_201422_create_team_table',1),
(8,'2023_08_28_203636_create_slider_table',1),
(9,'2023_08_28_204814_create_about_table',1),
(10,'2023_08_28_205220_create_services_table',1),
(11,'2023_08_28_205414_create_services_details_table',1),
(12,'2023_08_28_205621_create_blog_posts_table',1),
(13,'2023_08_28_205909_create_blog_categories_table',1),
(14,'2023_08_28_205943_create_sss_categories_table',1),
(15,'2023_08_28_205949_create_sss_table',1),
(16,'2023_08_28_210205_create_referanslar_table',1),
(17,'2023_08_28_210321_create_contact_table',1),
(18,'2023_08_28_210728_create_prices_table',1),
(19,'2023_08_28_210949_create_timeline_table',1),
(20,'2023_09_05_200208_create_services_categories',1),
(21,'2023_09_06_182636_create_statics_table',1),
(22,'2026_09_12_074957_add_theme_and_whatsapp_fields_to_settings_table',1),
(23,'2026_09_12_075100_add_favicon_to_settings_table',1),
(24,'2026_09_12_090000_add_missing_columns_to_slider_table',1),
(25,'2026_09_12_090500_add_subtitle_to_services_details_table',1),
(26,'2026_09_13_150000_make_legacy_slider_fields_optional',1),
(27,'2026_09_13_160000_make_sss_category_nullable',1),
(28,'2026_09_13_170000_add_slider_speed_to_settings_table',1),
(29,'2026_09_13_180000_add_kvkk_text_to_settings_table',1),
(30,'2026_09_13_190000_add_sidebar_bio_to_settings_table',1),
(31,'2026_09_13_200000_widen_slider_subtitle_column',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `features` text NOT NULL,
  `price` int(11) NOT NULL,
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
-- Table structure for table `referanslar`
--

DROP TABLE IF EXISTS `referanslar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `referanslar` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `konum` varchar(255) NOT NULL,
  `yazilim` varchar(255) NOT NULL,
  `tarih` varchar(255) NOT NULL,
  `musteri` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referanslar`
--

LOCK TABLES `referanslar` WRITE;
/*!40000 ALTER TABLE `referanslar` DISABLE KEYS */;
/*!40000 ALTER TABLE `referanslar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES
(1,'Bireysel Terapi','service-bireysel.svg','bireysel-terapi','1',1,'2026-09-13 19:55:29','2026-09-13 19:55:29'),
(2,'Çift Terapisi','service-cift.svg','cift-terapisi','2',2,'2026-09-13 19:55:29','2026-09-13 19:55:29'),
(3,'Online Terapi','service-online.svg','online-terapi','3',3,'2026-09-13 19:55:29','2026-09-13 19:55:29');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services_categories`
--

DROP TABLE IF EXISTS `services_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `services_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services_categories`
--

LOCK TABLES `services_categories` WRITE;
/*!40000 ALTER TABLE `services_categories` DISABLE KEYS */;
INSERT INTO `services_categories` VALUES
(1,'Bireysel Terapi','bireysel-terapi','2026-09-13 19:55:29','2026-09-13 19:55:29'),
(2,'Çift Terapisi','cift-terapisi','2026-09-13 19:55:29','2026-09-13 19:55:29'),
(3,'Online Terapi','online-terapi','2026-09-13 19:55:29','2026-09-13 19:55:29');
/*!40000 ALTER TABLE `services_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services_details`
--

DROP TABLE IF EXISTS `services_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `services_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `position` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services_details`
--

LOCK TABLES `services_details` WRITE;
/*!40000 ALTER TABLE `services_details` DISABLE KEYS */;
INSERT INTO `services_details` VALUES
(1,'1','Bireysel Terapi','BİREYSEL TERAPİ','service-bireysel.svg','Bireysel Terapi, BİREYSEL TERAPİ','1','<p><strong>Kaygı, stres, tükenmişlik, özgüven, yas ya da yaşamın herhangi bir döneminde zorlandığınız konularda; yargılanmadan, kendi hızınızda ilerleyebileceğiniz bir alan sunuyorum.</strong></p><p>Bireysel terapi, kendinizi ve yaşadıklarınızı daha yakından tanımak, zorlandığınız alanlarda destek almak için ayırdığınız bir zamandır. Seanslarda kaygı, stres, tükenmişlik, özgüven, ilişki güçlükleri, yas ve kayıp gibi pek çok konuda birlikte çalışabiliriz.</p><p>Görüşmelerde güncel bilimsel yaklaşımlardan yararlanır, sürecin her adımında sizi bilgilendiririm. Paylaştığınız her bilgi gizlilik ilkesi çerçevesinde korunur.</p><p>Seans sıklığı ve süreci, ihtiyaçlarınıza göre birlikte belirlenir; bu sayfadaki bilgiler genel bir çerçeve sunmak amacıyla hazırlanmıştır.</p>','2026-09-13 19:55:29','2026-09-13 19:55:29'),
(2,'2','Çift Terapisi','ÇİFT TERAPİSİ','service-cift.svg','Çift Terapisi, ÇİFT TERAPİSİ','2','<p><strong>İletişim güçlükleri, güven sorunları ya da hayatın farklı dönemlerinde ilişkinizi yeniden güçlendirmek isteyen çiftler için tarafsız bir üçüncü göz.</strong></p><p>Çift terapisi, ilişkinizdeki iletişim kalıplarını fark etmenizi, birbirinizi daha iyi anlamanızı ve birlikte çözüm üretmenizi hedefleyen bir süreçtir. Görüşmelere çiftler birlikte katılır; bazı durumlarda bireysel görüşmelerle desteklenebilir.</p><p>Sürecin amacı taraflardan birini \"haklı\" çıkarmak değil, ilişkideki dinamikleri birlikte görünür kılmaktır. Her iki tarafın da kendini güvende ve duyulmuş hissettiği bir ortam önceliğimdir.</p>','2026-09-13 19:55:29','2026-09-13 19:55:29'),
(3,'3','Online Terapi','ONLİNE TERAPİ','service-online.svg','Online Terapi, ONLİNE TERAPİ','3','<p><strong>Manisa dışında ya da yoğun bir programda olsanız da, güvenli görüntülü görüşme ile aynı içerik ve gizlilikte destek alabilirsiniz.</strong></p><p>Online terapi, yüz yüze görüşmeye zaman ya da mesafe nedeniyle gelemeyen danışanlar için görüntülü görüşme üzerinden yürütülen bir terapi biçimidir. Yapılan araştırmalar, uygun koşullar sağlandığında online terapinin yüz yüze terapiyle benzer etkinlikte olabildiğini göstermektedir.</p><p>Görüşme öncesinde sizinle güvenli bağlantı bilgileri paylaşılır; sürecin gizliliği yüz yüze görüşmelerdeki ile aynı titizlikte korunur.</p>','2026-09-13 19:55:29','2026-09-13 19:55:29');
/*!40000 ALTER TABLE `services_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `site_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `accent_color` varchar(255) NOT NULL DEFAULT '#D9784B',
  `secondary_color` varchar(255) NOT NULL DEFAULT '#7FA36F',
  `heading_color` varchar(255) NOT NULL DEFAULT '#FFFFFF',
  `body_text_color` varchar(255) NOT NULL DEFAULT '#E7E3D8',
  `background_color` varchar(255) NOT NULL DEFAULT '#1B1F1C',
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `slider_speed` int(11) NOT NULL DEFAULT 6000,
  `kvkk_text` longtext DEFAULT NULL,
  `sidebar_bio` text DEFAULT NULL,
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
INSERT INTO `settings` VALUES
(1,'merve-kalayci-logo.svg','favicon.svg','Psikolog Merve Kalaycı | Manisa & Online Terapi','Manisa merkezli, bireysel terapi, çift terapisi ve online terapi hizmeti sunan Psikolog Merve Kalaycı\'nın resmi web sitesi.','psikolog, manisa psikolog, turgutlu psikolog, online terapi, bireysel terapi, çift terapisi','Merve Kalaycı','','https://www.instagram.com/psikologmervekalayci/','','','','0 (5XX) XXX XX XX','info@example.com','Manisa, Türkiye','#D9784B','#7FA36F','#FFFFFF','#E7E3D8','#1B1F1C',NULL,6000,'<p><strong>Kişisel Verilerin Korunması Hakkında Aydınlatma Metni</strong></p><p>Bu internet sitesi üzerinden (randevu ve iletişim formları aracılığıyla) tarafımla paylaştığınız ad-soyad, telefon, e-posta ve mesaj içeriğinden ibaret kişisel verileriniz; 6698 sayılı Kişisel Verilerin Korunması Kanunu (\"KVKK\") kapsamında, veri sorumlusu sıfatıyla tarafımca, yalnızca randevu talebinizin değerlendirilmesi, sizinle iletişime geçilmesi ve talep ettiğiniz bilgilendirmenin yapılması amacıyla işlenmektedir.</p><p>Kişisel verileriniz, yasal zorunluluklar dışında üçüncü kişilerle paylaşılmaz, açık rızanız veya kanunda öngörülen haller dışında başka bir amaçla kullanılmaz ve gerekli teknik/idari tedbirlerle korunur.</p><p>KVKK\'nın 11. maddesi kapsamında; kişisel verilerinizin işlenip işlenmediğini öğrenme, işlenmişse buna ilişkin bilgi talep etme, işlenme amacını ve amacına uygun kullanılıp kullanılmadığını öğrenme, yurt içinde/yurt dışında aktarıldığı üçüncü kişileri bilme, eksik/yanlış işlenmişse düzeltilmesini isteme, silinmesini/yok edilmesini isteme ve bu işlemlerin ilgili üçüncü kişilere bildirilmesini isteme haklarına sahipsiniz.</p><p>Bu haklarınızı kullanmak için sitede yer alan iletişim bilgileri üzerinden tarafıma ulaşabilirsiniz.</p><p><em>(Bu metin örnek olarak hazırlanmıştır; yayına almadan önce bir hukuk danışmanına gözden geçirtmenizi öneririz. Bu alanı admin panelinden dilediğiniz gibi düzenleyebilirsiniz.)</em></p>','Manisa\'da ve online olarak bireysel ve çift terapisi hizmeti veriyorum. Randevu almak için benimle iletişime geçebilirsiniz.','2026-09-13 19:55:29','2026-09-13 19:55:29');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `slider` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sira` int(11) NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL,
  `subtitle` text DEFAULT NULL,
  `first` varchar(255) DEFAULT '',
  `second` varchar(255) DEFAULT '',
  `threed` varchar(255) DEFAULT '',
  `btn_text` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES
(1,1,'Kendinize Zaman Ayırın','Bireysel, çift ve online terapiyle yanınızdayım. Değişim için ilk adımı birlikte atalım.','','','','Randevu Al','hero-slider.svg','2026-09-13 19:55:29','2026-09-13 19:55:29'),
(2,6,'Duygusal Bağlarınızı Güçlendirin','İlişkilerde zamanla biriken kırgınlıklar ve iletişim kopuklukları kalplerin arasına duvarlar örebilir. Ortak duygularınızı yeniden yeşertmek, birbirinizi yargılamadan dinleyebilmek ve sevginin iyileştirici gücünü hatırlamak için güvenli bir alan yaratıyoruz.','','','','Çift Terapisini İncele','1789329332_6aa6ffb47e187.jpg','2026-09-13 19:55:32','2026-09-13 19:55:32');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social`
--

DROP TABLE IF EXISTS `social`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `social` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social`
--

LOCK TABLES `social` WRITE;
/*!40000 ALTER TABLE `social` DISABLE KEYS */;
/*!40000 ALTER TABLE `social` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sss`
--

DROP TABLE IF EXISTS `sss`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sss` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sss`
--

LOCK TABLES `sss` WRITE;
/*!40000 ALTER TABLE `sss` DISABLE KEYS */;
INSERT INTO `sss` VALUES
(1,'Seanslar ne kadar sürüyor?','<p>Bireysel ve çift seansları genellikle 45-50 dakika sürer. Randevu sırasında size uygun süre ve sıklık birlikte planlanır.</p>',1,'2026-09-13 19:55:29','2026-09-13 19:55:29'),
(2,'Görüştüklerimiz gizli kalır mı?','<p>Evet. Paylaştığınız bilgiler, yasal zorunluluk durumları dışında gizlilik ilkesi çerçevesinde korunur ve üçüncü kişilerle paylaşılmaz.</p>',1,'2026-09-13 19:55:29','2026-09-13 19:55:29'),
(3,'Online terapi yüz yüze terapi kadar etkili mi?','<p>Alanyazındaki çalışmalar, uygun koşullar sağlandığında online terapinin yüz yüze terapiyle benzer etkinlikte olabildiğini göstermektedir. Sizin için en uygun yöntemi birlikte değerlendirebiliriz.</p>',1,'2026-09-13 19:55:29','2026-09-13 19:55:29'),
(4,'Randevu almak için ne yapmalıyım?','<p>Sitedeki \"Randevu Al\" sayfasından size uygun gün ve saati seçerek talep oluşturabilir, ya da doğrudan WhatsApp üzerinden yazabilirsiniz.</p>',1,'2026-09-13 19:55:29','2026-09-13 19:55:29');
/*!40000 ALTER TABLE `sss` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sss_categories`
--

DROP TABLE IF EXISTS `sss_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sss_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sss_categories`
--

LOCK TABLES `sss_categories` WRITE;
/*!40000 ALTER TABLE `sss_categories` DISABLE KEYS */;
INSERT INTO `sss_categories` VALUES
(1,'Genel Sorular','genel-sorular','2026-09-13 19:55:29','2026-09-13 19:55:29');
/*!40000 ALTER TABLE `sss_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statics`
--

DROP TABLE IF EXISTS `statics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `statics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `title3` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statics`
--

LOCK TABLES `statics` WRITE;
/*!40000 ALTER TABLE `statics` DISABLE KEYS */;
/*!40000 ALTER TABLE `statics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `team` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timeline`
--

DROP TABLE IF EXISTS `timeline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `timeline` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timeline`
--

LOCK TABLES `timeline` WRITE;
/*!40000 ALTER TABLE `timeline` DISABLE KEYS */;
/*!40000 ALTER TABLE `timeline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Merve Kalaycı',1,'merve@example.com',NULL,'$2y$10$BnT5/ApbcipenS8ZeTJk3uODxfEhwYm8qzaPt94rUoOOw9HGohJgm',NULL,'2026-09-13 19:55:29','2026-09-13 19:55:29');
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

-- Dump completed on 2026-09-13 19:55:48
