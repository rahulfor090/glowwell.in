<?php
/**
 * Consultation & Contact Form Submission Processor
 * Glow Well Consultants Pvt. Ltd.
 */

require_once __DIR__ . '/config/settings.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . BASE_URL . "/index.php");
    exit;
}

// Verify CSRF
if (!verify_csrf()) {
    die("Security verification failed. Please refresh the page and try again.");
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$whatsapp = trim($_POST['whatsapp'] ?? $phone);
$company = trim($_POST['company'] ?? '');
$service = trim($_POST['service_interest'] ?? 'General Consultation');
$subject = trim($_POST['subject'] ?? "Inquiry for $service");
$message = trim($_POST['message'] ?? 'Client requested quotation/consultation via website form.');
$office = trim($_POST['office'] ?? 'Patna Head Office');
$return_url = $_POST['return_url'] ?? (BASE_URL . '/index.php');
$ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';

if (empty($name) || empty($email) || empty($phone)) {
    header("Location: " . $return_url . (strpos($return_url, '?') !== false ? '&' : '?') . "error=missing_fields");
    exit;
}

try {
    $pdo = get_pdo();
    $stmt = $pdo->prepare("INSERT INTO `contact_messages` 
        (`name`, `email`, `phone`, `whatsapp`, `company`, `service_interest`, `subject`, `office`, `message`, `ip_address`, `status`, `is_read`, `created_at`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'new', 0, NOW())");
    
    $stmt->execute([
        $name, $email, $phone, $whatsapp, $company, $service, $subject, $office, $message, $ip
    ]);

    // Redirect with success parameter
    header("Location: " . $return_url . (strpos($return_url, '?') !== false ? '&' : '?') . "success=1");
    exit;

} catch (Exception $e) {
    error_log("Enquiry Insert Error: " . $e->getMessage());
    header("Location: " . $return_url . (strpos($return_url, '?') !== false ? '&' : '?') . "error=db_error");
    exit;
}
