<?php
session_start();
require_once 'config/database.php';
if (isset($_SESSION['user_name'])) {
    writeLog($_SESSION['user_name'], 'LOGOUT', 'Выход из системы');
}
session_destroy();
header('Location: login.php');
exit;
?>