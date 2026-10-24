<?php
require_once __DIR__ . '/../config/settings.php';

if (empty($_SESSION['admin_logged'])) {
    header("Location: " . BASE_URL . "/login.php");
    exit;
}
