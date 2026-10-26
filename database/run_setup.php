<?php
/**
 * Glowwell Database Schema & Seed Data Initializer
 */
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$dbname = 'glowwell';
$port = 3306;

$conn = new mysqli($host, $user, $pass, '', $port);
if ($conn->connect_error) {
    die("MySQL Connection Failed: " . $conn->connect_error);
}

// Create database if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$conn->select_db($dbname);

echo "Database `$dbname` selected.\n";

// Table: settings
$conn->query("CREATE TABLE IF NOT EXISTS `settings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `setting_key` VARCHAR(100) NOT NULL UNIQUE,
    `setting_value` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

// Table: admins
$conn->query("CREATE TABLE IF NOT EXISTS `admins` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(190) NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `role` ENUM('superadmin', 'editor') DEFAULT 'editor',
    `login_attempts` INT DEFAULT 0,
    `lockout_until` DATETIME DEFAULT NULL,
    `last_login` DATETIME DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

// Table: practices
$conn->query("CREATE TABLE IF NOT EXISTS `practices` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `slug` VARCHAR(190) NOT NULL UNIQUE,
    `title` VARCHAR(255) NOT NULL,
    `short_description` TEXT,
    `icon` VARCHAR(100) DEFAULT 'fa-gavel',
    `hero_image` VARCHAR(255) DEFAULT NULL,
    `intro` TEXT,
    `awards_content` LONGTEXT,
    `cta_title` VARCHAR(255) DEFAULT 'Need Legal Assistance?',
    `cta_text` TEXT,
    `cta_btn_label` VARCHAR(100) DEFAULT 'Request Consultation',
    `cta_btn_link` VARCHAR(255) DEFAULT 'enquiry.php',
    `meta_title` VARCHAR(255) DEFAULT NULL,
    `meta_description` VARCHAR(500) DEFAULT NULL,
    `is_featured` TINYINT(1) DEFAULT 0,
    `sort_order` INT DEFAULT 0,
    `status` ENUM('published', 'draft') DEFAULT 'published',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

// Check if icon column exists in practices table
$colsP = $conn->query("SHOW COLUMNS FROM `practices` LIKE 'icon'");
if ($colsP->num_rows == 0) {
    $conn->query("ALTER TABLE `practices` ADD `icon` VARCHAR(100) DEFAULT 'fa-gavel' AFTER `short_description`");
}

// Table: practice_sections
$conn->query("CREATE TABLE IF NOT EXISTS `practice_sections` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `practice_id` INT NOT NULL,
    `heading` VARCHAR(255) NOT NULL,
    `content` LONGTEXT NOT NULL,
    `sort_order` INT DEFAULT 0,
    KEY `practice_id` (`practice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

// Table: faqs
$conn->query("CREATE TABLE IF NOT EXISTS `faqs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `practice_slug` VARCHAR(100) NOT NULL,
    `question` VARCHAR(500) NOT NULL,
    `answer` LONGTEXT NOT NULL,
    `sort_order` INT DEFAULT 0,
    `status` ENUM('published', 'draft') DEFAULT 'published',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

// Table: contact_messages (Enquiries & Messages)
$conn->query("CREATE TABLE IF NOT EXISTS `contact_messages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(190) NOT NULL,
    `email` VARCHAR(190) NOT NULL,
    `phone` VARCHAR(50) DEFAULT NULL,
    `whatsapp` VARCHAR(50) DEFAULT NULL,
    `company` VARCHAR(255) DEFAULT NULL,
    `service_interest` VARCHAR(150) DEFAULT NULL,
    `subject` VARCHAR(255) DEFAULT NULL,
    `office` VARCHAR(100) DEFAULT 'Patna Head Office',
    `message` TEXT NOT NULL,
    `status` ENUM('new', 'contacted', 'in_progress', 'closed') DEFAULT 'new',
    `is_read` TINYINT(1) DEFAULT 0,
    `ip_address` VARCHAR(50) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

// Add any missing columns to contact_messages if table already existed
$cols = $conn->query("SHOW COLUMNS FROM `contact_messages` LIKE 'service_interest'");
if ($cols->num_rows == 0) {
    $conn->query("ALTER TABLE `contact_messages` ADD `service_interest` VARCHAR(150) DEFAULT NULL AFTER `subject`");
}
$cols = $conn->query("SHOW COLUMNS FROM `contact_messages` LIKE 'company'");
if ($cols->num_rows == 0) {
    $conn->query("ALTER TABLE `contact_messages` ADD `company` VARCHAR(255) DEFAULT NULL AFTER `phone`");
}
$cols = $conn->query("SHOW COLUMNS FROM `contact_messages` LIKE 'whatsapp'");
if ($cols->num_rows == 0) {
    $conn->query("ALTER TABLE `contact_messages` ADD `whatsapp` VARCHAR(50) DEFAULT NULL AFTER `phone`");
}
$cols = $conn->query("SHOW COLUMNS FROM `contact_messages` LIKE 'status'");
if ($cols->num_rows == 0) {
    $conn->query("ALTER TABLE `contact_messages` ADD `status` ENUM('new', 'contacted', 'in_progress', 'closed') DEFAULT 'new' AFTER `message`");
}

// Table: careers
$conn->query("CREATE TABLE IF NOT EXISTS `careers` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `department` VARCHAR(100) DEFAULT 'Legal & IPR',
    `job_type` VARCHAR(50) DEFAULT 'Full Time',
    `experience` VARCHAR(100) DEFAULT '2-5 Years',
    `location` VARCHAR(150) DEFAULT 'Patna, Bihar / Hybrid',
    `description` LONGTEXT,
    `requirements` LONGTEXT,
    `posted_date` DATE DEFAULT NULL,
    `status` ENUM('published', 'draft') DEFAULT 'published',
    `sort_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

// Check missing columns in careers
foreach (['department' => 'VARCHAR(100) DEFAULT "Legal & IPR"', 'experience' => 'VARCHAR(100) DEFAULT "2-5 Years"', 'requirements' => 'LONGTEXT'] as $col => $def) {
    $chkC = $conn->query("SHOW COLUMNS FROM `careers` LIKE '$col'");
    if ($chkC->num_rows == 0) {
        $conn->query("ALTER TABLE `careers` ADD `$col` $def");
    }
}

// Table: job_applications
$conn->query("CREATE TABLE IF NOT EXISTS `job_applications` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `career_id` INT DEFAULT NULL,
    `job_title` VARCHAR(255) DEFAULT NULL,
    `name` VARCHAR(190) NOT NULL,
    `email` VARCHAR(190) NOT NULL,
    `phone` VARCHAR(50) DEFAULT NULL,
    `experience_years` VARCHAR(50) DEFAULT NULL,
    `current_company` VARCHAR(255) DEFAULT NULL,
    `resume_path` VARCHAR(255) DEFAULT NULL,
    `cover_note` TEXT,
    `status` ENUM('new', 'reviewed', 'shortlisted', 'rejected') DEFAULT 'new',
    `applied_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

foreach (['job_title' => 'VARCHAR(255) DEFAULT NULL', 'experience_years' => 'VARCHAR(50) DEFAULT NULL', 'current_company' => 'VARCHAR(255) DEFAULT NULL', 'status' => 'ENUM("new", "reviewed", "shortlisted", "rejected") DEFAULT "new"'] as $col => $def) {
    $chkJ = $conn->query("SHOW COLUMNS FROM `job_applications` LIKE '$col'");
    if ($chkJ->num_rows == 0) {
        $conn->query("ALTER TABLE `job_applications` ADD `$col` $def");
    }
}

// Table: news (Insights & Articles)
$conn->query("CREATE TABLE IF NOT EXISTS `news` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `slug` VARCHAR(190) NOT NULL UNIQUE,
    `title` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100) DEFAULT 'IPR News',
    `is_featured` TINYINT(1) DEFAULT 0,
    `cover_image` VARCHAR(255) DEFAULT NULL,
    `excerpt` TEXT,
    `content` LONGTEXT,
    `author_name` VARCHAR(255) DEFAULT 'Glow Well Legal Advisory',
    `read_time` VARCHAR(50) DEFAULT '4 min read',
    `published_date` DATE DEFAULT NULL,
    `meta_title` VARCHAR(255) DEFAULT NULL,
    `meta_description` VARCHAR(500) DEFAULT NULL,
    `status` ENUM('published', 'draft') DEFAULT 'published',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

$chkN = $conn->query("SHOW COLUMNS FROM `news` LIKE 'read_time'");
if ($chkN->num_rows == 0) {
    $conn->query("ALTER TABLE `news` ADD `read_time` VARCHAR(50) DEFAULT '4 min read'");
}

// Table: downloads
$conn->query("CREATE TABLE IF NOT EXISTS `downloads` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100) DEFAULT 'IPR Forms',
    `file_path` VARCHAR(255) DEFAULT '#',
    `file_size` VARCHAR(50) DEFAULT '1.2 MB',
    `file_type` VARCHAR(20) DEFAULT 'PDF',
    `description` TEXT,
    `sort_order` INT DEFAULT 0,
    `downloads_count` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

// Table: testimonials
$conn->query("CREATE TABLE IF NOT EXISTS `testimonials` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `client_name` VARCHAR(190) NOT NULL,
    `client_role` VARCHAR(190) DEFAULT 'Managing Director',
    `company` VARCHAR(255) DEFAULT NULL,
    `rating` INT DEFAULT 5,
    `feedback` TEXT NOT NULL,
    `sort_order` INT DEFAULT 0,
    `status` ENUM('published', 'draft') DEFAULT 'published',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

echo "Tables verified/created.\n";

// Insert or update admin user (password: admin123)
$adminHash = password_hash('admin123', PASSWORD_BCRYPT);
$chk = $conn->query("SELECT id FROM admins WHERE username = 'admin'");
if ($chk->num_rows > 0) {
    $conn->query("UPDATE admins SET password_hash = '$adminHash', email = 'admin@glowwell.in' WHERE username = 'admin'");
    echo "Admin user updated with password 'admin123'.\n";
} else {
    $conn->query("INSERT INTO admins (username, email, password_hash, role) VALUES ('admin', 'admin@glowwell.in', '$adminHash', 'superadmin')");
    echo "Admin user created with username 'admin' and password 'admin123'.\n";
}

// Update settings with real Glowwell data
$settings = [
    'site_name' => 'Glow Well Consultants Pvt. Ltd.',
    'tagline' => 'Premier Intellectual Property, Patent & Legal Corporate Advisory',
    'header_phone_display' => '+91 7488961920 / 21',
    'contact_landline' => '+91 612 2999299',
    'contact_mobile' => '+91 7488961920',
    'contact_mobile_alt' => '+91 7488961921',
    'contact_mobile_alt2' => '+91 7488961921',
    'whatsapp_number' => '917488961920',
    'whatsapp_display' => '+91 7488961920',
    'contact_email' => 'info@glowwell.in',
    'contact_email_enquiry' => 'info@glowwell.in',
    'contact_address' => '2nd Floor, Mohini Market, Near SBI Exhibition Road Branch, Opp. Hotel Gargee Grand, Exhibition Road, Patna - 800001, Bihar, India',
    'office_hours' => 'Monday - Saturday: 10:00 AM - 7:00 PM (Sunday Closed)',
    'map_embed' => 'https://maps.google.com/maps?q=2nd+Floor,+Mohini+Market,+Near+SBI+Exhibition+Road+Branch,+Opp.+Hotel+Gargee+Grand,+Exhibition+Road,+Patna+-+800001,+Bihar,+India&t=&z=16&ie=UTF8&iwloc=&output=embed',
    'footer_about' => 'Glow Well Consultants Pvt. Ltd. is Eastern India\'s premier attorney & consultancy firm specializing in Patents, Trademarks, Copyrights, Industrial Designs, Geographical Indications, ISO Certification, and Corporate Business Registration.',
    'stats_years' => '13+',
    'stats_cases' => '6,500+',
    'stats_success' => '99.4%',
    'stats_clients' => '3,500+',
    'cta_title' => 'Protect Your Intellectual Property & Business Assets Today',
    'cta_text' => 'Get in touch with our certified attorney consultants for an immediate confidential evaluation and cost estimate.',
    'cta_btn_label' => 'Book Consultation',
    'cta_btn_link' => 'enquiry.php'
];

foreach ($settings as $k => $v) {
    $stmt = $conn->prepare("INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `setting_value` = ?");
    $stmt->bind_param("sss", $k, $v, $v);
    $stmt->execute();
}
echo "Settings updated.\n";

// Insert / Update Practices
$practices = [
    [
        'slug' => 'patent',
        'title' => 'Patent Law & Prosecution',
        'short_description' => 'Comprehensive patent search, provisional & complete drafting, Indian & PCT international filing, opposition and maintenance.',
        'icon' => 'fa-lightbulb-o',
        'intro' => 'A patent gives an inventor the statutory right for a limited period (20 years) to stop others from making, using, selling, or importing an invention without permission. At Glow Well, we guide inventors, research institutions, and corporations through patentability search, drafting, examination, and grant.',
        'sort_order' => 1,
        'is_featured' => 1
    ],
    [
        'slug' => 'trademark',
        'title' => 'Trademark Registration & Protection',
        'short_description' => 'Comprehensive market & official registry search, filing across Classes 1–45 and Class 99 multiclass, objection defense, opposition hearings & renewals.',
        'icon' => 'fa-registered',
        'intro' => 'A trademark protects your brand identity, logo, slogan, and business goodwill. Under the Trade Marks Act 1999, registration grants exclusive nationwide rights and prevents competitors from using deceptively similar marks.',
        'sort_order' => 2,
        'is_featured' => 1
    ],
    [
        'slug' => 'copyright',
        'title' => 'Copyright Protection & Licensing',
        'short_description' => 'Protection for literary works, software code, musical compositions, cinematography, artistic logos, and NOC clearance from Trademark Registry.',
        'icon' => 'fa-copyright',
        'intro' => 'Copyright safeguards original creative expressions under the Indian Copyright Act 1957. It confers economic and moral rights, preventing unauthorized reproduction, digital distribution, and adaptation.',
        'sort_order' => 3,
        'is_featured' => 1
    ],
    [
        'slug' => 'designs',
        'title' => 'Industrial Design Registration',
        'short_description' => 'Aesthetic shape, ornamentation, surface pattern, and 2D/3D design registration under the Designs Act 2000 at the Kolkata Patent Office.',
        'icon' => 'fa-paint-brush',
        'intro' => 'Design rights protect the unique aesthetic appearance and visual appeal of manufactured articles. Governed by the Designs Act 2000, valid design registration grants a 10-year exclusive monopoly extendable up to 15 years.',
        'sort_order' => 4,
        'is_featured' => 1
    ],
    [
        'slug' => 'geographical',
        'title' => 'Geographical Indication (GI)',
        'short_description' => 'Registration and protection of goods having specific geographical origin and reputation under TRIPS and the GI Act 1999.',
        'icon' => 'fa-globe',
        'intro' => 'Geographical Indication protects agricultural, handicraft, and manufactured products associated with a distinct territory (such as Darjeeling Tea, Madhubani Art, Bhagalpuri Silk, Shahi Litchi). It preserves cultural heritage and prevents commercial counterfeits.',
        'sort_order' => 5,
        'is_featured' => 1
    ],
    [
        'slug' => 'iso-certification',
        'title' => 'ISO Certification & Quality Audits',
        'short_description' => 'ISO 9001 (QMS), ISO 14001, ISO 27001 (Information Security), ISO 22000, gap analysis, documentation & compliance facilitation.',
        'icon' => 'fa-certificate',
        'intro' => 'ISO certifications validate your organization\'s commitment to quality, data safety, and operational excellence. Glow Well provides end-to-end consulting from gap assessment and process documentation to final audit certification.',
        'sort_order' => 6,
        'is_featured' => 1
    ],
    [
        'slug' => 'company-registration',
        'title' => 'Company & Business Incorporation',
        'short_description' => 'Private Limited Company, LLP, One Person Company (OPC), MSME / Udyam registration, Startup India DPIIT recognition & ROC filing.',
        'icon' => 'fa-building',
        'intro' => 'Launch your enterprise on solid legal foundations. We assist startups and established businesses with MCA incorporation, DIN, DSC, PAN, TAN, GST, MSME certifications, and statutory annual compliances.',
        'sort_order' => 7,
        'is_featured' => 1
    ],
    [
        'slug' => 'cyber-law',
        'title' => 'Cyber Law & Digital Rights Advisory',
        'short_description' => 'Data protection compliance, domain dispute resolution (INDRP/UDRP), software escrow contracts, cybercrime litigation & digital IP enforcement.',
        'icon' => 'fa-laptop',
        'intro' => 'In an interconnected digital landscape, digital assets face cyber threats, brand impersonation, and domain cybersquatting. Our cyber legal team defends your digital footprint under the Information Technology Act.',
        'sort_order' => 8,
        'is_featured' => 1
    ],
    [
        'slug' => 'litigation',
        'title' => 'Litigation & Dispute Resolution',
        'short_description' => 'Infringement lawsuits, passing-off legal actions, cease-and-desist notices, arbitration, and High Court / District Court representation.',
        'icon' => 'fa-gavel',
        'intro' => 'When your intellectual property or commercial rights are violated, swift and decisive legal action is vital. We represent rights holders in civil injunctions, damages suits, and criminal seizure proceedings against counterfeiters.',
        'sort_order' => 9,
        'is_featured' => 1
    ]
];

foreach ($practices as $p) {
    $stmt = $conn->prepare("INSERT INTO `practices` (`slug`, `title`, `short_description`, `icon`, `intro`, `sort_order`, `is_featured`, `status`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, 'published') 
        ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `short_description` = VALUES(`short_description`), `icon` = VALUES(`icon`), `intro` = VALUES(`intro`), `sort_order` = VALUES(`sort_order`), `is_featured` = VALUES(`is_featured`)");
    $stmt->bind_param("sssssii", $p['slug'], $p['title'], $p['short_description'], $p['icon'], $p['intro'], $p['sort_order'], $p['is_featured']);
    $stmt->execute();
}
echo "Practices updated.\n";

// Insert Rich FAQs for Trademark, Patent, Copyright, Design, GI
$conn->query("TRUNCATE TABLE `faqs`");

$faqs = [
    // TRADEMARK FAQs
    ['trademark', 'What is a trademark?', 'Trademarks are words, names, symbols, brand names, devices, headings, labels, tickets, signatures, letters, numerals, or any combination thereof, used or proposed to be used by manufacturers or service providers to identify and distinguish their goods and services from those of others. A person who uses a registered trademark acquires statutory exclusive rights.'],
    ['trademark', 'What are the benefits of trademark registration?', 'Trademark registration protects the goodwill of a business, grants exclusive nationwide rights, and provides prima facie evidence of ownership in legal disputes. It deters counterfeiters, allows you to use the registered ® symbol, and serves as a priority basis for filing international trademark applications under the Madrid Protocol.'],
    ['trademark', 'Who can file an application for trademark registration?', 'Any person claiming to be the proprietor of a trademark—whether an individual, partnership firm, LLP, private limited company, society, or trust—can file an application. The applicant can be either currently using the mark or propose to use it in good faith in commerce.'],
    ['trademark', 'What marks can and cannot be registered?', 'Distinctive marks, invented words, unique logos, and coined terms can be registered. Marks that are merely descriptive of the product, generic terms, deceptive marks, marks scandalous or offensive to religious sentiments, or marks identical/confusingly similar to pre-existing registered marks cannot be registered.'],
    ['trademark', 'What is a trademark search and why is it essential?', 'A trademark search scans the official records of the Trademark Registry to uncover identical or phonetically similar marks. Conducting an official search before filing saves immense time and money, and prevents expensive opposition, objections, and infringement lawsuits.'],
    ['trademark', 'How long does a trademark registration remain valid?', 'A trademark registration in India is valid for 10 (ten) years from the date of filing. It can be renewed indefinitely every 10 years upon payment of the statutory renewal fee.'],
    ['trademark', 'What is the difference between "TM" and "®"?', 'You can use the "TM" symbol immediately once you have filed the application and obtained an official acknowledgement / application number. The "®" symbol can ONLY be used legally after the Trademark Registry issues the official Certificate of Registration.'],
    ['trademark', 'What is the difference between Infringement and Passing Off?', 'Infringement is a statutory remedy available for registered trademarks under the Trade Marks Act 1999—proof of similarity alone is sufficient. Passing off is a common-law remedy for unregistered marks, which requires proving established goodwill, misrepresentation, and likelihood of financial injury.'],
    ['trademark', 'Can a trademark be transferred or assigned?', 'Yes, a registered trademark or an application pending registration is fully assignable with or without the goodwill of the business, through an official deed of assignment.'],

    // COPYRIGHT FAQs
    ['copyright', 'What is a copyright under Indian Law?', 'Copyright is a bundle of exclusive legal rights granted under the Indian Copyright Act 1957 to creators of original literary, dramatic, musical, artistic works, sound recordings, and cinematograph films, as well as computer software programs and databases.'],
    ['copyright', 'What rights does copyright protection grant?', 'Copyright confers the exclusive right to reproduce the work, publish copies, perform or communicate the work to the public, produce translations, create adaptations, and sell or license copies.'],
    ['copyright', 'Is copyright registration mandatory to claim protection?', 'Copyright protection is automatic upon the creation of the work. However, official registration with the Copyright Office of India provides prima facie admissible evidence in court, which is decisive in civil and criminal litigation against infringers.'],
    ['copyright', 'What documents are required for filing copyright in India?', 'Full name, nationality, and address of the applicant and author; title of the work; date and country of first publication; 6 copies of the work; Power of Attorney; and a No Objection Certificate (NOC) from the Trademark Office if registering artistic labels or logos.'],
    ['copyright', 'How long does copyright protection last?', 'For original literary, dramatic, musical, and artistic works, copyright lasts for the lifetime of the author plus 60 years from the beginning of the calendar year following the author\'s death. For cinematograph films, sound recordings, and posthumous works, it lasts for 60 years from publication.'],

    // PATENT FAQs
    ['patent', 'What is a patent and what rights does it confer?', 'A patent is a statutory monopoly granted by the Government for an invention that is novel, involves an inventive step (non-obvious), and has industrial applicability. It confers the exclusive right to exclude others from making, using, offering for sale, selling, or importing the invention in India for 20 years.'],
    ['patent', 'What is the difference between a provisional and complete specification?', 'A provisional specification establishes an immediate priority date when the invention is in development. A complete specification detailing full technical disclosure and claims must then be filed within 12 months.'],
    ['patent', 'Are patent rights territorial?', 'Yes, patent rights granted in India are valid only within the territory of India. To secure protection in other countries, an applicant must file corresponding patent applications abroad or through the Patent Cooperation Treaty (PCT) within 12 months of the Indian filing date.'],

    // DESIGN FAQs
    ['designs', 'What is an Industrial Design under the Designs Act 2000?', 'Design refers to the features of shape, configuration, pattern, ornament, or composition of lines or colors applied to any article in two-dimensional or three-dimensional form by an industrial process, which in the finished article appeal to and are judged solely by the eye.'],
    ['designs', 'What is the duration of design registration in India?', 'Initial registration lasts for 10 years from the registration date. It can be extended for an additional period of 5 years upon filing an application for renewal before expiry, giving total protection of 15 years.'],
    ['designs', 'Can a trademark or artistic work be registered as a design?', 'No. By statutory definition, design excludes trade marks, property marks, and artistic works covered under the Copyright Act, as well as mere functional mechanical devices.']
];

$stmt = $conn->prepare("INSERT INTO `faqs` (`practice_slug`, `question`, `answer`, `sort_order`, `status`) VALUES (?, ?, ?, ?, 'published')");
$order = 1;
foreach ($faqs as $f) {
    $stmt->bind_param("sssi", $f[0], $f[1], $f[2], $order);
    $stmt->execute();
    $order++;
}
echo "FAQs populated.\n";

$conn->query("SET FOREIGN_KEY_CHECKS = 0");

// Careers seed data
$conn->query("TRUNCATE TABLE `careers`");
$careers = [
    [
        'title' => 'Senior Trademark & Patent Attorney',
        'department' => 'Intellectual Property Rights',
        'job_type' => 'Full Time',
        'experience' => '4-8 Years',
        'location' => 'Patna Office / Hybrid',
        'description' => 'Lead trademark search, drafting patent specifications, responding to examination reports, and representing clients in registry hearings.',
        'requirements' => 'Degree in Law (LL.B.) and Registered Patent/Trademark Agent qualification. Proven track record in IP prosecution.'
    ],
    [
        'title' => 'Patent Drafting Associate (Tech / Bio)',
        'department' => 'Patent Prosecution',
        'job_type' => 'Full Time',
        'experience' => '2-4 Years',
        'location' => 'Patna Head Office',
        'description' => 'Drafting provisional and non-provisional patent specifications, prior art novelty searches, claim structuring, and patent landscaping.',
        'requirements' => 'B.Tech / M.Sc / M.Pharm / Ph.D. with deep patent search and drafting expertise.'
    ],
    [
        'title' => 'Corporate Legal Executive',
        'department' => 'Corporate Services',
        'job_type' => 'Full Time',
        'experience' => '1-3 Years',
        'location' => 'Patna Head Office',
        'description' => 'Handling company incorporation, ROC annual filings, MSME documentation, and client liaison for corporate licensing.',
        'requirements' => 'B.Com / LL.B / CS Executive with MCA V3 portal proficiency.'
    ]
];

$stmt = $conn->prepare("INSERT INTO `careers` (`title`, `department`, `job_type`, `experience`, `location`, `description`, `requirements`, `posted_date`, `status`, `sort_order`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, CURDATE(), 'published', ?)");
$co = 1;
foreach ($careers as $c) {
    $stmt->bind_param("sssssssi", $c['title'], $c['department'], $c['job_type'], $c['experience'], $c['location'], $c['description'], $c['requirements'], $co);
    $stmt->execute();
    $co++;
}
echo "Careers populated.\n";

// Seed Downloads
$conn->query("TRUNCATE TABLE `downloads`");
$downloads = [
    ['Official Trademark Application TM-A Guidance Note', 'Trademark', 'Official guide covering classification, user affidavits, and document checklists for TM-A filing.', 'PDF', '1.4 MB', 342],
    ['Patent Filing Checklist & Provisional Specification Guide', 'Patent', 'Step-by-step checklist for inventors covering novel technical disclosure and patent drawings.', 'PDF', '2.1 MB', 289],
    ['Copyright Registration Information & NOC Format', 'Copyright', 'Standard checklist for artistic, literary, and software copyright registration including TM NOC form.', 'PDF', '950 KB', 415],
    ['Industrial Design Application Form 1 Reference', 'Design', 'Guidelines on representation sheets, views (perspective, top, side), and priority documents.', 'PDF', '1.1 MB', 180],
    ['Nice Classification Guide (Classes 1–45 Goods & Services)', 'General', 'Comprehensive reference index of international goods and services classification.', 'PDF', '3.8 MB', 890]
];

$stmt = $conn->prepare("INSERT INTO `downloads` (`title`, `category`, `description`, `file_type`, `file_size`, `downloads_count`, `sort_order`) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");
$do = 1;
foreach ($downloads as $d) {
    $stmt->bind_param("sssssii", $d[0], $d[1], $d[2], $d[3], $d[4], $d[5], $do);
    $stmt->execute();
    $do++;
}
echo "Downloads populated.\n";

// Seed Testimonials
$conn->query("TRUNCATE TABLE `testimonials`");
$testimonials = [
    [
        'Dr. Alok Verma',
        'Founder & CEO',
        'Patliputra BioTech Labs',
        5,
        'Glow Well handled our complex biomedical patent application flawlessly. Their team performed exhaustive prior-art searches and drafted claims that were granted without a single objection.'
    ],
    [
        'Sunil K. Agarwal',
        'Managing Director',
        'Mithila Agro Processing Pvt Ltd',
        5,
        'We registered multiple brand trademarks and secured Geographical Indication facilitation through Glow Well. Their 13 years of courtroom and registry experience in Patna is unmatched in Eastern India.'
    ],
    [
        'Pooja Singhania',
        'Chief Legal Counsel',
        'Apex Infotech Solutions',
        5,
        'From our software copyright to ISO 27001 certification and corporate contracts, Glow Well Consultants has been our trusted legal backbone for the past 7 years.'
    ]
];

$stmt = $conn->prepare("INSERT INTO `testimonials` (`client_name`, `client_role`, `company`, `rating`, `feedback`, `sort_order`) 
    VALUES (?, ?, ?, ?, ?, ?)");
$to = 1;
foreach ($testimonials as $t) {
    $stmt->bind_param("sssisi", $t[0], $t[1], $t[2], $t[3], $t[4], $to);
    $stmt->execute();
    $to++;
}
echo "Testimonials populated.\n";

// Seed News / Insights
$conn->query("TRUNCATE TABLE `news`");
$news = [
    [
        'slug' => 'understanding-trademark-classes-for-startups',
        'title' => 'Understanding Trademark Classes: A Strategic Guide for Emerging Startups',
        'category' => 'Trademark Insights',
        'excerpt' => 'How to select the right Nice Classification classes for goods and services to avoid gaps in brand protection while keeping registration costs optimized.',
        'content' => '<p>When filing a trademark in India, selecting appropriate classes under the international Nice Classification system is one of the most critical decisions. With 34 classes for physical goods and 11 classes for services, entrepreneurs often wonder whether to file in single classes or opt for multiclass filing under Class 99.</p><p>Filing across multiple related classes provides comprehensive legal immunity against brand squatters, while proper classification saves applicants from costly re-filings and registry objections.</p>',
        'read_time' => '5 min read'
    ],
    [
        'slug' => 'biotech-and-ai-patents-indian-patent-office-trends',
        'title' => 'Patent Examination Trends for Computer Implemented Inventions & AI in India',
        'category' => 'Patent Law',
        'excerpt' => 'Analyzing Section 3(k) objections under the Indian Patents Act and how inventive step drafting ensures grants for software-driven innovations.',
        'content' => '<p>Section 3(k) of the Indian Patents Act 1970 excludes mathematical methods, business methods, computer programmes per se, and algorithms from patentability. However, recent High Court precedents and updated CRI guidelines affirm that when software produces a tangible technical effect or works in tandem with specialized hardware, patent protection is viable.</p><p>Careful specification drafting focusing on technical contribution rather than mere abstract code is the key to overcoming examination hurdles.</p>',
        'read_time' => '6 min read'
    ],
    [
        'slug' => 'safeguarding-geographical-indications-bihar-heritage',
        'title' => 'Safeguarding Regional Heritage: The Economic Power of Geographical Indications',
        'category' => 'Geographical Indications',
        'excerpt' => 'From Madhubani paintings to Shahi Litchi, how GI tagging protects rural artisan communities and commands premium pricing in international export markets.',
        'content' => '<p>Geographical Indications (GI) are collective rights granted to producers within a designated territory. In Eastern India, traditional crafts and agricultural delicacies have benefited enormously from GI registration, which legally excludes non-origin counterfeits from using deceptive regional labels.</p><p>Glow Well has actively championed the protection of regional heritage, advising cooperatives and artisan associations on statutory registration and post-grant enforcement.</p>',
        'read_time' => '4 min read'
    ]
];

$stmt = $conn->prepare("INSERT INTO `news` (`slug`, `title`, `category`, `excerpt`, `content`, `read_time`, `published_date`, `status`, `is_featured`) 
    VALUES (?, ?, ?, ?, ?, ?, CURDATE(), 'published', 1)");
foreach ($news as $n) {
    $stmt->bind_param("ssssss", $n['slug'], $n['title'], $n['category'], $n['excerpt'], $n['content'], $n['read_time']);
    $stmt->execute();
}
echo "News / Insights populated.\n";

$conn->query("SET FOREIGN_KEY_CHECKS = 1");
echo "ALL DATABASE SETUP COMPLETED SUCCESSFULLY!\n";
