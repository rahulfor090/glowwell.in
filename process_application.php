<?php
/**
 * Job Application Submission Processor
 * Glow Well Consultants Pvt. Ltd.
 */

require_once __DIR__ . '/config/settings.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . BASE_URL . "/career.php");
    exit;
}

if (!verify_csrf()) {
    die("Security verification failed. Please try again.");
}

$career_id = (int)($_POST['career_id'] ?? 0);
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$experience = trim($_POST['experience_years'] ?? '');
$cover_note = trim($_POST['cover_note'] ?? '');

if (empty($name) || empty($email) || empty($phone) || empty($_FILES['resume']['name'])) {
    header("Location: " . BASE_URL . "/career.php?err=missing_fields");
    exit;
}

// Handle file upload
$allowed_exts = ['pdf', 'doc', 'docx'];
$fileName = $_FILES['resume']['name'];
$fileTmp = $_FILES['resume']['tmp_name'];
$fileSize = $_FILES['resume']['size'];
$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

if (!in_array($ext, $allowed_exts) || $fileSize > (8 * 1024 * 1024)) {
    header("Location: " . BASE_URL . "/career.php?err=file_type");
    exit;
}

$uploadDir = __DIR__ . '/uploads/resumes/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$newFileName = 'resume_' . time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '', $name) . '.' . $ext;
$targetPath = $uploadDir . $newFileName;

if (!move_uploaded_file($fileTmp, $targetPath)) {
    header("Location: " . BASE_URL . "/career.php?err=upload_fail");
    exit;
}

$dbResumePath = 'uploads/resumes/' . $newFileName;

// Find Job title if applicable
$pdo = get_pdo();
$jobTitle = "General Application";
if ($career_id > 0) {
    $stmtJ = $pdo->prepare("SELECT title FROM careers WHERE id = ?");
    $stmtJ->execute([$career_id]);
    $jobTitle = $stmtJ->fetchColumn() ?: "General Application";
}

try {
    $stmt = $pdo->prepare("INSERT INTO `job_applications` 
        (`career_id`, `job_title`, `name`, `email`, `phone`, `experience_years`, `resume_path`, `cover_note`, `status`, `applied_at`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'new', NOW())");
    $stmt->execute([
        $career_id ?: null, $jobTitle, $name, $email, $phone, $experience, $dbResumePath, $cover_note
    ]);

    header("Location: " . BASE_URL . "/career.php?applied=1");
    exit;
} catch (Exception $e) {
    error_log("Application Save Error: " . $e->getMessage());
    header("Location: " . BASE_URL . "/career.php?err=db_error");
    exit;
}
