-- Yunuscan ZEYBEK web sitesi - SIFIRDAN KURULUM veritabanı
-- phpMyAdmin > İçe Aktar ile BOŞ bir veritabanına yükleyin.
-- UYARI: Canlı sitede TEKRAR ÇALIŞTIRMAYIN; tüm içeriğin üzerine yazar.
-- İlk giriş e-postası: co@canzeybek.com.tr (geçici şifre size ayrıca iletildi; girişten sonra değiştirin)

SET NAMES utf8mb4;

/*M!999999\- enable the sandbox mode */ 

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
DROP TABLE IF EXISTS `about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `about` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subtitle` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `about` WRITE;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;
INSERT INTO `about` VALUES
(1,'Merhaba, ben Yunuscan','Yunuscan ZEYBEK Kimdir?','<p><strong>Yunuscan ZEYBEK</strong>, Manisa merkezli çalışan; web yazılımı, dijital yayıncılık, medya planlama ve kurumsal iletişim alanlarında projeler üreten bir dijital medya ve web uzmanıdır.</p><p>2022\'den bu yana <strong>Cangas (CAF Grup)</strong> kurumsal web sitesinde basın, medya ve kurumsal duyuru içeriklerini hazırlayıp yayınlamaktadır. Manisa odaklı haber portalı <strong>Manşet 45</strong> ve <strong>360° Medya Planlama ve Satın Alma Ajansı</strong> çatısı altında dijital yayıncılık ve medya projelerinde yer almaktadır.</p><p>Web yazılımı tarafında Laravel tabanlı, yönetim panelli kurumsal siteler geliştirmektedir; <strong>Psikolog Merve Kalaycı</strong> için hazırladığı randevu ve danışan yönetim sistemli web sitesi bu çalışmalardan biridir.</p><p>Temel yaklaşımı; her projeyi kalıcı, yönetilebilir ve ölçülebilir kılmak, müşterisinin teknik bilgiye ihtiyaç duymadan kendi içeriğini yönetebilmesini sağlamaktır.</p>',NULL,1,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(2,'Kalıcılık','Sürdürülebilir İşler','<p>Bir web sitesi ya da yayın, teslim edildiği gün bitmez. Kurduğum her yapıyı; sonradan kolayca güncellenebilen, yönetim paneliyle desteklenen ve uzun yıllar kullanılabilecek şekilde tasarlarım.</p>',NULL,2,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(3,'Şeffaflık','Açık İletişim','<p>Sürecin her adımında ne yapıldığını, neden yapıldığını ve bir sonraki adımı açıkça paylaşırım. Beklentileri baştan netleştirmek, iyi sonuçların ilk şartıdır.</p>',NULL,3,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(4,'Yerellik','Manisa\'dan Dijitale','<p>Yerel haberciliğin, KOBİ\'lerin ve bölge markalarının dijitalde daha görünür olması için çalışıyorum. Yerel dinamikleri bilen biriyle çalışmak, projeyi hızlandırır.</p>',NULL,4,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(5,'Ölçülebilirlik','Sonuç Odaklılık','<p>Güzel görünen işlerden çok, işe yarayan işleri önemserim. Arama motoru görünürlüğü, hız ve kullanıcı deneyimi her projede ölçtüğüm temel kriterlerdir.</p>',NULL,5,'2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `about` ENABLE KEYS */;
UNLOCK TABLES;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES
(1,'Kişisel','kisisel','2026-09-25 01:10:20','2026-09-25 01:10:20'),
(2,'Web Yazılım','web-yazilim','2026-09-25 01:10:20','2026-09-25 01:10:20'),
(3,'Dijital Medya','dijital-medya','2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES
(1,1,'Yunuscan ZEYBEK Kimdir? Kısa Bir Tanışma','Yunuscan ZEYBEK kimdir, ne iş yapar, hangi projelerde yer aldı? Kendi kaleminden kısa bir tanışma yazısı.','<p>Merhaba, ben <strong>Yunuscan ZEYBEK</strong>. Manisa\'da yaşıyor ve çalışıyorum. Uzun süredir web yazılımı, dijital yayıncılık ve kurumsal iletişim alanlarında projeler üretiyorum.</p><h2>Neler yapıyorum?</h2><p>Bir yandan kurumsal web siteleri ve yönetim panelleri geliştirirken, diğer yandan markaların dijital dünyadaki sesini oluşturan içerikleri hazırlıyorum. 2022\'den bu yana Cangas (CAF Grup) kurumsal sitesinde basın ve medya içeriklerini yürütüyorum; Manisa odaklı haber portalı Manşet 45 ve 360° Medya Planlama ve Satın Alma Ajansı çatısı altında dijital yayın ve medya projelerinde yer alıyorum.</p><h2>Bu site neden var?</h2><p>\"Yunuscan ZEYBEK kimdir?\" diye merak edenlerin beni, yaptığım işleri ve düşüncelerimi tek bir yerde bulabilmesi için bu platformu hazırladım. Projelerimi, hizmetlerimi ve yazılarımı burada düzenli olarak paylaşacağım.</p><p>Bir proje, iş birliği ya da sadece tanışmak için <a href=\"/iletisim\">iletişim sayfasından</a> bana ulaşabilirsiniz.</p>','Yunuscan Zeybek, kimdir, biyografi, Manisa','yunuscan-zeybek-kimdir-kisa-bir-tanisma',NULL,'2026-09-15 01:10:20','2026-09-15 01:10:20'),
(2,2,'Kurumsal Web Sitelerinde Yönetim Paneli Neden Önemli?','Sitenizi her güncelleme için bir yazılımcıya bağımlı olmadan yönetebilmenin işletmenize kazandırdıkları.','<p>Bir web sitesinin değeri, güncel kaldığı sürece devam eder. Ancak pek çok işletme, basit bir metin ya da görsel değişikliği için bile yazılımcısına ulaşmak zorunda kalıyor.</p><h2>Yönetim paneli ne sağlar?</h2><ul><li><strong>Bağımsızlık:</strong> Metin, görsel, blog ve proje içeriklerini kendiniz güncellersiniz.</li><li><strong>Hız:</strong> Kampanya ya da duyuruları dakikalar içinde yayına alırsınız.</li><li><strong>Maliyet:</strong> Küçük değişiklikler için ek hizmet bedeli ödemezsiniz.</li><li><strong>SEO:</strong> Düzenli içerik eklemek, arama motorlarında görünürlüğü artırır.</li></ul><p>Geliştirdiğim tüm sitelerde, ihtiyaca göre şekillendirilmiş bir yönetim paneli standart olarak yer alıyor.</p>','yönetim paneli, kurumsal web sitesi, Laravel','kurumsal-web-sitelerinde-yonetim-paneli-neden-onemli',NULL,'2026-09-19 01:10:20','2026-09-19 01:10:20'),
(3,3,'Yerel Haber Yayıncılığında Dijital Dönüşüm','Yerel haber sitelerinin dijitalde okura daha hızlı ve güvenilir biçimde ulaşması için dikkat edilmesi gerekenler.','<p>Yerel haberciliğin gücü, okuruna yakın olmasından gelir. Dijital dönüşüm ise bu yakınlığı hıza ve erişilebilirliğe çevirmenin yoludur.</p><h2>Öne çıkan başlıklar</h2><ul><li><strong>Hızlı yayın altyapısı:</strong> Haberin sahadan sisteme dakikalar içinde girilebilmesi.</li><li><strong>Arama motoru uyumu:</strong> Doğru başlık, açıklama ve yapılandırılmış veri ile haberin bulunabilir olması.</li><li><strong>Mobil deneyim:</strong> Okurların büyük çoğunluğunun haberi telefondan okuduğunu unutmamak.</li><li><strong>Sosyal medya dağıtımı:</strong> Haberin doğru saatte doğru kanalda paylaşılması.</li></ul><p>Manisa odaklı yayın projelerinde bu başlıkları birlikte ele alarak çalışıyorum.</p>','yerel medya, haber portalı, dijital yayıncılık','yerel-haber-yayinciliginda-dijital-donusum',NULL,'2026-09-23 01:10:20','2026-09-23 01:10:20');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES
(1,'Cangas',NULL,NULL,1,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(2,'CAF Grup',NULL,NULL,2,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(3,'Manşet 45',NULL,NULL,3,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(4,'360° Medya',NULL,NULL,4,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(5,'Psikolog Merve Kalaycı',NULL,NULL,5,'2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;
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

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `footer_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `footer_links` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `footer_links` WRITE;
/*!40000 ALTER TABLE `footer_links` DISABLE KEYS */;
INSERT INTO `footer_links` VALUES
(1,'SSS','/sss',1,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(2,'KVKK','/kvkk',2,'2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `footer_links` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2026_09_24_000000_create_site_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
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

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
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

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `process_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `process_steps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `process_steps` WRITE;
/*!40000 ALTER TABLE `process_steps` DISABLE KEYS */;
INSERT INTO `process_steps` VALUES
(1,'Keşif & Analiz','İhtiyacı, hedef kitleyi ve başarı ölçütlerini birlikte netleştiriyoruz; yol haritası ve kapsam belirleniyor.','1-3 GÜN','icon-search-solid',1,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(2,'Tasarım & Planlama','Sayfa yapısı, içerik planı ve görsel dil hazırlanıyor; onayınızla bir sonraki adıma geçiliyor.','1 HAFTA','icon-bezier-curve-solid',2,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(3,'Geliştirme & Yayın','Yazılım, içerik girişi, SEO ayarları ve testler tamamlanıp proje yayına alınıyor.','1-3 HAFTA','icon-code-solid',3,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(4,'Destek & Büyüme','Yayın sonrası ölçümleme, iyileştirme ve düzenli içerik desteğiyle proje büyümeye devam ediyor.','SÜREKLİ','icon-chart-line-solid',4,'2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `process_steps` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `deliverables` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `image_3` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projects_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES
(1,'Psikolog Merve Kalaycı Web Sitesi & Randevu Sistemi','psikolog-merve-kalayci-web-sitesi-randevu-sistemi','Web Yazılım','Psikolog Merve Kalaycı','2026',NULL,'Randevu takvimi, danışan yönetimi ve rol bazlı yönetim paneli içeren, Laravel tabanlı kurumsal web sitesi.','Web tasarım, Laravel, Randevu / CRM, Yönetim paneli, SEO','<p>Manisa\'da ve online olarak hizmet veren Psikolog Merve Kalaycı için, danışanların site üzerinden uygun gün ve saati görerek randevu talep edebildiği kurumsal bir web sitesi geliştirildi.</p><h3>Öne çıkan özellikler</h3><ul><li>Gerçek zamanlı müsaitlik takvimi ve randevu talebi</li><li>Danışan kartları, seans notları ve PDF raporu</li><li>E-posta / SMS bildirim altyapısı ve hatırlatmalar</li><li>Yönetici ve psikolog rolleriyle ayrılmış yönetim paneli</li><li>Blog, SSS ve hizmet sayfalarının panelden yönetimi</li></ul>',NULL,NULL,NULL,1,1,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(2,'Manşet 45 Haber Portalı','manset-45-haber-portali','Dijital Yayıncılık','Manşet 45',NULL,NULL,'Manisa odaklı güncel haber portalı için dijital yayın ve web altyapı çalışmaları.','Haber portalı, Yayın altyapısı, Yerel medya','<p>Manşet 45, Manisa ve çevresinden son dakika gelişmeleri, teknoloji, kültür ve yaşam haberlerini okuyucularıyla buluşturan yerel bir haber portalıdır. Portalın dijital yayın süreçlerinde ve web altyapısında görev alındı.</p>',NULL,NULL,NULL,1,2,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(3,'Cangas Kurumsal İçerik & Basın-Medya','cangas-kurumsal-icerik-basin-medya','Kurumsal İletişim','Cangas (CAF Grup)','2022 – Günümüz','https://cloud.cangas.com.tr/author/caf/','Otogaz dönüşüm sistemleri üreticisi Cangas\'ın kurumsal sitesinde haber, duyuru ve basın içerikleri.','Basın bülteni, Kurumsal blog, İçerik yönetimi','<p>CAF Grup bünyesinde LPG dönüşüm kitleri ve tankları üreten Cangas\'ın kurumsal web sitesinde; fuar katılımları, sektör haberleri, kurumsal ziyaretler ve sosyal sorumluluk çalışmalarına dair içerikler 2022\'den bu yana düzenli olarak hazırlanıp yayınlanmaktadır.</p>',NULL,NULL,NULL,1,3,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(4,'360° Medya Planlama ve Satın Alma Ajansı','360-medya-planlama-ve-satin-alma-ajansi','Medya Planlama','360° Medya',NULL,NULL,'Markalar için medya planlama, satın alma ve dijital yayın projeleri.','Medya planlama, Dijital yayın, Web projeleri','<p>360° Medya Planlama ve Satın Alma Ajansı çatısı altında markaların hedef kitlelerine doğru kanallardan ulaşması için medya planları hazırlanmakta; dijital yayın ve web projeleri geliştirilmektedir.</p>',NULL,NULL,NULL,1,4,'2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES
(1,'Web Tasarım & Yazılım','web-tasarim-yazilim',1,'Laravel tabanlı, yönetim panelli, hızlı ve SEO uyumlu kurumsal web siteleri ile özel yazılım çözümleri.','<p>İhtiyacınıza göre sıfırdan tasarlanan ya da hazır bir tasarım üzerine kurulan, <strong>kendi yönetim paneliyle</strong> gelen web siteleri geliştiriyorum. Siteniz teslim edildikten sonra metin, görsel, blog yazısı ve proje gibi tüm içerikleri teknik bilgiye ihtiyaç duymadan güncelleyebilirsiniz.</p><h3>Neler sunuyorum?</h3><ul><li>Kurumsal ve kişisel web siteleri</li><li>Randevu, rezervasyon ve CRM gibi iş süreçlerine özel modüller</li><li>Arama motoru uyumlu (SEO) altyapı, site haritası ve yapılandırılmış veri</li><li>Mobil uyumlu, hızlı açılan sayfalar</li><li>Yayın sonrası bakım ve destek</li></ul>','Laravel, Yönetim Paneli, SEO Uyumlu, Mobil Uyumlu',NULL,1,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(2,'Dijital Yayıncılık & Haber Portalı','dijital-yayincilik-haber-portali',1,'Yerel ve sektörel haber siteleri için yayın altyapısı, içerik akışı ve dijital büyüme.','<p>Haber portalları için hızlı içerik girişi yapılabilen, kategori ve manşet yönetimi olan yayın altyapıları kuruyor; yayın süreçlerinin düzenli işlemesine destek oluyorum.</p><p>Manisa odaklı <strong>Manşet 45</strong> gibi yerel yayın projelerinde edindiğim deneyimle; haber akışı, arama motoru görünürlüğü ve sosyal medya dağıtımını birlikte planlıyorum.</p>','Haber Portalı, İçerik Akışı, Yerel Medya',NULL,2,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(3,'Kurumsal İletişim & İçerik Yönetimi','kurumsal-iletisim-icerik-yonetimi',1,'Kurumsal web siteleri için haber, duyuru, basın bülteni ve blog içeriklerinin hazırlanması ve yayınlanması.','<p>Markaların kurumsal sitelerinde düzenli ve tutarlı bir sesle görünmesi için basın bülteni, haber, etkinlik duyurusu ve blog içerikleri hazırlıyor, yayın takvimini yönetiyorum.</p><p>2022\'den bu yana <strong>Cangas (CAF Grup)</strong> kurumsal sitesinde basın ve medya içeriklerini yürütüyorum.</p>','Basın Bülteni, Kurumsal Blog, Duyuru',NULL,3,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(4,'Medya Planlama & Satın Alma','medya-planlama-satin-alma',1,'Bütçeye uygun, hedef kitleye doğru kanallardan ulaşan dijital ve geleneksel medya planları.','<p>Kampanyanızın hedefine ve bütçesine göre hangi kanalda, ne zaman ve hangi mesajla yer alacağınızı planlıyor; yayın sonrasında sonuçları raporluyorum.</p><p>Bu alandaki çalışmalarımı <strong>360° Medya Planlama ve Satın Alma Ajansı</strong> çatısı altında yürütüyorum.</p>','Medya Planı, Reklam, Hedefleme',NULL,4,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(5,'Sosyal Medya Yönetimi','sosyal-medya-yonetimi',1,'Marka sesine uygun paylaşım planı, içerik üretimi ve topluluk yönetimi.','<p>Sosyal medya hesaplarınız için aylık paylaşım planı hazırlıyor, görsel ve metin içeriklerini markanızın diliyle üretiyor, etkileşimleri takip ediyorum.</p>','Instagram, Facebook, İçerik Planı',NULL,5,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(6,'SEO & Dijital Görünürlük','seo-dijital-gorunurluk',1,'Google\'da doğru aramalarda üst sıralarda görünmek için teknik SEO, içerik ve profil optimizasyonu.','<p>Sitenizin teknik altyapısını (hız, site haritası, yapılandırılmış veri) arama motorlarına uygun hale getiriyor; hedef aramalar için içerik stratejisi oluşturuyorum.</p><p>Kişiler için de \"<em>Ad Soyad kimdir?</em>\" gibi aramalarda doğru bilgilerin öne çıkması amacıyla kişisel marka ve profil optimizasyonu yapıyorum.</p>','Teknik SEO, Google Search Console, Kişisel Marka',NULL,6,'2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `services_categories` WRITE;
/*!40000 ALTER TABLE `services_categories` DISABLE KEYS */;
INSERT INTO `services_categories` VALUES
(1,'Dijital Hizmetler','dijital-hizmetler','2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `services_categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `site_title` varchar(255) NOT NULL DEFAULT 'Yunuscan ZEYBEK',
  `description` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `same_as` text DEFAULT NULL,
  `google_verification` varchar(255) DEFAULT NULL,
  `analytics_id` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `logo_footer` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `location_text` varchar(255) DEFAULT NULL,
  `availability_text` varchar(255) DEFAULT NULL,
  `map_embed` text DEFAULT NULL,
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `accent_color` varchar(255) NOT NULL DEFAULT '#FD3A25',
  `quote_text` text DEFAULT NULL,
  `quote_author` varchar(255) DEFAULT NULL,
  `quote_role` varchar(255) DEFAULT NULL,
  `stats` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`stats`)),
  `footer_title` varchar(255) DEFAULT NULL,
  `footer_copyright_text` varchar(500) DEFAULT NULL,
  `footer_menu_title` varchar(255) DEFAULT NULL,
  `kvkk_text` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES
(1,'Yunuscan ZEYBEK Kimdir? | Web, Dijital Medya ve Kurumsal İletişim','Yunuscan ZEYBEK kimdir? Manisa merkezli; web yazılımı, dijital yayıncılık, medya planlama ve kurumsal iletişim alanlarında çalışan Yunuscan ZEYBEK\'in resmi web sitesi.','Yunuscan Zeybek, Yunuscan ZEYBEK kimdir, Can Zeybek, Manisa web tasarım, Laravel, dijital medya, medya planlama, kurumsal iletişim, Manşet 45','Yunuscan ZEYBEK','Web Yazılım & Dijital Medya Uzmanı','https://cloud.cangas.com.tr/author/caf/',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'co@canzeybek.com.tr',NULL,'Manisa, Türkiye','Yeni projeler ve iş birlikleri için müsaitim',NULL,NULL,'https://www.instagram.com/yunuscanzeybek/','https://www.facebook.com/gameoverrta/',NULL,NULL,NULL,NULL,'#FD3A25','İyi bir dijital iş, arkasındaki emeği göstermeden ziyaretçisine kendini kolayca anlatandır.','Yunuscan ZEYBEK','Web & Dijital Medya','[{\"label\":\"Tamamlanan Proje\",\"value\":\"4\",\"suffix\":\"+\"},{\"label\":\"Uzmanl\\u0131k Alan\\u0131\",\"value\":\"6\",\"suffix\":\"\"},{\"label\":\"Y\\u0131ll\\u0131k Kurumsal \\u0130\\u00e7erik Deneyimi\",\"value\":\"4\",\"suffix\":\"+\"}]','Sosyal medyada bağlantıda kalalım','Yunuscan ZEYBEK - Tüm Hakları Saklıdır',NULL,'<p><strong>Kişisel Verilerin Korunması Hakkında Aydınlatma Metni</strong></p><p>Bu internet sitesindeki iletişim formu aracılığıyla paylaştığınız ad-soyad, e-posta, telefon ve mesaj içeriğinden ibaret kişisel verileriniz; 6698 sayılı Kişisel Verilerin Korunması Kanunu (\"KVKK\") kapsamında, veri sorumlusu sıfatıyla Yunuscan ZEYBEK tarafından yalnızca talebinizin değerlendirilmesi ve sizinle iletişime geçilmesi amacıyla işlenmektedir.</p><p>Kişisel verileriniz, yasal zorunluluklar dışında üçüncü kişilerle paylaşılmaz ve gerekli teknik/idari tedbirlerle korunur. KVKK\'nın 11. maddesi kapsamındaki haklarınızı kullanmak için sitedeki iletişim bilgileri üzerinden başvurabilirsiniz.</p><p><em>(Bu metin örnek olarak hazırlanmıştır; yayına almadan önce bir hukuk danışmanına gözden geçirtmeniz önerilir.)</em></p>','2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `slider` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sira` int(11) NOT NULL DEFAULT 1,
  `badge` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `btn_text` varchar(255) DEFAULT NULL,
  `btn_url` varchar(255) DEFAULT NULL,
  `btn2_text` varchar(255) DEFAULT NULL,
  `btn2_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES
(1,1,'Web • Dijital Medya • Kurumsal İletişim','Yunuscan ZEYBEK','Dijitalde Değer Üretir','Manisa merkezli olarak web yazılımı, dijital yayıncılık, medya planlama ve kurumsal içerik alanlarında; markaların ve kişilerin dijital dünyada güçlü, güvenilir ve sürdürülebilir biçimde görünmesi için çalışıyorum.','Projelerimi İncele','/projeler','Beni Tanıyın','/yunuscan-zeybek-kimdir',NULL,'2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sss`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sss` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sss` WRITE;
/*!40000 ALTER TABLE `sss` DISABLE KEYS */;
INSERT INTO `sss` VALUES
(1,'Yunuscan ZEYBEK kimdir?','<p>Yunuscan ZEYBEK, Manisa merkezli çalışan; web yazılımı, dijital yayıncılık, medya planlama ve kurumsal iletişim alanlarında projeler üreten bir dijital medya ve web uzmanıdır. Detaylar için <a href=\"/yunuscan-zeybek-kimdir\">Hakkımda</a> sayfasına göz atabilirsiniz.</p>',1,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(2,'Hangi hizmetleri veriyorsunuz?','<p>Web tasarım ve yazılım, dijital yayıncılık, kurumsal iletişim ve içerik yönetimi, medya planlama, sosyal medya yönetimi ile SEO ve dijital görünürlük alanlarında hizmet veriyorum.</p>',1,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(3,'Sadece Manisa\'daki projelerle mi çalışıyorsunuz?','<p>Hayır. Manisa merkezliyim ancak web ve dijital medya projelerinin büyük kısmını uzaktan yürütebildiğim için Türkiye\'nin her yerinden projelerle çalışıyorum.</p>',1,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(4,'Bir web sitesi projesi ne kadar sürer?','<p>Kapsama göre değişmekle birlikte, yönetim panelli standart bir kurumsal site genellikle 2-4 hafta içinde yayına alınır. İlk görüşmede size özel bir zaman planı paylaşıyorum.</p>',1,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(5,'Size nasıl ulaşabilirim?','<p>İletişim sayfasındaki formu doldurabilir ya da e-posta ve sosyal medya hesaplarım üzerinden bana yazabilirsiniz.</p>',1,'2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `sss` ENABLE KEYS */;
UNLOCK TABLES;
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

LOCK TABLES `sss_categories` WRITE;
/*!40000 ALTER TABLE `sss_categories` DISABLE KEYS */;
INSERT INTO `sss_categories` VALUES
(1,'Genel','genel','2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `sss_categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `timeline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `timeline` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `timeline` WRITE;
/*!40000 ALTER TABLE `timeline` DISABLE KEYS */;
INSERT INTO `timeline` VALUES
(1,'Kurumsal İçerik ve Basın-Medya Yönetimi','Cangas (CAF Grup)','Otogaz dönüşüm sistemleri üreticisi Cangas\'ın kurumsal web sitesinde haber, duyuru ve basın içeriklerinin hazırlanması ve yayınlanması.','2022 – Günümüz',NULL,1,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(2,'Dijital Yayıncılık','Manşet 45','Manisa odaklı haber portalı Manşet 45\'in dijital yayın ve web altyapı süreçleri.','Günümüz',NULL,2,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(3,'Medya Planlama ve Satın Alma','360° Medya Planlama ve Satın Alma Ajansı','Markalar için medya planlama, dijital yayın ve iletişim projeleri.','Günümüz',NULL,3,'2026-09-25 01:10:20','2026-09-25 01:10:20'),
(4,'Web Yazılım ve CRM Projesi','Psikolog Merve Kalaycı','Randevu takvimi, danışan yönetimi ve yönetim paneli içeren Laravel tabanlı kurumsal web sitesi.','2026',NULL,4,'2026-09-25 01:10:20','2026-09-25 01:10:20');
/*!40000 ALTER TABLE `timeline` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'yonetici',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Yunuscan ZEYBEK',NULL,'co@canzeybek.com.tr','yonetici',NULL,'$2y$10$TaFN3UIf.umckB/tO3GXh.v0Hw9OLBQsF8LHXFRWW9ga8ECGPiqma',NULL,'2026-09-25 01:10:20','2026-09-25 01:10:20');
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

