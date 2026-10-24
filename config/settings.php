<?php
/**
 * Global Configuration & Helper Functions
 * Glow Well Consultants Pvt. Ltd.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';

// Auto-detect Base URL
function get_base_url() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? "https://" : "http://";
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
    
    // Check if script runs inside a subfolder like /glowwell.in
    $scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    // Normalize if inside /admin or similar
    if (strpos($scriptName, '/admin') !== false) {
        $scriptName = substr($scriptName, 0, strpos($scriptName, '/admin'));
    }
    $subDir = rtrim($scriptName, '/');
    return rtrim($protocol . $host . $subDir, '/');
}

define('BASE_URL', get_base_url());

// Settings Cache
function get_all_settings() {
    static $settings = null;
    if ($settings === null) {
        $settings = [];
        try {
            $pdo = get_pdo();
            $stmt = $pdo->query("SELECT setting_key, setting_value FROM settings");
            while ($row = $stmt->fetch()) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        } catch (Exception $e) {
            // fallback defaults
            $settings = [
                'site_name' => 'Glow Well Consultants Pvt. Ltd.',
                'tagline' => 'Premier Intellectual Property, Patent & Legal Corporate Advisory',
                'contact_phone' => '+91 612 2999299',
                'contact_landline' => '+91 612 2999299',
                'contact_mobile' => '+91 7488961920',
                'contact_mobile_alt' => '+91 7488961921',
                'whatsapp_number' => '917488961920',
                'contact_email' => 'info@glowwell.in',
                'contact_email_enquiry' => 'info@glowwell.in',
                'contact_address' => '201, 2nd Floor, Mohini Market, Opp Hotel Gargee Grand, Exhibition Road, Patna - 800001, Bihar, India'
            ];
        }
    }
    return $settings;
}

function get_setting($key, $default = '') {
    $all = get_all_settings();
    return isset($all[$key]) ? $all[$key] : $default;
}

// Security: Escape HTML
function e($string) {
    return htmlspecialchars((string)$string, ENT_QUOTES, 'UTF-8');
}

// CSRF Token Management
function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function verify_csrf() {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'])) {
        return false;
    }
    return true;
}

// Active navigation helper
function is_active($pageName) {
    $current = basename($_SERVER['PHP_SELF']);
    if ($current === $pageName) {
        return 'active';
    }
    return '';
}

// Fetch practices for dropdowns & cards
function get_active_practices() {
    static $practices = null;
    if ($practices === null) {
        try {
            $pdo = get_pdo();
            $stmt = $pdo->query("SELECT id, slug, title, short_description, icon FROM practices WHERE status = 'published' ORDER BY sort_order ASC");
            $practices = $stmt->fetchAll();
        } catch (Exception $e) {
            $practices = [];
        }
    }
    return $practices;
}
