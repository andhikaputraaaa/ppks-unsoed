<?php
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

function isAdmin() {
    return $_SESSION['role'] === 'admin';
}

function isSatgas() {
    return $_SESSION['role'] === 'satgas';
}
?>
