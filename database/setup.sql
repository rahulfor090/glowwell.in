-- ========================================================
-- Glow Well Consultants Pvt. Ltd. Database Export
-- Generated: 2026-10-18 14:42:20
-- ========================================================

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('1', 'site_name', 'Glow Well Consultants Pvt. Ltd.');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('2', 'tagline', 'Premier Intellectual Property, Patent & Legal Corporate Advisory');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('3', 'logo', 'glowwell-logo.jpg');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('4', 'favicon', '');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('5', 'contact_address', '201, 2nd Floor, Mohini Market, (SBI Exhibition Road Branch), Opp Hotel Gargee Grand, Near HAI COMPLEX, Exhibition Road, Patna - 800001, Bihar, India');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('6', 'contact_phone', '+91 612 2999299');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('7', 'contact_email', 'info@glowwell.in');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('8', 'footer_about', 'Glow Well Consultants Pvt. Ltd. is Eastern India\'s premier attorney & consultancy firm specializing in Patents, Trademarks, Copyrights, Industrial Designs, Geographical Indications, ISO Certification, and Corporate Business Registration.');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('9', 'copyright', '© 2026 Glowwell. All rights reserved.');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('10', 'facebook', 'https://facebook.com/glowwell');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('11', 'twitter', 'https://twitter.com/glowwell');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('12', 'linkedin', 'https://linkedin.com/company/glowwell');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('13', 'instagram', 'https://instagram.com/glowwell');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('14', 'youtube', 'https://youtube.com/glowwell');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('15', 'hero_slides', '[{\"title\":\"Stellar Legal Protection\",\"subtitle\":\"Providing premier corporate defense and advisory services globally.\",\"btn_label\":\"Our Practices\",\"btn_link\":\"practices.php\",\"image\":\"\"},{\"title\":\"Pioneering Innovation\",\"subtitle\":\"Guiding high-growth startups and tech giants through complex landscapes.\",\"btn_label\":\"Contact Us\",\"btn_link\":\"contact.php\",\"image\":\"\"}]');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('16', 'stats', '[{\"number\":\"13+\",\"label\":\"Years of Trust\"},{\"number\":\"150+\",\"label\":\"Attorneys Worldwide\"},{\"number\":\"98%\",\"label\":\"Success Rate\"},{\"number\":\"5000+\",\"label\":\"Satisfied Clients\"}]');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('17', 'cta_title', 'Protect Your Intellectual Property & Business Assets Today');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('18', 'cta_text', 'Get in touch with our certified attorney consultants for an immediate confidential evaluation and cost estimate.');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('19', 'cta_btn_label', 'Book Consultation');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('20', 'cta_btn_link', 'enquiry.php');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('23', 'header_phone_display', '+91 7488961920 / 21');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('24', 'contact_landline', '+91 612 2999299');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('25', 'contact_mobile', '+91 7488961920');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('26', 'contact_mobile_alt', '+91 7488961921');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('27', 'contact_mobile_alt2', '+91 7488961921');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('28', 'whatsapp_number', '917488961920');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('29', 'whatsapp_display', '+91 7488961920');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('31', 'contact_email_enquiry', 'info@glowwell.in');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('33', 'office_hours', 'Monday - Saturday: 10:00 AM - 7:00 PM (Sunday Closed)');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('34', 'map_embed', 'https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d115128.33215753247!2d85.07362666644445!3d25.61287751229096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x39ed59770d942f5d%3A0x3fe4b3ce4474f7b9!2sCopyright+Registration+in+Patna+-Glow+Well%2C+M%2FS+GLOW+WELL%2C+201%2C+2nd+Floor%2C+Mohini+Market%2C+Near+Hai+Complex+(SBI+ATM+Opp.+Hotel+Gargee+grand%2C+Exhibition+Rd%2C+Patna%2C+Bihar+800001!3m2!1d25.6128942!2d85.143667!5e0!3m2!1sen!2sin!4v1531109383735');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('36', 'stats_years', '13+');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('37', 'stats_cases', '6,500+');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('38', 'stats_success', '99.4%');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES ('39', 'stats_clients', '3,500+');

DROP TABLE IF EXISTS `admins`;
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

INSERT INTO `admins` (`id`, `username`, `email`, `password_hash`, `role`, `login_attempts`, `lockout_until`, `last_login`, `created_at`) VALUES ('1', 'admin', 'admin@glowwell.in', '$2y$12$5HHlyVcWQrDCDTpPz2Uz9e.2cM04VJIpUR5gbZ2XYMRAwvq8Zv5fG', 'superadmin', '1', NULL, NULL, '2026-08-28 22:49:18');

DROP TABLE IF EXISTS `practices`;
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `practices` (`id`, `slug`, `title`, `short_description`, `icon`, `hero_image`, `intro`, `awards_content`, `cta_title`, `cta_text`, `cta_btn_label`, `cta_btn_link`, `meta_title`, `meta_description`, `is_featured`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES ('1', 'patents', 'Patent Law & Prosecution', 'Protecting your intellectual property through robust patent drafting, prosecution, and enforcement.', 'fa-gavel', '', 'Innovation requires protection. Our team works with leading innovators to draft and secure patents across tech and bio sectors.', '<h3>Rankings</h3><p>Ranked Tier 1 in Intellectual Property Law by IP Today (2024–2026).</p>', 'Need IP protection?', 'Contact our patent team to discuss your innovation today.', 'Consult an IP Specialist', 'contact.php', 'Patent Law & Prosecution | Glowwell', 'Top-tier patent prosecution, advisory, and litigation services.', '1', '1', 'published', '2026-08-28 22:49:18', '2026-08-28 22:49:18');
INSERT INTO `practices` (`id`, `slug`, `title`, `short_description`, `icon`, `hero_image`, `intro`, `awards_content`, `cta_title`, `cta_text`, `cta_btn_label`, `cta_btn_link`, `meta_title`, `meta_description`, `is_featured`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES ('2', 'corporate-mergers', 'Corporate & Mergers', 'Leading cross-border acquisitions, corporate restructuring, and transaction advisory.', 'fa-gavel', '', 'In an evolving global marketplace, corporate transactions require rigorous execution and deep foresight.', '<h3>Rankings</h3><p>Recognized as a leading Corporate M&A team by LegalAdvisors International.</p>', 'Planning an M&A Transaction?', 'Reach out to our lead transaction advisors.', 'Contact M&A Team', 'contact.php', 'Corporate & Mergers | Glowwell', 'Professional transactional and M&A advisory.', '1', '2', 'published', '2026-08-28 22:49:18', '2026-08-28 22:49:18');
INSERT INTO `practices` (`id`, `slug`, `title`, `short_description`, `icon`, `hero_image`, `intro`, `awards_content`, `cta_title`, `cta_text`, `cta_btn_label`, `cta_btn_link`, `meta_title`, `meta_description`, `is_featured`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES ('3', 'patent', 'Patent Law & Prosecution', 'Comprehensive patent search, provisional & complete drafting, Indian & PCT international filing, opposition and maintenance.', 'fa-lightbulb-o', NULL, 'A patent gives an inventor the statutory right for a limited period (20 years) to stop others from making, using, selling, or importing an invention without permission. At Glow Well, we guide inventors, research institutions, and corporations through patentability search, drafting, examination, and grant.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', 'published', '2026-10-18 19:52:04', '2026-10-18 19:52:04');
INSERT INTO `practices` (`id`, `slug`, `title`, `short_description`, `icon`, `hero_image`, `intro`, `awards_content`, `cta_title`, `cta_text`, `cta_btn_label`, `cta_btn_link`, `meta_title`, `meta_description`, `is_featured`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES ('4', 'trademark', 'Trademark Registration & Protection', 'Comprehensive market & official registry search, filing across Classes 1–45 and Class 99 multiclass, objection defense, opposition hearings & renewals.', 'fa-registered', NULL, 'A trademark protects your brand identity, logo, slogan, and business goodwill. Under the Trade Marks Act 1999, registration grants exclusive nationwide rights and prevents competitors from using deceptively similar marks.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2', 'published', '2026-10-18 19:52:04', '2026-10-18 19:52:04');
INSERT INTO `practices` (`id`, `slug`, `title`, `short_description`, `icon`, `hero_image`, `intro`, `awards_content`, `cta_title`, `cta_text`, `cta_btn_label`, `cta_btn_link`, `meta_title`, `meta_description`, `is_featured`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES ('5', 'copyright', 'Copyright Protection & Licensing', 'Protection for literary works, software code, musical compositions, cinematography, artistic logos, and NOC clearance from Trademark Registry.', 'fa-copyright', NULL, 'Copyright safeguards original creative expressions under the Indian Copyright Act 1957. It confers economic and moral rights, preventing unauthorized reproduction, digital distribution, and adaptation.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '3', 'published', '2026-10-18 19:52:04', '2026-10-18 19:52:04');
INSERT INTO `practices` (`id`, `slug`, `title`, `short_description`, `icon`, `hero_image`, `intro`, `awards_content`, `cta_title`, `cta_text`, `cta_btn_label`, `cta_btn_link`, `meta_title`, `meta_description`, `is_featured`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES ('6', 'designs', 'Industrial Design Registration', 'Aesthetic shape, ornamentation, surface pattern, and 2D/3D design registration under the Designs Act 2000 at the Kolkata Patent Office.', 'fa-paint-brush', NULL, 'Design rights protect the unique aesthetic appearance and visual appeal of manufactured articles. Governed by the Designs Act 2000, valid design registration grants a 10-year exclusive monopoly extendable up to 15 years.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '4', 'published', '2026-10-18 19:52:04', '2026-10-18 19:52:04');
INSERT INTO `practices` (`id`, `slug`, `title`, `short_description`, `icon`, `hero_image`, `intro`, `awards_content`, `cta_title`, `cta_text`, `cta_btn_label`, `cta_btn_link`, `meta_title`, `meta_description`, `is_featured`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES ('7', 'geographical', 'Geographical Indication (GI)', 'Registration and protection of goods having specific geographical origin and reputation under TRIPS and the GI Act 1999.', 'fa-globe', NULL, 'Geographical Indication protects agricultural, handicraft, and manufactured products associated with a distinct territory (such as Darjeeling Tea, Madhubani Art, Bhagalpuri Silk, Shahi Litchi). It preserves cultural heritage and prevents commercial counterfeits.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '5', 'published', '2026-10-18 19:52:04', '2026-10-18 19:52:04');
INSERT INTO `practices` (`id`, `slug`, `title`, `short_description`, `icon`, `hero_image`, `intro`, `awards_content`, `cta_title`, `cta_text`, `cta_btn_label`, `cta_btn_link`, `meta_title`, `meta_description`, `is_featured`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES ('8', 'iso-certification', 'ISO Certification & Quality Audits', 'ISO 9001 (QMS), ISO 14001, ISO 27001 (Information Security), ISO 22000, gap analysis, documentation & compliance facilitation.', 'fa-certificate', NULL, 'ISO certifications validate your organization\'s commitment to quality, data safety, and operational excellence. Glow Well provides end-to-end consulting from gap assessment and process documentation to final audit certification.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '6', 'published', '2026-10-18 19:52:04', '2026-10-18 19:52:04');
INSERT INTO `practices` (`id`, `slug`, `title`, `short_description`, `icon`, `hero_image`, `intro`, `awards_content`, `cta_title`, `cta_text`, `cta_btn_label`, `cta_btn_link`, `meta_title`, `meta_description`, `is_featured`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES ('9', 'company-registration', 'Company & Business Incorporation', 'Private Limited Company, LLP, One Person Company (OPC), MSME / Udyam registration, Startup India DPIIT recognition & ROC filing.', 'fa-building', NULL, 'Launch your enterprise on solid legal foundations. We assist startups and established businesses with MCA incorporation, DIN, DSC, PAN, TAN, GST, MSME certifications, and statutory annual compliances.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '7', 'published', '2026-10-18 19:52:04', '2026-10-18 19:52:04');
INSERT INTO `practices` (`id`, `slug`, `title`, `short_description`, `icon`, `hero_image`, `intro`, `awards_content`, `cta_title`, `cta_text`, `cta_btn_label`, `cta_btn_link`, `meta_title`, `meta_description`, `is_featured`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES ('10', 'cyber-law', 'Cyber Law & Digital Rights Advisory', 'Data protection compliance, domain dispute resolution (INDRP/UDRP), software escrow contracts, cybercrime litigation & digital IP enforcement.', 'fa-laptop', NULL, 'In an interconnected digital landscape, digital assets face cyber threats, brand impersonation, and domain cybersquatting. Our cyber legal team defends your digital footprint under the Information Technology Act.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '8', 'published', '2026-10-18 19:52:04', '2026-10-18 19:52:04');
INSERT INTO `practices` (`id`, `slug`, `title`, `short_description`, `icon`, `hero_image`, `intro`, `awards_content`, `cta_title`, `cta_text`, `cta_btn_label`, `cta_btn_link`, `meta_title`, `meta_description`, `is_featured`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES ('11', 'litigation', 'Litigation & Dispute Resolution', 'Infringement lawsuits, passing-off legal actions, cease-and-desist notices, arbitration, and High Court / District Court representation.', 'fa-gavel', NULL, 'When your intellectual property or commercial rights are violated, swift and decisive legal action is vital. We represent rights holders in civil injunctions, damages suits, and criminal seizure proceedings against counterfeiters.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '9', 'published', '2026-10-18 19:52:04', '2026-10-18 19:52:04');

DROP TABLE IF EXISTS `practice_sections`;
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

INSERT INTO `practice_sections` (`id`, `practice_id`, `heading`, `content`, `sort_order`) VALUES ('1', '1', 'Patent Prosecution', '<p>Securing utility and design patents globally with direct representation before major patent offices.</p>', '1');
INSERT INTO `practice_sections` (`id`, `practice_id`, `heading`, `content`, `sort_order`) VALUES ('2', '1', 'Patent Litigation & Disputes', '<p>Enforcing IP rights and defending against infringement allegations in federal courts and appeal boards.</p>', '2');
INSERT INTO `practice_sections` (`id`, `practice_id`, `heading`, `content`, `sort_order`) VALUES ('3', '2', 'Mergers & Acquisitions', '<p>Structuring complex asset purchases, equity buyout structures, and joint venture alliances.</p>', '1');

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `practice_slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int DEFAULT '0',
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('1', 'trademark', 'What is a trademark?', 'Trademarks are words, names, symbols, brand names, devices, headings, labels, tickets, signatures, letters, numerals, or any combination thereof, used or proposed to be used by manufacturers or service providers to identify and distinguish their goods and services from those of others. A person who uses a registered trademark acquires statutory exclusive rights.', '1', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('2', 'trademark', 'What are the benefits of trademark registration?', 'Trademark registration protects the goodwill of a business, grants exclusive nationwide rights, and provides prima facie evidence of ownership in legal disputes. It deters counterfeiters, allows you to use the registered ® symbol, and serves as a priority basis for filing international trademark applications under the Madrid Protocol.', '2', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('3', 'trademark', 'Who can file an application for trademark registration?', 'Any person claiming to be the proprietor of a trademark—whether an individual, partnership firm, LLP, private limited company, society, or trust—can file an application. The applicant can be either currently using the mark or propose to use it in good faith in commerce.', '3', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('4', 'trademark', 'What marks can and cannot be registered?', 'Distinctive marks, invented words, unique logos, and coined terms can be registered. Marks that are merely descriptive of the product, generic terms, deceptive marks, marks scandalous or offensive to religious sentiments, or marks identical/confusingly similar to pre-existing registered marks cannot be registered.', '4', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('5', 'trademark', 'What is a trademark search and why is it essential?', 'A trademark search scans the official records of the Trademark Registry to uncover identical or phonetically similar marks. Conducting an official search before filing saves immense time and money, and prevents expensive opposition, objections, and infringement lawsuits.', '5', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('6', 'trademark', 'How long does a trademark registration remain valid?', 'A trademark registration in India is valid for 10 (ten) years from the date of filing. It can be renewed indefinitely every 10 years upon payment of the statutory renewal fee.', '6', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('7', 'trademark', 'What is the difference between \"TM\" and \"®\"?', 'You can use the \"TM\" symbol immediately once you have filed the application and obtained an official acknowledgement / application number. The \"®\" symbol can ONLY be used legally after the Trademark Registry issues the official Certificate of Registration.', '7', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('8', 'trademark', 'What is the difference between Infringement and Passing Off?', 'Infringement is a statutory remedy available for registered trademarks under the Trade Marks Act 1999—proof of similarity alone is sufficient. Passing off is a common-law remedy for unregistered marks, which requires proving established goodwill, misrepresentation, and likelihood of financial injury.', '8', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('9', 'trademark', 'Can a trademark be transferred or assigned?', 'Yes, a registered trademark or an application pending registration is fully assignable with or without the goodwill of the business, through an official deed of assignment.', '9', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('10', 'copyright', 'What is a copyright under Indian Law?', 'Copyright is a bundle of exclusive legal rights granted under the Indian Copyright Act 1957 to creators of original literary, dramatic, musical, artistic works, sound recordings, and cinematograph films, as well as computer software programs and databases.', '10', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('11', 'copyright', 'What rights does copyright protection grant?', 'Copyright confers the exclusive right to reproduce the work, publish copies, perform or communicate the work to the public, produce translations, create adaptations, and sell or license copies.', '11', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('12', 'copyright', 'Is copyright registration mandatory to claim protection?', 'Copyright protection is automatic upon the creation of the work. However, official registration with the Copyright Office of India provides prima facie admissible evidence in court, which is decisive in civil and criminal litigation against infringers.', '12', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('13', 'copyright', 'What documents are required for filing copyright in India?', 'Full name, nationality, and address of the applicant and author; title of the work; date and country of first publication; 6 copies of the work; Power of Attorney; and a No Objection Certificate (NOC) from the Trademark Office if registering artistic labels or logos.', '13', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('14', 'copyright', 'How long does copyright protection last?', 'For original literary, dramatic, musical, and artistic works, copyright lasts for the lifetime of the author plus 60 years from the beginning of the calendar year following the author\'s death. For cinematograph films, sound recordings, and posthumous works, it lasts for 60 years from publication.', '14', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('15', 'patent', 'What is a patent and what rights does it confer?', 'A patent is a statutory monopoly granted by the Government for an invention that is novel, involves an inventive step (non-obvious), and has industrial applicability. It confers the exclusive right to exclude others from making, using, offering for sale, selling, or importing the invention in India for 20 years.', '15', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('16', 'patent', 'What is the difference between a provisional and complete specification?', 'A provisional specification establishes an immediate priority date when the invention is in development. A complete specification detailing full technical disclosure and claims must then be filed within 12 months.', '16', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('17', 'patent', 'Are patent rights territorial?', 'Yes, patent rights granted in India are valid only within the territory of India. To secure protection in other countries, an applicant must file corresponding patent applications abroad or through the Patent Cooperation Treaty (PCT) within 12 months of the Indian filing date.', '17', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('18', 'designs', 'What is an Industrial Design under the Designs Act 2000?', 'Design refers to the features of shape, configuration, pattern, ornament, or composition of lines or colors applied to any article in two-dimensional or three-dimensional form by an industrial process, which in the finished article appeal to and are judged solely by the eye.', '18', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('19', 'designs', 'What is the duration of design registration in India?', 'Initial registration lasts for 10 years from the registration date. It can be extended for an additional period of 5 years upon filing an application for renewal before expiry, giving total protection of 15 years.', '19', 'published', '2026-10-18 19:53:14');
INSERT INTO `faqs` (`id`, `practice_slug`, `question`, `answer`, `sort_order`, `status`, `created_at`) VALUES ('20', 'designs', 'Can a trademark or artistic work be registered as a design?', 'No. By statutory definition, design excludes trade marks, property marks, and artistic works covered under the Copyright Act, as well as mere functional mechanical devices.', '20', 'published', '2026-10-18 19:53:14');

DROP TABLE IF EXISTS `contact_messages`;
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


DROP TABLE IF EXISTS `careers`;
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

INSERT INTO `careers` (`id`, `title`, `job_type`, `location`, `description`, `posted_date`, `status`, `sort_order`, `department`, `experience`, `requirements`) VALUES ('1', 'Senior Trademark & Patent Attorney', 'Full Time', 'Patna Office / Hybrid', 'Lead trademark search, drafting patent specifications, responding to examination reports, and representing clients in registry hearings.', '2026-10-18', 'published', '1', 'Intellectual Property Rights', '4-8 Years', 'Degree in Law (LL.B.) and Registered Patent/Trademark Agent qualification. Proven track record in IP prosecution.');
INSERT INTO `careers` (`id`, `title`, `job_type`, `location`, `description`, `posted_date`, `status`, `sort_order`, `department`, `experience`, `requirements`) VALUES ('2', 'Patent Drafting Associate (Tech / Bio)', 'Full Time', 'Patna Head Office', 'Drafting provisional and non-provisional patent specifications, prior art novelty searches, claim structuring, and patent landscaping.', '2026-10-18', 'published', '2', 'Patent Prosecution', '2-4 Years', 'B.Tech / M.Sc / M.Pharm / Ph.D. with deep patent search and drafting expertise.');
INSERT INTO `careers` (`id`, `title`, `job_type`, `location`, `description`, `posted_date`, `status`, `sort_order`, `department`, `experience`, `requirements`) VALUES ('3', 'Corporate Legal Executive', 'Full Time', 'Patna Head Office', 'Handling company incorporation, ROC annual filings, MSME documentation, and client liaison for corporate licensing.', '2026-10-18', 'published', '3', 'Corporate Services', '1-3 Years', 'B.Com / LL.B / CS Executive with MCA V3 portal proficiency.');

DROP TABLE IF EXISTS `job_applications`;
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


DROP TABLE IF EXISTS `news`;
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

INSERT INTO `news` (`id`, `slug`, `title`, `category`, `is_featured`, `cover_image`, `excerpt`, `content`, `author_name`, `author_attorney_id`, `source_name`, `source_url`, `published_date`, `meta_title`, `meta_description`, `status`, `created_at`, `updated_at`, `read_time`) VALUES ('1', 'understanding-trademark-classes-for-startups', 'Understanding Trademark Classes: A Strategic Guide for Emerging Startups', 'Trademark Insights', '1', NULL, 'How to select the right Nice Classification classes for goods and services to avoid gaps in brand protection while keeping registration costs optimized.', '<p>When filing a trademark in India, selecting appropriate classes under the international Nice Classification system is one of the most critical decisions. With 34 classes for physical goods and 11 classes for services, entrepreneurs often wonder whether to file in single classes or opt for multiclass filing under Class 99.</p><p>Filing across multiple related classes provides comprehensive legal immunity against brand squatters, while proper classification saves applicants from costly re-filings and registry objections.</p>', NULL, NULL, NULL, NULL, '2026-10-18', NULL, NULL, 'published', '2026-10-18 19:53:15', '2026-10-18 19:53:15', '5 min read');
INSERT INTO `news` (`id`, `slug`, `title`, `category`, `is_featured`, `cover_image`, `excerpt`, `content`, `author_name`, `author_attorney_id`, `source_name`, `source_url`, `published_date`, `meta_title`, `meta_description`, `status`, `created_at`, `updated_at`, `read_time`) VALUES ('2', 'biotech-and-ai-patents-indian-patent-office-trends', 'Patent Examination Trends for Computer Implemented Inventions & AI in India', 'Patent Law', '1', NULL, 'Analyzing Section 3(k) objections under the Indian Patents Act and how inventive step drafting ensures grants for software-driven innovations.', '<p>Section 3(k) of the Indian Patents Act 1970 excludes mathematical methods, business methods, computer programmes per se, and algorithms from patentability. However, recent High Court precedents and updated CRI guidelines affirm that when software produces a tangible technical effect or works in tandem with specialized hardware, patent protection is viable.</p><p>Careful specification drafting focusing on technical contribution rather than mere abstract code is the key to overcoming examination hurdles.</p>', NULL, NULL, NULL, NULL, '2026-10-18', NULL, NULL, 'published', '2026-10-18 19:53:15', '2026-10-18 19:53:15', '6 min read');
INSERT INTO `news` (`id`, `slug`, `title`, `category`, `is_featured`, `cover_image`, `excerpt`, `content`, `author_name`, `author_attorney_id`, `source_name`, `source_url`, `published_date`, `meta_title`, `meta_description`, `status`, `created_at`, `updated_at`, `read_time`) VALUES ('3', 'safeguarding-geographical-indications-bihar-heritage', 'Safeguarding Regional Heritage: The Economic Power of Geographical Indications', 'Geographical Indications', '1', NULL, 'From Madhubani paintings to Shahi Litchi, how GI tagging protects rural artisan communities and commands premium pricing in international export markets.', '<p>Geographical Indications (GI) are collective rights granted to producers within a designated territory. In Eastern India, traditional crafts and agricultural delicacies have benefited enormously from GI registration, which legally excludes non-origin counterfeits from using deceptive regional labels.</p><p>Glow Well has actively championed the protection of regional heritage, advising cooperatives and artisan associations on statutory registration and post-grant enforcement.</p>', NULL, NULL, NULL, NULL, '2026-10-18', NULL, NULL, 'published', '2026-10-18 19:53:15', '2026-10-18 19:53:15', '4 min read');

DROP TABLE IF EXISTS `downloads`;
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

INSERT INTO `downloads` (`id`, `title`, `category`, `file_path`, `file_size`, `file_type`, `description`, `sort_order`, `downloads_count`, `created_at`) VALUES ('1', 'Official Trademark Application TM-A Guidance Note', 'Trademark', '#', '1.4 MB', 'PDF', 'Official guide covering classification, user affidavits, and document checklists for TM-A filing.', '1', '342', '2026-10-18 19:53:15');
INSERT INTO `downloads` (`id`, `title`, `category`, `file_path`, `file_size`, `file_type`, `description`, `sort_order`, `downloads_count`, `created_at`) VALUES ('2', 'Patent Filing Checklist & Provisional Specification Guide', 'Patent', '#', '2.1 MB', 'PDF', 'Step-by-step checklist for inventors covering novel technical disclosure and patent drawings.', '2', '289', '2026-10-18 19:53:15');
INSERT INTO `downloads` (`id`, `title`, `category`, `file_path`, `file_size`, `file_type`, `description`, `sort_order`, `downloads_count`, `created_at`) VALUES ('3', 'Copyright Registration Information & NOC Format', 'Copyright', '#', '950 KB', 'PDF', 'Standard checklist for artistic, literary, and software copyright registration including TM NOC form.', '3', '415', '2026-10-18 19:53:15');
INSERT INTO `downloads` (`id`, `title`, `category`, `file_path`, `file_size`, `file_type`, `description`, `sort_order`, `downloads_count`, `created_at`) VALUES ('4', 'Industrial Design Application Form 1 Reference', 'Design', '#', '1.1 MB', 'PDF', 'Guidelines on representation sheets, views (perspective, top, side), and priority documents.', '4', '180', '2026-10-18 19:53:15');
INSERT INTO `downloads` (`id`, `title`, `category`, `file_path`, `file_size`, `file_type`, `description`, `sort_order`, `downloads_count`, `created_at`) VALUES ('5', 'Nice Classification Guide (Classes 1–45 Goods & Services)', 'General', '#', '3.8 MB', 'PDF', 'Comprehensive reference index of international goods and services classification.', '5', '890', '2026-10-18 19:53:15');

DROP TABLE IF EXISTS `testimonials`;
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

INSERT INTO `testimonials` (`id`, `client_name`, `client_role`, `company`, `rating`, `feedback`, `sort_order`, `status`, `created_at`) VALUES ('1', 'Dr. Alok Verma', 'Founder & CEO', 'Patliputra BioTech Labs', '5', 'Glow Well handled our complex biomedical patent application flawlessly. Their team performed exhaustive prior-art searches and drafted claims that were granted without a single objection.', '1', 'published', '2026-10-18 19:53:15');
INSERT INTO `testimonials` (`id`, `client_name`, `client_role`, `company`, `rating`, `feedback`, `sort_order`, `status`, `created_at`) VALUES ('2', 'Sunil K. Agarwal', 'Managing Director', 'Mithila Agro Processing Pvt Ltd', '5', 'We registered multiple brand trademarks and secured Geographical Indication facilitation through Glow Well. Their 13 years of courtroom and registry experience in Patna is unmatched in Eastern India.', '2', 'published', '2026-10-18 19:53:15');
INSERT INTO `testimonials` (`id`, `client_name`, `client_role`, `company`, `rating`, `feedback`, `sort_order`, `status`, `created_at`) VALUES ('3', 'Pooja Singhania', 'Chief Legal Counsel', 'Apex Infotech Solutions', '5', 'From our software copyright to ISO 27001 certification and corporate contracts, Glow Well Consultants has been our trusted legal backbone for the past 7 years.', '3', 'published', '2026-10-18 19:53:15');

SET FOREIGN_KEY_CHECKS = 1;
