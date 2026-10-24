-- MySQL dump 10.13  Distrib 8.4.7, for Win64 (x86_64)
--
-- Host: localhost    Database: glowwell
-- ------------------------------------------------------
-- Server version	8.4.7

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('superadmin','editor') COLLATE utf8mb4_unicode_ci DEFAULT 'editor',
  `login_attempts` int DEFAULT '0',
  `lockout_until` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','admin@glowwell.in','$2y$12$gUJcmYflFtSAXVt3lfNKH.XuIXuNkSuDdeN/7w5FjUCbMYUZXyeaG','superadmin',1,NULL,'2026-10-24 19:50:35','2026-08-28 17:19:18');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attorney_practice`
--

DROP TABLE IF EXISTS `attorney_practice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attorney_practice` (
  `attorney_id` int NOT NULL,
  `practice_id` int NOT NULL,
  PRIMARY KEY (`attorney_id`,`practice_id`),
  KEY `practice_id` (`practice_id`),
  CONSTRAINT `attorney_practice_ibfk_1` FOREIGN KEY (`attorney_id`) REFERENCES `attorneys` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attorney_practice_ibfk_2` FOREIGN KEY (`practice_id`) REFERENCES `practices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attorney_practice`
--

LOCK TABLES `attorney_practice` WRITE;
/*!40000 ALTER TABLE `attorney_practice` DISABLE KEYS */;
INSERT INTO `attorney_practice` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `attorney_practice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attorneys`
--

DROP TABLE IF EXISTS `attorneys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attorneys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` longtext COLLATE utf8mb4_unicode_ci,
  `awards` longtext COLLATE utf8mb4_unicode_ci,
  `landmark_cases` longtext COLLATE utf8mb4_unicode_ci,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attorneys`
--

LOCK TABLES `attorneys` WRITE;
/*!40000 ALTER TABLE `attorneys` DISABLE KEYS */;
INSERT INTO `attorneys` VALUES (1,'pravin-anand','Pravin Anand','Senior IP Counsel','','<p>Pravin is a veteran IP attorney with over 20 years of experience litigating milestone patent disputes in high-technology fields.</p>','<p>• IP Litigator of the Year (2025)<br>• Recognized in Legal 500 for IP Prosecution</p>','<p>• <i>TechCorp v. SystemSystems</i>: Secured $150M infringement verdict.<br>• <i>BioVax Inc.</i>: Defended key vaccine patents against global challenges.</p>','pravin@glowwell.com','+1 (555) 123-9876','Pravin Anand - Senior IP Counsel | Glowwell','Attorney profile of Pravin Anand, specializing in Patent Litigation and IP.',1,'published','2026-08-28 17:19:18','2026-08-28 17:19:18'),(2,'sarah-jenkins','Sarah Jenkins','Corporate Partner','','<p>Sarah advises Fortune 500 enterprises on complex cross-border merges, corporate governance, and venture capital financing.</p>','<p>• Top 40 Under 40 Corporate Advisor (2024)</p>','<p>• Advised <i>Apex Platforms</i> on its $2.1B acquisition of <i>NetSphere</i>.</p>','sarah.j@glowwell.com','+1 (555) 123-9877','Sarah Jenkins - Corporate Partner | Glowwell','Attorney profile of Sarah Jenkins, corporate merger specialist.',2,'published','2026-08-28 17:19:18','2026-08-28 17:19:18');
/*!40000 ALTER TABLE `attorneys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awards`
--

DROP TABLE IF EXISTS `awards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int DEFAULT '0',
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awards`
--

LOCK TABLES `awards` WRITE;
/*!40000 ALTER TABLE `awards` DISABLE KEYS */;
INSERT INTO `awards` VALUES (1,'Top Corporate Law Firm','2026','','Recognized by the Law Alliance for outstanding deal volume and execution quality.',1,'published','2026-08-28 17:19:18'),(2,'IP Firm of the Decade','2025','','Awarded by IP World Congress for continuous excellence in patent litigation and defense.',2,'published','2026-08-28 17:19:18');
/*!40000 ALTER TABLE `awards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `careers`
--

DROP TABLE IF EXISTS `careers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `careers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `posted_date` date DEFAULT NULL,
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  `sort_order` int DEFAULT '0',
  `department` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'Legal & IPR',
  `experience` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '2-5 Years',
  `requirements` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `careers`
--

LOCK TABLES `careers` WRITE;
/*!40000 ALTER TABLE `careers` DISABLE KEYS */;
INSERT INTO `careers` VALUES (1,'Senior Trademark & Patent Attorney','Full Time','Patna Office / Hybrid','Lead trademark search, drafting patent specifications, responding to examination reports, and representing clients in registry hearings.','2026-10-20','published',1,'Intellectual Property Rights','4-8 Years','Degree in Law (LL.B.) and Registered Patent/Trademark Agent qualification. Proven track record in IP prosecution.'),(2,'Patent Drafting Associate (Tech / Bio)','Full Time','Patna Head Office','Drafting provisional and non-provisional patent specifications, prior art novelty searches, claim structuring, and patent landscaping.','2026-10-20','published',2,'Patent Prosecution','2-4 Years','B.Tech / M.Sc / M.Pharm / Ph.D. with deep patent search and drafting expertise.'),(3,'Corporate Legal Executive','Full Time','Patna Head Office','Handling company incorporation, ROC annual filings, MSME documentation, and client liaison for corporate licensing.','2026-10-20','published',3,'Corporate Services','1-3 Years','B.Com / LL.B / CS Executive with MCA V3 portal proficiency.');
/*!40000 ALTER TABLE `careers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_interest` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('new','contacted','in_progress','closed') COLLATE utf8mb4_unicode_ci DEFAULT 'new',
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `downloads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'IPR Forms',
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '#',
  `file_size` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '1.2 MB',
  `file_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'PDF',
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int DEFAULT '0',
  `downloads_count` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downloads`
--

LOCK TABLES `downloads` WRITE;
/*!40000 ALTER TABLE `downloads` DISABLE KEYS */;
INSERT INTO `downloads` VALUES (1,'Official Trademark Application TM-A Guidance Note','Trademark','#','1.4 MB','PDF','Official guide covering classification, user affidavits, and document checklists for TM-A filing.',1,342,'2026-10-20 17:14:49'),(2,'Patent Filing Checklist & Provisional Specification Guide','Patent','#','2.1 MB','PDF','Step-by-step checklist for inventors covering novel technical disclosure and patent drawings.',2,289,'2026-10-20 17:14:49'),(3,'Copyright Registration Information & NOC Format','Copyright','#','950 KB','PDF','Standard checklist for artistic, literary, and software copyright registration including TM NOC form.',3,415,'2026-10-20 17:14:49'),(4,'Industrial Design Application Form 1 Reference','Design','#','1.1 MB','PDF','Guidelines on representation sheets, views (perspective, top, side), and priority documents.',4,180,'2026-10-20 17:14:49'),(5,'Nice Classification Guide (Classes 1–45 Goods & Services)','General','#','3.8 MB','PDF','Comprehensive reference index of international goods and services classification.',5,890,'2026-10-20 17:14:49');
/*!40000 ALTER TABLE `downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `practice_slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int DEFAULT '0',
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'trademark','What is a trademark?','Trademarks are words, names, symbols, brand names, devices, headings, labels, tickets, signatures, letters, numerals, or any combination thereof, used or proposed to be used by manufacturers or service providers to identify and distinguish their goods and services from those of others. A person who uses a registered trademark acquires statutory exclusive rights.',1,'published','2026-10-20 17:14:48'),(2,'trademark','What are the benefits of trademark registration?','Trademark registration protects the goodwill of a business, grants exclusive nationwide rights, and provides prima facie evidence of ownership in legal disputes. It deters counterfeiters, allows you to use the registered ® symbol, and serves as a priority basis for filing international trademark applications under the Madrid Protocol.',2,'published','2026-10-20 17:14:48'),(3,'trademark','Who can file an application for trademark registration?','Any person claiming to be the proprietor of a trademark—whether an individual, partnership firm, LLP, private limited company, society, or trust—can file an application. The applicant can be either currently using the mark or propose to use it in good faith in commerce.',3,'published','2026-10-20 17:14:48'),(4,'trademark','What marks can and cannot be registered?','Distinctive marks, invented words, unique logos, and coined terms can be registered. Marks that are merely descriptive of the product, generic terms, deceptive marks, marks scandalous or offensive to religious sentiments, or marks identical/confusingly similar to pre-existing registered marks cannot be registered.',4,'published','2026-10-20 17:14:48'),(5,'trademark','What is a trademark search and why is it essential?','A trademark search scans the official records of the Trademark Registry to uncover identical or phonetically similar marks. Conducting an official search before filing saves immense time and money, and prevents expensive opposition, objections, and infringement lawsuits.',5,'published','2026-10-20 17:14:48'),(6,'trademark','How long does a trademark registration remain valid?','A trademark registration in India is valid for 10 (ten) years from the date of filing. It can be renewed indefinitely every 10 years upon payment of the statutory renewal fee.',6,'published','2026-10-20 17:14:48'),(7,'trademark','What is the difference between \"TM\" and \"®\"?','You can use the \"TM\" symbol immediately once you have filed the application and obtained an official acknowledgement / application number. The \"®\" symbol can ONLY be used legally after the Trademark Registry issues the official Certificate of Registration.',7,'published','2026-10-20 17:14:48'),(8,'trademark','What is the difference between Infringement and Passing Off?','Infringement is a statutory remedy available for registered trademarks under the Trade Marks Act 1999—proof of similarity alone is sufficient. Passing off is a common-law remedy for unregistered marks, which requires proving established goodwill, misrepresentation, and likelihood of financial injury.',8,'published','2026-10-20 17:14:48'),(9,'trademark','Can a trademark be transferred or assigned?','Yes, a registered trademark or an application pending registration is fully assignable with or without the goodwill of the business, through an official deed of assignment.',9,'published','2026-10-20 17:14:48'),(10,'copyright','What is a copyright under Indian Law?','Copyright is a bundle of exclusive legal rights granted under the Indian Copyright Act 1957 to creators of original literary, dramatic, musical, artistic works, sound recordings, and cinematograph films, as well as computer software programs and databases.',10,'published','2026-10-20 17:14:48'),(11,'copyright','What rights does copyright protection grant?','Copyright confers the exclusive right to reproduce the work, publish copies, perform or communicate the work to the public, produce translations, create adaptations, and sell or license copies.',11,'published','2026-10-20 17:14:48'),(12,'copyright','Is copyright registration mandatory to claim protection?','Copyright protection is automatic upon the creation of the work. However, official registration with the Copyright Office of India provides prima facie admissible evidence in court, which is decisive in civil and criminal litigation against infringers.',12,'published','2026-10-20 17:14:48'),(13,'copyright','What documents are required for filing copyright in India?','Full name, nationality, and address of the applicant and author; title of the work; date and country of first publication; 6 copies of the work; Power of Attorney; and a No Objection Certificate (NOC) from the Trademark Office if registering artistic labels or logos.',13,'published','2026-10-20 17:14:48'),(14,'copyright','How long does copyright protection last?','For original literary, dramatic, musical, and artistic works, copyright lasts for the lifetime of the author plus 60 years from the beginning of the calendar year following the author\'s death. For cinematograph films, sound recordings, and posthumous works, it lasts for 60 years from publication.',14,'published','2026-10-20 17:14:48'),(15,'patent','What is a patent and what rights does it confer?','A patent is a statutory monopoly granted by the Government for an invention that is novel, involves an inventive step (non-obvious), and has industrial applicability. It confers the exclusive right to exclude others from making, using, offering for sale, selling, or importing the invention in India for 20 years.',15,'published','2026-10-20 17:14:48'),(16,'patent','What is the difference between a provisional and complete specification?','A provisional specification establishes an immediate priority date when the invention is in development. A complete specification detailing full technical disclosure and claims must then be filed within 12 months.',16,'published','2026-10-20 17:14:48'),(17,'patent','Are patent rights territorial?','Yes, patent rights granted in India are valid only within the territory of India. To secure protection in other countries, an applicant must file corresponding patent applications abroad or through the Patent Cooperation Treaty (PCT) within 12 months of the Indian filing date.',17,'published','2026-10-20 17:14:48'),(18,'designs','What is an Industrial Design under the Designs Act 2000?','Design refers to the features of shape, configuration, pattern, ornament, or composition of lines or colors applied to any article in two-dimensional or three-dimensional form by an industrial process, which in the finished article appeal to and are judged solely by the eye.',18,'published','2026-10-20 17:14:48'),(19,'designs','What is the duration of design registration in India?','Initial registration lasts for 10 years from the registration date. It can be extended for an additional period of 5 years upon filing an application for renewal before expiry, giving total protection of 15 years.',19,'published','2026-10-20 17:14:48'),(20,'designs','Can a trademark or artistic work be registered as a design?','No. By statutory definition, design excludes trade marks, property marks, and artistic works covered under the Copyright Act, as well as mere functional mechanical devices.',20,'published','2026-10-20 17:14:48'),(21,'barcode-registration','What is GS1 barcode registration and why is it necessary?','GS1 is the official international standards organization that administers barcodes globally. Having an authorized GS1 barcode ensures that each product SKU has a globally unique identification number (such as EAN-13 or UPC), which is mandatory for selling in retail supermarkets (Reliance, DMart, etc.), online marketplaces (Amazon, Flipkart), and for international exports.',1,'published','2026-10-24 13:49:22'),(22,'barcode-registration','What documents are required to obtain a Barcode in India?','The essential documents include: (1) Certificate of Company/LLP Incorporation or GST Registration Certificate, (2) PAN card of the business entity, (3) Audited annual turnover proof/balance sheet, (4) Request letter on company letterhead, and (5) Product list with SKU classification. GCPL handles the entire document preparation and submission.',2,'published','2026-10-24 13:49:22'),(23,'barcode-registration','How long does it take to allocate barcodes for my products?','Once complete documentation and the requisite GS1 subscription fees are submitted, barcode number series allotment is generally completed within 3 to 7 working days. GCPL also provides guidance on barcode dimensioning, color contrast, and packaging placement.',3,'published','2026-10-24 13:49:22'),(24,'social-security','When is EPF and ESIC registration mandatory for an employer?','EPF (Employees\' Provident Fund) registration is mandatory for any commercial establishment employing 20 or more persons (voluntary registration is permitted for smaller teams). ESIC (Employees\' State Insurance) registration is mandatory for non-seasonal factories and establishments employing 10 or more workers (in most states) whose monthly wages are up to Rs. 21,000.',1,'published','2026-10-24 13:49:22'),(25,'social-security','What are the monthly compliance obligations under EPF and ESIC?','Employers must deposit monthly contributions (both employee and employer shares) on or before the 15th of each succeeding month. This requires generating the monthly Electronic Challan Return (ECR) on the Unified Shram Suvidha/EPFO/ESIC portals. GCPL manages wage calculation, ECR challan generation, and timely filing.',2,'published','2026-10-24 13:49:22'),(26,'social-security','What are the consequences of non-compliance with EPF and ESIC?','Default or delay in EPF/ESIC remittance attracts statutory interest under Section 7Q and penal damages under Section 14B of the EPF Act, along with equivalent penalties under the ESI Act. Additionally, Directors/Partners can face personal liability and statutory prosecution. Engaging GCPL ensures continuous, error-free compliance.',3,'published','2026-10-24 13:49:22'),(27,'iso-certification','Does Glow Well Consultants issue the ISO certificate directly?','No. Under international accreditation norms (IAF / NABCB), ISO certificates are legally issued by independent, accredited Certification Bodies (CBs). Glow Well Consultants Pvt Ltd (GCPL) acts as your expert consultancy partner—we conduct gap assessments, draft Quality Manuals/SOPs, train personnel, perform internal audits, and guide your organization to successfully pass the official certification audit.',1,'published','2026-10-24 13:49:22'),(28,'iso-certification','What is the difference between ISO 9001 and ISO 14001?','ISO 9001 focuses on Quality Management Systems (QMS), customer satisfaction, and process consistency across product or service delivery. ISO 14001 focuses on Environmental Management Systems (EMS), helping organizations reduce waste, comply with environmental statutes, and improve ecological sustainability.',2,'published','2026-10-24 13:49:22');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `industries`
--

DROP TABLE IF EXISTS `industries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `industries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hero_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT '0',
  `sort_order` int DEFAULT '0',
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `industries`
--

LOCK TABLES `industries` WRITE;
/*!40000 ALTER TABLE `industries` DISABLE KEYS */;
INSERT INTO `industries` VALUES (1,'artificial-intelligence','Artificial Intelligence & Robotics','','Navigating regulatory compliance, copyright fair use, and safety guidelines for advanced systems.','<p>Glowwell represents generative AI platforms, robotics builders, and model creators. We assist in licensing negotiations, data acquisition governance, and compliance with emerging AI regulations.</p>','AI & Robotics Sector | Glowwell','Advisory for artificial intelligence and automation firms.',1,1,'published','2026-08-28 17:19:18','2026-08-28 17:19:18'),(2,'biotechnology','Biotechnology & Life Sciences','','Helping pharma developers and genetic labs register IP, run clinical trial agreements, and launch globally.','<p>Our experts advise life sciences companies from early-stage research agreements through drug development, patent clearances, and global distribution licensing.</p>','Biotech & Life Sciences Industry | Glowwell','Advisory services for biotech and healthcare developers.',0,2,'published','2026-08-28 17:19:18','2026-08-28 17:19:18');
/*!40000 ALTER TABLE `industries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_applications`
--

DROP TABLE IF EXISTS `job_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `career_id` int DEFAULT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_note` text COLLATE utf8mb4_unicode_ci,
  `applied_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_years` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('new','reviewed','shortlisted','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'new',
  PRIMARY KEY (`id`),
  KEY `career_id` (`career_id`),
  CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`career_id`) REFERENCES `careers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_applications`
--

LOCK TABLES `job_applications` WRITE;
/*!40000 ALTER TABLE `job_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filepath` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_type` enum('page','practice','industry','news','custom') COLLATE utf8mb4_unicode_ci DEFAULT 'custom',
  `page_id` int DEFAULT NULL,
  `custom_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT '0',
  `sort_order` int DEFAULT '0',
  `menu_group` enum('header','footer') COLLATE utf8mb4_unicode_ci DEFAULT 'header',
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,'Home','custom',NULL,'index.php',0,1,'header'),(2,'About Us','page',1,NULL,0,2,'header'),(3,'Practices','custom',NULL,'practices.php',0,3,'header'),(4,'Industries','custom',NULL,'industries.php',0,4,'header'),(5,'Our Team','custom',NULL,'team.php',0,5,'header'),(6,'News & Insights','custom',NULL,'news.php',0,6,'header'),(7,'Awards','custom',NULL,'awards.php',0,7,'header'),(8,'Careers','custom',NULL,'careers.php',0,8,'header'),(9,'Contact','custom',NULL,'contact.php',0,9,'header'),(10,'Disclaimer & Privacy','page',2,NULL,0,1,'footer'),(11,'Contact Us','custom',NULL,'contact.php',0,2,'footer');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT '0',
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_attorney_id` int DEFAULT NULL,
  `source_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_date` date DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `read_time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '4 min read',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `author_attorney_id` (`author_attorney_id`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author_attorney_id`) REFERENCES `attorneys` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'understanding-trademark-classes-for-startups','Understanding Trademark Classes: A Strategic Guide for Emerging Startups','Trademark Insights',1,NULL,'How to select the right Nice Classification classes for goods and services to avoid gaps in brand protection while keeping registration costs optimized.','<p>When filing a trademark in India, selecting appropriate classes under the international Nice Classification system is one of the most critical decisions. With 34 classes for physical goods and 11 classes for services, entrepreneurs often wonder whether to file in single classes or opt for multiclass filing under Class 99.</p><p>Filing across multiple related classes provides comprehensive legal immunity against brand squatters, while proper classification saves applicants from costly re-filings and registry objections.</p>',NULL,NULL,NULL,NULL,'2026-10-20',NULL,NULL,'published','2026-10-20 17:14:49','2026-10-20 17:14:49','5 min read'),(2,'biotech-and-ai-patents-indian-patent-office-trends','Patent Examination Trends for Computer Implemented Inventions & AI in India','Patent Law',1,NULL,'Analyzing Section 3(k) objections under the Indian Patents Act and how inventive step drafting ensures grants for software-driven innovations.','<p>Section 3(k) of the Indian Patents Act 1970 excludes mathematical methods, business methods, computer programmes per se, and algorithms from patentability. However, recent High Court precedents and updated CRI guidelines affirm that when software produces a tangible technical effect or works in tandem with specialized hardware, patent protection is viable.</p><p>Careful specification drafting focusing on technical contribution rather than mere abstract code is the key to overcoming examination hurdles.</p>',NULL,NULL,NULL,NULL,'2026-10-20',NULL,NULL,'published','2026-10-20 17:14:49','2026-10-20 17:14:49','6 min read'),(3,'safeguarding-geographical-indications-bihar-heritage','Safeguarding Regional Heritage: The Economic Power of Geographical Indications','Geographical Indications',1,NULL,'From Madhubani paintings to Shahi Litchi, how GI tagging protects rural artisan communities and commands premium pricing in international export markets.','<p>Geographical Indications (GI) are collective rights granted to producers within a designated territory. In Eastern India, traditional crafts and agricultural delicacies have benefited enormously from GI registration, which legally excludes non-origin counterfeits from using deceptive regional labels.</p><p>Glow Well has actively championed the protection of regional heritage, advising cooperatives and artisan associations on statutory registration and post-grant enforcement.</p>',NULL,NULL,NULL,NULL,'2026-10-20',NULL,NULL,'published','2026-10-20 17:14:49','2026-10-20 17:14:49','4 min read');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offices`
--

DROP TABLE IF EXISTS `offices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_embed` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offices`
--

LOCK TABLES `offices` WRITE;
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
INSERT INTO `offices` VALUES (1,'New York','100 Premium Plaza, Suite 500, New York, NY 10001','+1 (555) 123-4567','ny@glowwell.com','','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.4284568853757!2d-73.98755038459388!3d40.75482397932757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus',1,'published'),(2,'San Francisco','500 Tech Parkway, Suite 10, San Francisco, CA 94107','+1 (555) 123-4568','sf@glowwell.com','','',2,'published');
/*!40000 ALTER TABLE `offices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hero_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'about-us','About Us','','<p>Founded in 2001, Glowwell has grown into a leading international professional services and advisory firm. We cater to businesses across multiple industries, including Artificial Intelligence, Healthcare, and Finance.</p><h3>Our Mission</h3><p>To deliver top-tier, reliable strategic solutions designed to accelerate growth while maintaining compliance and mitigating operational risks.</p>','About Us | Glowwell','Learn about Glowwell history, mission, and team.','published','2026-08-28 17:19:18','2026-08-28 17:19:18'),(2,'disclaimer-privacy-policy','Disclaimer & Privacy Policy','','<h2>Disclaimer</h2><p>The information on this website is for general informational purposes only and does not constitute legal or professional advice.</p><h2>Privacy Policy</h2><p>We respect your privacy. Any personal information submitted through our contact forms is handled with strict confidentiality and never sold to third parties.</p>','Privacy Policy & Disclaimer | Glowwell','Official disclaimer and privacy policy documentation for Glowwell.','published','2026-08-28 17:19:18','2026-08-28 17:19:18');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practice_sections`
--

DROP TABLE IF EXISTS `practice_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `practice_sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `practice_id` int NOT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `sort_order` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `practice_id` (`practice_id`),
  CONSTRAINT `practice_sections_ibfk_1` FOREIGN KEY (`practice_id`) REFERENCES `practices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practice_sections`
--

LOCK TABLES `practice_sections` WRITE;
/*!40000 ALTER TABLE `practice_sections` DISABLE KEYS */;
INSERT INTO `practice_sections` VALUES (1,1,'Patent Prosecution','<p>Securing utility and design patents globally with direct representation before major patent offices.</p>',1),(2,1,'Patent Litigation & Disputes','<p>Enforcing IP rights and defending against infringement allegations in federal courts and appeal boards.</p>',2),(3,2,'Mergers & Acquisitions','<p>Structuring complex asset purchases, equity buyout structures, and joint venture alliances.</p>',1);
/*!40000 ALTER TABLE `practice_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practices`
--

DROP TABLE IF EXISTS `practices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `practices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'fa-gavel',
  `hero_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `awards_content` longtext COLLATE utf8mb4_unicode_ci,
  `cta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_text` text COLLATE utf8mb4_unicode_ci,
  `cta_btn_label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_btn_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT '0',
  `sort_order` int DEFAULT '0',
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `badge` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'Intellectual Property Rights',
  `banner_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_subtitle` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practices`
--

LOCK TABLES `practices` WRITE;
/*!40000 ALTER TABLE `practices` DISABLE KEYS */;
INSERT INTO `practices` VALUES (1,'patents','Patent Law & Prosecution','Protecting your intellectual property through robust patent drafting, prosecution, and enforcement.','fa-gavel','','Innovation requires protection. Our team works with leading innovators to draft and secure patents across tech and bio sectors.','<h3>Rankings</h3><p>Ranked Tier 1 in Intellectual Property Law by IP Today (2024–2026).</p>','Need IP protection?','Contact our patent team to discuss your innovation today.','Consult an IP Specialist','contact.php','Patent Law & Prosecution | Glowwell','Top-tier patent prosecution, advisory, and litigation services.',1,1,'draft','2026-08-28 17:19:18','2026-10-24 13:49:22','Intellectual Property Rights',NULL,NULL,NULL),(2,'corporate-mergers','Corporate & Mergers','Leading cross-border acquisitions, corporate restructuring, and transaction advisory.','fa-gavel','','In an evolving global marketplace, corporate transactions require rigorous execution and deep foresight.','<h3>Rankings</h3><p>Recognized as a leading Corporate M&A team by LegalAdvisors International.</p>','Planning an M&A Transaction?','Reach out to our lead transaction advisors.','Contact M&A Team','contact.php','Corporate & Mergers | Glowwell','Professional transactional and M&A advisory.',1,2,'draft','2026-08-28 17:19:18','2026-10-24 13:49:22','Intellectual Property Rights',NULL,NULL,NULL),(3,'patent','Patent Search & Documentation Support','Prior-art patent search, provisional & complete specification documentation, Indian & PCT international filing assistance.','fa-lightbulb-o',NULL,'A patent provides statutory exclusivity for novel technical inventions. Glow Well Consultants Pvt Ltd (GCPL) assists corporate research divisions, inventors, and technology startups with prior-art patentability searches, technical disclosure documentation, and filing facilitation through qualified registered patent agents.',NULL,NULL,NULL,NULL,NULL,'Patent Search & Documentation Consultancy | GCPL Patna','Comprehensive patent search, prior-art analysis, and procedural documentation assistance by Glow Well Consultants Pvt Ltd (GCPL).',1,9,'published','2026-10-18 14:22:04','2026-10-24 13:49:22','Intellectual Property Rights','Patent Registration &amp; Prosecution Services','Securing 20-year statutory monopolies for novel inventions, technological breakthroughs, and engineering advancements under the Indian Patents Act.','<h2>What is a Patent?</h2>\n                <p>\n                    A <strong>Patent</strong> gives an inventor the statutory right for a limited period (20 years) to stop others from making, using, selling, offering for sale, or importing an invention without the express permission of the inventor.\n                </p>\n                <p>\n                    Patents are granted for <strong>functional and technical aspects of products and processes</strong>. To qualify for a patent under Indian law, an invention must satisfy three cardinal criteria:\n                </p>\n                <ul>\n                    <li><strong>Novelty:</strong> The invention must be new and not published, publicly known, or disclosed anywhere in the world prior to the date of filing.</li>\n                    <li><strong>Inventive Step (Non-Obviousness):</strong> The invention must involve technical advance as compared to existing knowledge or economic significance, and must not be obvious to a person skilled in the relevant art.</li>\n                    <li><strong>Industrial Applicability:</strong> The invention must be capable of being made or used in an industry.</li>\n                </ul>\n\n                <p>\n                    Most patents are for <strong>incremental improvements in known technology</strong>—evolution rather than revolution. The underlying technology does not need to be astronomically complex, but it must solve a technical problem in a non-obvious manner.\n                </p>\n\n                <h2>Territorial Scope &amp; Duration</h2>\n                <p>\n                    Patent rights are strictly territorial. A patent granted in India confers exclusive rights only within the territorial boundary of India and does not protect the invention overseas. However, through international conventions such as the <strong>Patent Cooperation Treaty (PCT)</strong> and the Paris Convention, an Indian inventor can claim priority to seek corresponding patents in over 150 countries within 12 months of the Indian filing date.\n                </p>\n                <p>\n                    Patent rights in India remain in force for a period of <strong>20 years from the date of filing</strong>, subject to the payment of statutory annual maintenance (renewal) fees.\n                </p>\n\n                <h2>Our Comprehensive Patent Services</h2>\n                <div style=\"display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 24px 0 34px;\">\n                    <div style=\"padding: 20px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.1rem; margin-bottom: 6px;\"><i class=\"fa fa-search text-gold\"></i> Prior-Art Novelty Search</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Exhaustive global database searching to determine patentability and eliminate prior-art risks before filing.</p>\n                    </div>\n                    <div style=\"padding: 20px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.1rem; margin-bottom: 6px;\"><i class=\"fa fa-pencil-square-o text-gold\"></i> Specification Drafting</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Expert drafting of provisional and complete specifications, structured claims, and technical patent illustrations.</p>\n                    </div>\n                    <div style=\"padding: 20px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.1rem; margin-bottom: 6px;\"><i class=\"fa fa-file-text-o text-gold\"></i> Examination Defense</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Comprehensive technical responses to First Examination Reports (FER) and registry hearing representation.</p>\n                    </div>\n                    <div style=\"padding: 20px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.1rem; margin-bottom: 6px;\"><i class=\"fa fa-globe text-gold\"></i> PCT International Filing</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Filing international applications under the Patent Cooperation Treaty and managing foreign national phase entries.</p>\n                    </div>\n                </div>'),(4,'trademark','Trademark Registration & Brand Protection','Brand name search, logo registration support across Classes 1–45, procedural filing assistance, brand watch & commercial monetization guidance.','fa-registered',NULL,'Your brand name, logo, and commercial identity are amongst your organization\'s most valuable commercial assets. Under the Trade Marks Act, 1999, registration grants exclusive proprietary rights and prevents unauthorized imitation. Glow Well Consultants Pvt Ltd (GCPL) provides end-to-end brand protection facilitation—from comprehensive clearance searches to procedural application filing and commercial brand monetization guidance.',NULL,NULL,NULL,NULL,NULL,'Trademark Registration & Brand Protection Support | GCPL Patna','Trademark search, filing facilitation, and brand protection consulting in Patna by Glow Well Consultants Pvt Ltd (GCPL). Secure your brand, logo, and business identity.',1,4,'published','2026-10-18 14:22:04','2026-10-24 13:49:22','Brand Identity &amp; Defense','Trademark Registration &amp; Brand Protection','Protect your brand names, logos, devices, and company identity under the Trade Marks Act 1999 with Eastern India\'s most experienced IP attorney firm.','<h2>What is a Trademark?</h2>\n                <p>\n                    <strong>Trademarks</strong> are words, names, symbols, brands, devices, headings, labels, tickets, signatures, letters, numerals, or any combination thereof, used or proposed to be used by manufacturers of goods or providers of services to identify and distinguish their products from those sold by others.\n                </p>\n                <p>\n                    A person who markets goods or services under a registered trademark acquires statutory, exclusive rights to use that mark across India, deterring copycats and counterfeiters from trading on their earned goodwill.\n                </p>\n\n                <h2>Why Trademark Registration is Essential</h2>\n                <div style=\"display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 24px 0;\">\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-shield text-gold\"></i> Exclusive Nationwide Ownership</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Registration acts as constructive nationwide notice of ownership and confers legal standing to claim statutory damages.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-registered text-gold\"></i> Right to Use the &reg; Symbol</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Instills deep customer confidence, deters potential infringers, and creates a valuable corporate intangible asset.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-gavel text-gold\"></i> Simplified Court Enforcement</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">In infringement lawsuits, proof of deceptive similarity is sufficient—no need to prove difficult common-law passing off.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-globe text-gold\"></i> Basis for Global Protection</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">An Indian trademark application serves as a priority springboard for international filings under the Madrid Protocol.</p>\n                    </div>\n                </div>\n\n                <h2>The Trademark Registration Process in India</h2>\n                <ol style=\"margin-left: 20px; margin-bottom: 30px; display: flex; flex-direction: column; gap: 14px;\">\n                    <li><strong>Exhaustive Pre-filing Search:</strong> Official database check across 45 Nice classes to verify distinctiveness and eliminate similarity conflicts.</li>\n                    <li><strong>Application Filing (Form TM-A):</strong> Preparing applicant particulars, user date affidavits, power of attorney, and statutory filing at the Registry.</li>\n                    <li><strong>Registry Examination:</strong> The Registrar scrutinizes the application under Sections 9 and 11. If objections arise, our attorneys draft comprehensive legal replies.</li>\n                    <li><strong>Journal Publication:</strong> Accepted marks are advertised in the official Trade Marks Journal for a 4-month public opposition period.</li>\n                    <li><strong>Grant of Registration Certificate:</strong> If no opposition is entered, the official Certificate of Registration is issued, valid for 10 years.</li>\n                </ol>'),(5,'copyright','Copyright Registration & Creative Asset Protection','Protection for software code, website designs, literary works, musical recordings, artistic logos, and statutory documentation filing.','fa-copyright',NULL,'Copyright protects original creative expressions under the Indian Copyright Act, 1957. Glow Well Consultants Pvt Ltd (GCPL) guides businesses, authors, developers, and creative enterprises through copyright documentation, filing procedures, and NOC clearance from the Trademark Registry to secure commercial ownership of intellectual creations.',NULL,NULL,NULL,NULL,NULL,'Copyright Registration & Creative Asset Protection | GCPL Patna','Secure statutory copyright for software code, digital media, literary works, and artistic designs with Glow Well Consultants Pvt Ltd (GCPL) in Patna.',1,5,'published','2026-10-18 14:22:04','2026-10-24 13:49:22','Creative &amp; Digital IP','Copyright Protection &amp; Software Licensing','Securing statutory ownership, moral rights, and commercial exploitation for authors, software developers, artists, and media creators under the Indian Copyright Act 1957.','<h2>What is Copyright?</h2>\n                <p>\n                    <strong>Copyright</strong> is a form of intellectual property protection granted under the Indian Copyright Act 1957 to creators of original works of authorship, such as literary, dramatic, musical, and artistic works, cinematographic films, sound recordings, and computer software programs.\n                </p>\n                <p>\n                    Copyright material is the result of creative skill, significant labor, and financial investment. Without legal protection, unauthorized parties could exploit, duplicate, or distribute your creations without compensation. Copyright grants both <strong>economic rights</strong> (commercial distribution, reproduction, licensing) and <strong>moral rights</strong> (paternity right to claim authorship and integrity right to object to mutilation or derogatory distortion).\n                </p>\n\n                <h2>Exclusive Rights Available Under Copyright Protection</h2>\n                <p>Copyright owners have the exclusive rights to do or authorize any of the following acts in respect of a protected work:</p>\n                <ul>\n                    <li><strong>Reproduction in Any Material Form:</strong> Including storing the work in any electronic or cloud medium.</li>\n                    <li><strong>Public Issuance &amp; Communication:</strong> Issuing copies to the public and performing or communicating the work across digital channels.</li>\n                    <li><strong>Translation &amp; Adaptation:</strong> Creating derivative works, foreign language translations, or multimedia adaptations.</li>\n                    <li><strong>Commercial Rental &amp; Sale:</strong> In the case of computer software and sound recordings, the exclusive right to sell, license, or give on commercial hire.</li>\n                    <li><strong>Assignment &amp; Licensing:</strong> Conferring rights to publishers, distributors, or tech partners under exclusive or non-exclusive contracts.</li>\n                </ul>\n\n                <h2>Requirements for Filing a Copyright Application in India</h2>\n                <div style=\"background: var(--bg-subtle); padding: 24px; border-radius: var(--radius-md); margin: 24px 0;\">\n                    <p style=\"font-weight: 700; color: var(--primary); margin-bottom: 12px;\">Documents and Particulars Needed:</p>\n                    <ul style=\"margin-bottom: 0;\">\n                        <li>Full Name, Address, and Nationality of the Applicant and Author.</li>\n                        <li>Nature of the work (Literary, Artistic, Software Code, Sound Recording, etc.).</li>\n                        <li>Year and Country of first publication (or statement of unpublished work).</li>\n                        <li>List of countries where the work has been published and year of subsequent editions.</li>\n                        <li>Six physical copies (or digital CD/USB storage) of the work.</li>\n                        <li>Power of Attorney in favor of Glow Well Consultants Pvt. Ltd.</li>\n                        <li><strong>Trademark Search Certificate (NOC):</strong> For artistic labels, logos, and packaging that could be used as a trademark, an official NOC from the Trademark Registry is mandatory under Section 45(1) before copyright filing.</li>\n                    </ul>\n                </div>\n\n                <h2>Registration Procedure &amp; Timelines</h2>\n                <p>\n                    Following application filing with complete particulars, the Copyright Office issues an official Diary Number. A mandatory 30-day waiting period is observed for potential third-party objections. If no objections are raised, the application undergoes substantive examination. Once queries are resolved, the Registrar of Copyrights issues the official <strong>Certificate of Registration</strong>.\n                </p>'),(6,'designs','Industrial Design Registration & Aesthetics Protection','Aesthetic shape, ornamentation, surface patterns, and 2D/3D design registration under the Designs Act 2000.','fa-paint-brush',NULL,'Industrial design rights protect the unique visual appearance, shape, configuration, and surface aesthetic of manufactured articles. Governed by the Designs Act 2000, valid design registration grants a 10-year exclusive monopoly (extendable to 15 years). GCPL assists industrial manufacturers, innovators, and consumer product brands with design classification, visual representations, and procedural filings.',NULL,NULL,NULL,NULL,NULL,'Industrial Design Registration | Aesthetic Protection | GCPL Patna','Industrial design registration and aesthetics protection consultancy under the Designs Act 2000 by Glow Well Consultants Pvt Ltd (GCPL).',1,6,'published','2026-10-18 14:22:04','2026-10-24 13:49:22','Aesthetic &amp; Form Protection','Industrial Design Registration (Designs Act, 2000)','Securing exclusive commercial rights for aesthetic shapes, patterns, configurations, and ornamentation applied to manufactured articles.','<h2>What is an Industrial Design?</h2>\n                <p>\n                    Under Section 2(d) of the <strong>Designs Act, 2000</strong>, \"Design\" means only the features of shape, configuration, pattern, ornament, or composition of lines or color applied to any article—whether in two-dimensional or three-dimensional form—by any industrial process or means, which in the finished article <strong>appeal to and are judged solely by the eye</strong>.\n                </p>\n                <p>\n                    A design right protects the novel visual appearance of an industrial product. It does not protect functional mechanical mechanisms, principles of construction, trademarks, or artistic works covered under the Copyright Act.\n                </p>\n\n                <h2>Object of Design Law</h2>\n                <p>\n                    Consumer purchasing decisions are frequently influenced by aesthetic appeal, ergonomics, and visual distinctiveness rather than practical utility alone. The cardinal objective of the Designs Act is to ensure that the artisan, inventor, and manufacturer who invest creativity and capital into original aesthetic designs are rewarded with a commercial monopoly, preventing rivals from copying their product styling.\n                </p>\n\n                <h2>Essential Requirements for Registration</h2>\n                <ul>\n                    <li><strong>Absolute Novelty &amp; Originality:</strong> The design must be new and never published or used in India or in any other country prior to the date of filing.</li>\n                    <li><strong>Visual Appeal:</strong> The design features must be visible in the finished article and judged solely by the human eye.</li>\n                    <li><strong>Industrial Applicability:</strong> The design must be applied to an article of manufacture by an industrial, mechanical, chemical, or manual process capable of bulk production.</li>\n                    <li><strong>Non-Functional Character:</strong> The design cannot be a mere mechanical device or dictated solely by how the device operates.</li>\n                    <li><strong>Public Order &amp; Morality:</strong> The design must not be scandalous, obscene, or contrary to public order.</li>\n                </ul>\n\n                <h2>Duration of Design Protection in India</h2>\n                <p>\n                    Registration of a design confers upon the proprietor copyright in the design for an initial period of <strong>ten (10) years</strong> from the date of registration. Before the expiration of this initial 10-year term, an application for extension can be filed along with prescribed fees to extend the monopoly for a further period of <strong>five (5) years</strong>, giving a total statutory protection of <strong>15 years</strong>.\n                </p>'),(7,'geographical','Geographical Indication (GI) Facilitation','Protection and authorized user registration for goods having specific territorial origin and artisan heritage under the GI Act 1999.','fa-globe',NULL,'Geographical Indication recognizes agricultural, handicraft, and manufactured products rooted in regional tradition, soil, or craftsmanship (such as Madhubani Art, Bhagalpuri Silk, Shahi Litchi, and Katarni Rice). GCPL assists producer societies, farmers\' associations, and regional guilds with GI documentation, historical evidence compilation, and authorized user enrollment.',NULL,NULL,NULL,NULL,NULL,'Geographical Indication (GI) Consultancy & Facilitation | GCPL','Geographical Indication (GI) documentation and authorized user registration support in Bihar and Eastern India by Glow Well Consultants Pvt Ltd.',1,8,'published','2026-10-18 14:22:04','2026-10-24 13:49:22','Regional Heritage &amp; TRIPS','Geographical Indication (GI) Registration','Preserving regional heritage, protecting producer cooperatives, and securing premium export valuation under the Geographical Indications of Goods Act, 1999.','<h2>What is a Geographical Indication?</h2>\n                <p>\n                    A <strong>Geographical Indication (GI)</strong> is a sign used on products that have a specific geographical origin and possess qualities, characteristics, or a reputation that are fundamentally due to that origin.\n                </p>\n                <p>\n                    Geographical Indication is primarily granted to <strong>agricultural products, natural produce, manufactured goods, and traditional handicrafts</strong> originating from a definite geographical territory.\n                </p>\n                <p>\n                    Article 22 of the WTO TRIPS Agreement defines Geographical Indications as:\n                </p>\n                <blockquote style=\"background: var(--bg-light); border-left: 4px solid var(--accent); padding: 18px 24px; font-style: italic; color: #475569; margin: 20px 0;\">\n                    \"Indications which identify a good as originating in the territory of a Member, or a region or locality in that territory, where a given quality, reputation or other characteristic of the good is essentially attributable to its geographical origin.\"\n                </blockquote>\n\n                <h2>Threefold Statutory Objectives of the GI Act, 1999</h2>\n                <ol style=\"margin-left: 20px; margin-bottom: 24px; display: flex; flex-direction: column; gap: 12px;\">\n                    <li><strong>Producer Protection:</strong> Enacting a dedicated legal framework to adequately protect the collective commercial rights of traditional producers and artisan communities.</li>\n                    <li><strong>Consumer Protection:</strong> Excluding unauthorized persons from misusing regional names, protecting consumers from deceptive imitations and fraudulent origins.</li>\n                    <li><strong>Global Market Promotion:</strong> Promoting genuine Indian heritage goods in the high-value international export market under reciprocal treaty agreements.</li>\n                </ol>\n\n                <h2>Famous Registered Geographical Indications</h2>\n                <p>\n                    A registered Geographical Indication prohibits any third party from using such designation or presentation on goods that do not originate in the designated territory or do not meet the specified code of practice. Notable examples include:\n                </p>\n                <div style=\"display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin: 20px 0 30px;\">\n                    <div style=\"padding: 16px; background: var(--bg-subtle); border-radius: var(--radius-sm);\">\n                        <strong style=\"color: var(--primary);\">Darjeeling Tea:</strong> GI Registration No. 1 &amp; 2 (First GI tagged product in India).\n                    </div>\n                    <div style=\"padding: 16px; background: var(--bg-subtle); border-radius: var(--radius-sm);\">\n                        <strong style=\"color: var(--primary);\">Madhubani Paintings:</strong> Traditional handicraft originating from the Mithila region of Bihar.\n                    </div>\n                    <div style=\"padding: 16px; background: var(--bg-subtle); border-radius: var(--radius-sm);\">\n                        <strong style=\"color: var(--primary);\">Bhagalpuri Silk:</strong> Distinctive Tussar silk woven across Bhagalpur, Bihar.\n                    </div>\n                    <div style=\"padding: 16px; background: var(--bg-subtle); border-radius: var(--radius-sm);\">\n                        <strong style=\"color: var(--primary);\">Shahi Litchi &amp; Katarni Rice:</strong> Distinctive agricultural treasures of Muzaffarpur and Bhagalpur.\n                    </div>\n                </div>\n\n                <h2>How Glow Well Facilitates GI Registration</h2>\n                <p>\n                    We assist producer associations, cooperatives, statutory boards, and government departments in:\n                </p>\n                <ul>\n                    <li>Formulating Historical &amp; Technical Proof of Origin.</li>\n                    <li>Drafting the Statement of Case, Geographic Map boundaries, and Quality Standards.</li>\n                    <li>Filing before the Geographical Indications Registry in Chennai.</li>\n                    <li>Authorizing Individual User registrations for eligible local producers and artisans.</li>\n                    <li>Enforcing legal action against counterfeit distributors using protected GI labels.</li>\n                </ul>\n\n                <div style=\"margin-top: 40px; padding: 34px; background: var(--navy-grad); border-radius: var(--radius-lg); color: #ffffff;\">\n                    <h3 style=\"color: #ffffff; font-size: 1.5rem; margin-bottom: 8px;\">Facilitating GI Tagging for Cooperatives &amp; Producers</h3>\n                    <p style=\"color: #cbd5e1; font-size: 0.95rem; margin-bottom: 20px;\">\n                        Connect with our GI advisory attorneys in Patna for registration feasibility analysis and cost estimates.\n                    </p>\n                    <a href=\"<?= BASE_URL ?>/enquiry.php?service=geographical\" class=\"btn btn-primary open-consultation-modal\">\n                        <i class=\"fa fa-globe\"></i> Request GI Consultation\n                    </a>\n                </div>'),(8,'iso-certification','Management System Certification (ISO)','ISO 9001 (QMS), ISO 14001 (EMS), ISO 22000 (Food Safety), ISO 45001 (OH&S), gap analysis, documentation & compliance facilitation.','fa-certificate',NULL,'A Management System Certification demonstrates an organization\'s unwavering commitment to quality, environmental responsibility, and operational excellence. Glow Well Consultants Pvt Ltd (GCPL) delivers end-to-end consultancy for ISO 9001, ISO 14001, ISO 22000, ISO 45001, and HACCP, guiding enterprises through gap assessment, standard operating procedure (SOP) documentation, and internal audit preparation for successful certification audits by accredited bodies.',NULL,NULL,NULL,NULL,NULL,'ISO Certification Consultancy | ISO 9001, 14001, 22000, 45001 | GCPL Patna','Comprehensive ISO certification consultancy in Patna by Glow Well Consultants Pvt Ltd (GCPL). ISO 9001, 14001, 22000, 45001 gap analysis, documentation & audit readiness.',1,1,'published','2026-10-18 14:22:04','2026-10-24 13:49:22','Quality Standards','ISO Certification &amp; Management Systems','End-to-end consulting, process documentation, compliance gap analysis, and accredited audit facilitation for global quality standards.','<h2>Elevate Your Enterprise with International ISO Certification</h2>\n                <p>\n                    International Organization for Standardization (ISO) certifications demonstrate that your products, services, and internal processes meet globally recognized benchmarks of quality, safety, data security, and efficiency.\n                </p>\n                <p>\n                    At <strong>Glow Well Consultants Pvt. Ltd.</strong>, we provide complete handholding throughout the certification lifecycle. We do not just assist in passing an audit—we re-engineer business processes to enhance productivity, reduce operational waste, and qualify your company for premium government tenders and corporate vendor empanelment.\n                </p>\n\n                <h2>Key ISO Standards We Facilitate</h2>\n                <div style=\"display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 24px 0 34px;\">\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-check-square-o text-gold\"></i> ISO 9001:2015 (QMS)</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Quality Management System. Demonstrates consistent customer satisfaction, standard operating procedures, and continuous improvement.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-leaf text-gold\"></i> ISO 14001:2015 (EMS)</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Environmental Management System. Establishes sustainable resource consumption, waste reduction, and statutory environmental compliance.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-lock text-gold\"></i> ISO 27001:2022 (ISMS)</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Information Security Management. Protects client data, cloud infrastructure, intellectual assets, and prevents cybersecurity breaches.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-cutlery text-gold\"></i> ISO 22000 / HACCP (FSMS)</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Food Safety Management Systems. Vital for food processing companies, packaging plants, restaurants, and agricultural export firms.</p>\n                    </div>\n                </div>\n\n                <h2>The 5-Step Glow Well ISO Certification Roadmap</h2>\n                <ol style=\"margin-left: 20px; margin-bottom: 30px; display: flex; flex-direction: column; gap: 14px;\">\n                    <li><strong>Diagnostic Gap Analysis:</strong> Reviewing existing workflows against target ISO clauses to identify compliance deficits.</li>\n                    <li><strong>Process Documentation:</strong> Preparing Quality Manuals, SOPs, work instructions, and mandatory policy registers.</li>\n                    <li><strong>Implementation &amp; Staff Training:</strong> Training management and operational personnel on compliance standards and record maintenance.</li>\n                    <li><strong>Internal Audit &amp; Management Review:</strong> Conducting simulated pre-assessment audits to verify readiness.</li>\n                    <li><strong>Certification Audit Support:</strong> Coordinating Stage 1 and Stage 2 audits with accredited certification bodies (NABCB, IAF).</li>\n                </ol>\n\n                <div style=\"margin-top: 40px; padding: 34px; background: var(--navy-grad); border-radius: var(--radius-lg); color: #ffffff;\">\n                    <h3 style=\"color: #ffffff; font-size: 1.5rem; margin-bottom: 8px;\">Certify Your Business with Global Credibility</h3>\n                    <p style=\"color: #cbd5e1; font-size: 0.95rem; margin-bottom: 20px;\">\n                        Request a customized ISO proposal and timeline estimate from our quality management consultants.\n                    </p>\n                    <a href=\"<?= BASE_URL ?>/enquiry.php?service=iso\" class=\"btn btn-primary open-consultation-modal\">\n                        <i class=\"fa fa-certificate\"></i> Request ISO Proposal\n                    </a>\n                </div>'),(9,'company-registration','Company & Business Incorporation','Private Limited Company, LLP, One Person Company (OPC), MSME / Udyam registration, Startup India DPIIT recognition & annual ROC compliances.','fa-building',NULL,'Building an enterprise begins with robust corporate governance. Glow Well Consultants Pvt Ltd (GCPL) assists budding entrepreneurs and corporate groups with complete incorporation facilitation via MCA SPICe+, including Digital Signature Certificates (DSC), Director Identification Numbers (DIN), drafting MoA & AoA, PAN/TAN, MSME Udyam, and Startup India DPIIT recognition.',NULL,NULL,NULL,NULL,NULL,'Company & Business Incorporation Services | Pvt Ltd, LLP, MSME | GCPL','Incorporate your Private Limited Company, LLP, or MSME with Glow Well Consultants Pvt Ltd (GCPL) in Patna. Complete ROC filing and statutory business setup.',1,7,'draft','2026-10-18 14:22:04','2026-10-24 14:17:46','Corporate Structuring','Company &amp; Business Incorporation','Launch your business entity with seamless MCA filings, digital signature certificates, director DIN, and statutory registrations in Patna, Bihar.','<h2>Incorporate Your Enterprise on Rock-Solid Legal Foundations</h2>\n                <p>\n                    Choosing the right legal structure is crucial for securing founder liability protection, attracting equity investment, ensuring tax efficiency, and building long-term enterprise valuation.\n                </p>\n                <p>\n                    At <strong>Glow Well Consultants Pvt. Ltd.</strong>, we guide founders through name approval, MOA/AOA drafting, SPICe+ MCA filing, and statutory post-incorporation compliances.\n                </p>\n\n                <h2>Entities We Incorporate &amp; License</h2>\n                <div style=\"display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 24px 0 34px;\">\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-building-o text-gold\"></i> Private Limited Company (Pvt Ltd)</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">The gold standard for scalable startups and corporate ventures. Limited liability, separate legal identity, and easy equity dilution for investors.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-users text-gold\"></i> Limited Liability Partnership (LLP)</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Combines partnership flexibility with corporate limited liability. Reduced compliance overhead, ideal for professional consultancy practices.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-user-circle-o text-gold\"></i> One Person Company (OPC)</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Permits a single solo entrepreneur to operate a corporate entity with limited liability without needing a second director partner.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-rocket text-gold\"></i> Startup India &amp; MSME / Udyam</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Securing DPIIT recognition, 80-IAC income tax exemptions, patent fast-tracking discounts (up to 80%), and collateral-free bank credit.</p>\n                    </div>\n                </div>\n\n                <h2>End-to-End Startup Package Inclusions</h2>\n                <ul>\n                    <li>Name Reservation via RUN / SPICe+ Part A.</li>\n                    <li>Digital Signature Certificates (Class 3 DSC) for Directors.</li>\n                    <li>Director Identification Numbers (DIN).</li>\n                    <li>Drafting of customized Memorandum &amp; Articles of Association (MOA &amp; AOA).</li>\n                    <li>PAN, TAN, EPFO, ESIC, and Professional Tax registrations.</li>\n                    <li>Bank Account Opening Resolution &amp; Certificate of Incorporation.</li>\n                </ul>\n\n                <div style=\"margin-top: 40px; padding: 34px; background: var(--navy-grad); border-radius: var(--radius-lg); color: #ffffff;\">\n                    <h3 style=\"color: #ffffff; font-size: 1.5rem; margin-bottom: 8px;\">Ready to Incorporate Your Company?</h3>\n                    <p style=\"color: #cbd5e1; font-size: 0.95rem; margin-bottom: 20px;\">\n                        Talk to our corporate registration attorneys in Patna to start your company incorporation today.\n                    </p>\n                    <a href=\"<?= BASE_URL ?>/enquiry.php?service=company\" class=\"btn btn-primary open-consultation-modal\">\n                        <i class=\"fa fa-building\"></i> Start Company Registration\n                    </a>\n                </div>'),(10,'cyber-law','Cyber Law & Digital Rights Advisory','Data protection compliance, domain dispute resolution (INDRP/UDRP), software escrow contracts, cybercrime litigation & digital IP enforcement.','fa-laptop',NULL,'In an interconnected digital landscape, digital assets face cyber threats, brand impersonation, and domain cybersquatting. Our cyber legal team defends your digital footprint under the Information Technology Act.',NULL,NULL,NULL,NULL,NULL,'Cyber Law & Digital Rights Advisory | Glow Well Consultants Pvt. Ltd.','Cyber law litigation, domain name dispute resolution (INDRP/UDRP), IT Act compliance, software escrow, and digital IP enforcement in Patna, Bihar.',1,8,'draft','2026-10-18 14:22:04','2026-10-24 13:49:22','Technology &amp; Internet Law','Cyber Law &amp; Digital IP Advisory','Defending software rights, combating domain cybersquatting, navigating the Information Technology Act, and safeguarding enterprise digital assets.','<h2>Legal Defense in the Connected Digital Economy</h2>\n                <p>\n                    As enterprises migrate critical operations and brand assets to the cloud, digital exposure to cyber infringement, domain name squatting, data breaches, and software piracy has escalated exponentially.\n                </p>\n                <p>\n                    <strong>Glow Well Consultants Pvt. Ltd.</strong> provides specialized cyber legal consultancy grounded in the <strong>Information Technology Act, 2000 (and amendments)</strong>, Digital Personal Data Protection (DPDP) Act, and international internet arbitration protocols.\n                </p>\n\n                <h2>Our Cyber Law &amp; Digital Rights Practice</h2>\n                <div style=\"display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 24px 0 34px;\">\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-globe text-gold\"></i> Domain Name Disputes (INDRP / UDRP)</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Arbitration before NIXI and WIPO against cybersquatters who unlawfully register domains confusingly similar to your registered trademark.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-code text-gold\"></i> Software &amp; SaaS Contracts</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Drafting Software Licensing Agreements, Source Code Escrow contracts, End User License Agreements (EULA), and Service Level Agreements (SLA).</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-shield text-gold\"></i> Data Privacy &amp; DPDP Compliance</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Advising businesses on Indian Data Protection compliance, user consent architectures, privacy policies, and data fiduciary audits.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-ban text-gold\"></i> Cyber Crime &amp; Digital Evidence</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Filing complaints before Cyber Crime Police Cells for corporate identity theft, phishing, unauthorized access, and cyber defamation.</p>\n                    </div>\n                </div>\n\n                <div style=\"margin-top: 40px; padding: 34px; background: var(--navy-grad); border-radius: var(--radius-lg); color: #ffffff;\">\n                    <h3 style=\"color: #ffffff; font-size: 1.5rem; margin-bottom: 8px;\">Facing a Cyber Dispute or Domain Infringement?</h3>\n                    <p style=\"color: #cbd5e1; font-size: 0.95rem; margin-bottom: 20px;\">\n                        Contact our technology legal desk for urgent intervention, legal notices, and statutory dispute arbitration.\n                    </p>\n                    <a href=\"<?= BASE_URL ?>/enquiry.php?service=cyber\" class=\"btn btn-primary open-consultation-modal\">\n                        <i class=\"fa fa-shield\"></i> Consult Cyber Legal Team\n                    </a>\n                </div>'),(11,'litigation','Litigation & Dispute Resolution','Infringement lawsuits, passing-off legal actions, cease-and-desist notices, arbitration, and High Court / District Court representation.','fa-gavel',NULL,'When your intellectual property or commercial rights are violated, swift and decisive legal action is vital. We represent rights holders in civil injunctions, damages suits, and criminal seizure proceedings against counterfeiters.',NULL,NULL,NULL,NULL,NULL,'IP Litigation & Dispute Resolution | Glow Well Consultants Pvt. Ltd.','Intellectual property litigation in Patna, Bihar. Infringement lawsuits, passing off actions, cease and desist notices, commercial injunctions, and High Court representation.',1,9,'draft','2026-10-18 14:22:04','2026-10-24 13:49:22','Courtroom Representation','IP Litigation &amp; Dispute Resolution','Aggressive court defense and decisive enforcement against trademark infringement, patent piracy, counterfeiters, and commercial contract breaches.','<h2>Decisive Enforcement When Your Rights Are Violated</h2>\n                <p>\n                    Securing registration is only the first step. When unscrupulous competitors imitate your brand, counterfeit your products, or infringe upon your patented technology, vigorous litigation is essential to protect market share and corporate reputation.\n                </p>\n                <p>\n                    At <strong>Glow Well Consultants Pvt. Ltd.</strong>, our litigation counsel possesses extensive trial and appellate experience before Commercial Courts, District Courts, and High Courts across Eastern India.\n                </p>\n\n                <h2>Core Litigation Services</h2>\n                <div style=\"display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 24px 0 34px;\">\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-gavel text-gold\"></i> Infringement Lawsuits</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Statutory civil suits under the Trade Marks Act 1999, Patents Act 1970, and Copyright Act 1957 to secure permanent injunctions and punitive damages.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-balance-scale text-gold\"></i> Action for Passing Off</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Common-law protection for unregistered marks and trade dress to halt misrepresentation that injures established commercial goodwill.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-file-text-o text-gold\"></i> Cease &amp; Desist Notices</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Issuing strategic legal notices with strict deadlines, compelling infringers to surrender infringing stock without protracted court battles.</p>\n                    </div>\n                    <div style=\"padding: 22px; background: var(--bg-subtle); border-radius: var(--radius-md);\">\n                        <h4 style=\"color: var(--primary); font-size: 1.15rem; margin-bottom: 6px;\"><i class=\"fa fa-search-plus text-gold\"></i> Anton Piller &amp; Search Orders</h4>\n                        <p style=\"font-size: 0.92rem; color: var(--text-muted); margin: 0;\">Securing ex-parte court orders and appointing Local Commissioners to raid premises, seize counterfeit inventory, and preserve forensic evidence.</p>\n                    </div>\n                </div>\n\n                <div style=\"margin-top: 40px; padding: 34px; background: var(--navy-grad); border-radius: var(--radius-lg); color: #ffffff;\">\n                    <h3 style=\"color: #ffffff; font-size: 1.5rem; margin-bottom: 8px;\">Need Immediate Legal Intervention?</h3>\n                    <p style=\"color: #cbd5e1; font-size: 0.95rem; margin-bottom: 20px;\">\n                        Speak with our senior litigation advocates in Patna for rapid case assessment and court injunction filing.\n                    </p>\n                    <a href=\"<?= BASE_URL ?>/enquiry.php?service=litigation\" class=\"btn btn-primary open-consultation-modal\">\n                        <i class=\"fa fa-gavel\"></i> Schedule Legal Consultation\n                    </a>\n                </div>'),(39,'barcode-registration','BAR Code Registration & Implementation','GS1 Barcode registration, EAN-13, UPC, 2D Data Matrix, product allotment, retail packaging compliance & inventory implementation.','fa-barcode',NULL,'Barcodes are the international language of commerce, enabling automated product identification, retail point-of-sale checkout, inventory tracking, and supply chain transparency. Glow Well Consultants Pvt Ltd (GCPL) assists manufacturers, distributors, and e-commerce sellers with complete GS1 barcode registration, product number allocation, master data structuring, and barcode packaging compliance.',NULL,NULL,NULL,NULL,NULL,'BAR Code Registration & Implementation | GS1 India Consultancy | GCPL','Official GS1 BAR Code registration and implementation consultancy by Glow Well Consultants Pvt Ltd (GCPL). EAN-13, UPC, QR codes for retail, manufacturing and export.',1,2,'published','2026-10-24 13:49:22','2026-10-24 13:49:22','Intellectual Property Rights',NULL,NULL,NULL),(40,'social-security','Social Security Compliances (EPF & ESIC)','Employees\' Provident Fund (EPF) and Employees\' State Insurance (ESIC) registration, monthly return filings, ECR generation, and labor law compliance.','fa-users',NULL,'Statutory social security compliance is critical for building a compliant, employee-friendly workplace and avoiding stringent penalties. Glow Well Consultants Pvt Ltd (GCPL) provides complete advisory and procedural compliance management for the Employees\' Provident Fund (EPF under EPFO) and the Employees\' State Insurance (ESIC), from initial employer registration and employee onboarding to monthly Electronic Challan Return (ECR) generation and annual audit support.',NULL,NULL,NULL,NULL,NULL,'Social Security Compliances | EPF & ESIC Registration & Filings | GCPL','Comprehensive EPF & ESIC social security compliance services in Patna by Glow Well Consultants Pvt Ltd. Employer registration, monthly ECR challan filing, and labor audit compliance.',1,3,'published','2026-10-24 13:49:22','2026-10-24 13:49:22','Intellectual Property Rights',NULL,NULL,NULL);
/*!40000 ALTER TABLE `practices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site_name','Glow Well Consultants Pvt Ltd (GCPL)'),(2,'tagline','Premier Intellectual Property, Patent & Legal Corporate Advisory'),(3,'logo','glowwell-logo.jpg'),(4,'favicon',''),(5,'contact_address','201, 2nd Floor, Mohini Market, (SBI Exhibition Road Branch), Opp Hotel Gargee Grand, Near HAI COMPLEX, Exhibition Road, Patna - 800001, Bihar, India'),(6,'contact_phone','+91 612 2999299'),(7,'contact_email','info@glowwell.in'),(8,'footer_about','Glow Well Consultants Pvt Ltd (GCPL) is a premier corporate management consultancy firm incorporated in 2011. Headquartered in Patna, Bihar, we specialize in Management System Certification (ISO), GS1 Barcode Registration, EPF & ESIC Social Security Compliances, and Brand Asset Facilitation (Trademark, Copyright & Designs).'),(9,'copyright','© 2026 Glowwell. All rights reserved.'),(10,'facebook','https://facebook.com/glowwell'),(11,'twitter','https://twitter.com/glowwell'),(12,'linkedin','https://linkedin.com/company/glowwell'),(13,'instagram','https://instagram.com/glowwell'),(14,'youtube','https://youtube.com/glowwell'),(15,'hero_slides','[{\"title\":\"Stellar Legal Protection\",\"subtitle\":\"Providing premier corporate defense and advisory services globally.\",\"btn_label\":\"Our Practices\",\"btn_link\":\"practices.php\",\"image\":\"\"},{\"title\":\"Pioneering Innovation\",\"subtitle\":\"Guiding high-growth startups and tech giants through complex landscapes.\",\"btn_label\":\"Contact Us\",\"btn_link\":\"contact.php\",\"image\":\"\"}]'),(16,'stats','[{\"number\":\"13+\",\"label\":\"Years of Trust\"},{\"number\":\"150+\",\"label\":\"Attorneys Worldwide\"},{\"number\":\"98%\",\"label\":\"Success Rate\"},{\"number\":\"5000+\",\"label\":\"Satisfied Clients\"}]'),(17,'cta_title','Protect Your Intellectual Property & Business Assets Today'),(18,'cta_text','Get in touch with our certified attorney consultants for an immediate confidential evaluation and cost estimate.'),(19,'cta_btn_label','Book Consultation'),(20,'cta_btn_link','enquiry.php'),(23,'header_phone_display','+91 7488961920 / 21'),(24,'contact_landline','+91 612 2999299'),(25,'contact_mobile','+91 7488961920'),(26,'contact_mobile_alt','+91 7488961921'),(27,'contact_mobile_alt2','+91 7488961921'),(28,'whatsapp_number','917488961920'),(29,'whatsapp_display','+91 7488961920'),(31,'contact_email_enquiry','info@glowwell.in'),(33,'office_hours','Monday - Saturday: 10:00 AM - 7:00 PM (Sunday Closed)'),(34,'map_embed','https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d115128.33215753247!2d85.07362666644445!3d25.61287751229096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x39ed59770d942f5d%3A0x3fe4b3ce4474f7b9!2sCopyright+Registration+in+Patna+-Glow+Well%2C+M%2FS+GLOW+WELL%2C+201%2C+2nd+Floor%2C+Mohini+Market%2C+Near+Hai+Complex+(SBI+ATM+Opp.+Hotel+Gargee+grand%2C+Exhibition+Rd%2C+Patna%2C+Bihar+800001!3m2!1d25.6128942!2d85.143667!5e0!3m2!1sen!2sin!4v1531109383735'),(36,'stats_years','13+ Years of Consultancy Trust (Est. 2011)'),(37,'stats_cases','6,500+'),(38,'stats_success','99.4%'),(39,'stats_clients','3,500+'),(113,'hero_badge','13+ Years of Management Consultancy & Regulatory Excellence (Est. 2011)'),(114,'hero_title','Empowering Business Growth. <br><span class=\"text-gold\">Regulatory Compliance & ISO Systems.</span> <br>Brand Asset Facilitation.'),(115,'hero_desc','Glow Well Consultants Pvt Ltd (GCPL) is Eastern India\'s premier corporate management and regulatory consultancy firm. Incorporated in 2011, we guide startups, MSMEs, and established enterprises across ISO Management Systems, Barcode Registration, EPF & ESIC Social Security, and Brand Asset Facilitation (Trademark, Copyright & Designs).'),(116,'hero_btn1_text','Book Consultation'),(117,'hero_btn2_text','Explore Our Services'),(118,'trust_badge_1','Incorporated in 2011 (GCPL)'),(119,'trust_badge_2','3,500+ Businesses Advised'),(120,'trust_badge_3','100% Statutory Compliance'),(121,'stats_years_num','13+'),(122,'stats_years_label','Years of Trust (Est. 2011)'),(123,'stats_cases_num','3,500+'),(124,'stats_cases_label','Businesses & Startups Advised'),(125,'stats_success_num','99.4%'),(126,'stats_success_label','Audit Readiness & Compliance Rate'),(127,'stats_clients_num','100%'),(128,'stats_clients_label','Dedicated Advisory Support'),(129,'services_section_badge','Comprehensive Business Solutions'),(130,'services_section_title','Our Core Consultancy & Compliance Services'),(131,'services_section_desc','From management system certifications (ISO) and barcode allocation to social security filings and brand asset facilitation, we deliver end-to-end regulatory solutions for enterprises.'),(132,'tm_box_badge','Brand Clearance & Asset Search'),(133,'tm_box_title','Is Your Brand or Business Name Available?'),(134,'tm_box_desc','Protect your brand identity from conflicts. Enter your proposed trademark, brand name, or logo for an official Trade Marks Registry search and clearance report.'),(135,'why_badge','The GCPL Advantage'),(136,'why_title','Why Enterprises & Startups Choose Glow Well'),(137,'why_desc','We do not merely consult for certificates; we help organizations structure robust management systems, ensure statutory compliance, and protect brand value for long-term growth.'),(138,'why_float_title','Trusted Since 2011'),(139,'why_float_desc','Over 13 years of excellence in business management consultancy and regulatory compliance in Patna, Bihar.'),(140,'why_f1_title','ISO & System Certification Readiness'),(141,'why_f1_desc','Complete preparation, gap analysis, and documentation support for ISO 9001, 14001, 22000, 45001, and HACCP certifications issued by accredited certification bodies.'),(142,'why_f2_title','Barcode & Supply Chain Enablement'),(143,'why_f2_desc','Seamless GS1 barcode registration, product allocation, and retail inventory setup for domestic and international markets.'),(144,'why_f3_title','Social Security & Statutory Labor Compliance'),(145,'why_f3_desc','End-to-end EPF and ESIC registration, monthly return filings, electronic challans, and complete labor law statutory compliance.'),(146,'why_f4_title','Transparent Fixed-Fee & Milestone Billing'),(147,'why_f4_desc','Zero ambiguity with itemized statutory fees and consultancy milestones—ensuring cost efficiency for emerging startups and established enterprises.'),(185,'about_meta_desc','Learn about Glow Well Consultants Pvt Ltd (GCPL), incorporated in 2011 in Patna, Bihar. 13+ years of excellence in ISO certifications, Barcode registration, EPF/ESIC compliances, and brand facilitation.'),(186,'about_p1','<strong>Glow Well Consultants Pvt. Ltd.</strong> is a premier attorney and corporate consultancy firm headquartered in Patna, Bihar, with nationwide operational capabilities. For over 13 years, our firm has stood as a bastion of trust, legal acumen, and strategic guidance for businesses seeking to protect, enforce, and capitalize on their intellectual property assets.'),(187,'testimonials_section_desc','Over 13 years of trusted partnership with corporations, institutions, and entrepreneurs.'),(188,'show_testimonials','0'),(189,'site_tagline','Corporate Management Consultancy, ISO Systems & Regulatory Compliance'),(190,'about_meta_title','Who We Are | Glow Well Consultants Pvt Ltd (GCPL) | Management Consultancy Patna'),(191,'about_banner_title','Pioneering Business Management & Regulatory Compliance'),(192,'about_banner_subtitle','Guiding enterprises, startups, and institutions with institutional rigor, statutory precision, and strategic foresight since 2011.'),(193,'about_badge','Company Profile & Heritage'),(194,'about_title','Eastern India’s Trusted Corporate Management Consultancy (GCPL)'),(195,'footer_cta_title','Ready to Elevate Your Business Systems & Ensure Statutory Compliance?'),(196,'footer_cta_desc','Consult with our experienced corporate advisors in Patna for ISO systems, barcode registration, EPF/ESIC compliance, and brand protection.');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_role` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT 'Managing Director',
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int DEFAULT '5',
  `feedback` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int DEFAULT '0',
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Dr. Alok Verma','Founder & CEO','Patliputra BioTech Labs',5,'Glow Well handled our complex biomedical patent application flawlessly. Their team performed exhaustive prior-art searches and drafted claims that were granted without a single objection.',1,'published','2026-10-20 17:14:49'),(2,'Sunil K. Agarwal','Managing Director','Mithila Agro Processing Pvt Ltd',5,'We registered multiple brand trademarks and secured Geographical Indication facilitation through Glow Well. Their 13 years of courtroom and registry experience in Patna is unmatched in Eastern India.',2,'published','2026-10-20 17:14:49'),(3,'Pooja Singhania','Chief Legal Counsel','Apex Infotech Solutions',5,'From our software copyright to ISO 27001 certification and corporate contracts, Glow Well Consultants has been our trusted legal backbone for the past 7 years.',3,'published','2026-10-20 17:14:49');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-24 20:34:55
