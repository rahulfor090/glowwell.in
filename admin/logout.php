<?php
require_once __DIR__ . '/../config/settings.php';
unset($_SESSION['admin_logged'], $_SESSION['admin_id'], $_SESSION['admin_user'], $_SESSION['admin_role']);
session_destroy();
header("Location: " . BASE_URL . "/login.php");
exit;
